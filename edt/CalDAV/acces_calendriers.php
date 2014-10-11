<?php

session_start();
error_reporting(E_ALL);

include_once('../config.php');

/*
 * PARAMETRAGE ENVIRONNEMENT DE TEST
 */
if( !isset($_SESSION['logged_prof_perso']) || empty($_SESSION['logged_prof_perso'])) {
    // si non-prof alors on redirige l'utilisateur
    header("Location: /");
}

$urlEdt = "http://localhost/~indydedeken/edt";
$urlEdt = "http://compri.me/edt";

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
        <li><a href="#">Déconnexion</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<main>

    <!-- Form - Download EdT form -->
    <form method="post" action="/~indydedeken/ProjetRD/front/gestion_edt.php" class="demo-list">

        <!-- Table - Genered by DataTables plugin -->
        <table class="table table-striped">
            <thead>
            <tr>
                <th><span class="glyphicon glyphicon-th-list"></span></th>
                <th>Enseignant</th>
                <th><span class="glyphicon glyphicon-download"></span></th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-th="Sélection"></td>
                    <td data-th="Enseignant"></td>
                    <td data-th=""></td>
                <tr>
            </tbody>
        </table>
        <!-- ./table -->

        <!-- div - Download all the selected EdT -->
        <div class="center">
            <button type="submit" class="btn btn-primary btn-lg btn-block">Télécharger les agendas sélectionnés</button>
        </div>
        <!-- ./div -->

        <!-- DataTables plugin -->
        <script>
            $(document).ready(function(){
                /* Get data to feed DataTables */
                var data = [
                    <?php

                    $deleteValue  = 0;
                    $data         = array(':deleteValue'=>$deleteValue);

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
                $('table').dataTable({
                      "data"        : data,
                      "bSort"       : false,
                      "bSortable"   : false,
                      "lengthMenu"  : [200],
                      "language"    : {
                        "zeroRecords" : "Aucun enseignant",
                        "search"      : "Rechercher un enseignant _INPUT_"
                      }
                });

                /* Download EdT one by one */
                $( "table a" ).on('click', function( event ) {

                    event.preventDefault();

                    var idprof = $(this).data( "idprof" );
                    var nom    = $(this).data( "nom" );
                    var prenom = $(this).data( "prenom" );

                    var request = $.ajax({
                        url: "<?php echo $urlEdt; ?>/icsprof/icsprof.php",
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
                            .attr('href', "<?php echo $urlEdt; ?>/icsprof/" + nom.toLowerCase() + "_" + prenom.toLowerCase() + ".ics");

                        window.open($( "#lien_" + idprof).attr( 'href' ));

                    })
                    .fail(function( data ) {
                        alert( "La requête a échouée : " + textStatus );
                    });

                });
            });
        </script>
        <!-- ./DataTables plugin -->

        <!-- iCheck plugin -->
        <script>
            $(document).ready(function(){
                var callbacks_list = $('.demo-callbacks ul');
                $('.demo-list input').on('click ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event){
                    callbacks_list.prepend('<li><span>#' + this.id + '</span> is ' + event.type.replace('if', '').toLowerCase() + '</li>');
                }).iCheck({
                    checkboxClass: 'icheckbox_flat-blue',
                    radioClass: 'iradio_flat-blue',
                    increaseArea: '40%'
                });
            });
        </script>
        <!-- ./iCheck plugin -->

    </form>
    <!-- ./form -->
</main>
</body>
</html>
