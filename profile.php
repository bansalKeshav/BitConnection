<?php

session_start();
if(isset($_SESSION['email']))
{
require 'upload_dp.php';
require 'upload_cp.php';
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
  }
 }

 if(isset($_POST['about']))
     {
     header("Location: about.php?search=".$_GET['search']);
     } 



	if(isset($_POST['add_friend']))
	{
		//echo '<script>alert("fool");</script>';
		require 'connection.php';
		$var = $_GET['search'];
		$check=mysqli_query($con,"select * from `registration-table` where username = '$var'");
		$row=mysqli_fetch_assoc($check);
		$u=$_SESSION['email'];
		$p=$row['email'];
		$flag=" ";
		$flag1="";
		$check1=mysqli_query($con,"select * from `friendrequest-table`");
		while($row1=mysqli_fetch_assoc($check1))
		{
			if($row1['sender']==$u && $row1['receiver']==$p)
			{
				$flag="cannot send";
			}
			if($row1['sender']==$p && $row1['receiver']==$u)
			{
				$flag="cannot send";
			}
		}
		if($flag!="cannot send")
		{
			$stmt = $dbh->prepare("insert into `friendrequest-table` (sender,receiver) VALUES(:u,:p)");
			$stmt->bindParam(':u',$u);
			$stmt->bindParam(':p',$p);
			$stmt->execute();
		}
		else 
		{
			echo '<script>alert("this request cannot be processed .");  </script>';
		}
	}
	
	if(isset($_POST['confirm']))
	{
		//echo '<script>alert("fool");</script>';
		require 'connection.php';
		$var = $_GET['search'];
		$check=mysqli_query($con,"select * from `registration-table` where username = '$var'");
		$row=mysqli_fetch_assoc($check);
		$u=$_SESSION['email'];
		$p=$row['email'];
		$flag="";
		$check1=mysqli_query($con,"select * from `friends-table`");
		while($row1=mysqli_fetch_assoc($check1))
		{
			if($row1['user1']==$u && $row1['user2']==$p || $row1['user1']==$p && $row1['user2']==$u)
			{
				$flag="already friends";
			}
		}
		$check2=mysqli_query($con,"select count(*) as counter from `friendrequest-table` where receiver ='$u' and sender='$p'");
		$counter=mysqli_fetch_assoc($check2);
		$c=$counter['counter'];
		
		if($flag!="already friends" && $c!=0)
		{
		$stmt = $dbh->prepare("insert into `friends-table` (user1,user2) VALUES(:u,:p)");
		$stmt->bindParam(':u',$u);
		$stmt->bindParam(':p',$p);
		$stmt->execute();
		
		$stmt = $dbh->prepare("delete  from `friendrequest-table` where sender= '$p' and receiver= '$u'");
		$stmt->execute();
		}
	    else if($flag=="already friends")
		{
			echo '<script>alert("you are already friend with "'.$var.'");</script>';
		}
		else
		{
			echo '<script>alert("'.$var.' deleted the request");</script>';
		}
	}
	
	if(isset($_POST['cancel_btn']))
	{
		//echo '<script>alert("fool");</script>';
		require 'connection.php';
		$var = $_GET['search'];
		$check=mysqli_query($con,"select * from `registration-table` where username = '$var'");
		$row=mysqli_fetch_assoc($check);
		$u=$_SESSION['email'];
		$p=$row['email'];	
		$check2=mysqli_query($con,"select count(*) as counter from `friendrequest-table` where receiver ='$p' and sender='$u'");
		$counter=mysqli_fetch_assoc($check2);
		$c=$counter['counter'];
		$check3=mysqli_query($con,"select count(*) as counter from `friends-table` where user1 ='$u' and user2='$p' or user1 ='$p' and user2='$u'");
		$counter=mysqli_fetch_assoc($check3);
		$c1=$counter['counter'];
		if($c1!=0 && $c==0)
		{
			echo '<script>alert("the request cannot be proccessed");</script>';
		}
		
		else
		{
		$stmt = $dbh->prepare("delete  from `friendrequest-table` where sender= '$u' and receiver= '$p'");
		$stmt->execute();
		}
		
	}
	
	if(isset($_POST['unfrnd_btn']))
	{
		//echo '<script>alert("fool");</script>';
		require 'connection.php';
		$var = $_GET['search'];
		$check=mysqli_query($con,"select * from `registration-table` where username = '$var'");
		$row=mysqli_fetch_assoc($check);
		$u=$_SESSION['email'];
		$p=$row['email'];	
		$stmt = $dbh->prepare("delete  from `friends-table` where user1= '$u' and user2= '$p' or user1= '$p' and user2= '$u' ");
		$stmt->execute();
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

#yourBtn
{
   position: absolute;
       top: 264px;
	   left:29px;
   font-family: calibri;
   width: 178px;
   padding: 10px;
   -webkit-border-radius: 5px;
   -moz-border-radius: 5px;
   border: 1px dashed #BBB; 
   text-align: center;
   background-color: #fff;
   opacity:0.6;
   cursor:pointer;
  }
  #yourcvrBtn
{
   position: absolute;
       top: 83px;
	   left:913px;
   font-family: calibri;
   width: 150px;
   padding: 10px;
   -webkit-border-radius: 5px;
   -moz-border-radius: 5px;
   border: 1px dashed #BBB; 
   text-align: center;
   background-color: #fff;
   opacity:0.6;
   
   cursor:pointer;
  }
  #yourcvrBtn:hover
  {
	background-color: #ddd;
  }
  #yourBtn:hover
  {
	background-color: #ddd;
  }
  
</style>
<script type="text/javascript">
 function getFile(){
   document.getElementById("lele").click();
 }
 function sub(obj){
    var file = obj.value;
    var fileName = file.split("\\");
    document.getElementById("yourBtn").innerHTML = fileName[fileName.length-1];
    document.myForm.submit();
    event.preventDefault();
  }
  
 
</script>

<script>
function showlike(str1)
{
var fw="thmb"+str1;
var xmlhttp;
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
		     document.getElementById(fw).innerHTML = xmlhttp.responseText;
			 
        }
    }
    xmlhttp.open("GET","showlike.php?postid="+str1,true);
    xmlhttp.send();

}
function like_btn(str1)
{
	var xmlhttp;
	var fw="likebadge"+str1; 
	var value= document.getElementById("like"+str1).innerHTML;
	//alert(value);
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
		     
			 document.getElementById(fw).innerHTML= xmlhttp.responseText;
			 if(document.getElementById("like"+str1).innerHTML=="Like")
			 document.getElementById("like"+str1).innerHTML= "Unlike";
			 else
			 document.getElementById("like"+str1).innerHTML= "Like";
        }
    }
    xmlhttp.open("GET","likebadge.php?postid="+str1+"&v="+value,true);
    xmlhttp.send();
}
window.onload=like_btn; 

