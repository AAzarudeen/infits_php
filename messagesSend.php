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

	$dieticianID = $_POST['dieticianID'];
  $clientID = $_POST['clientID'];
	$message = $_POST['message'];
  $type = $_POST['type'];
  $sentBy = $_POST['sentBy'];
  $filename = $_POST['filename'];
  $time = $_POST['time'];
  // $dieticianID = "Rahul";
  // $clientID = "Eden";
	// $message = "hyy";
  if($type != "text"){
    $encoded = $message;
    $message = "";
  }
$stmnt = $conn -> prepare("INSERT INTO `messages`(`dietitianID`, `clientID`, `message`, `messageBy`, `time`,`type`,`filename`) VALUES (?,?,?,?,?,?,?)");

$stmnt->bind_param("sssssss",$dieticianID,$clientID,$message,$sentBy,$time,$type,$filename);

if($stmnt->execute()){
  if($type!="text"){
    file_put_contents("upload/Messages/$dieticianID$clientID$filename",base64_decode($encoded));
  }
echo "success";
}

else {
echo "failure";
}

?>