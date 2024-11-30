<?php

require_once('includes/db.php');

$mysqli = connect();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs
    $user = htmlspecialchars($_POST['username']);
    $pass = htmlspecialchars($_POST['password']);

    $response = $mysqli->query("SELECT * FROM admin WHERE Username = '$user' AND Password = '$pass'");
    $result = $response->fetch_assoc();

    // Check if the user exists
    if ($response->num_rows > 0) {
        // User exists, set session variables
        $_SESSION['admin_username'] = $user;
        header("Location: admin_request_table.php"); // Redirect to user dashboard
        exit;
    } else {
        $error = "Invalid username or password.";
    }

    $mysqli->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #43cea2, #185a9d);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
            padding: 0 1rem;
        }

        .container {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #43cea2;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #43cea2;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        input[type="submit"]:hover {
            background-color: #185a9d;
            transform: translateY(-2px);
        }

        .error {
            color: #d9534f; /* Red for error messages */
            margin-bottom: 15px;
        }

        .signup-link {
            margin-top: 20px;
            font-size: 14px;
        }

        .signup-link a {
            text-decoration: none;
            color: #185a9d;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .signup-link a:hover {
            color: #43cea2;
        }

        @media (max-width: 480px) {
            h2 {
                font-size: 20px;
            }

            input[type="text"], input[type="password"], input[type="submit"] {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Admin Sign in</h2>

    <!-- Display error message -->
    <?php if (isset($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <!-- Login form -->
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
    </form>

    <!-- Signup Link -->
    <div class="signup-link">
        <p>Sign in as an Official <a href="official_login.php"> here</a></p>
    </div>
</div>

</body>
</html>
