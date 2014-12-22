<form action="" class="jNice">
	<h3>Professeurs enregistr&eacute;s</h3>
	<div>
	<!--<fieldset>-->
	</br>
		<table cellpadding="0" cellspacing="0">
			<tr>
				<!--<th>&nbsp;</th>-->
				<th>Identifiant </th>
				<th>Nom de famille</th>
				<th>Pr&eacute;nom</th>
				<th>Adresse electronique</th>
				<!--<th>Photo</th>-->
				<!--<th>Date</th>-->
				<!--<th>Date d'inscription</th>
				<th></th>
				<!--<th>Vendeur</th>-->
			</tr>
			<?php
				//include_once 'classes.php';
				include_once 'classe-professeur.php';
				include('db/db.php');
				//$inscr= new Inscription();
				//$inscr_mgt = new InscriptionsManager();
				//$inscr_mgt->add($inscr);
				
				
				try{
					$conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8","$dbuser","$dbpassword");
					
					// set the PDO error mode to exception
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					//$etud = new etudiant(array('nom' => $_POST['nomrech'], 'prenom' => $_POST['prenomrech'], 'adresse' => $_POST['adresse']) ) ;
					$prof_mgt = new professeursManager($conn);
				
					if(!empty($_GET['id']))
						{
							
							$result= $prof_mgt->effacer($_GET['id']);
							
							echo "<fieldset>";
								echo "Un professeur a &eacute;t&eacute; effac&eacute;!";
							echo "</fieldset>";
						}
					
					/* if(!empty($_GET['nomrech']) || !empty($_GET['prenomrech']))
					{ */
							
							/* $nomrech=$_GET['nomrech'];
							$prenomrech=$_GET['prenomrech']; */
							//$professeurs= $prof_mgt->getAll();
							$professeurs= $prof_mgt->getAll();
					
						for($cpt=0;$cpt<sizeof($professeurs);$cpt++)
						{
						
						   // $etuds[$cpt]=new professeur($donnees);
							$id=$professeurs[$cpt]->get_idProf();
							$nom=$professeurs[$cpt]->get_nom();
							$prenom=$professeurs[$cpt]->get_prenom();
							/* $adresse=$professeurs[$cpt]->get_adresse();

							$cp=$professeurs[$cpt]->get_cp();
							$ville=$professeurs[$cpt]->get_ville();
							$tel=$professeurs[$cpt]->get_tel(); */
							$email=$professeurs[$cpt]->get_email();
							//$statut=$professeurs[$cpt]->get_statut();
							
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
									<td>$email</td>
									<td class='action'>
										<a href='index.php?page=modifier professeur&id=$id&nomrech=$nom&prenomrech=$prenom&email=$email' class='edit'>Edit</a>
										<a href='index.php?page=effacer professeur&id=$id&nomrech=$nom&prenomrech=$prenom' class='delete'>Delete</a></td>
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
		
	<!--</fieldset>	-->
	</div>

</form>	
<form method="post" action="index.php?page=nouveau professeur" class="jNice">
	<h3>Ajouter un professeur</h3>
		<fieldset>
			
				<p><label>Nom:</label><input type="text" name='nom' class="text-long" /></p>
				<p><label>Pr&eacute;nom: </label><input type="text" name='prenom' class="text-long" /></p>
				<p><label>email:</label><input type="text" name='email' class="text-long" /></p>
				 <!-- mettre "candidat" comme defaut value -->
				
				
				<input type="submit" value="Suivant >" />
			
		</fieldset>
</form>