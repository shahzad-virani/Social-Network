<?php
include_once("database.php");

if(issset($_GET['post_id']))
{
	$post_id = $_GET['post_id'];
	$query = mysqli_query($con,"SELECT count(post_id) as count_likes from likes where post_id = '$post_id'");
	$row = mysqli_fetch_assoc($query);
	echo $row["count_likes"];
}
?>