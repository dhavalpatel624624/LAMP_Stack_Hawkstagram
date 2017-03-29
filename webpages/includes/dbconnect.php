<?php
$servername = "192.168.1.192";
$username = "dbuser";
$password = "hawkstagram123";

// Create connection
$conn = mysql_connect($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>