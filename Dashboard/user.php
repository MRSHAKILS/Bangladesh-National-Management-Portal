<?php

require_once('includes/db.php');

$mysqli = connect();

// Service Request 
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['service_request'])) {
        $request_type = $_POST['service_request'];
        $user_id = $_SESSION['user_id'];

        if($request_type == 'Passport' || $request_type == 'Transport' || $request_type == 'Citizenship') {

            $sql = "SELECT UserID FROM users WHERE UserID = '$user_id'";
            $user_id = $mysqli->query($sql)->fetch_assoc()['UserID'];

            $sql = "SELECT ServiceID FROM services WHERE ServiceType = '$request_type'";
            $service_id = $mysqli->query($sql)->fetch_assoc()['ServiceID'];

            $sql = "SELECT CitizenID FROM citizen WHERE UserID = '$user_id'";
            $citizen_id = $mysqli->query($sql)->fetch_assoc()['CitizenID'];
            
            $sql = "INSERT INTO servicerequest (CitizenID, ServiceID) VALUES ('$citizen_id', '$service_id')";
            $mysqli->query($sql);
        } 
    } 
    else if(isset($_POST['save_user_info'])) {
        $user_id = $_SESSION['user_id'];
        $full_name = $mysqli->real_escape_string($_POST['full_name']);
        $email = $mysqli->real_escape_string($_POST['email']);
        $username = $mysqli->real_escape_string($_POST['username']);
        $phone_number = $mysqli->real_escape_string($_POST['ContactInfo']);
        $address = $mysqli->real_escape_string($_POST['addressPresent']);
        $country = $mysqli->real_escape_string($_POST['Nationality']);
        
    
        // Start a transaction
        $mysqli->begin_transaction();

        try {
            // Update the users table
            $update_users_sql = "
                UPDATE users 
                SET Email = '$email', Username = '$username' 
                WHERE UserID = $user_id
            ";
            if (!$mysqli->query($update_users_sql)) {
                throw new Exception("Error updating users table: " . $mysqli->error);
            }
    
            // Update the citizen table
            $update_citizen_sql = "
                UPDATE citizen 
                SET FullName = '$full_name', ContactInfo = '$phone_number', addressPresent = '$address', Nationality = '$country' 
                WHERE UserID = $user_id
            ";
            if (!$mysqli->query($update_citizen_sql)) {
                throw new Exception("Error updating citizen table: " . $mysqli->error);
            }
    
            // Commit the transaction
            $mysqli->commit();
        } catch (Exception $e) {
            // Rollback the transaction on error
            $mysqli->rollback();
            echo "<script>alert('Error updating user information: " . $e->getMessage() . "');</script>";
        }
    }
    else if(isset($_POST['submit_review'])) {
        $request_id = $_POST['request_id'];
        $review = $_POST['review'];

        $sql = "SELECT * FROM servicerequest WHERE RequestID = $request_id";
        $service_request = $mysqli->query($sql)->fetch_assoc();

        $sql = "INSERT INTO review (RequestID, CitizenID, ServiceID, Review) VALUES (".$service_request['RequestID'].", ".$service_request['CitizenID'].", ".$service_request['ServiceID'].", '$review')";

        $mysqli->query($sql);
    }
} 

//On page load
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users u JOIN Citizen c ON u.UserID = c.UserID WHERE u.UserID = '$user_id'";
$response = $mysqli->query($sql);

$user_details = $response->fetch_assoc();

if(!isset($user_details['type'])) {
    header('Location: user_signup_modal.php');
}

$sql = "SELECT CitizenID FROM citizen WHERE UserID = ". $_SESSION['user_id'];
$citizen_id = $mysqli->query($sql)->fetch_assoc()['CitizenID'];

