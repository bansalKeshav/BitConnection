<?php

session_start();
if(isset($_SESSION['email']))
{
if(isset($_GET['search']))
{
    if(isset($_POST['homecity'])&& isset($_POST['club'])&& isset($_POST['status'])&& isset($_POST['fav_sports'])&&
	   isset($_POST['fav_movie'])&& isset($_POST['fav_place'])&& isset($_POST['passion'])&& isset($_POST['department']))
	   {
	require 'connection.php';
	$var = $_GET['search'];
	$check=mysqli_query($con,"select * from `about-table` where username='$var'");
	$row=mysqli_fetch_assoc($check);
	$email=$row['email'];
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
	 //echo '<script>alert(" fool");</script>';
	$stmt = $dbh->prepare("UPDATE `about-table` SET club=:nam WHERE email='$email'");
	//echo '<script>alert(" fool");</script>';
		$stmt->bindParam(':nam',$club);
		$stmt->execute();
		echo '<script>alert(" fool");</script>';
	}
	
	
	if($homecity!=NULL)
	{
	$stmt = $dbh->prepare("UPDATE `about-table` SET homecity=:nam WHERE email='$email'");
		$stmt->bindParam(':nam',$homecity);
		$stmt->execute();
	}
	
	
	
	if($club!=NULL)
	{
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
	
	
	
	if($club!=NULL)
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
    <title>Keshav</title>
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
jQuery(document).ready(function() {

var toggle = false;
var user="Keshav";
var searchBoxText= "Type here...";
var fixIntv;
var fixedBoxsize = $('#fixed').outerHeight()+'px';
var Parent = $("#fixed"); // cache parent div
var Header = $(".fixedHeader"); // cache header div
var Chatbox = $(".userinput"); // cache header div
Parent.css('height', '30px');

Header.click(function(){           
    toggle = (!toggle) ? true : false;
    if(toggle)
    {
        Parent.animate({'height' : fixedBoxsize}, 300);                    
    }
    else
    {
        Parent.animate({'height' : '30px'}, 300); 
    }
    
});

Chatbox.focus(function(){
    $(this).val(($(this).val()==searchBoxText)? '' : $(this).val());
}).blur(function(){
    $(this).val(($(this).val()=='')? searchBoxText : $(this).val());
}).keyup(function(e){
    var code = (e.keyCode ? e.keyCode : e.which);       
    if(code==13){
        $('.fixedContent').append("<div class='userwrap'><span class='user'>"+user+"</span><span class='messages'>"+$(this).val()+"</span></div>");
        event.preventDefault();
     
        $(".fixedContent").scrollTop($(".fixedContent").height());
        $(this).val('');
    }
    
});

});
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
        <div class="page-header">
        <div class="pull-left" style="color:lavenderblush; padding:20px 10px; font-size:25px">BIT CONNECTION</div>    
		<div class="pull-right" style="padding:30px 0px; padding-right:100px;">
    <button type="button" class="btn btn-default" style="padding:0px 15px;">HOME <span class="glyphicon glyphicon-home" ></span></button>
    <button type="button" class="btn btn-primary" style="padding:0px 15px;">MESSAGES <span class="glyphicon glyphicon-comment" ></span></button>
    <button type="button" class="btn btn-success" style="padding:0px 15px;">FRIEND REQUESTS<span class="glyphicon glyphicon-user" ></span></button>
    <button type="button" class="btn btn-info" style="padding:0px 15px;">NOTIFICATION <span class="glyphicon glyphicon-globe" ></span></button>
    <button type="button" class="btn btn-warning" style="padding:0px 15px;">GALLERY <span class="glyphicon glyphicon-picture" ></span></button>
    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="padding:0px 15px;">
        SETTING <span class="glyphicon glyphicon-wrench"></span><span class="caret"></span></button>
        <ul class="dropdown-menu" role="menu">
          <li><a href="#">PRIVACY</a></li>
          <li><a href="mid_logout.php">LOGOUT</a></li>
        </ul>
      </div>	
	   <button type="button" class="btn btn-link" style="padding:0px 15px;">NEWS</button>  
   
    </div>
    </div>
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
      </div>
	  <?php
		require 'connection.php';
		$var = $_GET['search'];
		$check=mysqli_query($con,"select * from `about-table` where username = '$var'");
		$row=mysqli_fetch_assoc($check);
		
	  if($row['email']==$_SESSION['email'])
	  {
	  echo '
      <div style="padding:5px 65px;">
      <button type="button" class="btn btn-default">UPLOAD <span class="glyphicon glyphicon-camera" aria-hidden="true"></span></button>
      </div>';
	  }
	  else
	  {
	    echo '
			<div style="padding:20px 50px;">
            <button type="button" class="btn btn-default">Add Friend <span class="glyphicon glyphicon-user" aria-hidden="true"></span></button>
			</div>';
	  }
	  ?>
	  </button>
	
	
	
	
	
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
			<div class="list-group">
  <a href="#" class="list-group-item active">
    <h4 class="list-group-item-heading">FRIENDS</h4>
  </a>
  <div class="well well-lg">
 <a href="#" class="list-group-item"><img src="profile.jpg" alt="..." class="img-rounded-friend"></a>		
  <a href="#" class="list-group-item"><img src="profile.jpg" alt="..." class="img-rounded-friend"></a>		
 <a href="#" class="list-group-item"><img src="profile.jpg" alt="..." class="img-rounded-friend"></a>		

 </div>

</div>
 
		</div>
		<!---- right side division --->
    <div class="sab-kuch-in-right">    
		  <div class="panel panel-default">
					<div class="panel-body">
					Basic panel example
					</div>
		
			<button class="btn btn-default" style="width:248px" type="button">
						Messages &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge">4</span>
			</button>
		    <button class="btn btn-default" style="width:248px" type="button">
						Messages &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge">4</span>
			</button>
		    <button class="btn btn-default" style="width:248px" type="button">
						Messages &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge">4</span>
			</button>
		    
		    
		  
		  </div>
	</div>
	<!----Message BOX --->	
	 <div id="fixed">
			<div class="fixedHeader">jQuery404</div>
		<div class="fixedContent"></div>
			<div class="chatbox">
			<textarea class="userinput">Type here...</textarea>            
			</div>
	 </div>
     
	<!--- ---->
	
	<script src="dist/js/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min1.js"></script>
  </body>
</html>