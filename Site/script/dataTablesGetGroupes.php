<?php

/*
 * Constituer une liste de filière en JSON
 *
 *
 * [Sécuriser cette page, limiter l'accès...]
 *
 */

include( "../config/config.php" );

$deleteValue = 0;

if (isset($_GET["search"]["value"]) && $_GET["search"]["value"] != '') {
    // si on fait une recherche précise

    $req_listeGrp = $dbh->prepare($sql);
    $req_listeGrp = $dbh->prepare("SELECT codeGroupe, nom, alias
                                    FROM $dernierebase.ressources_groupes
                                    WHERE deleted=:delete
                                    AND (
                                        nom LIKE :nom
                                        OR alias LIKE :alias
                                    )"
    );

    $req_listeGrp->execute(
        array(
            ':delete' => $deleteValue,
            ':nom'    => '%' . $_GET["search"]["value"] . '%',
            ':alias'  => '%' . $_GET["search"]["value"] . '%'
        )
    );

} else {
    // recherche non-précise

    $req_listeGrp = $dbh->prepare("SELECT codeGroupe, nom, alias FROM $dernierebase.ressources_groupes WHERE deleted=:delete");
    $req_listeGrp->execute(
        array(
            ':delete' => $deleteValue
        )
    );
}

$res_listeGrp = $req_listeGrp->fetchAll();
$data  = array("data" => $res_listeGrp);
echo json_encode($data);
