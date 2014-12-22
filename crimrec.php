     <form method="post" action="index.php?page=recherche etudiant" class="jNice">
		<h3>Rechercher un &eacute;tudiant</h3>
		<fieldset>		
			<label>Nom et Pr&eacute;nom</label><input type='text' class='text-medium' name='nomrech'/>		
			<input type='text' class='text-medium' name='prenomrech'/>	
			<input type='submit' name='recherche' value='Chercher'/>
		</fieldset>
			<!--
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td>Vivamus rutrum nibh in felis tristique vulputate</td>
					<td class="action"><a href="#" class="view">View</a><a href="#" class="edit">Edit</a><a href="#" class="delete">Delete</a></td>
				</tr>                        
				<tr class="odd">
					<td>Duis adipiscing lorem iaculis nunc</td>
					<td class="action"><a href="#" class="view">View</a><a href="#" class="edit">Edit</a><a href="#" class="delete">Delete</a></td>
				</tr>                        
				<tr>
					<td>Donec sit amet nisi ac magna varius tempus</td>
					<td class="action"><a href="#" class="view">View</a><a href="#" class="edit">Edit</a><a href="#" class="delete">Delete</a></td>
				</tr>                        
				<tr class="odd">
					<td>Duis ultricies laoreet felis</td>
					<td class="action"><a href="#" class="view">View</a><a href="#" class="edit">Edit</a><a href="#" class="delete">Delete</a></td>
				</tr>                        
				<tr>
					<td>Vivamus rutrum nibh in felis tristique vulputate</td>
					<td class="action"><a href="#" class="view">View</a><a href="#" class="edit">Edit</a><a href="#" class="delete">Delete</a></td>
				</tr>                        
			</table>
			-->
	</form>
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
							//get
							$id=$_POST['fkStudent'];
							$etud = new criminalrecord(array('fkStudent' => $id, 'peine' => $_POST['peine'], 'ville' => $_POST['ville'], 'date' => $_POST['date'], 'charge' => $_POST['charge']) ) ;
							$etud_mgt = new criminalrecordManager($conn);
							//$id
							
							$etud_mgt->add($etud);
							//$etud_mgt->add($etud);
							}
						catch(PDOException  $e ){
							echo "Error: ".$e;
						}

						
						//$etud = new etudiant(array('nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'adresse' => $_POST['adresse']) ) ;
						//$inscr = new Inscription(array('idparticipant' => $_POST['idPart'], 'idSeance' => $_POST['idSeance'], 'idStatut' => $_POST['idStatProf']) ) ;
						
						//$db_rdv = new PDO('mysql:host=localhost;dbname=ecole', 'root', '');
					?>
	<!--				
	<form method="post" action="index.php?page=nouveau crimrec" class="jNice">
		<h3>Nouvel Etudiant</h3>
			<h4>Criminal Record</h4>
			<fieldset>
			
				<p><label>ville:</label><input type="text" name='ville' class="text-long" /></p>
				
				<p><label>date: </label><input type="date" name='date' class="text-long" /></p>
				
				<p><label>Adresse, Code Postal et Ville:</label> <input type="text" name='adresse' class="text-long" />
					<input type="text" name='code' class="text-small" />
					<input type="text" name='ville' class="text-medium" />
				</p>	
				
				<p><label>charge: </label><input type="text" name='charge' class="text-long" /></p>
				
				<p><label>peine:</label><input type="text" name='peine' class="text-long" /></p>
				
				<!--<p><label>statut:</label><input type="text" name='statut' class="text-long" /></p> <!-- mettre "candidat" comme defaut value -->
				
		<!--		<input type="submit" value="Suivant >" />
				
			</fieldset>
	</form>
	-->
	<form method="post" action="index.php?page=nouvelle inscription" class="jNice">
					<h3>Nouvel Etudiant</h3>
						<!--<h4>Enregistrer l'inscription</h4>-->
                    	<fieldset>
							<legend>Enregistrer l'inscription:</legend>
							<!-- Mettre dans Etudiant -->
							<!--
								<p><label>Dernier Diplome, D&eacute;but-fin:</label> <input type="text" class="text-long" />
									<input type="text" class="text-small" /> <input type="text" class="text-small" />
								</p>
								
								<p><label>Casier Judiciaire, Date de cr&eacute;ation, ville</label> <input type="text" class="text-long" />
									<input type="text" class="text-small" /> <input type="text" class="text-small" />
								</p>
							-->
							<?php echo "<p><label>identifiant &eacute;tudiant:</label><input type='text' name='fkStudent' class='text-long' value='$id'/></p>"; ?>
							
							<p><label>Ann&eacute;e scolaire:</label> 
								<select name='anneescolaire'>
								  <option value="1">1&egrave;re</option>
								  <option value="2">2&egrave;me</option>
								  <option value="3">3&egrave;me</option>
								</select>						
							</p>
							
							<p><label>Ann&eacute;e academique:</label> <input type="text" name='anneeacademique' class="text-long"/></p>
							
							<p><label>Montant Vers&eacute;:</label> <input type="text" name='montantVerse' class="text-long"/></p>
							
							<p> <label>Date de l'inscription:</label><input type="date" name='date' class="text-long"/></p>
								
							<p><label>D&eacute;cision:</label> 
								<select name='decision'>
								  <option value="accept&eacute;">accept&eacute;</option>
								  <option value="refus&eacute;">refus&eacute;</option>
								  <option value="pending">en attente</option>
								</select>	
							</p>
							
							<p><label>Remarque:</label><textarea rows="1" cols="1" name='remarque'></textarea></p>
							
                            <input type="submit" value="Suivant >" />
							
                        </fieldset>
    </form>