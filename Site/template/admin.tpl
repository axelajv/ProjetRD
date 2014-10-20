<html>
	<head>
		<meta charset="utf-8">
		<title>VT Calendar - Gestion des droits</title>
		<link rel="stylesheet" href="API/bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/common.css"/>
		<link rel="stylesheet" href="css/admin.css"/>
		<link rel="stylesheet" href="API/dataTables/css/dataTables.css"/>
		<script src="API/jquery/jquery.js"></script>
		<script src="API/jquery/jquery.tablesorter.min.js"></script>
		<script src="API/dataTables/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="API/bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="js/loadPage.js"></script>
		<script type="text/javascript" src="js/filterTable.js"></script>
	</head>
	<body>
		
		{include file='template/include/header.tpl'}
		<div class="container">
		<form>
				<table class="table-striped table center-table col-md-12 sortTable dataTable">
					<thead>
						<tr>
						   <th>Nom</th>
						   <th>Prenom</th>
						   <th>Administrateur</th>
						   <th>Export vers Giseh</th>
						   <th>Bilan des salles</th>
						   <th>Bilan des heures des profs</th>
						   <th>Bilan des formations</th>
						   <th>Afficher ses droits</th>
						   <th>Bilan de ses heures</th>
						   <th>Export PDF</th>
						   <th>RSS</th>
						   <th>Configuration</th>
						   <th>Reservation</th>
						   <th>Detail des modules</th>
						   <th>Séances clicables</th>
						   <th>Dialogue de Gestion</th>
						   <th>Agenda ICS</th>
						</tr>
					</thead>
					<tbody  class="searchable">
						{foreach from=$allTeachers item=teacher}
							<tr>
							   <td>{$teacher.prenom}</td>
							   <td>{$teacher.nom}</td>
							   {foreach from=$teacher.droits item=droit}
									<td {if $droit == 1} class="success" {else} class="danger" {/if} >
										<div class="checkbox">
											<input type="checkbox" {if $droit == 1} checked {/if} >
										</div>
									</td>
							   {/foreach}
							</tr>
						{/foreach}
					</tbody>
				</table>
			
			<button type="submit" class="btn btn-default">Sauvegarder</button>
		</form>
		</div>
		{include file='template/include/footer.tpl'}
	</body>
</html>