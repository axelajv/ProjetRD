<html>
	<head>
		<meta charset="utf-8">
		<title>VT Calendar - Mes modules</title>
		<link rel="stylesheet" href="API/bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/common.css"/>
		<script src="API/jquery/jquery.js"></script>
		<script type="text/javascript" src="API/bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="js/loadPage.js"></script>
		<script src="js/module.js"></script>
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
											<option value=0>{$annees[0]}</option>
										{/foreach}
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="departements" class="col-sm-3 control-label">Departement </label>
								<div class="col-sm-9">
									<select name="departements" class="form-control" id="departements" required="" onChange="loadProfsList()">
										<option value="all">TOUS</option>
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
											<option value={$prof.codeProf}>{$prof.prenom} {$prof.nom}</option>
										{/foreach}
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="modules" class="col-sm-3 control-label">Modules </label>
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
		{/if}
		
		<table class="table-striped table center-table col-sm-9 sortTable">
			<thead>
				<tr>
					<th>Date</th>
					<th>Groupes</th>
					<th>Type</th>
					<th>Enseignement</th>
					<th>Profs</th>
					<th>Salles</th>
					<th>Heure de début</th>
					<th>Durée</th>
					 <th>Effectuée</th>
				</tr>
			</thead>
			<tbody id="tableContent">
			</tbody>
		</table>
		</div>
		{include file='template/include/footer.tpl'}
	
	</body>
</html>