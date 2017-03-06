<?php 
require 'contact_serveur.php';
session_start();
//if (isset($_GET['message'])){
$salon=ajouteMessage ($_GET['message'],$_SESSION['pseudo'],$_GET['salon']);
//echo json_encode(json_decode($salon,true));

echo $salon;
//echo 'haaa';
//}

 ?>