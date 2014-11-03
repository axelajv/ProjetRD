<?php

session_start();

error_reporting(E_ALL);

include('../config/config.php');

// tableau suivant l'état de la connexion
$tableau = array("message"	 => "En attente",
				"connexion" => FALSE);

if (isset($_POST['studyLogin']) && !empty($_POST['studyLogin']))
{
	// variables
	$find		= FALSE;
	$studyLogin	= $_POST['studyLogin'];

	// si tous les champs sont remplis alors on vérifie l'existence en BDD
	$req = $dbh->prepare('SELECT * FROM ressources_etudiants WHERE identifiant = :studyLogin');
	$req->bindParam(':studyLogin', $studyLogin, PDO::PARAM_STR);
	$req->execute();

	// $find == 1 si une ligne correspond
	$find = $req->rowCount();

	/* ATTENTION :
	* Dans la table "ressources_etudiants" plusieurs
	* logins existent pour un même libellé
	*/
	if($find > 0) // connexion réussie
	{
		// compteur de connexion
		$dbh->exec('UPDATE compteur SET valeur=valeur+1 WHERE id_compteur=1');

		// init variable de session
		$_SESSION['studyLogin'] = $studyLogin;

		// $tableau sert de réponse à l'appel ajax
		$tableau["message"]	  	= "Connexion en cours";
		$tableau["connexion"] 	= TRUE;
	}
	else // connexion échouée
	{
		// $tableau sert de réponse à l'appel ajax
		$tableau["message"]	  = "Connexion impossible";
		$tableau["connexion"] = FALSE;
	}

	// fermeture de la connexion
	$req->closeCursor();

}
else
{
	// $tableau sert de réponse à l'appel ajax
	$tableau["message"]	  = "informations incorrectes";
	$tableau["connexion"] = false;
}

echo json_encode($tableau);
