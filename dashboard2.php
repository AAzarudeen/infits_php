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
	// $userID="Rahul";
	$stmnt = $conn -> prepare("SELECT client.clientuserID, client.profilePhoto
	FROM client WHERE client.dietitianuserID=? ");
	
	$stmnt-> bind_param("s",$userID);
	$stmnt-> execute();
	$stmnt-> bind_result($clientID,$profilePhoto);
	
	$products = array();
	
	while($stmnt->fetch()){

		$imageName = "$clientID.jpg";
		$image = 'upload/'.$imageName;
		$type = pathinfo($image, PATHINFO_EXTENSION);
		$data = file_get_contents($image);


	  $temp = array();
	  
	  $temp['clientID']= $clientID;
	  $temp['profilePhoto']= base64_encode($data);
	  
	  array_push($products,$temp);
	}

if(count($products)>0){
echo json_encode($products);
}
else {
echo "failure";
}
?>