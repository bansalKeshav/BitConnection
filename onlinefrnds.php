 <?php
			require 'connection.php';
			$curr=time()+16200-5;
			session_start();
			$var=$_SESSION['email'];
			$check=mysqli_query($con,"select * from `friends-table` where user1 = '$var' or user2= '$var'");
			while($row=mysqli_fetch_assoc($check))
			{
			if($row['user2']==$var)
			{
			$frnd=$row['user1'];
			$que=mysqli_query($con,"select * from `registration-table` where email='$frnd'");
		    $res=mysqli_fetch_assoc($que);
			$email=$res['email'];
			$check1=mysqli_query($con,"select * from `online-table` where email = '$email'");
			$row1=mysqli_fetch_assoc($check1);
			$time=$row1['time'];
			$name = $res['name'];
			if($time>$curr)
			{
			$status="online";
			echo '<div class="sidebar-name">
                <!-- Pass username and display name to register popup -->	
                <a href="javascript:register_popup('."'$frnd'".','."'$name'".','."'$email'".');">
                    <img width="30" height="30" src="users\\'.$frnd.'\profilepic.jpg" />
                    <span>'.$name.'</span>
					<span style="padding:0px 30px;"><b style="color:green;">'.$status.'</b></span>
                </a>
				
            </div>
			';
			}
			else
			{
			$status="offline";
			echo '<div class="sidebar-name">
                <!-- Pass username and display name to register popup -->	
                <a href="javascript:register_popup('."'$frnd'".','."'$name'".','."'$email'".');">
                    <img width="30" height="30" src="users\\'.$frnd.'\profilepic.jpg" />
                    <span>'.$name.'</span>
					<span style="padding:0px 30px;"><b style="color:red;">'.$status.'</b></span>
                </a>
            </div>
			';
			}
			
			
			}
			else if($row['user1']==$var)
			{
			$frnd=$row['user2'];
			$que=mysqli_query($con,"select * from `registration-table` where email='$frnd'");
		    $res=mysqli_fetch_assoc($que);
			$email=$res['email'];
			$name = $res['name'];
			$check1=mysqli_query($con,"select * from `online-table` where email = '$email'");
			$row1=mysqli_fetch_assoc($check1);
			$time=$row1['time'];
			if($time>$curr)
			{
			$status="online";
			echo '<div class="sidebar-name">
                <!-- Pass username and display name to register popup -->	
                <a href="javascript:register_popup('."'$frnd'".','."'$name'".','."'$email'".');">
                    <img width="30" height="30" src="users\\'.$frnd.'\profilepic.jpg" />
                    <span>'.$name.'</span>
					<span style="padding:0px 30px;"><b style="color:green;"align="right">'.$status.'</b></span>
                </a>
            </div>
			';
			}
			else
			{
			$status="offline";
			echo '<div class="sidebar-name">
                <!-- Pass username and display name to register popup -->	
                <a href="javascript:register_popup('."'$frnd'".','."'$name'".','."'$email'".');">
                    <img width="30" height="30" src="users\\'.$frnd.'\profilepic.jpg" />
                    <span>'.$name.'</span>
					<span style="padding:0px 30px;"><b style="color:red;" align="right">'.$status.'</b></span>
                </a>
				
            </div>
			';
			}
			}
		}
			?>
            			