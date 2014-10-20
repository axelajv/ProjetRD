<html>
	<head>
		<meta charset="utf-8">
		<title>VT Calendar - Accueil</title>

		<link rel="stylesheet" href="API/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="API/bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="css/common.css"/>
		<link rel="stylesheet" href="css/dialogueGestion.css"/>
		<script type="text/javascript" src="js/loadPage.js"></script>
	</head>
	<body>
		
		{include file='template/include/header.tpl'}
		<div class="container">
		{foreach from=$composantes item=composante}
			<h2>{$composante.nom}</h2>
			<table class="table-striped table center-table">
				<tr>
					<th>Grade</th>
					<th>Nom des enseignants</th>
					<th>Horaires statuaires</th>
					<th>Nombre</th>
					<th>Potentiel enseignement en heure</th>
				</tr>
				{foreach from=$composante.grades item=grade}
					<tr>
						<td>{$grade.nom}</td>
						<td class="resource_cell">{$grade.resources}</td>
						<td>{$grade.heure_vol_stat}h{$grade.minutes_vol_stat}</td>
						<td>{$grade.nb_prof}</td>
						<td>{$grade.nb_heure}</td>
					</tr>
				{/foreach}
				<tr class="success">
					<td colspan="4" class="potentielLabel">Potentiel Enseignement total</td>
					<td>{$composante.nbHeure}</td>
				</tr>
			</table>
		{/foreach}
		</div>
		{include file='template/include/footer.tpl'}
		
		<script type="text/javascript" src="API/bootstrap-calendar-master/components/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="API/bootstrap/js/bootstrap.min.js"></script>
	
	</body>
</html>