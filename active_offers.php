<?php
include("session.php"); 
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
<!DOCTYPE html>
<html xml:lang="en" lang="en">
	<head>
		<title>easy lift - My active offers - free carpooling website - travel from home to your work place - carsharing </title>
			<meta name="description" content="easy lift is a free carpooling website - travel from home to your work place using our carsharing service"/>
			<meta name="keywords" content="carpooling, car sharing, car pool, pool car, carpool, share car, rideshare, ride sharing, carpool website," />
			<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
			<link href="style.css" rel="stylesheet" type="text/css" media="all" />	
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" type="image/png" href="images/favicon.bmp" />
	</head>
		
	<body>
	';
include("header.php");
include("nav.php");
include_once("analyticstracking.php");
echo '
		<div ID="content">
		<h1>Active offers ('.$count_active.')</h1>
		<div ID="search_results">
	';

/////////////////////////////////QUERY////////////////////////////////////////////
$response = $bdd->query('
SELECT * 
FROM `offers` 
WHERE `departure_date` >= "'.$date.'"
AND id_user = "'.$id.'"
ORDER BY departure_date	DESC 
 ');

while ($data = $response->fetch())
{
	$noresult = 1;
	echo '
	
		<table ID="results-tab" style="width:100%">
		  <tr>
			<th>Departure</th>
			<th>Arrival</th>
		  </tr>
		  <tr>
			<td>The '.$data['departure_date'].' at '.$data['departure_time'].'	</td>
			<td>The '.$data['arrival_date'].' at '.$data['arrival_time'].'</td>
		  </tr>
		  <tr>
			<td>From '.$data['departure_lat'].' / '.$data['departure_lon'].'

<a href="#" onClick="window.open(\'mapview.php?GPS='.$data['departure_lat'].','.$data['departure_lon'].'\',\'mapView\',\'resizable,height=500,width=500,top=500,left=500,width=400,height=400\'); return false;">See on Map</a><noscript>You need Javascript to use the previous link or use <a href="mapview.php?GPS='.$data['departure_lat'].','.$data['departure_lon'].'" target="_blank">View on Map</a></noscript>

			
</td>
			<td>To '.$data['arrival_lat'].' / '.$data['arrival_lon'].'  
<a href="#" onClick="window.open(\'mapview.php?GPS='.$data['arrival_lat'].','.$data['arrival_lon'].'\',\'mapView\',\'resizable,height=500,width=500,top=500,left=500,width=400,height=400\'); return false;">See on Map</a><noscript>You need Javascript to use the previous link or use <a href="mapview.php?GPS='.$data['arrival_lat'].','.$data['arrival_lon'].'" target="_blank">View on Map</a></noscript>
		
</td>
		  </tr>
	</table> 	   
<p ID="corps" >'.$data['comment'].'</p>
<a ID="delete" href="delete.php?offer='.$data['id'].'">Delete this offer<a/>	

	';
	} 
	

$reponse->closeCursor();

if ( isset($noresult) == false )
{
	echo 'You have no active offers';
}

echo '</div></div>';

include("footer.php"); 
echo '
	</body>
	</html>
';
?>