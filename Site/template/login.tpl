<html>
	<head>
		<meta charset="utf-8">
		<title>VT Calendar - Login</title>
		<link rel="stylesheet" href="API/bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/common.css"/>
		<link rel="stylesheet" href="css/login.css"/>
		<script type="text/javascript" src="js/loadPage.js"></script>
	</head>
	<body>
		<div class="page-header">
			<h2><span class="glyphicon glyphicon-calendar"></span>
				VT CALENDAR 
				<small>consultation des emplois du temps faits avec VT</small><br>
			</h2>
		</div>
		<div id="loginTabContent" class="tab-content container">
			<ul id="myTab" class="nav nav-tabs col-md-4">
				<li class="active"><a href="#teachContainer" data-toggle="tab"><span class="glyphicon glyphicon-user"></span> Enseignant</a></li>
				<li><a href="#studyContainer" data-toggle="tab"><span class="glyphicon glyphicon-user"></span> Etudiant</a></li>
			</ul>

			{if isset($errorMsg)}
				<div class="alert alert-danger col-md-4 col-centered" role="alert">{$errorMsg}</div>
			{/if}

			{if isset($successMsg)}
				<div class="alert alert-success col-md-4 col-centered" role="alert">{$successMsg}</div>
			{/if}

			<div id="teachContainer" class="tab-pane fade in active">
				<div class="row">
					<div class="col-md-4 col-centered">
						<div class="panel panel-default">
							<div class="panel-heading">
								<strong class="">Planning des enseignants</strong>
							</div>
							<div class="panel-body">
								<form class="form-horizontal" role="form" method="post" action="script/teachConnectScript.php" onSubmit="return true;">
									<div class="form-group">
										<label for="inputLogin3" class="col-sm-3 control-label">Login</label>
										<div class="col-sm-9">
											<input type="text" name="teachLogin" class="form-control" id="inputLogin3" required="" placeholder="Login">
										</div>
									</div>
									<div class="form-group">
										<label for="inputPassword3" class="col-sm-3 control-label">Mdp</label>
										<div class="col-sm-9">
											<input type="password" name="teachPwd" class="form-control" id="inputPassword3" placeholder="Mot de passe" required="">
										</div>
									</div>

									<div class="form-group last" id="teachButtons">
										<button type="reset" class="btn btn-danger btn-sm col-md-6">Annuler</button>
										<button type="submit" class="btn btn-success btn-sm col-md-6">Valider</button>
									</div>
								</form>
							</div>
							<div class="panel-footer">
								<a role="button" class="btn" data-toggle="modal" data-target="#modifyMdp">Modifier le mot de passe</a>
								<a href="config/aide.pdf" role="button" class="btn" class="">Mode d'emploi</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="studyContainer" class="container tab-pane fade in">
				<div class="row">
					<div class="col-md-4 col-centered">
						<div class="panel panel-default">
							<div class="panel-heading"> <strong class="">Planning des étudiants</strong>

							</div>
							<div class="panel-body">
								<form class="form-horizontal" role="form" method="post" action="script/studyConnectScript.php" onSubmit="return true;">
									<div class="form-group">
										<label for="inputLoginEtudiant" class="col-sm-3 control-label">Login</label>
										<div class="col-sm-9">
											<input type="text" name="studyLogin" class="form-control" id="inputLoginEtudiant" required="" placeholder="Login">
										</div>
									</div>

									<div class="form-group last" id="studyButtons">
										<button type="reset" class="btn btn-danger btn-sm col-md-6">Annuler</button>
										<button type="submit" class="btn btn-success btn-sm col-md-6">Valider</button>
									</div>
								</form>
							</div>
							<div class="panel-footer">
								<a href="config/aide.pdf" class="">Mode d'emploi</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- POPUP MODAL DE MODIFICATION DE MOT DE PASSE -->
		<div class="modal fade" id="modifyMdp" tabindex="-1" role="dialog" aria-labelledby="modifyMdpLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<form class="form-horizontal" role="form" method="post" action="script/modifyMdp.php" onSubmit="return true;">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="modifyMdpLabel">Modification de mot de passe</h4>
				  </div>
				  <div class="modal-body">
						<div class="form-group">
							<label for="inputLogin" class="col-sm-3 control-label">Login</label>
							<div class="col-sm-9">
								<input type="text" name="loginTeach" class="form-control" id="inputLogin" placeholder="Login" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="inputOldPassword" class="col-sm-3 control-label">Ancien Mdp</label>
							<div class="col-sm-9">
								<input type="text" name="oldMdp" class="form-control" id="inputOldPassword" placeholder="Ancien Mot de passe" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="inputNewPassword1" class="col-sm-3 control-label">Nouveau Mdp</label>
							<div class="col-sm-9">
								<input type="password" name="newMdp1" class="form-control" id="inputNewPassword1" placeholder="Nouveau Mot de passe" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="inputNewPassword2" class="col-sm-3 control-label">Retappez Mdp</label>
							<div class="col-sm-9">
								<input type="password" name="newMdp2" class="form-control" id="inputNewPassword2" placeholder="Nouveau Mot de passe" required="">
							</div>
						</div>
					</form>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
					<button type="submit" class="btn btn-success">Valider</button>
				  </div>
				</div>
			</form>
		  </div>
		</div>

		{include file='template/include/footer.tpl'}

		<script src="API/jquery/jquery.js"></script>
		<script src="API/bootstrap/js/bootstrap.js"></script>
	</body>
</html>
