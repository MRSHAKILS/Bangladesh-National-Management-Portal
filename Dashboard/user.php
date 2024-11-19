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
