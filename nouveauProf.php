    	<!-- <form method="post" action="index.php?page=recherche etudiant" class="jNice">
		<h3>Rechercher un &eacute;tudiant</h3>
	
		<fieldset>		
			<label>Nom et Pr&eacute;nom</label><input type='text' class='text-medium' name='nomrech'/>		
			<input type='text' class='text-medium' name='prenomrech'/>	
			<input type='submit' name='recherche' value='Chercher'/>
		</fieldset>
		
		
	</form>-->
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
							
							$prof = new professeur( array('nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'email' => $_POST['email'] ));
							//$etud_mgt = new etudiantsManager($conn);
							$prof_mgt = new professeursManager($conn);
							
							$prof_mgt->add($prof);
							//$id= $etud_mgt->get_studentid($_POST['nom'] , $_POST['prenom']);
							///$id=$ids[sizeof($ids)-1];
							//echo $id;
							}
						catch(PDOException  $e ){
							echo "Error: ".$e;
						}
						
						echo "<fieldset>";
							echo "Nouveau professeur ajout&eacute;!";
						echo "</fieldset>";
						//$etud = new etudiant(array('nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'adresse' => $_POST['adresse']) ) ;
						//$inscr = new Inscription(array('idparticipant' => $_POST['idPart'], 'idSeance' => $_POST['idSeance'], 'idStatut' => $_POST['idStatProf']) ) ;
						
						//$db_rdv = new PDO('mysql:host=localhost;dbname=ecole', 'root', '');
					
					?>				
	