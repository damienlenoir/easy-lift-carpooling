<?php
 include("session.php"); 
 $bdd->exec('
 DELETE 
 FROM locations 
 WHERE id=' . $_GET['id'] . ' 
 AND id_user='.$id.'
 
 ');
 header('location: myAccount.php');
 ?>