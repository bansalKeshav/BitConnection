<?php
session_start();
require 'connection.php';
$email = $_SESSION['email'];
$count=0;
$check=mysqli_query($con,"select count(*) from `status-table` where postedon = '$email'  or postedby = '$email' or 
				 postedby in (select user1 from `friends-table` where user2='$email' ) or
				 postedby in (select user2 from `friends-table` where user1='$email') or
				 postedon in (select user1 from `friends-table` where user2='$email' ) or
				 postedon in (select user2 from `friends-table` where user1='$email')
				 "); 
   while($row=mysqli_fetch_assoc($check))
	{ 	
		$count=$count+1;
		//echo '<li class="list-group-item list-group-item-success-">'.$row['message'].'</li>';
	}
	echo $count;
?>