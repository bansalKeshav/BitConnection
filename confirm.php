<?php
		require 'connection.php';
		$sender = $_GET['sender'];
		$receiver = $_GET['receiver'];
		$flag="";
		$check1=mysqli_query($con,"select * from `friends-table`");
		while($row1=mysqli_fetch_assoc($check1))
		{
			if($row1['user1']==$sender && $row1['user2']==$receiver || $row1['user1']==$receiver && $row1['user2']==$sender)
			{
				$flag="already friends";
			}
		}
		if($flag!="already friends")
		{
		$stmt = $dbh->prepare("insert into `friends-table` (user1,user2) VALUES(:u,:p)");
		$stmt->bindParam(':u',$sender);
		$stmt->bindParam(':p',$receiver);
		$stmt->execute();
		$stmt = $dbh->prepare("delete  from `friendrequest-table` where sender= '$sender' and receiver= '$receiver'");
		$stmt->execute();
		}
?>