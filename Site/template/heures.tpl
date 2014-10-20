<html>
	<head>
		<meta charset="utf-8">
		<title>Mes heures</title>
		<link rel="stylesheet" href="API/bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/common.css"/>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
		<script type="text/javascript" src="js/filterTable2.js"></script>
		
			
	</head>
	
	<body>
		{include file='template/include/header.tpl'}
		
		<form name="form" id="form" action=""  method="get" >
			<input type="hidden" name="page" value="heure" />
			<label>Année scolaire :</label> 
			<select class="form-control" name="annee_scolaire">
				{foreach from=$annees item=annee}
					<option>{$annee}</option>
				{/foreach}
			</select><br>
		
			<label>Tri par Département :</label> 
			<select class="form-control" name="composante" onchange="document.form.submit();">
				<option value="all">TOUS</option>
				{foreach from=$composantes item=composante}
					<option {if $composante.codeComposante == $code}selected="selected"{/if} value="{$composante.codeComposante}">{$composante.nom}</option>
				{/foreach}
			</select></p><br>

			<label>Choix du professeur :</label> 
			<select multiple class="form-control" name="prof"  size="10">
				{foreach from=$allCSTeachers item=csTeacher}
					<option value="{$csTeacher.codeProf}">{$csTeacher.nom}   {$csTeacher.prenom}</option>
				{/foreach}
			</select><br>
			<button type="submit" class="btn btn-success">Envoyer</button>
		</form>
		
		<p style="text-align:center;"><span style="font-size:30px; font-weight:bold;">Liste de mes heures</span><br>
		<span style="font-size:15px; ">G&eacute;n&eacute;r&eacute; le <?php echo $jour;?>/<?php echo $mois; ?>/<?php echo $annee; ?> à <?php echo $heure; ?>h<?php echo $minute; ?></span><br></p>	



	
		<div class="table-responsive">
			<table class="table" id="mytable" >
				<thead>
					<tr>
						<th align="center" bgcolor="black" ><font color="white" >Formation</font></th>
						<th align="center" bgcolor="black" ><font color="white" >Code apog&eacute;e</font></th>
						<th align="center" bgcolor="black" ><font color="white" >Mati&egrave;re</font></th>
						<th align="center" bgcolor="black" ><font color="white" >Date</font></th>
						<th align="center" bgcolor="black" ><font color="white" >Heure d&eacute;but</font></th>
						<th align="center" bgcolor="black" ><font color="white" >Heure fin</font></th>
						<th align="center" bgcolor="black" ><font color="white" >Horaire r&eacute;parti / nb profs</font></th>
						<th align="center" bgcolor="black" ><font color="white" >Forfait</font></th>
						<th align="center" bgcolor="black" ><font color="white" >CR</font></th>
						<th align="center" bgcolor="black" ><font color="white" >TD</font></th>
						<th align="center" bgcolor="black" ><font color="white" >TP</font></th>
						<th align="center" bgcolor="black" ><font color="white" >EqTD</font></th>
						<th align="center" bgcolor="black" ><font color="white" >Effectué</font></th>
					</tr>
				</thead>
				<tbody> 
					 <tr>
						{foreach from=$allSeance item=seance}
							<td>{$seance.dateSeance}</td>
						{/foreach}
						
					 <td>3</td><td>13-10-2010</td><td>Low</td><td>6</td><td>49</td><td>293</td><td>1-10-2012</td><td>High</td><td>49</td><td>50</td><td>293</td><td>1-10-2012</td></tr>
				</tbody>

			</table>
		</div>
		
		{include file='template/include/footer.tpl'}

	</body>
		
</html>		