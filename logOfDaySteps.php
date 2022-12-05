<?php

$server="127.0.0.1:3307";
$username="root";
$password="";
$database = "infits";

$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$today = date('Y-m-d');

// $clientID = $_POST['userID'];

$clientID = 'Azarudeen';

$sql = "SELECT * 
FROM stepTracker
WHERE clientID='$clientID' AND `dateandtime` = '$today';";

$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray['steps'] = $row['steps'];
        $emparray['date'] = date("d-m-Y",strtotime($row['dateandtime']));
        $emparray['avgspeed'] = $row['avgspeed'];
        $emparray['distance'] = $row['distance'];
        $emparray['calories'] = $row['calories'];
        $full[] = $emparray;
    }
    echo json_encode(['water' => $full]);
?>