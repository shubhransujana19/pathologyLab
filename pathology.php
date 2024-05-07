<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fontawesome@5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer">
    
    
    <title>Patient Dashboard</title>
<style>
        /* Updated styles */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            width: 100%;
            /*display: flex;*/
            /*align-items: center;*/
            /*justify-content: center;*/
        }

        .container {
            display: flex;
            /*max-width: 1200px;*/
            width: 100%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            padding:10px;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: #4c51bf;
            color: #fff;
            padding: 20px;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        .sidebar h3 {
            margin-bottom: 20px;
            text-align: center;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar li {
            margin-bottom: 15px;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            display: block;
            padding: 10px 20px;
            transition: all 0.2s ease;
            border-radius: 5px;
            font-size: 14px;
            display: flex;
            align-items: center;
        }

        .sidebar a:hover {
            background-color: #7479e2;
        }

        .sidebar a.active {
            background-color: #7479e2;
        }

        .sidebar a i {
            margin-right: 10px;
            font-size: 18px;
            color: #fff;
        }

        /* Submenu Styles */
        .sidebar-option {
            position: relative;
        }

        .submenu {
            display: none;
            background-color: #f0f2f5;
            border-radius: 5px;
            padding: 10px;
            list-style-type: none;
            margin-top: 10px;
        }

        .submenu li {
            margin-bottom: 5px;
        }

        .submenu a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 3px;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
        }

        .submenu a:hover {
            background-color: #e0e0e0;
            color: #4c51bf;
        }

        .submenu a i {
            margin-right: 5px;
            font-size: 14px;
            color: #4c51bf;
        }
        h3 {
            text-align: center;
            color: #4c51bf;
            font-weight: 600;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Content Area Styles */
        .content {
            flex: 1;
            padding: 20px;
        }

        input[type="text"] {
            width: 90%;
            padding: 12px 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #4c51bf;
            box-shadow: 0 0 5px rgba(76, 81, 191, 0.3);
        }

        /* Improved table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #4c51bf;
            color: #fff;
            text-align: left;
            padding: 12px 10px;
            font-weight: 600;
        }

        td {
            background-color: #f8f9fa;
            color: #333;
        }

        .icon {
            cursor: pointer;
            color: #4c51bf;
            /*text-align: center;*/
            transition: all 0.2s ease;
        }

        .icon:hover {
            color: #7479e2;
        }

        .icon-delete {
            cursor: pointer;
            color: #dc143c;
            text-align: center;
            transition: all 0.2s ease;
        }

        .icon-delete:hover {
            color: #b30000;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 2% auto;
            padding: 5px;
            border: none;
            width: 80%;
            max-width: 800px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close:hover,
        .close:focus {
            color: #333;
            text-decoration: none;
        }

        button {
            padding: 10px 20px;
            background-color: #4c51bf;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: 500;
            font-size: 14px;
        }

        button:hover {
            background-color: #7479e2;
        }

        /* Bottom Links Styles */
        .bottom-links {
            flex: 1;
            text-align: center;
            color: #fff;
            padding: 10px 20px;
            background-color: #4c51bf;
            border-top: 1px solid #ddd;
        }

        .bottom-links ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        .bottom-links li {
            margin: 0 10px;
            display: inline-block;
        }

        .bottom-links a {
            color: inherit;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
        }

        .bottom-links a:hover {
            color: #fefefe;
        }

        .bottom-links a i {
            margin-right: 5px;
            font-size: 16px;
        }
        
        .logout-icon ul{
            list-style-type: none;
            padding: 25px;
            margin: 0;
            display: flex;
            justify-content: center;
        }
        .logout-icon a i{
            color: red;
        }        

        /* Animations */
        @keyframes slide-up {
            0% {
                transform: translateY(20px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

         .dashboard-iframe {
            display: none;
            width: 100%;
            height: 100vh;
            border: none;
        }
        
        .table-container {
            display: none;
        }


        .profile-info {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .profile-username {
            font-weight: bold;
            color: #fff; /* Adjust color as needed */
            font-size: 18px; /* Adjust size as needed */
        }
        
        .loading-bar-container {
            width: 100%;
            height: 4px; /* Adjust height as needed */
            background-color: #f0f0f0; /* Background color of the loading bar container */
            margin-top: 10px; /* Adjust as needed */
        }
        
        .loading-bar {
            width: 0%;
            height: 100%;
            background-color: #4caf50; /* Color of the loading bar */
            animation: progress 3s linear; /* Adjust animation duration as needed */
        }
        
        @keyframes progress {
            0% {
                width: 0%;
            }
            100% {
                width: 100%;
            }
        }

        .help-card {
          display: none;
          position: absolute;
          background-color: #4c51bf;
          padding: 10px;
          border: 1px solid #ccc;
          border-radius: 4px;
          box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
          z-index: 1;
        }
        
        #help-link:hover + .help-card, .help-card:hover {
          display: block;
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
    // Database connection
    require_once 'db.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    function getTotalRecords($table) {
        global $conn;
    
        $sql = "SELECT COUNT(*) AS total FROM $table";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            return 0;
        }
    }
    
    $testTypes = array(
        'BIO-CHEMICAL' => 'biochemical',
        'HEMOTOLOGY' => 'hemotology',
        'STOOL' => 'stool',
        'URINE' => 'urine',
        'WIDAL TEST' => 'widalTest',
        'ASO/RA' => 'asoRa',
        'C.R.P' => 'crp',
        'SERUM' => 'serum',
        'H.I.V' => 'hiv',
        'SEMEN 1' => 'semen1',
        'SEMEN 2' => 'semen2'
    );
    ?>

    <div class="container">
    <div class="sidebar">
        
    <div class="profile-info">
        <p class="profile-username">
            <i class="fas fa-user"></i>  <span><?php echo ucfirst(strtolower($username)); ?></span>
        </p>
     </div>
    
        <ul>

            <li><a href="#" id="dashboard-link"><i class="fas fa-home"></i> DASHBOARD</a></li>     

            <li class="sidebar-option">
                <a href="#"><i class="fas fa-flask text-primary mb-3"></i> BIO-CHEMICAL <i class="fas fa-chevron-down"></i></a>
                <ul class="submenu">
                    <li><a href="#" onclick="loadAddNewForm('biochemical')"><i class="fas fa-plus"></i> Add New</a></li>
                    <li><a href="pathology.php?table=biochemical"><i class="fas fa-eye"></i> View Report</a></li>
                </ul>
            </li>
            <li class="sidebar-option">
                <a href="#"><i class="fas fa-vial"></i> HEMOTOLOGY <i class="fas fa-chevron-down"></i></a>
                <ul class="submenu">
                    <li><a href="#"  onclick="loadAddNewForm('hemotology')"><i class="fas fa-plus"></i> Add New</a></li>
                    <li><a href="pathology.php?table=hemotology"><i class="fas fa-eye"></i> View Report</a></li>
                </ul>
            </li>
            <li class="sidebar-option">
                <a href="#"><i class="fas fa-poop"></i> STOOL <i class="fas fa-chevron-down"></i></a>
                <ul class="submenu">
                    <li><a href="#"  onclick="loadAddNewForm('stool')"><i class="fas fa-plus"></i> Add New</a></li>
                    <li><a href="pathology.php?table=stool"><i class="fas fa-eye"></i> View Report</a></li>
                </ul>
            </li>
            <li class="sidebar-option">
                <a href="#"><i class="fas fa-droplet"></i> URINE <i class="fas fa-chevron-down"></i></a>
               <ul class="submenu">
                    <li><a href="#"  onclick="loadAddNewForm('urine')"><i class="fas fa-plus"></i> Add New</a></li>
                    <li><a href="pathology.php?table=urine"><i class="fas fa-eye"></i> View Report</a></li>
                </ul>
            </li>
            <li class="sidebar-option">
                <a href="#"><i class="fas fa-virus text-info mb-3""></i> WIDAL TEST <i class="fas fa-chevron-down"></i></a>
                <ul class="submenu">
                    <li><a href="#"  onclick="loadAddNewForm('widalTest')"><i class="fas fa-plus"></i> Add New</a></li>
                    <li><a href="pathology.php?table=widalTest"><i class="fas fa-eye"></i> View Report</a></li>
                </ul>
            </li>
            <li class="sidebar-option">
                <a href="#"><i class="fas fa-syringe"></i> ASO/RA <i class="fas fa-chevron-down"></i></a>
                <ul class="submenu">
                    <li><a href="#"  onclick="loadAddNewForm('asoRa')"><i class="fas fa-plus"></i> Add New</a></li>
                    <li><a href="pathology.php?table=asoRa"><i class="fas fa-eye"></i> View Report</a></li>
                </ul>
            </li>
            <li class="sidebar-option">
                <a href="#"><i class="fas fa-temperature-high text-danger mb-3"></i> C.R.P <i class="fas fa-chevron-down"></i></a>
                 <ul class="submenu">
                    <li><a href="#"  onclick="loadAddNewForm('crp')"><i class="fas fa-plus"></i> Add New</a></li>
                    <li><a href="pathology.php?table=crp"><i class="fas fa-eye"></i> View Report</a></li>
                </ul>
            </li>
            <li class="sidebar-option">
                <a href="#"><i class="fas fa-tint"></i> SERUM <i class="fas fa-chevron-down"></i></a>
                <ul class="submenu">
                    <li><a href="#"  onclick="loadAddNewForm('serum')"><i class="fas fa-plus"></i> Add New</a></li>
                    <li><a href="pathology.php?table=serum"><i class="fas fa-eye"></i> View Report</a></li>
                </ul>

            </li>
            <li class="sidebar-option">
                <a href="#"><i class="fas fa-shield-alt"></i> H.I.V <i class="fas fa-chevron-down"></i></a>
                <ul class="submenu">
                    <li><a href="#"  onclick="loadAddNewForm('hiv')"><i class="fas fa-plus"></i> Add New</a></li>
                    <li><a href="pathology.php?table=hiv"><i class="fas fa-eye"></i> View Report</a></li>
                </ul>
            </li>
            <li class="sidebar-option">
                <a href="#"><i class="fas fa-mars"></i> SEMEN 1 <i class="fas fa-chevron-down"></i></a>
               <ul class="submenu">
                    <li><a href="#"  onclick="loadAddNewForm('semen1')"><i class="fas fa-plus"></i> Add New</a></li>
                    <li><a href="pathology.php?table=semen1"><i class="fas fa-eye"></i> View Report</a></li>
                </ul>

            </li>
            <li class="sidebar-option">
                <a href="#"><i class="fas fa-mars"></i> SEMEN 2 <i class="fas fa-chevron-down"></i></a>
                <ul class="submenu">
                    <li><a href="#"  onclick="loadAddNewForm('semen2')"><i class="fas fa-plus"></i> Add New</a></li>
                    <li><a href="pathology.php?table=semen2"><i class="fas fa-eye"></i> View Report</a></li>
                </ul>
            </li>
        </ul>
        <div class="bottom-links">
          <ul>
            <li>
              <a href="#" id="help-link"><i class="fas fa-question-circle"></i> Help & Support</a>
              <div class="help-card">
                <i class="fas fa-phone"></i> Phone: 03220 276 276/275
                <br>
                <i class="fas fa-envelope"></i> Email: info@wmps.in
              </div>
            </li>
            <br>
            <li><a href="#" id="settings-link" onClick="loadSettings()"><i class="fas fa-cog"></i> Settings</a></li>
          </ul>
        </div>
            <div class="logout-icon" >
                <ul>
                  <li><a href="logout.php" style="color: red;"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </div>
    </div>

    <?php 
            // Database connection
            require_once 'db.php';
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            // Retrieve table name from URL parameters
            if(isset($_GET['table'])) {
                $table = mysqli_real_escape_string($conn, $_GET['table']);
            } else {
                // Default table
                $table = 'biochemical';
            }
    ?>

    <div class="content">
    <iframe id="dashboard-iframe" src="admin_dashboard.php" class="dashboard-iframe"></iframe>
    
    <div class="table-container" style="display:none">
        <h3>Patient Reports For <?php echo strtoupper($table); ?></h3>
        <form method="GET" action="pathology.php" style="position: relative;"> <!-- Add action attribute to the form -->
            <input type="hidden" name="table" value="<?php echo $table; ?>"> <!-- Add hidden input field to pass the table name -->
            <input type="text" name="search" placeholder="Search by Name or UHID..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit" style="position: absolute; right: 5px; top: 0;">
                <i class="fas fa-search"></i>
            </button>
        </form>
    <!--  </div>  -->
      
    <!--<div>-->
    
    <?php

            // Check if search parameter is provided
            if(isset($_GET['search'])) {
                // Sanitize the input to prevent SQL injection
                $search = mysqli_real_escape_string($conn, $_GET['search']);

                // Construct SQL query to search for matching records
                $sql = "SELECT * FROM $table WHERE patient_name LIKE '%$search%' OR uhid LIKE '%$search%' ORDER BY date DESC";

                // Execute the query
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    echo '<table>';
                    echo '<tr>';
                    echo '<th><span class="me-2"><i class="bi bi-person"></i></span> Name</th>'; 
                    echo '<th><span class="me-2"><i class="bi bi-hospital"></i></span> UHID</th>'; 
                    echo '<th><span class="me-2"><i class="bi bi-calendar-date"></i></span> Date</th>'; 
                    echo '<th><i class="fas fa-file-medical"></i> View Report</th>';
                    echo '<th><i class="fas fa-file-alt"></i> View Bill</th>';
                    echo '<th><i class="fas fa-edit"></i> Edit Report</th>';
                    // echo '<th><i class="fas fa-trash"></i> Delete Report</th>';
                    echo '</tr>';
                    
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['patient_name'] . '</td>';
                        echo '<td>' . $row['uhid'] . '</td>';
                        echo '<td>' . $row['date'] . '</td>';
                        echo '<td class="icon" onclick="viewReport(\'' . $table . '\', ' . $row['id'] . ')"><i class="fas fa-eye" style="font-size: 12px; position: relative; top: -2px;"></i>&nbsp; View Report</td>';
                        echo '<td class="icon" onclick="viewBill(\'' . $table . '\', ' . $row['id'] . ')"><i class="fas fa-file-invoice-dollar"></i>&nbsp; View Bill</td>';
                        echo '<td class="icon" onclick="editReport(\'' . $table . '\', ' . $row['id'] . ')"><i class="fas fa-edit"></i>&nbsp; Edit Report</td>';
                        // echo '<td class="icon-delete" onclick="deleteBill(' . $row['id'] . ')"><i class="fas fa-trash"></i>&nbsp; Delete Report</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo "0 results";
                }
            } else {
                // Default query when search parameter is not provided
                $sql = "SELECT * FROM $table ORDER BY date DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    echo '<table>';
                    echo '<tr>';
                    echo '<th><span class="me-2"><i class="bi bi-person"></i></span> Name</th>'; 
                    echo '<th><span class="me-2"><i class="bi bi-hospital"></i></span> UHID</th>'; 
                    echo '<th><span class="me-2"><i class="bi bi-calendar-date"></i></span> Date</th>'; 
                    echo '<th><i class="fas fa-file-medical"></i> View Report</th>';
                    echo '<th><i class="fas fa-file-alt"></i> View Bill</th>';
                    echo '<th><i class="fas fa-edit"></i> Edit Report</th>';
                    // echo '<th><i class="fas fa-trash"></i> Delete Report</th>';
                    echo '</tr>';
                    
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['patient_name'] . '</td>';
                        echo '<td>' . $row['uhid'] . '</td>';
                        echo '<td>' . $row['date'] . '</td>';
                        echo '<td class="icon" onclick="viewReport(\'' . $table . '\', ' . $row['id'] . ')"><i class="fas fa-eye" style="font-size: 12px; position: relative; top: -2px;"></i>&nbsp; View Report</td>';
                        echo '<td class="icon" onclick="viewBill(\'' . $table .'\', ' . $row['id'] . ')"><i class="fas fa-file-invoice-dollar"></i>&nbsp; View Bill</td>';
                        echo '<td class="icon" onclick="editReport(\'' . $table . '\', ' . $row['id'] . ')"><i class="fas fa-edit"></i>&nbsp; Edit Report</td>';
                        // echo '<td class="icon-delete" onclick="deleteBill(' . $row['id'] . ')"><i class="fas fa-trash"></i>&nbsp; Delete Report</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                } else {
                    echo "0 results";
                }
            }
            
            $conn->close();
          ?>
          
          <?php
        // Other code...
        
        // Get the success or error message from the URL parameters
        $successMessage = isset($_GET['success']) ? urldecode($_GET['success']) : '';
        $errorMessage = isset($_GET['error']) ? urldecode($_GET['error']) : '';
        ?>

        </div>
    </div>
    
</div>

<script>
    function viewReport(table, id) {
        // Construct the URL using template literals
        const url = `${table}_report_view.php?id=${id}`;
        // Redirect to the constructed URL
        window.location.href = url;
    }

    function viewBill(table, id) {
        // Construct the URL with both table name and ID
        const url = `generate_invoice.php?table=${table}&id=${id}`;
        // Redirect to the constructed URL
        window.location.href = url;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const sidebarOptions = document.querySelectorAll('.sidebar-option');
    
        sidebarOptions.forEach(function(option) {
            const submenu = option.querySelector('.submenu');
    
            option.addEventListener('mouseenter', function() {
                submenu.style.display = 'block';
            });
    
            option.addEventListener('mouseleave', function() {
                submenu.style.display = 'none';
            });
        });
    });


        // JavaScript code for loading and displaying the add new form
        function loadAddNewForm(testType) {
            const formUrl = `${testType}Form.html`;

            fetch(formUrl)
                .then(response => response.text())
                .then(html => {
                    const modal = document.createElement('div');
                    modal.className = 'modal';
                    modal.innerHTML = `
                        <div class="modal-content">
                            <span class="close" onclick="closeModal()">&times;</span>
                            ${html}
                        </div>
                    `;
                    document.body.appendChild(modal);
                    modal.style.display = 'block';
                })
                .catch(error => {
                    console.error('Error fetching form:', error);
                });
        }

        function closeModal() {
            const modal = document.querySelector('.modal');
            modal.style.display = 'none';
            modal.remove();
        }
        
    
document.addEventListener('DOMContentLoaded', function() {
    const dashboardLink = document.getElementById('dashboard-link');
    const dashboardIframe = document.getElementById('dashboard-iframe');
    const tableContainer = document.querySelector('.table-container');

    // Function to show the dashboard and hide the table container
    function showDashboard() {
        dashboardIframe.style.display = 'block';
        tableContainer.style.display = 'none';
    }

    // Function to show the table container and hide the dashboard
    function showTable() {
        dashboardIframe.style.display = 'none';
        tableContainer.style.display = 'block';
    }

    // Add event listener to the dashboard link
    dashboardLink.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default behavior of anchor tag
        showDashboard(); // Show the dashboard
    });

    // Check if the URL contains "pathology.php"
    if (window.location.href.includes("pathology.php")) {
        showTable(); // Show the table container
    } else {
        showDashboard(); // Show the dashboard
    }
});