function update_comment(str1)
{
var fw="comment1"+str1;
var len=document.getElementById(fw).value.length;
var xmlhttp;
if(len>0)
{

var msg = document.getElementById(fw).value;
 var str=msg;
 /*var res = str.split(" ");
			var ori = "";
			var i = 0;
			var len = res.length;
			var s=0;
			var t=32;
			for(i=0;i<len;i++)
			{
				s=res[i].length/t;
				r= res[i].length%t;
				if(s==0)
				{
					ori = ori + res[i] + " ";
				}  
				else
				{
					var k=0;
					for(j=0;j<s;j++)
					{
      
					var y= res[i].slice(k,t+k);
					ori = ori + y + " ";
					k = k + t; 
					}
					ori = ori + res[i].slice(k,k+r) + " ";
				}		
			}*/
    }
 var ori=encodeURIComponent(msg);
    if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
			 document.getElementById(fw).value="";
			 document.getElementById(str1).innerHTML=xmlhttp.responseText+document.getElementById(str1).innerHTML;
        }
    }
    xmlhttp.open("GET","update_cmnt.php?postid="+str1+"&comment="+ori,true);
    xmlhttp.send();
}


function all_comments(str1)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
		     var fw="cid"+str1; 
			 document.getElementById(fw).innerHTML="";
			 document.getElementById(fw).innerHTML=xmlhttp.responseText+document.getElementById(fw).innerHTML;
			 document.getElementById("see"+str1).style.display="none";
        }
    }
    xmlhttp.open("GET","all_cmnt.php?postid="+str1,true);
    xmlhttp.send();
}



