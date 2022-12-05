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

$sql = "SELECT * FROM client WHERE client.verification = 1 and client.dietitianuserID = '$userID'";

$result = mysqli_query($conn,$sql);

$sql2 = "SELECT diet_chart.clientID FROM diet_chart WHERE diet_chart.dietitianuserID = '$userID'";

$result2 = mysqli_query($conn,$sql2);

$plan = "null";

$dietChartClient = array();

// print_r($result2);

$no = 0;

while ($row2 = mysqli_fetch_assoc($result2)) {
    array_push($dietChartClient,$row2['clientID']);
}
// print_r($dietChartClient);

	$products = array();
	while($row = mysqli_fetch_assoc($result))
	{

        // echo $row['clientID'] == $row['clientuserID'];

        // if (in_array($row['clientuserID'],$dietChartClient)) {
        //     echo $row['clientuserID'];
        //     echo " ";
        //     echo 'Not failed';
        //     echo "<br>";
        // }
        // else if(!in_array($row['clientuserID'],$dietChartClient)){
        //     echo $row['clientuserID']." Failed";
        // }


        // print_r($row);

	  	$temp = array();
        if (in_array($row['clientuserID'],$dietChartClient)) {
            $temp['clientID']= $row['clientuserID'];
	  	$clientID = $row['clientuserID'];
		$temp['name']= $row['name'];
		// echo $row['clientID'];
				$plan = "Diet Chart";
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
		}
		else if(!in_array($row['clientuserID'],$dietChartClient)){
			$plan = "null";
            $temp['clientID']= $row['clientuserID'];
	  	$clientID = $row['clientuserID'];
		$temp['name']= $row['name'];
		// echo $row['clientID'];
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
		}
	array_push($products,$temp);
	}
	
if(count($products)>0){
echo json_encode($products);
}

else {
echo "failure";
}

?>