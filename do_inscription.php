<?php
//if we got something through $_POST
if (isset($_POST['nomrech'])) {
    // here you would normally include some database connection
    include('db/db.php');
	$con = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
   // $db = new db();
    // never trust what user wrote! We must ALWAYS sanitize user input
   //$word = mysql_real_escape_string($_POST['nomrech']);
   $word = $_POST['nomrech'];
   // $word = htmlentities($word);
    // build your search query to the database
    $sql = "SELECT idStudent FROM student WHERE nom LIKE '%" . $word . "%' ORDER BY title LIMIT 10";
    // get results
   // $row = $db->select_list($sql);
   $row = mysqli_query($con, $sql);
    if(count($row)) {
        $end_result = '';
		while ( $unnum = mysqli_fetch_assoc($row) ) {
       // foreach($row as $r) {
           // $result         = $r['title'];
            // we will use this to bold the search word in result
          //  $bold           = '<span class="found">' . $word . '</span>';    
          //  $end_result     .= '<li>' . str_ireplace($word, $bold, $result) . '</li>';
				echo $unnum;
		  
       //}
	   }
        echo $end_result;
    } else {
        echo '<li>No results found</li>';
    }
}
?>

<?php

		$con = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
		$sql1 = "SELECT * FROM inscription";
		//$sql2 = "SELECT nom,prenom FROM student where=idStudent=fkStudent";
		if ( $lesinscriptions = mysqli_query($con, $sql1) ) {
		
			while ( $uneinscription = mysqli_fetch_assoc($lesinscriptions) ) {
						
				$vidinscr = utf8_encode($uneinscription['idInscr']);
				$vfkstud = utf8_encode($uneinscription['fkStudent']);
				//$vnom = utf8_encode($uneinscription['nom']);//
			//	$vdescription = utf8_encode($uneinscription['description']);//
			//	$vdescription = utf8_encode($uneinscription['description']);
				$vmontant = utf8_encode($uneinscription['montantVerse']);
			//	$vphoto = utf8_encode($uneinscription['photo']);//
				$vdate = utf8_encode($uneinscription['date']);
			//	$vdatemodification = utf8_encode($uneinscription['datemodification']);//
				//$vvendeur = utf8_encode($uneinscription['vendeur']);//
		
				echo "<tr>";
					echo "<td>$vidinscr</td>";
					echo "<td>$vfkstud</td>";
				//	echo "<td>$vnom</td>";
				//	echo "<td>$vdescription</td>";
					echo "<td>$vmontant euros</td>";
				//	echo "<td><img src='images/".$vphoto."' width='200' height='150' alt='".$vdescription."'></td>";
					echo "<td>$vdate</td>";
				//	echo "<td>$vdatemodification</td>";
				//	echo "<td>$vvendeur</td>";
					echo "<td class='action'><a href='#' class='view'>View</a><a href='#' class='edit'>Edit</a><a href='#' class='delete'>Delete</a></td>";
				echo "</tr>";
				
			}			
		}
		
		mysqli_close($con);		
	?>	