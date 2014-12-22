<form action="" class="jNice">
	<h3>Professeurs enregistr&eacute;s</h3>
	<div>
	</br>
		<table cellpadding="0" cellspacing="0">
			<tr>
				<th>Identifiant </th>
				<th>Intitul&eacute;</th>
				<th>id Prof</th>
				<th>Annee</th>
			</tr>
			<?php
				//include_once 'classes.php';
				include_once 'classe-cours.php';
				include('db/db.php');
			
				try{
					$conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8","$dbuser","$dbpassword");
					
					// set the PDO error mode to exception
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					//$etud = new etudiant(array('nom' => $_POST['nomrech'], 'prenom' => $_POST['prenomrech'], 'adresse' => $_POST['adresse']) ) ;
					$cours_mgt = new coursManager($conn);
										
							$cours= $cours_mgt->getAll();
					
						for($cpt=0;$cpt<sizeof($cours);$cpt++)
						{
						
						   // $etuds[$cpt]=new cours($donnees);
							$fkProf=$cours[$cpt]->get_fkProf();
							$intitule=$cours[$cpt]->get_intitule();
							$code=$cours[$cpt]->get_code();
							$local=$cours[$cpt]->get_local();

							$annee=$cours[$cpt]->get_annee();
							//$statut=$cours[$cpt]->get_statut();
							
							echo"<tr>
									<td>$code</td>
								";
							echo"
									<td>$intitule</td>
								";		
							echo"
									<td>$fkProf</td>
								";
							echo"
								<td>$local</td>
							";
							echo"
									<td>$annee</td>
									<td class='action'>
										<a href='index.php?page=modifier cours&id=$code&intitule=$intitule&fkProf=$fkProf&annee=$annee' class='edit'>Edit</a>
										<a href='index.php?page=effacer cours&id=$code&intitule=$intitule&fkProf=$fkProf' class='delete'>Delete</a></td>
								</tr>";
							//echo "$temp"." ca c'est etuds";
						
							
						}
					//}
					
					}
				catch(PDOException  $e ){
					echo "Error: ".$e;
				}	
			?>
		</table>
	</div>

</form>	

<form method='post' action='index.php?page=modifier cours2' class="jNice"><!-- -->
	<h3>Details</h3>
	<!--<div>-->
	<fieldset>
			<?php
				include_once 'classes.php';
				include('db/db.php');
					
				try{
					$conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8","$dbuser","$dbpassword");
					
					// set the PDO error mode to exception
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					//$etud = new etudiant(array('nom' => $_POST['nomrech'], 'prenom' => $_POST['prenomrech'], 'adresse' => $_POST['adresse']) ) ;
					$prof_mgt = new coursManager($conn);
					if(!empty($_GET['id']))
						{
							$cours= $prof_mgt->get($_GET['id']);
							
							
							$id=$cours->get_fkProf();
							$code=$cours->get_code();
							$intitule=$cours->get_intitule();
							//$email=$cours->get_email();
							$local=$cours->get_local();
							$annee=$cours->get_annee();
							//$statut=$etudiant->get_statut();
							
							echo"<p><label>Code:</label><input type='text' name='code' class='text-long' value='$code'></p>";
						
							echo"<p><label>Intitul&eacute;:</label><input type='text' name='intitule' class='text-long' value='$intitule'></p>";
							
							echo"<p><label>id Prof: </label><input type='text' name='fkProf' class='text-long' value='$fkProf'></p>";
							
							echo"<p><label>Local: </label><input type='text' name='local' class='text-long' value='$local'></p>";
 
							echo"<p><label>Ann&eacute;e:</label>
											<select name='annee' value='$annee'>
												<option value='1'>1</option>
												<option value='2'>2</option>
												<option value='3'>3</option>
											</select>
								</p>";
														
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