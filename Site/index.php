<?php

session_start();

require('API/Smarty/Smarty.class.php'); // On inclut la classe Smarty

$smarty = new Smarty();

include('config/config.php');
					
//compteur de pages vues
$sql="SELECT valeur FROM compteur WHERE id_compteur='1'";
$compteur_req=$dbh->query($sql);
$compteur_res=$compteur_req->fetchAll();
$compteur=$compteur_res['0']['valeur'];
$smarty->assign("compteur", $compteur);

$smarty->assign("annees", $annee_scolaire);

/* l'utilisateur est connecté */
if (isset($_SESSION['studyLogin']) || isset($_SESSION['teachLogin']) || !empty($_COOKIE['teachLogin']) || !empty($_COOKIE['studyLogin']))
{
	/* l'utilisateur connecté est un étudiant */
	if (isset($_SESSION['studyLogin']) || !empty($_COOKIE['studyLogin']))
	{
		include('script/getStudyInfos.php');
		$smarty->assign("loginStudy",$loginUtilisateur);
		$smarty->assign("userName",$userName);
		
	}
	else
	{
		/* l'utilisateur connecté est un enseignant */
		include('script/getTeachInfos.php');
		$smarty->assign("teachLogin",$loginUtilisateur);
		$smarty->assign("firstName",$firstName);
		$smarty->assign("userName",$userName);
		
		include('script/getDroits.php');
		$smarty->assign("droits", $droits);
	}
	
	if (isset($_GET['page']))
	{
		// NAVIGATION ETUDIANT
		if (isset($_SESSION['studyLogin']) || !empty($_COOKIE['studyLogin']))
		{
			if ($_GET['page'] == "deconnection")
			{
				include('script/disconnect.php');
				$smarty->assign("successMsg", "Déconnection reussie");
				$smarty->display("template/login.tpl");
			}
			else if ($_GET['page'] == "module")
			{
				include('script/getStudyModule.php');
				$smarty->assign("liste_enseignement", $liste_enseignement);
				$smarty->display("template/modules.tpl");
			}
			else if ($_GET['page' ] == "export")
			{
				include('script/getAllFormation.php');
				$smarty->assign("formations", $formations);
				$smarty->display("template/export.tpl");
			}
			else if ($_GET['page'] == "RSS")
			{
				header('Location: http://ufrsitec.u-paris10.fr/edtpst/RSSetudiant/rss.php?codeEtudiant='.$userCode);
			}
			else if ($_GET['page'] == "mesDS")
			{
				include('script/getDS.php');
				$smarty->assign("mesDS", $mesDS);
				$smarty->display("template/mesDS.tpl");
			}
			else if ($_GET['page'] == "version")
			{
				$smarty->display("template/versions.tpl");
			}
			else if ($_GET['page'] == "agendas_ics")
			{
				$smarty->display("template/agendas_ics.tpl");
				//$smarty->display('');
			}
			else
			{
				$smarty->display("template/index.tpl");
			}
		}
		else
		{
			// NAVIGATION ENSEIGNANT
			if ($_GET['page'] == "deconnection")
			{
				include('script/disconnect.php');
				$smarty->assign("successMsg", "Déconnection reussie");
				$smarty->display("template/login.tpl");
			}
			else if ($_GET['page'] == "module")
			{
				include('script/getComposantes.php');
				$smarty->assign("composantes", $composantes);
				include('script/getTeachModule.php');
				$smarty->assign("liste_enseignement", $liste_enseignement);
				include('script/getAllTeacherInfos.php');
				$smarty->assign("profs", $allTeachers);
				$smarty->display("template/modules.tpl");
			}
			else if ($_GET['page' ] == "heure")
			{
				include('script/getComposantes.php');
				$smarty->assign("composantes", $composantes);
				include('script/getComputerScienceTeachers.php');
				$smarty->assign("allCSTeachers", $allCSTeachers);
				$smarty->assign("code", $code);
				include('script/getTeachersHours.php');
				$smarty->assign("allSeances", $allSeances);
				
				
				$smarty->display("template/heures.tpl");
			}
			else if ($_GET['page' ] == "export" && ($droits['pdf'] == 1 || $droits['giseh'] == 1))
			{
				include('script/getAllFormation.php');
				$smarty->assign("formations", $formations);
				$smarty->display("template/export.tpl");
			}
			else if ($_GET['page'] == "config")
			{
				include('script/getUserConfig.php');
				$smarty->assign("userConfs", $userConfs);
				$smarty->display("template/maConfig.tpl");
			}
			else if ($_GET['page'] == "RSS")
			{
				header('Location: http://ufrsitec.u-paris10.fr/edtpst/RSS/rss.php?codeProf='.$userCode);
			}
			else if ($_GET['page'] == "droits")
			{
				$smarty->display("template/droits.tpl");
			}
			else if ($_GET['page'] == "dialogue" && $droits['dialogue'] == 1)
			{
				include('script/getComposantes.php');
				include('script/computeDialogueGestion.php');
				$smarty->assign("composantes", $composantesComplet);
				
				$smarty->display("template/dialogueGestion.tpl");
			}
			else if ($_GET['page'] == "admin" && $droits['admin'] == 1)
			{
				include('script/getAllTeacherInfos.php');
				$smarty->assign("allTeachers", $allTeachers);
				
				$smarty->display("template/admin.tpl");
			}
			else if ($_GET['page'] == "version")
			{
				$smarty->display("template/versions.tpl");
			}
			else if ($_GET['page'] == "agendas_ics")
			{
				$smarty->display("template/agendas_ics.tpl");
				//$smarty->display('');
			}
			else
			{
				$smarty->display("template/index.tpl");
			}
		}
	}
	else
	{
		$smarty->display("template/index.tpl");
	}
}
/* l'utilisateur n'est pas connecté */
else
{
	if (isset($_GET['page']) && $_GET['page'] == "version")
	{
		$smarty->display("template/versions.tpl");
	}
	else
	{
		if (isset($_GET['errorID']) && !empty($_GET['errorID']))
		{	
			$msg = "";
			if($_GET['errorID'] == 1)
			{
				$msg = "Vous n'avez pas saisi toutes les informations";
			}
			elseif ($_GET['errorID'] == 2)
			{
				$msg = "L'utilisateur saisi n'existe pas";
			}
			elseif ($_GET['errorID'] == 3)
			{
				$msg = "La modification de mot de passe a echoué. Les variables saisies ne sont pas correctes";
			}
			
			$smarty->assign("errorMsg", $msg);
		}
		else if (isset($_GET['successId']) && !empty($_GET['successId']))
		{
			$msg = "";
			if($_GET['successId'] == 1)
			{
				$msg = "Votre mot de passe a été modifié";
			}
			$smarty->assign("successMsg", $msg);
		}

		$smarty->display("template/login.tpl");
	}
}
?>