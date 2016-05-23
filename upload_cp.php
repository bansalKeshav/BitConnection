<?php

if(isset($_SESSION['email']))
{
if(isset($_FILES['file1']['name']))
{
	if(!empty($_FILES['file1']['name']))
	{
	$name = $_FILES['file1']['name'];
	$extension =strtolower(substr($name,strpos($name,'.')+1));
	$type = $_FILES['file1']['type'];
	$tmp_name = $_FILES['file1']['tmp_name'];
	$email = $_SESSION['email'];
	if(($extension=="jpeg" || $extension=="png" || $extension=="jpg" ))
	{
		$name="coverpic.jpg";
		$location = "users/".$email."/";
		move_uploaded_file($tmp_name,$location.$name);
	}
	else
	{
		echo "file1 must be jpeg or smaller in size";
	}
	}
	else
	{
			echo "please choose a file1";
	}
}
}
?>


  
  