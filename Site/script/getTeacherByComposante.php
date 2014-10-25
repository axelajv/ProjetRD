<?php

	session_start();
	include('../config/config.php');
	$teachers = array();

	if (isset($_POST['code']))
	{
		if ($_POST['code'] == "")
		{
			// 'TOUS' EST SELECTIONNE
			$annee = $annee_scolaire[0];
			include('getAllTeacherInfos.php');
			foreach ($allTeachers as $teacher)
			{
				array_push($teachers, implode('#', $teacher));
			}
		}
		else
		{
			$sql="SELECT * FROM ressources_profs WHERE deleted='0' and codeComposante=".$_POST['code']."  ORDER BY nom,prenom";
			$req_prof=$dbh->prepare($sql);
			$req_prof->execute();
			while($ligne = $req_prof->fetch())
			{
				array_push($teachers, implode('#', array($ligne['codeProf'], $ligne['prenom'], $ligne['nom'])));
			}
		}
		echo implode('~', $teachers);
	}

?>