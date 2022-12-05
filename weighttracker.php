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
$date = $_POST['date'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$bmi = $_POST['bmi'];
$goal = $_POST['goal'];

$sql = "select weight from weighttracker where clientID='$userID' and date = '$date'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 0){
$sql = "insert into weighttracker values('$date',$height,$weight,$bmi,$goal,'$userID')";
if (mysqli_query($conn,$sql)) {
    $sql = "update client set height='$height',weight = '$weight' where clientuserID = '$userID'";
    mysqli_query($conn,$sql);
    echo "updated";
}
else{
    echo "error";
}
}
else{
    $sql = "update weighttracker set height='$height',weight = '$weight',goal = '$goal',bmi = '$bmi' where date = '$date' and clientID = '$userID'";
    if (mysqli_query($conn,$sql)) {
        $sql = "update client set height='$height',weight = '$weight' where clientuserID = '$userID'";
        mysqli_query($conn,$sql);
        echo "updated";
    }
    else{
        echo "error";
    }   
}
?>