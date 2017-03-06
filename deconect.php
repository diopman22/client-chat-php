<?php 
require 'contact_serveur.php';
$addr='192.168.43.61:8000';
session_start();
poste('http://'.$addr.'/unSubscribe?login='.$_SESSION['pseudo']);
session_destroy();

header("Location: login.php");
 ?>