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

	$userID = $_POST['userID'];
	// $userID = "Azarudeen";
	
	$stmnt = $conn -> prepare("SELECT AVG(weight) FROM weighttracker WHERE WEEKOFYEAR(cast(weighttracker.date as DATE) )=WEEKOFYEAR(NOW()) AND clientid=?");
	
	$stmnt-> bind_param("s",$userID);
	$stmnt-> execute();
	$stmnt-> bind_result($Sum);
	
	$products = array();
	
	while($stmnt->fetch()){
	  $temp = array();
	  
	  $temp['SumWeek']= $Sum;
	   
	  array_push($products,$temp);
	}

	$stmnt = $conn -> prepare("SELECT AVG(weight) FROM weighttracker WHERE YEAR(cast(weighttracker.date as DATE)) = YEAR(NOW()) AND MONTH(cast(weighttracker.date as DATE))=MONTH(NOW()) AND clientid=?");
	
	$stmnt-> bind_param("s",$userID);
	$stmnt-> execute();
	$stmnt-> bind_result($Sum);
	
	while($stmnt->fetch()){
	  $temp = array();
	  
	  $temp['SumMonth']= $Sum;
	   
	  array_push($products,$temp);
	}

	$stmnt = $conn -> prepare("SELECT AVG(weight) FROM weighttracker WHERE cast(weighttracker.date as DATE)=CURRENT_DATE AND clientid=?");
	
	$stmnt-> bind_param("s",$userID);
	$stmnt-> execute();
	$stmnt-> bind_result($Sum);
	
	while($stmnt->fetch()){
	  $temp = array();
	  
	  $temp['SumDaily']= $Sum;
	   
	  array_push($products,$temp);
	}

	$stmnt = $conn -> prepare("SELECT AVG(weight) FROM weighttracker WHERE clientid=?");
	
	$stmnt-> bind_param("s",$userID);
	$stmnt-> execute();
	$stmnt-> bind_result($Sum);
	
	while($stmnt->fetch()){
	  $temp = array();
	  
	  $temp['SumTotal']= $Sum;
	   
	  array_push($products,$temp);
	}

if(count($products)>-1){
echo json_encode($products);
}

else {
echo "failure";
}
?>