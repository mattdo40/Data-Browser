<?php
    $servername = "localhost"; // default server name
    $username = "matt"; // user name that you created
    $password = "matt"; // password that you created
    $dbname = "pokemonDB";
    
    $conn =new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error ."<br>");
    } 
?>