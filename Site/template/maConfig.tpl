<html>
	<head>
		<meta charset="utf-8">
		<title>VT Calendar - Acceuil</title>
		<link rel="stylesheet" href="API/bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/common.css"/>
		<link rel="stylesheet" href="css/login.css"/>
		<script type="text/javascript" src="js/loadPage.js"></script>
	</head>
	<body>
		
		{include file='template/include/header.tpl'}
		<div class="container">
		<div class="col-md-4 col-centered">
			<div class="panel panel-default">
				<div class="panel-heading"> 
					<strong class="">Modifier votre configuration</strong>
				</div>
				<form class="form-horizontal" role="form" method="post" action="script/modifyConfig.php" onSubmit="return true;">
					<div class="form-group">
						<label for="weekend" class="col-sm-3 control-label">Weekend ?</label>
						<div class="col-sm-9">
							<select name="weekend" class="form-control" id="weekend" required="">
								<option>Samedi et dimanche</option>
								<option>Samedi</option>
								<option>Ni samedi ni dimanche</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="beginTime" class="col-sm-3 control-label">Heure début</label>
						<div class="col-sm-9">
							<select name="beginTime" class="form-control" id="beginTime" required="">
								{foreach from=$userConfs.listHeuresDebut item=heureDebut}
									<option value={$heureDebut.codeHeure}>{$heureDebut.heure}h{$heureDebut.minute}</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="endTime" class="col-sm-3 control-label">Heure fin</label>
						<div class="col-sm-9">
							<select name="endTime" class="form-control" id="endTime" required="">
								{foreach from=$userConfs.listHeuresFin item=heureFin}
									<option value={$heureFin.codeHeure}>{$heureFin.heure}h{$heureFin.minute}</option>
								{/foreach}
							</select>
						</div>
					</div>
					
					Bouton 1
					<div class="form-group">
						<label for="beginBtn1" class="col-sm-3 control-label">Début</label>
						<div class="col-sm-9">
							<select name="beginBtn1" class="form-control" id="beginBtn1" required="">
								{foreach from=$userConfs.listHeuresBouton item=heureBouton}
									<option value={$heureBouton.codeHeure}>{$heureBouton.heure}h{$heureBouton.minute}</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="endBtn1" class="col-sm-3 control-label">Fin</label>
						<div class="col-sm-9">
							<select name="endBtn1" class="form-control" id="endBtn1" required="">
								{foreach from=$userConfs.listHeuresBouton item=heureBouton}
									<option value={$heureBouton.codeHeure}>{$heureBouton.heure}h{$heureBouton.minute}</option>
								{/foreach}
							</select>
						</div>
					</div>
					
					Bouton 2
					<div class="form-group">
						<label for="beginBtn2" class="col-sm-3 control-label">Début</label>
						<div class="col-sm-9">
							<select name="beginBtn2" class="form-control" id="beginBtn2" required="">
								{foreach from=$userConfs.listHeuresBouton item=heureBouton}
									<option value={$heureBouton.codeHeure}>{$heureBouton.heure}h{$heureBouton.minute}</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="endBtn2" class="col-sm-3 control-label">Fin</label>
						<div class="col-sm-9">
							<select name="endBtn2" class="form-control" id="endBtn2" required="">
								{foreach from=$userConfs.listHeuresBouton item=heureBouton}
									<option value={$heureBouton.codeHeure}>{$heureBouton.heure}h{$heureBouton.minute}</option>
								{/foreach}
							</select>
						</div>
					</div>
					
					Bouton 3
					<div class="form-group">
						<label for="beginBtn3" class="col-sm-3 control-label">Début</label>
						<div class="col-sm-9">
							<select name="beginBtn3" class="form-control" id="beginBtn3" required="">
								{foreach from=$userConfs.listHeuresBouton item=heureBouton}
									<option value={$heureBouton.codeHeure}>{$heureBouton.heure}h{$heureBouton.minute}</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="endBtn3" class="col-sm-3 control-label">Fin</label>
						<div class="col-sm-9">
							<select name="endBtn3" class="form-control" id="endBtn3" required="">
								{foreach from=$userConfs.listHeuresBouton item=heureBouton}
									<option value={$heureBouton.codeHeure}>{$heureBouton.heure}h{$heureBouton.minute}</option>
								{/foreach}
							</select>
						</div>
					</div>
					
					Bouton 4
					<div class="form-group">
						<label for="beginBtn4" class="col-sm-3 control-label">Début</label>
						<div class="col-sm-9">
							<select name="beginBtn4" class="form-control" id="beginBtn4" required="">
								{foreach from=$userConfs.listHeuresBouton item=heureBouton}
									<option value={$heureBouton.codeHeure}>{$heureBouton.heure}h{$heureBouton.minute}</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="endBtn1" class="col-sm-3 control-label">Fin</label>
						<div class="col-sm-9">
							<select name="endBtn1" class="form-control" id="endBtn1" required="">
								{foreach from=$userConfs.listHeuresBouton item=heureBouton}
									<option value={$heureBouton.codeHeure}>{$heureBouton.heure}h{$heureBouton.minute}</option>
								{/foreach}
							</select>
						</div>
					</div>
					
					<div class="form-group last" id="teachButtons">
						<button type="submit" class="btn btn-success">Sauvegarder les modifications</button>
					</div>
				</form>
			</div>
		</div>
</div>
		{include file='template/include/footer.tpl'}
	
	</body>
</html>