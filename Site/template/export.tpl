<html>
	<head>

		<meta name="viewport" content="width = device-width, initial-scale = 1.0, minimum-scale = 1.0, maximum-scale = 1.0, user-scalable = no" charset="utf-8"/>
		<title>VT Agenda - Export</title>
		<link rel="icon" type="image/png" href="img/glyphicons_calendar_title.png"/>
		<link rel="stylesheet" href="css/jquery-ui.css"/>
		<link rel="stylesheet" href="API/bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/common.css"/>
		<link rel="stylesheet" href="css/export.css"/>
		<script src="API/jquery/jquery.js"></script>
		<script type="text/javascript" src="API/bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="js/loadPage.js"></script>
		<script type="text/javascript" src="js/customCheck.js"></script>
		<script type="text/javascript" src="API/tableExport/tableExport.js"></script>
		<script type="text/javascript" src="API/tableExport/jquery.base64.js"></script>
		<script type="text/javascript" src="API/tableExport/jspdf/libs/adler32cs.js"></script>
		<script type="text/javascript" src="API/tableExport/jspdf/libs/deflate.js"></script>
		<script type="text/javascript" src="API/tableExport/jspdf/jspdf.js"></script>
		<script type="text/javascript" src="API/jquery/jquery-ui.js"></script>
		<script type="text/javascript" src="js/datePicker.js"></script>


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
								<div class="panel-heading">
									<strong class="">Exporter en PDF</strong>
								</div>
								<div class="panel-body">
									<form class="form-horizontal" role="form" method="post" action="script/exportPDF.php" onSubmit="return true;">
										<div class="form-group">
											<label for="beginDate" class="col-sm-3 control-label">Début</label>
											<div class="col-sm-9">
												<input type="text" id="datePickerDeb">
											</div>
										</div>
										<div class="form-group">
											<label for="endDate" class="col-sm-3 control-label">Fin</label>
											<div class="col-sm-9">
												<input type="text" id="datePickerFin">
											</div>
										</div>
										<div class="form-group">
											<label for="formatPDF" class="col-sm-3 control-label">Format</label>
											<div class="col-sm-9">
												<select name="formatPDF" class="form-control" id="formatPDF">
													<option value="A4" selected>A4</option>
													<option value="A3">A3</option>
												</select>
											</div>
										</div>
										<table style="position:absolute; top: -10000px;" id="tableSeance">
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
											</tbody>
										</table>
										<script type="text/javascript">
											function loadSeanceList() {
										    console.log("test");

										    var annee_scolaire = $("#annee_scolaire").val();
										    var composante = $("#composante").val();
										    var prof = $("#prof").val();
										    var url = "index.php?page=heure&annee_scolaire=2013-2014&composante=all&prof={$smarty.session.teachCodeProf}&ajax&" + Math.random();

										    $.ajax( {
										        type: "GET",
										        url: url,
										        cache: false,
										        dateType: 'html',
										        success: function(data) {
										            $("#tableContent").html(data);
										        },
										        error: function(data) {
										            console.log(data);
										        }
										    } );

										    return false;
											}

											loadSeanceList();
										</script>

										<div class="form-group last" id="pdfButtons">
										<a class="btn btn-success" download="seances.pdf" {literal}onClick ="this.href = $('#tableSeance').tableExportInline({type:'pdf',pdfFontSize:'5', escape: false, pdfColumns : [70, 50, 170, 70, 30, 30, 30, 30, 30, 20, 20, 20, 20]}); return true;"{/literal}>Exporter</a>
										</div>
									</form>
								</div>
								<div class="panel-footer">
<a download="seances.csv" {literal}onClick ="this.href = $('#tableSeance').tableExportInline({type:'csv',escape:'false',separator:';',consoleLog:true}); return true;"{/literal}>Exporter vers Excel</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div id="gisehContainer" class="container tab-pane fade in">
					<div class="row">
						<div class="col-md-4 col-centered">
							<div class="panel panel-default">
								<div class="panel-heading">
									<strong class="">Exporter pour GISEH</strong>
								</div>
								<div class="panel-body">
									<form class="form-horizontal" role="form" method="post" action="script/exportGiseh.php" onSubmit="return true;">
										<div class="form-group">
											<label for="formation" class="col-sm-3 control-label">Format</label>
											<div class="col-sm-9">
												<select name="formation" class="form-control" id="formation">
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
										<div class="form-group myCheck">
											<label for="tptd" class="col-sm-3 control-label">TP en TD</label>
											<div class="col-sm-9 class="form-control"" style="background: #F5F5F6; margin-bottom: 10px;">
												<input type="checkbox" checked name="tptd" id="tptd" class="checkbox">
											</div>
										</div>
										<div class="form-group myCheck">
											<label for="exportForfait" class="col-sm-3 control-label">Exporter forfaits</label>
											<div class="col-sm-9 class="form-control"" style="background: #F5F5F6;">
												<input type="checkbox" checked name="exportForfait" id="exportForfait" class="checkbox">
											</div>
										</div>
										<div class="form-group last" id="gisehButtons">
											<button type="submit" class="btn btn-success">Exporter</button>
										</div>
									</form>
								</div>
								<div class="panel-footer">
									<a role="button" class="btn">Exporter vers EXCEL</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		{include file='template/include/footer.tpl'}
	</body>
</html>
