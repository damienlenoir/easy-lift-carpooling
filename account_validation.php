<?php
session_start();
include("bdd_connect.php");
if (isset($_GET['1A23X2']))
{
        $page = $_GET['1A23X2']; 
}
else 
{
        //header('Location: account.php');
		 echo 'ici';
}
	
////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
////////////////////hidden for seccurity////////////////////
////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
{
/////ici code pour passer l'attribut vérif de 0 à 1//////////
$bdd->exec('UPDATE user SET verif = 1 WHERE user .email = "' . $decrypted . ' "');

/////////fetching info///////////////
$response = $bdd->query('
SELECT * FROM `user` WHERE `email` = "' . $decrypted . ' "
 ');
while ($data = $response->fetch())
{
	////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
////////////////////hidden for seccurity////////////////////
////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
	
}
////creation des locations par defaut////////////////
$bdd->exec('
		INSERT INTO locations 
		VALUES (null, '.$id_receiver.', 51.8988,	-8.47139,"Cork City Center");
		INSERT INTO locations 
		VALUES (null, '.$id_receiver.', 51.8506, -8.48235, "Cork Airport Business Park");
		INSERT INTO locations 
		VALUES (null, '.$id_receiver.', 53.3463, -6.26541, "Dublin City Center");
		INSERT INTO locations 
		VALUES (null, '.$id_receiver.', 53.2743,	-9.04906, "Galway City Center");
		');

//////////////sending the welcome message////////////////////
$id_sender = 1; //ID of the admin account
$subject= "Hello and Welcome";
$message= "Welcome to Easy-lift!

We are pleased to count you as a new Easy-lift user.

We hope you will enjoy using our website.
Please, don't hesitate to contact us by reply to this message or trough the contact form.

Sincerely,

The Easy-Lift team";
$date = date("Y-m-d");

$req = $bdd->prepare('INSERT INTO messages (id, id_sender, id_receiver, subject, message, date) VALUES(:id, :id_sender, :id_receiver, :subject, :message, :date)');
$req->execute(array(
					'id' => null,
					'id_sender' => $id_sender,
					'id_receiver' => $id_receiver,
					'subject' => $subject,
					'message' => $message,
					'date' => $date
                    ));

$_SESSION['pseudo'] = $login; 
$_SESSION['password'] = $password;
$_SESSION['id'] = $id_receiver; 
$_SESSION['message'] = "Congratulations, your account is fully created";
//header('Location: myAccount.php');
}
else
{
 //header('Location: not_verified.php');
 echo 'la';
 var_dump($a);
 var_dump($b);
 var_dump($decrypted);
 var_dump($page[0]);
 var_dump($page[1]);
}
?>