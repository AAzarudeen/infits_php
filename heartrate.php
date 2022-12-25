<?php
require "connect.php";

$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$today = date('Y-m-d');

$from = date('Y-m-d', strtotime('-8 days', strtotime($today)));

$to = date('Y-m-d', strtotime('1 days', strtotime($today)));

// $clientID = $_POST['clientID'];

$clientID = "Azarudeen";

$sql = "select cast(date as time),cast(date as date),value from heartrate where clientID='$clientID' AND cast(date as date) between '$from' and '$to' AND cast(date as time) IN (
    SELECT MAX(cast(date as time)) 
    FROM heartrate
        
    GROUP BY DATE(cast(date as date))
    );";


$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    $value = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray['date'] = $row['cast(date as date)'];
        array_push($value,$row['value']);
        $average = array_sum($value)/count($value);
        $emparray['avg'] = $average;
        $emparray['max'] = max($value);
        $emparray['min'] = min($value);
        $full[] = $emparray;
    }
    echo json_encode(['heart' => $full]);
?>