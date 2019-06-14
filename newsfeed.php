<?php
include_once("database.php");
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['name']))
{
	$id = $_SESSION['id'];
	$name = $_SESSION['name'];
	if(isset($_POST["text"]) || isset($_FILES["photo"]))
	{
		$text = $_POST["text"];
		$profile = "";
		if(isset($_FILES["photo"]))
		{
			$profile = $_FILES["photo"];
			$profile_name = $profile['name'];
			$profile_location = $profile['tmp_name'];
			$profile_size = $profile['size'];
			$profile_error = $profile['error'];
		
			$profile_ext = explode(".",$profile_name);
			$profile_ext = strtolower(end($profile_ext));
			if($profile_ext === "jpg" || $profile_ext === "png")
		{
			if($profile_error === 0)
			{
				if($profile_size < 5000000)
				{
					$des = "photos/".$profile_name;
				
				if(move_uploaded_file($profile_location,$des))
				{

					$query = mysqli_query($con,"INSERT  INTO posts(user_id,post_text,post_img)VALUES('$id','$text','$profile_name')") or die("could not update database");
					$message = "Profile picture uploaded successfully";
					
				}
				else
				{
					$message = "Can't set picture"; 
				}
				}
				else
				{
					$message = " picture is too large";
				}
			}
			else
			{
				$message = "Error in uploading the  picture.";
			}
		}
		else
		{
			$message = "pls upload jpg file or  png file for your profile picture.";
		}
		
		
		}
		else
		{
			$query = mysqli_query($con,"INSERT INTO posts(user_id,post_text,post_img)VALUES('$id','$text',''");
		}

		
		
	}
}
else
{
	header("Location:login.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>

body
{
	background-color:aqua;
}

#friends
{
	border-right:1px solid black;
	border-bottom:1px solid black;
	height:500px;
	overflow:auto;
	width:300px;
	float:left;
}

#friend
{
	padding:10px;
	width:100%;
	cursor:pointer;
	background-color: aqua;

}
#friend:hover
{
	background-color:lightgrey;
}

#messages
{
	position:absolute;
	height:340px;
	width:300px;
	border:1px solid blue;
	right:0px;
	bottom:0px;
	overflow:auto;
	float:right;
}

#msg
{
	width:100%;
	position:absolute;
	right:0px;
	bottom:0px;
}
#post_container
{
	height:auto;
	width:30%;
	background-color:white;
	float:right;
	position:relative;
	left:-500px;
}

#new_post
{
	height:250px;
	border:1px solid black;
	width:100%;
}

#post_text
{
	width:100%;
	height:70%;
}

.fileUpload {
    position: relative;
    overflow: hidden;
    margin: 10px;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}

#bla{
	width:100%;
	overflow:auto;
}

#notifications
{
	position:absolute;
	right:0px;
	top:0px;
	width:25%;
	height:40%;
	border:1px solid black;	
}
#notif
{
	width:100%;
	height:100%;
	overflow:auto;
}

#each_notif
{
	width:100%;
	height:auto;
	padding:5px;
	border:1px solid black;
}
</style>
</head>

<body>
<div id = "user" data-id = "<?php echo $id;?>"></div>
<div id = "friends">
	<?php
	//echo $id;
		$query = mysqli_query($con,"SELECT * FROM users WHERE id in (SELECT friend2 FROM friends WHERE  friend1 = '$id')") or die("could not find friends in database");
		while($row = mysqli_fetch_assoc($query)):
	?>
	<div id = "friend" data-id = "<?php echo $row["id"]?>" onclick = "set_id(this)">
	<?php echo $row["name"]?>
	</div>
	<?php
	endwhile;
	?>

</div>

<div id = "notifications">
	<div id = "notif">
		
	</div>
</div>
<div id = "post_container">
	<div id = "new_post">
		<p>create new post</p>
		<form method = "post" action = "newsfeed.php" enctype = "multipart/form-data">
		<textarea id = "post_text" class = "form-control" name = "text"></textarea>
		<input type = "submit" class = "btn btn-primary">
		<div class="fileUpload btn btn-primary">
    	<span>Upload Photo</span>
    	
    	<input type="file" class="upload"  name = "photo"/>
</div>
		</form>
	</div>

	<div id = "posts">
	<?php
		$query = mysqli_query($con,"SELECT p.post_id,p.post_img,p.post_text,u.name FROM posts p JOIN users u ON p.user_id = u.id WHERE p.user_id in (SELECT friend2 FROM friends WHERE friend1 = '$id') ORDER BY post_id DESC") or die("could not find posts");
			
		while ($row = mysqli_fetch_assoc($query)):
			
	?>
	<div id = "post" style = "border:1px solid blue;">
	<p> <?php echo $row["name"]?></p>
	<p><?php echo $row["post_text"]?></p>
	<?php
	
	if($row["post_img"] != "")
	{
		echo '<p><img src = "photos/'.$row["post_img"].'" style = "height:300px; width:300px;"></p>';
	}
	?>
	</div>
	<div id = "likebox">
	<p>
	<button onclick = "send_like(this)" data-postid = "<?php echo $row["post_id"]?>" data-id = "<?php echo $id?>" id = "<?php echo "like".$row["post_id"]?>" class = "btn btn-primary">like</button>
	<span id = "num_likes"><?php
	$post_id = $row["post_id"];
			$query2 = mysqli_query($con,"SELECT count(post_id) as count_likes from likes where post_id = '$post_id'") or die("could not select from database");
			$row1 = mysqli_fetch_assoc($query2);
	echo $row1["count_likes"]
	?></span>
	</p>
	</div>
	<div id = "comments">
	<textarea id = "<?php echo $post_id . '_comment';?>"></textarea>
	<input type = "submit" data-id = "<?php echo $_SESSION["id"];?>" data-postid = "<?php echo $row["post_id"]?>" onclick = "send_comment(this)">
	<?php
	$p = $row["post_id"];
	//$post_id = $row["post_id"];
	$query2 = mysqli_query($con,"SELECT u.name, c.comment FROM comments c join users u on c.user_id = u.id where post_id ='$p'") or die("kia  hai yaar");
	while($row2 = mysqli_fetch_assoc($query2))
	{
	
	echo '<p>

	<b>'.$row2["name"].'</b>'.$row2["comment"].'</p>';
	}
	?>
	</div>
	<?php
	endwhile;?>
	</div>
</div>

<div id = "messages">
<div id = "bla">
</div>
<input type = "text" id = "msg" class = "form-control" onKeyPress="checkSubmit(event,this)">

</div>

<div id = "test" style = "position:absolute; top:0px; right:0px; overflow:auto;">
hello
</div>

<!-- javascript -->
<script>
//var id = 67;
function checkSubmit(e,x) {

   if(e && e.keyCode == 13) {

   		console.log("oye");
      	var message = document.getElementById("msg").value;
      	document.getElementById("msg").value = "";
      	var xhttp = new XMLHttpRequest();
      	xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
     	document.getElementById("test").innerHTML = this.responseText;
    	}
  		};
  		xhttp.open("GET", "message.php?msg=" + message+"&id=" + id, true);
  		xhttp.send();

   }
}

