<?php 

require "connect.php";

	$userID = $_POST['userID'];
	
	$stmnt = $conn -> prepare("SELECT SUM(steps) FROM steptracker WHERE WEEKOFYEAR(cast(steptracker.dateandtime as DATE))=WEEKOFYEAR(NOW()) AND clientid=?");
	
	$stmnt-> bind_param("s",$userID);
	$stmnt-> execute();
	$stmnt-> bind_result($stepsSum);
	
	$products = array();
	
	while($stmnt->fetch()){
	  $temp = array();
	  
	  $temp['stepsSumWeek']= $stepsSum;
	   
	  array_push($products,$temp);
	}

	$stmnt = $conn -> prepare("SELECT SUM(steps) FROM steptracker WHERE YEAR(cast(steptracker.dateandtime as DATE)) = YEAR(NOW()) AND MONTH(cast(steptracker.dateandtime as DATE))=MONTH(NOW()) AND clientid=?");
	
	$stmnt-> bind_param("s",$userID);
	$stmnt-> execute();
	$stmnt-> bind_result($stepsSum);
	
	while($stmnt->fetch()){
	  $temp = array();
	  
	  $temp['stepsSumMonth']= $stepsSum;
	   
	  array_push($products,$temp);
	}

	$stmnt = $conn -> prepare("SELECT SUM(steps) FROM steptracker WHERE cast(steptracker.dateandtime as DATE)=CURRENT_DATE AND clientid=?");
	
	$stmnt-> bind_param("s",$userID);
	$stmnt-> execute();
	$stmnt-> bind_result($stepsSum);
	
	while($stmnt->fetch()){
	  $temp = array();
	  
	  $temp['stepsSumDaily']= $stepsSum;
	   
	  array_push($products,$temp);
	}

	$stmnt = $conn -> prepare("SELECT SUM(steps) FROM steptracker WHERE clientid=?");
	
	$stmnt-> bind_param("s",$userID);
	$stmnt-> execute();
	$stmnt-> bind_result($stepsSum);
	
	while($stmnt->fetch()){
	  $temp = array();
	  
	  $temp['stepsSumTotal']= $stepsSum;
	   
	  array_push($products,$temp);
	}

if(count($products)>-1){
echo json_encode($products);
}

else {
echo "failure";
}
?>