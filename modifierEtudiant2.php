<form action="" class="jNice">
	<h3>Resultats</h3>
	<!--<div>-->
	<!--<fieldset>-->
	<!--</br>-->
		<!--<table cellpadding="0" cellspacing="0">
			<tr>
				<!--<th>&nbsp;</th>-->
				<!--<th>Identifiant </th>-->
				<!--<th>Nom de famille</th>-->
				<!--<th>Pr&eacute;nom</th>-->
				<!--<th>Adresse actuelle</th>-->
				<!--<th>Photo</th>-->
				<!--<th>Date</th>-->
				<!--<th>Date d'inscription</th>
				<th></th>
				<!--<th>Vendeur</th>-->
			<!--</tr>-->
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
					
					$etud = new etudiant(array('idStudent'=>$_POST['id'],'nom' => $_POST['nomrech'], 'prenom' => $_POST['prenomrech'], 'adresse' => $_POST['adresse'], 'cp' => $_POST['code'], 'ville' => $_POST['ville'], 'tel' => $_POST['tel'], 'email' => $_POST['email'], 'statut' => $_POST['statut']) ) ;
					//f$etud=;
					$etud_mgt = new etudiantsManager($conn);
					$nomrech='';
					$prenomrech='';
					$id='';
					
							
							
					if(!empty($_POST['id']))
						{
							
							//$etud_mgt->add($etud);
							
							$etudiants= $etud_mgt->update($etud);
							
							echo "<fieldset>";
								echo "<p>Les donn&eacute;es de l'&eacute;tudiant ont &eacute;t&eacute; modifi&eacute;es!</p>";
							echo "</fieldset>";
						}
				/* 	if(!empty($_GET['nomrech']) || !empty($_GET['prenomrech']))
					{
							
							$nomrech=$_GET['nomrech'];
							$prenomrech=$_GET['prenomrech'];
							
						//	$etudiants= $etud_mgt->rechEtud($_GET['nomrech'],$_GET['prenomrech']);
					
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
					} */
					
					}
				catch(PDOException  $e ){
					echo "Error: ".$e;
				}	
			?>
		<!--</table>-->
		
	<!--</fieldset>	-->
	<!--</div>-->

</form>	

	 