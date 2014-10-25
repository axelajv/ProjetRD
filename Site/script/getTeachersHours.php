<?php

$codeProf = 0;

if(isset($_GET["prof"]) && $_GET["prof"] != 0) {
	$codeProf = $_GET["prof"];
	$sql = "
		SELECT 
			* ,
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

while($ligne = $req->fetch())
{
	// On retourne le sens de  la date de la séance
	$ligne["dateSeance"] = date("d-m-Y", strtotime($ligne["dateSeance"]));
	
	// Calcul heure Fin avec Heure Début et Durée 
	$heureFin = $ligne["heureSeance"] + $ligne["dureeSeance"];
	$minutes = $heureFin % 100;
	$heure = floor($heureFin / 100) + floor($minutes / 60);
	$minutes = $minutes % 60;
	
	$ligne["heureFin"] = pad_zero($heure).'h'.pad_zero($minutes);
	$ligne["heureDebut"] = pad_zero(floor($ligne["heureSeance"] / 100)).'h'.pad_zero(floor($ligne["heureSeance"] % 100));
	
	
	array_push($allSeances, $ligne);
}

$req->closeCursor();

?>