function editReport(table, id) {
    window.location.href = `edit_form.php?table=${table}&id=${id}`;
}



 // Check if the success message exists
    <?php if (!empty($successMessage)) { ?>
        showSuccessPopup('<?php echo $successMessage; ?>');
    <?php } ?>

    // Check if the error message exists
    <?php if (!empty($errorMessage)) { ?>
        showErrorPopup('<?php echo $errorMessage; ?>');
    <?php } ?>
    
    
function showSuccessPopup(message) {
    // Create a new div element for the pop-up
    const popup = document.createElement('div');
    popup.className = 'success-popup';

    // Create a container for the content
    const popupContent = document.createElement('div');
    popupContent.className = 'popup-content';

    // Add the tick icon
    const tickIcon = document.createElement('i');
    tickIcon.className = 'fas fa-check-circle';
    tickIcon.style.color = '#4caf50';
    tickIcon.style.fontSize = '24px';
    tickIcon.style.marginRight = '10px';

    // Add the message text
    const messageText = document.createElement('span');
    messageText.textContent = message;

    // Append the tick icon and message text to the content container
    popupContent.appendChild(tickIcon);
    popupContent.appendChild(messageText);

    // Append the content container to the pop-up
    popup.appendChild(popupContent);

    // Create a container for the loading bar
    const loadingBarContainer = document.createElement('div');
    loadingBarContainer.className = 'loading-bar-container';

    // Create the loading bar
    const loadingBar = document.createElement('div');
    loadingBar.className = 'loading-bar';

    // Append the loading bar to the container
    loadingBarContainer.appendChild(loadingBar);

    // Append the loading bar container to the pop-up
    popup.appendChild(loadingBarContainer);

    // Add styles for the pop-up
    popup.style.position = 'fixed';
    popup.style.top = '10%';
    popup.style.left = '50%';
    popup.style.transform = 'translateX(-50%)';
    popup.style.padding = '20px';
    popup.style.backgroundColor = '#fff';
    popup.style.color = '#333';
    popup.style.borderRadius = '5px';
    popup.style.boxShadow = '0 0 10px rgba(0, 0, 0, 0.3)';
    popup.style.zIndex = '9999';
    popup.style.display = 'flex';
    popup.style.flexDirection = 'column'; // Adjusted to column layout

    // Add the pop-up to the document body
    document.body.appendChild(popup);

    // Animate the loading bar
    animateLoadingBar();

    // Remove the pop-up after 3 seconds
    setTimeout(function() {
        popup.remove();
    }, 3000);
}

