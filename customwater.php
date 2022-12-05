<?php

function getArr($from,$to){
    $server="127.0.0.1:4307";
    $username="root";
    $password="";
    $database = "infits"; 
    
    $conn=mysqli_connect($server,$username,$password,$database);
    
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
        $sql = "select steps,dateandtime from steptracker where clientID = 'Azarudeen' and dateandtime between '$from' and '$to';";
    
        $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));
        
            $emparray = array();
            $mon = array();
            $count=0;
            while($row =mysqli_fetch_assoc($result))
            {
                $mon[] = $row['steps'];
            }
            $sig = 0;
            for ($i=0; $i < count($mon) ; $i++) { 
                $sig = $sig + $mon[$i];
            }
            return $sig/count($mon);
}

$server="127.0.0.1:3307";
$username="root";
$password="";
$database = "infits";

$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// $date_one = date('Y-m-d', strtotime("2022-02-01"));

// $date_two = date('Y-m-d', strtotime("2022-06-10"));
$clientID = $_POST['clientID'];
$date_one = date('Y-m-d', strtotime($_POST['from']));
$date_two = date('Y-m-d',strtotime($_POST['to']));
    // echo $date_one;
    // echo $date_two;
    $diff = date_diff(date_create($date_one), date_create($date_two));

    if ((int)$diff->format('%d') <= 30 and $diff->format('%m') == 0  and $diff->format('%y') == 0) {
    $sql = "select steps,dateandtime from steptracker where clientID = '$clientID' and dateandtime between '$date_one' and '$date_two';";

    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
      $emparray['date'] = date("d",strtotime($row['dateandtime']));
      $emparray['steps'] = $row['steps'];
      $full[] = $emparray;
    }
    echo json_encode(['steps' => $full]);
    }
    else{
        $from = array();
        $to = array();
        $start = date('m',strtotime($date_one));
        $startDay = date('d',strtotime($date_one));
        $startMonth = date('m',strtotime($date_one));
        $startYear = date('Y',strtotime($date_one));

        $end = date('m',strtotime($date_two));
        $endDay = date('d',strtotime($date_two));
        $endMonth = date('m',strtotime($date_two));
        $endYear = date('Y',strtotime($date_two));

        for($i = $start;$i <= $endMonth;$i++){
            if ($i == $start) {
                $from[] = date('Y-m-d',strtotime("$startYear-$i-$startDay"));    
            }
            else {
                $from[] = date('Y-m-01',strtotime("$startYear-$i"));
            }
            if ($i == $endMonth) {
                $to[] = date('Y-m-d',strtotime("$endYear-$i-$endDay"));    
            }
            else {
                $to[] = date('Y-m-31',strtotime("$endYear-$i-$endDay"));
            }
        }
        $avgArr = array();
        for ($i=0; $i <= $diff->format('%m'); $i++) { 
            $avgArr['steps'] = getArr($from[$i],$to[$i]);
            $avgArr['date'] = $i+1;
            $avgJson[] = $avgArr;
        }
        echo json_encode(['steps' => $avgJson]);   
    }
?>