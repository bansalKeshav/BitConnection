<?php
        session_start();
		require 'connection.php';
		$email = $_SESSION['email'];
		$check=mysqli_query($con,"select * from `friendrequest-table` where receiver='$email'" );
		while($row=mysqli_fetch_assoc($check))
		{
			$frnd=$row['sender'];
			$que=mysqli_query($con,"select * from `registration-table` where email='$frnd'");
		    $res=mysqli_fetch_assoc($que);
		   $name = $res['name'];
		      echo '<div class="panel panel-default">
			        <div class="msgbar-name">
                    <img width="60" height="60" src= "users\\'.$frnd.'\profilepic.jpg"/>	
                     '.$name.'		
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<div class="btn-group" id="'.$email.'">
							<button type="button" class="btn btn-info btn-xs"  onclick="confirm('."'$email'".','."'$frnd'".') "style="width:70px;" ">CONFIRM</button>
							</div>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<div class="btn-group" id="'.$email.'">
						    <button type="button" class="btn btn-danger btn-xs" onclick="reject('."'$email'".','."'$frnd'".')" ">DELETE REQUEST </button>
						    </div>					 
					</div>
					</div>';
		
		}
		echo '<li class="msgbar-name">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No More Request</li>';
	     /*<div class="msgbar-name">
                    <img width="30" height="30" src= "users\\'.$frnd.'\profilepic.jpg"/>		
					</div><p>*/
		?>