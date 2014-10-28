$(document).ready(function() {

    // closeTag Bootstrap3.0
    var closeTag = '<button type="button" class="close" data-dismiss="modal">' +
                   '<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>' +
                   '</button>';

    // connexion teacher
    $('#teachConnect').submit(function(event) {

        event.preventDefault();

        $.ajax({
                type: "POST",
                url: "script/teachConnectScript.php",
                data: {
                    teachLogin: $("#teachConnect #inputLogin3").val(),
                    teachPwd: $("#teachConnect #inputPassword3").val()
                },
                dataType: "json"
            })
            .done(function(elem) {
                if (elem.connexion === true) {
                    // connexion réussie
                    window.location = "index.php";
                } else {
                    // connexion échouée
                    $("#retourLoginJs")
                        .html(closeTag + elem.message)
                        .addClass('alert alert-danger col-md-4 col-centered')
                        .show(500);
                }
            })
            .fail(function(elem) {
                alert("Appel AJAX impossible");
            });

    });

    // connexion student
    $('#studyConnect').submit(function(event) {

        event.preventDefault();

        $.ajax({
                type: "POST",
                url: "script/studyConnectScript.php",
                data: {
                    studyLogin: $("#studyConnect #inputLoginEtudiant").val(),
                },
                dataType: "json"
            })
            .done(function(elem) {
                if (elem.connexion === true) {
                    // connexion réussie
                    window.location.reload();
                } else {
                    // connexion échouée
                    $("#retourLoginJs")
                        .html(elem.message)
                        .addClass('alert alert-danger col-md-4 col-centered')
                        .show(500);
                }
            })
            .fail(function(elem) {
                alert("Appel AJAX impossible");
            });
    });

    // possibilité de masquer le message d'erreur
    $('#loginTabContent').on("click", "#retourLoginJs", function() {
        $(this).html('').hide();
    });
});
