<?php
session_start();
$postedby=$_SESSION['email'];
$time=time();
$time = 16200 + $time;
require 'connection.php';
$status= $_GET['status'];
$postedon= $_GET['postedon'];

		$stmt = $dbh->prepare("insert into `status-table` (postedby,postedon ,status,time) VALUES(:s,:u,:p,:t)");
        $stmt->bindParam(':s',$postedby);
		$stmt->bindParam(':u',$postedon);
		$stmt->bindParam(':p',$status);
		$stmt->bindParam(':t',$time);
		$stmt->execute();
		
        $check=mysqli_query($con,"select * from `registration-table` where email = '$postedby'");
		$row=mysqli_fetch_assoc($check);
		$name=$row['name'];
		
      echo '<div class="panel panel-default">
     <div class="panel-heading">
     <h3 class="panel-title"><img width="60" height="60" src="users\\'.$postedby.'\profilepic.jpg" />'.$name.'</h3>
	 <i> just now</i>
     </div>
     <div class="panel-body">
    '.$status.'
      </div>
</div>' ;


?>