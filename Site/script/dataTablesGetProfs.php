<?php

/*
 * Constituer une liste d'enseignants en JSON
 */

include( "../config/config.php" );

    /*
     *
     * Sécuriser cette page, limiter l'accès...
     *
     **/


    // si on fait une recherche précise
    if (isset($_GET["search"]["value"]) && $_GET["search"]["value"] != '') {
        // construction de la clause where
        $whereClause = "AND ";
        $whereClause .= "(nom LIKE '%" . $_GET["search"]["value"] . "%' ";
        $whereClause .= "OR prenom LIKE '%" . $_GET["search"]["value"] . "%' ";
        $whereClause .= ")";
    } else {
        // cas où GET est vide/null
        $whereClause = "";
    }

    $deleteValue = 0;
    $data        = array(':deleteValue'=>$deleteValue);

    $sql           = "SELECT codeProf, nom, prenom FROM $dernierebase.ressources_profs WHERE deleted=:deleteValue $whereClause ";
    $req_listeProf = $dbh->prepare($sql);
    $req_listeProf->execute($data);
    $res_listeProf = $req_listeProf->fetchAll();

    $data  = array("data" => $res_listeProf);

    echo json_encode($data);
