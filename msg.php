<?php
		session_start();
		require 'connection.php';
		$sender = $_SESSION['email'];
		$receiver = $_GET['receiver'];
		$message = $_GET['msg'];
		$time=time();
		$time = 16200 + $time;
		$stmt = $dbh->prepare("insert into `message-table` (sender,receiver,message,time) VALUES(:u,:p,:m,:t)");
		$stmt->bindParam(':u',$sender);
		$stmt->bindParam(':p',$receiver);
		$stmt->bindParam(':m',$message);
		$stmt->bindParam(':t',$time);
		$stmt->execute();
		echo '<pre>'.htmlentities($message).'</pre>';
?>