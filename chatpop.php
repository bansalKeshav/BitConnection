<?php
		session_start();
		require 'connection.php';
		$sender = $_SESSION['email'];
		$receiver = $_GET['receiver'];
		$check=mysqli_query($con,"select * from `message-table` where sender = '$sender' and receiver= '$receiver' or sender='$receiver' and receiver= '$sender' ");
		$check1=mysqli_query($con,"update `message-table` set seen=1 where sender = '$receiver' and receiver= '$sender' and seen=0 ");
		while($row=mysqli_fetch_assoc($check))
		{ 
		 if($row['sender']==$sender)
		 {		
		 echo '<pre>'.htmlentities($row['message']).'</pre><p>';
         }
		 else if($row['sender']==$receiver)
		 {
		// echo '<img width="30" height="30" src= "users\\'.$receiver.'\profilepic.jpg"/>';
         echo '<img width="30" height="30" src= "users\\'.$receiver.'\profilepic.jpg"/>&nbsp;&nbsp;&nbsp;<pre>'.htmlentities($row['message']).'</pre><p>';
		 }

		}
?>