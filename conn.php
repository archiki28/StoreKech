<?php
    // Get information server 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "storekech";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " .mysql_error());
    }
?>