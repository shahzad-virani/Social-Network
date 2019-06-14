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
      $uid = $_GET["id"];
      $query2 = mysqli_query($con,"UPDATE users set active = '0' WHERE id = '$uid'") or die("na baba na");
      $message = "You have successfully logout.";
      session_destroy();
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
<title>YouNited | Your New Social Platform</title>
<style>
body{
  margin:0;
    padding: 0;
  color:#6a6f8c;
  background:white;
  font:600 16px/18px 'Open Sans',sans-serif;
}
*,:after,:before{box-sizing:border-box}
.clearfix:after,.clearfix:before{content:'';display:table}
.clearfix:after{clear:both;display:block}
a{color:inherit;text-decoration:none}

.login-wrap{
  width:100%;
  margin:auto;
  max-width:525px;
  min-height:670px;
  position:relative;
  background:url(https://raw.githubusercontent.com/khadkamhn/day-01-login-form/master/img/bg.jpg) no-repeat center;
  box-shadow:0 12px 15px 0 rgba(0,0,0,.24),0 17px 50px 0 rgba(0,0,0,.19);
}
.login-html{
  width:100%;
  height:100%;
  position:absolute;
  padding:90px 70px 50px 70px;
  background:rgba(40,57,101,.9);
}
.login-html .sign-in-htm,
.login-html .sign-up-htm{
  top:0;
  left:0;
  right:0;
  bottom:0;
  position:absolute;
  -webkit-transform:rotateY(180deg);
          transform:rotateY(180deg);
  -webkit-backface-visibility:hidden;
          backface-visibility:hidden;
  -webkit-transition:all .4s linear;
  transition:all .4s linear;
}
.login-html .sign-in,
.login-html .sign-up,
.login-form .group .check{
  display:none;
}
.login-html .tab,
.login-form .group .label,
.login-form .group .button{
  text-transform:uppercase;
}
.login-html .tab{
  font-size:22px;
  margin-right:15px;
  padding-bottom:5px;
  margin:0 15px 10px 0;
  display:inline-block;
  border-bottom:2px solid transparent;
}
.login-html .sign-in:checked + .tab,
.login-html .sign-up:checked + .tab{
  color:#fff;
  border-color:#1161ee;
}
.login-form{
  min-height:345px;
  position:relative;
  -webkit-perspective:1000px;
          perspective:1000px;
  -webkit-transform-style:preserve-3d;
          transform-style:preserve-3d;
}
.login-form .group{
  margin-bottom:15px;
}
.login-form .group .label,
.login-form .group .input,
.login-form .group .button{
  width:100%;
  color:#fff;
  display:block;
}
.login-form .group .input,
.login-form .group .button{
  border:none;
  padding:15px 20px;
  border-radius:25px;
  background:rgba(255,255,255,.1);
}
.login-form .group input[data-type="password"]{
  text-security:circle;
  -webkit-text-security:circle;
}
.login-form .group .label{
  color:#aaa;
  font-size:12px;
}
.login-form .group .button{
  background:#1161ee;
}
.login-form .group label .icon{
  width:15px;
  height:15px;
  border-radius:2px;
  position:relative;
  display:inline-block;
  background:rgba(255,255,255,.1);
}
.login-form .group label .icon:before,
.login-form .group label .icon:after{
  content:'';
  width:10px;
  height:2px;
  background:#fff;
  position:absolute;
  -webkit-transition:all .2s ease-in-out 0s;
  transition:all .2s ease-in-out 0s;
}
.login-form .group label .icon:before{
  left:3px;
  width:5px;
  bottom:6px;
  -webkit-transform:scale(0) rotate(0);
          transform:scale(0) rotate(0);
}
.login-form .group label .icon:after{
  top:6px;
  right:0;
  -webkit-transform:scale(0) rotate(0);
          transform:scale(0) rotate(0);
}
.login-form .group .check:checked + label{
  color:#fff;
}
.login-form .group .check:checked + label .icon{
  background:#1161ee;
}
.login-form .group .check:checked + label .icon:before{
  -webkit-transform:scale(1) rotate(45deg);
          transform:scale(1) rotate(45deg);
}
.login-form .group .check:checked + label .icon:after{
  -webkit-transform:scale(1) rotate(-45deg);
          transform:scale(1) rotate(-45deg);
}
.login-html .sign-in:checked + .tab + .sign-up + .tab + .login-form .sign-in-htm{
  -webkit-transform:rotate(0);
          transform:rotate(0);
}
.login-html .sign-up:checked + .tab + .login-form .sign-up-htm{
  -webkit-transform:rotate(0);
          transform:rotate(0);
}

.hr{
  height:2px;
  margin:60px 0 50px 0;
  background:rgba(255,255,255,.2);
}
.foot-lnk{
  text-align:center;
}


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