function update_status(postedon)
{
  
 var xmlhttp;
 var len = document.getElementById("comment").value.length;
 if(len>0)
 {
 var msg = document.getElementById("comment").value;
 var str=msg;
 /*
 var res = str.split(" ");
			var ori = "";
			var i = 0;
			var len = res.length;
			var s=0;
			var t=32;
			for(i=0;i<len;i++)
			{
				s=res[i].length/t;
				r= res[i].length%t;
				if(s==0)
				{
					ori = ori + res[i] + " ";
				}  
				else
				{
					var k=0;
					for(j=0;j<s;j++)
					{
      
					var y= res[i].slice(k,t+k);
					ori = ori + y + " ";
					k = k + t; 
					}
					ori = ori + res[i].slice(k,k+r) + " ";
				}		
			}*/
    }
 var ori=encodeURIComponent(str);
 //ori="<pre>"+ori+"</pre>";
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

    xmlhttp.onreadystatechange=function() 
	{
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
		document.getElementById("comment").value="";	
		document.getElementById("after_update").innerHTML=xmlhttp.responseText+document.getElementById("after_update").innerHTML;
		document.getElementById("after_update").style.display="block";
        }
    }
    xmlhttp.open("GET","update_profile_status.php?status="+ori+"&postedon="+postedon,true);
    xmlhttp.send();	
}

</script>
<style>
 .updtae_status-name 
            {
                padding-left: 10px;
                padding-right: 10px;
                margin-bottom: 4px;
                font-size: 12px;
            }
            
            .updtae_status span
            {
                padding-left: 5px;
            }
            .updtae_status-name a
            {
                display: block;
                height: 100%;
                text-decoration: none;
                color: inherit;
            }
            
            
            .updtae_status-name img
            {
                width: 32px;
                height: 32px;
                vertical-align:middle;
            }

</style>

  
  
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
	
	<div style="padding:0px 700px;  " >
	 <form action="#" method="POST" enctype="multipart/form-data" name="myForm">
	 <div id="yourcvrBtn" onclick="getFile1()">upload<span class="glyphicon glyphicon-camera" aria-hidden="true"></span></div>
	 <div style="height: 0px;width: 0px; overflow:hidden;"><input id="upfile1" type="file" name ="file1" value="upload" onchange="sub1(this)"/></div>
	 </form>
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
	  <div class="panel panel-header" style="height:200px;" id="after edit">
	
			<form action="#" method="POST"> 
			<div style="padding:10px 10px;">
			<button type="submit" class="btn btn-primary"  name="about" value="abcd"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp;About</button><p>	
		    </div> </form>		<?php
		require 'connection.php';
		$var = $_GET['search'];
		$check=mysqli_query($con,"select * from `about-table` where username = '$var'");
		if(!$check)
		{
			exit;
		}
		$row=mysqli_fetch_assoc($check);
		$v1=$row['email'];
		//echo $v1;
		$v2=$row['username'];
		$v3=$row['homecity'];
		
			   echo '
			<div class="sidebar-name" style="font-size:20px;">
                
                    
					<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <span style="font-color:grey;">&nbsp;&nbsp;&nbsp;<font color="#6a7180">Email :</font></span>
                    <font color="#3b5998">'.$v1.'</font>
				
            </div>';
	   
	     
	   
	   	   echo '
			<div class="sidebar-name" style="font-size:20px;">
                
                    
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span> <span style="font-color:grey;">&nbsp;&nbsp;&nbsp;<font color="#6a7180">Username :</font></span>
                    <font color="#3b5998">'.$v2.'</font>
				
            </div>';
	  	   echo '
			<div class="sidebar-name" style="font-size:20px;">
                
                    
					<span class="glyphicon glyphicon-home" aria-hidden="true"></span> <span style="font-color:grey;">&nbsp;&nbsp;&nbsp<font color="#6a7180">Home City:</font></span>
                     <font color="#3b5998">'.$v3.'</font>
              
				
            </div>';?>
			
	      </div>
     	 
      </div>
      
  <div class="list-group">
  
   <a href ="show_friends.php?search=<?php 
		echo $_GET['search'];
	  ?>" class="list-group-item active">
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
		  $cnt=$cnt+1;
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
		 if($cnt>3)
		 {
		 break;
		 }
		 
		}
			
  ?>
  <!--- dont delete it may cause fuzzy --->
 <div class="panel-body">
  </div>
