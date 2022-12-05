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

	// $dietianID = $_POST['dietianID'];

    $dietianID = 'Rahul';

    $sql = "select * from create_client where dietitianuserID = '$dietianID'";

$result = mysqli_query($conn,$sql);

$emparray = array();

while ($row = mysqli_fetch_assoc($result)) {
    $emparray["clientName"] = $row["clientName"];
    $emparray["gender"] = $row["gender"];
    $emparray["age"] = $row["age"];
    $emparray["height"] = $row["weight"];
    $emparray["about"] = $row["about"];
    $emparray["title"] = $row["title"];
    $emparray["plantitle"] = $row["plantitle"];
    $emparray["plandescription"] = $row["plandescription"];
    $emparray["referalcode"] = $row["referalcode"];
    $emparray["description"] = $row["description"];


    // $imageName = $row['name']."$dietianID.jpg";
	// $image = 'upload/Recipies/'.$imageName;
	// $type = pathinfo($image, PATHINFO_EXTENSION);
	// $data = file_get_contents($image);

    // $emparray["image"] = base64_encode($data);
    $full[] = $emparray;
}

echo json_encode($full);

?>