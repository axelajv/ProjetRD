<html>
	<head>
		<meta charset="utf-8">
		<title>Versions du site</title>
		<link rel="stylesheet" href="API/bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/common.css"/>
		<link rel="stylesheet" href="css/version.css"/>
		<script type="text/javascript" src="js/version.js"></script>
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
		<div class="panel panel-default">
		
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte79')">Version 6.0</a></h3>
			</div>
			<div class="panel-body"><span id="texte79" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Design et refonte de l'arbo en cours</li>
				</ul>

				<ul>
					<lh><em><strong>Inferface étudiant :</strong></em></lh>
					<li>Design et refonte de l'arbo en cours</li>
				</ul>			
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte78')">Version 5.1.9</a></h3>
			</div>
			<div class="panel-body"><span id="texte78" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Dans les infos-bulles des séances des profs, il y avait un problème entre la durée réelle d'une séance et la durée par défaut définie dans vt..</li>
						<li>Maintenant, les réservations privées s'affichent dans une couleur différente des réservations non privées.</li>
				</ul>			
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte77')">Version 5.1.8</a></h3>
			</div>
			<div class="panel-body"><span id="texte77" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Dans les infos-bulles des séances des profs, le noms du et des profs ont été ajoutés.</li>
				</ul>			
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte76')">Version 5.1.7</a></h3>
			</div>
			<div class="panel-body"><span id="texte76" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Dans le bilan des salles, ajout d'un colonne donnant le taux d'occupation annuel par salle.</li>
						<li>Dans le bilan des salles, correction du bug qui après un export excel continuait à générer des fichiers excel lorsqu'on changeait d'année.</li>
						<li>Correction de variables mal initialisées dans "dialogue de gestion" et dans "admin".</li>
				</ul>			
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte75')">Version 5.1.6</a></h3>
			</div>
			<div class="panel-body"><span id="texte75" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>Ajout de la possibilité de choisir dans le fichier config.php l'identifiant correspondant aux DS dans la base de données de VT.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Dans le bilan des salles, le graphique du taux d'occupation des salles par zone se fait maintenant sur une base de 1120h/an au lieu de 1400h comme ce qui est demandé lors des enquêtes nationales.</li>
						<li>Dans le fichier config.php, on peut maintenant faire en sorte qu'une réservation privée soit totalement invisible par les autres profs au lieu de marquer "privé" sur la réservation.</li>
				</ul>				
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte74')">Version 5.1.5</a></h3>
			</div>
			<div class="panel-body"><span id="texte74" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Export Giseh (uniquement pour l'université Paris10). Le code de la composante n'apparaissait pas à chaque fois pour certains enseignements au forfait.</li>
				</ul>			
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte73')">Version 5.1.4</a></h3>
			</div>
			<div class="panel-body"><span id="texte73" style="visibility: hidden; display: none;">
				<ul>
					<li>Il faut ajouter le champ "dialogue" en int(2) dans la table "login_prof" avec 0 comme valeur par défaut.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Export Giseh (uniquement pour l'université Paris10). Les cours au forfait apparaissaient sous forme de TD.</li>
						<li>Dialogue de gestion (uniquement pour l'université Paris10). Ajout de l'interface qui calcule les données nécessaires au dialogue de gestion avec l'université.</li>
						<li>Lorsqu'on triait les salles par composante, il y avait un petit bug et les salles n'apparaissaient pas dans la liste déroulante.</li>
				</ul>			
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte72')">Version 5.1.3</a></h3>
			</div>
			<div class="panel-body"><span id="texte72" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Dans "mes heures", lorsqu'on a le droit de voir les heures des autres profs le changement de prof ne se fait plus de manière automatique mais en appuyant sur le bouton "envoyer"</li>
						<li>Export Giseh (uniquement pour l'université Paris10). Si le dernier enseignement du dernier prof du tableau n'avait qu'une seule séance, celle-ci n'apparaissait pas et les heures étaient reportées sur la ligne précédente.</li>
				</ul>			
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte71')">Version 5.1.2</a></h3>
			</div>
			<div class="panel-body"><span id="texte71" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>Si on n'est pas sur la semaine courante un dimanche soir et qu'on appuie sur le bouton "retour à la semaine courante" le lundi, on tombe maintenant sur la nouvelle semaine et non sur la semaine passée.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Si on n'est pas sur la semaine courante un dimanche soir et qu'on appuie sur le bouton "retour à la semaine courante" le lundi, on tombe maintenant sur la nouvelle semaine et non sur la semaine passée.</li>
				</ul>				
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte70')">Version 5.1.1</a></h3>
			</div>
			<div class="panel-body"><span id="texte70" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Suite a la disparition du champ "affectation" dans la table "ressources_profs", le pré-tri des profs se fait maintenant uniquement avec les composantes.</li>
				</ul>			
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte69')">Version 5.1.0</a></h3>
			</div>
			<div class="panel-body"><span id="texte69" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Ajout d'une interface "Gestion des droits" qui permet à l'administrateur de définir les droits de chaque utilisateur.</li>
				</ul>			
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte68')">Version 5.0.9</a></h3>
			</div>
			<div class="panel-body"><span id="texte68" style="visibility: hidden; display: none;">
				<ul>
					<li>Il faut ajouter le champ "mes_droits" en int(2) dans la table "login_prof" avec 1 comme valeur par défaut.</li>
					<li>Il faut ajouter le champ "admin" en int(2) dans la table "login_prof" avec 0 comme valeur par défaut.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Ajout d'une interface "Mes droits" qui permet aux utilisateurs de voir les droits qu'ils ont.</li>
				</ul>			
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte67')">Version 5.0.8</a></h3>
			</div>
			<div class="panel-body"><span id="texte67" style="visibility: hidden; display: none;">
				<ul>
					<li>Il y avait un petit problème d'affichage sur la page d'accueil depuis la version 7 de firefox qui a été corrigé.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>Il y a maintenant une vue verticale, horizontale, mensuelle, mensuelle réduite et journalière.</li>
				</ul>			
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte66')">Version 5.0.7</a></h3>
			</div>
			<div class="panel-body"><span id="texte66" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>Création d'un outil "Mes DS" qui permet aux étudiants d'avoir une liste de leurs DS.</li>
				</ul>			
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte65')">Version 5.0.6</a></h3>
			</div>
			<div class="panel-body"><span id="texte65" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Quand on est dans "Mes modules", "Mes heures", "Bilan par formation"... et qu'on se fait déconnecter par le serveur, il y a maintenant un lien qui s'affiche pour revenir à la page principale.</li>
						<li>Dans "Mes heures", il y a maintenant la somme des heures effectuées en bas du tableau.</li>
						<li>Dans "Mes heures, il y a maintenant un graphique qui représente l'évolution des heures au cours de l'année.</li>
						<li>Dans "Occupation des salles", il y a maintenant un graphique qui représente le taux d'occupation des salles en fonction des zones.</li>
				</ul>			
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte64')">Version 5.0.5</a></h3>
			</div>
			<div class="panel-body"><span id="texte64" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Ajout d'une vue mensuelle où on voit le détail des séances. L'ancienne vue mensuelle s'appelle maintenant "vue mensuelle réduite".</li>
						<li>Dans le bilan par formation et dans le bilan "giseh", les vacataires et les titulaires sont distingués à l'aide du champ "titulaire" de la table "ressource_profs".</li>
				</ul>			
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte63')">Version 5.0.4</a></h3>
			</div>
			<div class="panel-body"><span id="texte63" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Dans la vue mensuelle, quand on choisissait par exemple la semaine 44 de 2011, elle ne s'affichait pas.</li>
				</ul>			
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte62')">Version 5.0.3</a></h3>
			</div>
			<div class="panel-body"><span id="texte62" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Il est maintenant possible de choisir avec quoi on filtre les groupes, les profs et les salles (niveau, diplome, composante, zone...). Ceci se fait dans le fichier config.php.</li>
				</ul>			
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte61')">Version 5.0.2</a></h3>
			</div>
			<div class="panel-body"><span id="texte61" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Avec le login perso, si on n'a pas le droit de se mettre des rendez-vous perso, les boutons permettant de définir l'heure de début et de fin des raccourcis dans "ma config" sont maintenant cachés.</li>
						<li>Les champs permettant de choisir la semaine et l'année ont été déplacés pour gagner un peu de place.</li>
						<li>Lors de l'export pdf de la vue mensuelle, si la date de début était durant la dernière semaine du mois, il y avait un problème d'affichage.</li>
				</ul>			
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte60')">Version 5.0.1</a></h3>
			</div>
			<div class="panel-body"><span id="texte60" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Lors d'un export PDF, les dates de début et de fin correspondent maintenant aux dates du planning visualisé.</li>
						<li>Lors d'un conflit, la taille du rectangle noir est maintenant fonction du nombre de lignes à afficher.</li>
				</ul>			
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte59')">Version 5.0.0</a></h3>
			</div>
			<div class="panel-body"><span id="texte59" style="visibility: hidden; display: none;">
				<ul>
					<li>Il faut ajouter le champ "selecMateriel" en varchar(45) dans la table "login_prof".</li>
					<li>Il faut ajouter les champs "couleur_groupe","couleur_prof", "couleur_salle" et "couleur_materiel" en int(3) dans la table "login_prof".</li>
				</ul>
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Quand on affiche le planning d'un groupe, quand celui-ci est en "congé", on voit maintenant le type de congé : examen, entreprise/stage et congé.</li>
						<li>Dans "Mes heures", il est maintenant possible de définir la répartition cours, td et tp de chaque type d'enseignement de VT. Cela se fait dans le fichier config.php.</li>
						<li>Maintenant, on peut afficher le planning du matériel.</li>
						<li>Dans "ma config", on peut choisir pour chaque ressource (salle, groupe, prof et materiel) la couleur à associer à la séance (groupe, prof ou matiere).</li>
						<li>Dans mes modules, on a maintenant le matériel associé aux séances.</li>
						<li>Ajout du script pour générer les fichiers ics du matériel.</li>
						<li>Dans la vue verticale avec plusieurs ressources, quand on cliquait sur le bouton "Retour à la semaine actuelle" qui était en bas du planning, la largeur et la hauteur de l'écran n'étaient plus pris en compte lors de l'affichage du planning de la semaine courante.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>On voit maintenant le type de congé : examen, entreprise/stage et congé.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte58')">Version 4.4.8</a></h3>
			</div>
			<div class="panel-body"><span id="texte58" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Lors de la génération d'un pdf, le nom du fichier comporte le type de vue utilisé et les heures et les minutes ont été supprimées.</li>
						<li>Avant de générer un pdf, la page de choix des dates indique maintenant si les conflits et les réservations risquent d'être masqués si les cases "masquer les problèmes" et "masquer les RDV" sont cochées.</li>
						<li>Lors de l'export pdf du planning mensuel d'une seule ressource, l'intitulé des séances et des réservations apparait.</li>
				</ul>			
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte57')">Version 4.4.7</a></h3>
			</div>
			<div class="panel-body"><span id="texte57" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Le menu du haut lors d'un export pdf avec le login générique ne fonctionnait pas correctement. C'est corrigé.</li>
						<li>Tous les CSS de la mise en page se trouvent maintenant dans le répertoire "css" au lieu d'être inclus dans chaque fichier php.</li>
						<li>La largeur des listes de choix est maintenant fixe. Elle peut être modifiée dans le fichier "css/index.css".</li>
				</ul>			
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte56')">Version 4.4.6</a></h3>
			</div>
			<div class="panel-body"><span id="texte56" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Maintenant, quand plusieurs séances sont superposées, dès qu'on passe la souris sur les séances une info-bulle apparait avec la liste de toutes les séances superposées.</li>
						<li>Lors d'un export PDF, le nom de la vue que l'on souhaite exporter apparait sur la page où on choisit les dates de début et de fin de l'export.</li>
						<li>Lors d'un export PDF, le nom du fichier est fonction des ressources sélectionnées.</li>
						<li>Avec le login perso, si l'utilisateur n'avait pas défini une autre heure que l'heure de début et de fin par défaut, la génération des pdf plantait.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>Lors d'un export PDF, le nom du fichier correspond au nom de l'étudiant.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte55')">Version 4.4.5</a></h3>
			</div>
			<div class="panel-body"><span id="texte55" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Dans le bilan par formation, il est maintenant possible de définir la répartition cours, td et tp de chaque type d'enseignement de VT. Cela se fait dans le fichier config.php. La même chose sera faite bientôt dans le bilan "mes heures".</li>
				</ul>			
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte54')">Version 4.4.4</a></h3>
			</div>
			<div class="panel-body"><span id="texte54" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Ajout de la possibilité de choisir l'année scolaire dans "Mes modules" quand on a plusieurs bases de données.</li>
						<li>Ajout de la possibilité de choisir l'année scolaire dans "Mes heures" quand on a plusieurs bases de données.</li>
						<li>Quand on clique sur une séance, l'interface choisit maintenant la bonne base de données et non plus uniquement la dernière. </li>
				</ul>
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>Ajout de la possibilité de choisir l'année scolaire dans "Mes modules" quand on a plusieurs bases de données.</li>
						<li>Quand on clique sur une séance, l'interface choisit maintenant la bonne base de données et non plus uniquement la dernière.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte53')">Version 4.4.3</a></h3>
			</div>
			<div class="panel-body"><span id="texte53" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Le passage d'une année à l'autre avec les flèches permettant de se déplacer de mois en mois ne fonctionnait pas. C'est corriger.</li>
						<li>Ajout de la possibilité de colorier les séances avec la couleur associée aux profs dans VT. Le choix se fait dans le fichier config.php.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>Le passage d'une année à l'autre avec les flèches permettant de se déplacer de mois en mois ne fonctionnait pas. C'est corriger.</li>
						<li>Ajout de la possibilité de colorier les séances avec la couleur associée aux profs dans VT. Le choix se fait dans le fichier config.php.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte52')">Version 4.4.2</a></h3>
			</div>
			<div class="panel-body"><span id="texte52" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Possibilité d'afficher soit le nom soit l'alias des enseignements.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>Possibilité d'afficher soit le nom soit l'alias des enseignements.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte51')">Version 4.4.1</a></h3>
			</div>
			<div class="panel-body"><span id="texte51" style="visibility: hidden; display: none;">
				<ul>
					<li>Ajout d'un champ "salle" en int(2) avec une valeur par défaut de 0 pour autoriser ou non l'utilisation du bilan de l'occupation des salles.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Ajout du bilan d'occupation des salles.</li>
						<li>Possibilité d'afficher soit le nom soit l'alias des salles.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte50')">Version 4.4.0</a></h3>
			</div>
			<div class="panel-body"><span id="texte50" style="visibility: hidden; display: none;">
				<ul>
					<li>Ajout d'un champ "giseh" en int(2) avec une valeur par défaut de 0 pour que la version de l'interface web disponible sur le site de VT soit la même que celle utilisée dans mon université. Ce champ sert à activer un bilan des heures pour les exporter vers le logiciel Giseh. Si vous n'avez pas ce logiciel, il faut laisser ce champ à 0 pour tous vos utilisateurs.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Ajout d'un paramètre dans config.php afin de définir le fuseau horaire. Cela permet de mettre la bonne heure dans le champ "dateModif" lors de la création d'une réservation au lieu de l'heure GMT+0.</li>
						<li>Ajout d'un paramètre dans config.php afin de choisir si la couleur des séances correspond à la couleur des groupes dans vt ou à la couleur des matières.</li>
						<li>Dans "Bilan par formation", j'ai ajouté en fin de tableau la somme totale des heures faites.</li>
						<li>Dans "Bilan par formation", j'ai séparé les heures des titulaires des heures des vacataires.</li>
						<li>Ajout de flèches supplémentaires pour se déplacer de mois en mois</li>
				</ul>
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>Ajout de flèches supplémentaires pour se déplacer de mois en mois.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte49')">Version 4.3.9</a></h3>
			</div>
			<div class="panel-body"><span id="texte49" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Le flux RSS a été revu. Maintenant, les changements de prof, de salle et de groupe sont pris en compte.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>Le flux RSS a été revu. Maintenant, les changements de prof, de salle et de groupe sont pris en compte.</li>
						<li>La création du cookie pour rester connecté est réparée.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte48')">Version 4.3.8</a></h3>
			</div>
			<div class="panel-body"><span id="texte48" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Amélioration de la mise en page et ajout d'un menu.</li>
						<li>Dans la vue horizontale, quand une séance ou une réservation ont une durée inférieure à 1h, le bandeau du haut et les arrondis sont réduits pour laisser plus de place au texte.</li>
						<li>Dans la vue verticale mono-ressource, le bandeau du haut et les arrondis de chaque séance et réservation sont légèrement plus petits pour gagner un peu de place.</li>
						<li>La légende en bas de page a été revue.</li>
						<li>Dans "mes heures", ajout de la possibilité de faire un tri par code apogée.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>Amélioration de la mise en page et ajout d'un menu.</li>
						<li>Quand une séance ou une réservation ont une durée inférieure à 1h, le bandeau du haut et les arrondis sont réduits pour laisser plus de place au texte.</li>
						<li>La légende en bas de page a été revue.</li>
						<li>Ajout de "Mes modules" pour les étudiants.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface smartphone :</strong></em></lh>
						<li>Le rayon des arrondis a été légèrement réduit pour gagner un peu de place.</li>
						<li>Les horaires de début et de fin de chaque séance ou réservation sont mieux centrés</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte47')">Version 4.3.7</a></h3>
			</div>
			<div class="panel-body"><span id="texte47" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Affichage des jours fériés qui sont définis au niveau de la filière.</li>
						<li>Dans la vue "jour J", les vacances des anciennes bases de données sont maintenant affichées.</li>
						<li>Dans "Mes modules", quand il y a plusieurs ressources associées à une séance, elles sont maintenant classées dans l'ordre alphabétique.</li>
						<li>Quand on utilisait le login générique et qu'on souhaitait visualiser une semaine contenant un rendez-vous marqué comme "privé" et que le serveur est configuré pour afficher les erreurs, le planning ne s'affichait pas. C'est corrigé.</li>
						<li>Si dans une séance il y a plusieurs profs, plusieurs salles ou plusieurs groupes, ils sont maintenant classés dans l'ordre alphabétique.</li>
						<li>Dans "Mes heures", il y a une nouvelle colonne "Effectué" afin de savoir quelles sont les séances qui sont déjà passées.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>Affichage des jours fériés qui sont définis au niveau de la filière.</li>
						<li>Dans "Mes modules", quand il y a plusieurs ressources associées à une séance, elles sont maintenant classées dans l'ordre alphabétique.</li>
						<li>Si dans une séance il y a plusieurs profs ou plusieurs salles, ils sont maintenant classés dans l'ordre alphabétique.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface smartphone :</strong></em></lh>
						<li>Affichage des jours fériés qui sont définis au niveau de la filière.</li>
						<li>Les cases des séances et des réservations ont maintenant les coins arrondis comme dans l'interface classique.</li>
						<li>Dans la vue des profs, l'intitulé des séances n'était pas en gras.</li>
						<li>Quand une salle était associée à une réservation, la salle n'apparaissait pas. C'est corrigé.</li>
						<li>Quand on utilisait le login générique et qu'on souhaitait visualiser une semaine contenant un rendez-vous marqué comme "privé" et que le serveur est configuré pour afficher les erreurs, le planning ne s'affichait pas. C'est corrigé.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte46')">Version 4.3.6</a></h3>
			</div>
			<div class="panel-body"><span id="texte46" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Dans "Ma config", on peut maintenant choisir les heures de début et de fin de chacun des 4 boutons de raccourci pour les horaires des réservations. IL NE FAUT PAS OUBLIER D'AJOUTER 8 CHAMPS (bouton1Debut, bouton1Fin...) DANS LA TABLE LOGIN_PROF (Cf. lisezmoi.txt) !!!</li>
						<li>Dans "Mes modules", ajout d'un tiret pour séparer le nom des profs quand il y a plusieurs profs associés à une séance.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte45')">Version 4.3.5</a></h3>
			</div>
			<div class="panel-body"><span id="texte45" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Lors que la croix permettant de modifier ou de supprimer une réservation se trouvait superposée à une séance, elle n'était pas cliquable. C'est corrigé.</li>
						<li>Le pré-tri des groupes se fait avec les "niveaux" qui sont associés aux groupes dans "groupes/ajouter modifier détruire" dans VT.</li>
						<li>Quand on laisse la souris quelques secondes sur une séance, l'intitulé complet de la séance apparait dans une info-bulle.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>Quand on clique sur une séance, on obtient le détail de l'ensemble des séances de l'enseignement.</li>
						<li>Quand on laisse la souris quelques secondes sur une séance, l'intitulé complet de la séance apparait dans une info-bulle.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte44')">Version 4.3.4</a></h3>
			</div>
			<div class="panel-body"><span id="texte44" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>La liste des profs était visible quand on tapait l'url des fonctions "mes modules" et "mes heures" en étant déconnecté. Maintenant, il y a une page blanche.</li>
						<li>Quand une salle est associée à une réservation pour un groupe ou un prof, le nom de la salle est maintenant affiché.</li>
						<li>Le texte des réservations est mieux centré verticalement.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte43')">Version 4.3.3</a></h3>
			</div>
			<div class="panel-body"><span id="texte43" style="visibility: hidden; display: none;">
				<ul>
					<li>Amélioration des générateurs de logins et de mots de passe pour les étudiants et les profs. Maintenant, les espaces, les tirets et les apostrophes sont supprimées lors de la génération.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Quand un rendez-vous perso et une séance avaient la même heure de début, la croix permettant de modifier ou de supprimer le rendez-vous perso n'était pas cliquable. C'est corrigé.</li>
						<li>Dans "Bilan par formation", la date de la génération n'était pas la bonne pour la deuxième année scolaire et les suivantes.</li>
						<li>Dans les différents bilans, les forfaits de plus de 100h étaient mal comptabilisés.</li>
				</ul>	
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte42')">Version 4.3.2</a></h3>
			</div>
			<div class="panel-body"><span id="texte42" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Dans "Mes modules", suppression du trait rouge de séparation entre les séances passées et les séances futures et ajout d'une nouvelle colonne "Effectuée" pour savoir si une séance a déjà été faite ou non.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte41')">Version 4.3.1</a></h3>
			</div>
			<div class="panel-body"><span id="texte41" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>La balise <*map*> n'était pas toujours fermée. C'est corrigé.</li>
						<li>Avec le login et le mot de passe perso, on peut maintenant cliquer sur n'importe quelle séance afin d'afficher le détail du module auquel appartient celle-ci. L'administrateur peut activer ou non cette fonction pour chaque utilisateur. IL NE FAUT PAS  OUBLIER D'AJOUTER 1 CHAMP DANS LA TABLE LOGIN_PROF (Cf. lisezmoi.txt) !!!</li>
						<li>Dans "mes modules" quand on faisait un classement par prof, par groupe, par type ou par salle, le prof sélectionné dans la liste déroulante changeait pour devenir l'utilisateur au lieu de rester sur le prof sélectionné au départ. C'est corrigé.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte40')">Version 4.3</a></h3>
			</div>
			<div class="panel-body"><span id="texte40" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Dans "Bilan par formation", quand il n'y avait que des enseignements au forfait durant une année scolaire, le tableau s'affichait mal. C'est corrigé.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte39')">Version 4.2.9</a></h3>
			</div>
			<div class="panel-body"><span id="texte39" style="visibility: hidden; display: none;">
				<ul>
					<li>Correction des erreurs de syntaxe HTML afin de passer le test w3c sur toutes les pages sauf celles de l'interface Smartphone (prévu pour bientôt).</li>
				</ul>
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Dans "Mes heures", il y avait un bug d'affichage quand on sélectionnait un prof qui n’a aucune séance.</li>
						<li>La mise en page du menu de "Mes modules" a été corrigée pour être identique aux autres.</li>
						<li>Dans "Mes modules", il y avait une variable mal initialisée.</li>
						<li>Dans "Mes modules", lors du classement chronologique, la séparation entre les séances passées et les séances futures se fait par un trait ROUGE. Pour les autres types de classement, la séparation entre les ressources se fait avec un trait BLEU.</li>
						<li>Limitation à 2 chiffres du numéro de la semaine et à 4 chiffres pour l'année dans les champs "semaine" et "année".</li>
						<li>Dans "Ma config", il manquait des sauts de lignes pour avoir la même mise en page que les autres fonctions (Mes heures, Mes modules...).</li>
				</ul>
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>Limitation à 2 chiffres du numéro de la semaine et à 4 chiffres pour l'année dans les champs "semaine" et "année".</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte38')">Version 4.2.8</a></h3>
			</div>
			<div class="panel-body"><span id="texte38" style="visibility: hidden; display: none;">
				<ul>
					<li>Correction d'une variable utilisée pour les cookies mal initialisée.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Ajout d'un bouton pour le flux RSS car dans Firefox 4 le flux RSS n'est plus accessible dans la barre d'adresse.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>Transformation du lien du flux RSS en un bouton à côté de l'export PDF pour gagner un peu de place.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte37')">Version 4.2.7</a></h3>
			</div>
			<div class="panel-body"><span id="texte37" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Ajout de la possibilité de faire un export PDF avec le login et le mot de passe générique des profs. On peut activer ou désactiver cette possibilité dans le fichier config.php.</li>
						<li>Ajout de la possibilité d'ajouter un titre lors de la génération des fichiers pdf.</li>
						<li>Avec le login et le mot de passe persos, prise en compte de l'affichage du samedi et du dimanche ainsi que de l'heure personnalisée dans les exports PDF.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte36')">Version 4.2.6</a></h3>
			</div>
			<div class="panel-body"><span id="texte36" style="visibility: hidden; display: none;">
				<ul>
					<li>Ajout de la possibilité de sauvegarder un cookie pour rester connecté. Dès qu'on appuie sur "Se déconnecter", le cookie est supprimé.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Ajout d'un export PDF de l'emploi du temps. L'administrateur peut activer ou non cette fonction pour chaque utilisateur. IL NE FAUT PAS OUBLIER D'AJOUTER 1 CHAMP DANS LA TABLE LOGIN_PROF (Cf. lisezmoi.txt) !!!</li>
				</ul>
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>Ajout d'un export PDF de l'emploi du temps.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte35')">Version 4.2.5</a></h3>
			</div>
			<div class="panel-body"><span id="texte35" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Bouton "Mes Modules" : ajout de la possibilité de faire des tris en fonction des groupes, des salles, des profs, des types et de la date. Pour cela, il faut cliquer sur l'intitulé des colonnes du tableau.</li>
						<li>Vue "Jour J" : ajout de la possibilité de changer de jour.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte34')">Version 4.2.4</a></h3>
			</div>
			<div class="panel-body"><span id="texte34" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>L'administrateur peut activer ou non le bilan des heures par formation. IL NE FAUT PAS OUBLIER D'AJOUTER 1 CHAMP DANS LA TABLE LOGIN_PROF (Cf. lisezmoi.txt) !!!</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte33')">Version 4.2.3</a></h3>
			</div>
			<div class="panel-body"><span id="texte33" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>L'administrateur peut maintenant activer ou non pour certains utilisateurs un bilan des heures où on peut choisir le prof dont on veut faire le bilan. IL NE FAUT PAS OUBLIER D'AJOUTER 1 CHAMP DANS LA TABLE LOGIN_PROF (Cf. lisezmoi.txt) !!!</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte32')">Version 4.2.2</a></h3>
			</div>
			<div class="panel-body"><span id="texte32" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>L'administrateur peut maintenant activer ou non la possibilité de mettre des réservations, l'affichage des boutons "Mes modules", "Mes heures" et "Ma config" et le flux RSS. IL NE FAUT PAS OUBLIER D'AJOUTER 3 CHAMPS DANS LA TABLE LOGIN_PROF (Cf. lisezmoi.txt) !!!</li>
						<li>Dans la vue mensuelle, les vacances de la dernière semaine du mois étaient affichées l'avant dernière semaine. C'est corrigé.</li>
						<li>Dans la vue mensuelle, les vacances du dernier dimanche du mois n'étaient pas affichées. C'est corrigé.</li>
						<li>Quand on a plusieurs bases de données, les vacances des bases des années précédentes s'affichent dorénavant.</li>
						<li>Avec le login et le mot de passe perso, quand on se déloguait, le flux RSS était toujours disponible.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte31')">Version 4.2.1</a></h3>
			</div>
			<div class="panel-body"><span id="texte31" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Dans certains cas, l'affichage des conflits des groupes faisait planter l'interface. C'est maintenant corrigé.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte30')">Version 4.2</a></h3>
			</div>
			<div class="panel-body"><span id="texte30" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Dans la vue mensuelle, la pause de midi est maintenant visible.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte29')">Version 4.1.9</a></h3>
			</div>
			<div class="panel-body"><span id="texte29" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Maintenant, quand on visualise le planning d'un groupe, les séances et les réservations placées aux groupes de niveaux inférieurs sont visibles.</li>
						<li>Ajout du bouton "Mon planning" qui permet de revenir à l'affichage de son propre emploi du temps lorsque d'autres groupes, salles ou profs ont été sélectionnés. Marche uniquement avec le login et le mot de passe perso.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte28')">Version 4.1.8</a></h3>
			</div>
			<div class="panel-body"><span id="texte28" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>La croix à côté de l'horaire des rendez-vous persos permettant de les modifier ou de les supprimer apparaissait sur les réservations enregistrées dans les bases de données des années scolaires précédentes. Celle-ci a été effacée car on ne peut modifier ou supprimer que les réservations de la base de données de l'année scolaire en cours.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>Prise en compte de la diffusabilité des séances. Si une séance est marquée comme "non diffusable" dans VT, elle ne s'affichera pas sur le planning des étudiants. Inversement, si elle est marquée comme "diffusable", elle s'affichera sur le planning des étudiants. L'activation ou non de cette fonction se fait dans le fichier config.php</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte27')">Version 4.1.7</a></h3>
			</div>
			<div class="panel-body"><span id="texte27" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Page de Login :</strong></em></lh>
						<li>Maintenant, les logins génériques et persos des profs sont insensibles aux majuscules. En effet, les iPhones ajoutent par défaut des majuscules à la première lettre du login et cela faisait planter l'interface. Par contre, le mot de passe est toujours sensible aux majuscules.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte26')">Version 4.1.6</a></h3>
			</div>
			<div class="panel-body"><span id="texte26" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Quand on utilise son login et son mot de passe perso pour la première fois, l'heure de début et de fin du planning n'étaient pas les bonnes. Pour corriger le problème, il faut changer les valeurs par défaut dans la table login_prof au niveau des champs heureDebut et heureFin afin de mettre la valeur 0 au lieu de 8 et 19.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte25')">Version 4.1.5</a></h3>
			</div>
			<div class="panel-body"><span id="texte25" style="visibility: hidden; display: none;">
				<ul>
					<li>Ajout de la possibilité de changer le titre de la fenêtre depuis le fichier config.php</li>
				</ul>
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>La liste de pré-tri des salles ne s'affichait pas dans l'ordre alphabétique. C'est maintenant corrigé.</li>
						<li>Quand on cliquait sur la croix pour modifier une réservation, la date et l'heure de la réservation n'étaient pas les bonnes.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte24')">Version 4.1.4</a></h3>
			</div>
			<div class="panel-body"><span id="texte24" style="visibility: hidden; display: none;">
				<ul>
					<li>Si l'heure de début de journée n'était pas un nombre entier, l'interface n'affichait pas les séances de début de journée.</li>
					<li>Certaines requêtes étaient mal interprétées avec les vielles versions de MySQL. Elles ont été améliorées.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Si l'heure de début de journée n'était pas un nombre entier, il y avait un problème d'affichage dans le choix des heures de début et de fin des réservations.</li>
						<li>Si l'heure de début de journée n'était pas un nombre entier, il y avait un problème d'affichage dans le choix des heures de début et de fin de journée dans "Ma config".</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte23')">Version 4.1.3</a></h3>
			</div>
			<div class="panel-body"><span id="texte23" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Dans "Mes heures", les durées forfaitaires de 0h généraient une erreur qui a été corrigée.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte22')">Version 4.1.2</a></h3>
			</div>
			<div class="panel-body"><span id="texte22" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Avec JavaScript désactivé, il était possible de placer une réservation avec une date dans un mauvais format (exemple : 35/13/2010) et cela faisait planter VT. Maintenant, l'interface détecte si JavaScript est activé et si ce n'est pas le cas, on ne peut plus placer de réservations.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte21')">Version 4.1.1</a></h3>
			</div>
			<div class="panel-body"><span id="texte21" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Ajout de la possibilité d'activer ou de désactiver le message "pas de salle" quand aucune salle n'est affectée à une séance depuis le fichier config.php.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte20')">Version 4.1</a></h3>
			</div>
			<div class="panel-body"><span id="texte20" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Ajout du bouton "Ma config" qui permet de modifier l'heure de début et de fin des journées ainsi que de choisir si on veut afficher le samedi et le dimanche. Ne fonctionne que si on utilise son login perso.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte19')">Version 4.0.2</a></h3>
			</div>
			<div class="panel-body"><span id="texte19" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Lorsque des séances étaient annulées, l'affichage du planning plantait. C'est corrigé.</li>
						<li>Lorsqu'une séance est annulée, un message est maintenant affiché sur la séance.</li>
						<li>Les séances non comptabilisées et les séances annulées ne sont plus prises en compte dans "Mes heures".</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte18')">Version 4.0.1</a></h3>
			</div>
			<div class="panel-body"><span id="texte18" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Ajout de la possibilité de configurer dans config.php l'ajout ou non du mot "Salle :" devant le nom des salles inscrits sur les séances.</li>
						<li>Ajout de la possibilité de configurer dans config.php le nombre de caractères à afficher pour les salles dont le nom est inscrit sur les séances.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>Ajout de la possibilité de configurer dans config.php l'ajout ou non du mot "Salle :" devant le nom des salles inscrits sur les séances.</li>
						<li>Ajout de la possibilité de configurer dans config.php le nombre de caractères à afficher pour les salles dont le nom est inscrit sur les séances.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte17')">Version 4.0</a></h3>
			</div>
			<div class="panel-body"><span id="texte17" style="visibility: hidden; display: none;">
				<ul>
					<li>Adaptation des scripts à la nouvelle version de VT.</li>
					<li>La page de login a été améliorée.</li>
					<li>Suppression de toutes les erreurs de syntaxe en php.</li>
					<li>Suppression des erreurs de syntaxe en html afin d'être conforme à la norme W3C.</li>
					<li>Les heures de début et de fin de journée sont réglables directement depuis le fichier config.php</li>
					<li>Les heures de début et de fin de la pause de midi sont réglables directement depuis le fichier config.php</li>
				</ul>
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Dans l'affichage du planning des salles, quand il y avait plusieurs profs associés à une séance, le texte n'était pas centré verticalement dans la case de la séance.</li>
						<li>Dans la vue mensuelle, les info-bulles pour les réservations des groupes de niveaux supérieurs ne fonctionnait pas. Par exemple, une réservation au niveau d'un groupe de TD n'apparaissait pas quand on visualisait le groupe de TP. C'est corrigé.</li>
						<li>Correction d'une faille de sécurité dans la suppression des rendez-vous.</li>
						<li>Dans "Mes modules...", on peut maintenant choisir n'importe quel prof.</li>
						<li>Avec Internet explorer, quand le filtre des groupes était sur "Tous", le filtre des profs se retrouvait aussi sur "Tous" en plus du filtre choisi.</li>
						<li>Ajout de "Mes heures..." afin que les profs puissent voir le bilan de leurs heures. La colonne "Code apogée" correspond au champ "identifiant" des enseignements dans VT.</li>
						<li>Dans "Mes heures.." ajout d'un bouton de tri qui classe les séances par ordre chronologique ou par matière.</li>
						<li>Dans "Mes heures..." ajout d'un export vers excel des bilans des heures.</li>
						<li>Il n'y a plus besoin d'appuyer sur "envoyer" quand on change de type de vue ou qu'on cache les rendez-vous ou les problèmes. Ca marche pour tous les navigateurs sauf internet explorer qui ne respecte pas les standards du web.</li>
						<li>Dans "Mes modules", l'interface ne faisait pas la différence entre un enseignement qui s'appelait par exemple "GMP1_AUTOM" et un autre qui s'appelait "GMP1_AUTOMATISATION" et les séances des deux enseignements se trouvaient mélangées quand on visualisait le module "GMP1_AUTOM". C'est corrigé.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte16')">Version 3.1.3</a></h3>
			</div>
			<div class="panel-body"><span id="texte16" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Dans le flux RSS, l'heure des modifications était donnée en GMT+0. Elle est maintenant donnée en GMT+1.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>Dans le flux RSS, l'heure des modifications était donnée en GMT+0. Elle est maintenant donnée en GMT+1.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte15')">Version 3.1.2</a></h3>
			</div>
			<div class="panel-body"><span id="texte15" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Dans "Mes modules", un trait de séparation horizontal rouge sépare maintenant les séances passées des futures séances.</li>
						<li>Les réservations des groupes de niveaux supérieurs n'apparaissaient pas. Par exemple, une réservation au niveau d'un groupe de TD n'apparaissait pas quand on visualisait le groupe de TP. C'est corrigé.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte14')">Version 3.1.1</a></h3>
			</div>
			<div class="panel-body"><span id="texte14" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Amélioration de l'algorithme de détection des conflits de profs, groupes, salles... Durée de génération du planning divisée par 4.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte13')">Version 3.1</a></h3>
			</div>
			<div class="panel-body"><span id="texte13" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Dans l'emploi du temps d'un prof, on peut maintenant voir facilement s'il y a bien une salle affectée à la séance, si le prof n'a pas plusieurs cours en même temps, si les groupes n'ont pas plusieurs cours en même temps et si la salle n'est pas utilisée par quelqu'un d'autre.Ces messages peuvent être cachés si on coche la case "Masquer les problèmes".</li>
						<li>Quand la case "Masquer les RDV" était cochée et qu'ensuite on cliquait sur "Retour à la semaine actuelle", la case "Masquer les RDV" ne restait pas cochée. C'est corrigé.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte12')">Version 3.0.3</a></h3>
			</div>
			<div class="panel-body"><span id="texte12" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Dans le flux RSS, les noms des groupes et des salles n'apparaissaient plus. Ca a été corrigé.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte11')">Version 3.0.2</a></h3>
			</div>
			<div class="panel-body"><span id="texte11" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Les fichiers .ics ont été légèrement modifiés afin de les rendre plus lisibles.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>Les fichiers .ics ont été légèrement modifiés afin de les rendre plus lisibles.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte10')">Version 3.0.1</a></h3>
			</div>
			<div class="panel-body"><span id="texte10" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Un bug avec internet explorer a été corrigé. Quand on cliquait sur "Tout désélectionner" on se retrouvait délogué si après on cliquait sur "Envoyer".</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte9')">Version 3.0</a></h3>
			</div>
			<div class="panel-body"><span id="texte9" style="visibility: hidden; display: none;">
				<ul>
					<li>Toutes les requêtes vers la base de données sont maintenant des requêtes préparées --> suppression des risques d'injections SQL.</li>
					<li>Correction de certains problèmes d'affichage avec internet explorer.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Dans la vue "Jour J" un problème lors de l'affichage des vacances a été corrigé.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte8')">Version 2.8</a></h3>
			</div>
			<div class="panel-body"><span id="texte8" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Une vue "Jour J" a été ajoutée. Elle permet de ne visualiser que le jour actuel.</li>
						<li>La taille de l'image générée dans les différentes vues a été corrigée pour être agrandie dans certains cas et diminuée dans d'autres pour supprimer les ascenseurs verticaux. Ca marche pour tous les navigateurs sauf internet explorer qui ne respecte pas les standards du web.</li>
						<li>Dans "mes modules", le nom du jour (lundi, mardi...) des séances a été ajouté</li>
						<li>L'abonnement au flux RSS ne marchait pas bien dans certains cas. C'est corrigé.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>L'abonnement au flux RSS ne marchait pas bien dans certains cas. C'est corrigé.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte7')">Version 2.7</a></h3>
			</div>
			<div class="panel-body"><span id="texte7" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Un nouveau bouton a été ajouté. Il permet de voir tous les détails des modules dans lesquels on intervient. Pour le faire apparaitre, il faut absolument utiliser le login et le mot de passe perso.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte6')">Version 2.6</a></h3>
			</div>
			<div class="panel-body"><span id="texte6" style="visibility: hidden; display: none;">
				<ul>
					<li>Ajout d'un mode d'emploi</li>
				</ul>
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
						<li>Changement du design des séances.</li>
						<li>L'abonnement à l'agenda électronique est de nouveau disponible. Pour s'abonner, il faut cliquer sur le nom de la ressource dans la zone grise.</li>
						<li>Ajout d'une liste de pré-tri des groupes d'étudiants.</li>
						<li>Ajout d'une liste de pré-tri des profs</li>
						<li>Ajout d'une liste de pré-tri des profs</li>
						<li>Ajout d'une liste de pré-tri des salles.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>Changement du design des séances</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte5')">Version 2.5</a></h3>
			</div>
			<div class="panel-body"><span id="texte5" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interfaces profs, salles et multi-ressources :</strong></em></lh>
						<li>Les interfaces profs et salles sont remplacées par l'interface multi-ressources qui s'appelle maintenant "planning des profs".</li>
				</ul>
				<ul>
					<lh><em><strong>Interface téléphones portables :</strong></em></lh>
						<li>Une interface optimisée pour les téléphones portables a été ajoutée. Pour passer à la semaine suivante, il faut cliquer sur le tiers droit de l'image. Pour aller à la semaine précédente, il faut cliquer sur le tiers gauche de l'image.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte4')">Version 2.4</a></h3>
			</div>
			<div class="panel-body"><span id="texte4" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface multi-ressources :</strong></em></lh>
					<li>Une vue mensuelle a été ajoutée. Pour voir le détail des séances, il faut laisser la souris quelques secondes au-dessus de celles-ci.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte3')">Version 2.3</a></h3>
			</div>
			<div class="panel-body"><span id="texte3" style="visibility: hidden; display: none;">
				<ul>
					<li>Les emplois du temps de 2008-2009 et de 2009-2010 sont visibles sur la même interface web.</li>
				</ul>
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte2')">Version 2.2</a></h3>
			</div>
			<div class="panel-body"><span id="texte2" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>Les vacances scolaires et les périodes d'apprentissage apparaissent dans l'emploi du temps.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
					<li>Les vacances scolaires des profs apparaissent dans l'emploi du temps.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface multi-ressources :</strong></em></lh>
					<li>Les vacances scolaires des profs apparaissent dans l'emploi du temps.</li>
					<li>Les vacances scolaires et les périodes d'apprentissage des groupes apparaissent dans l'emploi du temps.</li>
					<li>On peut maintenant masquer réservations pour voir le cours qu'il y a en dessous en cas de superposition.</li>
				</ul> 
			</span></div>
			
			<div class="panel-heading">
				<h3 class="panel-title"><a onClick="toggleVisibility('texte1')">Version 2.1</a></h3>
			</div>
			<div class="panel-body"><span id="texte1" style="visibility: hidden; display: none;">
				<ul>
					<lh><em><strong>Interface étudiant :</strong></em></lh>
						<li>J'ai corrigé l'affichage des commentaires de séances qui dépassaient 2 lignes.</li>
					    <li>Le flux RSS est maintenant détecté par votre navigateur.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface prof :</strong></em></lh>
					<li>Les fichiers ics sont faits à partir des bases 08-09 et 09-10.</li>
					<li>J'ai ajouté le bouton "journée" dans l'ajout des rendez-vous perso.</li>
					<li>J'ai corrigé l'affichage des commentaires de séances qui dépassaient 2 lignes.</li>
					<li>Le flux RSS est maintenant détecté par votre navigateur.</li>
				</ul>
				<ul>
					<lh><em><strong>Interface salle :</strong></em></lh>
					<li>J'ai corrigé l'affichage des commentaires de séances qui dépassaient 2 lignes</li>
					<li>J'ai corrigé l'affichage des noms des réservations qui dépassaient 2 lignes.</li>
					<li>On peut maintenant masquer réservations pour voir le cours qu'il y a en dessous en cas de superposition..</li>
				</ul> 
				<ul>
					<lh><em><strong>Interface multi-ressources :</strong></em></lh>
					<li>j'ai réduit la largeur (ou la hauteur pour la vue verticale) du rectangle des rendez-vous perso pour pouvoir voir s'il y a un cours en dessous.</li>
					<li>On peut maintenant masquer les rendez-vous perso pour voir le cours qu'il y a en dessous en cas de superposition..</li>
					<li>J'ai ajouté le bouton "journée" dans l'ajout des rendez-vous perso.</li>
					<li>J'ai corrigé l'affichage des noms des rdv perso qui dépassaient 2 lignes.</li>
					<li>J'ai corrigé l'affichage des commentaires de séances qui dépassaient 2 lignes.</li>
					<li>Affichage de son propre emploi du temps lorsqu'on vient juste de se loguer avec son login perso en multi ressources..</li>
					<li>Le flux RSS est maintenant détecté par votre navigateur..</li>
				</ul>  				
			</span></div>
		</div>
		
		{include file='template/include/footer.tpl'}
		
	</body>
</html>