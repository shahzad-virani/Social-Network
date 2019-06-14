<?php
include_once('database.php');
if(isset($_POST['name']))
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$dob = $_POST['dob'];
	$password = $_POST['password'];
	$password_again = $_POST['password_again'];
  if($password == $password_again)
  {
    $query = mysqli_query($con,"SELECT * FROM users WHERE 
    email = '$email'");
    if(mysqli_num_rows($query) > 0)
    {
      $message = "Email Already Exists.";
    }
    else
    {
   
    $password = sha1($password);
    $query = mysqli_query($con,"INSERT into users(name,email,dob,password) values('$name','$email','$dob','$password')") or die("could not insert data into database");
    
    $query = mysqli_query($con,"SELECT id FROM users WHERE email = '$email'") or die("could not find id from database");
    $row = mysqli_fetch_assoc($query);
    $id = $row['id'];

    $query = mysqli_query($con,"INSERT INTO profile (id) VALUES('$id')") or die("could not insert id in profile");


    

  }
  } 
  else
  {
    $message = "Password doesn't match.";
  }
	
	
}
?>

<!DOCTYPE html>
	<head>
	<title>Registration</title>
    </head>
    
    <body>
    <form method = "post" action = "upload_image.php" enctype = "multipart/form-data">
      <p>
        <label>upload profile pic </label>
        <input type = "file" name = "profile">	
      </p>
      <p>
        <label>upload cover photo</label>
        <input type = "file" name = "cover">
      </p>
      <p>

      </p>
      <p>
      <input type = "submit">
      </p>
 	</form>   
    </body>
</html>