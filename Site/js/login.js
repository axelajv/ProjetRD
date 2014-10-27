$(document).ready(function() {

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
                    window.location.reload();
                } else {
                    // connexion échouée
                    $("#retourLoginJs")
                        .html(elem.message)
                        .addClass('alert alert-danger col-md-4 col-centered')
                        .show(500)
                        .delay(1000)
                        .hide(1000);
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
                        .show(500)
                        .delay(1000)
                        .hide(1000);
                }
            })
            .fail(function(elem) {
                alert("Appel AJAX impossible");
            });
    });

    $('.btn-success').click(function() {

        $("#retourLoginJs").hide();

    });
});
