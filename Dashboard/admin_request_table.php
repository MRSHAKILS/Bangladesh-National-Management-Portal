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
        .Approve-btn-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 1rem;
        }
        .Approve_btn {
            background: #EE222A;
            font-family: inherit;
            padding: 0.6em 1.3em;
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

    <!-- Main Content Section -->
    <div class="container">
        <h2>Admin Dashboard</h2>
        <table class="admin-service-table">
            <thead>
                <tr>
                    <th>Request ID</th>
                    <th>Request Type</th>
                    <th>Department</th>
                    <th>User ID</th>
                    <th>Request Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example rows for demonstration -->
                <tr>
                    <td>001</td>
                    <td>Passport Renewal</td>
                    <td>Immigration</td>
                    <td>U12345</td>
                    <td>In Progress</td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>Driving License</td>
                    <td>Transport</td>
                    <td>U23456</td>
                    <td>Pending</td>
                </tr>
                <tr>
                    <td>003</td>
                    <td>Citizenship Verification</td>
                    <td>Public Info</td>
                    <td>U34567</td>
                    <td>Completed</td>
                </tr>
                <!-- Add more rows dynamically as needed -->
            </tbody>
        </table>

        <!-- Approve Button -->
        <div class="Approve-btn-container">
            <button class="Approve_btn">Approve</button>
        </div>
    </div>

</body>
</html>
