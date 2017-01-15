 <?php

 ////////////checking if the email exists in database///////////
 include("bdd_connect.php"); 
 
$reponse = $bdd->query('SELECT email FROM `user` WHERE email="' .htmlspecialchars($_POST['mail']). '" ');
while ($donnees = $reponse->fetch())
{
    if ($donnees['email'] == null) {
		header('location: wrongmail.php');
	} else {
		
		
///////////pulling out password and login///////////////////
$reponse = $bdd->query('SELECT * FROM `user` WHERE email="' .htmlspecialchars($_POST['mail']). '" ');
while ($donnees = $reponse->fetch())
{
	////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
////////////////////hidden for seccurity////////////////////
////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
}
$reponse->closeCursor();

 
///////////sending a password recovery email////////////////


$mail = htmlspecialchars($_POST['mail']); //adress de destination

if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}
//=====Déclaration des messages au format texte et au format HTML.
$message_txt = "Your easy-lift credentials";
$message_html = "<html><head></head><body><b>Your easy-lift credentials</b>, <br>Your easy-lift credentials are: <br>Login: " .$pseudo. " <br>Password: " .$password." </body></html>";
//==========
 
 
//=====Création de la boundary.
$boundary = "-----=".md5(rand());
$boundary_alt = "-----=".md5(rand());
//==========
 
//=====Définition du sujet.
$sujet = "Your easy-lift credentials";
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

header('Location: recoverymailsent.php');
	}
}
$reponse->closeCursor();
?>