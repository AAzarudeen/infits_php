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

// $sql = "select SUM(hrsSlept),SUM(minsSlept),date from sleeptracker where clientID = 'Azarudeen' and date BETWEEN '2022-09-01' and '2022-09-02' GROUP BY (date) ORDER BY date";

$sql = "select SUM(hrsSlept),SUM(minsSlept),waketime from sleeptracker where clientID = '$clientID' and waketime BETWEEN '$from' and '$to' GROUP BY Cast(waketime as date) ORDER BY Cast(waketime as date)";

// $sql = "select hrsSlept,waketime from sleeptracker where clientID = '$clientID' and waketime between '$from' and '$to';";

$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
      $emparray['date'] = date("d-m-Y",strtotime($row['waketime']));
      if ($row['SUM(minsSlept)'] >= 60) {
        $emparray['hrsSlept'] = ($row['SUM(hrsSlept)']+1)." Hrs ".($row['SUM(minsSlept)']-60)." Mins ";
      }
      else {
        $emparray['hrsSlept'] = $row['SUM(hrsSlept)']." Hrs ".$row['SUM(minsSlept)']." Mins ";
      }
      $full[] = $emparray;
    }
    echo json_encode(['sleep' => $full]);
?>