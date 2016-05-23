<?php
session_start();
require 'connection.php';
$likedby = $_SESSION['email'];
$postid = $_GET['postid'];
	$check1=mysqli_query($con,"select * from `like-table` where postid='$postid' ");
	    $c=0;
		while($row1=mysqli_fetch_assoc($check1))
		{
		$check2=mysqli_query($con,"select * from `registration-table` where email='$likedby' ");
		$row2=mysqli_fetch_assoc($check2);
		$username = $row2['username'];
		$name = $row2['name'];
		$c=$c+1;
		 echo '
		 <div class="msgbar-name">
					<a href="profile.php?search='.$username.'">
                    <img width="40" height="40" src= "users\\'.$likedby.'\profilepic.jpg"/>
                    <span>'.$name.'</span></a>
					</div>';
		}
		if($c==0)
		echo'<div class="msgbar-name"><li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No likes</li><div>';
		
?>