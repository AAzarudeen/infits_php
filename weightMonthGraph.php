<?php

$server="localhost:4307";
$username="root";
$password="";
$database = "infits";

$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// if ($_POST['option'] == 'Week') {
  $from = date("Y-m-d", strtotime("first day of this month"));
  $to = date("Y-m-d", strtotime("last day of this month"));

$clientID = $_POST['userID'];

  $sql = "select weight,date from weighttracker where clientID = '$clientID' and date between '$from' and '$to';";

  $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray['date'] = date("d",strtotime($row['date']));
        $emparray['weight'] = $row['weight'];
        $full[] = $emparray;
    }
    echo json_encode(['weight' => $full]);
?>