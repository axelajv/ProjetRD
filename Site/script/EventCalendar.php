<?php
/*
*
* Avec connection a la bdd
*
*/
session_start();
include('../config/config.php');

/*
if (!isset($_SESSION['week'])) {
    $_SESSION['week'] = array();
}
array_push($_SESSION['week'], $_POST['weekArray']);
*/

//create object/array from json data 
//$theArray = json_decode($_POST['jsonArray']); 
//$theArray is now the array you had on the client side! 
//echo $theArray;

//$some_object = doSomething($theArray); 

//prepare the response object/array to the client 
//$response = json_encode($some_object); 
//echo $_SERVER['PHP_SELF'];
//echo $response;
/*
if(empty($_SERVER['CONTENT_TYPE'])){
 
     $type = "application/x-www-form-urlencoded";
 
     $_SERVER['CONTENT_TYPE'] = $type;
 
}

print_r($_GET);
print_r($_POST["var1"]);
*/

/*if (!isset($_SESSION['week'])) {
    $_SESSION['week'] = array();
}
if (isset($_POST['weekArray'])) {
	array_push($_SESSION['week'], $_POST['weekArray']);
}
print_r($_SESSION['week']);*/
//echo "</br>";

/*$myarray = &$_POST ; 
$var1=$myarray["var1"];
$var2=$myarray["var2"];
print_r($myarray);*/


$start = $_REQUEST['from'] / 1000;
$end   = $_REQUEST['to'] / 1000;
$loginUtilisateur = "";
     
if (isset($_SESSION['teachLogin']))
{
    $loginUtilisateur = $_SESSION['teachLogin'];
}
else if (isset($_COOKIE['teachLogin']))
{
    $loginUtilisateur = $_COOKIE['teachLogin'];
}
else if (isset($_SESSION['studyLogin'])){
    $loginUtilisateur = $_SESSION['studyLogin'];
}
else if (isset($_COOKIE['studyLogin']))
{
    $loginUtilisateur = $_SESSION['studyLogin'];
}

//$data = json_decode(stripslashes($_POST['data']));

//$we = json_decode(stripslashes($_POST['data']));
//unserialize($_POST["we"]);
//echo $_POST['data'];
/*$myArray = $_POST['weekArray'];
print_r($myArray);*/



