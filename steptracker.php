<?php

$server="127.0.0.1:4307";
$username="root";
$password="";
$database = "sample";

$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set('Asia/Kolkata');


// steps	dateandtime	avgspeed	distance	calories	goal	clintID

$userID = $_POST['userID'];
$steps = $_POST['steps'];
$dateandtime = date('Y-m-d h:i:s',strtotime($_POST['dateandtime']));
$avgspeed = $_POST['avgspeed'];
$distance = $_POST['distance'];
$goal = $_POST['goal'];
$calories = $_POST['calories'];

// $userID = 'dilip';
// $steps = '3000';
// $dateandtime = date('Y-m-d',strtotime('2022-05-29'));
// $avgspeed = '55';
// $distance = '10';
// $goal = '5000';
// $calories = '34';


// $sql = "select steps from steptracker where clientID='$userID' and dateandtime = '$dateandtime'";

// $result = mysqli_query($conn, $sql);

// if(mysqli_num_rows($result) == 0){
//     $sql = "insert into steptracker values('$steps','$dateandtime','$avgspeed','$distance','$calories','$goal','$userID')";
// if (mysqli_query($conn,$sql)) {
//     echo "updated 1st";
// }
// else{
//     echo "error";
// }
// }
// else{
//     $sql = "update steptracker set steps = '$steps',goal = '$goal' where dateandtime = '$dateandtime' and clientID = '$userID'";
//     if (mysqli_query($conn,$sql)) {
//         echo "updated 2nd";
//     }
//     else{
//         echo "error";
//     }   
// }

    $sql = "insert into steptracker values('$steps','$dateandtime','$avgspeed','$distance','$calories','$goal','$userID')";
if (mysqli_query($conn,$sql)) {
    echo "updated";
}
else{
    echo "error";
}


?>