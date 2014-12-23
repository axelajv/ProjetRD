function displayDroits()
{
		function manageDroitState(id, state)
		{
			if (state == 1)
			{
				$(id).addClass("active");
			}
			else
			{
				$(id).removeClass("active");
			}
		}
		var codeProf = $('#profs :selected').val();
		
		$.ajax({
			type: "POST",
			url: "./script/getDroitsByCodeProf.php",
			data: {
				code: codeProf,
			},
			dataType: "json"
		})
		.done(function(elem)
		{
			manageDroitState("#admin", elem.admin);
			manageDroitState("#giseh", elem.giseh);
			manageDroitState("#bilan_formation", elem.bilan_formation);
			manageDroitState("#bilan_salle", elem.salle);
			manageDroitState("#droits", elem.mes_droits);
			manageDroitState("#bilan_salle", elem.salle);
			manageDroitState("#bilan_heure", elem.bilan_heure_global);
			manageDroitState("#pdf", elem.pdf);
			manageDroitState("#rss", elem.rss);
			manageDroitState("#config", elem.configuration);
			manageDroitState("#reservation", elem.reservation);
			manageDroitState("#modules", elem.module);
			manageDroitState("#dialogue", elem.dialogue);
			manageDroitState("#heures", elem.bilan_heure);
		})
		.fail(function(elem)
		{
			alert("Appel AJAX impossible");
		});
}

$(document).ready(function()
{
	displayDroits();
	
	$('#modifyConfigForm').submit(function(event)
	{

        event.preventDefault();

        $.ajax({
                type: "POST",
                url: "./script/updateDroits.php",
                data: {
                    code: $('#profs :selected').val(),
					admin: $('#admin :active'),
					reservation: $('#reservation :active'),
					mes_droits : $('#droits :active'),
                    modules  : $('#modules :active'),
					bilan_heure_global : $("#bilan_heure :active"),
					bilan_heure : $("#heures :active"),
					configuration : $("#config :active"),
					rss : $("#rss :active"),
					pdf : $("#pdf :active"),
					giseh : $("#giseh :active"),
					dialogue : $("#dialogue :active"),
					salle : $("#bilan_salle :active")
                },
                dataType: "text"
            })
            .done(function(elem)
			{
                // connexion échouée
                $("#retourLoginJs")
                    .html("<span class='glyphicon glyphicon-ok-circle'></span> "  + elem)
                    .addClass('alert alert-success col-centered alert-dismissible');
            })
            .fail(function(elem)
			{
                alert("Appel AJAX impossible");
            });
    });
});