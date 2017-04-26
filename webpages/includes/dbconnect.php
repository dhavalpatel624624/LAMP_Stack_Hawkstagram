<?php
$mastername = "192.168.1.192"; //change the ip for your own db
$slavename = "192.168.1.202"; //change the ip for your own db
$username = "dbuser";
$password = "hawkstagram123";
$dbname = "hawkstagram";

// Create connection to masterdb
$masterdb = mysql_connect($mastername, $username, $password);

// Check connection with master db
if (!$masterdb) {
    die("Connection failed with master db: " . $masterdb->connect_error . "\n");
}

//create connection to slave db
$slavedb = mysql_connect($slavename, $username, $password, true);

//check connection to slave db
if(!$slavedb){
  die("Connection failed with slave db:" . $slavedb->connect_error . "\n");
}

mysql_select_db($dbname, $masterdb);
mysql_select_db($dbname, $slavedb);
?>