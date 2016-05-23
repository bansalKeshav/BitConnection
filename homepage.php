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
	<style>
#yourBtn
{
   position: absolute;
       top: 330px;
   font-family: calibri;
   width: 150px;
   padding: 10px;
   -webkit-border-radius: 5px;
   -moz-border-radius: 5px;
   border: 1px dashed #BBB; 
   text-align: center;
   background-color: #DDD;
   cursor:pointer;
  }
</style>
<script type="text/javascript">
 function getFile(){
   document.getElementById("upfile").click();
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
function confirm(str1,str2)
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
		    document.getElementById(str1).style.display="none";
			document.getElementById(str1+"frnd").style.display="block";
		}
    }
    xmlhttp.open("GET","confirm.php?receiver="+str1+"&sender="+str2,true);
    xmlhttp.send();
	
}
function reject(str1,str2)
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
			location.reload();
        }
    }
    xmlhttp.open("GET","reject.php?receiver="+str1+"&sender="+str2,true);
    xmlhttp.send();
	
}

function showhint(searchfrnd)
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
 if (searchfrnd.length == 0) { 
        document.getElementById("txthint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	            document.getElementById("frndwell").style.display="block";		
     			document.getElementById("txthint").innerHTML = xmlhttp.responseText;
			
			}
        }
        xmlhttp.open("GET", "searchfrnd.php?q="+searchfrnd, true);
        xmlhttp.send();
    }

}



function update_home_status()
{
 var xmlhttp;
 var len = document.getElementById("comment").value.length;
 if(len>0)
 {
 var msg = document.getElementById("comment").value;
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
 
            var ori=encodeURIComponent(msg);
 }
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
		
		 	
	     document.getElementById("after_update").innerHTML= xmlhttp.responseText + document.getElementById("after_update").innerHTML;
		 document.getElementById("comment").value="";
        }
    }
    xmlhttp.open("GET","update_home_status.php?status="+ori,true);
    xmlhttp.send();	
}




</script>
  
  
  
  </head>

  <body>
     <div class="container">
	 <?php
        require 'header.php';
	  ?>
	<!--- left Side container--->   
	   <div class="sab-kuch-in-left">
     <div class="container">
      <h2>
	  <?php
	  $check=mysqli_query($con,"select * from `registration-table` where email='$email'");
		$row=mysqli_fetch_assoc($check);
		echo $row['name'];
	  ?>
	  </h2>         
      <button type="button" class="btn" style="background-color:white;"<span><img src="<?php 
	  $email=$_SESSION['email'];
	echo "users\\".$email."\\profilepic.jpg"; 
	  ?>"
	  class="img-rounded" alt="Cinque Terre" width="180" height="236"></span> 
      </div>
	  <div style="padding:0px 38px;">
	<form action="#" method="POST" enctype="multipart/form-data" name="myForm">
	<div id="yourBtn" onclick="getFile()">upload<span class="glyphicon glyphicon-camera" aria-hidden="true"></span></div>
	<div style='height: 0px;width: 0px; overflow:hidden;'><input id="upfile" type="file" name ="file" value="upload" onchange="sub(this)"/></div>
	</form>
	</div>
     <div class="container" style="padding:80px 20px;">
    <div class="btn-group-vertical">
      <button type="button" class="btn btn-default" style="width:200px"><a href ="profile.php?search=<?php $var=$_SESSION['email'] ;
	  $check=mysqli_query($con,"select * from `registration-table` where email='$var'");
		$row=mysqli_fetch_assoc($check);
		echo $row['username'];
	  ?>"><?php
	echo $row['name'];
		
	  ?></a></button>
      <button type="button" class="btn btn-default"><a href ="about.php?search=<?php $var=$_SESSION['email'] ;
	  $check=mysqli_query($con,"select * from `registration-table` where email='$var'");
		$row=mysqli_fetch_assoc($check);
		echo $row['username'];
	  ?>">About</a></button>
      <div>
	  <div class="form-group" style="padding:30px 0px;">
	  <label for="user">FIND FRIEND</label>
	  <form action="" autocomplete="off"> 
	  <input type ="text" class="form-control" name="search" id ="tert" onkeyup="showhint(this.value)">
	  </form >
	   <div class="well well-sm" style="display:none;" id="frndwell">
	   <span id="txthint"></span>
	  </div>
	  </div>
	  </div>
	</div>
  </div>
    </div>
	<!--- Center block---> 
		<div class="center-block">                                   
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
					<button class="btn btn-primary" style="width:70px;" type="button" name="post_status" onclick="update_home_status('<?php 
					  
					  $postedon=$_SESSION['email'];
				   
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
                require 'connection.php';
                 
                 $check=mysqli_query($con,"select * from `status-table` where postedon = '$email'  or postedby = '$email' or 
				 postedby in (select user1 from `friends-table` where user2='$email' ) or
				 postedby in (select user2 from `friends-table` where user1='$email') or
				 postedon in (select user1 from `friends-table` where user2='$email' ) or
				 postedon in (select user2 from `friends-table` where user1='$email')
				 order by time desc"); 	 
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
                       <pre>'.htmlentities($status).'</pre>';
					   
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