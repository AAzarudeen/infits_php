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


	$stmnt = $conn -> prepare(" SELECT * FROM subscribedclient ");
	
	$stmnt-> execute();
	$stmnt-> bind_result($clientID,$plan,$startDate,$endDate,$dietChart,$dietitianID);
	

	$products = array();
	
	while($stmnt->fetch()){
	  $temp = array();
	  
	  $temp['clientID']= $clientID;
	  $temp['plan']= $plan;
	  $temp['startDate']= $startDate;
 	  $temp['endDate']= $endDate;
	  $temp['dietChart']= $dietChart;
	  $temp['dietitianID']= $dietitianID;
	  
	  array_push($products,$temp);
	}

if(count($products)>-1){
echo json_encode($products);
}
else {
echo "failure";
}
?>