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
				<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pr&eacute;nom</th>
				<th>Statut actuel</th>
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

							$cp=$etudiants[$cpt]->get_cp();
							$ville=$etudiants[$cpt]->get_ville();
							$tel=$etudiants[$cpt]->get_tel();
							$email=$etudiants[$cpt]->get_email();
							$statut=$etudiants[$cpt]->get_statut();
							
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
									<td>$statut</td>";
							echo"		<td class='action'>
										<a href='index.php?page=afficher inscription&id=$id&nomrech=$nomrech&prenomrech=$prenomrech' class='view'>View</a>
										<a href='index.php?page=modifier inscription&id=$id&nomrech=$nomrech&prenomrech=$prenomrech&adresse=$adresse&code=$cp&ville=$ville&tel=$tel&email=$email&statut=$statut' class='edit'>Edit</a>
										<a href='index.php?page=effacer inscription&id=$id&nomrech=$nomrech&prenomrech=$prenomrech' class='delete'>Delete</a></td>
								</tr>";
						
						
							
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

<!--<form method='get' action='index.php?page=modifier etudiant&id=$id&nomrech=$nomrech&prenomrech=$prenomrech' class="jNice">-->
<form method='post' action='index.php?page=modifier inscription2' class="jNice"><!-- -->
	<h3>Details</h3>
	<!--<div>-->
	
	
	
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
					$inscr_mgt = new InscriptionsManager($conn);
					if(!empty($_GET['id']))
						{
							$etudiant= $etud_mgt->get($_GET['id']);
							$inscription= $inscr_mgt->get($_GET['id']);
							
							$id=$etudiant->get_idStudent();
							$nom=$etudiant->get_nom();
							$prenom=$etudiant->get_prenom();
							//$id=$inscription->get_idInscription();
							//$fkStudent=$inscription->get_fkStudent();
							
							$date=$inscription->get_date();
							$annee=$inscription->get_annee();
							$montantVerse=$inscription->get_montantVerse();
							$decision=$inscription->get_decision();
							$remarque=$inscription->get_remarque();
							
							echo"<fieldset>";
								echo"<legend>Donn&eacute;es personnelles:</legend>";
									echo"<label><h4>Identifiant:</h4></label>";
									echo"$id";
								
									echo"<p>";
										echo"<label><h4>Nom:</h4></label>";
										echo"$nom";
									echo"</p>";			

									echo"<p>";
										echo"<label><h4>Pr&eacute;nom:</h4></label>";
										echo"$prenom";
									echo"</p>";
							echo"</fieldset>";
							
							echo"<fieldset>";
							echo"<legend>Donn&eacute;es d'inscription:</legend>";
							
							echo"<p><input type='hidden' name='id' class='text-medium' value='$id'></p>";
                        	
							echo"<p><label>Date:</label> <input type='text' name='date' class='text-long' value='$date'></p>";
							
							echo"<p><label>Annee:</label> <input type='text' name='annee' class='text-small' value='$annee'></p>";
							
								
							
							echo"<p><label>Montant Vers&eacute;: </label><input type='text' name='montantVerse' class='text-long' value='$montantVerse' ></p>";
							
							echo"<p><label>Decision:</label><input type='text' name='decision' class='text-long' value='$decision'></p>";
							
							echo"<p><label>Remarque:</label><input type='text' name='remarque' class='text-long' value='$remarque'></p>";
							
							
							echo"<input type='submit' value='Modifier'>";
						
						}
					}
				catch(PDOException  $e ){
					echo "Error: ".$e;
				}	
		?>
		
		
	</fieldset>
	<!--</div>-->
</form>		