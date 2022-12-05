<?php

$server="127.0.0.1:4307";
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
FROM watertracker
WHERE clientID='$clientID' AND `date` = '$today';";

$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray['drink'] = $row['drinkConsumed'];
        $emparray['date'] = date("d-m-Y",strtotime($row['date']));
        $emparray['type'] = $row['type'];
        $emparray['time'] = $row['time'];
        $emparray['amount'] = $row['amount'];
        $full[] = $emparray;
    }
    echo json_encode(['water' => $full]);
?>