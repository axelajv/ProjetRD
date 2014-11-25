<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>VT Calendar - Accueil</title>

        <link rel="icon" type="image/x-icon" href="img/favicon/favicon.ico">

        <!-- Add to homescreen for Chrome on Android -->
        <meta name="mobile-web-app-capable" content="yes">
        <link rel="icon" sizes="192x192" href="img/favicon/favicon.png">

        <!-- Add to homescreen for Safari on iOS -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="Web Starter Kit">
        <link rel="apple-touch-icon-precomposed" href="img/favicon/apple-touch-icon-precomposed.png">

        <!-- Tile icon for Win8 (144x144 + tile color) -->
        <meta name="msapplication-TileImage" content="img/favicon/favicon.png">
        <meta name="msapplication-TileColor" content="#3372DF">

        <!-- Page styles -->
        <link rel="stylesheet" href="API/bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/common.css"/>

        <!-- scripts -->
        <script src="API/jquery/jquery.js"></script>
        <script src="API/bootstrap/js/bootstrap.js"></script>
        <script src="js/loadPage.js"></script>
        <script src="js/login_agendas_ics.js"></script>

    </head>
    <body>

        {include file='template/include/header.tpl'}

        {if isset($loginStudy)}
            <!-- PARTIE ETUDIANT -->
            <!-- faire une redirection vers index.php -->
        {else}
            <!-- PARTIE ENSEIGNANT -->

            <!-- div - retour login.js -->
            <div id="retourLoginJs"></div>
            <!-- ./div - retour login.js -->

            <!-- div - teachContainer -->
            <div id="teachContainer">
                <div class="col-md-4 col-centered">
                    <!-- div - panel -->
                    <div class="panel panel-default">

                        <!-- div - header panel -->
                        <div class="panel-heading">
                            <strong class="">Téléchargement de calendriers ICS</strong>
                        </div>
                        <!-- ./div - header panel -->

                        <!-- div - body panel -->
                        <div class="panel-body">

                            <!-- form -->
                            <form id="teachConnect" class="form-horizontal" role="form" method="post" action="#">

                                <!-- div - form-group login -->
                                <div class="form-group">
                                    <label for="inputLogin3" class="col-sm-3 control-label">Login</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="teachLogin" class="form-control" id="inputLogin3" required="" placeholder="Login">
                                    </div>
                                </div>
                                <!-- ./div - form-group login -->

                                <!-- div - form-group password -->
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Mdp</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="teachPwd" class="form-control" id="inputPassword3" placeholder="Mot de passe" required="">
                                    </div>
                                </div>
                                <!-- ./div - form-group password -->

                                <!-- div - form-group submit -->
                                <div class="form-group" id="teachButtons">
                                    <div class="btn-group col-xs-12">
                                        <button type="reset" class="btn btn-danger col-xs-6">Annuler</button>
                                        <button type="submit" class="btn btn-success col-xs-6">Valider</button>
                                    </div>
                                </div>
                                <!-- ./div - form-group submit -->

                            </form>
                            <!-- ./form -->
                        </div>
                        <!-- ./div - body panel -->
                    </div>
                    <!-- ./div - panel -->
                </div>
            </div>
            <!-- /div - teachContainer -->

        {/if}

        {include file='template/include/footer.tpl'}

    </body>
</html>
