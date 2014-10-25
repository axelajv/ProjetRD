<html>
	<head>
		<meta charset="utf-8">
		<title>VT Calendar - Qui sommes nous</title>
		<link rel="stylesheet" href="API/bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/common.css"/>
		<link rel="stylesheet" href="css/infosDev.css"/>
		<script src="API/jquery/jquery.js"></script>
		<script type="text/javascript" src="API/bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="js/loadPage.js"></script>
	</head>
	
	<body>
		<div class="page-header">
				<h2>
					<a onClick="loadIndex()">
						<span class="glyphicon glyphicon-calendar"></span>
						VT CALENDAR 
					</a>
					<small>consultation des emplois du temps faits avec VT</small><br>
				</h2>
		</div>
		
		<div class="container">
			<!-- description du projet -->
			<h3>DESCRIPTION DU PROJET</h3>
			<p>Cet outil a été mis à jour par le biais d'un projet de master 2 MIAGE à l'université d'EVRY. L'objectif de ce projet était de faire une refonte graphique de VTCalendar afin de l'adapter aux téléphones et tablettes</p>
			<br><br><br>
			
			<!-- LISTE DES INTERVENANTS -->
			<h3>LISTE DES INTERVENANTS</h3>
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-example-generic" data-slide-to="1"></li>
					<li data-target="#carousel-example-generic" data-slide-to="2"></li>
					<li data-target="#carousel-example-generic" data-slide-to="3"></li>
					<li data-target="#carousel-example-generic" data-slide-to="4"></li>
					<li data-target="#carousel-example-generic" data-slide-to="5"></li>
					<li data-target="#carousel-example-generic" data-slide-to="6"></li>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<div class="item active">
					  <a><img src="img/infosDev/luis.jpg" class="img-responsive"></a>
					  <div class="carousel-caption">
						Bruno MILLION : co-créateur des versions antérieurs de VTCalendar
					  </div>
					</div>
					<div class="item">
					  <a><img src="img/infosDev/luis.jpg"></a>
					  <div class="carousel-caption">
						Gaëtan COLOMBIER : co-créateur des versions antérieurs de VTCalendar
					  </div>
					</div>
					<div class="item">
					  <a><img src="img/infosDev/luis.jpg"></a>
					  <div class="carousel-caption">
						Didier COURTAUD : responsable du projet VT2
					  </div>
					</div>
					<div class="item">
					  <a><img src="img/infosDev/luis.jpg"></a>
					  <div class="carousel-caption">
						Luis BRAGA : étudiant de l'université d'EVRY
					  </div>
					</div>
					<div class="item">
					  <a><img src="img/infosDev/edmond.jpg"></a>
					  <div class="carousel-caption">
						Edmond S'NADANE : étudiant de l'université d'EVRY
					  </div>
					</div>
					<div class="item">
					 <a><img src="img/infosDev/pieck.jpg"></a>
					  <div class="carousel-caption">
						Pierrick MOREAU : étudiant de l'université d'EVRY
					  </div>
					</div>
				</div>

				<!-- Controls -->
				<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
				</a>
				<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			</div>
		</div>
		
		{include file='template/include/footer.tpl'}
	</body>
</html>