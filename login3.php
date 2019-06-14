<?php
  include_once('database.php');
  if(isset($_SESSION['id']))
  {
    header("Location:profile.php");
  }
  $message = "";
  
    if(isset($_GET["id"]))
    {
      session_start();
      echo "session destroyed";
      session_destroy();
    }
    else
    {
      echo "session not destroyed";
    }
	if(isset($_POST['email'] ) && isset($_POST['password']))
	{
		$email = $_POST['email'];
		$password = $_POST['password'];

    $password = sha1($password);

    $query = mysqli_query($con,"SELECT * FROM users WHERE password = '$password' && email = '$email'");
    if(mysqli_num_rows($query) === 1)
    {
      $row = mysqli_fetch_assoc($query);
      session_start();
      $_SESSION['id'] = $row['id'];
      $_SESSION['name'] = $row['name'];
      header("Location:profile.php");
    }
    else
    {
      $message = "Email or Password doesn't exist.";
    }
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Page</title>
<style>

</style>
</head>

<body>
<h1>Login</h1>
<p>Enter your Email and password</p>
<form method = "post" action = "login.php">
  <p>
    Email:<input type = "text" name = "email" />
  </p>
  <p>
    Password:<input type = "password" name = "password"/>
  </p>
  <p><input type = "submit"></p>
</form>
<p><?php echo $message; ?> </p>

<form method = "post" action = "register.php">
<h1>Registration</h1>
<p>Join the best social network in the world</p>
<p><label>Name:</label>
   <input type = "text" name = "name" />
</p>
<p>
  <label>Email:</label>
  <input type = "email" name = "email" />
  </p>
<p><label>Date Of Birth:</label>
  <input type = "date" name = "dob"/>
  </p>
<p><label>Password:</label>
  <input type = "password" name = "password"/>
  </p>
<p><label>Re-enter Password</label> <input type = "password" name = "password_again"/>
</p>
<input type ="submit" />
</form>
</body>
</html>