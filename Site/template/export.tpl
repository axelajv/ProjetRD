<html>
	<head>
		<meta charset="utf-8">
		<title>VT Calendar - Acceuil</title>
		<link rel="stylesheet" href="API/bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/common.css"/>
		<link rel="stylesheet" href="css/export.css"/>
		<script type="text/javascript" src="js/loadPage.js"></script>
	</head>
	<body>
		{include file='template/include/header.tpl'}
		
		<div id="exportTabContent" class="tab-content container">
				{if isset($droits) && ($droits.pdf == 1  || $droits.giseh == 1)}
					<ul id="exportTab" class="nav nav-tabs col-md-4">
						{if isset($droits) && $droits.pdf == 1}
							<li class="active"><a href="#pdfContainer" data-toggle="tab"><span class="glyphicon glyphicon-file"></span> PDF</a></li>
						{/if}
						{if isset($droits) && $droits.giseh == 1}
							<li><a href="#gisehContainer" data-toggle="tab"><span class="glyphicon glyphicon-file"></span> GISEH</a></li>
						{/if}
					</ul>
				{/if}
				
				<div id="pdfContainer" class="tab-pane fade in active">
					<div class="row">
						<div class="col-md-4 col-centered">
							<div class="panel panel-default">
								<form class="form-horizontal" role="form" method="post" action="script/exportPDF.php" onSubmit="return true;">
									<div class="panel-heading"> 
										<strong class="">Exporter en PDF</strong>
									</div>
									<div class="form-group">
										<label for="beginDate" class="col-sm-3 control-label">Début</label>
										<div class="col-sm-9">
											<input type="date" name="beginDate" class="form-control" id="beginDate" placeholder="Début">
										</div>
									</div>
									<div class="form-group">
										<label for="endDate" class="col-sm-3 control-label">Fin</label>
										<div class="col-sm-9">
											<input type="date" name="endDate" class="form-control" id="endDate" placeholder="Fin">
										</div>
									</div>
									<div class="form-group">
										<label for="formatPDF" class="col-sm-3 control-label">Format</label>
										<div class="col-sm-9">
											<select name="formatPDF" id="formatPDF">
												<option value="A4" selected>A4</option>
												<option value="A3">A3</option>
											</select>
										</div>
									</div>
									<div class="form-group last" id="pdfButtons">
										<button type="submit" class="btn btn-success">Exporter</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			
				<div id="gisehContainer" class="container tab-pane fade in">
					<div class="row">
						<div class="col-md-4 col-centered">
							<div class="panel panel-default">
								<form class="form-horizontal" role="form" method="post" action="script/exportGiseh.php" onSubmit="return true;">
									<div class="panel-heading"> 
										<strong class="">Exporter en GISEH</strong>
									</div>
									<div class="form-group">
										<label for="formation" class="col-sm-3 control-label">Format</label>
										<div class="col-sm-9">
											<select name="formation" id="formation">
												{foreach from=$formations item=formation}
													<option value={$formation.codeNiveau}>{$formation.nom}</option>
												{/foreach}
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="beginDate" class="col-sm-3 control-label">Début</label>
										<div class="col-sm-9">
											<input type="date" name="beginDate" class="form-control" id="beginDate" placeholder="Début">
										</div>
									</div>
									<div class="form-group">
										<label for="endDate" class="col-sm-3 control-label">Fin</label>
										<div class="col-sm-9">
											<input type="date" name="endDate" class="form-control" id="endDate" placeholder="Fin">
										</div>
									</div>
									<div class="form-group">
										<div class="checkbox">
											<input type="checkbox" checked name="vacataire">déclarer les TP en TD</input>
										</div>
									</div>
									<div class="form-group">
										<div class="checkbox">
											<input type="checkbox" checked name="teachCookie">Exporter les forfaits sans séance placée</input>
										</div>
									</div>
									<div class="form-group last" id="gisehButtons">
										<button type="submit" class="btn btn-success">Exporter</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		
		{include file='template/include/footer.tpl'}
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script type="text/javascript" src="API/bootstrap/js/bootstrap.js"></script>
	</body>
</html>