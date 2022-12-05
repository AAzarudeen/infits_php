<?php
	include 'connect.php';
	
	$stmnt = $conn -> prepare("select dietitianuserID,name,qualification,
	email,mobile,profilePhoto,location,age,gender from dietitian");
	
	$stmnt-> execute();
	$stmnt-> bind_result($dietitianuserID,$name,$qualification,
	$email,$mobile,$profilePhoto,$location,$age,$gender);
	
	$products = array();
	
	while($stmnt->fetch()){
	  $temp = array();
	  
	  $temp['dietitianuserID']= $dietitianuserID;
	  $temp['name']= $name;
	  $temp['qualification']= $qualification;
	  $temp['email']= $mobile;
	  $temp['profilePhoto']= $profilePhoto;
	  $temp['location']= $location;
	  $temp['age']= $age;
	  $temp['gender']= $gender;
	  
	  array_push($products,$temp);
	}
	echo json_encode($products);
?>