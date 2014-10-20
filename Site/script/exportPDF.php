<?php
session_start();
require('../API/fpdf/fpdf.php');
include('../config/config.php');
	
//préparation requetes
$sql="SELECT * FROM ressources_groupes WHERE codeGroupe=:codeRessource and deleted=0";
$req_nom_groupe=$dbh->prepare($sql);
$sql="SELECT * FROM ressources_profs WHERE codeProf=:codeRessource and deleted=0";
$req_nom_prof=$dbh->prepare($sql);
$sql="SELECT * FROM ressources_salles WHERE codeSalle=:codeRessource and deleted=0";
$req_nom_salle=$dbh->prepare($sql);
$sql="SELECT * FROM ressources_materiels WHERE codeMateriel=:codeRessource and deleted=0";
$req_nom_materiel=$dbh->prepare($sql);


//VERSION PROF
if (isset($_SESSION['pdf']) || (isset($_SESSION['logged_prof_generique']) && $autorisation_pdf==1))
{
if ($_SESSION['pdf']==1 || (isset($_SESSION['logged_prof_generique']) && $autorisation_pdf==1))
{


if(isset($_SESSION['logged_prof_perso']))
{
$codeProf=$_SESSION['logged_prof_perso'];


//recuperation de la config perso des profs		
$sql="SELECT * FROM login_prof WHERE codeProf=:codeProf  ";
$req_config_prof_perso=$dbh->prepare($sql);
$req_config_prof_perso->execute(array(':codeProf'=>$codeProf));
$res_config_prof_perso=$req_config_prof_perso->fetchAll();
foreach($res_config_prof_perso as $config_prof)
{
	if ($config_prof['weekend']=='0')
		{
		$weekend='0';
	
		}
	elseif($config_prof['weekend']=='1')
		{
		$weekend='1';
		
		}
	else
		{
	$weekend='2';
		
		}

}
}


//définition de l'image à afficher
$nom_image="";
//emplacement
$nom_image=$url_site."/";
//type de vue
if ($horizon==0)
{
	if (count($groupes_multi)+count($salles_multi)+count($profs_multi)+count($materiels_multi)>1)
	{
	$nom_image.="vue_prof_verticale_multiressources.php?";
	}
	else
	{
	$nom_image.="vue_prof_verticale.php?";
	}

}
elseif ($horizon==1)
{
$nom_image.="vue_prof_horizontale.php?";
}
elseif ($horizon==2 || $horizon==4)
{
	if (count($groupes_multi)+count($salles_multi)+count($profs_multi)+count($materiels_multi)==1)
{
$nom_image.="vue_prof_mensuelle_pdf.php?";
}
else
{
$nom_image.="vue_prof_mensuelle.php?";
}
}
elseif ($horizon==3)
{
$nom_image.="vue_prof_journaliere.php?";
}


//liste des profs, salles et groupes
for ($i=0; $i<count($groupes_multi); $i++)
{ 
$nom_image.="&groupes_multi[]=".$groupes_multi[$i];
}
 for ($i=0; $i<count($salles_multi); $i++)
{ 
$nom_image.="&salles_multi[]=".$salles_multi[$i];
}
 for ($i=0; $i<count($profs_multi); $i++)
{
$nom_image.="&profs_multi[]=".$profs_multi[$i];
}
 for ($i=0; $i<count($materiels_multi); $i++)
{
$nom_image.="&materiels_multi[]=".$materiels_multi[$i];
}
//hideprobleme et hideprivate
$nom_image.="&hideprivate=".$hideprivate."&hideprobleme=".$hideprobleme;



//taille image
if ($horizon==0)
{
	if (count($groupes_multi)+count($salles_multi)+count($profs_multi)+count($materiels_multi)>1)
	{
	$k=count($groupes_multi)+count($salles_multi)+count($profs_multi)+count($materiels_multi);
		if ($k==2)
		{
		$nom_image.="&hau=1300&lar=".$k*800;
		}
		elseif ($k==3)
		{
		$nom_image.="&hau=1025&lar=".$k*550;
		}	
		elseif ($k==4)
		{
		$nom_image.="&hau=850&lar=".$k*400;
		}
		elseif ($k==5)
		{
		$nom_image.="&hau=400&lar=".$k*312;
		}
		elseif ($k==6)
		{
		$nom_image.="&hau=400&lar=".$k*310;
		}
		elseif ($k==7)
		{
		$nom_image.="&hau=400&lar=".$k*300;
		}
		elseif ($k==8)
		{
		$nom_image.="&hau=400&lar=".$k*295;
		}
		else
		{
		//si image trop grosse, ça plante
		$taille_largeur=$k*300;
		if($taille_largeur>3990)
		{
		$taille_largeur=3990;
		}
		$nom_image.="&hau=400&lar=".$k*300;
		}
	}
	
	else
	{
	$nom_image.="&lar=1300&hau=2000";
	}

}
elseif ($horizon==1)
{
	if (count($groupes_multi)+count($salles_multi)+count($profs_multi)+count($materiels_multi)>1)
	{
	$k=count($groupes_multi)+count($salles_multi)+count($profs_multi)+count($materiels_multi);
		if ($k==2)
		{
		$nom_image.="&lar=1100&hau=".$k*800;
		}
		elseif ($k==3)
		{
		$nom_image.="&lar=850&hau=".$k*600;
		}	
		elseif ($k==4)
		{
		$nom_image.="&lar=850&hau=".$k*550;
		}
		elseif ($k==5)
		{
		$nom_image.="&lar=850&hau=".$k*520;
		}
		elseif ($k==6)
		{
		$nom_image.="&lar=850&hau=".$k*520;
		}
		
		else
		{
		//si image trop grosse, ça plante
		$taille_largeur=$k*500;
		if($taille_largeur>3990)
		{
		$taille_largeur=3990;
		}
		$nom_image.="&lar=400&hau=".$taille_largeur;
		}
	}
	
	else
	{
	$nom_image.="&hau=1300&lar=1700";
	}
}
elseif ($horizon==2 || $horizon==4)
{
	if (count($groupes_multi)+count($salles_multi)+count($profs_multi)+count($materiels_multi)>1)
	{
	$k=count($groupes_multi)+count($salles_multi)+count($profs_multi)+count($materiels_multi);
		if ($k==2)
		{
		$nom_image.="&hau=1400&lar=".$k*800;
		}
		elseif ($k==3)
		{
		$nom_image.="&hau=1000&lar=".$k*500;
		}	
		elseif ($k==4)
		{
		$nom_image.="&hau=1000&lar=".$k*460;
		}

		else
		{
		//si image trop grosse, ça plante
		$taille_largeur=$k*475;
		if($taille_largeur>3990)
		{
		$taille_largeur=3990;
		}
		$nom_image.="&hau=1000&lar=".$taille_largeur;
		}
	}
	
	else
	{
	$nom_image.="&lar=1300&hau=2000";
	}
}
elseif ($horizon==3)
{
	if (count($groupes_multi)+count($salles_multi)+count($profs_multi)+count($materiels_multi)>1)
	{
	$k=count($groupes_multi)+count($salles_multi)+count($profs_multi)+count($materiels_multi);
		if ($k==2)
		{
		$nom_image.="&lar=1500&hau=".$k*650;
		}
		elseif ($k==3)
		{
		$nom_image.="&lar=1400&hau=".$k*580;
		}	
		elseif ($k==4)
		{
		$nom_image.="&lar=1400&hau=".$k*330;
		}
		elseif ($k==5)
		{
		$nom_image.="&lar=1300&hau=".$k*220;
		}
		elseif ($k==6)
		{
		$nom_image.="&lar=1300&hau=".$k*165;
		}
		
		else
		{
		//si image trop grosse, ça plante
		$taille_largeur=$k*125;
		if($taille_largeur>3990)
		{
		$taille_largeur=3990;
		}
		$nom_image.="&lar=1300&hau=".$taille_largeur;
		}
	}
	
	else
	{
	$nom_image.="&hau=1300&lar=1500";
	}
}

//heure debut, heure fin et weekend
if(isset($_SESSION['logged_prof_perso']))
{
$nom_image.="&weekend=".$weekend."&hdeb=".$hdeb."&hfin=".$hfin;
}


$pdf=new FPDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->SetFont('Times','',10);
$pdf->SetTitle('Emploi du temps - version du '.date("d/m/Y"));
$pdf->SetAuthor('Bruno Million (bruno.million@u-paris10.fr)');
$pdf->SetCreator('VT agenda');


//liste des ressources
$nom_ressource="";
foreach ($groupes_multi as $groupe_multi)
{

$req_nom_groupe->execute(array(':codeRessource'=>$groupe_multi));
$res_nom_groupe=$req_nom_groupe->fetchAll();
foreach($res_nom_groupe as $res_nom_groupes)
	{
	$nom_ressource.=$res_nom_groupes['nom']."-";
	}
}
foreach ($profs_multi as $prof_multi)
{

$req_nom_prof->execute(array(':codeRessource'=>$prof_multi));
$res_nom_prof=$req_nom_prof->fetchAll();
foreach($res_nom_prof as $res_nom_profs)
	{
	$nom_ressource.=ucwords(strtolower($res_nom_profs['prenom']))." ".$res_nom_profs['nom']."-";
	}
}

foreach ($salles_multi as $salle_multi)
{

$req_nom_salle->execute(array(':codeRessource'=>$salle_multi));
$res_nom_salle=$req_nom_salle->fetchAll();
foreach($res_nom_salle as $res_nom_salles)
	{
	$nom_ressource.=$res_nom_salles['nom']."-";
	}
}

foreach ($materiels_multi as $materiel_multi)
{

$req_nom_materiel->execute(array(':codeRessource'=>$materiel_multi));
$res_nom_materiel=$req_nom_materiel->fetchAll();
foreach($res_nom_materiel as $res_nom_materiels)
	{
	$nom_ressource.=$res_nom_materiels['nom']."-";
	}
}

//suppression du dernier "-"
$nom_ressource= substr($nom_ressource, 0, -1);

//date de génération
$jour_gene=date('d');
$mois_gene=date('m');
$annee_gene=date('y');
$date_generation=$jour_gene."/".$mois_gene."/".$annee_gene;


if(strlen($semaine_debut)==1)
{
$semaine_debut="0".$semaine_debut;
}
if(strlen($semaine_fin)==1)
{
$semaine_fin="0".$semaine_fin;
}
/*
$debut=$annee_debut.$semaine_debut.$jour_debut;

$fin=$annee_fin.$semaine_fin.$jour_fin;
*/


$debut=$annee_debut.$mois_debut.$jour_debut;

$fin=$annee_fin.$mois_fin.$jour_fin;


if ($debut<=$fin)
{
//si vue jour j
if ($horizon==3)
	{
		
	
		$decalage_entre_debut_et_jour_j=floor((mktime(0,0,0,$mois_debut,$jour_debut,$annee_debut)-mktime(0,0,0,date('m'),date('d'),date('Y')))/(60*60*24));
		$decalage_entre_fin_et_jour_j=floor((mktime(0,0,0,$mois_fin,$jour_fin,$annee_fin)-mktime(0,0,0,date('m'),date('d'),date('Y')))/(60*60*24));
			for($i=$decalage_entre_debut_et_jour_j;$i<=$decalage_entre_fin_et_jour_j;$i++)
				{
				$num_du_jour=date('z',mktime(0,0,0,date('m'),date('d')+$i,date('Y')));
					if ($format=="A4")
						{
						$pdf->AddPage('L','A4');
						$pdf->Image($nom_image.'&'.'current_year='.date('Y').'&'.'current_week='.date('W').'&'.'jour='.$i,10,20,277);
						}
						else
						{
						$pdf->AddPage('L','A3');
						$pdf->Image($nom_image.'&'.'current_year='.date('Y').'&'.'current_week='.date('W').'&'.'jour='.$i,10,20,400);
						}


				$pdf->Cell(0,2.5,$titre,0,0,'C');	
				$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
				$pdf->SetFont('Times','',8);
				$pdf->Cell(0,2.5,'Jour '.$num_du_jour." de ".$annee_debut,0,1,'C');
				
					$pdf->Cell(0,2.5,$nom_ressource,0,1,'C');
					$pdf->SetFont('Times','',6);
					if ($hideprobleme==1 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations ne sont pas affichés sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==0 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les réservations ne sont pas affichées sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==1 && $hideprivate==0)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits ne sont pas affichés sur ce planning',0,1,'C');
					}
					else
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations sont affichés sur ce planning',0,1,'C');
					}
				}		
	}
//si pas jour J
else
{



	if ($annee_debut==$annee_fin)
	{
	
$memoire_mois="";
			for($i=$semaine_debut;$i<=$semaine_fin;$i++)
				{
				
				if ($horizon==0)
					{
					
					if ($format=="A4")
						{
						$pdf->AddPage('P','A4');
						$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$i,10,20,190);
						}
						else
						{
						$pdf->AddPage('P','A3');
						$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$i,10,20,277);
						}
					$pdf->Cell(0,2.5,$titre,0,0,'C');
					$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
					$pdf->SetFont('Times','',8);
					$pdf->Cell(0,2.5,'Semaine '.$i." de ".$annee_debut,0,1,'C');
					
					$pdf->Cell(0,2.5,$nom_ressource,0,1,'C');
					$pdf->SetFont('Times','',6);
					if ($hideprobleme==1 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations ne sont pas affichés sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==0 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les réservations ne sont pas affichées sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==1 && $hideprivate==0)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits ne sont pas affichés sur ce planning',0,1,'C');
					}
					else
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations sont affichés sur ce planning',0,1,'C');
					}
					}
					
				elseif ($horizon==2 || $horizon==4)
					{
					$jsem=date('w',mktime(0,0,0,$mois_debut,$jour_debut+($i-$semaine_debut)*7,$annee_debut));
					if ($jsem==0)
					{
					$jsem=7;
					}
					$lundi=date('m',mktime(0,0,0,$mois_debut,$jour_debut+($i-$semaine_debut)*7+(1-$jsem),$annee_debut));
					$mois_visualise=date('m',mktime(0,0,0,$mois_debut,$jour_debut+($i-$semaine_debut)*7,$annee_debut));
					
					if ($mois_visualise!=$memoire_mois && $mois_visualise==$lundi)
					{
					if ($format=="A4")
						{
						$pdf->AddPage('P','A4');
						$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$i,10,20,190);
						}
						else
						{
						$pdf->AddPage('P','A3');
						$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$i,10,20,277);
						}
						
					$pdf->Cell(0,2.5,$titre,0,0,'C');
					$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
					$memoire_mois=$mois_visualise;
					$pdf->SetFont('Times','',8);
					$pdf->Cell(0,2.5,$mois_visualise.'/'.$annee_debut,0,1,'C');
					
					$pdf->Cell(0,2.5,$nom_ressource,0,1,'C');
					$pdf->SetFont('Times','',6);
					if ($hideprobleme==1 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations ne sont pas affichés sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==0 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les réservations ne sont pas affichées sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==1 && $hideprivate==0)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits ne sont pas affichés sur ce planning',0,1,'C');
					}
					else
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations sont affichés sur ce planning',0,1,'C');
					}
					}
					}	
				else
					{
					if ($format=="A4")
						{
						$pdf->AddPage('L','A4');
						$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$i,10,20,277);
						}
						else
						{
						$pdf->AddPage('L','A3');
						$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$i,10,20,400);
						}
					$pdf->Cell(0,2.5,$titre,0,0,'C');
					$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
					$pdf->SetFont('Times','',8);
					$pdf->Cell(0,2.5,'Semaine '.$i." de ".$annee_debut,0,1,'C');
					
						$pdf->Cell(0,2.5,$nom_ressource,0,1,'C');
					$pdf->SetFont('Times','',6);
					if ($hideprobleme==1 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations ne sont pas affichés sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==0 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les réservations ne sont pas affichées sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==1 && $hideprivate==0)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits ne sont pas affichés sur ce planning',0,1,'C');
					}
					else
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations sont affichés sur ce planning',0,1,'C');
					}
					}
				
				}
		

		
	}
	else
	{
	
		for($j=$annee_debut;$j<=$annee_fin;$j++)
			{
			$memoire_mois="";
			if($j==$annee_debut)
				{
		
				
						for($i=$semaine_debut;$i<=52;$i++)
						{
						if ($horizon==0)
							{
							if ($format=="A4")
								{
								$pdf->AddPage('P','A4');
								$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$i,10,20,190);
								}
								else
								{
								$pdf->AddPage('P','A3');
								$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$i,10,20,277);
								}
							$pdf->Cell(0,2.5,$titre,0,0,'C');
							$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
							$pdf->SetFont('Times','',8);
							$pdf->Cell(0,2.5,'Semaine '.$i." de ".$j,0,1,'C');
							
												$pdf->Cell(0,2.5,$nom_ressource,0,1,'C');
					$pdf->SetFont('Times','',6);
					if ($hideprobleme==1 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations ne sont pas affichés sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==0 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les réservations ne sont pas affichées sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==1 && $hideprivate==0)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits ne sont pas affichés sur ce planning',0,1,'C');
					}
					else
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations sont affichés sur ce planning',0,1,'C');
					}		
							
							
											
							}
						elseif ($horizon==2 || $horizon==4)
							{//le $z permet d'éviter que le mois de décembre apparaisse 2x si on commence par exemple le 31/10/10 et qu'on fini le 08/01/11
							$z=$i;
							if($z==52)
							{
							$z=51;
							}
							
							$jsem=date('w',mktime(0,0,0,$mois_debut,$jour_debut+($z-$semaine_debut)*7,$annee_debut));
							if ($jsem==0)
							{
							$jsem=7;
							}
							$lundi=date('m',mktime(0,0,0,$mois_debut,$jour_debut+($z-$semaine_debut)*7+(1-$jsem),$annee_debut));
							$mois_visualise=date('m',mktime(0,0,0,$mois_debut,$jour_debut+($z-$semaine_debut)*7,$annee_debut));
							if ($mois_visualise!=$memoire_mois && $mois_visualise==$lundi)
							{
							if ($format=="A4")
								{
								$pdf->AddPage('P','A4');
								$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$z,10,20,190);
								}
								else
								{
								$pdf->AddPage('P','A3');
								$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$z,10,20,277);
								}
							$pdf->Cell(0,2.5,$titre,0,0,'C');
							$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
							$memoire_mois=$mois_visualise;
								$pdf->SetFont('Times','',8);
							$pdf->Cell(0,2.5,$mois_visualise.'/'.$j,0,1,'C');
						
												$pdf->Cell(0,2.5,$nom_ressource,0,1,'C');
					$pdf->SetFont('Times','',6);
					if ($hideprobleme==1 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations ne sont pas affichés sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==0 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les réservations ne sont pas affichées sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==1 && $hideprivate==0)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits ne sont pas affichés sur ce planning',0,1,'C');
					}
					else
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations sont affichés sur ce planning',0,1,'C');
					}		
							}
							}
						else
							{
							if ($format=="A4")
								{
								$pdf->AddPage('L','A4');
								$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$i,10,20,277);
								}
								else
								{
								$pdf->AddPage('L','A3');
								$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$i,10,20,400);
								}
							$pdf->Cell(0,2.5,$titre,0,0,'C');
							$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
							$pdf->SetFont('Times','',8);
							$pdf->Cell(0,2.5,'Semaine '.$i." de ".$j,0,1,'C');
							
												$pdf->Cell(0,2.5,$nom_ressource,0,1,'C');
					$pdf->SetFont('Times','',6);
					if ($hideprobleme==1 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations ne sont pas affichés sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==0 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les réservations ne sont pas affichées sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==1 && $hideprivate==0)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits ne sont pas affichés sur ce planning',0,1,'C');
					}
					else
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations sont affichés sur ce planning',0,1,'C');
					}
							}
				
						
				
						
						}
	
					
					
					
					
					
					
				}
			elseif($j!=$annee_debut && $j!=$annee_fin)
				{
						for($i=1;$i<=52;$i++)
						{
							
						if ($horizon==0)
							{
							if ($format=="A4")
								{
								$pdf->AddPage('P','A4');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,190);
								}
								else
								{
								$pdf->AddPage('P','A3');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,277);
								}
							$pdf->Cell(0,2.5,$titre,0,0,'C');
							$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
							$pdf->SetFont('Times','',8);
							$pdf->Cell(0,2.5,'Semaine '.$i." de ".$j,0,1,'C');
							
												$pdf->Cell(0,2.5,$nom_ressource,0,1,'C');
					$pdf->SetFont('Times','',6);
					if ($hideprobleme==1 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations ne sont pas affichés sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==0 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les réservations ne sont pas affichées sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==1 && $hideprivate==0)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits ne sont pas affichés sur ce planning',0,1,'C');
					}
					else
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations sont affichés sur ce planning',0,1,'C');
					}
							}
						elseif ($horizon==2 || $horizon==4)
							{
							$jsem=date('w',mktime(0,0,0,$mois_debut,$jour_debut+($i-$semaine_debut)*7,$annee_debut));
							if ($jsem==0)
							{
							$jsem=7;
							}
							$lundi=date('m',mktime(0,0,0,$mois_debut,$jour_debut+($i-$semaine_debut)*7+(1-$jsem),$annee_debut));
							$mois_visualise=date('m',mktime(0,0,0,$mois_debut,$jour_debut+($i-$semaine_debut)*7,$annee_debut));
							if ($mois_visualise!=$memoire_mois && $mois_visualise==$lundi)
							{
							if ($format=="A4")
								{
								$pdf->AddPage('P','A4');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,190);
								}
								else
								{
								$pdf->AddPage('P','A3');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,277);
								}
							$pdf->Cell(0,2.5,$titre,0,0,'C');
							$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
							$pdf->SetFont('Times','',8);
							$memoire_mois=$mois_visualise;
							$pdf->Cell(0,2.5,$mois_visualise.'/'.$j,0,1,'C');
							
												$pdf->Cell(0,2.5,$nom_ressource,0,1,'C');
					$pdf->SetFont('Times','',6);
					if ($hideprobleme==1 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations ne sont pas affichés sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==0 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les réservations ne sont pas affichées sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==1 && $hideprivate==0)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits ne sont pas affichés sur ce planning',0,1,'C');
					}
					else
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations sont affichés sur ce planning',0,1,'C');
					}
							}
							}
						else
							{
							if ($format=="A4")
								{
								$pdf->AddPage('L','A4');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,277);
								}
								else
								{
								$pdf->AddPage('L','A3');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,400);
								}
							$pdf->Cell(0,2.5,$titre,0,0,'C');
							$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
								$pdf->SetFont('Times','',8);
							$pdf->Cell(0,2.5,'Semaine '.$i." de ".$j,0,1,'C');
						
												$pdf->Cell(0,2.5,$nom_ressource,0,1,'C');
					$pdf->SetFont('Times','',6);
					if ($hideprobleme==1 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations ne sont pas affichés sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==0 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les réservations ne sont pas affichées sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==1 && $hideprivate==0)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits ne sont pas affichés sur ce planning',0,1,'C');
					}
					else
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations sont affichés sur ce planning',0,1,'C');
					}
							}
						
						}				
				}
			else
				{
						for($i=1;$i<=$semaine_fin;$i++)
						{
						
						if ($horizon==0)
							{
							if ($format=="A4")
								{
								$pdf->AddPage('P','A4');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,190);
								}
								else
								{
								$pdf->AddPage('P','A3');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,277);
								}
							$pdf->Cell(0,2.5,$titre,0,0,'C');
							$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
							$pdf->SetFont('Times','',8);
							$pdf->Cell(0,2.5,'Semaine '.$i." de ".$j,0,1,'C');
							
												$pdf->Cell(0,2.5,$nom_ressource,0,1,'C');
					$pdf->SetFont('Times','',6);
					if ($hideprobleme==1 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations ne sont pas affichés sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==0 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les réservations ne sont pas affichées sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==1 && $hideprivate==0)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits ne sont pas affichés sur ce planning',0,1,'C');
					}
					else
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations sont affichés sur ce planning',0,1,'C');
					}
							}
						elseif ($horizon==2 || $horizon==4)
							{
							$mois_visualise=date('m',mktime(0,0,0,$mois_debut,$jour_debut+($i-$semaine_debut)*7,$annee_debut));
							if ($mois_visualise!=$memoire_mois)
							{
							if ($format=="A4")
								{
								$pdf->AddPage('P','A4');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,190);
								}
								else
								{
								$pdf->AddPage('P','A3');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,277);
								}
							$pdf->Cell(0,2.5,$titre,0,0,'C');
							$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
							$memoire_mois=$mois_visualise;
							$pdf->SetFont('Times','',8);
							$pdf->Cell(0,2.5,$mois_visualise.'/'.$j,0,1,'C');
							
												$pdf->Cell(0,2.5,$nom_ressource,0,1,'C');
					$pdf->SetFont('Times','',6);
					if ($hideprobleme==1 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations ne sont pas affichés sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==0 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les réservations ne sont pas affichées sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==1 && $hideprivate==0)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits ne sont pas affichés sur ce planning',0,1,'C');
					}
					else
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations sont affichés sur ce planning',0,1,'C');
					}
							}
							}
						else
							{
							if ($format=="A4")
								{
								$pdf->AddPage('L','A4');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,277);
								}
								else
								{
								$pdf->AddPage('L','A3');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,400);
								}
							$pdf->Cell(0,2.5,$titre,0,0,'C');
							$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
							$pdf->SetFont('Times','',8);
							$pdf->Cell(0,2.5,'Semaine '.$i." de ".$j,0,1,'C');
							
												$pdf->Cell(0,2.5,$nom_ressource,0,1,'C');
					$pdf->SetFont('Times','',6);
					if ($hideprobleme==1 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations ne sont pas affichés sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==0 && $hideprivate==1)
					{
					$pdf->Cell(0,2.5,'Les réservations ne sont pas affichées sur ce planning',0,1,'C');
					}
					elseif ($hideprobleme==1 && $hideprivate==0)
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits ne sont pas affichés sur ce planning',0,1,'C');
					}
					else
					{
					$pdf->Cell(0,2.5,'Les éventuels conflits et les réservations sont affichés sur ce planning',0,1,'C');
					}
							}
						
						}					
				}
			
			}
	}


}
}
else
{
$pdf->AddPage('L','A4');
$pdf->SetFont('Times','',30);
$pdf->Cell(0,10,'Erreur dans la sélection des dates',0,0,'C');
}

