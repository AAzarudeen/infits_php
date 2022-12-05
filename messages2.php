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

	$duserID = $_POST['duserID'];
	$cuserID = $_POST['cuserID'];
	$stmnt = $conn -> prepare("UPDATE `messages` SET `unread`='R' WHERE `dietitianID`=? AND`clientID`=? ");
	
	$stmnt-> bind_param("ss",$duserID,$cuserID);
	

if($stmnt-> execute()){
echo "success";
}
else {
echo "failure";
}
?>