// URL a deplacer/modifier
var urlRadicale = 'https://adminprof:adminprof@edouardalvescamilo.ovh';

/*
 * DataTables plugin Enseignant
 */
$(document).ready(function() {
    // EXAMPLE : http://editor.datatables.net/examples/api/checkbox.html
    $('table.table-enseignant').dataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "script/dataTablesGetProfs.php",
            "dataType": "json"
        },
        "columns": [{
            "data": "Enseignant",
            "render": function(data, type, row) {
                if (type === 'display') {
                    return row.nom + ' ' + row.prenom;
                }
                return data;
            },
            "defaultContent": "-"
        }, {
            "data": "Téléchargement",
            "render": function(data, type, row) {
                if (type === 'display') {
                    return '<a id="lien_' + row.codeProf + '" class="btn btn-default" data-idprof="' + row.codeProf + '" data-nom="' + row.nom + '" data-prenom="' + row.prenom + '"><span class="glyphicon glyphicon-save"></span></a>';
                }
                return data;
            },
            "defaultContent": "-"
        }],
        "bSort": false,
        "bSortable": false,
        "lengthMenu": [200],
        "language": {
            "zeroRecords": "Aucun enseignant",
            "search": "Rechercher un enseignant _INPUT_",
            "sProcessing": "Chargement..."
        },
        "fnDrawCallback": function(oSettings) {
            //$(document).trigger('icheck'); // charger iCheck

            var selecteurCSS = '.table-enseignant a';
            var typeICS = 'Enseignants';
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
    $('table.table-filiere').dataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "script/dataTablesGetGroupes.php",
            "dataType": "json"
        },
        "columns": [{
            "data": "Filière",
            "render": function(data, type, row) {
                if (type === 'display') {
                    return row.alias === '' ? row.nom : row.alias;
                }
                return data;
            },
            "defaultContent": "-"
        }, {
            "data": "Téléchargement",
            "render": function(data, type, row) {
                if (type === 'display') {
                    return '<a id="lien_' + row.codeGroupe + '" class="btn btn-default" data-idgroupe="' + row.codeGroupe + '" data-nom="' + row.nom + '" data-alias="' + row.alias + '"><span class="glyphicon glyphicon-save"></span></a>';
                }
                return data;
            },
            "defaultContent": "-"
        }],
        "bSort": false,
        "bSortable": false,
        "lengthMenu": [200],
        "language": {
            "zeroRecords": "Aucune filière",
            "search": "Rechercher une filière _INPUT_",
            "sProcessing": "Chargement..."
        },
        "fnDrawCallback": function(oSettings) {
            //$(document).trigger('icheck'); // charger iCheck

            var selecteurCSS = '.table-filiere a';
            var typeICS = 'Filieres';
            // lancement de production de fichier .ics
            callIcsCreator(selecteurCSS, urlRadicale, typeICS);
        }
    });

});
/*
 * ./DataTables plugin Filière
 */


/*
 * DataTables plugin Salle
 */
$(document).ready(function() {
    // EXAMPLE : http://editor.datatables.net/examples/api/checkbox.html
    $('table.table-salle').dataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "script/dataTablesGetSalles.php",
            "dataType": "json"
        },
        "columns": [{
            "data": "Salle",
            "render": function(data, type, row) {
                if (type === 'display') {
                    return row.nom;
                }
                return data;
            },
            "defaultContent": "-"
        }, {
            "data": "Téléchargement",
            "render": function(data, type, row) {
                if (type === 'display') {
                    return '<a id="lien_' + row.codeSalle + '" class="btn btn-default" data-idsalle="' + row.codeSalle + '" data-nom="' + row.nom + '" data-alias="' + row.alias + '"><span class="glyphicon glyphicon-save"></span></a>';
                }
                return data;
            },
            "defaultContent": "-"
        }],
        "bSort": false,
        "bSortable": false,
        "lengthMenu": [200],
        "language": {
            "zeroRecords": "Aucune salle",
            "search": "Rechercher une salle _INPUT_",
            "sProcessing": "Chargement..."
        },
        "fnDrawCallback": function(oSettings) {
            //$(document).trigger('icheck'); // charger iCheck

            var selecteurCSS = '.table-salle a';
            var typeICS = 'Salles';
            // lancement de production de fichier .ics
            callIcsCreator(selecteurCSS, urlRadicale, typeICS);
        }
    });

});
/*
 * ./DataTables plugin Salle
 */


