<?php

session_start();

error_reporting(E_ALL);

include('../config/config.php');

// tableau suivant l'état de la connexion
$tableau = array("message"	 => "En attente",
				"connexion" => FALSE);

if (isset($_POST['teachLogin']) && isset($_POST['teachPwd']) && !empty($_POST['teachLogin']) && !empty($_POST['teachPwd']))
{
	// variables
	$find 		= FALSE;
	$teachLogin = $_POST['teachLogin'];
	$teachPwd 	= md5($_POST['teachPwd']);

	// si tous les champs sont remplis alors on vérifie l'existence en BDD
	$req = $dbh->prepare('SELECT * FROM login_prof WHERE login = :teachLogin AND motPasse = :teachPwd');
	$req->bindParam(':teachLogin', $teachLogin, PDO::PARAM_STR);
	$req->bindParam(':teachPwd', $teachPwd, PDO::PARAM_STR);
	$req->execute();

	// $find == 1 si une ligne correspond
	$find = $req->rowCount();

	if($find === 1) // connexion réussie
	{
		// compteur de connexion
		$dbh->exec('UPDATE compteur SET valeur=valeur+1 WHERE id_compteur=1');

		// init variable de session
		$_SESSION['teachLogin'] = $teachLogin;

		// $tableau sert de réponse à l'appel ajax
		$tableau["message"]	  	= "Connexion en cours";
		$tableau["connexion"]	= TRUE;
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
	$tableau["message"]	  = "Indiquer login et mot de passe";
	$tableau["connexion"] = FALSE;
}

echo json_encode($tableau);
