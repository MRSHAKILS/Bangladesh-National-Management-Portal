<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <style>
        /* General styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f4;
            color: #333;
            padding: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
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
        .rbutton {
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

        .rbutton::before {
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

       .rbutton:hover::before {
            scale: 3;
        }

        .rbutton:hover {
            color: #212121;
            scale: 1.1;
            box-shadow: 0 0px 20px rgba(193, 163, 98,0.4);
        }

        .rbutton:active {
            scale: 1;
        }



    </style>
</head>
<body>
    <!-- User Information Section -->
    <div class="container">
        <div class="user-info">
            <h1>User Information</h1>
            <p><span>User ID:</span> 1</p>
            <p><span>Full Name:</span> John Doe</p>
            <p><span>Username:</span> john.doe</p>
            <p><span>Email:</span> john.doe@example.com</p>
            <p><span>User Role:</span> Citizen</p>
            <p><span>Notification Preferences:</span> Email, SMS</p>
            <p><span>Registration Date:</span> 2024-11-01</p>
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
                <tr>
                    <td>001</td>
                    <td>Passport Renewal</td>
                    <td>Immigration</td>
                    <td>In Progress</td>
                    <td><button class="rbutton">Review</button></td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>Driving License</td>
                    <td>Transport</td>
                    <td>Pending</td>
                    <td><button class="rbutton">Review</button></td>
                </tr>
                <tr>
                    <td>003</td>
                    <td>Citizenship Verification</td>
                    <td>Public Info</td>
                    <td>Completed</td>
                    <td><button class="rbutton">Review</button></td>
                </tr>
                <!-- Add more rows dynamically as needed -->
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
    <div class="modal" id="serviceModal">
        <div class="modal-content">
            <h2>Service Request</h2>
            <p id="modalMessage"></p>
            <button id="confirmButton">Confirm</button>
            <button id="cancelButton">Cancel</button>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal" id="confirmationModal">
        <div class="modal-content">
            <h2>Request Successful</h2>
            <p id="confirmationMessage"></p>
            <button onclick="closeModal('confirmationModal')">OK</button>
        </div>
    </div>


    
    <script>
        let selectedService = '';
        
        function handleService(service) {
            selectedService = service;
            document.getElementById('modalMessage').innerText = `You have selected the ${service} service.`;
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