//nom du fichier
$jour=date('d');

$mois=date('m');

$annee=date('y');

$nom_fichier="";


foreach ($groupes_multi as $groupe_multi)
{

$req_nom_groupe->execute(array(':codeRessource'=>$groupe_multi));
$res_nom_groupe=$req_nom_groupe->fetchAll();
foreach($res_nom_groupe as $res_nom_groupes)
	{
	$nom_fichier.=$res_nom_groupes['nom']."-";
	}
}
foreach ($profs_multi as $prof_multi)
{

$req_nom_prof->execute(array(':codeRessource'=>$prof_multi));
$res_nom_prof=$req_nom_prof->fetchAll();
foreach($res_nom_prof as $res_nom_profs)
	{
	$nom_fichier.=$res_nom_profs['nom']."-";
	}
}

foreach ($salles_multi as $salle_multi)
{

$req_nom_salle->execute(array(':codeRessource'=>$salle_multi));
$res_nom_salle=$req_nom_salle->fetchAll();
foreach($res_nom_salle as $res_nom_salles)
	{
	$nom_fichier.=$res_nom_salles['nom']."-";
	}
}

if ($horizon==0)
 {
 $nom_fichier.="vertical-";
 }
 elseif ($horizon==1) 
 {
 $nom_fichier.="horizontal-";
 } 
 elseif ($horizon==2 || $horizon==4)
 {
 $nom_fichier.="mensuel-"; 
 }
 elseif ($horizon==3) 
 {
 $nom_fichier.="jour_J-";
 }


