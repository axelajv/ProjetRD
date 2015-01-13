<?php
include('config/config.php');

// récupération des codeProf et des prénoms des enseignants
$sql = "SELECT codeProf, prenom FROM ressources_profs";
$req = $dbh->prepare($sql);
$req->execute();

while($ligne = $req->fetch()) {

  // crypt() sur le prénom de l'enseignant
  $cryptMdp = crypt( strtolower($ligne['prenom']), base64_encode(strtolower($ligne['prenom'])) );

  // requete d'update
  $update = 'UPDATE `login_prof` SET `motPasse` = \'' . $cryptMdp . '\' WHERE `login_prof`.`codeProf` = ' . $ligne['codeProf'];

  // execution du script
  $dbh->exec($update);

  // log de la requête
  echo $update . "<br>";
}
?>
