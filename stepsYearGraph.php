<?php

function getArr($from,$to,$clientID){
    
    require "connect.php";
    
    $sql = "select steps,dateandtime from steptracker where clientID = '$clientID' and dateandtime between '$from' and '$to';";

    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));
    
        $emparray = array();
        $mon = array();
        while($row =mysqli_fetch_assoc($result))
        {
            $emparray['date'] = date("Y-m-d",strtotime($row['dateandtime']));
            $emparray['steps'] = $row['steps'];
            $full[] = $emparray;
            $mon[] = $row['steps'];
        }
        
        $sig = 0;
        for ($i=0; $i < count($mon) ; $i++) { 
            $sig = $sig + $mon[$i];
        }
        return $sig/count($mon);
}

$from = array("2022-01-01","2022-02-01","2022-03-01","2022-04-01","2022-05-01","2022-06-01","2022-07-01","2022-08-01","2022-09-01","2022-10-01","2022-11-01","2022-12-01");
$to = array("2022-01-31","2022-02-28","2022-03-31","2022-04-30","2022-05-31","2022-06-30","2022-07-31","2022-08-30","2022-09-31","2022-10-30","2022-11-31","2022-12-30");
$clientID = $_POST['userID'];
    $avgArr = array();
    for ($i=0; $i < 12 ; $i++) { 
        $avgArr['av'] = getArr($from[$i],$to[$i],$clientID);
        $avgJson[] = $avgArr;
    }
    echo json_encode(['steps'=>$avgJson]);
?>