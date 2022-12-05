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

$dietitianuserID = $_POST['dietitianuserID'];
$json = $_POST['json'];
$template_name = $_POST['template_name'];
$sql = "insert into template_name values ('$json','$template_name','$dietitianuserID')";
if (mysqli_query($conn,$sql)) {
    echo "updated";
}
?>