<?php
include("session.php"); 
if (isset($_GET['step']))
{
$step = $_GET['step'];
}
else 
{
	$step = 1;
}
echo '
<!DOCTYPE html>
<html xml:lang="en" lang="en">
	<head>
		<title>easy lift - New location - free carpooling website - travel from home to your work place - carsharing </title>
			<meta name="description" content="easy lift is a free carpooling website - travel from home to your work place using our carsharing service"/>
			<meta name="keywords" content="carpooling, car sharing, car pool, pool car, carpool, share car, rideshare, ride sharing, carpool website," />
			<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
			<link href="style.css" rel="stylesheet" type="text/css" media="all" />	
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
						<link rel="icon" type="image/png" href="images/favicon.bmp" />
	</head>
		
	<body>';
include("header.php"); 
include("nav.php");
////////////////////////step 1 //////////////////////////////
if ($step == 1)
{
echo '
<div ID="content">
	<div ID="GPS_form">
		<h1>Register a new location</h1>
			<div id="numero'.$step.'"></div><h2>Type in your address</h2>
				<form action="GPS_finder.php?step=2" method="post"> 
					<input type="text" name="address" size="60" placeholder="';
						if (isset($_SESSION['GPSaddress']))
							{
								echo $_SESSION['GPSaddress'];
							}
							else
							{
								if (isset($_POST['address']))
								{
								echo $_SESSION['GPSaddress'];
								}
								else { echo 'Address';}
							}
					echo '" ><br>
					<input type="text" name="address2" size="60"  placeholder="';
						if (isset($_SESSION['GPSaddress2']))
							{
								echo $_SESSION['GPSaddress2'];
							}
							else
							{
								if (isset($_POST['address2']))
								{
								echo $_SESSION['GPSaddress2'] ;
								}
								else { echo 'Address';}
							}
					echo '"><br>
					<input type="text" name="address3" size="60"  placeholder="';
						if (isset($_SESSION['GPSaddress3']))
							{
								echo $_SESSION['GPSaddress3'];
							}
							else
							{
								if (isset($_POST['address3']))
								{
								echo $_SESSION['GPSaddress3'];
								}
								else { echo 'City';}
							}
					echo '"><br><br>
					<input type="submit" value="Search" id="buttonsearch">
				</form>
	</div>
</div>';
}
////////////////////////step 2 //////////////////////////////
if ($step == 2)
{
$APIkey = ""; ///API key 
$address4 = "Ireland";

if (isset($_POST['address'])) {$_SESSION['GPSaddress'] = str_replace(' ', '+', $_POST['address']);}
if (isset($_POST['address'])) {$_SESSION['GPSaddress2'] = str_replace(' ', '+', $_POST['address2']);}
if (isset($_POST['address'])) {$_SESSION['GPSaddress3'] = str_replace(' ', '+', $_POST['address3']);}

$query = "https://maps.googleapis.com/maps/api/geocode/xml?address=".$_SESSION['GPSaddress'].",".$_SESSION['GPSaddress2'].",".$_SESSION['GPSaddress3'].",".$address4."".$APIkey."";

$xml=simplexml_load_file($query) or die("Error: Cannot create object");
$noresult = (string)$xml->status;

if ($noresult == "ZERO_RESULTS")
{
	$noresult == "ZERO_RESULTS";
}
else {
$lat = $xml->result->geometry->location->lat;
$lon = $xml->result->geometry->location->lng;
$ville = $xml->result->address_component->short_name;
$_SESSION['lat'] = (string)$lat;
$_SESSION['lon'] = (string)$lon;
$_SESSION['google_name'] = (string)$ville;
}

echo '
<div ID="content">
	<div ID="GPS_form">
		<h1>Register a new location</h1>
			<div id="numero'.$step.'"></div><h2>Check the map:</h2>';
			///////////////////map///////////////////
		echo '
		<a  href="GPS_finder.php?step=1"><img id="buttonPrev" src="images/prev.png" alt="prev"></a>
		<a  href="GPS_finder.php?step=3"><img id="buttonNext" src="images/next.png" alt="next"></a>
		<div ID="map"><iframe width="800" height="300" frameborder="0" style="border:0;"';
		if (isset($lat) and isset($lon))
		{
			echo 'src="https://www.google.com/maps/embed/v1/place?q='.$_SESSION['lat'].','.$_SESSION['lon'].''.$APIkey.'"></div>' ;
		}
		else
		{
			echo 'src="https://www.google.com/maps/embed/v1/place?q=ireland&key="</div>'; //API KEY
		}
		echo '<allowfullscreen></iframe></form>
				
				</iframe></form>
		</div>
	</div>
</div>';

}
////////////////////////step 3 //////////////////////////////
if ($step == 3)
{
echo '
<div ID="content">
	<div ID="GPS_form">
		<h1>Register a new location</h1>
			<div id="numero'.$step.'"></div>';
			
			if (isset($_SESSION['GPSerror']))
			{ echo '<div id="GPSerror">'.$_SESSION['GPSerror'].'</div>'; }

echo '			<h2>Type in a name for this location:</h2>
				<form action="GPS_finder.php?step=4" method="post">
					<input type="text" name="name" size="60" placeholder="Name" ><br><br>
					<a  href="GPS_finder.php?step=2"><img id="buttonPrev" src="images/prev.png" alt="prev"></a>
					
					<input id="buttonNext" type="image" src="images/next.png" alt="next" >
				</form>
			</div>
	</div>
</div>';
$_SESSION['GPSerror'] = null;
}

////////////////////////step 4 //////////////////////////////
if ($step == 4)
{
	
	if (isset($_POST['name'])) {$_SESSION['name'] = htmlspecialchars($_POST['name']);}
	if (isset($_SESSION['name']) and isset($_SESSION['lat']) and isset($_SESSION['lon']) )
		{
			echo '
			<div ID="content">
				<div ID="GPS_form">
					<h1>Register a new location</h1>
					
						<div id="numero'.$step.'"></div><br>
						<p style="font-size:22px;">Check and confirm:<p><br>
						<p>Name: '; if (isset($_POST['name'])) {echo $_POST['name'];} echo '</p><br>
				<a  href="GPS_finder.php?step=3"><img id="buttonPrev" src="images/prev.png" alt="prev"></a>
				<a href="GPS_finder.php?step=5&name='.$_SESSION['name'].'&amp;lat='.$_SESSION['lat'].'&amp;lon='.$_SESSION['lon'].'" ><img id="buttonNext" src="images/next.png" alt="next"></a>
			</div>
			</div>
			';	
		}
	else
		{
			$_SESSION['GPSerror'] = "You need to choose a name for this location";
			header('Location: GPS_finder.php?step=3');
		}
}
////////////////////////step 5 //////////////////////////////
if ($step == 5)
{
$_SESSION['message'] = "Your new location has been succesfully registred";

$req = $bdd->prepare('INSERT INTO locations (id, id_user, lat, lon, name, google_name) VALUES(:id, :id_user, :lat, :lon, :name, :google_name)');
$req->execute(array(
					'id' => null,
					'id_user' => $id,
					'lat' => $_GET['lat'],
					'lon' => $_GET['lon'],
					'name' => $_GET['name'],
					'google_name' => $_SESSION['google_name']
                    ));
header('Location: myAccount.php');
}
//////////////////////////////////////////////////////////////////
 include("footer.php"); 
	echo '</body>
</html>';
?>