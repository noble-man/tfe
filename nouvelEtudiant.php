     <form method="post" action="index.php?page=recherche etudiant" class="jNice">
		<h3>Rechercher un &eacute;tudiant</h3>
		<fieldset>		
			<label>Nom et Pr&eacute;nom</label><input type='text' class='text-medium' name='nomrech'/>		
			<input type='text' class='text-medium' name='prenomrech'/>	
			<input type='submit' name='recherche' value='Chercher'/>
		</fieldset>
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
							
							$etud = new etudiant(array('nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'adresse' => $_POST['adresse'], 'code' => $_POST['code'], 'ville' => $_POST['ville'], 'email' => $_POST['email'], 'statut' => $_POST['statut']) ) ;
							$etud_mgt = new etudiantsManager($conn);
							
							$etud_mgt->add($etud);
							$id= $etud_mgt->get_studentid($_POST['nom'] , $_POST['prenom']);
							///$id=$ids[sizeof($ids)-1];
							//echo $id;
							}
						catch(PDOException  $e ){
							echo "Error: ".$e;
						}

						
						//$etud = new etudiant(array('nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'adresse' => $_POST['adresse']) ) ;
						//$inscr = new Inscription(array('idparticipant' => $_POST['idPart'], 'idSeance' => $_POST['idSeance'], 'idStatut' => $_POST['idStatProf']) ) ;
						
						//$db_rdv = new PDO('mysql:host=localhost;dbname=ecole', 'root', '');
					
	?>				
	<form method="post" action="index.php?page=nouveau crimrec" class="jNice">
	
		<h3>Nouvel Etudiant</h3>
			<!--<h4>Criminal Record</h4>-->
			<fieldset>
				<legend>Criminal Record:</legend>
					<p><label>Ville:</label><input type="text" name='ville' class="text-long" /></p>
					
					<p><label>Date du crime: </label><input type="date" name='date' class="text-long" /></p>
					
					<!--<p><label>Adresse, Code Postal et Ville:</label> <input type="text" name='adresse' class="text-long" />
						<input type="text" name='code' class="text-small" />
						<input type="text" name='ville' class="text-medium" />
					</p>-->
					
					<p><label>Charge: </label><input type="text" name='charge' class="text-long" /></p>
					
					<p><label>Peine:</label><input type="text" name='peine' class="text-long" /></p>
					
					<?php echo "<p><label>Identifiant &eacute;tudiant:</label><input type='text' name='fkStudent' class='text-long' value='$id'/></p>"; ?>
					
					<input type="submit" value="Suivant >" />
				
			</fieldset>
	</form>