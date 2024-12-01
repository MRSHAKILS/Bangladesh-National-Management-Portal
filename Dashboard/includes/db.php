<?php  

// Start the session
session_start();

function connect() {
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $database = "bdportal";
    $conn = new mysqli($servername, $username, $password, $database); 

    // Check connection 
    if ($conn->connect_error) { 
        die("Connection failure: " 
            . $conn->connect_error); 
    }
    
    return $conn;
}
  
  

?> 