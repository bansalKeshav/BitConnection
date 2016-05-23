<?php
		require 'connection.php';
		$sender = $_GET['sender'];
		$receiver = $_GET['receiver'];
		$stmt = $dbh->prepare("delete  from `friendrequest-table` where sender= '$sender' and receiver= '$receiver'");
		$stmt->execute();
?>