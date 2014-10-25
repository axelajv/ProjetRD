<html>
	<head>
		<meta charset="utf-8">
		<title>VT Calendar - Bilan Formation</title>
		<link rel="stylesheet" href="API/bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/common.css"/>
		<script src="API/jquery/jquery.js"></script>
		<script type="text/javascript" src="API/bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="js/loadPage.js"></script>
	</head>
	<body>
		
		{include file='template/include/header.tpl'}
		
		<div class="container">
			<div class="col-md-4 col-centered">
				<div class="panel panel-default">
					<div class="panel-heading"> 
						<strong class="">Afficher le bilan de la formation</strong>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form">
							<div class="form-group">
								<label for="formations" class="col-sm-3 control-label">Formation </label>
								<div class="col-sm-9">
									<select name="formations" class="form-control" id="formations" required="">
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="beginDate" class="col-sm-3 control-label">Date debut </label>
								<div class="col-sm-9">
									<input type="date" name="beginDate" class="form-control" id="beginDate" placeholder="Début" value="01-01-2014">
								</div>
							</div>
							<div class="form-group">
								<label for="endDate" class="col-sm-3 control-label">Date fin </label>
								<div class="col-sm-9">
									<input type="date" name="endDate" class="form-control" id="endDate" placeholder="Fin" value="01-01-2014">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<h3>Heures des profs permanants</h3>
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
							<th>CR></th>
							<th>TD</th>
							<th>TP</th>
							<th>EqTD</th>
							<th>Effectué</th>
						</tr>
					</thead>
					<tbody id="tablePermanant">
					</tbody>
				</table>
				
				<h3>Heures des profs vacataires</h3>
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
							<th>CR></th>
							<th>TD</th>
							<th>TP</th>
							<th>EqTD</th>
							<th>Effectué</th>
						</tr>
					</thead>
					<tbody id="tableVacataire">
					</tbody>
				</table>
		</div>
		
		{include file='template/include/footer.tpl'}
	
	</body>
</html>