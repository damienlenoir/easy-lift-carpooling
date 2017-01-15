<?php  include("session.php");  ?>
<!DOCTYPE html>
<html xml:lang="en" lang="en">
	<head>
		<title>easy lift - Search a lift - free carpooling website - travel from home to your work place - carsharing </title>
			<meta name="description" content="easy lift is a free carpooling website - travel from home to your work place using our carsharing service"/>
			<meta name="keywords" content="carpooling, car sharing, car pool, pool car, carpool, share car, rideshare, ride sharing, carpool website," />
			<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
			<link href="style.css" rel="stylesheet" type="text/css" media="all" />	
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
    $( function() {
    $( "#datepicker2" ).datepicker();
  } );
  </script>
	</head>
	<body>
	<?php include("header.php"); 
	include("nav.php");
	 include_once("analyticstracking.php") ?>

		<div ID="content">
		<h1>Search a lift</h1><br>

<form action="" method="post"> 
	<div ID="depart">
		<h2>Choose your departure options</h2>
		<p>From: <select name="departure_location">
<?php
$reponse = $bdd->query('SELECT locations.* FROM locations, user WHERE locations.id_user=user.id AND id_user = '.$id.'');
while ($donnees = $reponse->fetch())
{
    echo '<option value="'.$donnees['lat'].",".$donnees['lon'].'">'.$donnees['name'].'</option>' ;
	
}
$reponse->closeCursor();

 ?>
		</select>
		<a href="GPS_finder.php">Add New location</a><br>
		Flexibility :		
		<select name="departure_geo_flex">
			<option value="1000">1 km</option>
          <option value="2000">2 km</option>
           <option value="3000">3 km</option>
           <option value="4000">4 km</option>
           <option value="5000">5 km</option>
		   <option value="10000">10 km</option>
           <option value="20000">20 km</option>
		</select>
		 <p>Date: </p>
		 <p><input type="text" id="datepicker" name="departure_date"> 
		 Flexibility :		
		<select name="departure_date_flex">
			<option value="0">None</option>
          <option value="1">1 day</option>
           <option value="2">2 days</option>
           <option value="3">3 days</option>
           <option value="4">4 days</option>
		   <option value="5">5 days</option>
           <option value="6">6 days</option>
           <option value="7">7 days</option>
		</select>
	</div>
	<div ID="arrivee">
		<h2>Choose your arrival options</h2>
		
		<p>From: <select name="arrival_location">
<?php
$reponse = $bdd->query('SELECT locations.* FROM locations, user WHERE locations.id_user=user.id AND id_user = '.$id.'');
while ($donnees = $reponse->fetch())
{
    echo '<option value="'.$donnees['lat'].",".$donnees['lon'].'">'.$donnees['name'].'</option>' ;
	
}
$reponse->closeCursor();

 ?>
		</select>
		<a href="GPS_finder.php">Add New location</a><br>
		Flexibility :		
		<select name="arrival_geo_flex">
			<option value="1000">1 km</option>
          <option value="2000">2 km</option>
           <option value="3000">3 km</option>
           <option value="4000">4 km</option>
           <option value="5000">5 km</option>
		   <option value="10000">10 km</option>
           <option value="20000">20 km</option>
		</select>
		 <p>Date: </p>
		 <p><input type="text" id="datepicker2" name="arrival_date"> 
		 Flexibility :		
		<select name="arrival_date_flex">
			<option value="0">None</option>
           <option value="1">1 day</option>
           <option value="2">2 days</option>
           <option value="3">3 days</option>
           <option value="4">4 days</option>
		   <option value="5">5 days</option>
           <option value="6">6 days</option>
           <option value="7">7 days</option>
		</select>
		
	</div>
		<div id="divconfirm"><input ID="buttonsearchlift" type="submit" value="Search" /></div>
</form>

