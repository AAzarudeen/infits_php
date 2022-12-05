<?php

require "connect.php";

$from = date("Y-m-d", strtotime("first day of this month"));
$to = date("Y-m-d", strtotime("last day of this month"));

$clientID = $_POST['userID'];

$sql = "select hrsSlept,sleeptime from sleepTracker where clientID = '$clientID' and sleeptime between '$from' and '$to';";

$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray['date'] = date("d",strtotime($row['sleeptime']));
        $emparray['hrsSlept'] = $row['hrsSlept'];
        $full[] = $emparray;
    }
    echo json_encode(['sleep' => $full]);
?>