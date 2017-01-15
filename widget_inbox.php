 <?php
echo '<div ID="widget_inbox"><br>
 	<h1>My Inbox</h1><br>
			<a ID="buttonNewMessage" href="newMessage.php">New message</a>  
			<a ID="buttonSentMessages" href="sentMessages.php">Sent Messages</a> </p><br>
			 <table ID="inbox">
			 <p class="pages">
			<tr>
				<th style="width:15%;">Date</th>
				<th style="width:15%;">Sender</th>
				<th style="width:60%;">Subject</th>
				<th style="width:10%;"> </th>
			</tr>
 ';

$reponse = $bdd->query('SELECT id FROM user WHERE pseudo="' .$login. '" ');
				while ($donnees = $reponse->fetch())
					{
						$iduser = $donnees['id'];
					}
$nombreDeMessagesParPage = 10; // Essayez de changer ce nombre pour voir :o)
$reponse = $bdd->query('SELECT COUNT(*) AS nb_messages FROM messages WHERE id_receiver="' .$id. '"');
$donnees = $donnees =  $reponse->fetch();
$totalDesMessages = $donnees['nb_messages'];
$nombreDePages  = ceil($totalDesMessages / $nombreDeMessagesParPage);
echo 'Page : ';
for ($i = 1 ; $i <= $nombreDePages ; $i++)
{
    echo '<a href="inbox.php?page=' . $i . '">' . $i . '  </a> ';
}
$reponse->closeCursor();

echo '</p>';

if (isset($_GET['page']))
{
        $page = $_GET['page']; // On récupère le numéro de la page indiqué dans l'adresse (livreor.php?page=4)
}
else 
{
        $page = 1; // On se met sur la page 1 (par défaut)
}
 
$premierMessageAafficher = ($page - 1) * $nombreDeMessagesParPage;
 
$reponse = $bdd->query('SELECT messages.* ,user_2.pseudo FROM messages, user, user AS user_2 WHERE user.id = messages.id_receiver AND user_2.id = messages.id_sender AND user.id = '.$id.' ORDER BY date DESC LIMIT ' . $premierMessageAafficher . ', ' . $nombreDeMessagesParPage .' ');
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
echo '</table>
</div> ';
?>