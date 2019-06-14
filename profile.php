<?php

include_once('database.php');
$message = "";
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['name']))
{
	$name = $_SESSION['name'];
	$id = $_SESSION['id'];

	$query = mysqli_query($con,"SELECT * FROM users WHERE id = '$id'");
	$row = mysqli_fetch_assoc($query);
	$email = $row["email"];
	$dob = $row["dob"];
	$query1 = mysqli_query($con,"SELECT * FROM profile WHERE id = '$id'");
	$row1 = mysqli_fetch_assoc($query1);
	$profile_pic = $row1["profile_pic"];
	$profile_pic = "profile_pics/".$id."/".$profile_pic;
	$query2 = mysqli_query($con,"UPDATE users set active = '1' WHERE id = '$id'");

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
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}

#profile_pic{
	height:250px;
	width:220px;

}

</style>
</head>

<body>
<p>Welcome <b> <?php echo $name . " " . $id;?></b></p>

<div class="fileUpload btn btn-primary">
    <span>Upload Profile Pic</span>
    <form method = "post" action = "upload_image.php" enctype = "multipart/form-data">
    <input type="file" class="upload"  onchange="this.form.submit()" name = "profile"/>
    <input type = "hidden" value = "<?php echo $id?>" name = "id">
    </form>
</div>
<a href = "login.php?id=1"> logout</a> 
<img src = "<?php echo $profile_pic?>" id = "profile_pic"> 
<p>Name:<?php echo $name;?></p>
<p>Date Of Birth:<?php echo $dob;?></p>
<p>Email:<?php echo $email;?></p>
<p><b>Search for people to be friends with</b></p>
<form> 
<input type="text" onkeyup="showHint(this.value)">
</form>
<p>Suggestions: <span id="txtHint"></span></p>
<p><a href = "home.php">News Feed</a></p>



<!-- javascript -->

<script>
function showHint(str) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "search.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>
</body>
</html>