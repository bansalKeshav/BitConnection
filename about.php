<?php

session_start();
if(isset($_SESSION['email']))
{
    if(isset($_REQUEST['search']))
    {
       if(isset($_POST['homecity'])&& isset($_POST['club'])&& isset($_POST['status'])&& isset($_POST['fav_sports'])&&
	   isset($_POST['fav_movie'])&& isset($_POST['fav_place'])&& isset($_POST['passion'])&& isset($_POST['department']))
	   {
	require 'connection.php';
	$var = $_REQUEST['search'];
	$check=mysqli_query($con,"select * from `registration-table` where username = '$var'");
	$row=mysqli_fetch_assoc($check);
	$email=$_SESSION['email'];
	$homecity=$_POST['homecity'];
	$club=$_POST['club'];
	$status=$_POST['status'];
	$department=$_POST['department'];
	$fav_sports=$_POST['fav_sports'];
	$fav_place=$_POST['fav_place'];
	$fav_movie=$_POST['fav_movie'];
	$passion=$_POST['passion'];
	
	
	if($club!=NULL)
	{
	$stmt = $dbh->prepare("UPDATE `about-table` SET club=:nam WHERE email='$email'");
		$stmt->bindParam(':nam',$club);
		$stmt->execute();
	}
	
	
	if($homecity!=NULL)
	{
	$stmt = $dbh->prepare("UPDATE `about-table` SET homecity=:nam WHERE email='$email'");
		$stmt->bindParam(':nam',$homecity);
		$stmt->execute();
	}
	
	
	
	if($status!=NULL)
	{
	echo '<script>alert("sahi");</script>';
	$stmt = $dbh->prepare("UPDATE `about-table` SET status=:nam WHERE email='$email'");
		$stmt->bindParam(':nam',$status);
		$stmt->execute();
	}
	
	

	if($passion!=NULL)
	{
	$stmt = $dbh->prepare("UPDATE `about-table` SET passion=:nam WHERE email='$email'");
		$stmt->bindParam(':nam',$passion);
		$stmt->execute();
	}
	
	
	
	if($department!=NULL)
	{
	$stmt = $dbh->prepare("UPDATE `about-table` SET department=:nam WHERE email='$email'");
		$stmt->bindParam(':nam',$department);
		$stmt->execute();
	}
	
	
	
	if($fav_place!=NULL)
	{
	$stmt = $dbh->prepare("UPDATE `about-table` SET `fav-place`=:nam WHERE email='$email'");
		$stmt->bindParam(':nam',$fav_place);
		$stmt->execute();
	}
	
	
	if($fav_sports!=NULL)
	{
	$stmt = $dbh->prepare("UPDATE `about-table` SET `fav-sport`=:nam WHERE email='$email'");
		$stmt->bindParam(':nam',$fav_sports);
		$stmt->execute();
	}
	
	
	if($fav_movie!=NULL)
	{
	$stmt = $dbh->prepare("UPDATE `about-table` SET `fav-movie`=:nam WHERE email='$email'");
		$stmt->bindParam(':nam',$fav_movie);
		$stmt->execute();
	}
	}
	}
	if(isset($_POST['home']))
	{
	header("Location: homepage.php");
	}
	}
	else if(!isset($_SESSION['email']))
	{
		header("Location: signin.php");
	}
?>
<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BIT CONNECTION</title>
     <link href="dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="dist/css/kmessage.css" rel="stylesheet">
     <script src="js/jquery.js"></script>
	<script src="js/textEffect.jquery.js"></script>
   <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  
  
  <script type="text/javascript">

