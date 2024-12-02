<?php
// Include the database connection file
require_once 'db.php'; // Adjust this path as needed

try {
    // Fetch all reviews from the database
    $query = "
        SELECT 
            r.ReviewID, 
            r.RequestID, 
            r.CitizenID, 
            r.ServiceID, 
            r.Review, 
            r.DateSubmitted, 
            s.ServiceName, 
            c.FullName AS CitizenName
        FROM review r
        LEFT JOIN services s ON r.ServiceID = s.ServiceID
        LEFT JOIN users c ON r.CitizenID = c.UserID
        ORDER BY r.DateSubmitted DESC
    ";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<h1>All Reviews</h1>";
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr>
                <th>Review ID</th>
                <th>Request ID</th>
                <th>Citizen Name</th>
                <th>Service Name</th>
                <th>Review</th>
                <th>Date Submitted</th>
              </tr>";

        // Loop through and display each review
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['ReviewID']}</td>
                    <td>{$row['RequestID']}</td>
                    <td>{$row['CitizenName']}</td>
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
