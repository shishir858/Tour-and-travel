<?php
$servername = "localhost"; // Change if using a live server
$username = "root"; // Change for live database
$password = ""; // Change for live database
$database = "sspsof5_tdspt"; // Change to your actual DB name	


// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);


// Check connection
if (!$conn) {
  echo  mysqli_connect_error();
  die("Connection failed: " . mysqli_connect_error());
}