function fn1()
{
document.getElementById("before edit").style.display="block";
document.getElementById("after edit").style.display="none";
}
function fn2()
{
document.getElementById("before edit").style.display="none";
document.getElementById("after edit").style.display="block";
}
</script> 
  </head>

  <body>
     <div class="container">
         <?php
        require 'header.php';
	  ?>
	
	<!--- Cover pic container--->   
	
	<div class="coverpic">
	
	
	<button type="button" class="btn" style="background-color:white;" ><span><img src="<?php 
	require 'connection.php';
	$var = $_GET['search'];
	$check=mysqli_query($con,"select * from `registration-table` where username='$var'");
	$row=mysqli_fetch_assoc($check);
	$email=$row['email'];
	echo "users\\".$email."\\coverpic.jpg"; 
	  ?>"
	  class="img-rounded" alt="Cinque Terre" width="1000px" height="500px" <span class="glyphicon glyphicon-camera" aria-hidden="true" ></span></span> 
   
	  </button>
	
	 </div>
	  
	
	
	
	</div>
	
	  
	<!--- left Side container--->   
	   <div class="profile-left">
     <div class="container" ">
      <h2>
	  <?php
		require 'connection.php';
		$u = $_GET['search'];
		$check=mysqli_query($con,"select * from `registration-table` where username='$u'");
		$row=mysqli_fetch_assoc($check);
		echo $row['name'];
	  ?>
	  
	  </h2>         
      <button type="button" class="btn" style="background-color:white;" ><span><img src="<?php 
	require 'connection.php';
	$var = $_GET['search'];
	$check=mysqli_query($con,"select * from `registration-table` where username='$var'");
	$row=mysqli_fetch_assoc($check);
	$email=$row['email'];
	echo "users\\".$email."\\profilepic.jpg"; 
	  ?>" class="img-rounded" alt="Image not Load" width="180" height="236" <span class="glyphicon glyphicon-camera" aria-hidden="true" ></span></span> 
      </div>
	
    </div>
	<!--- Center block---> 
		<div class="friends-center-block">
			<div style="display:none;" id="before edit">
	   <form role="form" action="#" method="POST">
	   <div class="form-group">
	   <label for="user">Home city:</label>
	   <input type="text" class="form-control" name="homecity" palceholder="Home city">                                                     
	   </div>
	   
	   <div class="form-group">
	   <label for="user">Club:</label>
	   <input type="text" class="form-control" name="club" palceholder="club">
	   </div>
	   
	   <div class="form-group">
	   <label for="user">Department:</label>
	   <input type="text" class="form-control" name="department" palceholder="Department">
	   </div>
	   
	   <div class="form-group">
	   <label for="user">Status:</label>
	   <input type="text" class="form-control" name="status" palceholder="Staus">
	   </div>
	   
	   <div class="form-group">
	   <label for="user">Passion:</label>
	   <input type="text" class="form-control" name="passion" palceholder="Passion">
	   </div>
	   
	   <div class="form-group">
	   <label for="user">Fav movie:</label>
	   <input type="text" class="form-control" name="fav_movie" palceholder="Fav Movie">
	   </div>
	   
	   <div class="form-group">
	   <label for="user">Fav sports:</label>
	   <input type="text" class="form-control" name="fav_sports" palceholder="Fav Movie">
	   </div>
	   
	   <div class="form-group">
	   <label for="user">Fav Place:</label>
	   <input type="text" class="form-control" name="fav_place" palceholder="Fav place">
	   </div>
	   
	   <div class="form-group">
	   <label for="user">Update:</label>
	   <button type="submit" class="btn btn-info" id="email" name="update" onsubmit="fn2()"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp;Update</button>
	   </div>
	   
	   
	  </div>
			<div class="panel panel-header"  id="after edit">
		<h2>About</h2>	
			<?php
		require 'connection.php';
		$var = $_REQUEST['search'];
		$check=mysqli_query($con,"select * from `about-table` where username = '$var'");
		$check1 = mysqli_query($con,"select * from `registration-table` where username = '$var'");
		$row1=mysqli_fetch_assoc($check1);
		$row=mysqli_fetch_assoc($check);
		$v1=$row1['email'];
		$v2=$row1['username'];
		$v3=$row['homecity'];
		$v4=$row['club'];
		$v5=$row['status'];
		$v6=$row['department'];
		$v7=$row['passion'];
		$v8=$row['fav-sport'];
		$v9=$row['fav-place'];
		$v10=$row['fav-movie'];
		
			   echo '
			<div class="panel panel-info">
			<div class="panel-heading"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp;Email :</div>
			<div class="panel-body">
			<p>
			'.$v1.'
			</p>
			</div>
	   </div>';
	   	   echo '
			<div class="panel panel-info">
			<div class="panel-heading"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp;Username:</div>
			<div class="panel-body">
			<p>
			'.$v2.'
			</p>
			</div>
	   </div>';
	  	   echo '
			<div class="panel panel-info">
			<div class="panel-heading"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp;Homecity :</div>
			<div class="panel-body">
			<p>
			'.$v3.'
			</p>
			</div>
	   </div>';
		   echo '
			<div class="panel panel-info">
			<div class="panel-heading"><span class="glyphicon glyphicon-music" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp;Club :</div>
			<div class="panel-body">
			<p>
			'.$v4.'
			</p>
			</div>
	   </div>';
	 	   echo '
			<div class="panel panel-info">
			<div class="panel-heading"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp;Status:</div>
			<div class="panel-body">
			<p>
			'.$v5.'
			</p>
			</div>
	   </div>';
	   	   echo '
			<div class="panel panel-info">
			<div class="panel-heading"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp;Department :</div>
			<div class="panel-body">
			<p>
			'.$v6.'
			</p>
			</div>
	   </div>';
		   echo '
			<div class="panel panel-info">
			<div class="panel-heading"><span class="glyphicon glyphicon-tower" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp;Passion :</div>
			<div class="panel-body">
			<p>
			'.$v7.'
			</p>
			</div>
	   </div>';
	   echo '
			<div class="panel panel-info">
			<div class="panel-heading"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp;Fav sport :</div>
			<div class="panel-body">
			<p>
			'.$v8.'
			</p>
			</div>
	   </div>';
		   echo '
			<div class="panel panel-info">
			<div class="panel-heading"><span class="glyphicon glyphicon-tree-deciduous" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp;Fav Place :</div>
			<div class="panel-body">
			<p>
			'.$v9.'
			</p>
			</div>
	   </div>';
	   	   echo '
			<div class="panel panel-info">
			<div class="panel-heading"><span class="glyphicon glyphicon-film" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp;Fav Movie :</div>
			<div class="panel-body">
			<p>
			'.$v10.'
			</p>
			</div>
	   </div>';
	        /*echo '
			       <div class="panel panel-default">
				   <div>
					<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-camera" aria-hidden="true" ></span>
					 '. $v1 .'
					</button>
					</div>
					</div>
				   ';
			*/
			if($row1['email']==$_SESSION['email'])
			{
			echo '
		       <div>
               <button type="button" class="btn btn-default" onclick="fn1()">Edit Info <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
			   </div>';
			}
			
			?>
			
			   </div>
     	 
		</div>
		<!---- right side division --->
    
	<!----Message BOX --->	
		<?php
		  require 'lol.php';
		?>
      
	<!--- ---->
	
	<script src="dist/js/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min1.js"></script>
  </body>
</html>