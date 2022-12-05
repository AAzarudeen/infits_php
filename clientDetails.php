<?php 
$server="127.0.0.1:4307";
$username="root";
$password="";
$database = "infits";
// Create connection
$conn=mysqli_connect($server,$username,$password,$database);
$conn2=mysqli_connect($server,$username,$password,$database);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

	$clientuserID = $_POST['clientuserID'];
	// $clientuserID = "Azarudeen";
	$dietitianID = $_POST['dietitianID'];

	$stmnt = $conn -> prepare("select  * FROM client,diet_chart where client.clientuserID = ? and diet_chart.dietitianuserID = ?");
	
	$stmnt-> bind_param("ss",$clientuserID,$dietitianID);
	$stmnt-> execute();
	$stmnt-> bind_result($clientuserID,$password,$name,$location,$email,$mobile,$plancl,$profilePhoto,$dietitianID,$gender,$age,$verification,$height,$weight,$dietitianID,$clientID,$dun,$mon,$tue,$wed,$thur,$fri,$sat);
	

	$stmnt2 = $conn2 -> prepare("select  clientID FROM diet_chart where diet_chart.dietitianuserID = ?");
	
	$stmnt2-> bind_param("s",$dietitianID);
	$stmnt2-> execute();
	$stmnt2-> bind_result($clientID);

	$products = array();
	
	$plan = "null";

	$dietChartClient = array();

	while ($stmnt2 -> fetch()) {
		array_push($dietChartClient,$clientID);
	}

	// print_r($dietChartClient);

	while($stmnt->fetch()){

		// echo $clientID." <br> ".$clientuserID;

	  $temp = array();
	  
	  	$imageName = "$clientuserID.jpg";
	 	$image = 'upload/'.$imageName;
		$type = pathinfo($image, PATHINFO_EXTENSION);
		$data = file_get_contents($image);

	  $temp['clientuserID']= $clientuserID;
	  $temp['password']= $password;
	  $temp['name']= $name;
	  $temp['location']= $location;
	  $temp['email']= $email;
	  $temp['location']= $location;
	  $temp['email']= $email;
	  $temp['mobile']= $mobile;
	  $temp['age']= $age;
	  if(in_array($clientuserID,$dietChartClient)){
		$plan = "Diet Chart";
	}
	else if(!in_array($clientuserID,$dietChartClient)){
	$plan = "null";
	}
	  $temp['plan']= $plan;
	  $temp['profilePhoto']= base64_encode($data);
	  $temp['gender']= $gender;
	  $temp['dietitianID']= $dietitianID;
	  $temp['height'] = $height;
	  $temp['weight'] = $weight;
	  
	  array_push($products,$temp);
	}
	echo json_encode($products);
?>