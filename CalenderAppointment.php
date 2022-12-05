<?php 
$server="127.0.0.1:4307";
$username="root";
$password="";
$database = "infitstwo";
// Create connection
$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

	$userID = $_POST['userID'];
	$date = $_POST['date'];
	$stmnt = $conn -> prepare("SELECT * FROM consultations WHERE dietitianID=? AND cast(dateAndTime as DATE)=?");
	
	$stmnt-> bind_param("ss",$userID,$date);
	$stmnt-> execute();
	$stmnt-> bind_result($dateAndTime,$dietitianID,$clientID,$status,$duration,$consultation_location,
					$Title,$Note,$NotifyMe);
	
	$products = array();
	
	while($stmnt->fetch()){
	  $temp = array();
	  
	  $temp['dateAndTime']= $dateAndTime;
	  $temp['dietitianID']= $dietitianID;
	  $temp['clientID']= $clientID;
	  $temp['status']= $status;
	  $temp['duration']= $duration; 
	  $temp['consultation_location']= $consultation_location;
	  $temp['Title']= $Title;
	  $temp['Note']= $Note;
	  $temp['NotifyMe']= $NotifyMe;

	  array_push($products,$temp);
	}

if(count($products)>-1){
echo json_encode($products);
}

else {
echo "failure";
}
?>