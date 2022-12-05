<?php    

$server="localhost:4307";
$username="root";
$password="";
$database = "infits";

$conn=mysqli_connect($server,$username,$password,$database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$list=array();
for($d=1; $d<=31; $d++)
{
    $time=mktime(12, 0, 0, date("m",strtotime("01-12-2022")), $d, date('Y'));
    if (date('m', $time)==date('m',strtotime("01-12-2022")))
        $list[]=date('Y-m-d', $time);
}
print_r($list);

for ($i=0; $i < 31; $i++) { 

    $r = rand(0,12);

    $rb = rand(0,60);
    
    $sql = "insert into sleeptracker values('$list[$i] 10:10','$list[$i] 06:00','Azarudeen',$r,8,$rb)";
    try {
        if($conn->query($sql)){
            echo "success";
        }
    } catch (mysqli_sql_exception $th) {
        echo $th;
    }

}

?>