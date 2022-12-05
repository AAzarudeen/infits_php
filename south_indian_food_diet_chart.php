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

$sql = "select * from food_data_base_for_diet_chart where category = 'south_indian'";

$imageName = '';

$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $name = $row['photo'];
        $emparray['name'] = $row['name'];
        $emparray['calorie'] = $row['calorie'];
        $imageName = "$name.jpg";
	      $image = 'upload\food\south_indian\\'.$imageName;
	      $type = pathinfo($image, PATHINFO_EXTENSION);
	      $data = file_get_contents($image);
        $emparray['photo'] = base64_encode($data);
        $emparray['description'] = $row['description'];
        $emparray['nutrients'] = $row['nutrients'];
        $emparray['ingredients'] = $row['ingredients'];
        $emparray['category'] = $row['category'];
        $emparray['preparation'] = $row['preparation'];
        $full[] = $emparray;  
    }
    echo json_encode(['food' => $full]);

?>