<?php
session_start();
require 'connection.php';
$likedby = $_SESSION['email'];
$postid = $_GET['postid'];
$value = $_GET['v'];

if($value=="Like")
{		
$stmt = $dbh->prepare("insert into `like-table` (postid,likedby) VALUES(:u,:p)");
		$stmt->bindParam(':u',$postid);
		$stmt->bindParam(':p',$likedby);
		$stmt->execute();
}

else 
{
	$stmt = $dbh->prepare("delete  from `like-table` where postid= '$postid' and likedby= '$likedby'");
	$stmt->execute();
}
		$check1=mysqli_query($con,"select * from `like-table` where postid='$postid' ");
		$cnt=0;
		while($row1=mysqli_fetch_assoc($check1))
		{
		$cnt = $cnt + 1;
		}
		echo $cnt;
?>