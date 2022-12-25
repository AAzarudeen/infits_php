<?php 

require "connect.php";

//$user_name = $_POST["userID"];
//$user_pass = $_POST["password"];

$user_name = "Azarudeen";
$user_pass = "password";
$sql = "select * from client where clientuserID=? and password=?";

$stmt = $conn->stmt_init();
$stmt->prepare($sql);
$stmt->bind_param("ss", $user_name,$user_pass);
$stmt->execute();
$stmt-> bind_result($clientuserID,$password,$name,$location,$email,$mobile,$plan,$profilePhoto,$dietitianuserID,$gender,$age,$verification,$height,$weight);
$result = $stmt->get_result();
$resultArray = $result->fetch_assoc();

if(mysqli_num_rows($result) > 0) {

	// $imageName = $_POST[''];
	$imageName = "$user_name.jpg";
	$image = 'upload/'.$imageName;
	$type = pathinfo($image, PATHINFO_EXTENSION);
	$data = file_get_contents($image);

  $products = array();
  $temp = array();
  $temp['clientuserID']= $resultArray['clientuserID'];
  $temp['dietitianuserID']= $resultArray['dietitianuserID'];
  $temp['name']= $resultArray['name'];
  $temp['mobile']= $resultArray['mobile'];
  $temp['password']= $resultArray['password'];
  $temp['email']= $resultArray['email'];
  $temp['profilePhoto']= base64_encode($data);
  $temp['location']= $resultArray['location'];
  $temp['age']= $resultArray['age'];
  $temp['gender']= $resultArray['gender'];
  $temp['plan'] = $resultArray['plan'];
  $temp['verification'] = $resultArray['verification'];
  $temp['height'] = $resultArray['height'];
  $temp['weight'] = $resultArray['weight'];
  array_push($products,$temp);
echo json_encode($products);
}

else {
echo "failure";
}
?>