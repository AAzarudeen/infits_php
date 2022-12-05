<?php

$server="127.0.0.1:4307";
$username="root";
$password="";
$database = "sample";

$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$date = date("d-m-Y");

$sql = "select value from sleeptracker where name = 'Azarudeen A' ORDER BY time DESC LIMIT 1";

$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while($row = mysqli_fetch_assoc($result))
    {
        print_r($row);
        $emparray['drink'] = $row['value'];
        $full[] = $emparray;
    }
    echo json_encode(['water' => $full]);

?>