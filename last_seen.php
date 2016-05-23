<?php
		session_start();
		require 'connection.php';
		$email = $_SESSION['email'];
		$time=time();
		$time = 16200 + $time;
		$check=mysqli_query($con,"update `online-table` set time='$time' where email='$email'");
		$row=mysqli_fetch_assoc($check);
		
?>