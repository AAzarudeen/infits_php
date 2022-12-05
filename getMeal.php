<?php
// header("Content-type: image/png");

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

$date = $_POST['date'];

// $meal = $_POST['timeMeal'];

// $username = "Azarudeen";

// $date = date("d M Y");

// $date = "10 Aug 2022";

// $meal = 'breakfast';

$sql = "select * from mealtracker where clientID = '$username' and date = '$date';";

$result = mysqli_query($conn,$sql);

$emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray['name'] = $row['name'];
        $emparray['time'] = date("h.i.s a",strtotime($row['time']));
        $emparray['description'] = $row['description'];
        $emparray['meal'] = $row['meal'];
        $imageName = $row['name'].$date.$row['time'].".jpg";
  	    $image = 'upload/mealTracker/'.$imageName;
	      $type = pathinfo($image, PATHINFO_EXTENSION);
	      $data = file_get_contents($image);
        $emparray['image'] = base64_encode($data);
        $emparray['position'] = $row['position'];
        $full[] = $emparray;
    }
    echo json_encode(['meal' => $full]);
?>