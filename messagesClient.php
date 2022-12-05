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

	$dieticianID = $_POST['duserID'];
    $clientID = $_POST['cuserID'];
	
$stmnt = $conn -> prepare("SELECT * FROM `messages` WHERE dietitianID=? and clientID=? ORDER BY time ASC");

$stmnt->bind_param("ss",$dieticianID,$clientID);
$stmnt->execute();
$stmnt-> bind_result($dieticianID,$clientID,$message,$messageBy,$time,$status,$type,$filename);



	$products = array();
	while($stmnt->fetch())
	{
	  	$temp = array();
	  	$temp['dieticianID']= $dieticianID;
	  	$temp['clientID']= $clientID;
		$temp['message']= $message;
		$temp['messageBy']= $messageBy;
		$temp['time']=$time;
		$temp['type'] = $type;
		$temp['filename'] = $filename;
	  
	array_push($products,$temp);
	}
	
if(count($products)>-1){
echo json_encode($products);
}

else {
echo "failure";
}

?>