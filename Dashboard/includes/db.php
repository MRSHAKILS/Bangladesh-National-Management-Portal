<?php  


function connect() {
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $database = "shakil";
    $conn = new mysqli($servername, $username, $password, $database); 

    // Check connection 
    if ($conn->connect_error) { 
        die("Connection failure: " 
            . $conn->connect_error); 
    }
    
    return $conn;
}
  
  
// Creating a database named geekdata 
// $sql = "CREATE DATABASE geekdata"; 
// if ($conn->query($sql) === TRUE) { 
//     echo "Database with name geekdata"; 
// } else { 
//     echo "Error: " . $conn->error; 
// } 
  
// Closing connection 
// $conn->close(); 
?> 