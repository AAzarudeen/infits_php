<?php

function date_compare($a, $b)
{
    $t1 = $a['date'];
    $t2 = $b['date'];
    return $t1 - $t2;
}

$server="127.0.0.1:4307";
$username="root";
$password="";
$database = "infits";

$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$from = date('Y-m-d', strtotime("-6 day"));

$to = date('Y-m-d');

$end = date('Y-m-d',strtotime("1 day"));

$clientID = $_POST['userID'];

// $clientID = "dilip";

$sql = "SELECT * 
FROM watertracker
WHERE clientID='$clientID' AND `date` between '$from' and '$to' AND `time` IN (
  SELECT MAX(`time`) 
  FROM watertracker
    
  GROUP BY DATE(`date`)
 );";

$full = array();

$dateArr = array();

$dateArray = array();

$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));


    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray['drink'] = $row['drinkConsumed'];
        $emparray['date'] = date("d",strtotime($row['date']));
        $dateArray[] = date("d",strtotime($row['date']));
        $full[] = $emparray;
    }

    $missingDates = array();

    $dateStart = date_create($from);
    $dateEnd   = date_create($end);

    $interval  = new DateInterval('P1D');
    $period    = new DatePeriod($dateStart, $interval, $dateEnd);

    foreach($period as $day) {
      $formatted = $day->format("d");
      // echo gettype($formatted);
      if(!in_array($formatted, $dateArray)) {
        $missingDates['date'] = $formatted;
        $missingDates['drink'] = '0';
        $full[] = $missingDates;
    }}

    usort($full, 'date_compare');

    echo json_encode(['water' => $full]);
?>