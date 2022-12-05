<?php 
$server="127.0.0.1:4307";
$username="root";
$password="";
$database = "infits";

$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

	$dietitianuserID = $_POST['dietitianuserID'];
	$dateandtime = $_POST['dateandtime'];
	$title = $_POST['title'];
	$note = $_POST['note'];
	$status = $_POST['status'];
	$viewer = '0';

	$stmnt = $conn -> prepare("INSERT INTO live VALUES(?,?,?,?,?,?)");
	
	$stmnt-> bind_param("ssssss",$dietitianuserID,$dateandtime,$title,$note,$status,$viewer);
	$stmnt-> execute();

if($conn->connect_error){
        echo "failure";
    }else{
        echo "success";   
    }
?>