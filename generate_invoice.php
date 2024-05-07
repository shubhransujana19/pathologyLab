<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lab Invoice</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 10px;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .invoice-header .logo {
            max-width: 150px;
        }

        .invoice-header .company-info {
            text-align: right;
        }

        .invoice-details {
            margin-bottom: 30px;
        }

        .invoice-details p {
            margin: 5px 0;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .invoice-table th,
        .invoice-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .invoice-table th {
            background-color: #f5f5f5;
        }

        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            color: #777;
            margin-top: 30px;
        }

        .signature {
            text-align: right;
            margin-top: 10px;
        }

        .signature img {
            max-width: 150px;
        }
        
        .actions {
        text-align: center;
        margin-top: 20px;
        }
        
        .actions button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
            transition: background-color 0.3s ease;
        }
        
        .actions button:hover {
            background-color: #0056b3;
        }
    @media print{
        .actions button{
            display:none;
        }
        

    /* Adjust the container width and font size for printing */
    .container {
        width: 90%;
        font-size: 12px; /* Adjust the font size as needed */
        margin: auto; /* Center the content horizontally */
    }


    }

    </style>
</head>
<body>
    
    <?php
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
        // Redirect to the login page
        header("Location: login.php");
        exit();
    }
    
    // Get the username from the session
    $username = $_SESSION['username'];

    ?>

    <?php
    require_once 'db.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve test type and ID from URL parameters
    $testType = $_GET['table'];
    $id = $_GET['id'];

    // Fetch test data from the database based on test type and ID
    $sql = "SELECT * FROM $testType WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Access the retrieved data from $row
        $patientName = $row['patient_name'];
        $uhid = $row['uhid'];
        $date = $row['date'];
        $age = $row['age'];
        $gender = $row['gender'];
        // ... and other relevant fields
    } else {
        echo "No results found.";
    }

    // Fetch laboratory information from the user table
    $sql = "SELECT laboratory_name, address, contact_number1, contact_number2,email FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $labInfo = $result->fetch_assoc();
        $laboratoryName = $labInfo['laboratory_name'];
        $address = $labInfo['address'];
        $contactNumber1 = $labInfo['contact_number1'];
        $contactNumber2 = $labInfo['contact_number2'];
        $email = $labInfo['email'];

    } else {
        echo "No laboratory information found.";
    }

    // Fetch test prices from the test_prices table
    $sql = "SELECT * FROM test_prices";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $testPrices = array();
        while ($row = $result->fetch_assoc()) {
            $testPrices[$row['test_type']] = $row['price'];
        }
    } else {
        echo "No test prices found.";
    }

    // Generate a random invoice number
    $invoiceNumber = mt_rand(1000000, 9999999);

    $conn->close();
    ?>

    <div class="container">
        <h1>Lab Invoice</h1>
        <div class="invoice-header">
            <div class="logo">
                <img src="logo.png" alt="Company Logo">
            </div>
            <div class="company-info">
                <h3><?php echo $laboratoryName; ?></h3>
                <p><?php echo $address; ?></p>
                <p>Phone: <?php echo $contactNumber1; ?></p>
                <p>Phone: <?php echo $contactNumber2; ?></p>
                <p>Email: <?php echo $email; ?></p>
            </div>
        </div>
        <div class="invoice-details">
            <p><strong>Patient Name:</strong> <?php echo $patientName; ?></p>
            <p><strong>UHID:</strong> <?php echo $uhid; ?></p>
            <p><strong>Date:</strong> <?php echo $date; ?></p>
            <p><strong>Age:</strong> <?php echo $age; ?></p>
            <p><strong>Gender:</strong> <?php echo $gender; ?></p>
            <p><strong>Test Type:</strong> <?php echo ucfirst($testType); ?></p>
            <p><strong>Invoice Number:</strong> <?php echo $invoiceNumber; ?></p>
        </div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo ucfirst($testType); ?> Test</td>
                    <td>
                        <?php
                        $price = $testPrices[$testType];
                        echo '₹ ' . $price;
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="total">
            <p>Total: ₹ <?php echo $price; ?></p>
        </div>
        <div class="footer">
            <p>Thank you for choosing our lab services.</p>
            <p>&copy; <?php echo date('Y'); ?> <?php echo $laboratoryName; ?></p>
            <div class="signature">
            <p>  ------------------ <br>
                Signature &nbsp; </p>
        </div>

        </div>
        
         <!-- Print and Download PDF buttons -->
    <div class="actions">
        <button onclick="printInvoice()">Print</button>
        <button onclick="downloadPDF()">Download PDF</button>
    </div>
    
    
    </div>

   <script>
      
    function printInvoice() {
        window.print();
    }

    function downloadPDF() {
        const invoiceContainer = document.querySelector('.container');
        const pdf = new jsPDF();
        pdf.html(invoiceContainer, {
            callback: function (pdf) {
                pdf.save('lab_invoice.pdf');
            }
        });
    }


    </script>
    
</body>
</html>