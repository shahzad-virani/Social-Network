<?php
include_once("database.php");

$query = mysqli_query($con,"INSERT INTO friends(friend1,friend2,request_accepted) VALUES('68','65',true)") or die("could not insert friend");
?>