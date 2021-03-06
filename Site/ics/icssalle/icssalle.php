<?php
include("../../config/config.php");
//error_reporting(E_ALL);
//Connection a la bdd
mysql_connect($serveur,$user,$pass);
mysql_select_db($dernierebase);

//CALDav project - START ------
include("../../script/CalDAVCommunication.php");
//CALDav project - FIN --------

error_reporting(E_ERROR | E_PARSE | E_NOTICE);

date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fr_FR');
$jour	= date('d');
$mois 	= date('m');
$annee	= date('Y');
$heure	= date('H');
$minute	= date('i');
$i=0;
$newline = "\n";

$noData=true;

// Pour générer un calendrier de salle précis
// recuperation de : ID NOM
if(	isset($_POST['idsalle'])
&& !empty($_POST['idsalle'])
&& isset($_POST['nom'])
&& !empty($_POST['nom'])
// user == prof logged
) {
	$idSalle	= htmlspecialchars($_POST['idsalle'], ENT_QUOTES, 'UTF-8');
	$nomSalle	= htmlspecialchars($_POST['nom'], ENT_QUOTES, 'UTF-8');

	$requete_precision_salle = "AND codeSalle=$idSalle AND nom='$nomSalle'";
} else {
	// si aucun prof n'est précisé => EXPORT TOUS CALENDRIERS
	$requete_precision_salle = "";
}

//constitution de la requête
$ressources_salles = "SELECT * FROM ressources_salles WHERE deleted=0 $requete_precision_salle";

depart_timer("ICSSALLE");

