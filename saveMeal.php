<?php
$server="127.0.0.1:4307";
$username="root";
$password="";
$database = "infits";
// Create connection
$conn = new mysqli($server, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['clientID'];

$name = $_POST['name'];

$date = $_POST['date'];

$time = $_POST['time'];

$meal = $_POST['timeMeal'];

$description = $_POST['description'];

$image = $_POST['image'];

$postion = $_POST['position'];

// $username = "Azar";

// $name = 'Dosa';

// $date = '22-09-2022';

// $time = '11-54 pm';

// $meal = 'Breakfast';

// $description = 'With Ghee';

// $image = 'image';


// echo $meal;

$sql = "insert into mealtracker value('$name','$description','$name$date$time','$date','$time','$meal','$username',$postion);";

if (mysqli_query($conn,$sql)) {
    echo 'updated';
    file_put_contents("upload/mealTracker/$name"."$date"."$time".".jpg",base64_decode($image));
}

?>