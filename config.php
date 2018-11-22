<?php

$dbhost="localhost"; // hostname
$dbuser="root"; // username 
$dbpass="usbw"; // password
$dbname="itweek"; // database name

// Create connection
$conn = mysqli_connect($dbhost,$dbuser,$dbpass);
mysqli_select_db($conn,$dbname);

if(!$conn)
	die('Could not connect to MySQL: ' . mysqli_error());

?>

