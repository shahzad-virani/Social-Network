<?php
include_once("database.php");

if(isset($_GET["id1"]) && isset($_GET["id2"]))
{
$id1 = $_GET["id1"];
$id2 = $_GET["id2"];

$query = mysqli_query($con,"UPDATE friends set request_accepted = '1'  where (friend1 = '$id2' and friend2 = '$id1') or (friend1 = '$id1' and friend2 = '$id2')") or die("could not insert friend into database");
$query = mysqli_query($con,"UPDATE friends set request_sent = '0'  where (friend1 = '$id2' and friend2 = '$id1') or (friend1 = '$id1' and friend2 = '$id2')") or die("could not insert friend into database");
$query1 = mysqli_query($con,"INSERT INTO notifications(user_id1,user_id2,type)VALUES('$id1','$id2','accept')");
}
echo $id1. " " . $id2 ;

?>