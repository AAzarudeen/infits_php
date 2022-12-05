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

	$dietitianuserID = $_POST['dietitianuserID'];
	$dateandtime = $_POST['dateandtime'];
	$title = $_POST['title'];
    $viewer = $_POST['viewer'];
	$status = "ended";
	echo $dietitianuserID;
	echo $dateandtime;
	echo $title;
	$sql = "update live set status = '$status',viewer = '$viewer' where dietitianuserID = '$dietitianuserID' and dateandtime = '$dateandtime' and title='$title';";
    if (mysqli_query($conn,$sql)) {
        echo "updated";
    }
    else{
        echo "error";
    }   
?>