<?php
include("session.php"); 
$bdd->exec('DELETE FROM offers WHERE id=' .$_GET['offer']. ' AND id_user='.$id.' ');
header('location: active_offers.php');
?>