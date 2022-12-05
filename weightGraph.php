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
  $from = date('Y-m-d', strtotime("-1 week"));

  $to = date('Y-m-d');

  $clientID = $_POST['userID'];

  // $clientID = "Azarudeen";

  $sql = "select weight,date from weighttracker where clientID = '$clientID' and date between '$from' and '$to';";

  $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray['weight'] = $row['weight'];
        $emparray['date'] = date("d",strtotime($row['date']));
        $full[] = $emparray;
    }
    echo json_encode(['weight' => $full]);
// }

// if ($_POST['option'] == 'Month') {
  
// }

?>