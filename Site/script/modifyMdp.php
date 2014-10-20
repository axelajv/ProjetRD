<?php

error_reporting(E_ALL);

session_start();

include('../config/config.php');

if(isset($_POST['loginTeach']) && isset($_POST['oldMdp']) && isset($_POST['newMdp1']) && isset($_POST['newMdp2']) && !empty($_POST['loginTeach']) && !empty($_POST['oldMdp']) && !empty($_POST['newMdp1']) && !empty($_POST['newMdp2']))
{   	       		
	if ($_POST['newMdp1'] == $_POST['newMdp2'])
	{
		$login=$_POST['loginTeach'];
		$ancien_mot_passe=md5($_POST['oldMdp']);
		$nouveau_mot_passe=md5($_POST['newMdp1']);

		$sql="SELECT * FROM login_prof WHERE login=".$dbh->quote($login, PDO::PARAM_STR)." AND motPasse=".$dbh->quote($ancien_mot_passe, PDO::PARAM_STR);
		$req_login=$dbh->prepare($sql);
		$req_login->execute();
		$res_login=$req_login->fetchAll();

		if (count($res_login) > 0)
		{
			$sql="UPDATE login_prof SET motPasse=".$dbh->quote($nouveau_mot_passe, PDO::PARAM_STR)." WHERE login=".$dbh->quote($login, PDO::PARAM_STR)." AND motPasse=".$dbh->quote($ancien_mot_passe, PDO::PARAM_STR);
			$req_login_maj=$dbh->prepare($sql);
			$req_login_maj->execute();
			header('Location: ../index.php?successId=1');
			exit();
		}
		else
		{
			header('Location: ../index.php?errorID=3');
			exit();
		}
	}
	else
	{
		header('Location: ../index.php?errorID=3');
		exit();
	}
}
else
{
	header('Location: ../index.php?errorID=3');
	exit();
}
?>