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
		if(isset($_FILES["photo"]) || isset($_FILES["text"]))
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
			$query = mysqli_query($con,"INSERT INTO posts(user_id,post_text,post_img)VALUES('$id','$text',''") or die("not post");
		}

		
		
	}
}
else
{
	header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="homecss.css">
    <title>YouNited | HOME</title>
</head>
    
<body>
<div id = "user" data-id = "<?php echo $id;?>"></div>
<nav class="navbar navbar-toggleable-md navbar-bg-primary" id="mynav" >
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">YouNited</a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Profile</a>
      </li>
	  <?php
        echo'<a href = "login.php?id='.$id.'" style = "text-decoration:none;"><button class="btn btn-danger navbar-btn" style="align:left">Logout</button></a>';
		?>
	</ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" onkeyup="showHint(this.value)">
    
	  
    </form>
  </div>
</nav>

    <div class="container">
            <div class="col-md-2" id="fonline" style="height:85vh">
                <div class="panel panel-default">
                   
                    <div class="panel-body">
                        <div class="list-group" id = "friends">
                            <button type="button" class="list-group-item"><div class="grad"></div>&nbsp; Faseih Saad</button>
                            
							
                        </div>
                    </div>
                </div>
            </div>
			
			<div id = "txtHint" style = "z-index:10;display:none; top:100px; right:100px; position:fixed; background-color:yellow">
			</div>
            <div class="col-md-6" id="posts" style="height:90vh">
			
			<div id = "new_post">
		<p>create new post</p>
		<form method = "post" action = "home.php" enctype = "multipart/form-data">
		<textarea id = "post_text" class = "form-control" name = "text"></textarea>
		<input type = "submit" class = "btn btn-primary">
		<div class="fileUpload btn btn-primary">
    	<span>Upload Photo</span>
    	
    	<input type="file" class="upload"  name = "photo"/>
		</div>
		</form>
	</div>
				<?php
		$query = mysqli_query($con,"SELECT p.user_id,p.post_id,p.post_img,p.post_text,u.name FROM posts p JOIN users u ON p.user_id = u.id WHERE p.user_id in (SELECT friend2 FROM friends WHERE friend1 = '$id') ORDER BY post_id DESC") or die("could not find posts");
			
		while ($row = mysqli_fetch_assoc($query)):
			
	?>
                <div id="postbox">
                    <div id="postinfo">
						<?php
						$uid = $row["user_id"];
						$query6 = "SELECT * FROM profile WHERE id = '$uid'";
						$query6 = mysqli_query($con,$query6);
						$row5 = mysqli_fetch_assoc($query6);
						echo '<img class="img-responsive" src="profile_pics/'.$uid.'/'.$row5["profile_pic"].'" id="linkbyimg">';
						?>
                        
                        <p class ="poststart"><a class="linkby" href="#"><?php echo $row["name"]?></a> added a new post</p>
                    </div>
                    <p class="time">09:10 pm</p>
                    <p class="postcaption"> <?php echo $row["post_text"]?> </p>
					<?php
	
	if($row["post_img"] != "")
	{
		echo '<p><img src = "photos/'.$row["post_img"].'" class="img-responsive" id="postimg" ></p>';
	}
	?>
                    
                    <div  id="likecomment">
                        <button type="button" class="btn btn-default" onclick = "send_like(this)" data-postid = "<?php echo $row["post_id"]?>" data-id = "<?php echo $id?>" id = "<?php echo "like".$row["post_id"]?>" class = "btn btn-primary">Like</button>
                        <span id = "num_likes"><?php
	$post_id = $row["post_id"];
			$query2 = mysqli_query($con,"SELECT count(post_id) as count_likes from likes where post_id = '$post_id'") or die("could not select from database");
			$row1 = mysqli_fetch_assoc($query2);
	echo $row1["count_likes"]
	?></span>
						<button id="comment" type="button" class="btn btn-default">Comment</button>
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
                    </div>
					
		<?php
	endwhile;?>
                 <div id="postbox">
                    <div id="postinfo">
                        <img class="img-responsive" src="faseih.jpg"id="linkbyimg">
                        <p class ="poststart"><a class="linkby" href="#">Faseih Saad</a> added a new post</p>
                    </div>
                    <p class="time">09:10 pm</p>
                    <p class="postcaption"> #Dying #ESES </p>
                    <img  class="img-responsive" src="cover.jpg" id="postimg">
                    <div  id="likecomment">
                        <button id="like" type="button" class="btn btn-default">Like</button>
                        <button id="comment" type="button" class="btn btn-default">Comment</button>
                    </div>
                    </div>
                
                <div id="postbox">
                 <div id="postinfo">
                        <img class="img-responsive" src="faseih.jpg"id="linkbyimg">
                        <p class ="poststart"><a class="linkby" href="#">Faseih Saad</a> added a new post</p>
                    </div>
                    <p class="time">09:10 pm</p>
                    <p class="postcaption"> #Dying #ESES </p>
                    <img  class="img-responsive" src="cover.jpg" id="postimg">
                    <div  id="likecomment">
                        <button id="like" type="button" class="btn btn-default">Like</button>
                        <button id="comment" type="button" class="btn btn-default">Comment</button>
                    </div>
                </div>
        </div>
            <div class="col-md-4" id="notifychat" style="position:fixed; right:0; top:0; margin:0px; height:92%; margin-top:4%">
                <div id="notification" style="overflow:auto; height:40%">
                    <ul class="list-group" id = "notifications">
                        <li id="notif" class="list-group-item"><a href="#" class="linkby">Faseih Saad &nbsp;</a>liked your <a class="linkto" href="#">&nbsp;Profile Picture</a></li>
                        
                         
                    </ul>
                </div>
                <div id="chat" class="theChatBox" style="height:50%">
                    <p id="brand">Chat</p>
					<div style = "overflow:auto;">
                    <div id="bla">
                <p id="sender" style="float:right"> Hi how are you? </p>
                <p id="reciever" style="float:left">I'm fine you tell</p>
                        </div>
						</div>
                    <div class="input-group" id="msgtext">
                        <input type="text" id = "msg" class="form-control" placeholder="Type here" onKeyPress="checkSubmit(event,this)" autocomplete="off">
                            <!--<span class="input-group-btn">
                            <button class="btn btn-default" type="button">Send</button>
                            </span>-->
                    </div>
                </div>
            </div>
    </div>
    
   <!-- javascript -->
<script>
var id = 0;
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
    			//alert(res);
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
function showHint(str) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				document.getElementById("txtHint").style.display = "block";
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "search.php?q=" + str, true);
        xmlhttp.send();
    }
}

function friend_request(x)
{

var id2 = x.getAttribute("data-id");
var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
			alert("Friend request sent.");
            }
        };
        xmlhttp.open("GET", "request.php?id1=" + user_id +"&id2=" + id2, true);
        xmlhttp.send();
}

function accept_request(x)
{
var id2 = x.getAttribute("data-id");
//alert(user_id);
var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
			alert("friend request has been accepted.");
            }
        };
        xmlhttp.open("GET", "request_accept.php?id1=" + user_id +"&id2=" + id2, true);
        xmlhttp.send();
}function friend()
{
var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
			//alert("friend request has been accepted.");
			document.getElementById("friends").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "update_friends.php?id="+user_id, true);
        xmlhttp.send();
}


setInterval(show_message,200);
setInterval(friend,500);
setInterval(show_notifications,1000);

</script>
</body>
    
    
    
</html>