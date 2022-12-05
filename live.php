<?php

$server="127.0.0.1:4307";
$username="root";
$password="";
$database = "infits";

$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$dietitianuserID = $_POST['dietitianuserID'];
// $dietitianuserID = "Rahul";

$sql = "select * from live where dietitianuserID = '$dietitianuserID';";

$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray['dietitianuserID'] = $row['dietitianuserID'];
        $emparray['date'] = date("Y-m-d",strtotime($row['dateandtime']));
        $emparray['time'] = date("G:i:s",strtotime($row['dateandtime']));
        $emparray['title'] = $row['title'];
        $emparray['note'] = $row['note'];
        $emparray['status'] = $row['status'];
        $full[] = $emparray;
    }
    echo json_encode(['live' => $full]);
?>