<?php
echo ' <div ID="widget_location"><br>
 <h3>Manage my locations: </h3><br>
 <ul>';
$reponse = $bdd->query('
SELECT locations.* 
FROM locations 
WHERE locations.id_user= '.$id.' 

');
while ($donnees = $reponse->fetch())
{
    echo '
	<li>
		<a href="delete_location.php?id='.$donnees['id'].'">
			<img class="deletepic" src="images/delete.png">
		</a>'.$donnees['name']. 
	'</li>' ;
}
$reponse->closeCursor();

echo '<br><a href="GPS_finder.php" id="buttonsearch">Add a new location</a>
		</ul>
		 </div>';
?>
