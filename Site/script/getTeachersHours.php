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
			seances.dureeSeance as seancesDureeSeance,
			GROUP_CONCAT(ressources_groupes.nom SEPARATOR ' / ') as nomFormation, 
			enseignements.identifiant as codeApogee, 
			matieres.nom as nomMatiere,
			seances.dateSeance,
			seances.heureSeance,
			codeTypeActivite,
			volumeReparti,
			forfaitaire
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
			seances.annulee='0'
			GROUP BY seances.codeSeance
			ORDER BY seances.dateSeance	";
			
	$req = $dbh->prepare($sql);
	$req->execute(array(':codeProf' => $codeProf));
} 


$allSeances = array();

function pad_zero($value) {
	return sprintf("%02d", $value);
}

function add_int_hour($int_hour1, $int_hour2) {
	$minutes1 = $int_hour1 % 100;
	$heure1 = floor($int_hour1 / 100) + floor($minutes1 / 60);
	$minutes1 = $minutes1 % 60;
	
	$minutes2 = $int_hour2 % 100;
	$heure2 = floor($int_hour2 / 100) + floor($minutes2 / 60);
	$minutes2 = $minutes2 % 60;
	
	$heure = $heure1 + $heure2;
	$minutes = $minutes1 + $minutes2;
	
	$heure_result = $heure + floor($minutes / 60);
	$minutes_result = $minutes	% 60;
	
	return $heure_result * 100 + $minutes_result;
}

function pretty_hour($int_hour) {
	$minutes = $int_hour % 100;
	$heure = floor($int_hour / 100) + floor($minutes / 60);
	$minutes = $minutes % 60;
	if ($heure == 0 && $minutes == 0) {
		return "";
	} else {
		return pad_zero($heure).'h'.pad_zero($minutes);
	}
}

$cumuls = array();
$heuresParMois = array(9 => 0, 10 => 0, 11 => 0, 12 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0);
while($ligne = $req->fetch())
{
	// On retourne le sens de  la date de la séance
	$ligne["dateSeance"] = date("d-m-Y", strtotime($ligne["dateSeance"]));
	$ligne["dateSeanceFormatee"] = date("Y-m-d", strtotime($ligne["dateSeance"]));
	
	$currMonth = (int)date("m", strtotime($ligne["dateSeance"]));
	$heuresParMois[$currMonth] = add_int_hour($heuresParMois[$currMonth], $ligne["seancesDureeSeance"]);
	
	// Calcul heure Fin avec Heure Début et Durée 
	$heureFin = add_int_hour($ligne["heureSeance"], $ligne["seancesDureeSeance"]);
	
	$ligne["heureFin"] = pretty_hour($heureFin);
	$ligne["heureDebut"] = pretty_hour($ligne["heureSeance"]);
	
	$dureeCM = $taux_type_ens[$ligne["codeTypeActivite"]][0] * $ligne["seancesDureeSeance"];
	$dureeTD = $taux_type_ens[$ligne["codeTypeActivite"]][1] * $ligne["seancesDureeSeance"];
	$dureeTP = $taux_type_ens[$ligne["codeTypeActivite"]][2] * $ligne["seancesDureeSeance"];
	$eqTD = ($dureeCM > 0 ? $dureeCM + 130 : 0) + $dureeTD + $dureeTP; 
	
	if(array_key_exists($ligne["nomMatiere"], $cumuls)) {
		$cumuls[$ligne["nomMatiere"]]["dureeCM"] = add_int_hour($cumuls[$ligne["nomMatiere"]]["dureeCM"], $dureeCM);
		$cumuls[$ligne["nomMatiere"]]["dureeTD"] = add_int_hour($cumuls[$ligne["nomMatiere"]]["dureeTD"], $dureeTD);
		$cumuls[$ligne["nomMatiere"]]["dureeTP"] = add_int_hour($cumuls[$ligne["nomMatiere"]]["dureeTP"], $dureeTP);
		$cumuls[$ligne["nomMatiere"]]["eqTD"] = add_int_hour($cumuls[$ligne["nomMatiere"]]["eqTD"], $eqTD);
	} else {
	    $cumuls[$ligne["nomMatiere"]] = array(
			"type" => "cumul",
			"nomMatiere" => $ligne["nomMatiere"],
			"dureeCM" => $dureeCM, 
			"dureeTD" => $dureeTD, 
			"dureeTP" => $dureeTP,
			"eqTD" => $eqTD
		);
	}
	
	$ligne["dureeCM"] = pretty_hour($dureeCM);
	$ligne["dureeTD"] = pretty_hour($dureeTD);
	$ligne["dureeTP"] = pretty_hour($dureeTP);
	$ligne["eqTD"] = pretty_hour($eqTD);
	$ligne["type"] = "normal";
	
	array_push($allSeances, $ligne);
}

foreach($cumuls as $cumul) {
	$cumul["dureeCM"] = pretty_hour($cumul["dureeCM"]);
	$cumul["dureeTD"] = pretty_hour($cumul["dureeTD"]);
	$cumul["dureeTP"] = pretty_hour($cumul["dureeTP"]);
	$cumul["eqTD"] = pretty_hour($cumul["eqTD"]);
	
	array_push($allSeances, $cumul);
}

foreach($heuresParMois as $month => $cumulHeures) {
	$strEngMois = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	$strFrMois = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août',	'Septembre', 'Octobre', 'Novembre',	'Décembre');

	$strMonth = str_ireplace($strEngMois, $strFrMois, date('F', mktime(0, 0, 0, $month, 10)));
	
	//$heuresParMois["heure"]=pretty_hour($cumulHeures);
	$heuresParMois[$month] = array("num" => $cumulHeures, "str" => pretty_hour($cumulHeures), "mois" => $strMonth);
	
}

$req->closeCursor();


?>