$out = array();
//si l'utilisateur est un prof
if(($loginUtilisateur == isset($_SESSION['teachLogin'])) || ($loginUtilisateur == isset($_COOKIE['teachLogin']))) {
$sql=sprintf('SELECT seances.dateSeance, seances.heureSeance, seances.dureeSeance,
                enseignements.nom, enseignements.couleurFond,enseignements.alias,
                enseignements.codeTypeSalle, types_activites.codeTypeActivite, types_activites.alias,
                matieres.couleurFond, matieres.nom, login_prof.login
                FROM seances
                LEFT JOIN seances_profs ON seances.codeSeance = seances_profs.codeSeance
                LEFT JOIN enseignements ON seances.codeEnseignement = enseignements.codeEnseignement
                RIGHT JOIN matieres ON matieres.codeMatiere = enseignements.codeMatiere
                LEFT JOIN login_prof ON login_prof.codeprof = seances_profs.codeRessource
                INNER JOIN types_activites on enseignements.codeTypeActivite = types_activites.codeTypeActivite
                WHERE seances_profs.deleted =  "0"
                AND seances.deleted =  "0"
                AND matieres.deleted =  "0"
                AND seances.annulee =  "0"
                AND login_prof.login = '.$dbh->quote($loginUtilisateur, PDO::PARAM_STR));
 
}
//si l'utilisateur est un etudiant
else if (($loginUtilisateur == isset($_SESSION['studyLogin'])) || ($loginUtilisateur == isset($_COOKIE['studyLogin']))) {
    $sql=sprintf('SELECT distinct seances.dateSeance, seances.heureSeance, seances.dureeSeance,
                enseignements.nom, enseignements.couleurFond,enseignements.alias,
                enseignements.codeTypeSalle, types_activites.codeTypeActivite, types_activites.alias,
                matieres.couleurFond, matieres.nom
                FROM seances
                inner join seances_groupes on seances.codeSeance=seances_groupes.codeSeance
                inner join ressources_groupes on seances_groupes.codeRessource = ressources_groupes.codeGroupe
                inner join ressources_groupes_etudiants on ressources_groupes.codeGroupe = ressources_groupes_etudiants.codeGroupe
                inner join ressources_etudiants on ressources_groupes_etudiants.codeEtudiant = ressources_etudiants.codeEtudiant
                inner join enseignements ON seances.codeEnseignement = enseignements.codeEnseignement
                inner join matieres ON matieres.codeMatiere = enseignements.codeMatiere
                inner join types_activites on enseignements.codeTypeActivite = types_activites.codeTypeActivite
                WHERE seances.deleted =  "0"
                AND matieres.deleted =  "0"
                AND seances.annulee =  "0"
                AND seances_groupes.deleted = "0"
                AND ressources_groupes.deleted = "0"
                AND ressources_groupes_etudiants.deleted = "0"
                AND enseignements.deleted = "0"
                AND ressources_etudiants.deleted = "0"
                AND ressources_etudiants.nom = '.$dbh->quote($loginUtilisateur, PDO::PARAM_STR));
}
$req = $dbh->prepare($sql);
$req->execute();

$out = array();
while($ligneCode = $req->fetch()) {
    if(strlen($ligneCode['heureSeance']) > 3)
    {
        $debut = $ligneCode['dateSeance']." ".substr($ligneCode['heureSeance'],0,2).":".substr($ligneCode['heureSeance'],2,2).":00.0";
        $heureDebut = substr($ligneCode['heureSeance'],0,2).":".substr($ligneCode['heureSeance'],2,2).":00.0";
    }
    else
    {
        $debut = $ligneCode['dateSeance']." ".substr($ligneCode['heureSeance'],0,1).":".substr($ligneCode['heureSeance'],1,2).":00.0";
        $heureDebut = substr($ligneCode['heureSeance'],0,1).":".substr($ligneCode['heureSeance'],1,2).":00.0";
    }
    $heureDuree = ((int)substr($ligneCode['dureeSeance'],0,1)*60)*60+((int)substr($ligneCode['dureeSeance'],1,2)*60); //on convertie la durée en seconde
    
    $timeDebut = strtotime($debut); // on convertie la du date de debut en seconde
    $timeFin = $timeDebut + $heureDuree;

    if($ligneCode['codeTypeActivite'] == 1) //CM
    {
        $eventC = 'event-info';
    }
    else if($ligneCode['codeTypeActivite'] == 2) //TD
    {
        $eventC = 'event-warning';
    }
    else if($ligneCode['codeTypeActivite'] == 3) //TP
    {
        $eventC = 'event-success';
    }
    else if($ligneCode['codeTypeActivite'] == 4) //PRO
    {
       $eventC = 'event-simple';
    }
    else if($ligneCode['codeTypeActivite'] == 6) //STA
    {
        $eventC = 'event-info';
    }
    else if($ligneCode['codeTypeActivite'] == 7) //ADM
    {
        $eventC = 'event-special';
    }
    else if($ligneCode['codeTypeActivite'] == 8) //TUT
    {
        $eventC = 'event-inverse';
    }
    else if($ligneCode['codeTypeActivite'] == 9) //DS
    {
        $eventC = 'event-important';
    }
    else if($ligneCode['codeTypeActivite'] == 11) //TP APP
    {
        $eventC = 'event-success';
    }
       
    $out[] = array(
        'id' => $ligneCode['nom'],
        'title' =>$ligneCode['alias'] ." - ". str_replace(" ", "h",date("H i",$timeDebut)) ." - ". str_replace(" ", "h",date("H i",$timeFin)) ." ". $ligneCode['nom'],
        'url' => "",
        'class' => $eventC,
        'start' => $timeDebut*1000,
        'end' => $timeFin*1000
    );
}

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