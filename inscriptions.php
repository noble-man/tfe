<?php	
	include('db/db.php');
?>

 
	<form method="post" action='index.php?page=recherche inscription' class='jNice'>
		
		<h3>Rechercher une inscription</h3>
		
			<fieldset>
					<label>Nom et Pr&eacute;nom</label><input type='text' class='text-medium' name='nomrech'/>
					<input type='text' class='text-medium' name='prenomrech'/>
					<input type='submit' name='recherche' value='Chercher'/>
	   		</fieldset>
	
	</form>	
	
	<form method="post" action="index.php?page=nouvel etudiant" class="jNice">
			<h3>Nouvel Etudiant</h3>
				<fieldset>
					
						<p><label>Nom:</label><input type="text" name='nom' class="text-long" /></p>
						<p><label>Pr&eacute;nom: </label><input type="text" name='prenom' class="text-long" /></p>
						
						<p><label>Adresse:</label> <input type="text" name='adresse' class="text-long" /></p>
						<p>	<label>Code Postal:</label> <input type="text" name='code' class="text-small" /></p>
						<p>	<label>Ville:</label><input type="text" name='ville' class="text-medium" />	</p>	
						<p><label>T&eacute;l&eacute;phone: </label><input type="text" name='tel' class="text-long" /></p>
						<p><label>email:</label><input type="text" name='email' class="text-long" /></p>
						<p><label>statut:</label>
								<select name='statut'>
									<option value='Candidat'>Candidat</option>
									<option value='Etudiant Inscrit'>Etudiant Inscrit</option>
								</select>
						</p> 
						
					
						<input type="submit" value="Suivant >" />
					
				</fieldset>
	 </form>
		


	