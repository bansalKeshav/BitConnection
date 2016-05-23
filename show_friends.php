<?php
session_start();
if(isset($_SESSION['email']))
{
    if(isset($_REQUEST['search']))
    {
       require 'connection.php';
	}
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
		$check=mysqli_query($con,"select * from `registration-table` where username ='$var'");
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
		$var = $_GET['search'];
		$check=mysqli_query($con,"select * from `registration-table` where username ='$var'");
		$row=mysqli_fetch_assoc($check);
		$u=$row['email'];
		$check=mysqli_query($con,"select * from `registration-table` where email='$u'");
		$row=mysqli_fetch_assoc($check);
		echo $row['name'];
	  ?>
	  
	  </h2>         
      <button type="button" class="btn" style="background-color:white;" ><span><img src="<?php 
	require 'connection.php';
	$var = $_GET['search'];
		$check=mysqli_query($con,"select * from `registration-table` where username ='$var'");
		$row=mysqli_fetch_assoc($check);
	$email=$row['email'];
	echo "users\\".$email."\\profilepic.jpg"; 
	  ?>" class="img-rounded" alt="Image not Load" width="180" height="236" <span class="glyphicon glyphicon-camera" aria-hidden="true" ></span></span> 
      </div>
	
    </div>
	<!--- Center block---> 
<div class="friends-center-block">
	<div class="list-group">
       <a href="#" class="list-group-item active">
         <h4 class="list-group-item-heading">FRIENDS</h4>
	   </a>
       <div class="well well-lg">
       <?php 
  
        require 'connection.php';
		$var = $_GET['search'];
		$check=mysqli_query($con,"select * from `registration-table` where username ='$var'");
		$row=mysqli_fetch_assoc($check);
		$u=$_SESSION['email'];
		$p=$row['email'];
		$check=mysqli_query($con,"select * from `friends-table` where user1 = '$p' or user2 = '$p'");
		$cnt=0;
		while ($row=mysqli_fetch_assoc($check))
		{
		 $user1 = $row['user1'];
		 $user2 = $row['user2'];	
		 if( $user1== $p)
		 {
			$que1=mysqli_query($con,"select * from `registration-table` where email='$user2'");
			$res1=mysqli_fetch_assoc($que1);
			$name = $res1['name'];
			$username = $res1['username'];
			echo '<a href="profile.php?search='.$username.'" class="list-group-item" style="float:left"><img src="users'.'/'.$user2.'/'.'profilepic.jpg" alt="..." class="img-rounded-friend"><span class="label label-default">'.$name.'</span></a>';		
         }
		 else if($user2==$p)
		 {
		  $cnt=$cnt+1;
		  $que=mysqli_query($con,"select * from `registration-table` where email='$user1'");
		  $res=mysqli_fetch_assoc($que);
		  $name = $res['name'];
		  $username = $res['username'];
		  echo '<a href="profile.php?search='.$username.'" class="list-group-item" style="float:left"><img src="users'.'/'.$user1.'/'.'profilepic.jpg" alt="..." class="img-rounded-friend"><span class="label label-default">'.$name.'</span></a>';		
		 }
		}
       ?>
       <!--- dont delete it may cause fuzzy --->
           <div class="panel-body">
           </div>
       </div>
     
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