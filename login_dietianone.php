<?php 
$server="127.0.0.1";
$username="root";
$password="";
$database = "infits";
// Create connection
$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

	$password = $_POST['password'];
   	$userID = $_POST['userID'];
	
$stmnt = $conn -> prepare("select dietitianuserID,password,name,qualification,
	email,mobile,profilePhoto,location,age,gender from dietitian where dietitianuserID=? and password=?");

$stmnt->bind_param("ss",$userID,$password);
$stmnt->execute();
$stmnt-> bind_result($dietitianuserID,$password,$name,$qualification,
	$email,$mobile,$profilePhoto,$location,$age,$gender);

$products = array();
	while($stmnt->fetch()){
	  $temp = array();
	  $temp['dietitianuserID']= $dietitianuserID;
	  $temp['name']= $name;
	$temp['mobile']= $mobile;
	$temp['password']= $password;
	  $temp['qualification']= $qualification;
	  $temp['email']= $email;
	  $temp['profilePhoto']= $profilePhoto;
	  $temp['location']= $location;
	  $temp['age']= $age;
	  $temp['gender']= $gender;
	  array_push($products,$temp);
	}
if(count($products)>0){
echo json_encode($products);
}
else {
echo "failure";
}

?>