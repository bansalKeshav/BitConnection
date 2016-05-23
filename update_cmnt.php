<?php
		require 'connection.php';
		session_start();
		$postid = $_GET['postid'];
		$time=time();
		$time = 16200 + $time;
		$commentedby = $_SESSION['email'];
		$cmnt=$_GET['comment'];
		$stmt = $dbh->prepare("insert into `comment-table` (postid,comment,commentedby,time) VALUES(:u,:p,:r,:t)");
		$stmt->bindParam(':u',$postid);
		$stmt->bindParam(':p',$cmnt);
		$stmt->bindParam(':r',$commentedby);
		$stmt->bindParam(':t',$time);
		$stmt->execute();
		
		
		
		echo '<div class="panel-heading">
				 <h3 class="panel-title"><img width="30" height="30" src="users\\'.$commentedby.'\profilepic.jpg" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<pre>'.htmlentities($cmnt).'</pre></h3>
				 <i> just now</i>
				</div>
					' ;
		
?>