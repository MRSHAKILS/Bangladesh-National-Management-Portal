<?php
require_once('includes/user_signupFunction.php');
if (isset($_POST['signup'])) {
    $response = signup($_POST['username'], $_POST['email'], $_POST['password'], $_POST['c_password']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
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
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 0 1rem;
        }

        .signup-container {
            background: #ffffff;
            padding: 30px 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .signup-container h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .signup-container input {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .signup-container input:focus {
            border-color: #43cea2;
        }

        .signup-container button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background: #43cea2;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .signup-container button:hover {
            background: #185a9d;
            transform: translateY(-2px);
        }

        .signup-container .response {
            margin-top: 10px;
            color: #d9534f; /* Red for errors */
        }

        .signup-container .success {
            color: #5cb85c; /* Green for success */
        }

        .user-login-link {
            margin-top: 15px;
            font-size: 14px;
        }

        .user-login-link a {
            text-decoration: none;
            color: #185a9d;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .user-login-link a:hover {
            color: #43cea2;
        }

        @media (max-width: 480px) {
            .signup-container {
                padding: 20px;
            }

            .signup-container h2 {
                font-size: 20px;
            }

            .signup-container input,
            .signup-container button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="c_password" placeholder="Confirm Password" required>
            <p class="response <?php echo (@$response == 'success') ? 'success' : ''; ?>">
                <?php echo htmlspecialchars(@$response); ?>
            </p>
            <button type="submit" name="signup">Sign Up</button>
        </form>
        <div class="user-login-link">
            <p>Already have an account? <a href="user_login.php">Log in here</a></p>
        </div>
    </div>
</body>
</html>
