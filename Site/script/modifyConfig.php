<?php

	session_start();
	include('../config/config.php');
	
	$sql="update login_prof set weekend=:weekend,heureDebut=:heureDebut,heureFin=:heureFin, bouton1Debut=:debut_bouton_1,bouton2Debut=:debut_bouton_2,bouton3Debut=:debut_bouton_3,bouton4Debut=:debut_bouton_4,bouton1Fin=:fin_bouton_1,bouton2Fin=:fin_bouton_2,bouton3Fin=:fin_bouton_3,bouton4Fin=:fin_bouton_4 where login=:login ";
	$req_modif_config=$dbh->prepare($sql);
	$req_modif_config->execute(array(':weekend'=>$_POST['weekend'],':heureDebut'=>$_POST['beginTime'],':heureFin'=>$_POST['endTime'],':login'=>$_SESSION['teachLogin'],':debut_bouton_1'=>$_POST['beginBtn1'],':debut_bouton_2'=>$_POST['beginBtn2'],':debut_bouton_3'=>$_POST['beginBtn3'],':debut_bouton_4'=>$_POST['beginBtn4'],':fin_bouton_1'=>$_POST['endBtn1'],':fin_bouton_2'=>$_POST['endBtn2'],':fin_bouton_3'=>$_POST['endBtn3'],':fin_bouton_4'=>$_POST['endBtn4']));

	header('Location: ../index.php?page=config&successId=1');
	exit();
	
?>