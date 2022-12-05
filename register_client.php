<?php
$server="127.0.0.1:4307";
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
$mobile = $_POST['phone'];
$sql = "insert into client (clientuserID,password,name,email,mobile) VALUES ('$userID','$password',
	'$name','$email','$mobile');";
    try {
        if($conn->query($sql)){
            echo "success";
        }
    } catch (mysqli_sql_exception $th) {
        echo "UserName already taken";
    }
?>