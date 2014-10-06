<?php
/*
 * Page test pour login
 */

// Variables de test -- Fausses valeurs
$user = 'stud';
$user = 'prof';
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
    <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/favicon.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <!-- Page styles -->
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/specifiques.css">
</head>

<body>
<!-- Préchargement des images -->
<img style="display: none" src="https://dl.dropboxusercontent.com/u/12687630/menu/rss.gif" />
<img style="display: none" src="https://dl.dropboxusercontent.com/u/12687630/menu/pdf.gif" />
<!-- Fin préchargement des images -->

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
            <?php
            if($user == 'prof') {
                ?>
                <!-- Accès à ma config -->
                <a href="javascript:submitform_ma_config2()">
                    <button><i class="color--gray-background icon icon-cog"></i></button>
                </a>
            <?php
            }
            ?>
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
        <?php

        if ($user == 'prof') {
            ?>
            <li><a href="#" role="menuitem"><span>Mes modules</span></a></li>
            <li><a href="#" role="menuitem"><span>Mes droits</span></a></li>
            <li><a href="#" role="menuitem"><span>Mes heures</span></a></li>
            <li><a href="#" role="menuitem" class="exportPDF"><span>Export PDF</span></a></li>
            <li><a href="#" role="menuitem" class="fluxRSS"><span>Flux RSS</span></a></li>
            <li><a href="#" role="menuitem"><span>Agenda</span></a></li>
        <?php
        } else if($user == 'stud') {
            ?>
            <li><a href="#exportPDF" role="menuitem"><span>Export PDF</span></a></li>
            <li><a href="#MesDS" role="menuitem"><span>Mes DS</span></a></li>
            <li><a href="#MesModules" role="menuitem"><span>Mes modules</span></a></li>
            <li><a href="#FluxRSS" role="menuitem"><span>Flux RSS</span></a></li>
            <li><a href="#AgendaElectronique" role="menuitem"><span>Agenda</span></a></li>
        <?php
        }
        ?>
    </ul>
</nav>

<!-- Formulaire de gestion des EdT -->
<main>
    <table class="table-6">
        <colgroup>
            <col span="1">
            <col span="1">
            <col span="1">
        </colgroup>
        <thead>
        <tr>
            <th>Element</th>
            <th>Etat</th>
            <th>Description</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td data-th="Element">
                <input type="checkbox">
            </td>
            <td data-th="Etat">Clos</td>
            <td data-th="Description">Gives the address (URL) of the video.</td>
        </tr>
        <tr>
            <td data-th="element">
                <input type="checkbox">
            </td>
            <td data-th="Etat">Ouvert</td>
            <td data-th="Description">Gives the address (URL) of an image file that the browser can show as soon as the video element loads, before playback begins.</td>
        </tr>

    </table>
</main>

<!-- SCRIPTS JS -->
<script src="lib/jquery/src/jquery.js"></script>
<script src="scripts/main.js"></script>
<!-- ./SCRIPTS JS -->

</body>
</html>