<?php

$server="127.0.0.1:4307";
$username="root";
$password="";
$database = "infits";
// Create connection
$conn = mysqli_connect($server, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$username = 'Priya';

$name = $_POST['name'];

$gender = $_POST['gender'];

$email = $_POST['email'];

$mobile = $_POST['mobile'];

$age = $_POST['age'];

$Image = $_POST['img'];

$qualification = $_POST['qualification'];

$nameImg = $_POST['nameImg'];

$location = $_POST['location'];

$expirence = $_POST['experience'];

$about_me = $_POST['about'];

$sql = "update dietitian set name = '$name',experience='$expirence',qualification='$qualification',gender = '$gender',email = '$email',mobile = '$mobile', age = '$age',profilePhoto ='$username',about_me='$about_me',location='$location' where dietitianuserID = '$username'";

if (mysqli_query($conn,$sql)) {
    
    echo "updated";

    file_put_contents("upload/$nameImg".".jpg",base64_decode($Image));
}

?>