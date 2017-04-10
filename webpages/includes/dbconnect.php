<?php
$mastername = "192.168.1.192"; //change the ip for your own db
$slavename = "192.168.1.202"; //change the ip for your own db
$password = "hawkstagram123";
$dbname = "hawkstagram";

// Create connection to masterdb
$masterdb = mysql_connect($mastername, $username, $password);

// Check connection with master db
if ($masterdb->connect_error) {
    die("Connection failed with master db: " . $masterdb->connect_error);
}
else{ 
  echo "Connected successfully to master db";
}

//create connection to slave db
$slavedb = mysql_connect($slavename, $username, $password);

//check connection to slave db
if($slavedb->connect_error){
  die("Connection failed with slave db:" . $slavedb->connect_error);
}
else{
  echo "connected successfully to slave db";
}

mysql_select_db($dbname);
?>