<form action="" class="jNice">
	<h3>Liste des Cours</h3>
	<div>
	</br>
		<table cellpadding="0" cellspacing="0">
			<tr>
				<!--<th>Code du cours </th>-->
				<th>&nbsp;&nbsp;&nbsp;&nbsp;Intitul&eacute; du cours</th>
				<th>Id Professeur</th>
				<th>Local</th>
				<th>Annee</th>
			</tr>
			<?php
				
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
						  	$code=$cours[$cpt]->get_code();
							$intitule=$cours[$cpt]->get_intitule();
							$fkLocal=$cours[$cpt]->get_local();
							$fkProf=$cours[$cpt]->get_fkProf();
							$annee=$cours[$cpt]->get_annee();
						
							
							echo"
									<td>$intitule</td>
								";		
							echo"
									<td>$fkProf
											
									</td>
								";
							echo"
								<td>$fkLocal
										
								</td>
							";
							echo"
									<td>$annee</td>
									<td class='action'>
										<a href='index.php?page=modifier cours&id=$code&intitule=$intitule&fkProf=$fkProf&annee=$annee' class='edit'>Edit</a>
										<a href='index.php?page=effacer cours&id=$code&intitule=$intitule&fkProf=$fkProf' class='delete'>Delete</a></td>
								</tr>";
							
						
							
						}
					
					
					}
				catch(PDOException  $e ){
					echo "Error: ".$e;
				}	
			?>
		</table>
		
	</div>

</form>	
<form method="post" action="index.php?page=nouveau cours" class="jNice">
	<h3>Ajouter un cours</h3>
		<fieldset>
				<p><label>Intitul&eacute;:</label><input type="text" name='intitule' class="text-long" /></p>
				<p><label>Id Professeur: </label><input type="text" name='fkProf' class="text-long" /></p>
				<p><label>Local: </label><input type="text" name='local' class="text-long" /></p>
				<p><label>Annee:</label>
					<select name='annee'>
							<option value='1'>1</option>
							<option value='2'>2</option>
							<option value='3'>3</option>
					</select>
				</p>
				 
				<input type="submit" value="Suivant >" />
		</fieldset>
</form>