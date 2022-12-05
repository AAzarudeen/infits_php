<?php 
// require "connect.php";
$server="127.0.0.1:3307";
$username="root";
$password="";
$database = "infits";
// Create connection
$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

	$userID = $_POST['userID'];
	$date = $_POST['date'];
	$stmnt = $conn -> prepare("SELECT steptracker.goal, SUM(steptracker.steps),
					 watertracker.goal, SUM(watertracker.drinkConsumed), 
					sleeptracker.goal, SUM(sleeptracker.hrsSlept), SUM(sleeptracker.minsSlept),
					weighttracker.goal, weighttracker.weight 
					,cast(weighttracker.date as DATE),cast(steptracker.dateandtime as DATE),
					cast(watertracker.time as DATE),cast(sleeptracker.waketime as DATE)
					FROM steptracker,watertracker,sleeptracker,weighttracker 
					WHERE steptracker.clientid =? 
					AND watertracker.clientID = ? 
					AND sleeptracker.clientID = ? 
					AND weighttracker.clientID =?
					AND cast(weighttracker.date as DATE) = ?
					AND cast(steptracker.dateandtime as DATE) = ?
					AND cast(watertracker.time as DATE) = ?
					AND cast(sleeptracker.waketime as DATE) = ?");
	
	$stmnt-> bind_param("ssssssss",$userID,$userID,$userID,$userID,$date,$date,$date,$date);
	$stmnt-> execute();
	$stmnt-> bind_result($stepsgoal,$steps,$watergoal,$water,$sleepgoal,$sleephrs,$sleepmins,$weightgoal,$weight,$date1,
					$date2,$date3,$date4);
	
	$products = array();
	
	while($stmnt->fetch()){
	  $temp = array();
	  
	  $temp['stepsgoal']= $stepsgoal;
	  $temp['steps']= $steps;
	  $temp['watergoal']= $watergoal;
	  $temp['water']= $water;
	  $temp['sleepgoal']= $sleepgoal;
	  $temp['sleephrs']= $sleephrs;
	 $temp['sleepmins']= $sleepmins;
	  $temp['weightgoal']= $weightgoal;
	  $temp['weight']= $weight;
		$temp['date1']= $date1;
		$temp['date2']= $date2;
		$temp['date3']= $date3;
		$temp['date4']= $date4;	  

	  array_push($products,$temp);
	}

if(count($products)>0){
echo json_encode($products);
}

else {
echo "failure";
}
?>