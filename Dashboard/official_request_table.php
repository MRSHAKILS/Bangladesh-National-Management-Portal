<?php

require_once('includes/db.php');

if(!isset($_SESSION['official_id'])) {
    header('Location: official_login.php');
}

$mysqli = connect();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the relevant POST data exists
    if (isset($_POST['Approved']) || isset($_POST['not-Approved'])) {

        $sql = "";
        
        // Loop through the Approved checkboxes
        if (isset($_POST['Approved'])) {
            foreach ($_POST['Approved'] as $requestID => $approved) {

                $sql .= "UPDATE servicerequest SET RequestStatus = 'Pending Approval' WHERE RequestID = $requestID;";
            }
        }

        // Loop through the NotApproved checkboxes
        if (isset($_POST['not-Approved'])) {
            foreach ($_POST['not-Approved'] as $requestID => $notApproved) {

                $sql .= "UPDATE servicerequest SET RequestStatus = 'Pending' WHERE RequestID = $requestID;";
            }
        }

        // Execute all the queries at once using multi_query
        if ($mysqli->multi_query($sql)) {
            // Loop through the results to fetch all responses from the queries
            do {
                // // Store the first result set
                // if ($result = $mysqli->store_result()) {
                //     while ($row = $result->fetch_row()) {
                //         // Process the result if necessary
                //     }
                //     $result->free();
                // }
            } while ($mysqli->next_result()); // Check for further results
        } else {
            // Error in executing the queries
            echo "Error: " . $mysqli->error;
        }
    }
}


$sql = "SELECT * FROM serviceRequest sr JOIN services s ON sr.ServiceID = s.ServiceID";
$service_requests = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Service Request Dashboard</title>
    <style>
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

        /* Main container styles */
        .container {
            display: flex;
            flex-direction: column; /* Stack elements vertically */
            align-items: stretch; /* Stretch elements to fill the width */
            gap: 1.5rem; /* Add spacing between elements */
            max-width: 1200px;
            margin: 2rem auto; /* Center container with top margin */
            padding: 0 1rem; /* Add horizontal padding */
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
            background: #ffc506; /* Accent color for the button */
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


        h2 {
            text-align: center;
        }

        /* Table styles */
        .official-service-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .official-service-table th, .official-service-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .official-service-table th {
            background-color: #1e6e1e;
            color: #ffffff;
        }

        .official-service-table tbody tr:hover {
            background-color: #f0f0f0;
        }

        /* Submit button styles */
        .submit-btn-container {
            display: flex;
            justify-content: flex-end; 
            margin-top: 1rem;
        }
        .submit_btn {
            background: #ffc506;
            font-family: inherit;
            padding: 0.6em 1.3em;
            font-weight: 900;
            font-size: 18px;
            border: 3px solid black;
            border-radius: 0.4em;
            box-shadow: 0.1em 0.1em;
            cursor: pointer;
        }

        
        .submit_btn:hover {
            transform: translate(-0.05em, -0.05em);
            box-shadow: 0.15em 0.15em;
        }

        .submit_btn:active {
            transform: translate(0.05em, 0.05em);
            box-shadow: 0.05em 0.05em;
        }


        /* Responsive styles */
        @media (max-width: 768px) {
            .official-service-table, .official-service-table th, .official-service-table td {
                font-size: 0.9rem;
            }

            .submit-btn-container {
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

    <div class="search_container">
        <h1>Official Dashboard</h1>
            <div class="search-bar">
                <input type="text" placeholder="Search services...">
                <button><i class="fas fa-search"></i> Search</button>
            </div>
    </div>

    <!-- Main Content Section -->
    <div class="container">
        <form method="post">
            <table class="official-service-table">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Request Type</th>
                        <th>Department</th>
                        <th>User ID</th>
                        <th>Approve</th>
                        <th>Deny</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    if(isset($service_requests)) {
                        while($service_request = $service_requests->fetch_assoc()) {
                            echo "
                                <tr>
                                    <td>". $service_request['RequestID'] ."</td>
                                    <td>". $service_request['ServiceType'] ."</td>
                                    <td>Under Construction</td>
                                    <td>". $service_request['CitizenID'] ."</td>
                                    <td><input type='checkbox' name='Approved[" . $service_request['RequestID'] . "]' ". ($service_request['RequestStatus'] == 'Pending Approval' ? 'checked' : '')."></td>
                                    <td><input type='checkbox' name='not-Approved[" . $service_request['RequestID'] . "]' ". ($service_request['RequestStatus'] == 'Pending' ? 'checked' : '')."></td>
                                </tr>
                            ";
                        }
                    }
    
                    ?>
                    <!-- Add more rows dynamically as needed -->
                </tbody>
            </table>
    
            <!-- Submit Button -->
            <div class="submit-btn-container">
                <button type="submit" name="official_request" class="submit_btn">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
