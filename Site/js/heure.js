
function loadSeanceList()
{
	var codeProf = $('#prof :selected').text();
	
	/* fonction recuperant la liste des groupe dans lequel n'est pas un utilisateur */
	createSeanceTable = function(seance)
	{
		$('#tableContent').empty();
		if(seance.length)
		{
			for(i=0; i<seance.length; i++)
			{
				var ligne = "<tr>";
				var seanceInfo = seance[i].split("#");
				for(j=0; j<seanceInfo.length; j++)
				{
					ligne += "<td "
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
							ligne += "<span class='glyphicon glyphicon-ok-circle'></span>"
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
	}
	
	$.ajax({
		type: "POST",
		url: "./script/getTeachersHours.php.php",
		data: {prof : codeProf},
		cache: false,
		dateType: 'text',
		success: function(data)
		{
			createSeanceTable(data.split("~"));
		},
		error: function(data)
		{
			alert(data);
		}
	});
	
	return false;
}