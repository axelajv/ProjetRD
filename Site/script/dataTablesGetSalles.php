<?php

/*
 * Constituer une liste de salles en JSON
 *
 *
 * [Sécuriser cette page, limiter l'accès...]
 *
 */

include( "../config/config.php" );

$deleteValue = 0;

if (isset($_GET["search"]["value"]) && $_GET["search"]["value"] != '') {
    // si on fait une recherche précise

    $req_listeSalle = $dbh->prepare($sql);
    $req_listeSalle = $dbh->prepare("SELECT codeSalle, nom, alias
                                    FROM $dernierebase.ressources_salles
                                    WHERE deleted=:delete
                                    AND (
                                        nom LIKE :nom
                                        OR alias LIKE :alias
                                    )"
    );

    $req_listeSalle->execute(
        array(
            ':delete' => $deleteValue,
            ':nom'    => '%' . $_GET["search"]["value"] . '%',
            ':alias'  => '%' . $_GET["search"]["value"] . '%'
        )
    );

} else {
    // recherche non-précise

    $req_listeSalle = $dbh->prepare("SELECT codeSalle, nom, alias FROM $dernierebase.ressources_salles WHERE deleted=:delete");
    $req_listeSalle->execute(
        array(
            ':delete' => $deleteValue
        )
    );
}

$res_listeSalle = $req_listeSalle->fetchAll();
$data  = array("data" => $res_listeSalle);
echo json_encode($data);
