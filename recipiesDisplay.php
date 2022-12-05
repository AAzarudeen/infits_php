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

$userId = $_POST['userId'];

// $userId = 'Rahul';

$sql = "select * from dietian_recipies where userId = '$userId'";

$result = mysqli_query($conn,$sql);

$emparray = array();

while ($row = mysqli_fetch_assoc($result)) {
    $emparray["name"] = $row["name"];
    $emparray["course"]=$row["course"];
    $emparray["category"] = $row["category"];
    $emparray["preparationTime"]=$row["preparationTime"];
    $emparray["cookingTime"]=$row["cookingTime"];
    $emparray["servings"] = $row["servings"];
    $emparray["protein"] = $row["protein"];
    $emparray["calories"] = $row["calories"];
    $emparray["fats"] = $row["fats"];
    $emparray["carbs"] = $row["carbs"];
    $emparray["fibres"] = $row["fibres"];
    $emparray["ingredientname"] = $row["ingredientname"];
    $emparray["ingredientquantity"] = $row["ingredientquantity"];
    $emparray["directions"] = $row["directions"];
    $emparray["image"]=$row["image"];
    $emparray["steps"]=$row["steps"];
  
    
    // $imageName = $row['name']."$dietianID.jpg";
	  // $image = 'upload/Recipies/'.$imageName;
	  // $type = pathinfo($image, PATHINFO_EXTENSION);
	  // $data = file_get_contents($image);
    // $emparray["image"] = base64_encode($data);
    $full[] = $emparray;
}

echo json_encode($full);

?>