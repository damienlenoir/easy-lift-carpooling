 <?php
 echo ' <div ID="active_offers"><br>';
$date = date("Y-m-d");
$count_active=0;
$count_total=0;
$reponse = $bdd->query('
SELECT departure_date
FROM offers 
WHERE id_user = "'.$id.'"
 ');
  
while ($donnees =  $reponse->fetch())
{
	if ($donnees['departure_date'] >= $date )
	{
		++$count_active;		
	}			
}
$reponse->closeCursor();
echo '
<p>You have '.$count_active.' active offers</p>
<p>Click here to access your active offers: <a href="active_offers.php">View</a></p>
<br>
 </div>
';

?>