$nom_fichier.=$jour."_".$mois."_".$annee.".pdf";
$pdf->Output($nom_fichier,'D');


}
}


//VERSION ETUDIANT
if (isset($_SESSION['loggedstudent']))
{
if ($_SESSION['loggedstudent']!="")
{

//définition de l'image à afficher
$nom_image="";
//emplacement
$nom_image=$url_site."/";
//type de vue




if ($horizon==0)
 {
 $nom_image.="vue_etudiant_verticale.php?";

 }
 elseif ($horizon==1) 
 {
 $nom_image.="vue_etudiant_horizontale.php?";
 
 } 
elseif ($horizon==2 || $horizon==4)
 {
 $nom_image.="vue_etudiant_mensuelle_pdf.php?";

 }
 elseif ($horizon==3) 
 {
 $nom_image.="vue_etudiant_journaliere.php?";

 }

 

//etudiant à visualiser
$nom_image.="&current_student=".$current_student;

//taille image
$nom_image.="&hau=1300&lar=2000";






$pdf=new FPDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->SetFont('Times','',10);
$pdf->SetTitle('Emploi du temps - version du '.date("d/m/Y"));
$pdf->SetAuthor('Bruno Million (bruno.million@u-paris10.fr)');
$pdf->SetCreator('VT agenda');

//$debut=$annee_debut.$semaine_debut;

//$fin=$annee_fin.$semaine_fin;




//date de génération
$jour_gene=date('d');
$mois_gene=date('m');
$annee_gene=date('y');
$date_generation=$jour_gene."/".$mois_gene."/".$annee_gene;




if(strlen($semaine_debut)==1)
{
$semaine_debut="0".$semaine_debut;
}
if(strlen($semaine_fin)==1)
{
$semaine_fin="0".$semaine_fin;
}

/*
$debut=$annee_debut.$semaine_debut.$jour_debut;

$fin=$annee_fin.$semaine_fin.$jour_fin;
*/

$debut=$annee_debut.$mois_debut.$jour_debut;

$fin=$annee_fin.$mois_fin.$jour_fin;


if ($debut<=$fin)
{
//si vue jour j
if ($horizon==3)
	{
		
	
		$decalage_entre_debut_et_jour_j=floor((mktime(0,0,0,$mois_debut,$jour_debut,$annee_debut)-mktime(0,0,0,date('m'),date('d'),date('Y')))/(60*60*24));
		$decalage_entre_fin_et_jour_j=floor((mktime(0,0,0,$mois_fin,$jour_fin,$annee_fin)-mktime(0,0,0,date('m'),date('d'),date('Y')))/(60*60*24));
			for($i=$decalage_entre_debut_et_jour_j;$i<=$decalage_entre_fin_et_jour_j;$i++)
				{
				$num_du_jour=date('z',mktime(0,0,0,date('m'),date('d')+$i,date('Y')));
					if ($format=="A4")
						{
						$pdf->AddPage('L','A4');
						$pdf->Image($nom_image.'&'.'current_year='.date('Y').'&'.'current_week='.date('W').'&'.'jour='.$i,10,20,277);
						}
						else
						{
						$pdf->AddPage('L','A3');
						$pdf->Image($nom_image.'&'.'current_year='.date('Y').'&'.'current_week='.date('W').'&'.'jour='.$i,10,20,400);
						}


				$pdf->Cell(0,2.5,$titre,0,0,'C');	
				$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
				$pdf->SetFont('Times','',8);
				$pdf->Cell(0,2.5,'Jour '.$num_du_jour." de ".$annee_debut,0,1,'C');
				
				}		
	}
//si pas jour J
else
{



	if ($annee_debut==$annee_fin)
	{
	
$memoire_mois="";
			for($i=$semaine_debut;$i<=$semaine_fin;$i++)
				{
				
				if ($horizon==0)
					{
					
					if ($format=="A4")
						{
						$pdf->AddPage('L','A4');
						$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$i,10,20,277);
						}
						else
						{
						$pdf->AddPage('L','A3');
						$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$i,10,20,400);
						}
					$pdf->Cell(0,2.5,$titre,0,0,'C');
					$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
					$pdf->SetFont('Times','',8);
					$pdf->Cell(0,2.5,'Semaine '.$i." de ".$annee_debut,0,1,'C');
					
				
					}
					
				elseif ($horizon==2 || $horizon==4)
					{
					$jsem=date('w',mktime(0,0,0,$mois_debut,$jour_debut+($i-$semaine_debut)*7,$annee_debut));
					if ($jsem==0)
					{
					$jsem=7;
					}
					$lundi=date('m',mktime(0,0,0,$mois_debut,$jour_debut+($i-$semaine_debut)*7+(1-$jsem),$annee_debut));
					$mois_visualise=date('m',mktime(0,0,0,$mois_debut,$jour_debut+($i-$semaine_debut)*7,$annee_debut));
					
					if ($mois_visualise!=$memoire_mois && $mois_visualise==$lundi)
					{
					if ($format=="A4")
						{
						$pdf->AddPage('L','A4');
						$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$i,10,20,277);
						}
						else
						{
						$pdf->AddPage('L','A3');
						$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$i,10,20,400);
						}
						
					$pdf->Cell(0,2.5,$titre,0,0,'C');
					$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
					$memoire_mois=$mois_visualise;
					$pdf->SetFont('Times','',8);
					$pdf->Cell(0,2.5,$mois_visualise.'/'.$annee_debut,0,1,'C');
					
					
					}
					}	
				else
					{
					if ($format=="A4")
						{
						$pdf->AddPage('L','A4');
						$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$i,10,20,277);
						}
						else
						{
						$pdf->AddPage('L','A3');
						$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$i,10,20,400);
						}
					$pdf->Cell(0,2.5,$titre,0,0,'C');
					$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
					$pdf->SetFont('Times','',8);
					$pdf->Cell(0,2.5,'Semaine '.$i." de ".$annee_debut,0,1,'C');
					
					
					}
				
				}
		

		
	}
	else
	{
	
		for($j=$annee_debut;$j<=$annee_fin;$j++)
			{
			$memoire_mois="";
			if($j==$annee_debut)
				{
		
				
						for($i=$semaine_debut;$i<=52;$i++)
						{
						if ($horizon==0)
							{
							if ($format=="A4")
								{
								$pdf->AddPage('L','A4');
								$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$i,10,20,277);
								}
								else
								{
								$pdf->AddPage('L','A3');
								$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$i,10,20,400);
								}
							$pdf->Cell(0,2.5,$titre,0,0,'C');
							$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
							$pdf->SetFont('Times','',8);
							$pdf->Cell(0,2.5,'Semaine '.$i." de ".$j,0,1,'C');
							
						
							
							
											
							}
						elseif ($horizon==2 || $horizon==4)
							{//le $z permet d'éviter que le mois de décembre apparaisse 2x si on commence par exemple le 31/10/10 et qu'on fini le 08/01/11
							$z=$i;
							if($z==52)
							{
							$z=51;
							}
							
							$jsem=date('w',mktime(0,0,0,$mois_debut,$jour_debut+($z-$semaine_debut)*7,$annee_debut));
							if ($jsem==0)
							{
							$jsem=7;
							}
							$lundi=date('m',mktime(0,0,0,$mois_debut,$jour_debut+($z-$semaine_debut)*7+(1-$jsem),$annee_debut));
							$mois_visualise=date('m',mktime(0,0,0,$mois_debut,$jour_debut+($z-$semaine_debut)*7,$annee_debut));
							if ($mois_visualise!=$memoire_mois && $mois_visualise==$lundi)
							{
							if ($format=="A4")
								{
								$pdf->AddPage('L','A4');
								$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$z,10,20,277);
								}
								else
								{
								$pdf->AddPage('L','A3');
								$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$z,10,20,400);
								}
							$pdf->Cell(0,2.5,$titre,0,0,'C');
							$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
							$memoire_mois=$mois_visualise;
								$pdf->SetFont('Times','',8);
							$pdf->Cell(0,2.5,$mois_visualise.'/'.$j,0,1,'C');
						
						
							}
							}
						else
							{
							if ($format=="A4")
								{
								$pdf->AddPage('L','A4');
								$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$i,10,20,277);
								}
								else
								{
								$pdf->AddPage('L','A3');
								$pdf->Image($nom_image.'&'.'current_year='.$annee_debut.'&'.'current_week='.$i,10,20,400);
								}
							$pdf->Cell(0,2.5,$titre,0,0,'C');
							$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
							$pdf->SetFont('Times','',8);
							$pdf->Cell(0,2.5,'Semaine '.$i." de ".$j,0,1,'C');
							
					
							}
				
						
				
						
						}
	
					
					
					
					
					
					
				}
			elseif($j!=$annee_debut && $j!=$annee_fin)
				{
						for($i=1;$i<=52;$i++)
						{
							
						if ($horizon==0)
							{
							if ($format=="A4")
								{
								$pdf->AddPage('L','A4');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,277);
								}
								else
								{
								$pdf->AddPage('L','A3');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,400);
								}
							$pdf->Cell(0,2.5,$titre,0,0,'C');
							$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
							$pdf->SetFont('Times','',8);
							$pdf->Cell(0,2.5,'Semaine '.$i." de ".$j,0,1,'C');
							
						
							}
						elseif ($horizon==2 || $horizon==4)
							{
							$jsem=date('w',mktime(0,0,0,$mois_debut,$jour_debut+($i-$semaine_debut)*7,$annee_debut));
							if ($jsem==0)
							{
							$jsem=7;
							}
							$lundi=date('m',mktime(0,0,0,$mois_debut,$jour_debut+($i-$semaine_debut)*7+(1-$jsem),$annee_debut));
							$mois_visualise=date('m',mktime(0,0,0,$mois_debut,$jour_debut+($i-$semaine_debut)*7,$annee_debut));
							if ($mois_visualise!=$memoire_mois && $mois_visualise==$lundi)
							{
							if ($format=="A4")
								{
								$pdf->AddPage('L','A4');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,277);
								}
								else
								{
								$pdf->AddPage('L','A3');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,400);
								}
							$pdf->Cell(0,2.5,$titre,0,0,'C');
							$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
							$pdf->SetFont('Times','',8);
							$memoire_mois=$mois_visualise;
							$pdf->Cell(0,2.5,$mois_visualise.'/'.$j,0,1,'C');
							
					
							}
							}
						else
							{
							if ($format=="A4")
								{
								$pdf->AddPage('L','A4');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,277);
								}
								else
								{
								$pdf->AddPage('L','A3');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,400);
								}
							$pdf->Cell(0,2.5,$titre,0,0,'C');
							$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
								$pdf->SetFont('Times','',8);
							$pdf->Cell(0,2.5,'Semaine '.$i." de ".$j,0,1,'C');
						
					
							}
						
						}				
				}
			else
				{
						for($i=1;$i<=$semaine_fin;$i++)
						{
						
						if ($horizon==0)
							{
							if ($format=="A4")
								{
								$pdf->AddPage('L','A4');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,277);
								}
								else
								{
								$pdf->AddPage('L','A3');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,400);
								}
							$pdf->Cell(0,2.5,$titre,0,0,'C');
							$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
							$pdf->SetFont('Times','',8);
							$pdf->Cell(0,2.5,'Semaine '.$i." de ".$j,0,1,'C');
							
					
							}
						elseif ($horizon==2 || $horizon==4)
							{
							$mois_visualise=date('m',mktime(0,0,0,$mois_debut,$jour_debut+($i-$semaine_debut)*7,$annee_debut));
							if ($mois_visualise!=$memoire_mois)
							{
							if ($format=="A4")
								{
								$pdf->AddPage('L','A4');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,277);
								}
								else
								{
								$pdf->AddPage('L','A3');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,400);
								}
							$pdf->Cell(0,2.5,$titre,0,0,'C');
							$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
							$memoire_mois=$mois_visualise;
							$pdf->SetFont('Times','',8);
							$pdf->Cell(0,2.5,$mois_visualise.'/'.$j,0,1,'C');
							
					
							}
							}
						else
							{
							if ($format=="A4")
								{
								$pdf->AddPage('L','A4');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,277);
								}
								else
								{
								$pdf->AddPage('L','A3');
								$pdf->Image($nom_image.'&'.'current_year='.$j.'&'.'current_week='.$i,10,20,400);
								}
							$pdf->Cell(0,2.5,$titre,0,0,'C');
							$pdf->Cell(0,2.5,"Généré le ".$date_generation,0,1,'R');
							$pdf->SetFont('Times','',8);
							$pdf->Cell(0,2.5,'Semaine '.$i." de ".$j,0,1,'C');
							
						
							}
						
						}					
				}
			
			}
	}


}
}
else
{
$pdf->AddPage('L','A4');
$pdf->SetFont('Times','',30);
$pdf->Cell(0,10,'Erreur dans la sélection des dates',0,0,'C');
}

$jour=date('d');
$mois=date('m');
$annee=date('y');
$heuredujour=date('H');
$minutedujour=date('i');
$nom_fichier="";
$sql="SELECT * FROM ressources_etudiants WHERE codeEtudiant=:codeRessource and deleted=0";
$req_nom_etudiant=$dbh->prepare($sql);




$req_nom_etudiant->execute(array(':codeRessource'=>$current_student));
$res_nom_etudiant=$req_nom_etudiant->fetchAll();
foreach($res_nom_etudiant as $res_nom_etudiants)
	{
	$nom_fichier.=$res_nom_etudiants['nom']."-";
	}


$nom_fichier.=$jour."_".$mois."_".$annee."-".$heuredujour."h".$minutedujour.".pdf";
$pdf->Output($nom_fichier,'D');
//$pdf->Output('pdf.pdf','D');

}
}

?>