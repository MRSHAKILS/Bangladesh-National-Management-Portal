<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Service Request Dashboard</title>
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


        /* Table styles */
        .service-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .service-table th, .service-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .service-table th {
            background-color: #1e6e1e;
            color: #ffffff;
        }

        .service-table tbody tr:hover {
            background-color: #f0f0f0;
        }

        /* Checkbox styles */
        .status-checkboxes {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .navbar ul {
                display: none;
            }
            .hamburger {
                display: flex;
                cursor: pointer;
            }
            .service-table, .service-table th, .service-table td {
                font-size: 0.9rem;
            }
            .service-table tbody tr {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                padding: 1rem;
                border-bottom: 1px solid #ddd;
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
        <h2>Official Dashboard</h2>
        <table class="service-table">
            <thead>
                <tr>
                    <th>Request ID</th>
                    <th>Request Type</th>
                    <th>User ID</th>
                    <th>Approve</th>
                    <th>Deny</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example rows for demonstration -->
                <tr>
                    <td>001</td>
                    <td>Passport Renewal</td>
                    <td>U12345</td>
                    <td><input type="checkbox" name="completed"></td>
                    <td><input type="checkbox" name="not-completed"></td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>Driving License</td>
                    <td>U23456</td>
                    <td><input type="checkbox" name="completed"></td>
                    <td><input type="checkbox" name="not-completed"></td>
                </tr>
                <tr>
                    <td>003</td>
                    <td>Citizenship Verification</td>
                    <td>U34567</td>
                    <td><input type="checkbox" name="completed" checked></td>
                    <td><input type="checkbox" name="not-completed"></td>
                </tr>
                <!-- Add more rows dynamically as needed -->
            </tbody>
        </table>
    </div>

</body>
</html>
