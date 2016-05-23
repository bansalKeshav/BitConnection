<?php
session_start();

if(isset($_SESSION['email']))
{
	header('Location: homepage.php');
}
else
{
if (isset($_POST['email']) && isset($_POST['password']))
{
	if(!empty($_POST['email']) && !empty($_POST['password']))
	{
		require 'connection.php';
		$email = $_POST['email'];
		$password = $_POST['password'];
		//$md5_password = md5($password);
		$flag=1;
		$check=mysqli_query($con,"select * from `login-table`");
		while($row=mysqli_fetch_assoc($check))
		{
			if($row['password']==$password && $row['email']==$email)
			{
				$flag=2;
			}
		}
		if($flag==2)
		{	
		$_SESSION['email'] = $email;
		echo'<script>alert("sdf");</script>';
		require 'connection.php';
		$status=1;
		$time=time();
		$time = 16200 + $time;
		$check=mysqli_query($con,"update `online-table` set time='$time' where email='$email'");
		$row=mysqli_fetch_assoc($check);
		$check1=mysqli_query($con,"update `online-table` set status='$status' where email='$email'");
		$row1=mysqli_fetch_assoc($check1);
		header("Location: homepage.php");
		
		}
	}
	else
	{
		echo '<script> alert("please fill all the details");</script>';
	}
}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <style>

body{
    background-image: url("Sqaures.jpg");
    background-color: #cccccc;
}
</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="docs/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body >

    <div class="container">

      <form class="form-signin" role="form" action="#" method="POST">
        		<h1>BIT Connection <small></small></h1>
		<label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
		<div>
		 <a href="forgot.php"style="color:black;">forgot password</a>
         <a href="signup.php"style="float:right;color:black;">Register</a>
		 </div>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
