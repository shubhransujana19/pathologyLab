<?php
    // Include database connection
    require_once 'db.php';

    // Initialize variables
    $message = '';

    // Check if form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if table and ID parameters are provided in the URL
        if(isset($_GET['table']) && isset($_GET['id'])) {
            $table = $_GET['table'];
            $id = $_GET['id'];

            // Get column names from the table
            $sqlColumns = "SHOW COLUMNS FROM $table";
            $resultColumns = $conn->query($sqlColumns);
            $columns = array();
            while ($rowColumn = $resultColumns->fetch_assoc()) {
                $columns[] = $rowColumn['Field'];
            }

            // Initialize an empty array to store updated data
            $updatedData = array();

            // Iterate through the column names
            foreach ($columns as $column) {
                // Skip the 'id' column
                if ($column == 'id') continue;

                // Check if the column exists in the submitted form data
                if (isset($_POST[$column])) {
                    // Sanitize the input data
                    $updatedData[$column] = mysqli_real_escape_string($conn, $_POST[$column]);
                }
            }

            // Construct the SQL query to update the record
            $sqlUpdate = "UPDATE $table SET ";
            foreach ($updatedData as $key => $value) {
                $sqlUpdate .= "$key = '$value', ";
            }
            $sqlUpdate = rtrim($sqlUpdate, ', ');
            $sqlUpdate .= " WHERE id = $id";

            // Execute the update query
            if ($conn->query($sqlUpdate) === TRUE) {
                
            // Redirect to pathology.php with success message
            header("Location: pathology.php?table=" . urlencode($table) . "&success=Record updated successfully");
            exit();
                
            } else {
                $message = "Error updating record: " . $conn->error;
            }
        } else {
            $message = "Table or ID not provided.";
        }
    } else {
        // If form is not submitted, display the edit form
        if(isset($_GET['table']) && isset($_GET['id'])) {
            $table = $_GET['table'];
            $id = $_GET['id'];

            // Fetch record from the database based on table and ID
            $sql = "SELECT * FROM $table WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows > 0) {
                // Fetch record data
                $row = $result->fetch_assoc();

                // Get column names from the table
                $sqlColumns = "SHOW COLUMNS FROM $table";
                $resultColumns = $conn->query($sqlColumns);
                $columns = array();
                while ($rowColumn = $resultColumns->fetch_assoc()) {
                    $columns[] = $rowColumn['Field'];
                }
            } else {
                $message = "Record not found.";
            }
        } else {
            $message = "Table or ID not provided.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 30px;
            max-width: 500px;
            width: 100%;
            animation: slide-up 0.5s ease;
        }

        h2 {
            color: #4c51bf;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            color: #666;
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            color: #333;
            font-weight: 500;
            margin-bottom: 8px;
        }

        input[type="text"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #4c51bf;
            box-shadow: 0 0 5px rgba(76, 81, 191, 0.3);
        }

        button[type="submit"] {
            background-color: #4c51bf;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #7479e2;
        }

        @keyframes slide-up {
            0% {
                transform: translateY(50px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><i class="fas fa-edit"></i> Edit Record</h2>
        <p><?php echo $message; ?></p>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?table=' . $table . '&id=' . $id; ?>">
            <?php
            foreach ($columns as $column) {
                
             // Skip the 'id' column
            if ($column == 'id' || $column == 'created_at' || $column == 'updated_at'|| $column == 'date') continue;

                echo '<label for="' . $column . '">' . ucfirst($column) . ':</label>';
                echo '<input type="text" id="' . $column . '" name="' . $column . '" value="' . $row[$column] . '">';
            }
            ?>

            <button type="submit"><i class="fas fa-save"></i> Update</button>
        </form>
    </div>

    <!-- SVG Background -->
    <div style="position: fixed; bottom: 0; left: 0; z-index: -1;">
        <svg viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#4c51bf" fill-opacity="0.2" d="M0,256L48,245.3C96,235,192,213,288,197.3C384,181,480,171,576,186.7C672,203,768,245,864,261.3C960,277,1056,267,1152,258.7C1248,251,1344,245,1392,242.7L1440,240L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</body>
</html>