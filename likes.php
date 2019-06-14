<?php
include_once("database.php");

if(isset($_GET["id"]) && isset($_GET["post_id"]))
{
	$id = $_GET["id"];
	$post_id = $_GET["post_id"];

	$query = mysqli_query($con,"SELECT user_id from posts where post_id = '$post_id'");
	$row = mysqli_fetch_assoc($query);
	$user = $row["user_id"];
	$query = mysqli_query($con,"SELECT * FROM likes Where user_id = '$id' and post_id = '$post_id'");
	if(mysqli_num_rows($query) == 0)
	{
		$query = mysqli_query($con,"INSERT INTO likes(post_id,user_id) VALUES('$post_id','$id')") or die("could not insert like in database");
		$query = mysqli_query($con,"INSERT INTO notifications(user_id1,user_id2,type) VALUES('$id','$user','like')") or die("could not insert like in database");
		$query = mysqli_query($con,"SELECT count(post_id) as count_likes from likes where post_id = '$post_id'");
		$row = mysqli_fetch_assoc($query);
		echo $row["count_likes"];
	}
	else
	{
		echo 'liked';
	}
}
?>