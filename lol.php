
<?php
?>

<!doctype html>
<html>
    <head>
        <title>Facebook Style Popup Design</title>
        <style>
            @media only screen and (max-width : 540px) 
            {
                .chat-sidebar
                {
                    display: none !important;
                }
                
                .chat-popup
                {
                    display: none !important;
                }
            }
            
            body
            {
                background-color: #e9eaed;
            }
            
            .chat-sidebar
            {
                width: 200px;
                position: fixed;
                height: 100%;
                right: 0px;
                top: 50px;
                padding-top: 10px;
                padding-bottom: 10px;
                border: 1px solid rgba(29, 49, 91, .3);
            }
            
            .sidebar-name 
            {
                padding-left: 10px;
                padding-right: 10px;
                margin-bottom: 4px;
                font-size: 12px;
            }
            
            .sidebar-name span
            {
                padding-left: 5px;
            }
            
            .sidebar-name a
            {
                display: block;
                height: 100%;
                text-decoration: none;
                color: inherit;
            }
            
            .sidebar-name:hover
            {
                background-color:#e1e2e5;
            }
            
            .sidebar-name img
            {
                width: 32px;
                height: 32px;
                vertical-align:middle;
            }
            
            .popup-box
            {
                display: none;
                position: fixed;
                bottom: 29px;
                right: 220px;
                height: 285px;
                background-color: rgb(237, 239, 244);
                width: 300px;
                border: 1px solid rgba(29, 49, 91, .3);
                z-index:1000;          
		  }
            
            .popup-box .popup-head
            {
                background-color: #6d84b4;
                padding: 5px;
                color: white;
                font-weight: bold;
                font-size: 14px;
                clear: both;
            }
            
            .popup-box .popup-head .popup-head-left
            {
                float: left;
            }
            
            .popup-box .popup-head .popup-head-right
            {
                float: right;
                opacity: 0.5;
            }
            
            .popup-box .popup-head .popup-head-right a
            {
                text-decoration: none;
                color: inherit;
            }
            
            .popup-box .popup-messages 
            {
                height: 90%;
                overflow-y:scroll;
            }
             
			 


        </style>	
		<script>
         function scroll_to(div)
		 {
          //if (document.getElementById(div).scrollTop < document.getElementById(div).scrollHeight - document.getElementById(div).scrollTop.clientHeight)
         // document.getElementById(div).scrollTo(0,document.getElementById(div).scrollHeight);
          document.getElementById(div).scrollTop+=document.getElementById(div).scrollHeight;
		 }
		 
		 
		function msgupdate(e,id)
		{			
		if(e.keycode==13 || e.which==13)
		{
			var tb=document.getElementById(id).value;
	       
			if(tb.length>0)
			{
			var len= id.length;
			var str2= id.substring(0,len-3);
			
			var str=tb;
            var res = str.split(" ");
			var ori = "";
			var i = 0;
			var len = res.length;
			var s=0;
			for(i=0;i<len;i++)
			{
				s=res[i].length/32;
				r= res[i].length%32;
				if(s==0)
				{
					ori = ori + res[i] + " ";
				}  
				else
				{
					var k=0;
					for(j=0;j<s;j++)
					{
      
					var y= res[i].slice(k,32+k);
					ori = ori + y + " ";
					k = k + 32; 
					}
					ori = ori + res[i].slice(k,k+r) + " ";
				}	
                
                			
			}
			ori=encodeURIComponent(ori);
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
			    document.getElementById(str2+"msg").value="";
				document.getElementById(str2+"msg1").innerHTML=document.getElementById(str2+"msg1").innerHTML + xmlhttp.responseText;
		        scroll_to(str2+"msg1");	    
			}
			}
			xmlhttp.open("GET","msg.php?receiver="+str2+"&msg="+ori,true);
			xmlhttp.send();
			scroll_to(str2+"msg1");
		}
		}
		}
            //this function can remove a array element.
            Array.remove = function(array, from, to) {
                var rest = array.slice((to || from) + 1 || array.length);
                array.length = from < 0 ? array.length + from : from;
                return array.push.apply(array, rest);
            };
        
            //this variable represents the total number of popups can be displayed according to the viewport width
            var total_popups = 0;
            
            //arrays of popups ids
            var popups = [];
            var myvar=[];
            //this is used to close a popup
            function close_popup(id)
            {	
                for(var iii = 0; iii < popups.length; iii++)
                {
                    if(id == popups[iii])
                    {
                        Array.remove(popups, iii);
                        
                        document.getElementById(id).style.display = "none";
                        
                        calculate_popups(id);
						clearTimeout(myvar[id]);
						
                        
                        return;
                    }
                }   
            }
            //displays the popups. Displays based on the maximum number of popups that can be displayed on the current viewport width
            function display_popups(id)
            {
				
                var right = 220;
                var iii = 0;
                for(iii; iii < total_popups; iii++)
                {
                    if(popups[iii] != undefined)
                    {
                        var element = document.getElementById(popups[iii]);
                        element.style.right = right + "px";
                        right = right + 320;
                        element.style.display = "block";
						//alert(iii);
						if(myvar[id]==undefined)
						{
							myvar[id] = setInterval(function(){
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
						    var len=document.getElementById(id+"msg1").innerHTML.length;
							document.getElementById(id+"msg1").innerHTML= xmlhttp.responseText;
							if(xmlhttp.responseText.length!=len-4)
							{
							scroll_to(id+"msg1");
							}
							
						}
						}
						xmlhttp.open("GET","chatpop.php?receiver="+id,true);
						xmlhttp.send(); 
						//scroll_to(id+"msg1");
						}, 2000);
						
					}
                    }
                }
                
                for(var jjj = iii; jjj < popups.length; jjj++)
                {
			        var element = document.getElementById(popups[jjj]);
                    element.style.display = "none";
					//clearTimeout(myvar[jjj]);
                }
            }
            
            //creates markup for a new popup. Adds the id to popups array.
            function register_popup(id,name,email,user)
            {
                //setInterval(function(){alert("hello");}, 2000);
				//alert("popup="+popups.length);
                for(var iii = 0; iii < popups.length; iii++)
                {   
                    //already registered. Bring it to front.
                    if(id == popups[iii])
                    {
                        Array.remove(popups, iii);
                    
                        popups.unshift(id);
                        
                        calculate_popups();
                        
                        
                        return;
                    }
                }               
                
                var element = '<div class="popup-box chat-popup" id="'+ id +'">';
                element = element + '<div class="popup-head">';
                element = element + '<div class="popup-head-left"><a href="profile.php?search='+user+'"><span style="color:black;">'+ name +'</span></a></div>';
                element = element + '<div class="popup-head-right"><a href="javascript:close_popup(\''+ id +'\');">&#10005;</a></div>';
                element = element + '<div style="clear: both"></div></div><div class="popup-messages" id ="'+id+'msg1">';
				element = element + '</div><div><input id="'+ id +'msg" type="text" name="text" style=" bottom:10px;width: 298px; " onkeypress="msgupdate(event,'+"id"+')" ></input></div></div>';
				
                document.getElementsByTagName("body")[0].innerHTML = document.getElementsByTagName("body")[0].innerHTML + element;  
                
                popups.unshift(id);
                        
                calculate_popups(id);
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
			    document.getElementById(id+"msg1").innerHTML= xmlhttp.responseText;
			    scroll_to(id+"msg1");
			}
			}
			xmlhttp.open("GET","chatpop.php?receiver="+id,true);
			xmlhttp.send(); 
                scroll_to(id+"msg1");
			
			}
            
            //calculate the total number of popups suitable and then populate the toatal_popups variable.
            function calculate_popups(id)
            {
                var width = window.innerWidth;
                if(width < 540)
                {
                    total_popups = 0;
                }
                else
                {
                    width = width - 200;
                    //320 is width of a single popup box
                    total_popups = parseInt(width/320);
                }
                
                display_popups(id);
                
            }
			
			
            //recalculate when window is loaded and also when window is resized.
            window.addEventListener("resize", calculate_popups);
            window.addEventListener("load", calculate_popups);
            function onlinefrnds()
			{
			
						setInterval(function(){
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
						  document.getElementById("sidebar").innerHTML= xmlhttp.responseText;	
						}
						}
						xmlhttp.open("GET","onlinefrnds.php",true);
						xmlhttp.send(); 
						//scroll_to(id+"msg1");
						}, 5000);			
			}
			
			function msgbadge()
            {
				setInterval(function(){
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
							document.getElementById("msgbadge").innerHTML= xmlhttp.responseText;
						}
						}
						xmlhttp.open("GET","headerbadge.php",true);
						xmlhttp.send(); 
						//scroll_to(id+"msg1");
						}, 2000);
						last_seen();

            }

