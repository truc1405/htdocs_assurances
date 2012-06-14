<div class='step3'>


	<h2>{l file='demande-credit' term='Vos coordonnées'}</h2>
	<fieldset>
		<div class='select required field'>
			<span  class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Pays de résidence'}</span></span><!--
			--><div class='rightPart'>
				<div id='pays' class='selectDiv' data-selected=''>
					<div class='visible_option'>{l file='demande-credit' term='Choisissez une option...'}</div>
					<div class='options'>
						<div class='option selected_option' id='suisse'>{l file='demande-credit' term='Suisse'}</div>
						<div class='option' id='france'>{l file='demande-credit' term='France'}</div>
						<div class='option' id='allemagne'>{l file='demande-credit' term='Allemagne'}</div>
						<div class='option' id='autriche'>{l file='demande-credit' term='Autriche'}</div>
						<div class='option' id='italie'>{l file='demande-credit' term='Italie'}</div>
						<div class='option' id='liechtenstein'>{l file='demande-credit' term='Liechtenstein'}</div>
					</div>
				</div>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		<div class='select field required hidden'>
			<span  class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Département'}</span></span><!--
			--><div class='rightPart'>
				<div id='region_france' class='selectDiv' data-selected=''>
					<div class='visible_option'>{l file='demande-credit' term='Choisissez une option...'}</div>
					<div class='options'></div>
				</div>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		<div class='select field autocomplete required hidden'>
			<span  class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Canton'}</span></span><!--
			--><div class='rightPart'>
				<div id='region_suisse' class='selectDiv' data-selected=''>
					<input class='visible_option' value='' placeholder="{l file='demande-credit' term='Choisissez une option...'}" />
					<div class='options'></div>
				</div>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		<div class='select field hidden required'>
			<span  class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Région'}</span></span><!--
			--><div class='rightPart'>
				<div id='region_allemagne' class='selectDiv' data-selected=''>
					<div class='visible_option'>{l file='demande-credit' term='Choisissez une option...'}</div>
					<div class='options'>
						<div class='option selected_option' id='baden'>{l file='demande-credit' term='Baden-Wurttemberg'}</div>
						<div class='option' id='bayern'>{l file='demande-credit' term='Bayers'}</div>
						<!-- <div class='option' id='autre'>{l file='demande-credit' term='Autre'}</div> -->
					</div>
				</div>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		<div class='select field hidden required'>
			<span  class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Région'}</span></span><!--
			--><div class='rightPart'>
				<div id='region_autriche' class='selectDiv' data-selected=''>
					<div class='visible_option'>{l file='demande-credit' term='Choisissez une option...'}</div>
					<div class='options'>
						<div class='option selected_option' id='vorarlberg'>{l file='demande-credit' term='Vorarlberg'}</div>
						<div class='option' id='tyrol'>{l file='demande-credit' term='Tyrol'}</div>
						<!-- <div class='option' id='autre'>{l file='demande-credit' term='Autre'}</div> -->
					</div>
				</div>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		<div class='select field hidden required'>
			<span  class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Région'}</span></span><!--
			--><div class='rightPart'>
				<div id='region_italie' class='selectDiv' data-selected=''>
					<div class='visible_option'>{l file='demande-credit' term='Choisissez une option...'}</div>
					<div class='options'>
						<div class='option selected_option' id='val_d_aosta'>{l file='demande-credit' term='Val d\'Aosta'}</div>
						<div class='option' id='piemonte'>{l file='demande-credit' term='Piemonte'}</div>
						<div class='option' id='lombardia'>{l file='demande-credit' term='Lombardia'}</div>
						<div class='option' id='trentino_alto_adige'>{l file='demande-credit' term='Trentino Alto adige'}</div>
						<!-- <div class='option' id='autre'>{l file='demande-credit' term='Autre'}</div> -->
					</div>
				</div>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>


		<div class='field select hidden autocomplete required'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Code postal / NPA'}</span></span><!--
			--><div class='rightPart'>
				<div id='zip' class='selectDiv' data-selected=''>
					<input class='visible_option' value='' placeholder="{l file='demande-credit' term='Choisissez une option...'}" />
					<div class='options'></div>
				</div>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		
		
		<div class='field select hidden autocomplete required'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Commune / Localité'}</span></span><!--
			--><div class='rightPart'>
				<div id='ville' class='selectDiv' data-selected=''>
					<input class='visible_option' value='' placeholder="{l file='demande-credit' term='Choisissez une option...'}" />
					<div class='options'></div>
				</div>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		
		
		
		<div class='select field autocomplete free displayWarn hidden required'>
			<span  class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Adresse'}</span></span><!--
			--><div class='rightPart'>
				<div id='adresse_suisse' class='selectDiv' data-selected=''>
					<input class='visible_option' value='' placeholder="{l file='demande-credit' term='Choisissez une option...'}" />
					<div class='options'></div>
				</div>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		
		
		<div class='field text hidden  required'>
			<span class='leftPart'><label for='adresse' class='leftContent'>{l file='demande-credit' term='Adresse'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='adresse' name='adresse' value='' />
			</span><!--
			       --><div class='thirdPart'></div>
		</div>
	
		<div class='field hidden text'>
			<span class='leftPart'><label for='numero' class='leftContent'>{l file='demande-credit' term='Numéro'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='numero' name='numero' value='' />
			</span>
		</div>
	
		<div class='field dateMois required'>
			<span class='leftPart'><label for='adresse_depuis' class='leftContent'>{l file='demande-credit' term='A cette adresse depuis'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='adresse_depuis' name='adresse_depuis' value='' maxlength='7'/>
			</span><!--
			--><div class='thirdPart'>mm/aaaa</div>
		</div>
	</fieldset>	



	<div id='adressePrecedente'>
		<h2>{l file='demande-credit' term='Adresse précédente'}</h2>
		<fieldset>
			<div class='select field required'>
				<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Pays de résidence précédent'}</span></span><!--
				--><span class='rightPart'>				
					<div id='pays_prec' class='selectDiv' data-selected=''>
						<div class='visible_option'>{l file='demande-credit' term='Choisissez une option...'}</div>
						<div class='options'>
							<div class='option selected_option' id='suisse'>{l file='demande-credit' term='Suisse'}</div>
							<div class='option' id='france'>{l file='demande-credit' term='France'}</div>
							<div class='option' id='allemagne'>{l file='demande-credit' term='Allemagne'}</div>
							<div class='option' id='autriche'>{l file='demande-credit' term='Autriche'}</div>
							<div class='option' id='italie'>{l file='demande-credit' term='Italie'}</div>
							<div class='option' id='lichtenstein'>{l file='demande-credit' term='Lichtenstein'}</div>
							<div class='option' id='autre'>{l file='demande-credit' term='Autre'}</div>
						</div>
					</div>
				</span><!--
				       --><div class='thirdPart'></div>
			</div>
		
		
			<div class='select field autocomplete required hidden'>
				<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Département précédent'}</span></span><!--
				--><div class='rightPart'>
					<div id='region_france_prec' class='selectDiv' data-selected=''>
						<input class='visible_option' value='' placeholder="{l file='demande-credit' term='Choisissez une option...'}" />
						<div class='options'></div>
					</div>
				</div><!--
				      --><div class='thirdPart'></div>
			</div>
		
			<div class='select field autocomplete required hidden'>
				<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Canton précédent'}</span></span><!--
				--><div class='rightPart'>
					<div id='region_suisse_prec' class='selectDiv' data-selected=''>
						<input class='visible_option' value='' placeholder="{l file='demande-credit' term='Choisissez une option...'}" />
						<div class='options'></div>
					</div>
				</div><!--
				      --><div class='thirdPart'></div>
			</div>

			<div class='select field autocomplete hidden required'>
				<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Code postal / NPA précédent'}</span></span><!--
				--><div class='rightPart'>
					<div id='zip_prec' class='selectDiv' data-selected=''>
						<input class='visible_option' value='' placeholder="{l file='demande-credit' term='Choisissez une option...'}" />
						<div class='options'></div>
					</div>
				</div><!--
				      --><div class='thirdPart'></div>
			</div>
		
		
			<div class='select field autocomplete hidden required'>
				<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Commune / Localité précédente'}</span></span><!--
				--><div class='rightPart'>
					<div id='ville_prec' class='selectDiv' data-selected=''>
						<input class='visible_option' value='' placeholder="{l file='demande-credit' term='Choisissez une option...'}" />
						<div class='options'></div>
					</div>
				</div><!--
				      --><div class='thirdPart'></div>
			</div>
		
		
			<div class='field text hidden required'>
				<span class='leftPart'><label for='adresse_prec' class='leftContent'>{l file='demande-credit' term='Rue précédente'}</label></span><!--
				--><span class='rightPart'>				
					<input type='text' id='adresse_prec' name='adresse_prec' value='' />
				</span><!--
				       --><div class='thirdPart'></div>
			</div>

			
			<div class='select field autocomplete free displayWarn hidden required'>
				<span  class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Adresse précédente'}</span></span><!--
				--><div class='rightPart'>
					<div id='adresse_suisse_prec' class='selectDiv' data-selected=''>
						<input class='visible_option' value='' placeholder="{l file='demande-credit' term='Choisissez une option...'}" />
						<div class='options'></div>
					</div>
				</div><!--
				      --><div class='thirdPart'></div>
			</div>
			
			
			<div class='field text hidden'>
				<span class='leftPart'><label for='numero_prec' class='leftContent'>{l file='demande-credit' term='Numéro'}</label></span><!--
				--><span class='rightPart'>				
					<input type='text' id='numero_prec' name='numero_prec' value='' />
				</span>
			</div>
		
			<div class='field textarea hidden required'>
				<span class='leftPart'><label for='adresse_complete_prec' class='leftContent'>{l file='demande-credit' term='Adresse précédente'}</label></span><!--
				--><span class='rightPart'>				
					<textarea name='adresse_complete_prec' id='adresse_complete_prec' rows='4' cols='38'></textarea>
				</span><!--
				       --><div class='thirdPart'></div>
			</div>
					

			<div class='select required field'>
				<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='A cette adresse pendant'}</span></span><!--
				--><div class='rightPart'>
					<div id='adresse_pendant' class='selectDiv' data-selected=''>
						<div class='visible_option'>{l file='demande-credit' term='Choisissez une option...'}</div>
						<div class='options'>
							<div class='option selected_option' id='moins_1'>{l file='demande-credit' term='Moins d\'un an'}</div>
							<div class='option' id='1_3'>{l file='demande-credit' term='Entre 1 et 3 ans'}</div>
							<div class='option' id='3_5'>{l file='demande-credit' term='Entre 3 et 5 ans'}</div>
							<div class='option' id='plus_5'>{l file='demande-credit' term='Plus de 5 ans'}</div>
						</div>
					</div>
				</div><!--
				      --><div class='thirdPart'></div>
			</div>
		</fieldset>
	</div>



	
	
		
	<h3><div class='info'>{l file='demande-credit' term='infos contact'}</div></h3>

	<fieldset>
		<div class='select field'>

			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Téléphone mobile'}</span></span><!--
			--><div class='rightPart'>
				<div id='type_telephone_mobile' class='selectDiv' data-selected=''>
					<div class='visible_option'>{l file='demande-credit' term='Choisissez une option...'}</div>
					<div class='options'>
						<div class='option selected_option' id=''>{l file='demande-credit' term='Pas de numéro'}</div>
						<div class='option' id='+41'><div class='num_suisse'>+41</div></div>
						<div class='option' id='+39' ><div class='num_italie'>+39</div></div>
						<div class='option' id='+33'><div class='num_france'>+33</div></div>
						<div class='option' id='+41'><div class='num_allemagne'>+49</div></div>
						<div class='option' id='+43'><div class='num_autriche'>+43</div></div>
					</div>
				</div>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		
		<div class='field required hidden phone'>
			<span class='leftPart'><label for='num_mobile' class='leftContent'>{l file='demande-credit' term='Numéro'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='num_mobile' name='num_mobile' value='' />
			</span><!--
			--><div class='thirdPart'>000 000 00 00</div>
		</div>
		
		<div class='select field'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Téléphone domicile'}</span></span><!--
			--><div class='rightPart'>
				<div id='type_telephone_domicile' class='selectDiv' data-selected=''>
					<div class='visible_option'>{l file='demande-credit' term='Choisissez une option...'}</div>
					<div class='options'>
						<div class='option selected_option' id=''>{l file='demande-credit' term='Pas de numéro'}</div>
						<div class='option' id='+41'><div class='num_suisse'>+41</div></div>
						<div class='option' id='+39' ><div class='num_italie'>+39</div></div>
						<div class='option' id='+33'><div class='num_france'>+33</div></div>
						<div class='option' id='+41'><div class='num_allemagne'>+49</div></div>
						<div class='option' id='+43'><div class='num_autriche'>+43</div></div>
					</div>
				</div>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		
		<div class='field required hidden phone'>
			<span class='leftPart'><label for='num_domicile' class='leftContent'>{l file='demande-credit' term='Numéro'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='num_domicile' name='num_domicile' value='' />
			</span><!--
			--><div class='thirdPart'>000 000 00 00</div>
		</div>
	
		<div class='select field'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Téléphone professionnel'}</span></span><!--
			--><div class='rightPart'>
				<div id='type_telephone_pro' class='selectDiv' data-selected=''>
					<div class='visible_option'>{l file='demande-credit' term='Choisissez une option...'}</div>
					<div class='options'>
						<div class='option selected_option' id=''>{l file='demande-credit' term='Pas de numéro'}</div>
						<div class='option' id='+41'><div class='num_suisse'>+41</div></div>
						<div class='option' id='+39' ><div class='num_italie'>+39</div></div>
						<div class='option' id='+33'><div class='num_france'>+33</div></div>
						<div class='option' id='+41'><div class='num_allemagne'>+49</div></div>
						<div class='option' id='+43'><div class='num_autriche'>+43</div></div>
					</div>
				</div>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		
		<div class='field required hidden phone'>
			<span class='leftPart'><label for='num_professionnel' class='leftContent'>{l file='demande-credit' term='Numéro'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='num_professionnel' name='num_professionnel' value='' />
			</span><!--
			--><div class='thirdPart'>000 000 00 00</div>
		</div>
	


	</fieldset>


	
	
	
	

	

</div>