function set_id(x)
{
	id = x.getAttribute("data-id");
}
function show_message(x)
{
	
	var xhttp = new XMLHttpRequest();
      	xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
     	document.getElementById("bla").innerHTML = this.responseText;
     	//alert(this.responseText);
    	}
  		};
  		xhttp.open("GET", "show_message.php?id=" + id, true);
  		xhttp.send();
}

function send_comment(x)
{
	id  = x.getAttribute("data-id");
	post_id  = x.getAttribute("data-postid"); 
	var comment = document.getElementById(post_id + "_comment").value;
	var xhttp = new XMLHttpRequest();
      	xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
     	document.getElementById("test").innerHTML = this.responseText;
     	alert(this.responseText);
    	}
  		};
  		alert(id + " " + comment + " " + post_id);
  		xhttp.open("GET", "comment.php?comment=" + comment+"&id=" + id + "&post_id="+post_id, true);
  		xhttp.send();

	//alert(comment);
}

function show_comments(x)
{
	id  = x.getAttribute("data-id");
	document.getElementById()
}

function send_like(x)
{
	id = x.getAttribute("data-id");
	post_id = x.getAttribute("data-postid");

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
    		var res = this.responseText;
    		if(res != 'liked')
    		{
    			document.getElementById("like"+post_id).innerHTML = this.responseText;
    			document.getElementById("like"+post_id).innerHTML = "liked";
    			alert(res);
    		}
		
	

     	//alert(this.responseText);
    	}
  		};
  		xhttp.open("GET", "likes.php?id=" + id+"&post_id=" + post_id, true);
  		xhttp.send();

}
var x = document.getElementById("user");
var user_id = x.getAttribute("data-id");
function show_notifications()
{
	//alert();
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
    		//alert(this.responseText);
    		document.getElementById("notif").innerHTML = this.responseText;
    
    				}
  		};
  		xhttp.open("GET", "notifications.php?id="+user_id, true);
  		xhttp.send();
}



setInterval(show_message,200);
setInterval(show_notifications,1000);
</script>
</body>
</html>