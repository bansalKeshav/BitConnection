<?php
		require 'connection.php';
		$postid = $_GET['postid'];
		$check1=mysqli_query($con,"select * from `comment-table` where postid= '$postid' order by time DESC");
		while($row1=mysqli_fetch_assoc($check1))
		{
		    $comment=$row1['comment'];
			$commentedby=$row1['commentedby'];
			 $time = $row1['time'];
			$time = date('D M Y H : i',$time);
		    echo '
			           <div class="panel-heading">
                       <h3 class="panel-title"><img width="30" height="30" src="users\\'.$commentedby.'\profilepic.jpg" /><pre>'.htmlentities($comment).'</pre></h3><i>'.$time.'</i>
                       </div>';
		}
		
?>