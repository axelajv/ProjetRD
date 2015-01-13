<?php
include("../config/config.php");

// Connection a la bdd
mysql_connect($serveur, $user, $pass);
mysql_select_db($dernierebase);

//choisir un dossier cible en commun avec l'equipe projet, ce choix est TEMPORAIRE
//puisqu'il est impossible de les creer directement dans le dossier de config radicale
$rights = fopen('../config/rights', 'w+');
$users = fopen('../config/users', 'w+');

$query = "SELECT IDENTIFIANT,'' as MDP,'ETUD' as TYPE FROM ressources_etudiants UNION SELECT LOGIN,MOTPASSE,'PROF' from login_prof";

foreach($dbh->query($query) as $user) {

	if($user['TYPE']=='PROF'){
		$col=".*";
	}
	else if($user['TYPE']=='ETUD'){
		$col="(^Etudiants$)|(^Filieres$)|(^Salles$)";
	}

	fputs($users, $user['IDENTIFIANT'].":{SHA}".crypt($motDePasseEtudiant, base64_encode($motDePasseEtudiant))."\n");
	fputs($rights, "user: ".$user['IDENTIFIANT']."\ncollection: ".$col."\npermission: r\n\n");
}

fclose($rights);
fclose($users);

?>
