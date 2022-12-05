<?php 
$server="127.0.0.1:3307";
$username="root";
$password="";
$database = "infits";
// Create connection
$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

	$password = $_POST['password'];
	// $password ="rahul@!!";
	// $userID ="Rahul";
   	$userID = $_POST['userID'];
	
$stmnt = $conn -> prepare("select * from dietitian where dietitianuserID=? and password=?");

$stmnt->bind_param("ss",$userID,$password);
$stmnt->execute();
$stmnt-> bind_result($dietitianuserID,$password,$name,$qualification,
	$email,$mobile,$profilePhoto,$location,$age,$gender,$experience,$about_me,$no_of_clients);

$products = array();
	while($stmnt->fetch()){

		$imageName = "$dietitianuserID.jpg";
		$image = 'upload/'.$imageName;
	   $type = pathinfo($image, PATHINFO_EXTENSION);
	   $data = file_get_contents($image);

	  $temp = array();
	  $temp['dietitianuserID']= $dietitianuserID;
	  $temp['name']= $name;
	$temp['mobile']= $mobile;
	$temp['password']= $password;
	  $temp['qualification']= $qualification;
	  $temp['email']= $email;
	  $temp['profilePhoto']= base64_encode($data);
	  $temp['location']= $location;
	  $temp['age']= $age;
	  $temp['experience']= $experience;
	  $temp['about_me']= $about_me;
	  $temp['gender']= $gender;
	  $temp['no_of_clients']= $no_of_clients;
	  array_push($products,$temp);
	}
if(count($products)>0){
echo json_encode($products);
}
else {
echo "failure";
}

?>