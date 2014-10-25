<?php
/*
*
* Avec connection a la bdd
*
*/
session_start();
include('../config/config.php');

$start = $_REQUEST['from'] / 1000;
$end   = $_REQUEST['to'] / 1000;
/*
//préparation des requetes

		$sql="SELECT * FROM seances 
		left join (seances_profs) on (seances.codeSeance=seances_profs.codeSeance ) 
		left join (enseignements) on (seances.codeEnseignement=enseignements.codeEnseignement) 
		right join (matieres) on (matieres.codeMatiere=enseignements.codeMatiere)
                left join login_prof lp on lp.codeprof = enseignements.codeProprietaire
		where lp.codeProf = '".$_SESSION['teachLogin']."'
		AND seances_profs.deleted='0'
		AND seances.deleted='0' 
		and matieres.deleted='0' 
		and enseignements.deleted='0' 
		AND seances.annulee='0'  
		";
	*/
/*
	$req_seances_prof=$dbh->prepare($sql);
	
	//requete pour avoir les groupes associés aux séances	
	$sql="SELECT * FROM seances_groupes where codeSeance=:code_seance_prof  and deleted= '0'";
	$req_seances_groupe=$dbh->prepare($sql);
	
	//requete pour avoir le nom des groupes associés aux séances	
	$sql="SELECT * FROM ressources_groupes where codeGroupe=:codeGroupe AND deleted= '0'";
	$req_noms_groupe=$dbh->prepare($sql);
	
	// requete pour avoir info sur la séance (date durée...)
	$sql="SELECT * FROM seances where codeSeance=:codeSeance AND deleted= '0'";
	$req_seances=$dbh->prepare($sql);
	
	// requete pour avoir info sur les enseignements
	$sql="SELECT * FROM enseignements where codeEnseignement=:codeEnseignement AND deleted= '0'";
	$req_enseignements=$dbh->prepare($sql);
	
	//requete pour comptere le nb de prof associé à la séance
	$sql="SELECT * FROM seances_profs where seances_profs.deleted='0' and seances_profs.codeSeance=:codeSeance  ";
	$req_nb_prof=$dbh->prepare($sql);
	
	//requete pour comptere le nb de seances associé à l'enseignement
	$sql="SELECT * FROM seances left join seances_profs on seances.codeSeance=seances_profs.codeSeance where seances.deleted='0' and seances_profs.deleted='0' and seances_profs.codeRessource=:codeProf and seances.codeEnseignement=:codeEnseignement  ";
	$req_nb_seances=$dbh->prepare($sql);
	
	//requete pour avoir la liste des enseignements forfaitaires
	$sql="SELECT * FROM enseignements left join (enseignements_profs) on (enseignements.codeEnseignement=enseignements_profs.codeEnseignement )  where enseignements_profs.codeRessource=:codeProf AND enseignements_profs.deleted='0' AND enseignements.forfaitaire='1' AND enseignements.deleted='0' order by enseignements.nom";
	$req_enseignement_forfait_pur=$dbh->prepare($sql);
	//requete pour compter le nb de profs associés à l'enseignement forfaitaire
	$sql="SELECT * FROM enseignements_profs where enseignements_profs.deleted='0' and enseignements_profs.codeEnseignement=:codeEnseignement  ";
	$req_nb_prof_enseignement_forfait_pur=$dbh->prepare($sql);
	//requete pour avoir le nom des groupes associés au forfait
	$sql="SELECT * FROM enseignements_groupes where enseignements_groupes.deleted='0' and enseignements_groupes.codeEnseignement=:codeEnseignement  ";
	$req_groupes_enseignement_forfait_pur=$dbh->prepare($sql);
	//Requete pour avoir le nom du groupe de plus haut niveau pour l'afficher dans la ligne des cumules
	$sql="SELECT * FROM hierarchies_groupes WHERE codeRessourceFille=:groupeaafficher AND deleted= '0'";
	$req_groupes_de_niveau_sup=$dbh->prepare($sql);
	//requete pour avoir la liste des séances des profs non comptabilisées
	$sql="SELECT * FROM seances_profs_non_comptabilisees WHERE codeSeance=:codeSeance AND deleted= '0'";
	$req_seance_non_comptabilisee=$dbh->prepare($sql);	

	
	

	
		
	
//requete pour avoir la liste des séances des profs
$req_seances_prof->execute(array(':codeProf'=>$codeProf));
$res_seances_prof=$req_seances_prof->fetchAll();

//memorisation du code de la matière pour afficher le sous total des heures lors du changmeent de matiere
$memoire_code_matiere="";
//memorisation du code apogee pour afficher le sous total des heures lors du changmeent de code apogee
$memoire_code_apogee="";
//variable pour savoir si on est en train de traiter la toute première seance ou pas.
$premiere_seance='1';
//initialisation compteur nb heure dans un EC (module)
$total_heure_cr_module='';
$total_min_cr_module='';
$total_heure_td_module='';
$total_min_td_module='';
$total_heure_tp_module='';
$total_min_tp_module='';
$total_heure_forfait_module='';
$total_min_forfait_module='';
$total_heure_eqtd_module='';
$total_min_eqtd_module='';

*/

