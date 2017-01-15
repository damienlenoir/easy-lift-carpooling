 <link href="style.css" rel="stylesheet" type="text/css" media="all" />	

<?php 
 include("session.php"); 

$reponse = $bdd->query('SELECT * FROM user WHERE id="' .$_SESSION['id']. '" ');
while ($donnees = $reponse->fetch())
	{
			$pseudo = $donnees['pseudo'];
			$password = $donnees['password'];
	}

$reponse->closeCursor();

// pseudo check
//is pseudo filled and longer than 4 caracters ?
if (isset($_POST['pseudo']))
	{
		if (strlen($_POST['pseudo']) < 4 )
			{
				$pseudo_check = "Username is too short" ;
			}
		else { $pseudo_check = "" ; }
	} else { $pseudo_check = "Username is mandatory" ; }
//Is pseudo already registred? (if different)
if ($_POST['pseudo'] !== $login )
$reponse = $bdd->query('SELECT pseudo FROM `user` WHERE pseudo="' .$_POST['pseudo']. '" ');
while ($donnees = $reponse->fetch())
{
    if ($donnees['pseudo'] != null) {
		$pseudo_check = "This username is registred already";
	} else {
	$pseudocheck = "";	}
}
$reponse->closeCursor();

// password check
if ($_POST['password2'] !== $_POST['password']) 
	{
			$password_check = "Password doesn't match! Please try again";
			
	} 

else { 

if (strlen($_POST['password']) < 4 )
	{
		$password_check = "Password must have more than 4 caracters" ;
	}	
else 
	{
		$password_check ="";
	}
}

//registration into data base
if ($password_check == "" and $pseudo_check == "")
{
	$bdd->exec('UPDATE user 
			SET name = "'.$_POST['name'].'" ,
				surname = "'.$_POST['surname'].'" ,
				pseudo = "'.$_POST['pseudo'].'" ,
				password = "'.$_POST['password'].'" 
			WHERE user.id = ' .$id. ' ');
	header('Location: myAccount.php');		
			
}
else {
	include("header.php"); 
	include("nav.php"); 
    echo '<br><br><div ID="register"><p>Oups, it didn\'t worked. Please check below for errors and try again: <a href="myAccount.php">My Account</a><br><br>';
	echo 'Error:  '.$pseudo_check.' <br>  '.$password_check.' <br>';
}

?>