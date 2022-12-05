<?php

$server="127.0.0.1:4307";
$username="root";
$password="";
$database = "infits";

$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set('Asia/Kolkata');

$userID = $_POST['userID'];
$sleeptime = date('Y-m-d h:i:s',strtotime($_POST['sleeptime']));
$waketime = date('Y-m-d h:i:s',strtotime($_POST['waketime']));
$hrsslept = date('H',strtotime($_POST['timeslept']));
$goal = $_POST['goal'];
$minsslept = date('i',strtotime($_POST['timeslept']));

// $date = date('d-m-y h:i:s');
// echo $date;


// echo $sleeptime."  ";

// echo $waketime;

// $sql = "insert into sleeptracker values('$sleeptime','$waketime','$hrsslept','$minsslept','$goal','$userID')";
$sql = "insert into sleeptracker values('$sleeptime','$waketime','$userID','$hrsslept','$goal','$minsslept')";
if (mysqli_query($conn,$sql)) {
    echo "updated";
}
else{
    echo "error";
}
?>