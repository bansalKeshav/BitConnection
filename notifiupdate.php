<?php
session_start();
require 'connection.php';
$email = $_SESSION['email'];
$count=0;
$check=mysqli_query($con,"select * from `status-table` where postedon = '$email'   or 
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
				 
				  echo '
				       <div class="msgbar-name">
					
                    <img width="40" height="40" src= "users\\'.$postedby.'\profilepic.jpg"/>
                    <span>'.$name.' &nbsp;&nbsp; <pre>'.htmlentities($status).'</pre></span>
					
					
					</div>' ;
				    if($count>=5)
					break;
					$count=$count+1;
				  }
	             echo '<li class="list-group-item"><a href="homepage.php"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;See all</a></li>';
	            
?>