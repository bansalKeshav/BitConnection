<?php
session_start();
require 'connection.php';
$receiver = $_SESSION['email'];
$count=0;
$check=mysqli_query($con,"select * from `message-table` where receiver= '$receiver' and seen = 0 ");
   while($row=mysqli_fetch_assoc($check))
	{ 	
		$count=$count+1;
		//echo '<li class="list-group-item list-group-item-success-">'.$row['message'].'</li>';
	}
	echo $count;
?>