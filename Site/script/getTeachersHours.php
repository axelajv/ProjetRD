<?php

// TODO : put in config.php
$taux_type_ens = array(   
	1 => array(1,0,0),
    2 => array(0,1,0),
    3 => array(0,0,1),
	4 => array(0,1,0),
	5 => array(0,1,0),
	6 => array(0,1,0),
	7 => array(0,1,0),
	8 => array(0,1,0),
	9 => array(0,1,0),
	10 => array(0,1,0),
	11 => array(0,1,0),
	12 => array(0,1,0),
	13 => array(0,1,0),
	14 => array(0,1,0),
	15 => array(0,1,0)
);

$codeProf = 0;
if(isset($_GET["prof"]) && $_GET["prof"] != 0) {
	$codeProf = $_GET["prof"];
	$sql = "
		SELECT 
			*,
			seances.dureeSeance as seancesDureeSeance,
			ressources_groupes.nom as nomFormation, 
			enseignements.identifiant as codeApogee, 
			matieres.nom as nomMatiere
		FROM 
			seances_profs,
			seances,
			seances_groupes,
			ressources_groupes,
			enseignements,
			matieres
		WHERE 
			seances_profs.codeRessource=:codeProf AND 
			seances_profs.codeSeance=seances.codeSeance AND
			seances_groupes.codeSeance=seances.codeSeance AND
			seances_groupes.codeRessource=ressources_groupes.codeGroupe AND
			seances.codeEnseignement=enseignements.codeEnseignement AND
			matieres.codeMatiere=enseignements.codeMatiere AND 
			seances.deleted='0' AND 
			matieres.deleted='0' AND 
			enseignements.deleted='0' AND 
			seances.annulee='0'";
			
	$req = $dbh->prepare($sql);
	$req->execute(array(':codeProf' => $codeProf));
} 


$allSeances = array();

function pad_zero($value) {
	return sprintf("%02d", $value);
}

function pretty_hour($hour, $minutes) {
	if ($hour == 0 && $minutes == 0) {
		return "";
	} else {
		return pad_zero($hour).'h'.pad_zero($minutes);
	}
}

while($ligne = $req->fetch())
{
	// On retourne le sens de  la date de la séance
	$ligne["dateSeance"] = date("d-m-Y", strtotime($ligne["dateSeance"]));
	
	// Calcul heure Fin avec Heure Début et Durée 
	$heureFin = $ligne["heureSeance"] + $ligne["seancesDureeSeance"];
	$minutes = $heureFin % 100;
	$heure = floor($heureFin / 100) + floor($minutes / 60);
	$minutes = $minutes % 60;
	
	$ligne["heureFin"] = pretty_hour($heure, $minutes);
	$ligne["heureDebut"] = pretty_hour(floor($ligne["heureSeance"] / 100), floor($ligne["heureSeance"] % 100));
	
	$dureeCM = $taux_type_ens[$ligne["codeTypeActivite"]][0] * $ligne["seancesDureeSeance"];
	$dureeTD = $taux_type_ens[$ligne["codeTypeActivite"]][1] * $ligne["seancesDureeSeance"];
	$dureeTP = $taux_type_ens[$ligne["codeTypeActivite"]][2] * $ligne["seancesDureeSeance"];
	
	$ligne["dureeCM"] = pretty_hour(floor($dureeCM / 100), floor($dureeCM % 100));
	$ligne["dureeTD"] = pretty_hour(floor($dureeTD / 100), floor($dureeTD % 100));
	$ligne["dureeTP"] = pretty_hour(floor($dureeTP / 100), floor($dureeTP % 100));
	
	array_push($allSeances, $ligne);

}

$req->closeCursor();

?>