</div>
    
    </div>
	<!--- Center block---> 
		<div class="profile-center-block">                                   
			  <div class="panel panel-default" style="height:250px;">
					<div class="panel-body">
					<form role="form">
                    <div class="form-group">
        	  	    <button type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                    <b>Update Status <i>
					<div style="padding:5px 0px;" >
				    <textarea class="form-control" rows="5" id="comment" placeholder="What's on your mind?" ></textarea></b></i>
					</div>
					<div style="padding:0px 400px;">
					<button class="btn btn-primary" style="width:70px;" type="button" name="post_status" onclick="update_status('<?php 
					  
					  $curruser =$_GET['search'];
					  $check1=mysqli_query($con,"select * from `registration-table` where username = '$curruser'");
						$row1=mysqli_fetch_assoc($check1);
						$postedon=$row1['email'];
				   
					  echo ''.$postedon.'';
					?>')">POST
					</button>
					</div>
      			    </div>
	                  
				    </form>
					</div>
		           
			   </div>
                			   
                <div id="after_update">
				<?php
				$email=$_SESSION['email'];
                $profile=$_GET['search'];
                 require 'connection.php';
                 
				 $check1=mysqli_query($con,"select * from `registration-table` where username = '$profile'");
		         $row1=mysqli_fetch_assoc($check1);
		         $postedon=$row1['email'];
				 
                 $check=mysqli_query($con,"select * from `status-table` where postedon = '$postedon' order by time desc"); 
				 
				 while($row=mysqli_fetch_assoc($check))
				  {
				  $status=$row['status'];
				  $time=$row['time'];
				  $actual_time = date('D M Y H : i',$time);
                  $postedby =$row['postedby'];
				 $check2=mysqli_query($con,"select * from `registration-table` where email = '$postedby'");
		         $row2=mysqli_fetch_assoc($check2);
		         $name=$row2['name'];
				 $postid=$row['postid'];
				  echo '<div class="panel panel-default">';
				  echo '
                       <div class="panel-heading">
                       <h3 class="panel-title"><img width="60" height="60" src="users\\'.$postedby.'\profilepic.jpg" />'.$name.'</h3>
					   '.$actual_time.'
                       </div>
                       <div class="panel-body">
                       <pre>'.$status.'</pre>';
					   
						$check5=mysqli_query($con,"select count(*) as counter1 from `like-table` where postid='$postid' and likedby='$email'");
						$counter1=mysqli_fetch_assoc($check5);
						$c=$counter1['counter1'];
						if($c==0)
						{
					    echo '<div style="padding:0px 5px;">						
					    <button class="btn btn-primary" style="width:80px;" type="button" name="like_status" onclick="like_btn('.$postid.')" >
						<span id="like'.$postid.'">Like</span></button>';
						}
						else
						{
						echo '<div style="padding:0px 5px;">
						
					    <button class="btn btn-primary" style="width:80px;" type="button" name="like_status" onclick="like_btn('.$postid.')" >
						<span id="like'.$postid.'">Unlike</span></button>';
						
						}
						
						
						
						$check4=mysqli_query($con,"select count(*) as counter from `like-table` where postid='$postid' ");
						$counter=mysqli_fetch_assoc($check4);
						$c=$counter['counter'];
						
						
						
						
						
		                 
						
					    echo '<span style="float:right;" >
						<div class="btn-group">
						<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" onclick="showlike('.$postid.')" style="padding:0px 15px;">
						<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span><span class="badge" id="likebadge'.$postid.'" value="like" style="color:red;">'.$c.'</span></span><span class="caret"></span></button>
					     <ul class="dropdown-menu" role="menu" style="width:100px;" id="thmb'.$postid.'">
						</ul>
						</div>
						</span>
						</div>
						
						<div id="'.$postid.'">
						</div>
						<div style="padding:5px 0px;" >
				      <textarea class="form-control" rows="1" id="comment1'.$postid.'" placeholder="comment here" ></textarea>
					  </div>
					  <div style="padding:0px 2px;">
					  <button class="btn btn-primary" style="width:80px;" type="button" name="post_comment" onclick="update_comment('.$postid.')">comment
					  </button>
					   </div>
                      </div>' 
						;
						$f=0;
					   $count2=1;
					   $check3=mysqli_query($con,"select * from `comment-table` where postid='$postid' order by time desc");
					   echo'<div class="panel panel-default" id="cid'.$postid.'">';
					    
					   while($row3=mysqli_fetch_assoc($check3))
					   {
					   $commentedby = $row3['commentedby'];
					   $cmnt = $row3['comment'];
					   $time = $row3['time'];
				       $time = date('D M Y H : i',$time);
					    echo '
                        <div class="panel-heading">
				        <h3 class="panel-title"><img width="30" height="30" src="users\\'.$commentedby.'\profilepic.jpg" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$cmnt.'</h3>
				        <i>'.$time.'</i>
				        </div>
				
					     ' ;
					   $count2 = $count2 + 1;
					   if($count2>3)
					   {
					   $f=1;
					   break;
					   }
					   }
					   echo '</div>';
					   
						if($f==1)
						{
						echo '
						<div style="padding:0px 2px;" id="see'.$postid.'">
					    <button class="btn btn-primary" style="width:150px;" type="button" name="post_comment" onclick="all_comments('.$postid.')">See All comments
					    </button>
					    </div>';
					   }
					   
						echo'
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