<?php  include("session.php");  ?>
<!DOCTYPE html>
<html xml:lang="en" lang="en">
	<head>
		<title>easy lift - offer a lift - free carpooling website - travel from home to your work place - carsharing </title>
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
	include_once("analyticstracking.php");

	echo '	<div ID="content">';

if (isset($_SESSION['error']))
{
	echo '<div id="error"><p>' . $_SESSION['error']. '</p></div>';
}
	echo '	<h1>Offer a lift</h1><br>
		
		
<form action="offer_post.php" method="post"> 
	<div ID="depart">
		<h2>Choose your departure options</h2>
		
		<p>From: <select name="departure_location">';

$reponse = $bdd->query('SELECT locations.* FROM locations, user WHERE locations.id_user=user.id AND id_user = '.$id.'');
while ($donnees = $reponse->fetch())
{
    echo '<option value="'.$donnees['id'].'">'.$donnees['name'].'</option>' ;
}
$reponse->closeCursor();

 echo '
		</select>
		<a href="GPS_finder.php">Add New location</a><br>
		<br><p>Date:	<i style="float:right; margin-right:100px;">Time:</i> </p>
		 <p><input style="margin-right:50px;" type="text" id="datepicker" name="departure_date" value="';
		 if (isset($_SESSION['departure_date'])) { echo $_SESSION['departure_date']; } 		 
		 echo '
		 
		 "> 
		<select name="departure_time_hour" >';
		
		$count = 0 ;
		while ($count < 24)
		{
			echo '<option value="'.$count.'" '; 
			if (isset($_SESSION['departure_time_hour']))
				{ 
					if ($_SESSION['departure_time_hour'] == "'.$count.'")
						{ 
							echo 'selected="selected"';
						}
				} 
			echo '>'.$count.'</option>';
			$count = $count +1;
		}
		echo '</select>h
		<select name="departure_time_minutes" >';
		$count = 0 ;
		while ($count < 60)
		{
			echo '<option value="'.$count.'" '; 
			if (isset($_SESSION['departure_time_minutes']))
				{ 
					if ($_SESSION['departure_time_minutes'] == "'.$count.'")
						{ 
							echo 'selected="selected"';
						}
				} 
			echo '>'.$count.'</option>';
			$count = $count +5;
		}
		 echo '</select>
		</p><br>
	</div>
	<div ID="arrivee">
		<h2>Choose your arrival options</h2>
		
		<p>From: <select name="arrival_location">
		';

$reponse = $bdd->query('SELECT locations.* FROM locations, user WHERE locations.id_user=user.id AND id_user = '.$id.'');
while ($donnees = $reponse->fetch())
{
    echo '<option value="'.$donnees['id'].'">'.$donnees['name'].'</option>' ;
}
$reponse->closeCursor();

echo '
		</select>
		<a href="GPS_finder.php">Add New location</a><br><br>
		
		<p>Date:	<i style="float:right; margin-right:100px;">Time:</i> </p>
		 <p><input  style="margin-right:50px;" type="text" id="datepicker2" name="arrival_date" value="';
		 if (isset($_SESSION['arrival_date'])) { echo $_SESSION['arrival_date']; } 		 
		 echo '
		 
		 "> 
		<select name="arrival_time_hour" >';

           $count = 0 ;
		while ($count < 24)
		{
			echo '<option value="'.$count.'" '; 
			if (isset($_SESSION['arrival_time_hour']))
				{ 
					if ($_SESSION['arrival_time_hour'] == "'.$count.'")
						{ 
							echo 'selected="selected"';
						}
				} 
			echo '>'.$count.'</option>';
			$count = $count +1;
		}
		echo '</select>h
		<select name="arrival_time_minutes" >';
		$count = 0 ;
		while ($count < 60)
		{
			echo '<option value="'.$count.'" '; 
			if (isset($_SESSION['arrival_time_minutes']))
				{ 
					if ($_SESSION['arrival_time_minutes'] == "'.$count.'")
						{ 
							echo 'selected="selected"';
						}
				} 
			echo '>'.$count.'</option>';
			$count = $count +5;
		}
		 echo '</select>
		
		</p><br>
	</div>
	<br> 
		<label for="comment">Type your add in the below field, you can include any informations you like for example: the kind of car you have, how many seats are available, eventualy the price you ask....	</label> <br>
        <textarea name="comment"  type="text" id="comment" >'; 
		if (isset($_SESSION['comment'])) { echo $_SESSION['comment']; } 
		echo '
		</textarea><br>
        <div id="divconfirm"><input ID="offerconfirm" type="submit" value="Confirm" /></div>
</form>

		</div>';
		
include("footer.php");
$_SESSION['error'] = null;


echo '	</body>
</html>
';
?>