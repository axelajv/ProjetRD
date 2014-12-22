<?php
include("../config/config.php");

// Connection a la bdd
mysql_connect($serveur, $user, $pass);
mysql_select_db($dernierebase);

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

	fputs($users, $user['IDENTIFIANT'].":{SHA}".md5($motDePasseEtudiant)."\n");
	fputs($rights, "user: ".$user['IDENTIFIANT']."\ncollection: ".$col."\npermission: r\n\n");
}

fclose($rights);
fclose($users);

?>