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
					
					$etud = new etudiant(array('nom' => $_GET['nomrech'], 'prenom' => $_GET['prenomrech'], 'adresse' => $_GET['adresse'], 'cp' => $_GET['code'], 'ville' => $_GET['ville'], 'tel' => $_GET['tel'], 'email' => $_GET['email'], 'statut' => $_GET['statut']) ) ;
					$etud_mgt = new etudiantsManager($conn);
					$nomrech='';
					$prenomrech='';
					$id='';
					
							
							
					/* if(!empty($_GET['id']))
						{
							
							//$etud_mgt->add($etud);
							echo"on est ici";
							
						} */
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
									<td>$adresse</td>
									<td class='action'>
										<a href='index.php?page=afficher etudiant&id=$id&nomrech=$nomrech&prenomrech=$prenomrech' class='view'>View</a>
										<a href='index.php?page=modifier etudiant&id=$id&nomrech=$nomrech&prenomrech=$prenomrech&adresse=$adresse&code=$cp&ville=$ville&tel=$tel&email=$email&statut=$statut' class='edit'>Edit</a>
										<a href='index.php?page=effacer etudiant&id=$id&nomrech=$nomrech&prenomrech=$prenomrech' class='delete'>Delete</a></td>
								</tr>";
							//echo "$temp"." ca c'est etuds";
							//<a href='index.php?page=modifier etudiant&id=$id&nomrech=$nomrech&prenomrech=$prenomrech' class='edit'>Edit</a>;
						
							
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
<form method='post' action='index.php?page=modifier etudiant2' class="jNice"><!-- -->
	<h3>Details</h3>
	<!--<div>-->
	<fieldset>
	
	
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
							
							//echo"<input type='hidden' name='page' value='modifier etudiant'>";
							
							echo"<p><label>Identifiant:</label><input type='text' name='id' class='text-long' value='$id'></p>";
						
							echo"<p><label>Nom:</label><input type='text' name='nomrech' class='text-long' value='$nom'></p>";
							
							echo"<p><label>Pr&eacute;nom: </label><input type='text' name='prenomrech' class='text-long' value='$prenom'></p>";
                        	
							echo"<p><label>Adresse:</label> <input type='text' name='adresse' class='text-long' value='$adresse'></p>";
							
							echo"<p><label>Code Postal:</label> <input type='text' name='code' class='text-small' value='$cp'></p>";
							
							echo"<p><label>Ville:</label><input type='text' name='ville' class='text-medium' value='$ville'></p>";	
							
							echo"<p><label>T&eacute;l&eacute;phone: </label><input type='text' name='tel' class='text-long' value='$tel' ></p>";
							
							echo"<p><label>email:</label><input type='text' name='email' class='text-long' value='$email'></p>";
							
							echo"<p><label>statut:</label><input type='text' name='statut' class='text-long' value='$statut'></p>";
							
							
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