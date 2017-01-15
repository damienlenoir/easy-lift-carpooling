 <?php
 session_start();
////////////////To forbid access to not connected visitors///////////////
if (isset($_SESSION['pseudo']))
{
	////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
////////////////////hidden for seccurity////////////////////
////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
	include("bdd_connect.php");
	$reponse = $bdd->query('SELECT * FROM user WHERE pseudo="' .$login. '" ');
	while ($donnees = $reponse->fetch())
		{
			$name = $donnees['name'];
////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
////////////////////hidden for seccurity////////////////////
////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
		}
}
else
{
	header('Location: account.php');
}
if ($verif == 1)
			{
				header('Location: myAccount.php');
			}
			
?>
<!DOCTYPE html>
<html xml:lang="en" lang="en">
	<head>
		<title>easy lift - My Account (not yet verified) - free carpooling website - travel from home to your work place - carsharing </title>
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
		<?php echo '<h2>Hello '  .$login.   ' </h2>'; 
		if(isset($_SESSION['message']))
{
	echo '<div "ID=error"><p>'.$_SESSION['message'].'</p></div>';
}?>
		<br>
		<div ID="informations">
		
		<h3>Confirm your email address</h3>
		<p>Your did not confirmed your email adress</p>
		<p>Click here to resend the confirmation email: 
		<form action="resend_validation_email.php" method="post"> 
		<input type="submit" value="Confirm">
		</form>
		</div>
	</div>
			<?php include("footer.php"); ?>
	</body>
</html>

