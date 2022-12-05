<?php

$server="127.0.0.1:4307";
$username="root";
$password="";
$database = "sample";

$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$userID = $_POST['userID'];

$mon = $_POST['month'];

// $userID = 'Azarudeen';

// $mon = 'Jun';

$from = date("Y-m-d", strtotime("first day of $mon"));
$to = date("Y-m-d", strtotime("last day of $mon"));

$sql = "select date,weight from weighttracker where clientID='$userID' and date between '$from' and '$to'";

$result = mysqli_query($conn, $sql);

$emparray = array();

while ($row = mysqli_fetch_assoc($result)) {
    $emparray['date'] = $row['date'];
    $emparray['weight'] = $row['weight'];
    $full[] = $emparray;
}
echo json_encode(['weight' => $full]);
?>