<?php 
 session_start();
////////////////To forbid access to not connected visitors///////////////
if (isset($_SESSION['pseudo']))
{
	$pw = $_SESSION['password'];
	$login = $_SESSION['pseudo'];
	////////////pulling account info///////////////
////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
////////////////////hidden for seccurity////////////////////
////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
/////////////sending verification email///////////////
$mail = $email ; 

////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
////////////////////hidden for seccurity////////////////////
////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////

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
 
//==========

// Redirection du visiteur vers la page 
$_SESSION['message'] = "We have sent a new confirmation email to ".$email."";
header('Location: not_verified.php');
		
?>