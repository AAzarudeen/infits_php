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
$question = $_POST['question'];
$question = json_decode($question, TRUE);

$answer = $_POST['answer'];
$answer = json_decode($answer, TRUE);

$userID = $_POST['clientID'];

//$tablename = $_POST['tablename'];

// $question = array("Q1", "Q2", "Q3");
// $answer = array("A1", "A2", "A3");

$sql = "select * from clientcon where ClientName='$userID'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 0){
    for($i = 0; $i < count($question); $i++) {

        $sql = "insert into clientcon VALUES ('$userID','$question[$i]','$answer[$i]');";
    
        try {
            if($conn->query($sql)){
                echo "success";
            }
        } catch (mysqli_sql_exception $th) {
            echo $th;
        }
    
    }
}
else{
    for($i = 0; $i < count($question); $i++) {

        $sql = "update clientcon set answers = '$answer[$i]' where question = '$question[$i]' and ClientName = '$userID'";
    
        try {
            if($conn->query($sql)){
                echo "success";
            }
        } catch (mysqli_sql_exception $th) {
            echo $th;
        }
    
    }
}    
?>