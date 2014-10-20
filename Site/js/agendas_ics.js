var urlRadicale = 'https://www.edouardalvescamilo.ovh';


/*
 * iCheck plugin
 */
    $(document).on('icheck', function(){
        var callbacks_list = $('.demo-callbacks ul');
        $('.form-enseignant, .form-filiere, .form-salle')
            .on('click ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed',
                function(event){
                    callbacks_list.prepend('<li><span>#' + this.id + '</span> is ' + event.type.replace('if', '').toLowerCase() + '</li>');
                }
            ).iCheck({
                checkboxClass : 'icheckbox_flat-blue',
                radioClass    : 'iradio_flat-blue',
                increaseArea  : '40%'
            });
    }).trigger('icheck');; // charger iCheck
/*
 * ./iCheck plugin
 */

/*
 * DataTables plugin Enseignant
 */
    $(document).ready(function() {
        // EXAMPLE : http://editor.datatables.net/examples/api/checkbox.html
        $('table.table-enseignant').dataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url" : "script/dataTablesGetProfs.php",
                "dataType" : "json"
            },
            "columns": [
                {
                    "data": "Selection",
                    "render": function ( data, type, row ) {
                        if ( type === 'display' ) {
                            return '<input id="box_' + row.codeProf + '" type="checkbox" name="' + row.codeProf + '">';
                        }
                        return data;
                    },
                    "defaultContent": "-"
                },
                {
                    "data": "Enseignant",
                    "render": function ( data, type, row ) {
                        if ( type === 'display' ) {
                            return row.nom + ' ' + row.prenom;
                        }
                        return data;
                    },
                    "defaultContent": "-"
                },
                {
                    "data": "Téléchargement",
                    "render": function ( data, type, row ) {
                        if ( type === 'display' ) {
                            return '<a id="lien_'+ row.codeProf + '" class="btn btn-default" data-idprof="' + row.codeProf + '" data-nom="' + row.nom + '" data-prenom="' + row.prenom + '"><span class="glyphicon glyphicon-save"></span></a>';
                        }
                        return data;
                    },
                    "defaultContent": "-"
                }
            ],
            "bSort"       : false,
            "bSortable"   : false,
            "lengthMenu"  : [200],
            "language"    : {
                "zeroRecords" : "Aucun enseignant",
                "search"      : "Rechercher un enseignant _INPUT_",
                "sProcessing" : "Chargement..."
            },
            "fnDrawCallback": function( oSettings ) {
                $(document).trigger('icheck'); // charger iCheck

                var selecteurCSS = '.table-enseignant a';
                var typeICS      = 'Enseignant';
                // lancement de production de fichier .ics
                callIcsCreator(selecteurCSS, urlRadicale, typeICS);
            }
        });
    });
/*
 * ./DataTables plugin Enseignant
 */


/*
 * DataTables plugin Filière
 */
    $(document).ready(function() {
        // EXAMPLE : http://editor.datatables.net/examples/api/checkbox.html
        $('table.table-filiere').dataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url" : "script/dataTablesGetGroupes.php",
                "dataType" : "json"
            },
            "columns": [
                {
                    "data": "Sélection",
                    "render": function ( data, type, row ) {
                        if ( type === 'display' ) {
                            return '<input id="box_' + row.codeGroupe + '" type="checkbox" name="' + row.codeGroupe + '">';
                        }
                        return data;
                    },
                    "defaultContent": "-"
                },
                {
                    "data": "Filière",
                    "render": function ( data, type, row ) {
                        if ( type === 'display' ) {
                            return row.alias === '' ? row.nom : row.alias;
                        }
                        return data;
                    },
                    "defaultContent": "-"
                },
                {
                    "data": "Téléchargement",
                    "render": function ( data, type, row ) {
                        if ( type === 'display' ) {
                            return '<a id="lien_'+ row.codeGroupe + '" class="btn btn-default" data-idgroupe="' + row.codeGroupe + '" data-nom="' + row.nom + '" data-alias="' + row.alias + '"><span class="glyphicon glyphicon-save"></span></a>';
                        }
                        return data;
                    },
                    "defaultContent": "-"
                }
            ],
            "bSort"       : false,
            "bSortable"   : false,
            "lengthMenu"  : [200],
            "language"    : {
                "zeroRecords" : "Aucune filière",
                "search"      : "Rechercher une filière _INPUT_",
                "sProcessing" : "Chargement..."
            },
            "fnDrawCallback": function( oSettings ) {
                $(document).trigger('icheck'); // charger iCheck

                var selecteurCSS = '.table-filiere a';
                var typeICS      = 'Filiere';
                // lancement de production de fichier .ics
                callIcsCreator(selecteurCSS, urlRadicale, typeICS);
            }
        });

    });
/*
 * ./DataTables plugin Filière
 */


/*
 * DataTables - téléchargement d'EdT un par un
 */
