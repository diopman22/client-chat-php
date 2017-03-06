<?php 
require 'contact_serveur.php';
session_start();
if (isset($_GET['salon'])){
$salon=ajouteSalon ($_GET['salon'],$_SESSION['pseudo']);
//echo json_encode(json_decode($salon,true));
echo $salon;
//echo 'haaa';
}

 ?>