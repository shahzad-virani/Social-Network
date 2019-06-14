<?php
include_once("database.php");
if(isset($_GET["id1"]) && isset($_GET["id2"]))
{
$id1 = $_GET["id1"];
$id2 = $_GET["id2"];

$query = mysqli_query($con,"INSERT INTO friends(friend1,friend2,request_sent)VALUES('$id1','$id2',1)") or die("could not insert friend into database");
$query = mysqli_query($con,"INSERT INTO friends(friend1,friend2,request_sent)VALUES('$id2','$id1',1)") or die("could not insert friend into database");
$query1 = mysqli_query($con,"INSERT INTO notifications(user_id1,user_id2,type)VALUES('$id1','$id2','request')");
echo $id1. " " . $id2 ;

}

?>


 