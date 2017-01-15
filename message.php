<?php
//Thanks to openclassroom
include("session.php"); 
?>
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
			<h1>My Inbox</h1><br>
			<p><a href="newMessage.php">Send a new message</a>  -  <a href="sentMessages.php">Sent Messages</a> <br><a href="myAccount.php#widget_inbox">Back to Inbox</a><br><br></p>
			 <table ID="inbox">
			 
<?php
// display per page

if (isset($_GET['page']))
{
        $page = $_GET['page']; 
}
else 
{
        header('Location: inbox.php');
}
 
$reponse = $bdd->query('SELECT messages.*, user.pseudo FROM messages, user WHERE messages.id_sender = user.id AND messages.id = '.$page.' ');
while ($donnees =  $reponse->fetch())
{
     echo '  <div ID="onemessage">

		
		<p>The '.$donnees['date'].'  from  '.$donnees['pseudo'].'	  </p>
		 
		<p>Subject:  ' .$donnees['subject'].'<br> </p>

	   
<p ID="corps" >'.$donnees['message'].'';

if(is_file("upload/".$donnees['id_sender'].".png"))
{
     echo '<img class="avatarinsearch" src="upload/'.$donnees['id_sender'].'.png">';
}
echo '</p><a ID="reply" href="newMessage.php?send='.$donnees['pseudo'].'">Reply<a/>	
</div>
	';	
}
 
$reponse->closeCursor();
echo '</table></div>';
include('footer.php');
?>
</body>
</html>
