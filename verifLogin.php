
<?php 
require_once "contact_serveur.php";
session_start();
if (isset($_POST['pseudo'])){
	$rep=veriflogin($_POST['pseudo']);
	$rep=json_decode($rep,true)['response'];
	

	if ($rep=='login exist'){
		
		echo "<script type='text/javascript'> alert ('ce login existe deja')</script>";
		echo "<script>document.location.href='login.php';</script>";
	}
	else{
		$_SESSION['pseudo']=$rep;
		echo "<script>document.location.href='chatRoom.php';</script>";
	}

}
else{
	header('Location: login.php');
}
 

 ?>
