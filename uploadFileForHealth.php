<?php
$server="127.0.0.1:4307";
$username="root";
$password="";
$database = "infits";

$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$clientID = $_POST['clientID'];

$dietianuserID = $_POST['dietianuserID'];

$upload_date = $_POST['upload_date'];

$type = $_POST['type'];

$file = $_POST['file'];

$file_name = preg_replace('/[^A-Za-z0-9. -]/', '', $clientID.$dietianuserID.$upload_date);

$sql = "insert into client_health_files values('$clientID','$dietianuserID','$file_name','$upload_date','$type')";

if(mysqli_query($conn,$sql)){
    if (file_put_contents("upload/FilesForHealthDetails/"."$file_name".".$type",base64_decode($file))){
        echo "updated";
    }
}
else{
    echo "failure";
}
?>