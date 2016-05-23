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
  <style>
			.msgbar-name 
            {
                padding-left: 10px;
                padding-right: 10px;
                margin-bottom: 4px;
                font-size: 12px;
            }
            
            .msgbar-name span
            {
                padding-left: 5px;
            }
            
            .msgbar-name a
            {
                display: block;
                height: 100%;
                text-decoration: none;
                color: inherit;
            }
            
            .msgbar-name:hover
            {
                background-color:#e1e2e5;
            }
            
            .msgbar-name img
            {
                width: 32px;
                height: 32px;
                vertical-align:middle;
            }
</style>
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
	$email=$_SESSION['email'];
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
		$u = $_SESSION['email'];
		$check=mysqli_query($con,"select * from `registration-table` where email='$u'");
		$row=mysqli_fetch_assoc($check);
		echo $row['name'];
	  ?>
	  
	  </h2>         
      <button type="button" class="btn" style="background-color:white;" ><span><img src="<?php 
	require 'connection.php';
	$email=$_SESSION['email'];
	echo "users\\".$email."\\profilepic.jpg"; 
	  ?>" class="img-rounded" alt="Image not Load" width="180" height="236" <span class="glyphicon glyphicon-camera" aria-hidden="true" ></span></span> 
      </div>
	
    </div>
	<!--- Center block---> 
<div class="friends-center-block">
	<div class="list-group">
     <?php
		require 'connection.php';
		$email = $_SESSION['email'];
		$check=mysqli_query($con,"select distinct receiver AS name from `message-table` where sender ='$email' UNION
		select distinct sender AS name from `message-table` where receiver ='$email'
		EXCEPT
		(select distinct receiver  AS name from `message-table` where sender ='$email' INTERSECT
		select distinct sender AS  name from `message-table` where receiver ='$email')");
		while($row=mysqli_fetch_assoc($check))
		{ 
		 $sender=$row['name'];
		 $check1=mysqli_query($con,"select * from `registration-table` where email = '$sender'");
		 $row1=mysqli_fetch_assoc($check1);
		 $name=$row1['name'];
		 
		 echo      '<div class="msgbar-name">
					<a href="javascript:register_popup('."'$sender'".','."'$name'".','."'$email'".');">
                    <img width="90" height="90" src= "users\\'.$sender.'\profilepic.jpg"/>
                    <span>'.$name.' &nbsp;&nbsp;
                    </a>					
					</div><p>';
		}
		echo '<li class="list-group-item"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO MORE MESSAGES</li>' 
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