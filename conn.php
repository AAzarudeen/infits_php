<?php
$server="127.0.0.1:4307";
$username="root";
$password="";
$database = "infitstwo";
// Create connection
$conn = new mysqli($server, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
