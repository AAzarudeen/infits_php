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

$userID = $_POST['clientID'];
// $json = $_POST['json'];
// $day = $_POST['day'];

$dietitianuserID = $_POST['dietitianuserID'];
// $userID = 'Azarudeen';
$json = $_POST['json'];
$day = $_POST['day'];

$sql = "select * from diet_chart where clientID='$userID' and dietitianuserID  = '$dietitianuserID'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 0){
        $sql = "insert into diet_chart(dietitianuserID,clientID,$day) values('$dietitianuserID','$userID','$json')";
        if (mysqli_query($conn,$sql)) {
            echo "updated";
        }
}
else{
        $sql = "update diet_chart set $day = '$json' where clientID = '$userID' and dietitianuserID = '$dietitianuserID'";
        if (mysqli_query($conn,$sql)) {
            echo "updated";
        }
}
?>