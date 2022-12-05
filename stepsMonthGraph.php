<?php

$server="127.0.0.1:3307";
$username="root";
$password="";
$database = "infits";

$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$from = date("Y-m-d", strtotime("first day of this month"));
$to = date("Y-m-d", strtotime("last day of this month"));



$sql = "select steps,dateandtime from steptracker where clientID = 'Azarudeen' and dateandtime between '$from' and '$to';";

$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray['date'] = date("d",strtotime($row['dateandtime']));
        $emparray['steps'] = $row['steps'];
        $full[] = $emparray;
    }
    echo json_encode(['steps' => $full]);
?>