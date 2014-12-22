<?php
include_once 'admin-class.php';
$admin = new itg_admin();
$admin->_authenticate();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Administrator page</title>	
		<!-- CSS -->
		<link href="style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
		<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie6.css" /><![endif]-->
		<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie7.css" /><![endif]--> 

		<!-- JavaScripts
		<script type="text/javascript" src="style/js/jquery.js"></script>
		<script type="text/javascript" src="style/js/jNice.js"></script>
		-->
		<script type="text/javascript" src="style/js/lienactif.js"></script>
    </head>
    <body>
       <!-- 
	   <fieldset>
		   <legend>Welcome <?php echo $admin->get_nicename(); ?></legend>
                <p>
                    Here are some of the basic informations
                </p>
                <p>
                    Username: <?php echo $_SESSION['admin_login']; ?>
                </p>
                <p>
                    Email: <?php echo $admin->get_email(); ?>
                </p>
        </fieldset>
		 -->
		<fieldset>
				<?php //include ("index-part.html"); ?>
				<?php //include ("index-part.php"); ?>
				
				
			<div id="wrapper">
				<!-- h1 tag stays for the logo, you can use the a tag for linking the index page -->
				<h1><a href="#"><span>Transdmin Light</span></a></h1>
        
				<?php include("menu-horizontal.php");?>
        
				<div id="containerHolder">
					<div id="container">
						<?php include("sidebar.php");?>
					
						<?php
						//Tableau des pages autorisées à l'include
						$pagesOK['inscriptions'] = 'inscriptions.php';
							$pagesOK['nouvelle inscription'] = 'newInscription.php';
							$pagesOK['recherche inscription'] = 'rechInscription.php';
							$pagesOK['afficher inscription'] = 'affInscription.php';
							$pagesOK['modifier inscription'] = 'modifierInscription.php';
							$pagesOK['modifier inscription2'] = 'modifierInscription2.php';
							$pagesOK['effacer inscription'] = 'effacerInscription.php';
						$pagesOK['etudiants'] = 'etudiants.php';
							$pagesOK['recherche etudiant'] = 'rechEtudiant.php';
							$pagesOK['afficher etudiant'] = 'affEtudiant.php';
							$pagesOK['modifier etudiant'] = 'modifierEtudiant.php';
							$pagesOK['modifier etudiant2'] = 'modifierEtudiant2.php';
							$pagesOK['effacer etudiant'] = 'effacerEtudiant.php';
							$pagesOK['nouvel etudiant'] = 'nouvelEtudiant.php';
								$pagesOK['nouveau crimrec'] = 'crimrec.php';
						$pagesOK['professeurs'] = 'professeurs.php';
							$pagesOK['nouveau professeur'] = 'nouveauProf.php';
							$pagesOK['modifier professeur'] = 'modifierProf.php';
							$pagesOK['modifier professeur2'] = 'modifierProf2.php';
							$pagesOK['effacer professeur'] = 'effacerProfesseur.php';
						$pagesOK['cours'] = 'cours.php';
							$pagesOK['nouveau cours'] = 'nouveauCours.php';
							$pagesOK['modifier cours'] = 'modifierCours.php';
							$pagesOK['modifier cours2'] = 'modifierCours2.php';
							$pagesOK['effacer cours'] = 'effacerCours.php';
					
						//$pagesOK['contact'] = 'contact.php';
						$pagesOK[' '] = 'accueil.php';
						//Page par defaut
						//$page = 'accueil';
						$page = ' ';
						$lienpage='';
						//Si le $_GET['page'] est dans les keys du tableau $pagesOK
						if(!empty($_GET['page']) && array_key_exists($_GET['page'], $pagesOK))
						{
							//Remplace la valeur par defaut par celle de l'URL
							$page = $_GET['page'];
							$lienpage=$page;
							if($page=='recherche etudiant')$lienpage='etudiants';
							if($page=='afficher etudiant')$lienpage='etudiants';
							if($page=='modifier etudiant')$lienpage='etudiants';
							if($page=='effacer etudiant')$lienpage='etudiants';
							if($page=='nouvel etudiant')$lienpage='etudiants';
							if($page=='nouveau crimrec')$lienpage='etudiants';
							
							if($page=='nouveau professeur')$lienpage='professeurs';
							if($page=='effacer professeur')$lienpage='professeurs';
							if($page=='modifier professeur')$lienpage='professeurs';
							
							if($page=='recherche inscription')$lienpage='inscriptions';
							if($page=='afficher inscription')$lienpage='inscriptions';
							if($page=='modifier inscription')$lienpage='inscriptions';
							if($page=='modifier inscription2')$lienpage='inscriptions';
							if($page=='effacer inscription')$lienpage='inscriptions';
							
							if($page=='recherche cours')$lienpage='cours';
							if($page=='afficher cours')$lienpage='cours';
							if($page=='modifier cours')$lienpage='cours';
							if($page=='modifier cours2')$lienpage='cours';
							if($page=='effacer cours')$lienpage='cours';
							
							
							
						}
						?>
						<!-- h2 stays for breadcrumbs -->
						<h2><a href="#">Dashboard</a> &raquo; <a href="#" class="active"><?php echo($lienpage); ?></a></h2>
                
				
						<div id="main">
					
						<?php include($pagesOK[$page]); ?>

					
					
						</div> 
						<!-- // #main -->
                
					<div class="clear"></div>
				</div>
				<!-- // #container -->
			</div>	
			<!-- // #containerHolder -->
        
			<p id="footer">Application Libre de droits.</p>
		</div>
    <!-- // #wrapper -->




				
				
		</fieldset>
		
	
    </body>
</html>

