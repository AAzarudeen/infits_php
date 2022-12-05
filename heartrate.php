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

$from = date('Y-m-d', strtotime('-8 days', strtotime($today)));

$to = date('Y-m-d', strtotime('1 days', strtotime($today)));

// $clientID = $_POST['clientID'];

$clientID = "Azarudeen";

$sql = "select cast(date as time),cast(date as date),maximum from heartrate where clientID='$clientID' AND cast(date as date) between '$from' and '$to' AND cast(date as time) IN (
    SELECT MAX(cast(date as time)) 
    FROM heartrate
        
    GROUP BY DATE(cast(date as date))
    );";


$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray['date'] = $row['cast(date as time)'];
        $a = json_decode($row['maximum']);
        $average = array_sum($a)/count($a);
        $emparray['avg'] = $average;
        $emparray['min'] = min($a);
        $emparray['max'] = max($a);

        $full[] = $emparray;
    }
    echo json_encode(['heart' => $full]);
?>