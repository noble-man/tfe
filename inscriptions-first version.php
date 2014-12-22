<?php	
	include('db/db.php');
?>
 <!--<div id="main"> -->
 
	<form method="post" action='index.php?page=rechEtudiant' class='jNice'>
		
		<h3>Rechercher une inscription</h3>
		
			<fieldset>
					<label>Nom et Pr&eacute;nom</label><input type='text' class='text-medium' name='nomrech'/>
					<input type='text' class='text-medium' name='prenomrech'/>
					<input type='submit' name='recherche' value='Chercher'/>
	   		</fieldset>
			<!--
				<table cellpadding='0' cellspacing='0'>
					<tr>
						<th>Id Inscription</th>
						<th>Id Etudiant</th>-->
						<!--<th>Nom</th>-->
						<!--<th>Pr&eacute;nom</th>-->
			<!--			<th>Montant vers&eacute;</th>
						<!--<th>Photo</th>-->
						<!--<th>Date</th>-->
			<!--			<th>Date d'inscription</th>
						<th></th> -->
						<!--<th>Vendeur</th>-->
			<!--		</tr>
				</table>
			-->
	</form>	
	
	<form method="post" action='newInscription.php' class='jNice'>
		<h3>Nouvelle Inscription</h3>
                    
			
			<fieldset>
				<p><label>Numero de l'Etudiant:</label><input type="text" name='idstudent' class="text-small" /></p>
			<!--
				<p><label>Nom:</label><input type="text" name='nom' class="text-long" /></p>
				
				<p><label>Pr&eacute;nom: </label><input type="text" name='prenom' class="text-long" /></p>
				
				<p><label>Adresse:</label> <input type="text" name='adresse' class="text-long" /></p>
				
				<p><label>Code Postal:</label> <input type="text" name='code' class="text-small" /></p>
				
				<p><label>Ville:</label><input type="text" name='ville' class="text-medium" /></p>
				
				<p><label>T&eacute;l&eacute;phone: </label><input type="text" name='telephone' class="text-long" /></p>
				
				<p><label>email:</label><input type="text" name='email' class="text-long" /></p>
				
				<p><label>Dernier Diplome, D&eacute;but-fin:</label> <input type="text" name='dernierdiplome' class="text-long" />
					<input type="text" name='debut' class="text-small" /> <input type="text" name='fin' class="text-small" />
				</p>
				
				<p><label>Casier Judiciaire, Date de cr&eacute;ation, ville</label> <input type="text" name='casierjudiciaire' class="text-long" />
					<input type="text" name='datecreation' class="text-small" /> <input type="text" name='ville' class="text-small" />
				</p>
			-->
				<p>
						<label>Ann&eacute;e:</label>
							<select>
								<option>1&egrave;re</option>
								<option>2&egrave;me</option>
								<option>3&egrave;me</option>
								<option>4&egrave;me</option>
								<option>5&egrave;me</option>
								<option>6&egrave;me</option>
							</select>
				</p>
					
				<p><label>Date:</label> <input type="text" name='date' class="text-long" /></p>
				
				<p><label>Montant Vers&eacute;:</label> <input type="text" name='montant' class="text-small" /></p>
							
				<p><label>D&eacute;cision:</label> <input type="text" name='decision' class="text-medium" /></p>
				
				<p><label>Remarque:</label><textarea rows="1" cols="1" name='remarque'></textarea></p>
                
				<input type="submit" value="Envoyer" />
							
            </fieldset>
                
    </form>
				
 <!--  </div> -->

	