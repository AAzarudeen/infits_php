<?php
$server="127.0.0.1:4307";
$username="root";
$password="";
$database = "infits";

$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// $dietitianuserID = $_POST['dietitianuserID'];
// $template_name = $_POST['template_name'];

$dietitianuserID = "Rahul";

$sql = "select * from template_name where dietitianuserID = '$dietitianuserID'";

$result = mysqli_query($conn,$sql);

$emparray = array();

while ($row = mysqli_fetch_assoc($result)) {

  $emparray['template_name'] = $row['template_name'];
  $emparray['diet_chart'] = $row['diet_chart'];

  $full[] = $emparray;

}

echo json_encode(['temp' => $full]);

?>