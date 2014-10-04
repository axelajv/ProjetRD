<!doctype html>
<html lang="">
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
<header class="app-bar promote-layer">
    <div class="app-bar-container">
        <button class="menu"><img src="images/hamburger.svg" alt="Menu"></button>
        <h1 class="logo">VT <strong>Emploi du temps</strong></h1>
        <section class="app-bar-actions">
            <!-- Put App Bar Buttons Here -->
            <!-- e.g <button><i class="icon icon-star"></i></button> -->
            <form action="#LogOut" method="post">
                <button type="submit"><i class="color--red icon icon-close"></i></button>
            </form>
        </section>
    </div>
</header>


<!-- Menu bar -->
<nav id="cssmenu" class="navdrawer-container promote-layer">
    <h4>Navigation</h4>
    <ul>
        <!-- liens pour démonstration -->
        <li class="principal"><a href="http://edt.univ-evry.fr/index.php" target="_blank">Accueil</a></li>
        <!--<li><a id="outils" href="#outils">Outils</a>-->
        <ul class="submenu">
            <li><a href="#exportPDF" role="menuitem"><span>Export PDF</span></a></li>
            <li><a href="#MesDS" role="menuitem"><span>Mes DS</span></a></li>
            <li><a href="#MesModules" role="menuitem"><span>Mes modules</span></a></li>
            <li><a href="#FluxRSS" role="menuitem"><span>Flux RSS</span></a></li>
            <li><a href="#AgendaElectronique" role="menuitem"><span>Agenda</span></a></li>
        </ul>
        <!--</li>-->
    </ul>
</nav>

<!-- Formulaire de connexion -->
<main>
    <form id="connexionCaldav" method="post">
        <h2>Gestion Interne des Calendriers</h2>
        <label for="email">Adresse Email</label>
        <input type="email" name="email" id="email" placeholder="exemple@univ-evry.fr" required="">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="******" required="">
        <input type="submit" name="submit" id="submit" value="Connexion au Caldav">
    </form>
</main>

<script src="scripts/jquery-2.1.1.min.js"></script>
<script src="scripts/main.js"></script>
<!-- Built with love using Web Starter Kit -->
</body>
</html>
