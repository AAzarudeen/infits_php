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
// $userID = "Rahul";
	
$stmnt = $conn -> prepare("select DISTINCT clientID from messages where dietitianID=? ");

$stmnt->bind_param("s",$userID);
$stmnt->execute();
$stmnt-> bind_result($clientID);

$products = array();
	while($stmnt->fetch()){
	  $temp = array();
	  $temp['clientID']= $clientID;
	  array_push($products,$temp);
	}

echo json_encode($products);
?>