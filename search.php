<?php
// get the q parameter from URL
include_once("database.php");
session_start();
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from "" 
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    $query = mysqli_query($con,"SELECT id,name FROM users WHERE name LIKE '$q%'") or die("could not find from database");
    if(mysqli_num_rows($query) == 0)
    {
    	echo "no user found";
    }
    else
    {

    	while($row = mysqli_fetch_assoc($query))
    	{

    		$id2 = $row["id"];
    		$id1 = $_SESSION["id"];
    		if($id1 != $id2)
    		{
    			
    		
    		$query1 = mysqli_query($con,"SELECT * FROM friends where friend2 = '$id2' and friend1 = '$id1' ");
    		if(mysqli_num_rows($query1) == 0)
    		{
    			echo '<p>'.$row["name"].'<span style = "margin-left:50px;" class = "btn btn-success" data-id = "'.$row["id"].'" onclick  = "friend_request(this)">send friend request</span></p>';
    		}
    		else
    		{
    		$row1 = mysqli_fetch_assoc($query1);
    		if($row1["request_sent"] == 1)
    		{
    			echo '<p>'.$row["name"].'<span style = "margin-left:50px;" class = "btn btn-success" data-id = "'.$row["id"].'">friend request sent</span></p>';
    		}
    		if($row1["request_accepted"] == 1)
    		{
    			echo '<p>'.$row["name"].'<span style = "margin-left:50px;" class = "btn btn-success" data-id ="'.$row["id"].'">friend</span></p>';
    		}


    		}
    	}


    	}
    }
	}

// Output "no suggestion" if no hint was found or output correct values 
?>