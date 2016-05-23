<?php
?>
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
<script>


</script>
<script>
function receivemsg()
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
							document.getElementById("msg_update").innerHTML= xmlhttp.responseText;	
						}
						}
						xmlhttp.open("GET","receivemsg.php",true);
						xmlhttp.send(); 
				
}

function notifi_update()
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
							document.getElementById("notifi").innerHTML= xmlhttp.responseText;	
						}
						}
						xmlhttp.open("GET","notifiupdate.php",true);
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
			location.reload();
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
 function frndrequest()
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
							document.getElementById("frnd_request").innerHTML= xmlhttp.responseText;	
						}
						}
						xmlhttp.open("GET","frndrequest.php",true);
						xmlhttp.send(); 
						
						
 }
</script>

<div class="page-header">
        <div class="pull-left" style="color:lavenderblush; padding:20px 10px; font-size:25px">BIT CONNECTION</div>    
		<div class="pull-right" style="padding:30px 0px; padding-right:100px;">
   <button type="button" class="btn btn-default" style="padding:0px 15px;"><a href="homepage.php">HOME</a> <span class="glyphicon glyphicon-home" ></span></button>
    <div class="btn-group">
	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="padding:0px 15px;"  onclick="receivemsg()"><span class="glyphicon glyphicon-comment" ><span class="badge" id="msgbadge" style="color:red;">&nbsp;</span></span><span class="caret"></span></button>
	   <ul class="dropdown-menu" role="menu" style="width:350px;" id="msg_update">
        </ul>
		</div>
	<div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" onclick="frndrequest()" style="padding:0px 15px;">
        FRIEND REQUEST <span class="glyphicon glyphicon-user"></span><span class="caret"></span></button>
        <ul class="dropdown-menu" role="menu" style="width:350px;" id="frnd_request">
		
		
        </ul>
      </div>	
	
	
	<div class="btn-group">
	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="padding:0px 15px;" onclick="notifi_update()">NOTIFICATION <span class="glyphicon glyphicon-globe" ><span class="badge" id="notifibadge" style="backgroud-color:red;"></span></span><span class="caret"></span></button>
	<ul class="dropdown-menu" role="menu" style="width:350px;" id="notifi">
        </ul>
	</div>
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
		