<?php 

require "connect.php";

	$userID = $_POST['userID'];
	$stmnt = $conn -> prepare("SELECT COUNT(clientID) FROM subscribedclient WHERE dietitianID=?");
	
	$stmnt-> bind_param("s",$userID);
	$stmnt-> execute();
	$stmnt-> bind_result($count);
	

	$products = array();
	
	while($stmnt->fetch()){
	  $temp = array();
	  
	  $temp['count']= $count;
	  
	  array_push($products,$temp);
	}

if(count($products)>0){
echo json_encode($products);
}
else {
echo "failure";
}
?>