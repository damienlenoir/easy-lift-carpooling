<?php  session_start(); include('status.php'); ?>
<!DOCTYPE html>
<html xml:lang="en" lang="en">
	<head>
		<title>easy lift - My account - free carpooling website - travel from home to your work place - carsharing </title>
			<meta name="description" content="easy lift is a free carpooling website - travel from home to your work place using our carsharing service"/>
			<meta name="keywords" content="carpooling, car sharing, car pool, pool car, carpool, share car, rideshare, ride sharing, carpool website," />
			<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
			<link href="style.css" rel="stylesheet" type="text/css" media="all" />	
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<link rel="icon" type="image/png" href="images/favicon.bmp" />
	</head>
		
	<body>
	<?php include("header.php"); 
	include("nav.php");
	include_once("analyticstracking.php") ?>

<div ID="content">
<?php 
if(isset($_SESSION['error_login']))
{
	echo '<div ID="error"><p>'.$_SESSION['error_login'].'</p></div>';
}	
?>
			<div ID="register">
				<h1>Sign in</h1>
				<form action="login_post.php" method="post"> 
				Username:<br>
				<input type="text" name="pseudo" size="30"><br><br>
				Password:<br>
				<input type="password" name="password" size="30"><br><br><br></br>
				<input type="submit" value="OK"><br>
				<i><a href="pw_recovery.php">I forgot my password</a></i>
				</form>
			</div>		
</div>
<?php include("footer.php");
$_SESSION['error_login'] = null;
$_SESSION['message'] = null;
$_SESSION['error'] = null; ?>
	</body>
</html>

