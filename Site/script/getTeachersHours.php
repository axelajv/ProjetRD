<?php

$codeProf = 0;

if(isset($_GET["prof"]) && $_GET["prof"] != 0) {
	$codeProf = $_GET["prof"];

	$sql = "SELECT * FROM `seances_profs,seances WHERE codeRessource:codeProf AND seances_profs.codeSeance=seances.codeSeance ";
	$req = $dbh->prepare($sql);
	$req->execute(array(':codeProf' => $codeProf));
} 


$allSeances = array();

while($ligne = $req->fetch())
{
	$seance = array('dateSeance' => $ligne['dateSeance']);
	array_push($allSeances, $seance);
}

$req->closeCursor();

?>