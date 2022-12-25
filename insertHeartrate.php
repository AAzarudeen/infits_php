<?php
require "connect.php";
// Create connection
$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// $clientid = $_POST['clientID'];

$clientid = "Azarudeen";

// $date = $_POST['date'];

$date = "2022-12-23 11:32:10";

// $value = $_POST['value'];

$value = 32;

$sql = "insert into heartrate VALUES ('$clientid','$date', '$value');";
    try {
        if($conn->query($sql)){
            $conn2=mysqli_connect($server,$username,$password,$database);
            $sql = "select value from heartrate where clientID='$clientid' AND cast(date as date) = CURRENT_DATE ";
            
            
            $result = mysqli_query($conn2, $sql) or die("Error in Selecting " . mysqli_error($connection));
            
                $emparray = array();
                $value = array();
                while($row =mysqli_fetch_assoc($result))
                {
                    array_push($value,$row['value']);
                    $average = array_sum($value)/count($value);
                    $emparray['avg'] = $average;
                    $emparray['max'] = max($value);
                    $emparray['min'] = min($value);
                    $full[] = $emparray;
                }
                echo json_encode(['heart' => $full]);
        }
    } catch (mysqli_sql_exception $th) {
        echo "Error";
        echo $th;
    }  
?>