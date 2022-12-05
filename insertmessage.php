<?php
$server="127.0.0.1:4307";
$username="root";
$password="";
$database = "infits";
// Create connection
$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$message = $_POST['message'];

$messageby = $_POST['messageby'];

$clientid = $_POST['clientid'];

$dietitianid = $_POST['dietitianid'];
$unread = $_POST['unread'];

$time = $_POST['time'];


//$tablename = $_POST['tablename'];

//$question = array("Q1", "Q2", "Q3");
//$answer = array("A1", "A2", "A3");




    $sql = "insert into messages VALUES ('$dietitianid', '$clientid', '$message', 'messageby', '$time', '$unread');";

    try {
        if($conn->query($sql)){
            echo "success";
        }
    } catch (mysqli_sql_exception $th) {
        echo "Error";
    }


    
?>