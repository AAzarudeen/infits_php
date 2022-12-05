<?php 
$server="127.0.0.1:4307";
$username="root";
$password="";
$database = "infits";
// Create connection
$conn=mysqli_connect($server,$username,$password,$database);
$conn2=mysqli_connect($server,$username,$password,$database);
$conn3=mysqli_connect($server,$username,$password,$database);
$conn4=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

	// $userID = $_POST['userID'];

	$userID = "Azarudeen";
	$stmnt = $conn -> prepare("SELECT steptracker.goal, SUM(steptracker.steps)
					FROM steptracker
					WHERE steptracker.clientid =? 
					AND cast(steptracker.dateandtime as DATE) =  CURRENT_DATE");
	
	$stmnt-> bind_param("s",$userID);
	$stmnt-> execute();
	$stmnt-> bind_result($stepsgoal,$steps);
	

    $stmnt2 = $conn2 -> prepare("SELECT watertracker.goal, watertracker.drinkconsumed FROM watertracker
    WHERE watertracker.clientid =? 
    AND cast(watertracker.date as DATE) =  CURRENT_DATE");

$stmnt2-> bind_param("s",$userID);
$stmnt2-> execute();
$stmnt2-> bind_result($watergoal,$water);

$stmnt3 = $conn3 -> prepare("SELECT sleeptracker.goal, SUM(sleeptracker.hrsSlept), SUM(sleeptracker.minsSlept) FROM sleeptracker
					WHERE sleeptracker.clientid =? 
					AND cast(sleeptracker.waketime as DATE) =  CURRENT_DATE");
	
	$stmnt3-> bind_param("s",$userID);
	$stmnt3-> execute();
	$stmnt3-> bind_result($sleepgoal,$sleephrs,$sleepmins);
	

    $stmnt4 = $conn4 -> prepare("SELECT weighttracker.goal, weighttracker.weight FROM weighttracker
    WHERE weighttracker.clientid =? 
    AND cast(weighttracker.date as DATE) =  CURRENT_DATE");

$stmnt4-> bind_param("s",$userID);
$stmnt4-> execute();
$stmnt4-> bind_result($weightgoal,$weight);

	$products = array();
	

	while($stmnt->fetch()){
	//   $temp = array();
	  
	  $temp['stepsgoal']= $stepsgoal;
	  $temp['steps']= $steps;
	}

    while ($stmnt2->fetch()) {
        $temp['watergoal']= $watergoal;
	  $temp['water']= $water;
    }

    while($stmnt3->fetch()){
        // $temp = array();
        
        $temp['sleepgoal']= $sleepgoal;
        $temp['sleephrs']= $sleephrs;
        $temp['sleepmins']= $sleepmins;

      }
  
      while ($stmnt4->fetch()) {
        $temp['weightgoal']= $weightgoal;
        $temp['weight']= $weight;
      }

      array_push($products,$temp);
if(count($products)>0){
echo json_encode($products);
}

else {
echo "failure";
}
?>