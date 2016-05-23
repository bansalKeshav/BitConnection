<?php
	$user="root";
	$pass="";
	$host="localhost";
	$con = mysqli_connect($host,$user,$pass,"soc_net");
	if(!$con)
	{
		die('Could not connect:'.mysql_error());
	}
	mysqli_select_db($con,"soc_net");
	$dsn='mysql:dbname=soc_net;host=127.0.0.1';
	$dbh = new PDO($dsn,$user,$pass);
?>