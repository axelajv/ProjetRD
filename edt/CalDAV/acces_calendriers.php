<?php

session_start();
error_reporting(E_ALL);

include_once('../config.php');
//Connection a la bdd
mysql_connect($serveur,$user,$pass);
mysql_select_db($dernierebase);

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
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/specifiques.css">
    <link rel="stylesheet" href="lib/iCheck/skins/all.css">
    <link rel="stylesheet" href="lib/DataTables/media/css/jquery.dataTables.css">

    <!-- SCRIPTS JS -->
    <script src="lib/jquery/dist/jquery.js"></script>
    <script src="lib/iCheck/icheck.js"></script>
    <script src="lib/DataTables/media/js/jquery.dataTables.js"></script>
    <!-- ./SCRIPTS JS -->

</head>

<body>
<header class="app-bar promote-layer">
    <div class="app-bar-container">
        <button class="menu"><img src="images/hamburger.svg" alt="Menu"></button>
        <h1 class="logo">VT <strong>Agenda</strong></h1>
        <section class="app-bar-actions">
            <!-- Nom de l'utilisateur -->
            <div class="utilisateur">
                <p>RAJCHENBACH-TELLER David</p>
            </div>
            <!-- Put App Bar Buttons Here -->

            <!-- Accès à ma config -->
            <a href="javascript:submitform_ma_config2()">
                <button><i class="color--gray-background icon icon-cog"></i></button>
            </a>

            <!-- Déconnexion -->
            <a href="index.php?disconnect=true">
                <button><i class="color--red icon icon-close"></i></button>
            </a>
        </section>
    </div>
</header>

<!-- Menu bar -->
<nav id="cssmenu" class="navdrawer-container promote-layer">
    <h4>Navigation</h4>
    <ul>
        <li class="principal"><a href="#accueil" role="menuitem"><span>Accueil</span></a></li>
        <li><a href="#" role="menuitem"><span>Mes modules</span></a></li>
        <li><a href="#" role="menuitem"><span>Mes droits</span></a></li>
        <li><a href="#" role="menuitem"><span>Mes heures</span></a></li>
        <li><a href="#" role="menuitem" class="exportPDF"><span>Export PDF</span></a></li>
        <li><a href="#" role="menuitem" class="fluxRSS"><span>Flux RSS</span></a></li>
        <li><a href="#" role="menuitem"><span>Agenda</span></a></li>
    </ul>
</nav>

<!-- Formulaire de téléchargement des EdT -->
<!-- tableau généré avec DataTables -->
<main>
    <form method="post" action="/~indydedeken/ProjetRD/front/gestion_edt.php" class="demo-list">
        <table class="table-6">
            <colgroup>
                <col span="1">
                <col span="4">
                <col span="1">
            </colgroup>
            <thead>
            <tr>
                <th>Sélectionner</th>
                <th>Enseignant</th>
                <th>Téléchargement</th>
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

        <button type="submit" class="button--secondary">Télécharger les agendas sélectionnés</button>

        <!-- DataTables plugin -->
        <script>
            var data = [
            <?php
                $ressources_profs = mysql_query("SELECT * FROM $dernierebase.ressources_profs WHERE deleted='0' ");
                while ($prof = mysql_fetch_array($ressources_profs)) {
                    ?>
                [
                    '<input id="box<?php echo $prof[0]; ?>" type="checkbox" name="box<?php echo $prof[0]; ?>">',
                    '<?php echo $prof[4] . " " . $prof[3]; ?>',
                    '<a class="button--secondary" target="_blank" href="http://localhost/~indydedeken/edt/icsprof/icsprof.php?<?php echo "idprof=$prof[0]&nom=$prof[3]&prenom=$prof[4]"; ?>">Téléchargement</a>'
                ],
                    <?php
                }
            ?>
            ]

            $('table').dataTable({
                  "data"        : data,
                  "bSort"       : false,
                  "bSortable"   : false,
                  "lengthMenu"  : [200]
            });
        </script>

        <!-- iCheck plugin -->
        <script>
            $(window).ready(function(){
                var callbacks_list = $('.demo-callbacks ul');
                $('.demo-list input').on('click ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event){
                    callbacks_list.prepend('<li><span>#' + this.id + '</span> is ' + event.type.replace('if', '').toLowerCase() + '</li>');
                }).iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%'
                });
            });
        </script>

    </form>

    <script src="scripts/main.js"></script>

</main>
</body>
</html>
