<html>
	<head>
		<meta charset="utf-8">
		<title>VT Calendar - Occupation des salles</title>
		<link rel="stylesheet" href="API/bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/common.css"/>
		<link rel="stylesheet" href="css/admin.css"/>
		<script src="API/jquery/jquery.js"></script>
		<script type="text/javascript" src="API/bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="js/loadPage.js"></script>
		<script type="text/javascript" src="API/googleCharts/googleCharts.js"></script>
		<script type="text/javascript" src="js/occupationSalle.js"></script>
	</head>
	<body>
		
		{include file='template/include/header.tpl'}
		
		<div class="container">
			<a role="button" class="btn">Exporter vers EXCEL</a>
			<br>
			<table class="table-striped table center-table col-md-12">
				<thead>
					<tr>
						<th>Salle</th>
						<th>Zone</th>
						<th>Séance (en heure)</th>
						<th>Réservation (en heure)</th>
						<th>Total (en heure)</th>
						<th>Taux d'occupation</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$occupations item=occupation}
						<tr>
							<td>{$occupation.nom_salle}</td>
							<td>{$occupation.nom_zone}</td>
							<td>{$occupation.heure}</td>
							<td>{$occupation.heureReserve}</td>
							<td>{$occupation.total}</td>
							<td>{$occupation.taux}</td>
						</tr>
						{if $occupation.cumul == TRUE}
							<tr class="success">
								<td colspan="2">TOTAL</td>
								<td>{$occupation.total_seance}</td>
								<td>{$occupation.total_reserve}</td>
								<td>{$occupation.total_zone}</td>
								<td>{$occupation.total_taux}</td>
							<tr>
						{/if}
					{/foreach}
				</tbody>
			</table>
			<br>
			<div id="chart_div" class="hidden-xs hidden-sm"></div>
		</div>
		{include file='template/include/footer.tpl'}
	</body>
</html>