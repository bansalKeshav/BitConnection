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
		$check1=mysqli_query($con,"select * from `status-table` where postedby = '$postedby' and time='$time'");
		$row1=mysqli_fetch_assoc($check1);
		$postid=$row1['postid'];
		$c=0;
	  echo '<div class="panel panel-default">
     <div class="panel-heading">
     <h3 class="panel-title"><img width="60" height="60" src="users\\'.$postedby.'\profilepic.jpg" />'.$name.'</h3>
	 <i> just now</i>
     </div>
     <div class="panel-body"> 
	 <pre>'.htmlentities($status).'</pre>
	
	<div style="padding:0px 5px;">						
	<button class="btn btn-primary" style="width:80px;" type="button" name="like_status" onclick="like_btn('.$postid.')" >
	<span id="like'.$postid.'">Like</span></button>
	<span style="float:right;" >
						<div class="btn-group">
						<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" onclick="showlike('.$postid.')" style="padding:0px 15px;">
						<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span><span class="badge" id="likebadge'.$postid.'" value="like" style="color:red;">'.$c.'</span></span><span class="caret"></span></button>
					     <ul class="dropdown-menu" role="menu" style="width:100px;" id="thmb'.$postid.'">
						</ul>
						</div>
						</span>
      </div>
	  
	  <div id="'.$postid.'">
						</div>
						<div style="padding:5px 0px;" >
				      <textarea class="form-control" rows="1" id="comment1'.$postid.'" placeholder="comment here" ></textarea>
					  </div>
					  <div style="padding:0px 2px;">
					  <button class="btn btn-primary" style="width:80px;" type="button" name="post_comment" onclick="update_comment('.$postid.')">comment
					  </button>
					   </div>
                      </div>
      </div>' ;


?>