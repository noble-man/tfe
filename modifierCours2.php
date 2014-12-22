<form action="" class="jNice">
	<h3>Resultats</h3>

			<?php
				include_once 'classes.php';
				include_once 'classe-cours.php';
				include('db/db.php');

				
				
				try{
					$conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8","$dbuser","$dbpassword");
					
					// set the PDO error mode to exception
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					$cours = new cours(array('fkProf'=>$_POST['fkProf'],'intitule' => $_POST['intitule'], 'code' => $_POST['code'], 'annee' => $_POST['annee'], 'local' => $_POST['local']));
					//f$etud=;
					$cours_mgt = new coursManager($conn);
		
					if(!empty($_POST['code']))
						{
							
							//$etud_mgt->add($etud);
							
							$cours= $cours_mgt->update($cours);
							
							echo "<fieldset>";
								echo "<p>Les donn&eacute;es du cours ont &eacute;t&eacute; modifi&eacute;es!</p>";
							echo "</fieldset>";
						}					
					}
				catch(PDOException  $e ){
					echo "Error: ".$e;
				}	
			?>
</form>	

	 