<?php
if (isset($_POST['departure_date']))
{
////////////////////calculation of the min and max departure dates///////////////////////
$departure_date = new DateTime($_POST['departure_date']);
$departure_date = $departure_date->format('Y-m-d');
$departure_date_max = date("Y-m-d", strtotime($_POST['departure_date']." +".$_POST['departure_date_flex']." days"));
$departure_date_min = date("Y-m-d", strtotime($_POST['departure_date']." -".$_POST['departure_date_flex']." days"));
$arrival_date = new DateTime($_POST['arrival_date']);
$arrival_date = $arrival_date->format('Y-m-d');
$arrival_date_max = date("Y-m-d", strtotime($_POST['arrival_date']." +".$_POST['arrival_date_flex']." days"));
$arrival_date_min = date("Y-m-d", strtotime($_POST['arrival_date']." -".$_POST['arrival_date_flex']." days"));


/////////////////////////////////QUERY////////////////////////////////////////////
$response = $bdd->query('
SELECT offers.* , user.pseudo
FROM `offers`, user
WHERE `departure_date` BETWEEN "'.$departure_date_min.'" AND "'.$departure_date_max.'"
AND `arrival_date` BETWEEN "'.$arrival_date_min.'" AND "'.$arrival_date_max.'"

AND user.id = offers.id_user
ORDER BY departure_date	DESC 
 ');

while ($data = $response->fetch())
{
	/////////////////////Geo check///////////////////////
	$query ='https://maps.googleapis.com/maps/api/distancematrix/xml?origins='.$_POST['departure_location'].'&destinations='.$data['departure_lat'].','.$data['departure_lon'].'&language=en-FR&key=AIzaSyBeiAJOcBwToQnrkYI0AcD-ESZQWAjmzI0';
	$xml=simplexml_load_file($query) or die("Error: Cannot create object");
	$departure_distance = $xml->row->element->distance->value;

	$query2 ='https://maps.googleapis.com/maps/api/distancematrix/xml?origins='.$_POST['arrival_location'].'&destinations='.$data['arrival_lat'].','.$data['arrival_lon'].'&language=en-FR&key=AIzaSyBeiAJOcBwToQnrkYI0AcD-ESZQWAjmzI0';
	$xml=simplexml_load_file($query2) or die("Error: Cannot create object");
	$arrival_distance = $xml->row->element->distance->value;

	/////converting to int//////////////
	$departure_distance = (int)$departure_distance;
	$arrival_distance = (int)$arrival_distance;
	$dep_geo_flex =(int)$_POST['departure_geo_flex'];
	$ar_geo_flex =(int)$_POST['arrival_geo_flex'];
	

	if ($departure_distance < $dep_geo_flex and $arrival_distance < $ar_geo_flex)
	{
	$noresult = 1;
	echo '
	<div ID="search_results">
		<table ID="results-tab" style="width:100%">
		  <tr>
			<th>Departure</th>
			<th>Arrival</th>
		  </tr>
		  <tr>
			<td>The '.$data['departure_date'].' at '.$data['departure_time'].'</td>
			<td>The '.$data['arrival_date'].' at '.$data['arrival_time'].'</td>
		  </tr>
		  <tr>
			<td>View exact location on <a href="#" onClick="window.open(\'mapview.php?GPS='.$data['departure_lat'].','.$data['departure_lon'].'\',\'mapView\',\'resizable,height=500,width=500,top=500,left=500,width=400,height=400\'); return false;">Map</a><noscript>You need Javascript to use the previous link or use <a href="mapview.php?GPS='.$data['departure_lat'].','.$data['departure_lon'].'" target="_blank">Map</a></noscript>
</td>
			<td>View exact location on <a href="#" onClick="window.open(\'mapview.php?GPS='.$data['arrival_lat'].','.$data['arrival_lon'].'\',\'mapView\',\'resizable,height=500,width=500,top=500,left=500,width=400,height=400\'); return false;">Map</a><noscript>You need Javascript to use the previous link or use <a href="mapview.php?GPS='.$data['arrival_lat'].','.$data['arrival_lon'].'" target="_blank">Map</a></noscript>
</td>
		  </tr>
	</table> 	   
<div ID="corps" ><p>'.$data['comment'].'</p>';

if(is_file("upload/".$data['id_user'].".png"))
{
     echo '<img class="avatarinsearch" src="upload/'.$data['id_user'].'.png">';
}

echo '</div>


<a ID="reply" href="newMessage.php?send='.$data['pseudo'].'">Send a message<a/>	
</div>
	';
	} 
}
$reponse->closeCursor();

if ( isset($noresult) == false )
{
	echo 'No result for this request';
}

}

echo '
</div>
		</div>';
include("footer.php"); 
echo '
	</body>
</html>';
?>