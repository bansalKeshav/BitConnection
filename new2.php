<?php
session_start();
if(isset($_SESSION['email']))
{
if(isset($_FILES['file']['name']))
{
	if(!empty($_FILES['file']['name']))
	{
	$name = $_FILES['file']['name'];
	$extension =strtolower(substr($name,strpos($name,'.')+1));
	$type = $_FILES['file']['type'];
	$tmp_name = $_FILES['file']['tmp_name'];
	$email = $_SESSION['email'];
	if(($extension=="jpeg" || $extension=="png" || $extension=="jpg" )&& ($type=="image/jpeg"))
	{
		$name="profilepic".".jpg";
		echo $name;
		$location = "users/".$email."/";
		if(move_uploaded_file($tmp_name,$location.$name))
		{
			echo "uploaded successfully";
			echo $tmp_name;
			echo $location.$name;
		}
		else
		{
			echo "there was an error.";
		}
		
	}
	else
	{
		echo "file must be jpeg or smaller in size";
	}
	}
	else
	{
			echo "please choose a file";
	}
}
}
?>

<form action="new2.php" method="POST" enctype="multipart/form-data">
	<input type="file" name="file"><br><br>
	<input type="submit" value="Submit">
</form>
	
	