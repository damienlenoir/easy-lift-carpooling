<?php include("session.php"); ?>


<!DOCTYPE html>
<html xml:lang="en" lang="en">
	<head>
		<title>easy lift - My Inbox - free carpooling website - travel from home to your work place - carsharing </title>
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
	include_once("analyticstracking.php") ?>

		<div ID="content">
			<h1>Sent messages</h1><br>
			 <a ID="buttonSentMessages" href="myAccount.php#widget_inbox">Back to Inbox</a>
			<a ID="buttonNewMessage" href="newMessage.php">New Message</a><br><br><br>
			 <table ID="inbox">
			 <p class="pages">
			<tr>
				<th style="width:15%;">Date</th>
				<th style="width:15%;">To</th>
				<th style="width:60%;">Subject</th>
				<th style="width:10%;"> </th>
			</tr>
 
    
 
<?php
 
////////pagination//////////
$nombreDeMessagesParPage = 10; 
$reponse = $bdd->query('SELECT COUNT(*) AS nb_messages FROM messages WHERE id_sender="' .$id. '"');
$donnees = $donnees =  $reponse->fetch();
$totalDesMessages = $donnees['nb_messages'];
$nombreDePages  = ceil($totalDesMessages / $nombreDeMessagesParPage);
echo 'Page : ';
for ($i = 1 ; $i <= $nombreDePages ; $i++)
{
    echo '<a href="sentMessages.php?page=' . $i . '">' . $i . '  </a> ';
}
$reponse->closeCursor();
?>
 
</p>
 
<?php
if (isset($_GET['page']))
{
        $page = $_GET['page']; // On récupère le numéro de la page indiqué dans l'adresse (livreor.php?page=4)
}
else // La variable n'existe pas, c'est la première fois qu'on charge la page
{
        $page = 1; // On se met sur la page 1 (par défaut)
}
 
// On calcule le numéro du premier message qu'on prend pour le LIMIT de MySQL
$premierMessageAafficher = ($page - 1) * $nombreDeMessagesParPage;
 
$reponse = $bdd->query('SELECT messages.* ,user_2.pseudo FROM messages, user, user AS user_2 WHERE messages.id_sender = user.id AND messages.id_receiver = user_2.id AND user.id = '.$id.' ORDER BY date DESC LIMIT ' . $premierMessageAafficher . ', ' . $nombreDeMessagesParPage .' ');
while ($donnees =  $reponse->fetch())
{
        echo '<tr><td>';
		echo $donnees['date'];
		echo '</td><td>' ;
		echo $donnees['pseudo'];
		echo'</td><td>' ;
		echo $donnees['subject'];
		echo'</td><td>' ;
		echo '<a href="message.php?page=' .$donnees['id']. '">View</a>';
		echo'</td><td>' ;
}
 
$reponse->closeCursor();
echo '</table></div>';
include('footer.php');
?>
 
</body>
</html>
