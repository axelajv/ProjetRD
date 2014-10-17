<?php
session_start();
//error_reporting(E_ALL);

include_once('../config.php');
include_once('env_radicale_prod.php');

/*
 * PARAMETRAGE ENVIRONNEMENT DE TEST
 */

/*
 * SCRIPT PIERRICK
 * if( isset($_SESSION['teachLogin']) ) {
    // si non-prof alors on redirige l'utilisateur
    header("Location: /");
}*/

/*
 * FIN PARAMETRAGE ENVIRONNEMENT DE TEST
 */
?>

<!doctype html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="GIK - Interface de gestion des calendriers">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion Interne des Calendriers</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/touch/favicon.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Web Starter Kit">
    <link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon-precomposed.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/favicon.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <!-- Page styles -->
    <link rel="stylesheet" href="lib/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="styles/specifiques.css">
    <link rel="stylesheet" href="lib/iCheck/skins/flat/blue.css">
    <link rel="stylesheet" href="lib/DataTables/media/css/jquery.dataTables.css">

    <!-- SCRIPTS JS -->
    <script src="lib/jquery/dist/jquery.js"></script>
    <script src="lib/bootstrap/dist/js/bootstrap.js"></script>
    <script src="lib/iCheck/icheck.js"></script>
    <script src="lib/DataTables/media/js/jquery.dataTables.js"></script>
</head>

