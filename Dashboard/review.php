<?php
// Include the database connection file
require_once 'db.php'; // Adjust this path if needed

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
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
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
