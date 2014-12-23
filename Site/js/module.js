function loadProfsList()
{
    var codeComposante = $('#departements :selected').val();

    addProfsToOptions = function(profs)
	{
        $('#profs').empty();
        if (profs.length) {
            for (i = 0; i < profs.length; i++)
			{
                profInfos = profs[i].split("#");
                $('#profs').append("<option value=" + profInfos[0] + ">" + profInfos[1] + " " + profInfos[2] + "</option>");
            }
            loadModuleList();
        }
    };

    $.ajax({
        type: "POST",
        url: "./script/getTeacherByComposante.php",
        data: {
            code: codeComposante
        },
        cache: false,
        dateType: 'text',
        success: function(data)
		{
            addProfsToOptions(data.split("~"));
        },
        error: function(data)
		{
            alert(data);
        }
    });
}

function loadModuleList()
{
    var codeProf = $('#profs :selected').val();

    addModulesToOptions = function(module)
	{
        $('#module').empty();
        if (module.length)
		{
            for (i = 0; i < module.length; i++)
			{
                $('#module').append("<option>" + module[i] + "</option>");
            }
            loadSeanceList();
        }
    };

    $.ajax({
        type: "POST",
        url: "./script/getTeachModule.php",
        data: { code: codeProf },
        cache: false,
        dateType: 'text',
        success: function(data)
		{
            addModulesToOptions(data.split("~"));
        },
        error: function(data)
		{
            alert(data);
        }
    });
}

function loadSeanceList()
{
    var codeModule = $('#module :selected').text();

    /* fonction recuperant la liste des groupe dans lequel n'est pas un utilisateur */
    createSeanceTable = function(seance)
	{
        $('#tableContent').empty();
        if (seance.length)
		{
            for (i = 0; i < seance.length; i++)
			{
                var ligne = "<tr>";
                var seanceInfo = seance[i].split("#");
                for (j = 0; j < seanceInfo.length; j++)
				{
					ligne += "<td ";
					if (j == 2)
					{
						if (seanceInfo[j] == "CM")
						{
							ligne += "class='info'";
						}
						else if (seanceInfo[j] == "TD")
						{
							ligne += "class='success'";
						}
						else if (seanceInfo[j] == "TP")
						{
							ligne += "class='warning'";
						}
						else 
						{
							ligne += "class='danger'";
						}
					}

					ligne += ">";
					if (j == (seanceInfo.length - 1))
					{
						if (seanceInfo[j] == 1)
						{
							ligne += "<span class='glyphicon glyphicon-ok-circle'></span>";
						}
					}
					else
					{
						ligne += seanceInfo[j];
					}
					ligne += "</td>";
				}
                ligne += "</tr>";

                $('#tableContent').append(ligne);
            }
        }
		else
		{
            $('#tableContent').append("<tr class='danger'><td colspan=9>Aucun resultats trouvés</td></tr>");
        }
    };

    $.ajax({
        type: "POST",
        url: "./script/getSeanceByUserAndModule.php",
        data: { module: codeModule },
        cache: false,
        dateType: 'text',
        success: function(data) { createSeanceTable(data.split("~"));},
        error: function(data) {alert(data);}
    });

    return false;
}