$sql = "SELECT sr.RequestID, sr.CitizenID, sr.ServiceID, sr.RequestStatus, s.ServiceType, d.DepartmentName, r.Review FROM serviceRequest sr JOIN services s ON sr.ServiceID = s.ServiceID JOIN department d ON s.DepartmentID = d.DepartmentID LEFT JOIN review r ON r.RequestID = sr.RequestID WHERE sr.CitizenID = $citizen_id ORDER BY sr.RequestID";
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

        .close-btn {
            float: right;
            cursor: pointer;
            font-size: 20px;
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
                <p><span>User Type:</span> <?php echo @$user_details['type'] ?></p>
                <p><span>Phone Number:</span> <?php echo @$user_details['ContactInfo'] ?></p>
                <p><span>Address:</span> <?php echo @$user_details['addressPresent'] ?></p>
                <p><span>Nationality:</span> <?php echo @$user_details['Nationality'] ?></p>
                <p><span>Notification Preferences:</span> Email, SMS</p>
                <p><span>Registration Date:</span> <?php echo @$user_details['date_registered'] ?></p>
                <button onclick="openModal('editUserModal')">Edit</button>

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
                                    <td>". ($service_request['Review'] == NULL ? "<button class='review-btn' data-request-id=". $service_request['RequestID'] .">Review</button>" : "")."</td>
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

        <!-- Edit User Info Modal -->
        <div class="modal" id="editUserModal" style="display: none;">
            <div class="modal-content">
                <h2>Edit User Information</h2>
                <form id="editUserForm" method="post">
                    <input type="hidden" name="user_id" value="<?php echo @$user_details['UserID']; ?>">
                    <p>
                        <label for="editUsername">Username:</label>
                        <input type="text" id="editUsername" name="username" value="<?php echo @$user_details['Username']; ?>">
                    </p>
                    <p>
                        <label for="editFullName">Full Name:</label>
                        <input type="text" id="editFullName" name="full_name" value="<?php echo @$user_details['FullName']; ?>">
                    </p>
                    <p>
                        <label for="editEmail">Email:</label>
                        <input type="email" id="editEmail" name="email" value="<?php echo @$user_details['Email']; ?>">
                    </p>
                    <p>
                        <label for="editPhoneNumber">Phone Number:</label>
                        <input type="text" id="editPhoneNumber" name="ContactInfo" value="<?php echo @$user_details['ContactInfo']; ?>">
                    </p>
                    <p>
                        <label for="editAddress">Address:</label>
                        <input type="text" id="editAddress" name="addressPresent" value="<?php echo @$user_details['addressPresent']; ?>">
                    </p>
                    
                    <p>
                        <label for="editCountry">Country:</label>
                        <input type="text" id="editCountry" name="Nationality" value="<?php echo @$user_details['Nationality']; ?>">    
                    </p>
                    
                    
                    <button type="submit" name="save_user_info">Update</button>
                    <button type="button" onclick="closeModal('editUserModal')">Cancel</button>
                </form>
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

    <!-- Modal -->
    <div id="reviewModal" class="modal">
        <div class="modal-content">
        <span class="close-btn">&times;</span>
        <form id="reviewForm" method="POST">
            <input type="hidden" name="request_id" id="request_id">
            <label for="review">Review:</label><br>
            <textarea name="review" id="review" rows="4" cols="50" required></textarea><br><br>
            <button type="submit" name="submit_review">Submit Review</button>
        </form>
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
            const modal = document.getElementById(modalId);
            console.log(`Opening modal: ${modalId}, current display: ${modal.style.display}`);
            modal.style.display = 'flex';
            
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
            document.querySelector('button[onclick="openModal(\'editUserModal\')"]').addEventListener('click', () => {
            openModal('editUserModal');
            });

            // <form id="editUserForm" method="post" onsubmit="return validateForm()">

            function validateForm() {
                const fullName = document.getElementById('editFullName').value.trim();
                const email = document.getElementById('editEmail').value.trim();
                const username = document.getElementById('editUsername').value.trim();

                if (!fullName || !email || !username) {
                    alert('All fields are required!');
                    return false;
                }
                return true;
            }


            // Modal functionality
            const modal = document.getElementById("reviewModal");
            const closeBtn = document.querySelector(".close-btn");
            const reviewForm = document.getElementById("reviewForm");

            // Open modal when "Review" button is clicked
            document.querySelectorAll(".review-btn").forEach(button => {
            button.addEventListener("click", function () {
                const requestId = this.getAttribute("data-request-id");

                // Populate hidden fields
                document.getElementById("request_id").value = requestId;

                modal.style.display = "flex";
            });
            });

            // Close modal
            closeBtn.addEventListener("click", () => {
            modal.style.display = "none";
            });

            window.addEventListener("click", event => {
            if (event.target === modal) {
                modal.style.display = "none";
            }
            });

        </script>
</body>
</html>
