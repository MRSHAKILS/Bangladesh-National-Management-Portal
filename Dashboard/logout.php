<?php

require_once('includes/db.php');

if(isset($_SESSION['user_id'])) {
    session_unset();
    header('Location: ./user_login.php');
} else if(isset($_SESSION['official_id'])) {
    session_unset();
    header('Location: ./official_login.php');
} else {
    header('Location: ./dashboard.php');
}

?>