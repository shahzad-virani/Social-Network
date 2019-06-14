<?php
include_once("database.php");
session_start();
if(isset($_REQUEST['id']))
{
	$sender_id = $_SESSION['id'];
	$receiver_id = $_REQUEST['id'];
	$query = mysqli_query($con,"SELECT * FROM messages WHERE (sender_id = '$sender_id' AND receiver_id = '$receiver_id') OR (sender_id = '$receiver_id' AND receiver_id = '$sender_id') ORDER BY id ASC") or die("could not find messages from database");
	while($row = mysqli_fetch_assoc($query))
	{
		if($row["sender_id"] == $sender_id)
		{
			echo '<p id = "sender" style = "float:right"> '.$row["message"].' </p>';
		}
		if($row["sender_id"] == $receiver_id)
		{
			echo '<p id = "reciever" style = "float:left"> '.$row["message"].' </p>';
		}
		echo '<div style = "clear:both"></div>';

	}
}
?>