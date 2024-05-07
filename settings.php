<?php
session_start();

// Check if the user is logged in and has the required permissions
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true || $_SESSION['username'] !== 'admin') {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit();
}

// Database connection
require_once 'db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle the form submission and update the prices
    require_once 'update_prices.php';
}

// Fetch the current test prices from the database
$sql = "SELECT test_type, price FROM test_prices";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    /* General Styles */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
    }

    .content {
      max-width: 800px;
      margin: 20px auto;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }

    /* Tabs */
    .tab {
      overflow: hidden;
      background-color: #f1f1f1;
      border-radius: 5px;
      margin-bottom: 20px;
    }

    .tab button {
      background-color: #f1f1f1;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 10px 20px;
      transition: 0.3s;
      font-size: 16px;
      border-radius: 5px 5px 0 0;
    }

    .tab button:hover {
      background-color: #ddd;
    }

    .tab button.active {
      background-color: #ffc107;
      color: #333;
    }

    .tabcontent {
      display: none;
      padding: 20px;
      border: 1px solid #ccc;
      border-top: none;
      border-radius: 0 0 10px 10px;
    }

    /* Table */
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }


    /* Buttons */
    button[type="submit"] {
      background-color: #ffc107;
      color: #333;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      display: block; /* Make the button a block-level element */
      margin: 0 auto; /* Center the button horizontally */
    }

    button[type="submit"]:hover {
      background-color: #ffb300;
    }
  </style>
</head>
<body>

  <div class="content">
    <h2>Settings</h2>
    <div class="tab">
      <button class="tablinks active" onclick="openTab(event, 'TestPrices')">
        <i class="fas fa-vial"></i> Test Prices
      </button>
      <button class="tablinks" onclick="openTab(event, 'GeneralSettings')">
        <i class="fas fa-sliders-h"></i> General Settings
      </button>
      <button class="tablinks" onclick="openTab(event, 'UserManagement')">
        <i class="fas fa-users"></i> User Management
      </button>
    </div>

    <div id="TestPrices" class="tabcontent">
      <h3>Test Prices</h3>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <table>
          <tr>
            <th>Test Type</th>
            <th>Current Price</th>
            <th>New Price</th>
          </tr>
          <?php
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['test_type'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td><input type='number' name='price[" . $row['test_type'] . "]' value='" . $row['price'] . "'></td>";
                echo "</tr>";
              }
            }
          ?>
        </table>
        <br>
        <button type="submit">Update Prices</button>
      </form>
    </div>

    <div id="GeneralSettings" class="tabcontent">
      <h3>General Settings</h3>
      <!-- Add your general settings form or content here -->
    </div>

    <div id="UserManagement" class="tabcontent">
      <h3>User Management</h3>
      <!-- Add your user management form or content here -->
    </div>
  </div>

 <script>
    function openTab(evt, tabName) {
      var i, tabcontent, tablinks;
      // Get all elements with class="tabcontent" and hide them
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      // Get all elements with class="tablinks" and remove the class "active"
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }

      // Show the current tab, and add an "active" class to the button that opened the tab
      document.getElementById(tabName).style.display = "block";
      evt.currentTarget.className += " active";
    }
  </script>
  
  </body>
</html>
