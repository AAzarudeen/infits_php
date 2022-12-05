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

// $clientID = "Azarudeen";

// $dietianuserID = "Rahul";

$sql = "select * from client_health_files where clientID = '$clientID' and dietitianuserID = '$dietianuserID'";

$result = mysqli_query($conn,$sql);

// echo $ip;

$emparray = array();

while ($row = mysqli_fetch_assoc($result)) {
    
$emparray["files"] = $row["files"];

$emparray["upload_date"] = $row["upload_date"];

$emparray["type"] = $row["type"];

$full[] = $emparray;

}

echo json_encode(['files'=>$full]);

?>