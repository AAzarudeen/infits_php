<?php 
$server="127.0.0.1:4307";
$username="root";
$password="";
$database = "infitsTwo";
// Create connection
$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

	$dietitianuserID = $_POST['dietitianuserID'];
	$clientuserID = $_POST['clientuserID'];
	$dateandtime = $_POST['dateandtime'];
	$status = $_POST['status'];
	$duration = $_POST['duration'];
	$location = $_POST['location'];
	$title = $_POST['title'];
	$note = $_POST['note'];
	$notifyme = $_POST['notifyme'];


	$stmnt = $conn -> prepare("INSERT INTO consultations VALUES(?,?,?,?,?,?,?,?,?)");
	
	$stmnt-> bind_param("sssssssss",$dateandtime,$dietitianuserID,$clientuserID,$status
				,$duration,$location,$title,$note,$notifyme);
	$stmnt-> execute();
	

if($conn->connect_error){
        echo "failure";
    }else{
        echo "success";   
    }

?>