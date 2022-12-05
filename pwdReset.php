<?php 
$server="127.0.0.1";
$username="root";
$password="";
$database = "infits";
// Create connection
$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

	$password = $_POST['password'];
   	$userID = $_POST['userID'];
	
$stmnt = $conn -> prepare("UPDATE `dietitian` SET `password`=? WHERE dietitianuserID=?");

$stmnt->bind_param("ss",$password,$userID);


if($stmnt->execute()){
echo "success";
}
else {
echo "failure";
}

?>