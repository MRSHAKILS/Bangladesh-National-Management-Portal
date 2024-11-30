<?php

require_once('includes/db.php');

$mysqli = connect();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['service_request'])) {
        $request_type = $_POST['service_request'];
        $username = $_SESSION['username'];

        if($request_type == 'Passport' || $request_type == 'Transport' || $request_type == 'Citizenship') {

            $sql = "SELECT UserID FROM users WHERE Username = '$username'";
            $user_id = $mysqli->query($sql)->fetch_assoc()['UserID'];

            $sql = "SELECT ServiceID FROM services WHERE ServiceType = '$request_type'";
            $service_id = $mysqli->query($sql)->fetch_assoc()['ServiceID'];

            $sql = "SELECT CitizenID FROM citizen WHERE UserID = '$user_id'";
            $citizen_id = $mysqli->query($sql)->fetch_assoc()['CitizenID'];
            
            $sql = "INSERT INTO servicerequest (CitizenID, ServiceID) VALUES ('$citizen_id', '$service_id')";
            $mysqli->query($sql);
        } 
    }
} 

$user_username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE Username = '$user_username'";
$response = $mysqli->query($sql);

$user_details = $response->fetch_assoc();

if(!isset($user_details['type'])) {
    header('Location: user_signup_modal.php');
}

$sql = "SELECT CitizenID FROM citizen WHERE UserID = ". $_SESSION['user_id'];
$citizen_id = $mysqli->query($sql)->fetch_assoc()['CitizenID'];

