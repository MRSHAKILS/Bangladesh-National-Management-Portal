<?php

require_once('includes/db.php');

// Start the session
session_start();

// Check and handle logout logic
if (isset($_SESSION['user_id'])) {
    session_destroy(); // Destroy the session
    header('Location: ./user_login.php');
    exit(); // Ensure script execution stops
} else if (isset($_SESSION['official_id'])) {
    session_destroy();
    header('Location: ./official_login.php');
    exit();
} else if (isset($_SESSION['admin_username'])) {
    session_destroy();
    header('Location: ./admin_login.php');
    exit();
} else {
    header('Location: ./dashboard.php');
    exit();
}
?>
