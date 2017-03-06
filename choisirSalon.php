<?php 
require 'contact_serveur.php';
session_start();
if (isset($_GET['salon'])){
$message=listMessages($_GET['salon']);

if (isset($_SESSION['messages'])){
	if ($_SESSION['messages']!=$message){
		$_SESSION['messages']=$message;
	    echo $_SESSION['messages'];	
		
	}

}
else{
	 
	 $_SESSION['messages']=$message;
	    echo $_SESSION['messages'];

}

//echo 'haaa';
} 
 ?>