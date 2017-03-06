<?php 
$aiguilleur='192.168.43.61';
function envoi($message){

//$postdata = http_build_query($message[1]);
 
$opts = array('http' =>
    array(
        'method'  => 'GET',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        //'content' => $postdata
    )
);
 $message=str_replace(' ', '%20', $message);
$context  = stream_context_create($opts);
$result = file_get_contents($message, false, $context);
return $result;
}

function poste($message){

//$postdata = http_build_query($message[1]);
 
$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        //'content' => $postdata
    )
);
 $message=str_replace(' ', '%20', $message);
$context  = stream_context_create($opts);
$result = file_get_contents($message, false, $context);

return $result;
}

function veriflogin($pseudo){
	global $aiguilleur;
return envoi('http://'.$aiguilleur.':8000/subscribe?login='.$pseudo);
}

function ajouteSalon($salon,$login){
	global $aiguilleur;
	return poste('http://'.$aiguilleur.':8000/addSalon?login='.$login.'&nomSalon='.$salon);
}

function ajouteMessage($message,$pseudo,$salon){
	global $aiguilleur;
	return poste("http://".$aiguilleur.":8000/sendMessage?login=".$pseudo."&nomSalon=".$salon."&message=".$message);
}
function listSalons(){
	global $aiguilleur;
	return envoi("http://".$aiguilleur.":8000/getRooms");
}

function listMessages($salon){
	global $aiguilleur;
	return envoi("http://".$aiguilleur.":8000/getMessagesSalon?login=".$_SESSION['pseudo']."&salon=".$salon);
}

 ?>