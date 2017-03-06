<?php 
require 'contact_serveur.php';
session_start();
//if (isset($_GET['message'])){
$salon=listSalons();

if (isset($_SESSION['salons'])){
	if ($_SESSION['salons']!=$salon){
		$_SESSION['salons']=$salon;
		echo $_SESSION['salons'];
		
	}

}
else{
	 
	 $_SESSION['salons']=$salon;
	 echo $salon;

}

//echo 'haaa';
//}

 ?>