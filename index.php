<?php  session_start(); include('status.php'); include("bdd_connect.php"); 
if (isset($_SESSION['pseudo']))
{
	$pw = $_SESSION['password'];
	$login = $_SESSION['pseudo'];
	$id = $_SESSION['id'];
} ?>
<!DOCTYPE html>
<html xml:lang="en" lang="en">
	<head>
		<title>easy lift - free carpooling website - travel from home to your work place - carsharing </title>
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

	include('nav.php');
	include_once("analyticstracking.php") ?>
		<div ID="content-index">
<?php if(isset($_SESSION['message']))
{
	echo '<div "ID=error"><p>'.$_SESSION['message'].'</p></div>';
}
?>
<h1>Need a lift?</h1>
<p>If you are tired to arrive late because of the bus, if you care about our planet, or just if you want to have nicest trips...</p><br>
<p>You are in the right place!</p>
	<h2>Carpooling is :</h2>	
		<img id="imageIndex" src="images/index.png" alt="carpooling is cheap, social and green">
	<h3>Join the community!</h3>
<h3><a href="account.php">Sign up</a> and search or offer a lift in seconds</h3>	

</div>
</div>
<?php include("footer.php"); ?>

	</body>
</html>


