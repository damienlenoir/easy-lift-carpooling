<?php  session_start(); include('status.php'); ?>
<html xml:lang="en" lang="en">
	<head>
		<title>easy lift - About us - free carpooling website - travel from home to your work place - carsharing </title>
			<meta name="description" content="easy lift is a free carpooling website - travel from home to your work place using our carsharing service"/>
			<meta name="keywords" content="carpooling, car sharing, car pool, pool car, carpool, share car, rideshare, ride sharing, carpool website," />
			<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
			<link href="style.css" rel="stylesheet" type="text/css" media="all" />	
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="icon" type="image/png" href="images/favicon.bmp" />
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
	<?php include("header.php"); ?>
	<?php include_once("nav.php") ?>
			<div ID="content">
					<h1>About</h1>
					<p>
						The purpose of this website is to provide a way to find and meet people who are doing the same ride than yourself.<br>
						Here, drivers can offer a ride. They can ask for money or not.<br>
						Easy-lifters can search for a ride and contact the drivers.<br>
						In case there is some king of financial agreement beetween users of the website, easy-lift cannot be involved and won't take any responsability.
					</p>
					<br> 
					<h2>If you have any comment or suggestion please send us a message:</h2>
					<p><a href="newMessage.php?send=easy-lift">Contact easy-lift</a></p>
			</div>
			<?php include("footer.php"); ?>
	</body>
</html>

