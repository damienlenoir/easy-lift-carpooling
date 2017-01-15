 <?php
include("session.php"); 
$date = date("Y-m-d");

if (strlen($_POST['comment']) < 5)
{
	$_SESSION['error'] = "The comment section must be filled";
	$_SESSION['departure_date'] = $_POST['departure_date'];
	$_SESSION['departure_time_hour'] = $_POST['departure_time_hour'];
	$_SESSION['departure_time_minutes'] = $_POST['departure_time_minutes'];
	$_SESSION['arrival_date'] = $_POST['arrival_date'];
	$_SESSION['arrival_time_hour'] = $_POST['arrival_time_hour'];
	$_SESSION['arrival_time_minutes'] = $_POST['arrival_time_minutes'];
	$_SESSION['comment'] = $_POST['comment'];
	header('Location: offer.php');
}
else
{
	 
//////must compile hours and min to get the time with good format 	'00:00:00'////////////	 
$departure_time = $_POST['departure_time_hour'].$_POST['departure_time_minutes']."00" ;
$arrival_time = $_POST['arrival_time_hour'].$_POST['arrival_time_minutes']."00" ;	


//////must convert dates into SQL format:  YYYY-MM-DD //////////
$departure_date = new DateTime($_POST['departure_date']);
$departure_date = $departure_date->format('Y-m-d');
$arrival_date = new DateTime($_POST['arrival_date']);
$arrival_date = $arrival_date->format('Y-m-d');



$reponse = $bdd->query('SELECT * FROM locations WHERE id='.$_POST['departure_location'].' ');
while ($donnees = $reponse->fetch())
{
    $departure_lat = $donnees['lat'];
	$departure_lon = $donnees['lon'];
	
}
$reponse->closeCursor();

$reponse = $bdd->query('SELECT * FROM locations WHERE id='.$_POST['arrival_location'].' ');
while ($donnees = $reponse->fetch())
{
    $arrival_lat = $donnees['lat'];
	$arrival_lon = $donnees['lon'];
	
}
$reponse->closeCursor();

	 
$req = $bdd->prepare('INSERT INTO offers (id, id_user, departure_date, departure_time, arrival_date, arrival_time, departure_lat, departure_lon, arrival_lat, arrival_lon, comment) VALUES(:id, :id_user, :departure_date, :departure_time, :arrival_date, :arrival_time, :departure_lat, :departure_lon, :arrival_lat, :arrival_lon, :comment)');
$req->execute(array(
					'id' => null,
					'id_user' => $id,
					'departure_date' => $departure_date,
					'departure_time' => $departure_time,
					'arrival_date' => $arrival_date,
					'arrival_time' => $arrival_time,
					'departure_lat' => $departure_lat,
					'departure_lon' => $departure_lon,
					'arrival_lat' => $arrival_lat,
					'arrival_lon' => $arrival_lon,
					'comment'  => htmlspecialchars($_POST['comment'])
					
                    ));
 
header('Location: active_offers.php');
}
?>