<body>
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-calendar"></span> VT Calendar</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> nom prenom <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Outils</a></li>
                        <li><a href="#">Modules</a></li>
                        <li><a href="#">Droits</a></li>
                        <li><a href="#">Heures</a></li>
                        <li><a href="#">Export PDF</a></li>
                        <li><a href="#">Flux RSS</a></li>
                        <li><a href="#">Config</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <!-- SCRIPT PIERRICK -->
                <li><a href="<?php echo URL_APPLICATION; ?>/script/disconnectScript.php">Déconnexion</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<main>

    <!-- div - btn-group -->
    <div class="btn-group btn-group-justified">
        <a id="form-enseignant" role="button" class="btn btn-default active">Enseignants</a>
        <a id="form-groupe" role="button" class="btn btn-default">Filières</a>
        <a id="form-salle" role="button" class="btn btn-default">Salles</a>
    </div>
    <!-- ./div - btn-group -->

    <!-- form - form-enseignant -->
    <form method="post" action="#" class="form-enseignant">
        <!-- Table-enseigant - Generate by DataTables plugin -->
        <table class="table table-striped table-enseignant">
            <thead>
            <tr>
                <th><span class="glyphicon glyphicon-th-list"></span></th>
                <th class="libelle">Enseignant <span id="plusEnseignant" class="glyphicon glyphicon-chevron-down"></span></th>
                <th><span class="glyphicon glyphicon-download"></span></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td data-th="Sélection"></td>
                <td data-th="Enseignant"></td>
                <td data-th=""></td>
            </tr>
            </tbody>
        </table>
        <!-- ./table -->

        <!-- div - Download all the selected EdT -->
        <div class="button-enseignant center">
            <button type="submit" class="btn btn-primary btn-lg">Enseignants sélectionnés</button>
        </div>
        <!-- ./div -->
    </form>
    <!-- ./form - form-enseignant -->

    <!-- form - form-group -->
    <form method="post" action="#" class="form-groupe">
        <!-- Table-groupe - Generate by DataTables plugin -->
        <table class="table table-striped table-groupe">
            <thead>
            <tr>
                <th><span class="glyphicon glyphicon-th-list"></span></th>
                <th class="libelle">Groupe <span id="plusGroupe" class="glyphicon glyphicon-chevron-down"></span></th>
                <th><span class="glyphicon glyphicon-download"></span></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td data-th="Sélection"></td>
                <td data-th="Groupe"></td>
                <td data-th=""></td>
            <tr>
            </tbody>
        </table>
        <!-- ./table -->

        <!-- div - Download all the selected EdT -->
        <div class="button-groupe center">
            <button type="submit" class="btn btn-primary btn-lg">Filières sélectionnés</button>
        </div>
        <!-- ./div -->
    </form>
    <!-- ./form - form-groupe -->

        <!-- DataTables plugin -->
        <script>
            $(document).ready(function() {
                /* Get data from ENSEIGNANT to feed DataTables */
                var dataEnseigant = [
                    <?php
                    $deleteValue = 0;
                    $data        = array(':deleteValue'=>$deleteValue);

                    $sql           = "SELECT codeProf, nom, prenom FROM $dernierebase.ressources_profs WHERE deleted=:deleteValue;";
                    $req_listeProf = $dbh->prepare($sql);
                    $req_listeProf->execute($data);
                    $res_listeProf = $req_listeProf->fetchAll();

                    foreach($res_listeProf as $prof) {
                    ?>
                        [
                            '<input id="box_<?php echo $prof[0]; ?>" type="checkbox" name="<?php echo $prof[0]; ?>">',
                            '<?php echo $prof[1] . " " . $prof[2]; ?>',
                            '<a id="lien_<?php echo $prof[0]; ?>" class="btn btn-default" data-idprof="<?php echo $prof[0]; ?>" data-nom="<?php echo $prof[1]; ?>" data-prenom="<?php echo $prof[2]; ?>"><span class="glyphicon glyphicon-save"></span></a>'
                        ],
                    <?php
                    }
                    ?>
                ]

                /* Param DataTables plugin */
                $('table.table-enseignant').dataTable({
                    "data"        : dataEnseigant,
                    "bSort"       : false,
                    "bSortable"   : false,
                    "lengthMenu"  : [200],
                    "language"    : {
                        "zeroRecords" : "Aucun enseignant",
                        "search"      : "Rechercher un enseignant _INPUT_"
                    }
                });

                /* Download ENSEIGNANT-EdT one by one */
                $( 'table.table-enseignant a' ).on('click', function( event ) {
                    event.preventDefault();

                    var idprof = $(this).data( "idprof" );
                    var nom    = $(this).data( "nom" );
                    var prenom = $(this).data( "prenom" );

                    var request = $.ajax({
                        url: "<?php echo URL_APPLICATION; ?>/icsprof/icsprof.php",
                        type: "POST",
                        data: {
                            idprof : idprof,
                            nom    : nom,
                            prenom : prenom
                        }
                    })
                        .done(function( data ) {
                            $( "#lien_" + idprof)
                                .removeClass('btn-default')
                                .html( '<span class="glyphicon glyphicon-ok"></span>' )
                                .addClass('btn-success')
                                .attr('href', "<?php echo URL_RADICALE; ?>/Enseignants/" + nom.toLowerCase() + "_" + prenom.toLowerCase() + ".ics/");
                            window.open($( "#lien_" + idprof).attr( 'href' ));
                        }
                    )
                        .fail(function( data ) {
                            $( "#lien_" + idprof)
                                .removeClass('btn-default')
                                .html( '<span class="glyphicon glyphicon-repeat"></span>' )
                                .addClass('btn-danger');
                            alert( "La requête a échoué : " + textStatus );
                        }
                    );
                });

                /* Get data from GROUPE/FILIERE to feed DataTables */
                var dataGroupe = [
                    <?php
                    $deleteValue = 0;
                    $data        = array(':deleteValue'=>$deleteValue);

                    $sql          = "SELECT codeGroupe, nom, alias FROM $dernierebase.ressources_groupes WHERE deleted=:deleteValue;";
                    $req_listeGrp = $dbh->prepare($sql);
                    $req_listeGrp->execute($data);
                    $res_listeGrp = $req_listeGrp->fetchAll();

                    foreach($res_listeGrp as $grp) {
                    ?>
                    [
                        '<input id="box_<?php echo $grp[0]; ?>" type="checkbox" name="<?php echo $grp[0]; ?>">',
                        '<?php echo ((empty($grp[2])) ? $grp[1] : $grp[2]); ?>',
                        '<a id="lien_<?php echo $grp[0]; ?>" class="btn btn-default" data-idgrp="<?php echo $grp[0]; ?>" data-nomgrp="<?php echo $grp[1]; ?>"><span class="glyphicon glyphicon-save"></span></a>'
                    ],
                    <?php
                    }
                    ?>
                ]

                /* Param DataTables plugin */
                $('table.table-groupe').dataTable({
                    "data"        : dataGroupe,
                    "bSort"       : false,
                    "bSortable"   : false,
                    "lengthMenu"  : [200],
                    "language"    : {
                        "zeroRecords" : "Aucune filière",
                        "search"      : "Rechercher une filière _INPUT_"
                    }
                });

                /* Download GROUPE-EdT one by one */
                $( 'table.table-groupe a' ).on('click', function( event ) {

                    event.preventDefault();

                    var idgrp  = $(this).data( "idgrp" );
                    var nomgrp = $(this).data( "nomgrp" );

                    var request = $.ajax({
                        url: "<?php echo URL_APPLICATION; ?>/icsetudiant/icsgroupe.php",
                        type: "POST",
                        data: {
                            idgrp  : idgrp,
                            nomgrp : nomgrp
                        }
                    })
                        .done(function( data ) {

                            $( "#lien_" + idgrp)
                                .removeClass('btn-default')
                                .html( '<span class="glyphicon glyphicon-ok"></span>' )
                                .addClass('btn-success')
                                .attr('href', "<?php echo URL_RADICALE; ?>/Etudiants/" + nomgrp.toLowerCase() + ".ics/");

                            window.open($( "#lien_" + idgrp).attr( 'href' ));
                        }
                    )
                        .fail(function( data ) {
                            $( "#lien_" + idgrp)
                                .removeClass('btn-default')
                                .html( '<span class="glyphicon glyphicon-repeat"></span>' )
                                .addClass('btn-danger');
                            alert( "La requête a échoué : " + textStatus );
                        }
                    );
                });
            });
        </script>
        <!-- ./DataTables plugin -->

        <!-- iCheck plugin -->
        <script>
            $(document).ready(function(){
                var callbacks_list = $('.demo-callbacks ul');
                $('form input').on('click ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event){
                    callbacks_list.prepend('<li><span>#' + this.id + '</span> is ' + event.type.replace('if', '').toLowerCase() + '</li>');
                }).iCheck({
                    checkboxClass : 'icheckbox_flat-blue',
                    radioClass    : 'iradio_flat-blue',
                    increaseArea  : '40%'
                });
            });
        </script>
        <!-- ./iCheck plugin -->

        <!-- Manual scripts -->
        <script>
            $(document).ready(function() {

                /*
                 * Dropdown effect on Enseignant-list
                 */
                $('.table-enseignant th').click(function (e) {
                    $('#DataTables_Table_0 tbody, .downloadEnseigant').slideToggle("fast");

                    /* recoder proprement */
                    var monIcone = $('#plusEnseignant');
                    var change = monIcone.hasClass('glyphicon-chevron-down');
                    if (change) {
                        monIcone.removeClass('glyphicon-chevron-down')
                            .addClass('glyphicon-chevron-up');
                        $('.button-enseignant').hide('fast');
                        $('#DataTables_Table_0_filter').slideUp();
                    } else {
                        monIcone.removeClass('glyphicon-chevron-up')
                            .addClass('glyphicon-chevron-down');
                        $('.button-enseignant').show('fast');
                        $('#DataTables_Table_0_filter').slideDown();
                    }

                });

                /*
                 * Dropdown effect on Groupe-list (filière)
                 */
                $('.table-groupe th').click(function (e) {
                    $('#DataTables_Table_1 tbody, .downloadGroupe').slideToggle("fast");

                    /* recoder proprement */
                    var monIcone = $('#plusGroupe');
                    var change = monIcone.hasClass('glyphicon-chevron-down');
                    if (change) {
                        monIcone.removeClass('glyphicon-chevron-down')
                            .addClass('glyphicon-chevron-up');
                        $('.button-groupe').hide('fast');
                        $('#DataTables_Table_1_filter').slideUp();

                    } else {
                        monIcone.removeClass('glyphicon-chevron-up')
                            .addClass('glyphicon-chevron-down');
                        $('.button-groupe').show('fast');
                        $('#DataTables_Table_1_filter').slideDown();
                    }
                });

                /*
                 * Button - choose a category (Enseignant, Filière, Salle)
                 */
                $('#form-enseignant').click(function(){
                    $('.form-groupe, .form-salle').hide('fast');
                    $('.form-enseignant').show('fast');
                    $('#form-groupe, #form-salle').removeClass('active');
                    $(this).addClass('active');
                });
                $('#form-groupe').click(function(){
                    $('.form-enseignant, .form-salle').hide('fast');
                    $('.form-groupe').show('fast');

                    $('#form-salle, #form-enseignant').removeClass('active');
                    $(this).addClass('active');
                });
                $('#form-salle').click(function(){
                    $('.form-enseignant, .form-groupe').hide('fast');
                    $('.form-salle').show('fast');
                    $('#form-enseignant, #form-groupe').removeClass('active');
                    $(this).addClass('active');
                });

                // par défault, on affiche uniquement le form-enseignant
                $('.form-groupe, .form-salle').hide('fast');
            });
        </script>
        <!-- ./Manual scripts -->

    </form>
    <!-- ./form -->
</main>
</body>
</html>
