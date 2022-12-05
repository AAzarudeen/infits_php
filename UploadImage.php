<?php 

// $server="127.0.0.1:3307";
// $username="root";
// $password="";
// $database = "img";
// // Create connection
// $conn = new mysqli($server, $username, $password, $database);
// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }


// $targetDir = "upload/";
// $fileName = basename($_FILES["up"]["name"]);
// $targetFilePath = $targetDir . $fileName;
// $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
// if(move_uploaded_file($_FILES["up"]["tmp_name"], $targetFilePath)){
//     echo "Uploaded";
// }
// else {
//     echo "failure";
// }


$Image = $_POST['img'];

$name = $_POST['name'];
    
if(file_put_contents("upload/$name".".jpg",base64_decode($Image))){
    echo "Uploaded";
}
else {
    echo "failure";
}


// if($_SERVER['REQUEST_METHOD']=='POST') 
// {
//     $ImageData = $_POST['image_path'];
 
//     $ImageName = $_POST['image_name'];
    
//     $ImagePath = "upload/";
    
//     file_put_contents($ImagePath,base64_decode($ImageData));
       
// $sql="INSERT INTO img VALUES ('$fileName')";
           
//           if(mysqli_query($conn,$sql))
//           {
//               echo "<script>alert('Notice uploaded successful!');</script>";
//           }
//           else
//           {
//               echo "Error :".mysqli_error($conn);
//           }
//}

?>