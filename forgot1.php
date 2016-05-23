<?php
session_start();
if(isset($_SESSION['temp']))
{
if(isset($_POST['sq1'])&&isset($_POST['sa1']) && isset($_POST['sq2'])&&isset($_POST['sa2']))
    {
     if(!empty($_POST['sq1']) && !empty($_POST['sq2']) && !empty($_POST['sa1']) && !empty($_POST['sa2']))
     {
    require 'connection.php';
	$email = $_SESSION['temp'];
	$check=mysqli_query($con,"select * from `login-table` where email='$email'");
	$row=mysqli_fetch_assoc($check);
	
	$sq1 = $row['sq1'];
	$sq2= $row['sq2'];
	$sa1 = $row['sa1'];
	$sa2= $row['sa2'];

     if($_POST['sa1']!=$sa1 || $_POST['sa2']!=$sa2|| $_POST['sq1']!=$sq1 || $_POST['sq2']!=$sq2)
     {
      echo '<script>alert("Invalid Answer");</script>';
     }
	  else if($_POST['sa1']==$sa1 && $_POST['sa2']==$sa2 && $_POST['sq1']==$sq1 && $_POST['sq2']==$sq2)
	  {
	  $_SESSION['temp1']=$email;
	  header("Location:forgot2.php");
	  }
 }
 else
 {
 echo '<script>alert("Fill all the details");</script>';
 }
 }
 }
 else
 {
 session_destroy();
  header("Location:forgot.php");
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
	<div id="sq">
      <form class="form-signin" role="form" action="#" method="POST">
		<label for="sq1">Security question 1:</label>
        <div class="form-group input-group">	
									 <span class="input-group-addon"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></span>
										<select class="form-control"  id="sel1" name="sq1">
                                    <option>what is your first school name ?</option>
                                    <option>what is your birth place?</option>
                                    <option>what is your last school name ?</option>
                                    <option>where is your maternal place ?</option>
                                    <option>who is your crush ?</option>
                                     <option>what is your favorite movie ?</option>
                                     </select>
                                     </div>
		<label for="sq1">Security Answer 1:</label>
		<input type="text" name="sa1" class="form-control" placeholder="" required autofocus value="">
		<label for="sq2">Security question 2:</label>
        <div class="form-group input-group">	
									 <span class="input-group-addon"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></span>
										<select class="form-control"  id="sel1" name="sq2">
                                    <option>what is your first school name ?</option>
                                    <option>what is your birth place?</option>
                                    <option>what is your last school name ?</option>
                                    <option>where is your maternal place ?</option>
                                    <option>who is your crush ?</option>
                                     <option>what is your favorite movie ?</option>
                                     </select>
                                     </div>
		<label for="sq2">Security Answer 2:</label>
		<input type="text" name="sa2" class="form-control" placeholder="" required autofocus value="">
		<br>
        <button class="btn btn-lg btn-primary btn-block" type="submit" >Submit</button>
      </form>
	</div>

	
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>














