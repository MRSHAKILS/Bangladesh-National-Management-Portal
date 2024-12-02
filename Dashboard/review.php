<?php
    require_once 'includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .review {
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        .review:last-child {
            border-bottom: none;
        }
        .review-date {
            font-size: 0.9em;
            color: gray;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Reviews</h1>
        <?php
        // Fetch all reviews from the review table
        $query = "SELECT r.ReviewID, r.Review, r.DateSubmitted, c.CitizenID, s.ServiceID, sr.RequestID 
                  FROM review r
                  JOIN citizen c ON r.CitizenID = c.CitizenID
                  JOIN services s ON r.ServiceID = s.ServiceID
                  JOIN servicerequest sr ON r.RequestID = sr.RequestID
                  ORDER BY r.DateSubmitted DESC";

        $result = $conn->query($query);

        // Check if there are reviews
        if ($result->num_rows > 0) {
            // Output each review
            while ($row = $result->fetch_assoc()) {
                echo "<div class='review'>";
                echo "<p><strong>Review ID:</strong> " . $row['ReviewID'] . "</p>";
                echo "<p><strong>Citizen ID:</strong> " . $row['CitizenID'] . "</p>";
                echo "<p><strong>Service ID:</strong> " . $row['ServiceID'] . "</p>";
                echo "<p><strong>Request ID:</strong> " . $row['RequestID'] . "</p>";
                echo "<p>" . htmlspecialchars($row['Review']) . "</p>";
                echo "<p class='review-date'><strong>Date Submitted:</strong> " . $row['DateSubmitted'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No reviews found.</p>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
