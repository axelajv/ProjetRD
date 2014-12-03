﻿<?php
include("../../config/config.php");
//error_reporting(E_ALL);
//Connection a la bdd
mysql_connect($serveur,$user,$pass);
mysql_select_db($dernierebase);

//CALDav project - START ------
include("../../script/CalDAVCommunication.php");
//CALDav project - FIN --------

date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fr_FR');
$jour	= date('d');
$mois 	= date('m');
$annee	= date('Y');
$heure	= date('H');
$minute	= date('i');
$i=0;
$newline = "\n";

// Pour générer un calendrier précis
// recuperation de : ID NOM PRENOM
if(	isset($_POST['idprof'])
	&& !empty($_POST['idprof'])
	&& isset($_POST['nom'])
	&& !empty($_POST['nom'])
	&& isset($_POST['prenom'])
	&& !empty($_POST['prenom'])
	// user == prof logged
) {
		$idProf		= $_POST['idprof'];
		$nomProf	= $_POST['nom'];
		$prenomProf	= $_POST['prenom'];

		$requete_precision_prof = "AND codeProf=$idProf AND nom='$nomProf' AND prenom='$prenomProf'";
} else {
		// si aucun prof n'est précisé => EXPORT TOUS CALENDRIERS
		$requete_precision_prof = "";
}

// constitution de la requête
$ressources_profs = "SELECT * FROM $dernierebase.ressources_profs WHERE deleted=0 $requete_precision_prof";

depart_timer("ICSPROF");

