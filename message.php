<?php
session_start();
include_once("database.php");
if(isset($_REQUEST['msg']))
{

	$message = $_REQUEST['msg'];
	$receiver_id = $_REQUEST['id'];
	$sender_id = $_SESSION['id'];

	$query = mysqli_query($con,"INSERT INTO messages(sender_id,receiver_id,message)VALUES('$sender_id','$receiver_id','$message')") or die("could not insert into database");
	echo $message;
}

?>