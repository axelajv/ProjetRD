<html>
	<head>
		<meta charset="utf-8">
		<title>VT Calendar - Mes heures</title>
		<link rel="stylesheet" href="API/bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/common.css"/>
		<link rel="stylesheet" href="css/login.css"/>
		<script type="text/javascript" src="js/loadPage.js"></script>
		<script type="text/javascript" src="API/jquery/jquery.js"></script>
		<script type="text/javascript" src="API/jquery/jquery.tablesorter.min.js"></script>
		<script type="text/javascript" src="API/bootstrap/js/bootstrap.js"></script>		
		<script type="text/javascript" src="js/filterTable.js"></script>
		<script type="text/javascript" src="js/heure.js"></script>
		
	</head>
	
	<body>
		{include file='template/include/header.tpl'}
		<div class="container">
			<div class="col-md-4 col-centered">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong class="">Afficher mes Heures</strong>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form" name="form" id="form" method="get" >
	
							<input type="hidden" name="page" value="heure" />
							<label>Année scolaire :</label> 
							<select class="form-control" name="annee_scolaire">
								{foreach from=$annees item=annee}
									<option>{$annee}</option>
								{/foreach}
							</select><br>

							<label>Tri par Département :</label> 
							<select class="form-control" name="composante" onchange="document.form.submit();">
								<option value="all">TOUS</option>
								{foreach from=$composantes item=composante}
									<option {if $composante.codeComposante == $code}selected="selected"{/if} value="{$composante.codeComposante}">{$composante.nom}</option>
								{/foreach}
							</select></p><br>

							<label>Choix du professeur :</label> 
							<select name="prof" class="form-control" id="prof" required="">
								{foreach from=$allCSTeachers item=csTeacher}
									<option {if $csTeacher.codeProf == $codeProf}selected="selected"{/if}  value="{$csTeacher.codeProf}">{$csTeacher.nom}   {$csTeacher.prenom}</option>
								{/foreach}
							</select><br>
						</form>
					</div>
				</div>
			</div>		

			<table class="table-striped table center-table col-sm-9 sortTable">
				<thead>
					<tr>
						<th>Formation</th>
						<th>Code apogée</th>
						<th>Matière</th>
						<th>Date</th>
						<th>Heure début</th>
						<th>Heure fin</th>
						<th>Horaire réparti / nb profs</th>
						<th>Forfait</th>
						<th>CM</th>
						<th>TD</th>
						<th>TP</th>
						<th>EqTD</th>
						<th>Effectué</th>
					</tr>
				</thead>
				
				<tbody id="tableContent"> 
						{foreach from=$allSeances item=seance}
							<tr>
								<td>{$seance.nomFormation}</td>
								<td>{$seance.codeApogee}</td>
								<td>{$seance.nomMatiere}</td>
								<td>{$seance.dateSeance}</td>
								<td>{$seance.heureDebut}</td>
								<td>{$seance.heureFin}</td>
								<td>{if $seance.volumeReparti == 0} NON {else} OUI {/if}</td>
								<td>{if $seance.forfaitaire == 0} NON {else} OUI {/if} </td>
								<td>{if $seance.dureeCM !=0}{$seance.dureeCM}{else} --------{/if} </td>
								<td>{if $seance.dureeTD !=0}{$seance.dureeTD}{else} --------{/if} </td>
								<td>{if $seance.dureeTP !=0}{$seance.dureeTP}{else} --------{/if} </td>
								<td>{$seance.codeSeance} {$seance.seancesDureeSeance}</td>
								<td>TODO</td>
							</tr>	
						{/foreach}

				</tbody>

			</table>
		</div>
		
		{include file='template/include/footer.tpl'}

	</body>
		
</html>		