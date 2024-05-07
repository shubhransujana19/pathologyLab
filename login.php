<?php
session_start();
require_once 'db.php'; // Include the database connection file

// Check if the user is already logged in
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
    // Redirect to the dashboard
    header("Location: pathology.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the plaintext password using SHA-256
    $hashed_password = hash('sha256', $password);

    // Retrieve user data from the database
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Compare the hashed password with the hashed value stored in the database
        if ($hashed_password === $row['password']) {
            // Authentication successful, set session variables
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $row['username'];
            header('Location: pathology.php');
            exit;
        }
    }

    // Authentication failed
    $_SESSION['error'] = 'Invalid username or password';
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pathology Lab Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #F7D9C4, #FFF5E4);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            position: relative;
            animation: bounce 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .login-container h2 {
            text-align: center;
            color: #F7882F;
            margin-bottom: 30px;
            font-weight: 600;
            text-shadow: 2px 2px 0 #FFD275;
            margin-top: 30px;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
        }

        .login-container input {
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 2px solid #F7882F;
            border-radius: 10px;
            font-size: 16px;
            background-color: #FFF5E4;
            color: #F7882F;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .login-container input::placeholder {
            color: #F7882F;
            opacity: 0.6;
        }

        .login-container button {
            padding: 12px 15px;
            background-color: #F7882F;
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            font-weight: 500;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            animation: wiggle 2s infinite;
        }

        .login-container button:hover {
            background-color: #E86E0B;
        }

        .login-container .error-message {
            color: #dc143c;
            margin-bottom: 10px;
            text-align: center;
        }

        .svg-container {
            position: absolute;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
            animation: swing 4s infinite;
        }

        @keyframes bounce {
            0% {
                transform: translateY(-100px);
                opacity: 0;
            }
            60% {
                transform: translateY(20px);
            }
            80% {
                transform: translateY(-10px);
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes swing {
            0%, 100% {
                transform: translateX(-50%) rotate(0deg);
            }
            25% {
                transform: translateX(-50%) rotate(10deg);
            }
            75% {
                transform: translateX(-50%) rotate(-10deg);
            }
        }

        @keyframes wiggle {
            0%, 100% {
                transform: rotate(0deg);
            }
            25% {
                transform: rotate(1deg);
            }
            75% {
                transform: rotate(-1deg);
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="svg-container">
            <svg width="180" height="180" viewBox="0 0 180 180" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M90 180C139.706 180 180 139.706 180 90C180 40.2944 139.706 0 90 0C40.2944 0 0 40.2944 0 90C0 139.706 40.2944 180 90 180Z" fill="#F7882F"/>
                <path d="M116.25 49.5C112.988 46.2375 108.412 46.2375 105.15 49.5L74.25 80.4L62.85 69C59.5875 65.7375 55.0125 65.7375 51.75 69C48.4875 72.2625 48.4875 76.8375 51.75 80.1L72.15 100.5C75.4125 103.763 79.9875 103.763 83.25 100.5L116.25 67.5C119.513 64.2375 119.513 59.6625 116.25 49.5Z" fill="white"/>
            </svg>
        </div>
        <h2><i class="fas fa-microscope"></i> Pathology Lab Login</h2>
        <?php

        session_start();
        if (isset($_SESSION['error'])) {
            echo '<p class="error-message">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, 'UTF-8'); ?>">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>    
    </body>
</html>