<?php
function recurse_copy($src,$dst)
{
	$dir=opendir($src);
	@mkdir($dst);
	while(false!==($file=readdir($dir)))
	{
		if(($file!='.')&&($file!='..'))
		{
			if((is_dir($src.'/'.$file)))
			{
				recurse_copy($src.'/'.$file,$dst.'/'.$file);
			}
			else
			{
				copy($src.'/'.$file,$dst.'/'.$file);
			}
		}
	}
closedir($dir);
}
if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name']) &&  isset($_POST['username']) && isset($_POST['gender']) &&isset($_POST['date'])
&&isset($_POST['password1']) && isset($_POST['sq1']) &&  isset($_POST['sq2']) && isset($_POST['sa1']) &&  isset($_POST['sa2']) )
	{
	
	if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['name']) &&  !empty($_POST['username']) && !empty($_POST['gender']) &&
!empty($_POST['date']) &&!empty($_POST['password1']) && !empty($_POST['sq1']) &&  !empty($_POST['sq2']) && !empty($_POST['sa1']) &&  !empty($_POST['sa2']) )
	{
	
	require 'connection.php';
	$email = $_POST['email'];
	$password = $_POST['password'];
 	$password1 = $_POST['password1'];
	$name =$_POST['name'];
	$dob=$_POST['dob'];
	$username = $_POST['username'];
	$sq1 = $_POST['sq1'];
	$sq2= $_POST['sq2'];
	$sa1 = $_POST['sa1'];
	$sa2= $_POST['sa2'];
	$gender = $_POST['gender'];
	$check=mysqli_query($con,"select * from `registration-table`");
    $roll_no=' abcd';
	$flag = 1;
	while($row=mysqli_fetch_assoc($check))
	{
		if($row['email']==$email)
		{
			echo '<script> alert("Email already registered");</script>';
			$flag=2;
			break;
		}
		if($row['username']==$username)
		{
			echo '<script> alert("username already registered");</script>';
			$flag=2;
			break;
		}
	}
	if($flag===1)
	{
	if($password===$password1)
	{
		$stmt = $dbh->prepare("insert into `registration-table`(name,email,username,gender,dob) VALUES(:nam,:em,:us,:gen,:dob)");
		$stmt->bindParam(':nam',$name);
		$stmt->bindParam(':em',$email);
		$stmt->bindParam(':us',$username);
		$stmt->bindParam(':gen',$gender);
		$stmt->bindParam(':dob',$dob);
		$stmt->execute();
		$stmt = $dbh->prepare("insert into `login-table`(email,password,sq1,sq2,sa1,sa2) VALUES(:em,:pa,:q1,:q2,:a1,:a2)");
		$stmt->bindParam(':em',$email);
		$stmt->bindParam(':pa',$password);
		$stmt->bindParam(':q1',$sq1);
		$stmt->bindParam(':q2',$sq2);
		$stmt->bindParam(':a1',$sa1);
		$stmt->bindParam(':a2',$sa2);
		$stmt->execute();
		
		$stmt = $dbh->prepare("insert into `about-table` (email,username) VALUES(:em,:u)");
		$stmt->bindParam(':em',$email);
		$stmt->bindParam(':u',$username);
		$stmt->execute();
		$time=time();
		$time = 16200 + $time;
		$status=0;
		$stmt = $dbh->prepare("insert into `online-table` (email,time,status) VALUES(:u,:p,:r)");
		$stmt->bindParam(':u',$email);
		$stmt->bindParam(':p',$time);
		$stmt->bindParam(':r',$status);
		$stmt->execute();
		mkdir("users/".$email,0755);
		mkdir("users/".$email."/gallery");
		recurse_copy("temp/","users/".$email."/");
		header('Location: signin.php');
	}
	else
	{
		echo '<script> alert("Password Do not Match");</script>';
    }
	}
}
else
{
	echo '<script> alert("please fill all the * marked details");</script>';
}

}
?>
<!DOCTYPE html>
<html >
<style>

body{
    background-image: url("facebook-user.jpg");
    background-color: #cccccc;
}
</style>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Bootstrap Registration Page</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="docs/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLE CSS -->
    <link href="docs/assets/css/font-awesome.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="docs/assets/css/style.css" rel="stylesheet" />    
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <script src="docs/assets/js/ie-emulation-modes-warning.js"></script>

</head>
<body >
    <div class="container">
        <div class="row text-center pad-top ">
            <div class="col-md-12">
                <h2>BIT CONNECTION</h2>
            </div>
        </div>
         <div class="row  pad-top">
               
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <strong>   Register Yourself </strong>  
                            </div>
                            <div class="panel-body">
                                <form role="form" action="#" method="POST">
<br/>
                                        <div class="form-group input-group">
                                          <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                            <input type="text" class="form-control" name="name" placeholder="Your Name" />
                                        </div>
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
                                            <input type="text" class="form-control" name="username" placeholder="Desired Username" />
                                        </div>
                                         <div class="form-group input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></span>
                                             <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
										</div>
                                      <div class="form-group input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
                                            <input type="password" class="form-control" name="password" placeholder="Enter Password" />
                                        </div>
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
                                            <input type="password" class="form-control" name="password1" placeholder="Retype Password" />
                                        </div>
										 <div class="form-group input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-cake" aria-hidden="true"></span></span>
                                            <input type="date" class="form-control" name="date" placeholder="" />
                                        </div>
									<div class="form-group input-group">
										<input	type="radio" name="gender" id="Radio1" value="male">Male &nbsp;&nbsp;</label>
					<label class="radio-inline">
					<input	type="radio" name="gender" id="Radio2" value="female">Female</label>
					                </div>
									 <div class="form-group input-group">	
									 <span class="input-group-addon"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></span>
										<select class="form-control"  id="sel1" name="sq1">
                                    <option>what is your first school name ?</option>
                                    <option>what is your birth place?</option>
                                    <option>what is your last school name ?</option>
                                    <option>where is your maternal place ?</option>
                                    <option>who is your crush ?</option>
                                     <option>what is your favourite movie ?</option>
                                     </select>
                                     </div>
									<div class="form-group input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></span>
                                            <input type="text" class="form-control" name="sa1" placeholder="Your Answer" />
                                        </div>
										<div class="form-group input-group">	
									 <span class="input-group-addon"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></span>
										<select class="form-control"  id="sel1" name="sq2">
                                    <option>what is your first school name ?</option>
                                    <option>what is your birth place?</option>
                                    <option>what is your last school name ?</option>
                                    <option>where is your maternal place ?</option>
                                    <option>who is your crush ?</option>
                                     <option>what is your favorite movie ?</option>
                                     </select>
                                     </div>
									 <div class="form-group input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></span>
                                            <input type="text" class="form-control" name="sa2" placeholder="Your Answer" />
                                        </div>
                                     <input type="submit" name="submit" value="Register Me">
                                    <hr />
                                    Already Registered ?  <a href="signin.php" >Login here</a>
                                    </form>
                            </div>
                           
                        </div>
                    </div>
                
                
        </div>
<div class="row text-center ">
            <div class="col-md-12">
<br/>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- TAP-320-50 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:320px;height:50px"
     data-ad-client="ca-pub-2936243881134126"
     data-ad-slot="4175890690"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
            </div>
        </div>
    </div>


    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/plugins/bootstrap.js"></script>
   

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50445850-1', 'themeandphoto.com');
  ga('send', 'pageview');

</script>
</body>
</html>
