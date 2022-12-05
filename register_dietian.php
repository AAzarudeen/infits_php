<?php 
$server="127.0.0.1:4306";
$username="root";
$password="";
$database = "infits";
// Create connection
$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


    	$email = $_POST['email'];
    	$password = $_POST['password'];
   	$userID = $_POST['userID'];
	$name = $_POST['name'];
	$qualification = $_POST['qualification'];
	$mobile = $_POST['mobile'];
	$location = $_POST['location'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];
	$sql = "insert into dietitian (dietitianuserID,password,name,qualification,email,mobile,location,age,gender) 
	VALUES (?,?,?,?,?,?,?,?,?)";


	$stmt = $conn->stmt_init();
$stmt->prepare($sql);
$stmt->bind_param("sssssssss",$userID,$password,
		$name,$qualification,$email,$mobile,$location,$age,$gender);
$stmt->execute();


 if(!$conn->connect_error) {
echo "success";
}else{
        echo "failure";   
    }

?>