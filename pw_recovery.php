<?php session_start(); ?>
<!DOCTYPE html>
<html xml:lang="en" lang="en">
	<head>
		<title>easy lift - Password and login recovery - free carpooling website - travel from home to your work place - carsharing </title>
			<meta name="description" content="easy lift is a free carpooling website - travel from home to your work place using our carsharing service"/>
			<meta name="keywords" content="carpooling, car sharing, car pool, pool car, carpool, share car, rideshare, ride sharing, carpool website," />
			<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
			<link href="style.css" rel="stylesheet" type="text/css" media="all" />	
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
		
	<body>
	<?php include("header.php"); ?>
	<?php include("nav.php"); ?>
	<?php include_once("analyticstracking.php") ?>


<div ID="content">
	<h1>Account</h1>
		<h3>Can't recall what are your login or/ password?</h3>
			<div ID="register">
				<h1>Enter your email adress to receive your login and password</h1>
				<form action="pw_recovery_post.php" method="post"> 
				Email adress:<br>
				<input type="text" name="mail" size="30"><br><br>
				<br></br>
				<input type="submit" value="OK"><br>
				<i><a href="pw_recovery.php">I forgot my password</a></i>
				</form>
			</div>

		
</div>
			
			<?php include("footer.php"); ?>
	</body>
</html>

