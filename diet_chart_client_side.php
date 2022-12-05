<?php
$server="127.0.0.1:4307";
$username="root";
$password="";
$database = "infits";
// Create connection
$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$dietitianuserID = $_POST['dietitianID'];
$clientID = $_POST['clientID'];

// $dietitianuserID = 'Rahul';
// $clientID = 'Azarudeen';
$day = $_POST['day'];

// $day = 'monday';

$sql = "select $day from diet_chart where clientID = '$clientID' and dietitianuserID = '$dietitianuserID'";

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    print_r($row[$day]);
}
?>