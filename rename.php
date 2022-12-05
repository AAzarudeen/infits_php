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

$clientID = $_POST['clientID'];

$dietitianID = $_POST['dietitianID'];

$filename = $_POST['filename'];

$upload_date = $_POST['upload_date'];

$type = $_POST['type'];

$newName = $_POST['new_name'];


$sql = "update client_health_files set files ='$newName' where files = '$filename' and upload_date = '$upload_date' and clientID = '$clientID' and dietitianuserID = '$dietitianID'";

if (mysqli_query($conn,$sql)) {
    $status=rename("upload\FilesForHealthDetails\\$filename.$type","upload\FilesForHealthDetails\\$newName.$type");
    if($status){  
    echo "success";    
    }else{  
    echo "Sorry!";    
    }   
}  
?>  