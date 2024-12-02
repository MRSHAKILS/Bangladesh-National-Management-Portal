<?php
// Include the database connection file
require_once 'db.php'; // Adjust this path if needed
?>

try {
    // Fetch the necessary fields from the review table
    $query = "
        SELECT 
            r.Review, 
            r.DateSubmitted, 
            s.ServiceName
        FROM review r
        LEFT JOIN services s ON r.ServiceID = s.ServiceID
        ORDER BY r.DateSubmitted DESC
    ";
    $result = $conn->query($query);

    echo "<h1>Service Reviews</h1>";

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>
                <th>Service Name</th>
                <th>Review</th>
                <th>Date Submitted</th>
              </tr>";

        // Loop through and display each review
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['ServiceName']}</td>
                    <td>{$row['Review']}</td>
                    <td>{$row['DateSubmitted']}</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No reviews found.</p>";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Reviews</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #444;
            margin-bottom: 20px;
        }
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: #fff;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        td {
            vertical-align: top;
        }
        p {
            text-align: center;
            font-size: 18px;
            color: #666;
        }
    </style>
</head>
<body>


</body>
</html>