function animateLoadingBar() {
    const loadingBar = document.querySelector('.loading-bar');
    loadingBar.style.width = '100%'; // Initial width
    setTimeout(function() {
        loadingBar.style.width = '0%'; // Animate back to 0% width
    }, 3000); // Adjust the duration of the animation as needed
}



function showErrorPopup(message) {
    // Create a new div element for the pop-up
    const popup = document.createElement('div');
    popup.className = 'error-popup';

    // Create a container for the content
    const popupContent = document.createElement('div');
    popupContent.className = 'popup-content';

    // Add the error icon
    const errorIcon = document.createElement('i');
    errorIcon.className = 'fas fa-times-circle';
    errorIcon.style.color = '#ff6347';
    errorIcon.style.fontSize = '24px';
    errorIcon.style.marginRight = '10px';

    // Add the message text
    const messageText = document.createElement('span');
    messageText.textContent = message;

    // Append the error icon and message text to the content container
    popupContent.appendChild(errorIcon);
    popupContent.appendChild(messageText);

    // Append the content container to the pop-up
    popup.appendChild(popupContent);

    // Add styles for the pop-up
    popup.style.position = 'fixed';
    popup.style.top = '10%';
    popup.style.left = '50%';
    popup.style.transform = 'translateX(-50%)';
    popup.style.padding = '20px';
    popup.style.backgroundColor = '#fff';
    popup.style.color = '#333';
    popup.style.borderRadius = '5px';
    popup.style.boxShadow = '0 0 10px rgba(0, 0, 0, 0.3)';
    popup.style.zIndex = '9999';
    popup.style.display = 'flex';
    popup.style.alignItems = 'center';
    popup.style.justifyContent = 'center';

    // Add the pop-up to the document body
    document.body.appendChild(popup);

    // Remove the pop-up after 3 seconds
    setTimeout(function() {
        popup.remove();
    }, 3000);
}

document.getElementById('settings-link').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default link behavior
    // Load or display the settings page/section
    window.location.href = 'settings.php';
});

const helpLink = document.getElementById('help-link');
const helpCard = document.querySelector('.help-card');

helpLink.addEventListener('click', function(event) {
  event.preventDefault(); // Prevent the default link behavior
  helpCard.style.display = helpCard.style.display === 'none' ? 'block' : 'none';
});

// Hide the help card when clicking outside of it
document.addEventListener('click', function(event) {
  if (!helpLink.contains(event.target) && !helpCard.contains(event.target)) {
    helpCard.style.display = 'none';
  }
});



</script>
</body>
</html>
