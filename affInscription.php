<form action="" class="jNice">
	<h3>Etudiants Inscrits</h3>
	<div>
	</br>
		<table cellpadding="0" cellspacing="0">
			<tr>
				<th>Identifiant </th>
				<th>Nom de famille</th>
				<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pr&eacute;nom</th>
				<th>Statut actuel</th>
			</tr>
			<?php
				include_once 'classes.php';
				include('db/db.php');
							
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

<form action="" class="jNice">
	<h3>Details</h3>

		<?php
				include_once 'classes.php';
				include('db/db.php');
				
				try{
					$conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8","$dbuser","$dbpassword");
					
					// set the PDO error mode to exception
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					//$etud = new etudiant(array('nom' => $_POST['nomrech'], 'prenom' => $_POST['prenomrech'], 'adresse' => $_POST['adresse']) ) ;
					$inscr_mgt = new InscriptionsManager($conn);
					$etud_mgt = new etudiantsManager($conn);
					
					if(!empty($_GET['id']))
						{
							$inscription= $inscr_mgt->get($_GET['id']);
							$etudiant= $etud_mgt->get($_GET['id']);
							
							$id=$etudiant->get_idStudent();
							$nom=$etudiant->get_nom();
							$prenom=$etudiant->get_prenom();
							
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
									//echo"<p>";
										echo"<label><h4>Date d'inscription:</h4></label>";
										echo"$date";
									//echo"</p>";

									echo"<p>";
										echo"<label><h4>Ann&eacute;e :</h4></label>";
										echo"$annee";
									echo"</p>";

									echo"<p>";
										echo"<label><h4>Montant Vers&eacute;:</h4></label>";
										echo"$montantVerse";
									echo"</p>";
							
									echo"<label><h4>Decision:</h4></label>";
									echo"$decision";
									
									echo"<p>";
										echo"<label><h4>Remarque:</h4></label>";
										echo"$remarque";
									echo"</p>";
							echo"</fieldset>";
						
						}
					}
				catch(PDOException  $e ){
					echo "Error: ".$e;
				}	
		?>
</form>		