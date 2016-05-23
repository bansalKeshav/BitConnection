<?php
session_start();
if(isset($_SESSION['temp']) && isset($_SESSION['temp1']))
{
    if(isset($_POST['password']) && isset($_POST['password1']))
	{
	if(!empty($_POST['password']) && !empty($_POST['password1']))
	{
	 require 'connection.php';
	 $email=$_SESSION['temp'];
	if($_POST['password']==$_POST['password1'])
	{
	$password=$_POST['password'];
	$stmt = $dbh->prepare("update `login-table` set password=:nam where email='$email'");
		$stmt->bindParam(':nam',$password);
		$stmt->execute();
		session_destroy();
		header("Location:signin.php");
    }
	if($_POST['password']!=$_POST['password1'])
	{
	echo '<script>alert("password do not match");<script>';
	}
	}
	else
	{
	echo '<script>alert("Enter all Details");</script>';
	}
	}
}
else
{
session_destroy();
header("Location: forgot.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
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
	<div id="update">
      <form class="form-signin" role="form" action="#" method="POST">
		<label for="passord">Password :</label>
       <input type="password" name="password" class="form-control" placeholder="Password" required autofocus>
	   
		<label for="passord">Confirm Password :</label>
       <input type="password" name="password1" class="form-control" placeholder="Confirm Password" required autofocus>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Update</button>
      </form>
	</div>
	
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>














