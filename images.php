<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
if(isset($_SESSION['email']))
{
		require 'connection.php';
		require 'upload_dp.php';
		$email = $_SESSION['email'];
		$check=mysqli_query($con,"select * from `registration-table` where email='$email'");
		$row=mysqli_fetch_assoc($check);
	if(isset($_GET['search']))
	{
		if(!empty($_GET['search']))
		{
			$var =$_GET['search'];
			header("Location: profile.php?".$_SERVER['QUERY_STRING']);
			//header("Location: profile.php?uname='$var'");
		}
	}
    if(isset($_POST['post_status']))
	{
	    require 'connection.php';
		$email = $_SESSION['email'];
		$check=mysqli_query($con,"select * from `registration-table` where email='$email'");
		$row=mysqli_fetch_assoc($check); 
	}
}
else
{
	header('Location: signin.php');
}
?>

<?php 
require 'connection.php';

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Talking Stones
</title>

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


<link rel="icon" href="tu.ico" type="image/x-icon">
<link href="mystyle.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="mycss.css">
<script src="jquery.js"></script>
<script src="textEffect.jquery.js"></script>
<script src="jquery.colorbox.js"></script>
<script src="jquery.colorbox-min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
$('.prod').colorbox({rel:'prod',transition:"fade",width:"50%", height:"80%"});
});

</script>


</head>
<body class="bg">
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
	
	<div style="padding:0px 700px;  " >
	 <form action="#" method="POST" enctype="multipart/form-data" name="myForm">
	 <div id="yourcvrBtn" onclick="getFile1()">upload<span class="glyphicon glyphicon-camera" aria-hidden="true"></span></div>
	 <div style="height: 0px;width: 0px; overflow:hidden;"><input id="upfile1" type="file" name ="file1" value="upload" onchange="sub1(this)"/></div>
	 </form>
	  </div>  
	
	
	
	</div>
	
	
	<div class="profile-left">
     <div class="container" ">
      <h2>
	  <?php
		require 'connection.php';
		$u = $_GET['search'];
		$check=mysqli_query($con,"select * from `registration-table` where username='$u'");
		$row=mysqli_fetch_assoc($check);
		echo '<b>'.$row['name'].'</b>';
	  ?>
	  
	  </h2>         
      <button type="button" class="btn" style="background-color:white;" ><span><img src="<?php 
	require 'connection.php';
	$var = $_GET['search'];
	$check=mysqli_query($con,"select * from `registration-table` where username='$var'");
	$row=mysqli_fetch_assoc($check);
	$email=$row['email'];
	echo "users\\".$email."\\profilepic.jpg"; 
	  ?>" class="img-rounded" alt="Cinque Terre" width="180" height="236" <span class="glyphicon glyphicon-camera" aria-hidden="true" ></span></span> 
      </div>
	
	<?php
		require 'connection.php';
		$var = $_GET['search'];
		$check=mysqli_query($con,"select * from `registration-table` where username = '$var'");
		$row=mysqli_fetch_assoc($check);
		$u=$_SESSION['email'];
		$p=$row['email'];
		$flag=" ";
	  if($u==$p)
	  {
	  echo '
	  <div style="padding:40px 38px;">
	<form action="#" method="POST" enctype="multipart/form-data" name="myForm">
	<div id="yourBtn" onclick="getFile()">upload<span class="glyphicon glyphicon-camera" aria-hidden="true"></span></div>
	 <div style="height: 0px;width: 0px; overflow:hidden;"><input id="lele" type="file" name ="file" value="upload" onchange="sub(this)"/></div>
	</form>
	</div>';
	
	  }
	  else if($u!=$p)
	  {
		$check=mysqli_query($con,"select * from `friends-table`");
	   while($row=mysqli_fetch_assoc($check))
	  {
	   if($row['user1']==$u&&$row['user2']==$p ||$row['user1']==$p&&$row['user2']==$u)
	   {
	    $flag='friends';
	    break;
	   }
	  } 
	   if($flag=='friends') 
     	{
		echo '
			<div style="padding:20px 50px;">
			<form action="#" method="POST">
            <button type="submit" class="btn btn-default" name="unfrnd_btn">Unfriend <span class="glyphicon glyphicon-user" aria-hidden="true"></span></button>
			</form>
			</div>';
		}
		else
		{
		  $check=mysqli_query($con,"select * from `friendrequest-table`");
			while($row=mysqli_fetch_assoc($check))
			{
				if($row['sender']==$u && $row['receiver']==$p) 
					{
						$flag='cancel';
						break;
					}
			     	else if($row['sender']==$p&&$row['receiver']==$u) 
					{
						$flag='confirm';
						break;
					}
			
			} 
	  
		  if($flag=='cancel')
		  {
		    echo '
			<div style="padding:20px 50px;">
			<form action="#" method="POST">
            <button type="submit" class="btn btn-default" name="cancel_btn">Cancel <span class="glyphicon glyphicon-user" aria-hidden="true"></span></button>
			</form>
			</div>';
		
		  }
		   else if($flag=='confirm')
		  {
		    echo '
			<div style="padding:20px 50px;">
			<form action="#" method="POST">
            <button type="submit" class="btn btn-default" name="confirm">Confirm <span class="glyphicon glyphicon-user" aria-hidden="true"></span></button>
			</form>
			</div>';
		
		  }
		  else
		  {
		       echo '
			   
			<div style="padding:20px 50px;">
			<form action="#" method="POST">
            <button type="submit" class="btn btn-default " name="add_friend">Add Friend <span class="glyphicon glyphicon-user" aria-hidden="true"></span></button>
			</form>
			</div>';
		
		  }
		}
	  }
	  ?>
	
	
<div>
	
	
	
	
	
	
	
	
	
 <div class="img">
<a class="prod" href="gallery/emma1.jpg"><img src="gallery/emma1.jpg" alt="profile pic 1" width="110" height="90"></a> <div class="desc">Add a description of the image here</div>
</div>

 <div class="img">
 <a class="prod" href="gallery/emma2.jpg"><img src="gallery/emma2.jpg" alt="profile pic 2" width="110" height="90"></a>
 <div class="desc">Add a description of the image here</div>
</div>

 <div class="img">
 <a class="prod" href="gallery/emma3.jpg"><img src="gallery/emma3.jpg" alt="profile pic 2" width="110" height="90"></a>
 <div class="desc">Add a description of the image here</div>
</div>
  
     <?php
       require 'lol.php';
	  ?>

     
  
</body>

</html>
