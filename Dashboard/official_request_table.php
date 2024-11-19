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

        h2 {
            text-align: center;
        }

        /* Table styles */
        .service-table {
            width: 100%;
            border-collapse: collapse;
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

        /* Submit button styles */
        .btn {
            font-size: 17px;
            background: transparent;
            border: none;
            padding: 1em 1.5em;
            color: #ffedd3;
            text-transform: uppercase;
            position: relative;
            transition: 0.5s ease;
            cursor: pointer;
        }

        .btn::before {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            height: 2px;
            width: 0;
            background-color: #ffc506;
            transition: 0.5s ease;
        }

        .btn:hover {
            color: #1e1e2b;
            transition-delay: 0.5s;
        }

        .btn:hover::before {
            width: 100%;
        }

        .btn::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            height: 0;
            width: 100%;
            background-color: #ffc506;
            transition: 0.4s ease;
            z-index: -1;
        }

        .btn:hover::after {
            height: 100%;
            transition-delay: 0.4s;
            color: aliceblue;
        }


        /* Responsive styles */
        @media (max-width: 768px) {
            .service-table, .service-table th, .service-table td {
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

    <!-- Main Content Section -->
    <div class="container">
        <h2>Official Dashboard</h2>
        <table class="service-table">
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
                <tr>
                    <td>001</td>
                    <td>Passport Renewal</td>
                    <td>Immigration</td>
                    <td>U12345</td>
                    <td><input type="checkbox" name="Approved"></td>
                    <td><input type="checkbox" name="not-Approved"></td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>Driving License</td>
                    <td>Transport</td>
                    <td>U23456</td>
                    <td><input type="checkbox" name="Approved"></td>
                    <td><input type="checkbox" name="not-Approved"></td>
                </tr>
                <tr>
                    <td>003</td>
                    <td>Citizenship Verification</td>
                    <td>Public Info</td>
                    <td>U34567</td>
                    <td><input type="checkbox" name="Approved" checked></td>
                    <td><input type="checkbox" name="not-Approved"></td>
                </tr>
                <!-- Add more rows dynamically as needed -->
            </tbody>
        </table>

        <!-- Submit Button -->
        <div class="submit-btn-container">
            <button class="btn">Hover me</button>
        </div>
    </div>
</body>
</html>
