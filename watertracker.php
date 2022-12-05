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

$userID = $_POST['userID'];
$date = date('Y-m-d',strtotime($_POST['date']));
$goal = $_POST['goal'];
$type = $_POST['type'];
$time = $_POST['time'];
$amount = $_POST['amount'];
$consumed = $_POST['consumed'];

// $sql = "select drinkConsumed from watertracker where clientID='$userID' and date = '$date'";

// $result = mysqli_query($conn, $sql);

// if(mysqli_num_rows($result) == 0){
// $sql = "insert into watertracker values('$consumed','$goal','$date','$userID')";
// if (mysqli_query($conn,$sql)) {
//     echo "updated";
// }
// else{
//     echo "error";
// }
// }
// else{
//     $sql = "update watertracker set drinkConsumed = '$consumed',goal = '$goal' where clientID = '$userID' and date = '$date'";
//     if (mysqli_query($conn,$sql)) {
//         echo "updated";
//     }
//     else{
//         echo "error";
//     }   
// }

$sql = "select drinkConsumed from watertracker where clientID='$userID' and date = '$date'";

// $liquid = 0;

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 0){
$sql = "insert into watertracker values('$consumed','$goal','$date','$userID','$time','$type','$amount')";
if (mysqli_query($conn,$sql)) {
    echo "updated";
}
else{
    echo "error";
}
}
else{
    while ($row = mysqli_fetch_assoc($result)) {
        $liquid = $row['drinkConsumed'];
    }

    $liquid += $amount;
    
    $sql = "insert into watertracker values('$liquid','$goal','$date','$userID','$time','$type','$amount')";
if (mysqli_query($conn,$sql)) {
    echo "updated";
}
else{
    echo "error";
}
}
?>