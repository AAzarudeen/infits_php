<?php
function date_compare($a, $b)
{
    $t1 = $a['date'];
    $t2 = $b['date'];
    return $t1 - $t2;
}

require "connect.php";


$clientID = $_POST['clientuserID'];

// $clientID = 'dilip';

$from = date('Y-m-d', strtotime("-6 day"));

$to = date('Y-m-d');

$end = date('Y-m-d',strtotime("1 day"));


$sql = "SELECT * FROM steptracker where clientID = '$clientID' and cast(dateandtime as date) between '$from' and '$to' GROUP BY cast(dateandtime as date) order by dateandtime";

$full = array();

$dateArr = array();

$dateArray = array();

$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));
    while($row =mysqli_fetch_assoc($result))
    {

      $emparray['date'] = date("d",strtotime($row['dateandtime']));
      $emparray['steps'] = $row['steps'];
      
      $dateArray[] = date("d",strtotime($row['dateandtime']));

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
        $missingDates['steps'] = '0';
        $full[] = $missingDates;
    }}

    usort($full, 'date_compare');

    echo json_encode(['steps' => $full]);
?>