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

   	$userID = $_POST['userID'];
	
$stmnt = $conn -> prepare("select * from dietitian where dietitianuserID=?");

$stmnt->bind_param("s",$userID);
$stmnt->execute();
$stmnt-> bind_result($dietitianuserID,$password,$name,$qualification,
	$email,$mobile,$profilePhoto,$location,$experience,$about_me,$age,$gender,$no_of_clients);

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
	  $temp['experience']= $experience;
	  $temp['about_me']= $about_me;
	  $temp['gender']= $gender;
	  $temp['no_of_clients']= $no_of_clients;
	  array_push($products,$temp);
	}
if(count($products)==0){
echo "success";
}
else {
echo "failure";
}

?>