function last_seen()
{
setInterval(function(){
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
							
						}
						}
						xmlhttp.open("GET","last_seen.php",true);
						xmlhttp.send(); 
						//scroll_to(id+"msg1");
						}, 5000);
onlinefrnds();
}
						
window.onload=msgbadge; 
			
			
			//window.onload=onlinefrnds;
        </script>
    </head>
    <body>
        <div class="chat-sidebar" id="sidebar">
           <?php
			require 'connection.php';
			
			$var=$_SESSION['email'];
			$check=mysqli_query($con,"select * from `friends-table` where user1 = '$var' or user2= '$var'");
			while($row=mysqli_fetch_assoc($check))
			{
			if($row['user2']==$var)
			{
			$frnd=$row['user1'];
			$que=mysqli_query($con,"select * from `registration-table` where email='$frnd'");
		    $res=mysqli_fetch_assoc($que);
			$email=$res['email'];
			$name = $res['name'];
			$user=$res['username'];
			echo '<div class="sidebar-name">
                <!-- Pass username and display name to register popup -->	
                <a href="javascript:register_popup('."'$frnd'".','."'$name'".','."'$email'".','."'$user'".');">
                    <img width="30" height="30" src="users\\'.$frnd.'\profilepic.jpg" />
                    <span>'.$name.'</span>
					
                </a>
				
            </div>
			';
			}
			else if($row['user1']==$var)
			{
			$frnd=$row['user2'];
			$que=mysqli_query($con,"select * from `registration-table` where email='$frnd'");
		    $res=mysqli_fetch_assoc($que);
			$email=$res['email'];
			$name = $res['name'];
			echo '<div class="sidebar-name">
                <!-- Pass username and display name to register popup -->
				
                <a href="javascript:register_popup('."'$frnd'".','."'$name'".','."'$email'".');">
                    <img width="30" height="30" src= "users\\'.$frnd.'\profilepic.jpg"/>
                    <span>'.$name.'</span>
					
                </a>
				
            </div>
			';
			}
		}
			?>
        </div>
    </body>
</html>




			