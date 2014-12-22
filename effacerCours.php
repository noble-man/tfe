<form action="" class="jNice">
	<h3>Professeurs enregistr&eacute;s</h3>
	<div>
	<!--<fieldset>-->
	</br>
		<table cellpadding="0" cellspacing="0">
			<tr>
				<!--<th>&nbsp;</th>-->
				<th>Code du cours </th>
				<th>&nbsp;&nbsp;&nbsp;&nbsp;Intitul&eacute; du cours</th>
				<th>Id Professeur</th>
				<th>Annee</th>
				<!--<th>Photo</th>-->
				<!--<th>Date</th>-->
				<!--<th>Date d'inscription</th>
				<th></th>
				<!--<th>Vendeur</th>-->
			</tr>
			<?php
				//include_once 'classes.php';
				include_once 'classe-cours.php';
				include('db/db.php');
				//$inscr= new Inscription();
				//$inscr_mgt = new InscriptionsManager();
				//$inscr_mgt->add($inscr);
				
				
				try{
					$conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8","$dbuser","$dbpassword");
					
					// set the PDO error mode to exception
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					//$etud = new etudiant(array('nom' => $_POST['nomrech'], 'prenom' => $_POST['prenomrech'], 'adresse' => $_POST['adresse']) ) ;
					$cours_mgt = new coursManager($conn);
				
					if(!empty($_GET['id']))
						{
							
							$result= $cours_mgt->effacer($_GET['id']);
							
							echo "<fieldset>";
								echo "Un cours a &eacute;t&eacute; effac&eacute;!";
							echo "</fieldset>";
						}
					
				
							$cours= $cours_mgt->getAll();
					
						for($cpt=0;$cpt<sizeof($cours);$cpt++)
						{
						
						   //$etuds[$cpt]=new professeur($donnees);
							$fkProf=$cours[$cpt]->get_fkProf();
							$intitule=$cours[$cpt]->get_intitule();
							$code=$cours[$cpt]->get_code();
						
							$annee=$cours[$cpt]->get_annee();
							//$statut=$professeurs[$cpt]->get_statut();
							
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
		
	<!--</fieldset>	-->
	</div>

</form>	
<form method="post" action="index.php?page=nouveau cours" class="jNice">
	<h3>Ajouter un cours</h3>
		<fieldset>
				<!--<p><label>Code:</label><input type="text" name='code' class="text-long" /></p>-->
				<p><label>Intitul&eacute;:</label><input type="text" name='intitule' class="text-long" /></p>
				<p><label>Id Professeur: </label><input type="text" name='fkProf' class="text-long" /></p>
				<p><label>Annee:</label>
					<select name='annee'>
							<option value='1'>1</option>
							<option value='2'>2</option>
							<option value='3'>3</option>
					</select>
				</p>
				<!-- mettre "candidat" comme defaut value -->
				 
				<input type="submit" value="Suivant >" />
		</fieldset>
</form>