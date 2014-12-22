<?php
	include_once 'classes.php';
	include('db/db.php');

?>

<?php
						
	try{
		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8","$dbuser","$dbpassword");
		
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//get
		$inscr = new Inscription(array('fkStudent' => $_POST['fkStudent'], 'decision' => $_POST['decision'], 'remarque' => $_POST['remarque'], 'date' => $_POST['date'], 'montantVerse' => $_POST['montantVerse']));
		$inscr_mgt = new InscriptionsManager($conn);
		//$id
		
		$inscr_mgt->add($inscr);
		//$etud_mgt->add($etud);
		}
	catch(PDOException  $e ){
		echo "Error: ".$e;
	}

?>