<style>
 .searchbar-name 
            {
                padding-left: 10px;
                padding-right: 10px;
                margin-bottom: 4px;
                font-size: 12px;
            }
            
            .searchbar-name span
            {
                padding-left: 5px;
            }
            
            .searchbar-name a
            {
                display: block;
                height: 100%;
                text-decoration: none;
                color: inherit;
            }
            
            .searchbar-name:hover
            {
                background-color:#e1e2e5;
            }
            
            .searchbar-name img
            {
                width: 32px;
                height: 32px;
                vertical-align:middle;
            }
</style>

<?php
		
		session_start();
		require 'connection.php';
		$sender = $_SESSION['email'];
		$username = $_GET['q'];
		$check=mysqli_query($con,"select * from `registration-table` where username like '%$username%'  ");
		while($row=mysqli_fetch_assoc($check))
		{ 
		 $frnd=$row['username'];
		 $check1=mysqli_query($con,"select * from `registration-table` where username ='$frnd'  ");
		 $row1=mysqli_fetch_assoc($check1);
		 $frndemail=$row1['email'];
		 echo '<div class="searchbar-name" style="z-index:10000;"> 
		        <a href="profile.php?search='.$frnd.'">
                    <img width="30" height="30" src="users\\'.$frndemail.'\profilepic.jpg" />
                    <span>'.$frnd.'</span>
                </a>
				</div>';
		}
	
?>