foreach($dbh->query($ressources_profs) as $prof) {

		$fichier = "BEGIN:VCALENDAR" . $newline;
		$fichier .= "VERSION:2.0" . $newline;
		$fichier .= "PRODID:-//Developpe par Bruno Million//NONSGML v1.0//EN" . $newline;
		$fichier .= "CALSCALE:GREGORIAN" . $newline;
		$fichier .= "METHOD:PUBLISH" . $newline;
		$fichier .= "X-WR-CALNAME:".$prof['prenom']." ".$prof['nom'] . $newline;
		$fichier .= "X-WR-TIMEZONE:Europe/paris" . $newline;

		for($k=0;$k<=$nbdebdd-1;$k++) {
				mysql_select_db("$base[$k]");
				$seances_profs = "SELECT * FROM $base[$k].seances_profs WHERE codeRessource='$prof[codeProf]' AND deleted=0";

				foreach($dbh->query($seances_profs) as $seances_prof) {
						$seances = "SELECT * FROM $base[$k].seances WHERE codeSeance='$seances_prof[codeSeance]' AND deleted=0";
						$seances_salles = "SELECT * FROM $base[$k].seances_salles WHERE codeSeance='$seances_prof[codeSeance]' AND deleted=0";

						foreach($dbh->query($seances) as $seance) {
								$fichier .= "BEGIN:VEVENT" . $newline;

								//nom de la seance
								$enseignements=mysql_query("SELECT * FROM $base[$k].enseignements WHERE codeEnseignement='$seance[codeEnseignement]' AND deleted=0");
								$enseignement = mysql_fetch_array($enseignements);
								$numero_type=$enseignement['codeTypeActivite'];
								$types=mysql_query("SELECT * FROM $base[$k].types_activites WHERE codeTypeActivite='$numero_type'");
								$type_enseignement = mysql_fetch_array($types);
								$type=$type_enseignement['alias'];

								//création de la ligne summary
								//récupération de différentes infos du champs nom de la table enseignement
								$cursename=explode("_",$enseignement['nom']);
								//récuperation de la liste des groupes
								$seances_groupes = "SELECT * FROM $base[$k].seances_groupes WHERE codeSeance='$seances_prof[codeSeance]' AND deleted=0";

								$nomgroupe = '';

								foreach($dbh->query($seances_groupes) as $seance_groupe) {
									$groupes_sql = "SELECT * FROM $base[$k].ressources_groupes WHERE codeGroupe='$seance_groupe[codeRessource]' AND deleted=0";
									$groupes_stmt = $dbh->prepare($groupes_sql);
									$groupes_stmt->execute();
									$groupe = $groupes_stmt->fetch();
									$nomgroupe = trim($groupe['nom']);
								}

								$fichier .= "SUMMARY:".$cursename[1]." - ".$type." - ".$nomgroupe . $newline;
								$fichier .= "CATEGORIES:".$cursename[0] . $newline;

								//date debut seance
								$dateseance = $seance['dateSeance'];
								$dateseance = str_replace("-","",$dateseance);
								$heuredebutseance=$seance['heureSeance'];
								if (strlen($heuredebutseance)<=3) {
										$heuredebutseance="0".$heuredebutseance;
								}
								$anneeseance=substr($dateseance,0,4);
								$moisseance=substr($dateseance,4,2);
								$jourseance=substr($dateseance,6,2);
								$heureseance=substr($heuredebutseance,0,2);
								$minuteseance=substr($heuredebutseance,2,2);

								$dates= gmstrftime("DTSTART:%Y%m%dT%H%M%SZ", mktime($heureseance, $minuteseance, 0, $moisseance, $jourseance, $anneeseance));

								$fichier .= $dates . $newline;

								//date fin seance
								$heuredebut=gmstrftime("%H", mktime($heureseance, $minuteseance, 0, $moisseance, $jourseance, $anneeseance));
								$mindebut=gmstrftime("%M", mktime($heureseance, $minuteseance, 0, $moisseance, $jourseance, $anneeseance));
								$heuredebutenmin=$heuredebut*60+$mindebut;

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

								if (strlen($heurefin)==1) $heurefin="0".$heurefin;
								$minfin=$heurefinenmin%60;
								if (strlen($minfin)==1) $minfin="0".$minfin;

								$fichier .= "DTEND:".$dateseance."T".$heurefin.$minfin."00Z" . $newline;
								//numero de la salle

								foreach($dbh->query($seances_salles) as $seance_salle) {
									$ressources_salles_sql = "SELECT * FROM $base[$k].ressources_salles WHERE codeSalle='$seance_salle[codeRessource]' AND deleted=0";
									$ressources_salles_stmt = $dbh->prepare($ressources_salles_sql);
									$ressources_salles_stmt->execute();
									$salle = $ressources_salles_stmt->fetch();
								}
								$nomsalle = '' . trim($salle['nom']);

								$fichier .= "LOCATION:" . $nomsalle . $newline;

								//detail de la seance

								if($seance['commentaire']!="") {
									$commentaire=utf8_encode($seance['commentaire']);
									$commentaire=str_replace(array('à', 'â', 'ä', 'á', 'ã', 'å','î', 'ï', 'ì', 'í', 'ô', 'ö', 'ò', 'ó', 'õ', 'ø','ù', 'û', 'ü', 'ú','é', 'è', 'ê', 'ë','ç', 'ÿ', 'ñ'),array('a', 'a', 'a', 'a', 'a', 'a','i', 'i', 'i', 'i','o', 'o', 'o', 'o', 'o', 'o','u', 'u', 'u', 'u','e', 'e', 'e', 'e','c', 'y', 'n'),$commentaire);
									$commentaire=strtoupper($commentaire);

									$fichier .= "DESCRIPTION;LANGUAGE=fr-CA:MATIERE : ".$cursename[1]." - ".$type."\\nGROUPE : ".$nomgroupe."\\nDUREE : ".$heureduree."h".$minduree. "\\nCOMMENTAIRE : ".$commentaire. "\n";
								}
								else {
									$fichier .= "DESCRIPTION;LANGUAGE=fr-CA:MATIERE : ".$cursename[1]." - ".$type."\\nGROUPE : ".$nomgroupe."\\nDUREE : ".$heureduree."h".$minduree . $newline;
								}
								$fichier .= "DTSTAMP:".$annee.$mois.$jour."T".$heure.$minute."00Z" . $newline;
								$fichier .= "UID:".$annee.$mois.$jour."T"."000001Z-".$i."@ufrsitec.u-paris10.fr" . $newline;
								$i=$i+1;

								$fichier .= "END:VEVENT" . $newline;
						}
				}

				//reservations
				//$reservations_profs = mysql_query("SELECT * FROM $base[$k].reservations_profs WHERE codeRessource='$prof[codeProf]' AND deleted= '0'");
				$reservations_profs = "SELECT * FROM $base[$k].reservations_profs WHERE codeRessource='$prof[codeProf]' AND deleted=0";

				foreach($dbh->query($reservations_profs) as $reservation_prof) {
							$reservations = "SELECT * FROM $base[$k].reservations WHERE codeReservation='$reservation_prof[codeReservation]' AND deleted=0";

							foreach($dbh->query($reservations) as $reservation) {
									$fichier .= "BEGIN:VEVENT" . $newline;

									//nom de la reservation
									$commentaire=utf8_encode($reservation['commentaire']);
									$commentaire=str_replace(array('à', 'â', 'ä', 'á', 'ã', 'å','î', 'ï', 'ì', 'í', 'ô', 'ö', 'ò', 'ó', 'õ', 'ø','ù', 'û', 'ü', 'ú','é', 'è', 'ê', 'ë','ç', 'ÿ', 'ñ'),array('a', 'a', 'a', 'a', 'a', 'a','i', 'i', 'i', 'i','o', 'o', 'o', 'o', 'o', 'o','u', 'u', 'u', 'u','e', 'e', 'e', 'e','c', 'y', 'n'),$commentaire);
									$commentaire=strtoupper($commentaire);
									$fichier .= "SUMMARY:".$commentaire . $newline;

									$fichier .= "CLASS:PUBLIC" . $newline;

									//date debut reservation
									$datereservation=$reservation['dateReservation'];
									$datereservation=str_replace("-","",$datereservation);
									$heuredebutreservation=$reservation['heureReservation'];
									if (strlen($heuredebutreservation)<=3) {
											$heuredebutreservation="0".$heuredebutreservation;
									}
									$anneereservation=substr($datereservation,0,4);
									$moisreservation=substr($datereservation,4,2);
									$jourreservation=substr($datereservation,6,2);
									$heurereservation=substr($heuredebutreservation,0,2);
									$minutereservation=substr($heuredebutreservation,2,2);

									$dates= gmstrftime("DTSTART:%Y%m%dT%H%M%SZ", mktime($heurereservation, $minutereservation, 0, $moisreservation, $jourreservation, $anneereservation));

									$fichier .= $dates . $newline;

									//date fin reservation
									$heuredebut=gmstrftime("%H", mktime($heurereservation, $minutereservation, 0, $moisreservation, $jourreservation, $anneereservation));
									$mindebut=gmstrftime("%M", mktime($heurereservation, $minutereservation, 0, $moisreservation, $jourreservation, $anneereservation));
									$heuredebutenmin=$heuredebut*60+$mindebut;

									if (strlen($reservation['dureeReservation'])==4) {
											$heureduree=substr($reservation['dureeReservation'],0,2);
											$minduree=substr($reservation['dureeReservation'],2,2);
									}
									if (strlen($reservation['dureeReservation'])==3) {
											$heureduree=substr($reservation['dureeReservation'],0,1);
											$minduree=substr($reservation['dureeReservation'],1,2);
									}
									if (strlen($reservation['dureeReservation'])==2) {
											$heureduree=0;
											$minduree=$reservation['dureeReservation'];
									}
									$heurefinenmin=$heuredebutenmin+$heureduree*60+$minduree;
									$heurefin=intval($heurefinenmin/60);

									if (strlen($heurefin)==1) {
											$heurefin="0".$heurefin;
									}
									$minfin=$heurefinenmin%60;
									if (strlen($minfin)==1) {
											$minfin="0".$minfin;
									}
									$fichier .= "DTEND:".$datereservation."T".$heurefin.$minfin."00Z" . $newline;

									$nomsalle = '';

									//numero de la salle
									$reservations_salles = "SELECT * FROM $base[$k].reservations_salles WHERE codeReservation='$reservation_prof[codeReservation]' AND deleted=0 AND codeRessource!=0";
									foreach($dbh->query($reservations_salles) as $reservation_salle) {
											$ressources_salles = "SELECT * FROM $base[$k].ressources_salles WHERE codeSalle='$reservation_salle[codeRessource]' AND deleted=0";
											foreach($dbh->query($ressources_salles) as $ressource_salle) {
												$nomsalle = trim($salle['nom']);
											}
									}
									$fichier .= "LOCATION:".$nomsalle . $newline;

									//detail de la seance
									$fichier .= "DESCRIPTION;LANGUAGE=fr-CA:INTITULE : ".$commentaire." \\nDUREE : ".$heureduree."h".$minduree . $newline;

									$fichier .= "CATEGORIES:Emplois du temps du PST" . $newline;
									$fichier .= "DTSTAMP:".$annee.$mois.$jour."T".$heure.$minute."00Z" . $newline;
									$fichier .= "UID:".$annee.$mois.$jour."T"."000001Z-".$i."@ufrsitec.u-paris10.fr" . $newline;
									$i=$i+1;
									$fichier .= "END:VEVENT" . $newline;
							}
					}
			}

			$fichier .= "END:VCALENDAR";

			fin_timer("ICSPROF");
			echo afficher_timer("ICSPROF");

			$nomfichier=$prof['nom']."_".$prof['prenom'].".ics";
			$nomfichier=str_replace(" ","_",$nomfichier);
			$nomfichier=strtolower($nomfichier);

			file_put_contents($nomfichier,$fichier);



			//CALDav project - START ------
			$uid = $annee.$mois.$jour."T"."000001Z-".$i."@ufrsitec.u-paris10.fr";
			sendICSFile($nomfichier,$fichier,$ENSEIGNANT,$uid);
			//---------------- FIN --------
}
?>
