<?php
		session_start();
		require 'connection.php';
		$email = $_SESSION['email'];
		$check=mysqli_query($con,"select * from `message-table` where receiver = '$email' and seen = 0");
		while($row=mysqli_fetch_assoc($check))
		{ 
		 $sender=$row['sender'];
		 $check1=mysqli_query($con,"select * from `registration-table` where email = '$sender'");
		 $row1=mysqli_fetch_assoc($check1);
		 $name=$row1['name'];
		 $message=$row['message'];
		 echo '<div class="msgbar-name">
					<a href="javascript:register_popup('."'$sender'".','."'$name'".','."'$email'".');">
                    <img width="30" height="30" src= "users\\'.$sender.'\profilepic.jpg"/>
                    <span>'.$name.' &nbsp;&nbsp;<pre> '.htmlentities($message).'</pre></span>
                    </a>					
					</div><p>';
		}
		echo '<div class="msgbar-name">
					<a href="show_mesg.php" align="center">
                    <b>See All Messages</b>
                    </a>					
					</div><p>'
		 
?>