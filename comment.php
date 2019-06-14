<?php
include_once("database.php");

if(isset($_GET["comment"]) && isset($_GET["id"]) && isset($_GET["post_id"]))
{
	$comments = $_GET["comment"];
	$id = $_GET["id"];
	$post_id = $_GET["post_id"];
	
	$query = mysqli_query($con,"SELECT user_id from posts where post_id = '$post_id'");
	$row = mysqli_fetch_assoc($query);
	$user2 = $row["user_id"];
	$query = mysqli_query($con,"INSERT INTO comments(post_id,user_id,comment) VALUES('$post_id','$id','$comments')") or die("could not insert comments into database");

	$query = mysqli_query($con,"INSERT INTO notifications(user_id1,user_id2,type) VALUES('$id','$user2','comment')") or die("could not insert notifications into database");


}
?>