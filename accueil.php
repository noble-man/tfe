<form method="post" action='inscription_action.php' class='jNice'>
		
		 <!--<h3>Bienvenue</h3>-->
		<h3>Bonjour <?php echo $admin->get_nicename(); ?>!</h3>
		<fieldset> 
		
		<!--<fieldset>-->
            <legend>Details du compte:</legend>
               <!-- <p>
                    Details du compte:
                </p> -->
                <p>
                    Username: <?php echo $_SESSION['admin_login']; ?>
                </p>
                <p>
                    Email: <?php echo $admin->get_email(); ?>
                </p>
        </fieldset>
		
		
			<!--<p><i>Bienvenu dans l'outil d'administration lerendezvous</i></p>-->
				<!--
					<label>Nom et Pr&eacute;nom</label><input type='text' class='text-medium' name='nomrech'/>
					<input type='text' class='text-medium' name='prenomrech'/>
					<input type='submit' name='recherche' value='Chercher'/>
					-->
	   	<!--</fieldset>-->
			
			      	
					
		<h3></h3>
         <!--        	
			<fieldset>
				
							
			</fieldset> 
		-->
                
</form>