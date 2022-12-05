<head>
</head>
<body>
    
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
<b>Select Image File to attach with your notice:</b> <input type="file" name="up">

<input type="submit" value="Submit" name="submit">
</form>

<?php 

$server="127.0.0.1:4307";
$username="root";
$password="";
$database = "img";
// Create connection
$conn = new mysqli($server, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST["submit"])) 
{
$targetDir = "upload/";
$fileName = basename($_FILES["up"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
move_uploaded_file($_FILES["up"]["tmp_name"], $targetFilePath);
echo $targetFilePath;

$sql="INSERT INTO img VALUES ('$fileName')";
           
          if(mysqli_query($conn,$sql))
          {
              echo "<script>alert('Notice uploaded successful!');</script>";
          }
          else
          {
              echo "Error :".mysqli_error($conn);
          }
        }
 
?>

</body>
</html>