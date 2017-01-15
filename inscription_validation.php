<?php 
echo '<link href="style.css" rel="stylesheet" type="text/css" media="all" />	';
session_start();
include("bdd_connect.php");
$date = date("Y-m-d");

//mail is filled and valid?
if (isset($_POST['email']))
	{
		$_POST['email'] = htmlspecialchars($_POST['email']); 

		if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']))
			{
				$mailcheck = "";
			} else {
				$mailcheck = "Email adress is not valid or empty";
			}
	}
//mail is not already registred?
$reponse = $bdd->query('SELECT email FROM `user` WHERE email="' .$_POST['email']. '" ');
while ($donnees = $reponse->fetch())
{
    if ($donnees['email'] != null) {
		$mailcheck = "This email is registred already";
	} else {
	$mailcheck = "";	}
}
$reponse->closeCursor();

// pseudo check
//is pseudo filled and longer than 4 caracters ?
if (isset($_POST['pseudo']))
	{
		$pseudo = htmlspecialchars($_POST['pseudo']); 
		if (strlen($pseudo) < 4 )
			{
				$pseudocheck = "Username is too short" ;
			}
		else { $pseudocheck = "" ; }
	} else { $pseudocheck = "Username is mandatory" ; }
//Is pseudo already registred?
$reponse = $bdd->query('SELECT pseudo FROM `user` WHERE pseudo="' .$_POST['pseudo']. '" ');
while ($donnees = $reponse->fetch())
{
    if ($donnees['pseudo'] != null) {
		$pseudocheck = "This username is registred already";
	} else {
	$pseudocheck = "";	}
}
$reponse->closeCursor();



// password check
$password = $_POST['password'];
$password2 = $_POST['password2'];
$passwordcheck = "";

if ($password != $password2) 
		{
			$passwordcheck = "Password doesn't match! Please try again";
		} 
else if (strlen($password) < 4 )
		{
			$pseudocheck = "Password must have more than 4 caracters" ;
		}
else {	$passwordcheck = ""; }					



//registration into data base
if ($pseudocheck !== "" and $passwordcheck !== "" and $mailcheck !== "" )
	{
		include("header.php"); 
		include("nav.php"); 
		include_once("analyticstracking.php") ;
		echo '<div ID="register"><h1>Registration</h1><p>Oups, it didn\'t worked. Please check below for errors and try again: <a href="inscription.php">Registration</a><br><br>';

				echo '<p><i> ' .$mailcheck. '</i></p>'; 
				echo '<p><i> ' .$pseudocheck. '</i></p>'; 
				echo '<p><i> ' .$passwordcheck. '</i></p>'; 
		
	} else 
{ 
		$req = $bdd->prepare('INSERT INTO user (id, name, surname, email, address, date, pseudo, password, verif) VALUES(:id, :name, :surname, :email, :address, :date, :pseudo, :password, :verif)');
		$req->execute(array(
					'id' => null,
					'name' => "",
					'surname' => "" ,
					'email' => $_POST['email'],
					'address' => "",
					'date' => $date,
					'pseudo' => $_POST['pseudo'],
                    'password' => $password,
					'verif' => 0
                    ));
		$req->closeCursor();
		$_SESSION['password'] = htmlspecialchars($_POST['password']); 
		$_SESSION['pseudo'] = htmlspecialchars($_POST['pseudo']);

/////////////sending verification email///////////////
$mail = $_POST['email'] ; 

//////////////CRYPTAGE DU MAIL//////////////////////////////
$a = $mail[0];
$b = $mail[1];
$crypt = "{$mail}{$b}{$a}apeiqynwm";

/////////////generation the verification link///////////////
$validation_link = 'http://localhost/easy-lift/account_validation.php?1A23X2=' .$crypt. '';

///////////sending an email to the recevier ////////////////
/////////////sending verification email///////////////
$mail = $_POST['email'] ; 

//////////////CRYPTAGE DU MAIL//////////////////////////////
$a = $mail[0];
$b = $mail[1];
$crypt = "{$mail}{$b}{$a}apeiqynwm";


/////////////generation the verification link///////////////



$validation_link = 'http://localhost/easy-lift/account_validation.php?1A23X2=' .$crypt. '';



//////////////CRYPTAGE DU MAIL//////////////////////////////
$a = $mail[0];
$b = $mail[1];
$crypt = "{$mail}{$b}{$a}apeiqynwm";


/////////////generation the verification link///////////////
$validation_link = 'http://localhost/easy-lift/account_validation.php?1A23X2=' .$crypt. '';

///////////sending an email to the recevier ////////////////
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
{
	$passage_ligne = "\r\n";
}
else
{

	$passage_ligne = "\n";
}
//=====Déclaration des messages au format texte et au format HTML.
$message_txt = "Verify your account";
$message_html = "<html><head></head><body><b>Verify your account</b>, <br><br>Please click this to complete your registration: <a href=\"".$validation_link."\">".$validation_link.". </a> </body></html>";
//==========
 
 
//=====Création de la boundary.
$boundary = "-----=".md5(rand());
$boundary_alt = "-----=".md5(rand());
//==========
 
//=====Définition du sujet.
$sujet = "Complete your registration";
//=========
 
//=====Création du header de l'e-mail.
$header = "From: \"easy-lift\"<damienlenoir21@gmail>".$passage_ligne;
$header.= "Reply-to: \"easy-lift\" <damienlenoir21@gmail>".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========
 
//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
 
$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
 
//=====Ajout du message au format HTML.
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
 
//=====On ferme la boundary alternative.
$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
//==========
 
 
 
$message.= $passage_ligne."--".$boundary.$passage_ligne;
 
//=====Ajout de la pièce jointe.
//$message.= "Content-Type: image/jpeg; name=\"image.jpg\"".$passage_ligne;
//$message.= "Content-Transfer-Encoding: base64".$passage_ligne;
//$message.= "Content-Disposition: attachment; filename=\"image.jpg\"".$passage_ligne;
//$message.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;
//$message.= $passage_ligne."--".$boundary."--".$passage_ligne; 
//========== 
//=====Envoi de l'e-mail.
mail($mail,$sujet,$message,$header);
 

// Redirection du visiteur vers la page 
$_SESSION['message'] = "Your account has been successfully created, please check your inbox to confirm your email address.";
header('Location: myAccount.php');
}			
?>