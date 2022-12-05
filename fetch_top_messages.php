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

$dietitian_name = $_POST["dietitianID"];
$client_name = $_POST["clientID"];
// $client_name = "Eden";
// $dietitian_name = "Rahul";

$stmnt = $conn -> prepare("select message,time, messageBy,clientID from messages WHERE dietitianID=? and clientID=? order by time DESC LIMIT 1");

$stmnt->bind_param("ss",$dietitian_name,$client_name);
$stmnt->execute();
$stmnt-> bind_result($message,$time,$messageBy,$clientID);

$products = array();
	while($stmnt->fetch()){
	  $temp = array();

	  $imageName = "$clientID.jpg";
	  $image = 'upload/'.$imageName;
	 $type = pathinfo($image, PATHINFO_EXTENSION);
	 $data = file_get_contents($image);


	  $temp['message']= $message;
	  $temp['time']= $time;
	  $temp['messageBy']= $messageBy;
	//   $temp['unread'] = $unread;
	  $temp['clientID']= $clientID;
	  $temp['profilePhoto']= base64_encode($data);

	  array_push($products,$temp);
	}

echo json_encode($products);
?>