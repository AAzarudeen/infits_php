<?php

$server="127.0.0.1:4307";
$username="root";
$password="";
$database = "infits";

$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$from = date("Y-m-d", strtotime("first day of this month"));
$to = date("Y-m-d", strtotime("last day of this month"));

$clientID = $_POST['userID'];

// $clientID = "dilip";

$sql = "SELECT * 
FROM watertracker
WHERE clientID='$clientID' AND `date` between '$from' and '$to' AND `time` IN (
  SELECT MAX(`time`) 
  FROM watertracker
    
  GROUP BY DATE(`date`)
 );";

$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray['drink'] = $row['drinkConsumed'];
        $emparray['date'] = date("d",strtotime($row['date']));
        $full[] = $emparray;
    }
    echo json_encode(['water' => $full]);
?>