<?php
// Start the session
session_start();

// Database connection details
$servername = "localhost"; // Change to your database server if needed
$username = "root";        // Your database username
$password = "";            // Your database password
$dbname = "bdportal";          // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input to prevent SQL injection
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check user credentials
    $sql = "SELECT * FROM Users WHERE Username = '$user' AND Password = '$pass'";
    $result = $conn->query($sql);

    // Check if the user exists
    if ($result->num_rows > 0) {
        // User exists, set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user;
        header("Location: welcome.php"); // Redirect to a welcome page
    } else {
        $error = "Invalid username or password.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            padding-top: 50px;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            text-align: center;
        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
        }

        .signup-link a {
            text-decoration: none;
            color: #4CAF50;
            font-size: 16px;
        }

        .signup-link a:hover {
            color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h2>Login</h2>

        <?php
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>

        <!-- Login form -->
        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>

        <!-- Signup Link -->
        <div class="signup-link">
            <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
        </div>
    </div>
</div>

</body>
</html>