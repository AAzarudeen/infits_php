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

	// $userID = $_POST['userID'];

	$userID = "Rahul";
	
// $stmnt = $conn -> prepare("SELECT client.clientuserID,client.name,client.plan,client.profilePhoto,subscribedclient.startdate,
// subscribedclient.enddate,subscribedclient.dietChart,subscribedclient.dietitianID FROM client,subscribedclient WHERE 
// client.clientuserID=subscribedclient.clientID AND subscribedclient.dietitianID=? ");

// $stmnt->bind_param("s",$userID);
// $stmnt->execute();
// $stmnt-> bind_result($clientID,$name,$plan,
// 						$profilePhoto,$startdate,$enddate,
// 					$dietChart,$dietitianID);

$sql = "SELECT * FROM client,diet_chart WHERE client.verification = 1 and client.dietitianuserID = '$userID' and diet_chart.dietitianuserID = '$userID'";

$result = mysqli_query($conn,$sql);

$plan = "null";

	$products = array();
	while($row = mysqli_fetch_assoc($result))
	{
	  	$temp = array();
	  	$temp['clientID']= $row['clientuserID'];
	  	$clientID = $row['clientuserID'];
		$temp['name']= $row['name'];
		// echo $row['clientID'];
		if($row['clientID'] == $temp['clientID']){
				$plan = "Diet Chart";
		}
		else{
			$plan = "null";
		}
		$temp['plan']= $plan;
		  $imageName = "$clientID.jpg";
		  $image = 'upload/'.$imageName;
		  $type = pathinfo($image, PATHINFO_EXTENSION);
		  $data = file_get_contents($image);

		$temp['profilePhoto']= base64_encode($data);
		// $temp['startdate']= $startdate;
		// $temp['enddate']= $enddate;
		// $temp['dietChart']=$dietChart;
		$temp['dietitianID']=$row['dietitianuserID'];
	  
	array_push($products,$temp);
	}
	
if(count($products)>0){
echo json_encode($products);
}

else {
echo "failure";
}

?>