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
	// $duserID = "Rahul";
	// $cuserID = "Eden";

	$stmnt = $conn -> prepare("SELECT * FROM messages WHERE dietitianID=? and clientID =? ORDER BY time ASC");
	
	$stmnt-> bind_param("ss",$duserID,$cuserID);
	$stmnt-> execute();
	$stmnt-> bind_result($dieticianID,$clientID,$message,$messageBy,$time);
	

	$products = array();
	
	while($stmnt->fetch()){
	  $temp = array();
	  
	  $temp['dieticianID']= $dieticianID;
	  $temp['clientID']= $clientID;
	  $temp['message']= $message;
	  $temp['messageBy']= $messageBy;
	  $temp['time']= $time;
 	//   $temp['read']= $read;
	  
	  array_push($products,$temp);
	}

if(count($products)>-1){
echo json_encode($products);
}
else {
echo "failure";
}
?>