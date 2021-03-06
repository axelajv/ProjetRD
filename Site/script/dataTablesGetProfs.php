<?php

/*
 * Constituer une liste d'enseignants en JSON
 *
 *
 * [Sécuriser cette page, limiter l'accès...]
 *
 */

include( "../config/config.php" );

$deleteValue = 0;

if (isset($_GET["search"]["value"]) && $_GET["search"]["value"] != '') {
    // si on fait une recherche précise

    $req_listeProf = $dbh->prepare("SELECT codeProf, nom, prenom
                                    FROM $dernierebase.ressources_profs
                                    WHERE deleted=:delete
                                    AND (
                                        nom LIKE :nom
                                        OR prenom LIKE :prenom
                                    )"
    );

    $req_listeProf->execute(
        array(
            ':delete' => $deleteValue,
            ':nom'    => '%' . $_GET["search"]["value"] . '%',
            ':prenom' => '%' . $_GET["search"]["value"] . '%'
        )
    );

} else {
    // recherche non-précise

    $req_listeProf = $dbh->prepare("SELECT codeProf, nom, prenom FROM $dernierebase.ressources_profs WHERE deleted=:delete");
    $req_listeProf->execute(
        array(
            ':delete' => $deleteValue
        )
    );
}

$res_listeProf = $req_listeProf->fetchAll();
$data  = array("data" => $res_listeProf);
echo json_encode($data);
