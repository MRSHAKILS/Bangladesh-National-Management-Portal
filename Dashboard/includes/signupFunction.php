<?php
require_once('db.php');

function signup($username, $email, $password, $c_password) {
    $mysqli = connect();
    
    if($password != $c_password) {
        return "please enter password again";
    }

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($mysqli->query($sql) === TRUE) { 
        header('location: login.php');
        return "success"; 
    } else { 
        return "Error: " . $conn->error; 
    } 

}


?>