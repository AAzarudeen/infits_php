<?php

$server="127.0.0.1:4307";
$username="root";
$password="";
$database = "infits";
// Create connection
$conn = new mysqli($server, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$username = 'Azarudeen';

$name = $_POST['name'];

$gender = $_POST['gender'];

$email = $_POST['email'];

$mobile = $_POST['mobile'];

$age = $_POST['age'];

$Image = $_POST['img'];

$nameImg = $_POST['nameImg'];

$sql = "update dietitian set name = '$name',gender = '$gender',email = '$email',mobile = '$mobile', age = '$age',profilePhoto ='$username' where clientuserID = '$username'";


if (mysqli_query($conn,$sql)) {
    
    echo "updated";

    file_put_contents("upload/$nameImg".".jpg",base64_decode($Image));
}

?>