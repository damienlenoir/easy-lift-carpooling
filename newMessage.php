 <?php
include("session.php"); 
if (isset($_GET['send']))
{
        $pseudo = $_GET['send']; 
}
?>


<!DOCTYPE html>
<html xml:lang="en" lang="en">
	<head>
		<title>easy lift - Send a new message - free carpooling website - travel from home to your work place - carsharing </title>
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
	include_once("analyticstracking.php");

	echo '	<div ID="content">';
	
		if (isset($_SESSION['error']))
{
	echo '<div id="error"><p>' . $_SESSION['error']. '</p></div>';
}
?>
			<h1>New message</h1>
			<p><a ID="buttonNewMessage" href="myAccount.php#widget_inbox">Back to inbox</a>   <a ID="buttonSentMessages" href="sentMessages.php">Sent Messages</a> </p><br><br>
			<div ID="send">
			<form action="message_post.php" method="post"> 
				<p>Subject:</p><br>
				<input type="text" name="subject" size="100" value="<?php if (isset($_SESSION['subject'])) { echo $_SESSION['subject']; } ?>"><br><br>
				<p>To: (username)</p><br>
				<input type="text" name="receiver" size="100" value="<?php if (isset($pseudo)) { echo $pseudo; } ?>"><br><br>
				<p>Message:</p><br>
				<textarea name="message" rows="6" cols="100"><?php if (isset($_SESSION['message'])) { echo $_SESSION['message']; } ?> </textarea><br><br>  	
				<br></br>
				
				<input type="submit" value="Send !">
			</form>
						
			</div>

		</div>
<?php include("footer.php");
$_SESSION['error'] = null;
?>
	</body>
</html>

