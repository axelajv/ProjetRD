<!DOCTYPE html>
<html>
<head>
	<title>VT Calendar</title>
	<meta charset="UTF-8">
	<style type="text/css"></style>
</head>
<body>
<div class="container">
	<div class="page-header" id="groupeFiltre">
	<div class="row">
		<div class="col-sm-6" id="rowFiltreleft">
	
		<div class="btn-group btn-group-justified" id="filtreToday">
			<div class="btn-group" >
				<button class="btn btn-primary" data-calendar-nav="prev"> << </button>
			</div>	
			<div class="btn-group" >	
				<button class="btn btn-default" data-calendar-nav="today"> Aujourd'hui </button>
			</div>	
			<div class="btn-group" >	
				<button class="btn btn-primary" data-calendar-nav="next"> >> </button>
			</div>	
		</div>
</div>		
	<div class="col-sm-6" id="rowFiltreRight">			
		<div class="btn-group btn-group-justified" id="filtreAnnee">
			<div class="btn-group" >	
				<button class="btn btn-warning" data-calendar-view="year">Année</button>
			</div>
			<div class="btn-group" >		
				<button class="btn btn-warning active" data-calendar-view="month">Mois</button>
			</div>
			<div class="btn-group" >
				<button class="btn btn-warning" data-calendar-view="week">Semaine</button>
			</div>
			<div class="btn-group" >	
				<button class="btn btn-warning" data-calendar-view="day">Jour</button>
			</div>		
		</div>
	</div>
	</div>
			
		<div class="col-md-6" id="h3MoisAnnee">
			<h3 class=""></h3>
			<h4 class="" id="petitH4"></h4>
		</div>
	</div>	
	
	<div class="row">
		<div class="col-md-12">
			<div id="calendar"></div>
		</div>			
	</div>
	<div class="clearfix"></div>
	<div class="modal fade" id="events-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title">Event</h3>
				</div>
				<div class="modal-body" style="height: 400px">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	</div>	
</div>

<script type="text/javascript" src="API/bootstrap-calendar-master/js/app.js"></script>
</body>
</html>
