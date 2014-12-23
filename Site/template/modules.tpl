<html>
	<head>
		<meta name="viewport" content="width = device-width, initial-scale = 1.0, minimum-scale = 1.0, maximum-scale = 1.0, user-scalable = no">
		<meta charset="utf-8">
		<title>VT Agenda - Mes modules</title>
		<link rel="icon" type="image/png" href="img/glyphicons_calendar_title.png"/>
		<link rel="stylesheet" href="API/bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/common.css"/>
		<link href="API/footable/css/footable.core.css?v=2-0-1" rel="stylesheet" type="text/css">
		
		<script src="API/jquery/jquery.js"></script>
		<script type="text/javascript" src="API/bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="js/loadPage.js"></script>
		<script src="js/module.js"></script>
		<script type="text/javascript" src="API/footable/js/footable.js"></script>
		<script type="text/javascript" src="js/filterTable.js"></script>
		
		<script type="text/javascript" src="API/tableExport/tableExport.js"></script>
		<script type="text/javascript" src="API/tableExport/jquery.base64.js"></script>
	</head>
	<body>
		
		{include file='template/include/header.tpl'}
		<div class="container">
		{if isset($loginStudy)}
			<!-- PARTIE ETUDIANT -->
			<div class="col-md-4 col-centered">
				<div class="panel panel-default">
					<div class="panel-heading"> 
						<strong class="">Afficher mes modules</strong>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form">
							<div class="form-group">
								<label for="annee" class="col-sm-3 control-label">Annee scolaire </label>
								<div class="col-sm-9">
									<select name="annee" class="form-control" id="annee" required="">
										{foreach from=$annees item=annee}
											<option value=0>{$annees[0]}</option>
										{/foreach}
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="module" class="col-sm-3 control-label">Modules </label>
								<div class="col-sm-9">
									<select name="module" class="form-control" id="module" required="" onChange="loadSeanceList()">
										{foreach from=$liste_enseignement item=enseignement}
											<option>{$enseignement}</option>
										{/foreach}
									</select>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		{else}
			<div class="col-md-4 col-centered">
				<div class="panel panel-default">
					<div class="panel-heading"> 
						<strong class="">Afficher mes modules</strong>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form">
							<div class="form-group">
								<label for="anneeProf" class="col-sm-3 control-label">Annee scolaire </label>
								<div class="col-sm-9">
									<select name="anneeProf" class="form-control" id="anneeProf" required="">
										{foreach from=$annees item=annee}
											<option value=0 selected>{$annees[0]}</option>
										{/foreach}
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="departements" class="col-sm-3 control-label">Departement </label>
								<div class="col-sm-9">
									<select name="departements" class="form-control" id="departements" required="" onChange="loadProfsList()">
										<option value="all" selected>TOUS</option>
										{foreach from=$composantes item=composante}
											<option value={$composante.codeComposante}>{$composante.nom}</option>
										{/foreach}
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="profs" class="col-sm-3 control-label">Profs </label>
								<div class="col-sm-9">
									<select name="profs" class="form-control" id="profs" required="" onChange="loadModuleList()">
										{foreach from=$profs item=prof}
											<option value={$prof.codeProf}>{$prof.nom} {$prof.prenom}</option>
										{/foreach}
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="module" class="col-sm-3 control-label">Modules </label>
								<div class="col-sm-9">
									<select name="module" class="form-control" id="module" required="" onChange="loadSeanceList()">
									</select>
								</div>
							</div>
						</form>
					</div>
					<div class="panel-footer">
						{literal}
							<a download="module.csv" onClick ="this.href = $('#tableModule').tableExportInline({type:'csv',escape:'false',separator:';',consoleLog:true}); return true;">Export vers Excel</a>
						{/literal}
					</div>
				</div>
			</div>
		{/if}
		
		<table class="table center-table col-sm-9 footable" id="tableModule">
			<thead>
				<tr>
					<th>Date</th>
					<th>Groupes</th>
					<th data-hide="phone,tablet">Type</th>
					<th data-hide="phone,tablet">Enseignement</th>
					<th data-hide="phone,tablet">Profs</th>
					<th data-hide="phone,tablet">Salles</th>
					<th>Heure de début</th>
					<th data-hide="phone,tablet">Durée</th>
					<th data-hide="phone,tablet">Effectuée</th>
				</tr>
			</thead>
			<tbody id="tableContent">
			</tbody>
		</table>
		</div>
		{include file='template/include/footer.tpl'}
	
	</body>
</html>