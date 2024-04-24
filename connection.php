<?php 

$servername = "localhost";
$username = "kzy";
$password = "123";
$dbname = "mobile_banking";

// Create connection
$connect = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