//requete pour avoir la liste des séances des profs
	/*$sql="SELECT * FROM seances 
		left join (seances_profs) on (seances.codeSeance=seances_profs.codeSeance ) 
		left join (enseignements) on (seances.codeEnseignement=enseignements.codeEnseignement) 
		right join (matieres) on (matieres.codeMatiere=enseignements.codeMatiere) 
		where seances_profs.codeRessource=:codeProf 
		AND seances_profs.deleted='0' 
		AND seances.deleted='0' 
		and matieres.deleted='0' 
		and enseignements.deleted='0' 
		AND seances.annulee='0'  
		order by matieres.nom,seances.dateSeance,seances.heureSeance";
	
*/
//$loginUtilisateur = "";
	
	/*if (isset($_SESSION['teachLogin']))
	{
		$loginUtilisateur = $_SESSION['teachLogin'];
                echo $loginUtilisateur;
	}
	else
	{
		$loginUtilisateur = $_COOKIE['teachLogin'];
                echo $loginUtilisateur;
	}*/

	/*$userName= "";
	$firstName= "";

	// on récupere le codeProf reliés au login de l'enseignant
	$sql = "SELECT * FROM login_prof WHERE login= ".$dbh->quote($loginUtilisateur, PDO::PARAM_STR);   
	$req = $dbh->prepare($sql);
	$req->execute();
	$codeProf = 0;
		  
	// Si oui, on continue le script...      
	while($ligneCode = $req->fetch())
	{
		$codeProf = $ligneCode['codeProf'];
	}
	$req->closeCursor();*/
   
  /*
 $sql="SELECT nom, prenom from seances_profs left join ressources_profs on (seances_profs.codeRessource=ressources_profs.codeProf) WHERE seances_profs.codeSeance=".$code_seance." and seances_profs.deleted='0' and ressources_profs.deleted='0' order by ressources_profs.nom"; 
			$req5=$dbh->prepare($sql);
			$req5->execute();
			$premierProf = TRUE;
			
			while($res_5 = $req5->fetch())
			{
				$prenom=ucwords(strtolower($res_5['prenom'])) ;
				if($premierProf == FALSE)
				{
					$nom_prof .= " - ";
				}
				$nom_prof .= $prenom." ".$res_5['nom'];
				$premierProf = FALSE;
			}
			$req5->closeCursor();  
   
   
   */
   
  /* 
$sql="SELECT * FROM seances 
		left join (seances_profs) on (seances.codeSeance=seances_profs.codeSeance ) 
		left join (enseignements) on (seances.codeEnseignement=enseignements.codeEnseignement) 
		right join (matieres) on (matieres.codeMatiere=enseignements.codeMatiere)
                left join login_prof lp on lp.codeprof = enseignements.codeProprietaire
		where lp.codeProf = ".$teachLogin."
		AND seances_profs.deleted='0'
		AND seances.deleted='0' 
		and matieres.deleted='0' 
		and enseignements.deleted='0' 
		AND seances.annulee='0'  
";
*/
 
    $loginUtilisateur = "";
           
        if (isset($_SESSION['teachLogin']))
        {
            $loginUtilisateur = $_SESSION['teachLogin'];
        }
        else
        {
            $loginUtilisateur = $_COOKIE['teachLogin'];
        }


