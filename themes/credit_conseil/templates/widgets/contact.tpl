
<div id='pageContact' class='appliPage widescreen'> 


	<h1>{$titre}</h1>
	<h2>{$soustitre}</h2>

	<div id='coordonnees'>
	{$Coordonnees}
	</div>


	{if isset($mailReport.error) || isset($mailReport.success)}
	<div class='infoZone'>
		{$mailReport.message}
	</div>
	{/if}




	<form method='POST' name="form" action="{$shortlang}/1000/formulaire-contact.html">
		<input type='hidden' name='action' value='sendContactMail' />

			
				
					
				
				
				
				<fieldset id='contactGauche'>
				  <legend></legend>
				    	<ul class="form vhh">
				      		<li><label>{$labelGenre } *</label>{html_options name=Genre values=$GenreOptions output=$GenreOptions selected=$genreSelected}</li>
							<li><label>{$labelNom } *</label><input type="text" name="Nom" value="{$Nom}" size="25"></li>
							<li><label>{$labelAdresse } </label><input type="text" name="Adresse" value="{$Adresse}" size="25"></li>
							<li><label>{$labelNPA } </label><input type="text" name="NPA" value="{$NPA}" size="25"></li>
							<li><label>{$labelVille } </label><input type="text" name="Ville" value="{$Ville}" size="25"></li>
							<li><label>{$labelPays } </label><input type="text" name="Pays" value="{$Pays}" size="25"></li>
							<li><label>{$labelEmail } *</label><input type="text" name="Email" value="{$Email}" size="25"></li>
							<li><label>{$labelConcerne } *</label>{html_options name=Concerne values=$ConcerneOutputs output=$ConcerneOptions selected=$ConcerneSelected}</li>
				    	</ul>
				</fieldset>
				<fieldset id='contactDroite'>
				  <legend></legend>
				    	<ul class="form vhh">
							<li></li>
							<li><label>{$labelPrenom } *</label><input type="text" name="Prenom" value="{$Prenom}" size="25"></li>
							<li><label>{$labelEntreprise } </label><input type="text" name="Entreprise" value="{$Entreprise}" size="25"></li>
							<li><label>{$labelCP } </label><input type="text" name="CP" value="{$CP}" size="25"></li>
							<li><label>{$labelTelephone } </label><input type="text" name="Tel" value="{$Tel}" size="25"></li>
							<li><label>{$labelMobile } </label>	<input type="text" name="Mobile" value="{$Mobile}" size="25"></li>
							<li><label>{$labelFax } </label><input type="text" name="Fax" value="{$Fax}" size="25"></li>

				    	</ul>
				</fieldset>

				<fieldset>
				  <legend></legend>
				    	<ul class="form vhh">

							<li><label>{$labelVotreDemande}&nbsp;*</label><textarea COLS="60" ROWS="6" name="Commentaires">{$Commentaires}</textarea></li>
							<li><label></label><input type="submit"value="Envoyer"> <input type="reset" value="Annuler"></li>
				    	</ul>
				</fieldset>
				
					
				
		
	</form>

</div>
