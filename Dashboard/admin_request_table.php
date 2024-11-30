<?php

require_once('includes/db.php');

if(!isset($_SESSION['admin_username'])) {
    header('Location: admin_login.php');
}

$mysqli = connect();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if(isset($_POST['request_admin_approve'])) {
        $requestID = $_POST['request_admin_approve'];
        $sql = "UPDATE serviceRequest SET RequestStatus = 'Approved' WHERE RequestID = $requestID";
        $mysqli->query($sql);
    }
}


$sql = "SELECT * FROM serviceRequest sr JOIN services s ON sr.ServiceID = s.ServiceID JOIN department d ON s.DepartmentID = d.DepartmentID WHERE RequestStatus <> 'Approved'";
$service_requests = $mysqli->query($sql);

    // searchbar

    $search_query = isset($_GET['search_query']) ? $mysqli->real_escape_string($_GET['search_query']) : '';

    // Base SQL query
    $sql = "SELECT * FROM serviceRequest sr 
            JOIN services s ON sr.ServiceID = s.ServiceID 
            JOIN department d ON s.DepartmentID = d.DepartmentID 
            WHERE RequestStatus <> 'Approved'";

    // Modify the query if a search term is provided
    if (!empty($search_query)) {
        $sql .= " AND (s.ServiceType LIKE '%$search_query%' OR 
                    d.DepartmentName LIKE '%$search_query%' OR 
                    sr.CitizenID LIKE '%$search_query%' OR
                    sr.RequestID LIKE '%$search_query%')";
    }

    $service_requests = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Service Request Dashboard</title>
    <style>
        /* Reset and general styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f4;
            color: #333;
            
        }
        /* main container */
        .container {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 1.5rem;
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        h2 {
            text-align: center;
        }

        .search_container {
            background: linear-gradient(135deg, #000000, #1c1c1c, #333333); /* Black gradient */
            display: flex;
            flex-direction: row;
            align-items: center; /* Vertically aligns content */
            justify-content: space-between; /* Positions the items at opposite ends */
            gap: 1rem;
            padding: 1rem 2rem; /* Adds some inner spacing */
            border-radius: 0; /* Smooth corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
            color: #ffffff; /* White text color for readability */
            margin-bottom: 1.5rem; /* Space below the container */
        }

        .search_container h1 {
            font-size: 1.8rem;
            font-weight: bold;
            margin: 0;
        }

        .search-bar {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .search-bar input {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            outline: none;
            font-size: 1rem;
            color: #333;
            width: 250px;
        }

        .search-bar button {
            background: #EE222A; /* Accent color for the button */
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .search-bar button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.2);
        }

        .search-bar button i {
            margin-left: 0.5rem;
            font-size: 1rem;
        }
        

        /* Table styles */
        .admin-service-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .admin-service-table th, .admin-service-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .admin-service-table th {
            background-color: #1e6e1e;
            color: #ffffff;
        }

        .admin-service-table tbody tr:hover {
            background-color: #f0f0f0;
        }


        /* Approve button styles */
        
        .Approve_btn {
            background: #EE222A;
            font-family: inherit;
            padding: 0.2em .5em;
            font-weight: 900;
            font-size: 18px;
            border: 3px solid black;
            border-radius: 0.4em;
            box-shadow: 0.1em 0.1em;
            cursor: pointer;
            }

        .Approve_btn:hover {
            transform: translate(-0.05em, -0.05em);
            box-shadow: 0.15em 0.15em;
        }

        .Approve_btn:active {
            transform: translate(0.05em, 0.05em);
            box-shadow: 0.05em 0.05em;
        }



        

        /* Responsive styles */
        @media (max-width: 768px) {
            .admin-service-table, .admin-service-table th, .admin-service-table td {
                font-size: 0.9rem;
            }
            .admin-service-table tbody tr {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                padding: 1rem;
                border-bottom: 1px solid #ddd;
            }
            .Approve-btn-container {
                justify-content: center; /* Center the button on smaller screens */
            }
        }
        </style>
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <?php require_once('includes/navbar.php'); ?>
    </header>
    
    <!-- Searchbar Section -->
    <div class="search_container">
        <h1>Admin Dashboard</h1>
        <form method="GET">
            <div class="search-bar">
                <input type="text" name="search_query" placeholder="Search services..." value="<?php echo isset($_GET['search_query']) ? htmlspecialchars($_GET['search_query']) : ''; ?>">
                <button type="submit"><i class="fas fa-search"></i> Search</button>
            </div>
        </form>
    </div>

    <!-- Main Content Section -->
    <div class="container">
        <form method="post">            
            <table class="admin-service-table">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Request Type</th>
                        <th>Department</th>
                        <th>Citizen ID</th>
                        <th>Request Status</th>
                        <th>Confirm</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($service_requests) {
                        while ($service_request = $service_requests->fetch_assoc()) {
                            echo "
                                <tr>
                                    <td>" . $service_request['RequestID'] . "</td>
                                    <td>" . $service_request['ServiceType'] . "</td>
                                    <td>" . $service_request['DepartmentName'] . "</td>
                                    <td>" . $service_request['CitizenID'] . "</td>
                                    <td>" . $service_request['RequestStatus'] . "</td>
                                    <td>
                                        <div class='Approve-btn-container'>
                                            <button type='submit' name='request_admin_approve' value=".$service_request['RequestID']." class='Approve_btn'>Approve</button>
                                        </div>
                                    </td>
                                <tr>";
                                   
                        }
                    }
                    ?> 
            
                        
                    
                    <!-- Add more rows dynamically as needed -->
                </tbody>
            </table>
        </form>

        
    </div>

</body>
</html>