$out = array();
        //sylvie
        //sbourli1
        // on récupere le codeProf reliés au login de l'enseignant
        //$sql = "SELECT * FROM login_prof WHERE login= ".$dbh->quote($loginUtilisateur, PDO::PARAM_STR);
        $sql=sprintf('SELECT seances.dateSeance, seances.heureSeance, seances.dureeSeance,
        enseignements.nom, enseignements.dureeSeance, enseignements.couleurFond,
        enseignements.alias, enseignements.codeTypeSalle,
        matieres.couleurFond, matieres.nom, login_prof.login
                FROM seances
                LEFT JOIN seances_profs ON seances.codeSeance = seances_profs.codeSeance
                LEFT JOIN enseignements ON seances.codeEnseignement = enseignements.codeEnseignement
                RIGHT JOIN matieres ON matieres.codeMatiere = enseignements.codeMatiere
                LEFT JOIN login_prof ON login_prof.codeprof = seances_profs.codeRessource
                WHERE seances_profs.deleted =  "0"
                AND seances.deleted =  "0"
                AND matieres.deleted =  "0"
                AND matieres.deleted =  "0"
                AND seances.annulee =  "0"
                AND login_prof.login = '.$dbh->quote($loginUtilisateur, PDO::PARAM_STR));
        
       /* $req = $dbh->prepare($sql);
        $req->execute(); 
        $out = array();
        
        $data = getdate();//'Y-m-d', strtotime("+14 days"));
        print_r($req);
        */
 
        
       /* if()
        {
            
        }
        else if()
        {
            
        }
        else if()
        {
            
        }
        else if()
        {
            
        }*/

//$sql   = sprintf('SELECT * from seances where dateModif='.$dbh->quote('2014-09-22 13:45:28', PDO::PARAM_STR));  //2014-09-22 13:45:28');//('SELECT * FROM events WHERE `datetime` BETWEEN %s and %s',

$req = $dbh->prepare($sql);
//print_r($req);
$req->execute();
//print_r($req);

/*

8421504      >   gray
139          >   darkred
16711808     >   
8388863      >   purple
16777215     >   white
8454143      >   teal
33023        >   
65408        >   
16711680     >  blue 
8421631      >   
255          >    red   
65280        >       lime    
4227327      >       
12615808     >          
16744576     >           
8421440      >        

*/

$out = array();

$data = getdate();//'Y-m-d', strtotime("+14 days"));

while($ligneCode = $req->fetch()) {
        //print_r($ligneCode);
        if($ligneCode['couleurFond'] = 255)
        {
            $eventC = 'event-warning';
        }
        else if($ligneCode['couleurFond'] = 16777215)
        {
            $eventC = 'event-info';
        }
        else if($ligneCode['couleurFond'] = 8388863)
        {
            $eventC = 'event-special';
        }
        else if($ligneCode['couleurFond'] = 8421504)
        {
            $eventC = 'event-sucess';
        }
        else {$eventsC = 'event-warning';}
	$out[] = array(
        'id' => $ligneCode['nom'],
        'title' => $ligneCode['nom'],
        'url' => "",
		'class' => $eventC,
		'start' => $data[0].'000',
		'end' => $data[0].'999'
    );
}
//print_r($out);
echo json_encode(array('success' => 1, 'result' => $out));
$req->closeCursor();
exit;


/*
*
* Sans connection a la bdd
*
*/
/*
$out = array();
 
 for($i=1; $i<=15; $i++){ 	//from day 01 to day 15
	$data = date('Y-m-d', strtotime("+".$i." days"));
	$out[] = array(
     	'id' => $i,
		'title' => 'Event name '.$i,
		'url' => "",
		'class' => 'event-important',
		'start' => strtotime($data).'000',
		'end' => strtotime($data).'999'
	);
}
//print_r($out);
echo json_encode(array('success' => 1, 'result' => $out));
exit;
*/
?>