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
	// $userID="Rahul";
	$stmnt = $conn -> prepare("SELECT consultations.dateAndTime,consultations.dietitianID,consultations.clientID,consultations.status,
	client.clientuserID, client.mobile, client.profilePhoto from client,consultations WHERE consultations.clientID = client.clientuserID 
	AND consultations.dietitianID = ?
		AND consultations.status = 'pending'");
	
	$stmnt-> bind_param("s",$userID);
	$stmnt-> execute();
	$stmnt-> bind_result($dateandtime,$dietitianID,$clientID,$status,$clientuserID,$mobile,$profilePhoto);
	
	$products = array();
	
	while($stmnt->fetch()){

		$imageName = "$clientID.jpg";
		$image = 'upload/'.$imageName;
		$type = pathinfo($image, PATHINFO_EXTENSION);
		$data = file_get_contents($image);


	  $temp = array();
	  
	  $temp['dateandtime']= $dateandtime;
	  $temp['dietitianID']= $dietitianID;
	  $temp['clientID']= $clientID;
	  $temp['status']= $status;
	  $temp['clientuserID']= $clientuserID;
      $temp['mobile']= $mobile;
	  $temp['profilePhoto']= base64_encode($data);
	  
	  array_push($products,$temp);
	}

if(count($products)>-1){
echo json_encode($products);
}
else {
echo "failure";
}
?>