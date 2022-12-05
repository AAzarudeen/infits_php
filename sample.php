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

// $client_name = $_POST["clientid"];
// $dietitian_name = $_POST["dietitianid"];
$client_name = "Ryan_Gold";
$dietitian_name = "Rahul";
$sql = "select message, time, messageBy from messages where clientID=? and dietitianID=? order by time";

$stmt = $conn->stmt_init();
$stmt->prepare($sql);
$stmt->bind_param("ss", $client_name,$dietitian_name);
$stmt->execute();
$stmt->bind_result($message,$time,$messageBy);
//while ($stmt->fetch()) {
//    printf(" %s %s (%s)\n", $message, $time, $messageBy);
//}
$messages_array = array();
	while($stmt->fetch()){
	  $temp = array(); 
	  $temp['message']= $message;
	  $temp['time']= $time;
	  $temp['messageBy']= $messageBy;
	  //printf(" %s %s (%s)\n", $temp['message'], $temp['time'], $temp['messageBy']);
	  array_push($messages_array,$temp);
	}

echo json_encode($messages_array);
?>