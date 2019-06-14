<?php
	include_once('database.php');
	$message = "Abhi to kuch b nae hua";
	session_start();
	if(isset($_FILES['profile']))
	{

		$id = $_POST['id'];
		$profile = $_FILES["profile"];
		//$cover = $_FILES["cover_pic"];
		
		
		$profile_name = $profile['name'];
		$profile_location = $profile['tmp_name'];
		$profile_size = $profile['size'];
		$profile_error = $profile['error'];
		
		$profile_ext = explode(".",$profile_name);
		$profile_ext = strtolower(end($profile_ext));
		
		/*$cover_name = $cover['name'];
		$cover_location = $cover['tmp_name'];
		$cover_size = $cover['size'];
		$cover_error = $cover['error'];
		
		$cover_ext = explode(".",$cover_name);
		$cover_ext = strtolower(end($cover_ext));*/
		
		$message = "variables has been set";
		echo $profile_name . " " . $profile_location . " " . $profile_size . " " . $profile_error . " " . $profile_ext;
		if($profile_ext === "jpg" || $profile_ext === "png")
		{
			if($profile_error === 0)
			{
				if($profile_size < 5000000)
				{
					$des = "profile_pics/".$id;
					if (!file_exists($des)) {
    				mkdir($des);
}
					
					$profile_destination = 'profile_pics/'.$id.'/'.$profile_name;
				if(move_uploaded_file($profile_location,$profile_destination))
				{

					$query = mysqli_query($con,"UPDATE profile SET profile_pic = '$profile_name' WHERE id = '$id'") or die("could not update database");
					$message = "Profile picture uploaded successfully";
					header("Location:profile.php");
				}
				else
				{
					$message = "Can't set profile picture"; 
				}
				}
				else
				{
					$message = "Profile picture is too large";
				}
			}
			else
			{
				$message = "Error in uploading the profile picture.";
			}
		}
		else
		{
			$message = "pls upload jpg file or  png file for your profile picture.";
		}
		
		
		/*if($cover_ext === "jpg" || $cover_ext === "png")
		{
			if($cover_error === 0)
			{
				if($cover_size < 5000000)
				{
				mkdir("cover_pics/".$id);
				$cover_destination = 'cover_pics/'.$id.'/'.$cover_name;
				if(move_uploaded_file($cover_location,$cover_destination))
				{
					$query = mysqli_query($con,"INSERT INTO profile(id,profile_pic,cover_pic)VALUES('$id','$profile_name','$cover_name')") or die("could not insert into database");	
					$message = "Cover picture uploaded";		
				}
				else
				{
					$message = "HAHAHA loray lag gye";
				}
				}
				else
				{
					$message = "Cover picture is too large";
				}
			}
			else
			{
				$message = "Error in uploading the cover picture.";
			}
		}
		else
		{
			$message = "pls upload jpg file or  png file for your cover picture.";
		}*/
	}
	else
	{
		$message = "set nae hua yar";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p>
<?php
echo $message;
?>
</p>
</body>
</html>