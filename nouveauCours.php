
<?php
	
	include_once 'classe-cours.php';
	include('db/db.php');
	
	try{
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8","$dbuser","$dbpassword");
		
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$intitule=$_POST['intitule'];
		$annee=$_POST['annee'];
		$fkProf=$_POST['fkProf'];
		
		
		$cours = new cours( array('intitule' => $_POST['intitule'], 'fkProf' => $_POST['fkProf'],'local' => $_POST['local'], 'annee' => $_POST['annee'] ));
		//$etud_mgt = new etudiantsManager($conn);
		$cours_mgt = new coursManager($conn);
		
		$cours_mgt->add($cours);

		}
		
	catch(PDOException  $e ){
		echo "Error: ".$e;
	}
	
	echo "<fieldset>";
		echo "Nouveau cours ajout&eacute;!";
	echo "</fieldset>";

?>				
	