<?php 

require "connect.php";

	$userID = $_POST['userID'];
	$name = $_POST['name'];
    $email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];
	$location = $_POST['location'];
	$experience = $_POST['experience'];
	$about_me = $_POST['about_me'];

$stmnt = $conn -> prepare("UPDATE `dietitian` SET `name`=? ,`email`=? ,`mobile`=? ,`age`=? ,`gender`=? ,`location`=?,`experience`=?,
			`about_me`=?
			WHERE dietitianuserID=?");
$stmnt->bind_param("sssssssss",
		$name,$email,$mobile,$age,$gender,$location,$experience,$about_me,$userID);
$stmnt->execute();

 if($conn->connect_error){
        echo "failure";
    }else{
        echo "success";   
    }
?>