/*
 * DataTables - téléchargement d'EdT un par un
 */
function callIcsCreator(selecteurCSS, urlRadicale, typeICS) {

        $(selecteurCSS).on('click', function(event) {
            event.preventDefault();

            var texte = "";
            var obj = "";
            var icsDirectory = "";
            var icsScript = "";
            var icsFile = "";

            // En fonction du selecteur on identifie
            // si cas == enseignant || filiere || salle
            if (selecteurCSS.indexOf("enseignant") > -1) {

                texte = '{' +
                    '"idprof" : "' + $(this).data("idprof") + '",' +
                    '"var1"   : "' + $(this).data("idprof") + '",' +
                    '"nom"    : "' + $(this).data("nom") + '",' +
                    '"var2"   : "' + $(this).data("nom") + '",' +
                    '"prenom" : "' + $(this).data("prenom") + '",' +
                    '"var3"   : "' + $(this).data("prenom") + '" ' +
                    '}';

                obj = JSON.parse(texte);
                icsDirectory = "icsprof";
                icsScript = "icsprof.php";
                icsFile = obj.nom.toLowerCase() +
                    "_" +
                    obj.prenom.toLowerCase();

            } else if (selecteurCSS.indexOf("filiere") > -1) {

                texte = '{' +
                    '"idgroupe" : "' + $(this).data("idgroupe") + '",' +
                    '"var1"     : "' + $(this).data("idgroupe") + '",' +
                    '"nom"      : "' + $(this).data("nom") + '",' +
                    '"var2"     : "' + $(this).data("nom") + '",' +
                    '"alias"    : "' + $(this).data("alias") + '",' +
                    '"var3"     : "' + $(this).data("alias") + '" ' +
                    '}';

                obj = JSON.parse(texte);
                icsDirectory = "icsetudiant";
                icsScript = "icsgroupe.php";
                icsFile = obj.nom.toLowerCase();

            } else if (selecteurCSS.indexOf("salle") > -1) {
                texte = '{' +
                    '"idsalle"  : "' + $(this).data("idsalle") + '",' +
                    '"var1"     : "' + $(this).data("idsalle") + '",' +
                    '"nom"      : "' + $(this).data("nom") + '",' +
                    '"var2"     : "' + $(this).data("nom") + '",' +
                    '"alias"    : "' + $(this).data("alias") + '",' +
                    '"var3"     : "' + $(this).data("alias") + '" ' +
                    '}';

                obj = JSON.parse(texte);
                icsDirectory = "icssalle";
                icsScript = "icssalle.php";
                icsFile = obj.nom.toLowerCase();

                var find = ' ';
                var reg = new RegExp(find, 'g');

                icsFile = icsFile.replace(reg, '_');

            } else {
                icsDirectory = "";
                icsFile = "";
                icsScript = "";
                obj = "";
            }

            var request = $.ajax({
                    url: "ics/" + icsDirectory + "/" + icsScript,
                    type: "POST",
                    data: obj
                })
                .done(function(data) {
                    $("#lien_" + obj.var1)
                        .removeClass('btn-default')
                        .html('<span class="glyphicon glyphicon-ok"></span>')
                        .addClass('btn-success')
                        .attr('href', urlRadicale + "/" + typeICS + "/" + icsFile + ".ics/");
                    window.open($("#lien_" + obj.var1).attr('href'));
                })
                .fail(function(data) {
                    $("#lien_" + obj.var1)
                        .removeClass('btn-default')
                        .html('<span class="glyphicon glyphicon-repeat"></span>')
                        .addClass('btn-danger');
                    alert("La requête a échoué : " + textStatus);
                });
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
     * Button - choose a category (Enseignant, Filière, Salle)
     */
    $('#form-enseignant').click(function() {
        $('.form-filiere, .form-salle').hide('fast');
        $('.form-enseignant').show('fast');
        $('#form-filiere, #form-salle').removeClass('active');
        $(this).addClass('active');
    });
    $('#form-filiere').click(function() {
        $('.form-enseignant, .form-salle').hide('fast');
        $('.form-filiere').show('fast');
        $('#form-salle, #form-enseignant').removeClass('active');
        $(this).addClass('active');
    });
    $('#form-salle').click(function() {
        $('.form-enseignant, .form-filiere').hide('fast');
        $('.form-salle').show('fast');
        $('#form-enseignant, #form-filiere').removeClass('active');
        $(this).addClass('active');
    });
});
/*
 * Manual scripts
 */
