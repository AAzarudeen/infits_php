<?php

$server="127.0.0.1:4307";
$username="root";
$password="";
$database = "infits";

$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$from = date('Y-m-d', strtotime("sunday -1 week"));

$to = date('Y-m-d', strtotime("saturday 0 week"));

$clientID = $_POST['clientID'];

$sql = "select hrsSlept,sleeptime from sleepTracker where clientID = '$clientID' and sleeptime between '$from' and '$to';";

$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
      $emparray['date'] = date("d",strtotime($row['sleeptime']));
      $emparray['hrsSlept'] = $row['hrsSlept'];
      $full[] = $emparray;
    }
    echo json_encode(['sleep' => $full]);
?>