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
					
					if(!empty($_POST['nomrech']) || !empty($_POST['prenomrech']))
					{
							
							$nomrech=$_POST['nomrech'];
							$prenomrech=$_POST['prenomrech'];
							
							$etudiants= $etud_mgt->rechEtud($_POST['nomrech'],$_POST['prenomrech']);
					
						for($cpt=0;$cpt<sizeof($etudiants);$cpt++)
						{
						
						   // $etuds[$cpt]=new etudiant($donnees);
							$id=$etudiants[$cpt]->get_idStudent();
							$nom=$etudiants[$cpt]->get_nom();
							$prenom=$etudiants[$cpt]->get_prenom();
							$adresse=$etudiants[$cpt]->get_adresse();
							$code=$etudiants[$cpt]->get_cp();
							$ville=$etudiants[$cpt]->get_ville();
							$tel=$etudiants[$cpt]->get_tel();
							$email=$etudiants[$cpt]->get_email();
							$statut=$etudiants[$cpt]->get_statut();

							//echo" $etudiants[1]->adresse";
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
										<a href='index.php?page=afficher etudiant&id=$id&nomrech=$nomrech&prenomrech=$prenomrech' class='view'>View</a>
										<a href='index.php?page=modifier etudiant&id=$id&nomrech=$nomrech&prenomrech=$prenomrech&adresse=$adresse&code=$code&ville=$ville&tel=$tel&email=$email&statut=$statut' class='edit'>Edit</a>
										<a href='index.php?page=effacer etudiant&id=$id&nomrech=$nomrech&prenomrech=$prenomrech' class='delete'>Delete</a></td>
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
	<!--<fieldset>-->
	</br>
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
							$etudiant= $etud_mgt->get($_GET['id']);
							
							
							$id=$etudiant->get_idStudent();
							$nom=$etudiant->get_nom();
							$prenom=$etudiant->get_prenom();
							$adresse=$etudiant->get_adresse();
							$cp=$etudiant->get_cp();
							$ville=$etudiant->get_ville();
							$tel=$etudiant->get_tel();
							$email=$etudiant->get_email();
							$statut=$etudiant->get_statut();

							echo"<p>$nom</p>";
							echo"<p>$prenom</p>";
						}
					}
				catch(PDOException  $e ){
					echo "Error: ".$e;
				}	
			?>
		<!--</table>-->
		
	<!--</fieldset>	-->
	<!--</div>-->
</form>	
