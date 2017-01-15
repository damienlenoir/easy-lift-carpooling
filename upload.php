<?php
 include("session.php"); ;
	$reponse = $bdd->query('SELECT * FROM user WHERE id="' .$id. '" ');
	while ($donnees = $reponse->fetch())
		{
			$name = $donnees['name'];
			$surname = $donnees['surname'];
			$email = $donnees['email'];
			$address = $donnees['address'];
			$pseudo = $donnees['pseudo'];
			$password = $donnees['password'];
			$verif =$donnees['verif'];
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

	echo '	<div ID="content"><div id="upload"><p>';
$dossier = 'upload/';
$fichier = basename($_FILES['avatar']['name']);
$taille_maxi = 100000;
$taille = filesize($_FILES['avatar']['tmp_name']);
$extensions = array('.png', '.gif', '.jpg', '.jpeg', '.PNG', '.GIF', '.JPG');
$extension = strrchr($_FILES['avatar']['name'], '.'); 

if(!in_array($extension, $extensions)) 
{
     $erreur = 'You must upload a file with extention: png, gif, jpg or jpeg';
}
if($taille>$taille_maxi)
{
     $erreur = 'File too big';
}
if(!isset($erreur)) 
{
     $fichier = $id.".png";
     if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
          echo 'Upload successfull !';
     }
     else 
     {
          echo 'Oups it didn\'t work !';
     }
}
else
{
    echo $erreur;
}		
		?>
	</p>
	<p>
</div>
</div>
<?php include("footer.php"); ?>
</body>
</html>

