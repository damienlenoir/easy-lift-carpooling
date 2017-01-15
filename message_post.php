<link href="style.css" rel="stylesheet" type="text/css" media="all" />	
<?php 
include("session.php"); 

////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
////////////////////hidden for seccurity////////////////////
////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////

/////////checking if destination user exist////////
$reponse = $bdd->query('SELECT * FROM `user` WHERE pseudo="' .$receiver. '" ');
while ($donnees = $reponse->fetch()){$bddpseudo = $donnees['pseudo'] ; $bddid = $donnees['id']; }
if (isset($bddpseudo) == false ){$bddpseudo = "incorrect password";}
if ($bddpseudo == $receiver){	$receiver_test = "";}
else{	$receiver_test = "This username doesn't exist";}

//////checking if message and subject are filled///////
if ($subject=="")
{	$subject_test="Subject field is mandatory";} else {$subject_test=""; }

if (strlen($message) < 4 )
			{
				$message_test = "Your message is too short" ;
			}
		else { $message_test = "" ; }

///////////registration into data base/////////////
if ($receiver_test == "" and $subject_test=="" and $message_test=="")
	{
		$req = $bdd->prepare('INSERT INTO messages (id, id_sender, id_receiver, subject, message, date) VALUES(:id, :id_sender, :id_receiver, :subject, :message, :date)');
		$req->execute(array(
					'id' => null,
					'id_sender' => $id,
					'id_receiver' => $bddid,
					'subject' => $subject,
					'message' => $message,
					'date' => $date
                    ));
					header('Location: sentMessages.php');

/////////////linking recevier pseudo to receiver email///////////////
$reponse = $bdd->query('SELECT email FROM `user` WHERE pseudo="' .$receiver. '" ');
while ($donnees = $reponse->fetch()){$mail = $donnees['email'] ;}

///////////sending an email to the recevier ////////////////
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}
$message_txt = "You have a new message";
$message_html = "<html><head></head><body><b>Your have a new message</b>, <br><br>You receiver a new message from <strong> ".$login.". </strong> Please connect to your account to read it and reply :)</body></html>";
  $boundary = "-----=".md5(rand());
$boundary_alt = "-----=".md5(rand());
$sujet = "You have a new message";
 $header = "From: \"easy-lift\"<easy-lift-carpooling.com>".$passage_ligne;
$header.= "Reply-to: \"easy-lift\" <easy-lift-carpooling.com>".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
$message = $passage_ligne."--".$boundary.$passage_ligne;
$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary.$passage_ligne;
mail($mail,$sujet,$message,$header);
	}

 else { 
 
	$_SESSION['subject'] = $_POST['subject'];
	$_SESSION['receiver'] = $_POST['receiver'];
	$_SESSION['message'] = $_POST['message'];
	$_SESSION['error'] =  $receiver_test.$subject_test.$message_test;
	header('location: newMessage.php');
}
			$subject = $_POST['subject'];
$receiver = $_POST['receiver'];
$message = $_POST['message'];
?>