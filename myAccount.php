<?php
 include("session.php"); ;
	$reponse = $bdd->query('SELECT * FROM user WHERE id="' .$id. '" ');
	while ($donnees = $reponse->fetch())
		{
			$name = $donnees['name'];
			////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
////////////////////hidden for seccurity////////////////////
////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
		}
?>


<!DOCTYPE html>
<html xml:lang="en" lang="en">
	<head>
		<title>easy lift - My Account - free carpooling website - travel from home to your work place - carsharing </title>
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
	include_once("analyticstracking.php") ;

	echo '	<div ID="content">';
		
if (isset($_SESSION['error']))
{
	echo '<div id="error"><p>' . $_SESSION['error']. '</p></div>';
}
if(isset($_SESSION['message']))
{
	echo '<div "ID=error"><p>'.$_SESSION['message'].'</p></div>';
}
if(isset($_SESSION['error_login']))
{
	echo '<div "ID=error"><p>'.$_SESSION['error_login'].'</p></div>';
}			
		
		echo '<h2>Hello '  .$login.   '  -   Welcome to your dashboard</h2>'; 
			
		
		include("widget_avatar.php");
		include("widget_offers.php");
		include("widget_inbox.php");
		include("widget_location.php"); 
		?>
		
		<div ID="informations">
		
		<h3>Update your informations</h3>
		<form action="update_post.php" method="post"> 
		<strong><?php echo $email; ?></strong><br><br>
			Username:<br>
			<input type="text" name="pseudo" size="30" <?php echo 'value="'.$pseudo.'"'; ?> ><br><br>
			Name:<br>
			<input type="text" name="name" size="30" <?php echo 'value="'.$name.'"'; ?>><br><br>
			Surname:<br>
			<input type="text" name="surname" size="30" <?php echo 'value="'.$surname.'"'; ?>><br><br>
			Password:<br>
			<input type="password" name="password" size="30" <?php echo 'value="'.$password.'"'; ?>"><br><br>
			Confirm Password:<br>
			<input type="password" name="password2" size="30" <?php echo 'value="'.$password.'"'; ?>"><br>
			<br></br>
			<input type="submit" value="Confirm" id="gpsconfirm">
					
		</form>
		</div>
		</div>
			<?php 
			$_SESSION['error_login'] = null;
			$_SESSION['message'] = null;
			$_SESSION['error'] = null;
			include("footer.php"); ?>
	</body>
</html>

