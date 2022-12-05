<?php 

$server="127.0.0.1:4307";
$username="root";
$password="";
$database = "infits";

$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$userId = $_POST['userId'];
$name = $_POST['name'];
// $time = $_POST['time'];
$course = $_POST['course'];
$category = $_POST['category'];
$preparationTime = $_POST['preparationTime'];
$cookingTime = $_POST['cookingTime'];
$servings = $_POST['servings'];
$proteins = $_POST['protein'];
$fats = $_POST['fats'];
$fibres = $_POST['fibres'];
$carbs = $_POST['carbs'];
$calories = $_POST['calories'];
$ingredientname =$_POST['ingredientname'];
$ingredientquantity =$_POST['ingredientquantity'];
$directions =$_POST['directions'];
$image =$_POST['image'];
$steps= $_POST['steps'];
// $steps ="47";

// $dietianID = $_POST['dietianID'];
// $name = $_POST['name'];
// $time = $_POST['time'];
// $serving = $_POST['serving'];
// $link = $_POST['link'];
// $image = $_POST['image'];
// $calories = $_POST['calories'];
// $proteins = $_POST['proteins'];
// $fats = $_POST['fats'];
// $fibres = $_POST['fibres'];
// $carbs = $_POST['carbs'];
// $ingredient = $_POST['ingredients'];
// $instruction = $_POST['instruction'];
// $files = $_POST['files'];
// $category = $_POST['category'];


mysqli_query($conn,"INSERT into dietian_recipies VALUES('$userId','$name','$course','$category','$preparationTime',
'$cookingTime','$servings','$proteins','$fats','$fibres','$carbs','$calories','$ingredientname','$ingredientquantity','$directions','$image','$steps')");
mysqli_close($conn);

// $sql = "insert into dietian_recipies values('$name','$time',$serving,'$link','$calories','$proteins','$fats','$fibres','$carbs','$ingredient','$instruction','$category','$dietianID','$image',$files)";

// if (mysqli_query($conn,$sql)) {
//   if (file_put_contents("upload/Recipies/"."$name$dietianID",base64_decode($image))){
//     echo "updated";
// }
// }
// else {
//     echo "failure";
// }

?>
