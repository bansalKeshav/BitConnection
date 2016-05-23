<?php
		require 'connection.php';
		$postid = $_GET['postid'];
		$check1=mysqli_query($con,"select * from `comment-table` where postid= '$postid' order by DESC");
		$count=1;
		while($row1=mysqli_fetch_assoc($check1) && $count<4)
		{
		    $comment=$row1['comment'];
			$commentedby=$row1['commentedby'];
		    echo '
			           <div class="panel-heading">
                       <h3 class="panel-title"><img width="60" height="60" src="users\\'.$commentedby.'\profilepic.jpg" />'.$comment.'</h3>
                       </div>';
					   
		 $count=$count+1;
		}
		
?>