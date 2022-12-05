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

$from = date('Y-m-d', strtotime('-8 days', strtotime($today)));

$to = date('Y-m-d', strtotime('1 days', strtotime($today)));

$clientID = $_POST['clientID'];

// $clientID = "Azarudeen";

// $sql = "SELECT * 
// FROM watertracker
// WHERE clientID='$clientID' AND `date` between '$from' and '$to' AND `time` IN (
//   SELECT MAX(`time`) 
//   FROM watertracker
    
//   GROUP BY DATE(`date`)
//  );";

$sql = "SELECT SUM(amount) ,date
FROM watertracker
WHERE clientID='$clientID' AND `date` between '$from' and '$to' GROUP BY Cast(date as date) ORDER BY Cast(date as date)";

$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
      $emparray['date'] = date("d-m-Y",strtotime($row['date']));
      $emparray['water'] = $row['SUM(amount)'];
      // $emparray['water'] = $row['drinkConsumed'];
      $full[] = $emparray;
    }
    echo json_encode(['water' => $full]);
?>