function callIcsCreator(selecteurCSS, urlRadicale, typeICS) {

    $( selecteurCSS ).on('click', function( event ) {
        event.preventDefault();

        // En fonction du selecteur on identifie
        // si cas == enseignant || filiere || salle
        if(selecteurCSS.indexOf("enseignant") > -1) {

            var texte = '{' +
                '"idprof" : "' + $(this).data( "idprof" ) + '",' +
                '"var1"   : "' + $(this).data( "idprof" ) + '",' +
                '"nom"    : "' + $(this).data( "nom" )    + '",' +
                '"var2"   : "' + $(this).data( "nom" )    + '",' +
                '"prenom" : "' + $(this).data( "prenom" ) + '",' +
                '"var3"   : "' + $(this).data( "prenom" ) + '" ' +
                '}';

            var objet = JSON.parse(texte);
            var icsDirectory = "icsprof";
            var icsScript    = "icsprof.php";
            var icsFile      = objet.nom.toLowerCase() +
                                "_" +
                                objet.prenom.toLowerCase();

        }
        else if(selecteurCSS.indexOf("filiere") > -1) {

            var texte = '{' +
                '"idgroupe" : "' + $(this).data( "idgroupe" ) + '",' +
                '"var1"     : "' + $(this).data( "idgroupe" ) + '",' +
                '"nom"      : "' + $(this).data( "nom" )      + '",' +
                '"var2"     : "' + $(this).data( "nom" )      + '",' +
                '"alias"    : "' + $(this).data( "alias" )    + '",' +
                '"var3"     : "' + $(this).data( "alias" )    + '" ' +
                '}';

            var objet = JSON.parse(texte);
            var icsDirectory = "icsetudiant";
            var icsScript    = "icsgroupe.php";
            var icsFile      = objet.nom.toLowerCase();

        }
        else if(selecteurCSS.indexOf("salle") > -1) {
            /*
                REMPLIR
            */
        }
        else {
            var icsDirectory = "";
            var icsFile      = "";
            var icsScript    = "";
            var objet        = "";
        }

        var request = $.ajax({
            url: "ics/" + icsDirectory + "/" + icsScript,
            type: "POST",
            data: objet
        })
            .done(function( data ) {
                $( "#lien_" + objet.var1)
                    .removeClass('btn-default')
                    .html( '<span class="glyphicon glyphicon-ok"></span>' )
                    .addClass('btn-success')
                    .attr('href', urlRadicale + "/" + typeICS + "/" + icsFile + ".ics");
                window.open($( "#lien_" + objet.var1).attr( 'href' ));
            }
        )
            .fail(function( data ) {
                $( "#lien_" + objet.var1)
                    .removeClass('btn-default')
                    .html( '<span class="glyphicon glyphicon-repeat"></span>' )
                    .addClass('btn-danger');
                alert( "La requête a échoué : " + textStatus );
            }
        );
    });
}
/*
 *  ./DataTables - téléchargement d'EdT un par un
 */

/*
 * Manual scripts
 */
    $(document).ready(function() {

        /*
         * Dropdown effect on Enseignant-list
         */
        $('.table-enseignant th').click(function (e) {
            $('#DataTables_Table_0 tbody').slideToggle("fast");

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
         * Dropdown effect on Filiere-list (filière)
         */
        $('.table-filiere th').click(function (e) {
            $('#DataTables_Table_1 tbody').slideToggle("fast");

            /* recoder proprement */
            var monIcone = $('#plusFiliere');
            var change = monIcone.hasClass('glyphicon-chevron-down');
            if (change) {
                monIcone.removeClass('glyphicon-chevron-down')
                    .addClass('glyphicon-chevron-up');
                $('.button-filiere').hide('fast');
                $('#DataTables_Table_1_filter').slideUp();

            } else {
                monIcone.removeClass('glyphicon-chevron-up')
                    .addClass('glyphicon-chevron-down');
                $('.button-filiere').show('fast');
                $('#DataTables_Table_1_filter').slideDown();
            }
        });

        /*
         * Button - choose a category (Enseignant, Filière, Salle)
         */
        $('#form-enseignant').click(function(){
            $('.form-filiere, .form-salle').hide('fast');
            $('.form-enseignant').show('fast');
            $('#form-filiere, #form-salle').removeClass('active');
            $(this).addClass('active');
        });
        $('#form-filiere').click(function(){
            $('.form-enseignant, .form-salle').hide('fast');
            $('.form-filiere').show('fast');

            $('#form-salle, #form-enseignant').removeClass('active');
            $(this).addClass('active');
        });
        $('#form-salle').click(function(){
            $('.form-enseignant, .form-filiere').hide('fast');
            $('.form-salle').show('fast');
            $('#form-enseignant, #form-filiere').removeClass('active');
            $(this).addClass('active');
        });
    });
/*
 * Manual scripts
 */