foreach($dbh->query($ressources_salles) as $salle) {

	$fichier = "";
	$fichier = "BEGIN:VCALENDAR". $newline;
	$fichier .= "VERSION:2.0". $newline;
	$fichier .= "PRODID:-//Developpe par Bruno Million//NONSGML v1.0//EN". $newline;
	$fichier .= "CALSCALE:GREGORIAN". $newline;
	$fichier .= "METHOD:PUBLISH". $newline;
	$fichier .= "X-WR-CALNAME:".$salle['nom']. $newline;
	$fichier .= "X-WR-TIMEZONE:Europe/paris". $newline;

	$seances_salles = "SELECT * FROM seances_salles WHERE codeRessource='$salle[codeSalle]' AND deleted=0";
	foreach($dbh->query($seances_salles) as $seances_salle) {

		$seances = "SELECT * FROM seances WHERE codeSeance='$seances_salle[codeSeance]' AND deleted=0";
		foreach($dbh->query($seances) as $seance) {
			$noData = false;

			$fichier .= "BEGIN:VEVENT". $newline;

			//nom de la seance
			$enseignements = mysql_query("SELECT * FROM enseignements WHERE codeEnseignement='$seance[codeEnseignement]' AND deleted=0");
			$enseignement = mysql_fetch_array($enseignements);
			$numero_type = $enseignement['codeTypeActivite'];

			$types = mysql_query("SELECT * FROM types_activites WHERE codeTypeActivite='$numero_type'");
			$type_enseignement = mysql_fetch_array($types);
			$type = $type_enseignement['alias'];
			//création de la ligne summary
			//récupération de différentes infos du champs nom de la table enseignement
			$cursename = explode("_",$enseignement['nom']);
			$fichier .= "SUMMARY:".$cursename[1]." - ".$type.$newline;

			//date debut seance
			$dateseance=$seance['dateSeance'];
			//$dateseance=ereg_replace("[-:]","",$dateseance);
			$dateseance=preg_replace('/-/s',"",$dateseance);
			$heuredebutseance=$seance['heureSeance'];
			if (strlen($heuredebutseance)<=3)
			$heuredebutseance="0".$heuredebutseance;

			$anneeseance  = substr($dateseance,0,4);
			$moisseance	  = substr($dateseance,4,2);
			$jourseance	  = substr($dateseance,6,2);
			$heureseance  = substr($heuredebutseance,0,2);
			$minuteseance = substr($heuredebutseance,2,2);

			$dates = gmstrftime("DTSTART:%Y%m%dT%H%M%SZ", mktime($heureseance, $minuteseance, 0, $moisseance, $jourseance, $anneeseance));

			$fichier .= $dates.$newline;

			//date fin seance
			$heuredebut	= gmstrftime("%H", mktime($heureseance, $minuteseance, 0, $moisseance, $jourseance, $anneeseance));
			$mindebut	= gmstrftime("%M", mktime($heureseance, $minuteseance, 0, $moisseance, $jourseance, $anneeseance));
			$heuredebutenmin = $heuredebut*60 + $mindebut;

			if (strlen($seance['dureeSeance'])==4) {
				$heureduree=substr($seance['dureeSeance'],0,2);
				$minduree=substr($seance['dureeSeance'],2,2);
			}
			if (strlen($seance['dureeSeance'])==3) {
				$heureduree=substr($seance['dureeSeance'],0,1);
				$minduree=substr($seance['dureeSeance'],1,2);
			}
			if (strlen($seance['dureeSeance'])==2) {
				$heureduree=0;
				$minduree=$seance['dureeSeance'];
			}
			$heurefinenmin=$heuredebutenmin+$heureduree*60+$minduree;
			$heurefin=intval($heurefinenmin/60);

			if (strlen($heurefin)==1)
			$heurefin="0".$heurefin;
			$minfin=$heurefinenmin%60;
			if (strlen($minfin)==1)
			$minfin="0".$minfin;

			$fichier .= "DTEND:".$dateseance."T".$heurefin.$minfin."00Z".$newline;

			//detail de la seance
			$seances_groupes = "SELECT * FROM seances_groupes WHERE codeSeance='$seances_salle[codeSeance]' AND deleted=0";
			$nomgroupe = "";
			foreach($dbh->query($seances_groupes) as $seance_groupe) {
				$groupes_sql = "SELECT * FROM ressources_groupes WHERE codeGroupe='$seance_groupe[codeRessource]' AND deleted=0";
				$groupes_stmt = $dbh->prepare($groupes_sql);
				$groupes_stmt->execute();
				$groupe = $groupes_stmt->fetch();

				$nomgroupe = $nomgroupe . $groupe['nom']." ";
			}
			$nomgroupe = trim($nomgroupe);

			if(!empty($seance['commentaire'])) {
				$commentaire = utf8_encode($seance['commentaire']);
				$commentaire = str_replace(
				array('à', 'â', 'ä', 'á', 'ã', 'å',
				'î', 'ï', 'ì', 'í',
				'ô', 'ö', 'ò', 'ó', 'õ', 'ø',
				'ù', 'û', 'ü', 'ú',
				'é', 'è', 'ê', 'ë',
				'ç', 'ÿ', 'ñ'),
				array('a', 'a', 'a', 'a', 'a', 'a',
				'i', 'i', 'i', 'i',
				'o', 'o', 'o', 'o', 'o', 'o',
				'u', 'u', 'u', 'u',
				'e', 'e', 'e', 'e',
				'c', 'y', 'n'),
				$commentaire);
				$commentaire = strtoupper($commentaire);
				$fichier .= "DESCRIPTION;LANGUAGE=fr-CA:MATIERE : ".$cursename[1]." - ".$type."\nGROUPE : ".$nomgroupe."\nDUREE : ".$heureduree."h".$minduree. "\nCOMMENTAIRE : ".$commentaire. $newline;
			}
			else {
				$fichier .= "DESCRIPTION;LANGUAGE=fr-CA:MATIERE : ".$cursename[1]." - ".$type."\nGROUPE : ".$nomgroupe."\nDUREE : ".$heureduree."h".$minduree.$newline;
			}

			$fichier .= "DTSTAMP:".$annee.$mois.$jour."T".$heure.$minute."00Z". $newline;
			$fichier .= "UID:".$annee.$mois.$jour."T"."000001Z-".$i."@ufrsitec.u-paris10.fr". $newline;
			$i = $i+1;
			$fichier .= "CATEGORIES:Emplois du temps du PST". $newline;

			$fichier .= "END:VEVENT". $newline;
		}
	}

	//reservations
	$reservations_salles = "SELECT * FROM reservations_salles WHERE codeRessource='$salle[codeSalle]' AND deleted=0";

	foreach($dbh->query($reservations_salles) as $reservation_salle) {
		$reservations = "SELECT * FROM reservations WHERE codeReservation='$reservation_salle[codeReservation]' AND deleted=0";

		foreach($dbh->query($reservations) as $reservation) {
			$noData = false;

			$fichier .= "BEGIN:VEVENT". $newline;

			//nom de la reservation
			$commentaire = utf8_encode($reservation['commentaire']);
			$commentaire = str_replace(
			array('à', 'â', 'ä', 'á', 'ã', 'å',
			'î', 'ï', 'ì', 'í',
			'ô', 'ö', 'ò', 'ó', 'õ', 'ø',
			'ù', 'û', 'ü', 'ú',
			'é', 'è', 'ê', 'ë',
			'ç', 'ÿ', 'ñ'),
			array('a', 'a', 'a', 'a', 'a', 'a',
			'i', 'i', 'i', 'i',
			'o', 'o', 'o', 'o', 'o', 'o',
			'u', 'u', 'u', 'u',
			'e', 'e', 'e', 'e',
			'c', 'y', 'n'),
			$commentaire);

			$commentaire = strtoupper($commentaire);

			$fichier .= "SUMMARY:" . $commentaire . $newline;
			$fichier .= "CLASS:PUBLIC" . $newline;

			//date debut reservation
			$datereservation = $reservation['dateReservation'];
			$datereservation = preg_replace('/-/s',"", $datereservation);
			$heuredebutreservation = $reservation['heureReservation'];
			if (strlen($heuredebutreservation)<=3)
			$heuredebutreservation="0".$heuredebutreservation;

			$anneereservation	= substr($datereservation,0,4);
			$moisreservation	= substr($datereservation,4,2);
			$jourreservation	= substr($datereservation,6,2);
			$heurereservation	= substr($heuredebutreservation,0,2);
			$minutereservation	= substr($heuredebutreservation,2,2);

			$dates = gmstrftime("DTSTART:%Y%m%dT%H%M%SZ", mktime($heurereservation, $minutereservation, 0, $moisreservation, $jourreservation, $anneereservation));

			$fichier .= $dates.$newline;

			//date fin reservation
			$heuredebut = gmstrftime("%H", mktime($heurereservation, $minutereservation, 0, $moisreservation, $jourreservation, $anneereservation));
			$mindebut 	= gmstrftime("%M", mktime($heurereservation, $minutereservation, 0, $moisreservation, $jourreservation, $anneereservation));
			$heuredebutenmin = $heuredebut*60 + $mindebut;

			if (strlen($reservation['dureeReservation'])==4)
			{
				$heureduree	= substr($reservation['dureeReservation'],0,2);
				$minduree	= substr($reservation['dureeReservation'],2,2);
			}
			if (strlen($reservation['dureeReservation'])==3)
			{
				$heureduree	= substr($reservation['dureeReservation'],0,1);
				$minduree	= substr($reservation['dureeReservation'],1,2);

			}
			if (strlen($reservation['dureeReservation'])==2)
			{
				$heureduree = 0;
				$minduree = $reservation['dureeReservation'];
			}
			$heurefinenmin = $heuredebutenmin+$heureduree*60+$minduree;
			$heurefin = intval($heurefinenmin/60);

			if (strlen($heurefin)==1)
			$heurefin="0".$heurefin;

			$minfin=$heurefinenmin%60;
			if (strlen($minfin)==1)
			$minfin="0".$minfin;

			$fichier .= "DTEND:".$datereservation."T".$heurefin.$minfin."00Z".$newline;

			//detail de la seance
			$fichier .= "DESCRIPTION;LANGUAGE=fr-CA:INTITULE : " . $commentaire . " \nDUREE : " . $heureduree . "h" . $minduree . $newline;

			$fichier .= "CATEGORIES:Emplois du temps du PST" . $newline;
			$fichier .= "DTSTAMP:" . $annee . $mois . $jour . "T" . $heure . $minute . "00Z" . $newline;
			$fichier .= "UID:" . $annee . $mois . $jour . "T" . "000001Z-" . $i . "@ufrsitec.u-paris10.fr" . $newline;
			$i = $i+1;
			$fichier .= "END:VEVENT" . $newline;

		}

	}

	$fichier .= "END:VCALENDAR";

	fin_timer("ICSSALLE");
	//echo afficher_timer("ICSSALLE");

	/*
	* Fin du traitement - création du fichier ICS
	*/
	if(!$noData)
    {
		$nomfichier = $salle['nom'].".ics";
		$nomfichier	= str_replace(" ","_",$nomfichier);
		$nomfichier	= strtolower($nomfichier);
		file_put_contents($nomfichier,$fichier);

		$uid = $annee . $mois . $jour . "T" . "000001Z-" . $i . "@ufrsitec.u-paris10.fr";
		sendICSFile($nomfichier, $fichier, $SALLE, $uid);
	}
}

//si on ne passe pas dans le boucle (ex: id incorect), on informe quand meme qu'il n'y a pas de donnée
if ($noData) 
	echo "NO_DATA";
else
	echo "OK";
?>
