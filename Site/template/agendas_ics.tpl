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
        <link rel="stylesheet" href="css/login.css"/>
        <link rel="stylesheet" href="css/agendas_ics.css">
        <link rel="stylesheet" href="API/DataTables/css/jquery.dataTables.css">

        <!-- scripts -->
        <script src="API/jquery/jquery.js"></script>
        <script src="API/bootstrap/js/bootstrap.js"></script>
        <script src="js/loadPage.js"></script>
        <script src="API/dataTables/js/jquery.dataTables.js"></script>

    </head>
    <body>

        {include file='template/include/header.tpl'}

        {if isset($loginStudy)}
            <!-- PARTIE ETUDIANT -->
            <!-- faire une redirection vers index.php -->
        {else}

        <div class="container">
			<div class="col-lg-10 col-centered">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <!-- PARTIE ENSEIGNANT -->
                        <!-- div - btn-group -->
                        <div class="btn-group btn-group-justified">
                            <a id="form-enseignant" role="button" class="btn btn-default active">Enseignants</a>
                            <a id="form-filiere" role="button" class="btn btn-default">Filières</a>
                            <a id="form-salle" role="button" class="btn btn-default">Salles</a>
                        </div>
                        <!-- ./div - btn-group -->

                        <!-- form - form-enseignant -->
                        <form method="post" action="#" class="form-enseignant col-lg-12">
                            <!-- Table-enseigant - Generate by DataTables plugin -->
                            <table class="table table-enseignant">
                                <thead>
                                <tr>
                                    <th class="libelle">Enseignant</th>
                                    <th><span class="glyphicon glyphicon-download"></span></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td data-th="Enseignant"></td>
                                    <td data-th=""></td>
                                </tr>
                                </tbody>
                            </table>
                            <!-- ./table -->

                        </form>
                        <!-- ./form - form-enseignant -->

                        <!-- form - form-filiere -->
                        <form method="post" action="#" class="form-filiere col-lg-12" style="display:none;">
                            <!-- Table-filere - Generate by DataTables plugin -->
                            <table class="table table-filiere">
                                <thead>
                                <tr>
                                    <th class="libelle">Filière</th>
                                    <th><span class="glyphicon glyphicon-download"></span></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td data-th="Filière"></td>
                                    <td data-th=""></td>
                                </tr>
                                </tbody>
                            </table>
                            <!-- ./table -->

                        </form>
                        <!-- ./form - form-filiere -->

                        <!-- form - form-salle -->
                        <form method="post" action="#" class="form-salle col-lg-12" style="display:none;">
                            <!-- Table-salle - Generate by DataTables plugin -->
                            <table class="table table-salle">
                                <thead>
                                <tr>
                                    <th class="libelle">Salle</th>
                                    <th><span class="glyphicon glyphicon-download"></span></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td data-th="Salle"></td>
                                    <td data-th=""></td>
                                </tr>
                                </tbody>
                            </table>
                            <!-- ./table -->

                        </form>
                        <!-- ./form - form-salle -->
                    </div>
                </div>
            </div>
        </div>
        {/if}

        <script src="js/agendas_ics.js"></script>

        {include file='template/include/footer.tpl'}

    </body>
</html>
