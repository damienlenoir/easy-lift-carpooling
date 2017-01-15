<?php
 session_start();
 include("bdd_connect.php"); 
////////////////To forbid access to not connected visitors///////////////
if (isset($_SESSION['pseudo']))
{
	$pw = $_SESSION['password'];
	$login = $_SESSION['pseudo'];
	$id = $_SESSION['id'];
}
else
{
	header('Location: account.php');
	$_SESSION['error'] = "You need to create an account first:";
}

$reponse = $bdd->query('SELECT * FROM user WHERE pseudo="' .$login. '" ');
	while ($donnees = $reponse->fetch())
		{
			$verif =$donnees['verif'];
			if ($verif == 0)
			{
				header('Location: not_verified.php');
			}
		}
$reponse->closeCursor();
 if (isset($_GET['GPS']))
{
        $GPS = $_GET['GPS']; 
}

?>
<!DOCTYPE html>
<html xml:lang="en" lang="en">
	<head>
		<title>easy lift - View on map - free carpooling website - travel from home to your work place - carsharing </title>
			<meta name="description" content="easy lift is a free carpooling website - travel from home to your work place using our carsharing service"/>
			<meta name="keywords" content="carpooling, car sharing, car pool, pool car, carpool, share car, rideshare, ride sharing, carpool website," />
			<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
			<link href="style.css" rel="stylesheet" type="text/css" media="all" />	
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	</head>	
	<body>
		
		<div ID="onMap">
<?php

echo '<div><iframe width="500" height="500" frameborder="0" style="border:0;"';
if (isset($GPS))
{
	echo 'src="https://www.google.com/maps/embed/v1/place?q='.$GPS.'&key="></div>' ;///API KEY
}
else
{
	echo 'src="https://www.google.com/maps/embed/v1/place?q=ireland&key="</div>';///API key
}
echo '<allowfullscreen></iframe></form>';
?>			
		</iframe></form>
		</div>
		</div>
		

	</body>
</html>



