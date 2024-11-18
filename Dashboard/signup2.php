<?php
// Start the session
session_start();

// Database connection details
$servername = "localhost"; // Change to your database server if needed
$username = "root";        // Your database username
$password = "";            // Your database password
$dbname = "bmnp";          // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize success and error message variables
$successMessage = "";
$errorMessage = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input to prevent SQL injection
    $fullName = mysqli_real_escape_string($conn, $_POST['full_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if the email or username already exists in the database
    $emailCheckQuery = "SELECT * FROM Users WHERE Email = '$email'";
    $usernameCheckQuery = "SELECT * FROM Users WHERE Username = '$username'";

    $emailResult = $conn->query($emailCheckQuery);
    $usernameResult = $conn->query($usernameCheckQuery);

    // If email already exists
    if ($emailResult->num_rows > 0) {
        $errorMessage = "The email address is already taken. Please choose a different email.";
    }
    // If username already exists
    elseif ($usernameResult->num_rows > 0) {
        $errorMessage = "The username is already taken. Please choose a different username.";
    } else {
        // Insert query to insert the user data into the database (without UserID)
        $sql = "INSERT INTO Users (FullName, Username, Password, Email) 
                VALUES ('$fullName', '$username', '$password', '$email')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            // Set success message
            $successMessage = "Sign Up Successful! You can now <a href='login.php'>Login</a>.";
        } else {
            // Error handling for other issues
            $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        /* Add your styling here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 400px;
            padding: 30px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
        }

        input[type="text"], input[type="password"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            text-align: center;
        }

        .success {
            color: green;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Sign Up</h2>

    <?php
    // Display error message if there's an error
    if (!empty($errorMessage)) {
        echo "<p class='error'>$errorMessage</p>";
    }

    // Display success message if sign up was successful
    if (!empty($successMessage)) {
        echo "<p class='success'>$successMessage</p>";
    }
    ?>

    <!-- Sign Up Form -->
    <form method="POST" action="signup.php">
        <input type="text" name="full_name" placeholder="Full Name" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Sign Up">
    </form>
</div>

</body>
</html>