<?php
require_once('db.php');

function signup($username, $email, $password, $c_password) {
    $mysqli = connect();
    
    if($password != $c_password) {
        return "please enter same password";
    }

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($mysqli->query($sql) === TRUE) { 
        header('location: user_login.php');
        return "success"; 
    } else { 
        return "Error: " . $conn->error; 
    } 

}


?>