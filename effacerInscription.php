<form action="" class="jNice">
	<h3>Etudiants Inscrits</h3>
	<div>
	<!--<fieldset>-->
	</br>
		<table cellpadding="0" cellspacing="0">
				<tr>
					<!--<th>&nbsp;</th>-->
					<th>Identifiant </th>
					<th>Nom de famille</th>
					<th>Pr&eacute;nom</th>
					<th>Adresse actuelle</th>
					<!--<th>Photo</th>-->
					<!--<th>Date</th>-->
					<!--<th>Date d'inscription</th>
					<th></th>
					<!--<th>Vendeur</th>-->
				</tr>
			<?php
				include_once 'classes.php';
				include('db/db.php');
				//$inscr= new Inscription();
				//$inscr_mgt = new InscriptionsManager();
				//$inscr_mgt->add($inscr);
				
				
				try{
					$conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8","$dbuser","$dbpassword");
					
					// set the PDO error mode to exception
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					//$etud = new etudiant(array('nom' => $_POST['nomrech'], 'prenom' => $_POST['prenomrech'], 'adresse' => $_POST['adresse']) ) ;
					$etud_mgt = new etudiantsManager($conn);
					$nomrech='';
					$prenomrech='';
					
					if(!empty($_GET['id']))
						{
							
							$result= $etud_mgt->effacer($_GET['id']);
							
							
						}
					
					
					if(!empty($_GET['nomrech']) || !empty($_GET['prenomrech']))
					{
							
							$nomrech=$_GET['nomrech'];
							$prenomrech=$_GET['prenomrech'];
							
							$etudiants= $etud_mgt->rechEtud($_GET['nomrech'],$_GET['prenomrech']);
					
						for($cpt=0;$cpt<sizeof($etudiants);$cpt++)
						{
						
						   // $etuds[$cpt]=new etudiant($donnees);
							$id=$etudiants[$cpt]->get_idStudent();
							$nom=$etudiants[$cpt]->get_nom();
							$prenom=$etudiants[$cpt]->get_prenom();
							$adresse=$etudiants[$cpt]->get_adresse();

							
							echo"<tr>
									<td>$id</td>
								";
							echo"
									<td>$nom</td>
								";		
							echo"
									<td>$prenom</td>
								";
							echo"
									<td>$adresse</td>
									<td class='action'>
										<a href='index.php?page=afficher inscription&id=$id&nomrech=$nomrech&prenomrech=$prenomrech' class='view'>View</a>
										<a href='index.php?page=modifier inscription&id=$id&nomrech=$nomrech&prenomrech=$prenomrech' class='edit'>Edit</a>
										<a href='index.php?page=effacer inscription&id=$id&nomrech=$nomrech&prenomrech=$prenomrech' class='delete'>Delete</a></td>
								</tr>";
							//echo "$temp"." ca c'est etuds";
						
							
						}
					}
					
					}
				catch(PDOException  $e ){
					echo "Error: ".$e;
				}	
			?>
		</table>
		
	<!--</fieldset>	-->
	</div>
</form>	
<form action="" class="jNice">
	<!--<h3>Details de l'Etudiant</h3>-->
	<!--<div>-->
	</br>
	<fieldset>
	
		<!--<table cellpadding="0" cellspacing="0">
				<tr>-->
					<!--<th>&nbsp;</th>-->
					<!--<th>Identifiant </th>-->
					<!--<th>Nom de famille</th>-->
					<!--<th>Pr&eacute;nom</th>-->
					<!--<th>Adresse actuelle</th>-->
					<!--<th>Photo</th>-->
					<!--<th>Date</th>-->
					<!--<th>Date d'inscription</th>
					<th></th>
					<!--<th>Vendeur</th>-->
				<!--</tr>-->
			<?php
				include_once 'classes.php';
				include('db/db.php');
				//$inscr= new Inscription();
				//$inscr_mgt = new InscriptionsManager();
				//$inscr_mgt->add($inscr);
				
				
				try{
					$conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8","$dbuser","$dbpassword");
					
					// set the PDO error mode to exception
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					//$etud = new etudiant(array('nom' => $_POST['nomrech'], 'prenom' => $_POST['prenomrech'], 'adresse' => $_POST['adresse']) ) ;
					$etud_mgt = new etudiantsManager($conn);
					if(!empty($_GET['id']))
						{
							//$etudiant= $etud_mgt->get($_GET['id']);
							//$result= $etud_mgt->effacer($_GET['id']);
							/*
							$id=$etudiant->get_idStudent();
							$nom=$etudiant->get_nom();
							$prenom=$etudiant->get_prenom();
							$adresse=$etudiant->get_adresse();
							*/
							echo"<p>L'&eacute;tudiant a &eacute;t&eacute; supprim&eacute; de la base de donn&eacute;es</p>";
							//echo"<p>$prenom</p>";
							//echo"<p>$a</p>";
							//echo"<p>$prenom</p>";
							
						}
					}
				catch(PDOException  $e ){
					echo "Error: ".$e;
				}	
		?>
		<!--</table>-->
		
	</fieldset>	
	<!--</div>-->
</form>		