$sql = "SELECT * FROM serviceRequest sr JOIN services s ON sr.ServiceID = s.ServiceID JOIN department d ON s.DepartmentID = d.DepartmentID WHERE sr.CitizenID = $citizen_id";
$service_requests = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
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
        .section{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 1rem;
            margin: 1rem;
        }
        .container {
            display: flex;
            flex-direction: row;
            align-items: stretch;
            gap: 1.5rem;
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .user-info, .request-service {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            text-align: center;
            margin-bottom: 1rem;
        }

        .user-info h1, .request-service h2 {
            margin-bottom: 1rem;
            color: #1e6e1e;
        }

        .user-info p {
            margin: 0.5rem 0;
            font-size: 1rem;
            line-height: 1.5;
        }

        .user-info span {
            font-weight: bold;
        }

        .buttons {
            margin-top: 1rem;
            display: flex;
            justify-content: space-around;
        }

        .buttons button {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            background-color: #1e6e1e;
            color: #ffffff;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .buttons button:hover {
            background-color: #145014;
        }

        /* Table styles */
        .user-request-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .user-request-table th, .user-request-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .user-request-table th {
            background-color: #1e6e1e;
            color: #ffffff;
        }

        .user-request-table tbody tr:hover {
            background-color: #f0f0f0;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            max-width: 400px;
            width: 90%;
            text-align: center;
        }

        .modal-content h2 {
            margin-bottom: 1rem;
            color: #333;
        }

        .modal-content p {
            margin-bottom: 1rem;
        }

        .modal-content button {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            background-color: #1e6e1e;
            color: #ffffff;
            font-size: 1rem;
            cursor: pointer;
            margin: 0.5rem;
        }

        .modal-content button:hover {
            background-color: #145014;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .user-request-table, .user-request-table th, .user-request-table td {
                font-size: 0.9rem;
            }
            .user-request-table tbody tr {
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

        /* Review Button */
        .review-btn {
            cursor: pointer;
            position: relative;
            padding: 10px 24px;
            font-size: 18px;
            color: rgb(193, 163, 98);
            border: 2px solid rgb(193, 163, 98);
            border-radius: 34px;
            background-color: transparent;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
            overflow: hidden;
        }

        .review-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            margin: auto;
            width: 50px;
            height: 50px;
            border-radius: inherit;
            scale: 0;
            z-index: -1;
            background-color: rgb(193, 163, 98);
            transition: all 0.6s cubic-bezier(0.23, 1, 0.320, 1);
        }

       .review-btn:hover::before {
            scale: 3;
        }

        .review-btn:hover {
            color: #212121;
            scale: 1.1;
            box-shadow: 0 0px 20px rgba(193, 163, 98,0.4);
        }

        .review-btn:active {
            scale: 1;
        }



    </style>
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <?php require_once('includes/navbar.php'); ?>
    </header>
     
    <!-- User Information Section -->
     <div class="section">
        <div class="container">
            <div class="user-info">
                <h1>User Information</h1>
                <p><span>User ID:</span> <?php echo @$user_details['UserID'] ?></p>
                <p><span>Full Name:</span> <?php echo @$user_details['FullName'] ?></p>
                <p><span>Username:</span> <?php echo @$user_details['Username'] ?></p>
                <p><span>Email:</span> <?php echo @$user_details['Email'] ?></p>
                <p><span>Notification Preferences:</span> Email, SMS</p>
                <p><span>Registration Date:</span> <?php echo @$user_details['date_registered'] ?></p>
            </div>

            <div class="reque-info">
            <table class="user-request-table">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Request Type</th>
                        <th>Department</th>
                        <th>Request Status</th>
                        <th>Leave a review</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example rows for demonstration -->
                    <?php

                    if(isset($service_requests)) {
                        while($service_request = $service_requests->fetch_assoc()) {
                            echo "
                                <tr>
                                    <td>". $service_request['RequestID'] ."</td>
                                    <td>". $service_request['ServiceType'] ."</td>
                                    <td>". $service_request['DepartmentName'] ."</td>
                                    <td>". $service_request['RequestStatus'] ."</td>
                                    <td><button class='review-btn'>Review</button></td>
                                </tr>
                            ";
                        }
                    }

                    ?>                
                </tbody>
            </table>
            </div>
        </div>

        <!-- Request Service Section -->
        <div class="request-service">
            <h2>Request Service</h2>
            <div class="buttons">
                <button onclick="handleService('Passport')">Passport</button>
                <button onclick="handleService('Transport')">Transport</button>
                <button onclick="handleService('Citizenship')">Citizenship</button>
            </div>
        </div>

        <!-- Service Modal -->
        <div class="modal" id="serviceModal" style="display: none;">
            <form method="post">
                <div class="modal-content">
                    <h2>Service Request</h2>
                    <p id="modalMessage"></p>
                    <button type="submit" id="confirmButton" name="service_request"  value="">Confirm</button>
                    <button type="button" id="cancelButton">Cancel</button>
                </div>
            </form>
        </div>

        <!-- Confirmation Modal -->
        <div class="modal" id="confirmationModal" style="display: none;">
            <div class="modal-content">
                <h2>Request Successful</h2>
                <p id="confirmationMessage"></p>
                <button onclick="closeModal('confirmationModal')">OK</button>
            </div>
        </div>
    </div>


    
    <script>
        let selectedService = '';
        
        function handleService(service) {
            selectedService = service;
            document.getElementById('modalMessage').innerText = `You have selected the ${service} service.`;
            document.getElementById('confirmButton').value = service;
            openModal('serviceModal');
        }
        
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'flex';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Confirm and Cancel logic
        document.getElementById('confirmButton').addEventListener('click', async () => {
            closeModal('serviceModal');

            // Simulating database interaction
            const requestId = await fetchRequestId(selectedService);
            
            // Update the confirmation modal with the request ID
            document.getElementById('confirmationMessage').innerText = 
            `You have requested the ${selectedService} service. Your request ID is "${requestId}".`;
            openModal('confirmationModal');
        });
        
        document.getElementById('cancelButton').addEventListener('click', () => {
            closeModal('serviceModal');
        });
        
        // Simulate fetching request ID from the database
        async function fetchRequestId(service) {
            // Simulated delay and dummy request ID
            return new Promise((resolve) => {
                setTimeout(() => {
                    resolve(Math.floor(Math.random() * 1000000)); // Generate a random request ID
                }, 1000);
            });
        }
        </script>
</body>
</html>
