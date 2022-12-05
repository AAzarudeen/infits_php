<?php

$server="127.0.0.1";
$username="root";
$password="";
$database = "infits";
// Create connection
$conn = new mysqli($server, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


// $username = $_POST['userID'];

$userID = $_POST['userID'];

$name = $_POST['name'];

$gender = $_POST['gender'];

$email = $_POST['email'];

$mobile = $_POST['mobile'];

$age = $_POST['age'];
$location = $_POST['location'];
$experience = $_POST['experience'];
$about_me = $_POST['about_me'];
$Image = $_POST['img'];

$nameImg = $_POST['nameImg'];

$sql = "update dietitian set name = '$name',location ='$location',experience ='$experience',about_me ='$about_me',gender = '$gender',email = '$email',mobile = '$mobile', age = '$age',profilePhoto ='$userID' where dietitianuserID = '$userID'";


if (mysqli_query($conn,$sql)) {
    
    echo "updated";

    file_put_contents("upload/$nameImg".".jpg",base64_decode($Image));
}

?>