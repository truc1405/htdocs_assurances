<div class='step2'>

	<h2>{l file='demande-credit' term='Votre identité'}</h2>
	<fieldset>
		<div class='select required field'>
			<span  class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Etat civil'}</span></span><!--
			--><div class='rightPart'>
				<div id='etat_civil' class='selectDiv' data-selected=''>
					<div class='visible_option'>{l file='demande-credit' term='Choisissez une option...'}</div>
					<div class='options'>
						<div class='option selected_option' id='celibataire'>{l file='demande-credit' term='Célibataire'}</div>
						<div class='option' id='marie'>{l file='demande-credit' term='Marié(e)'}</div>
						<div class='option' id='pacse'>{l file='demande-credit' term='Pacsé(e)'}</div>
						<div class='option' id='separe'>{l file='demande-credit' term='Séparé(e)'}</div>
						<div class='option' id='divorce'>{l file='demande-credit' term='Divorcé(e)'}</div>
						<div class='option' id='veuf'>{l file='demande-credit' term='Veuf/veuve'}</div>
					</div>
				</div>
			</div><!--
				  --><div class='thirdPart'></div>
		</div>
		
		<div class='select hidden required field'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Situation familiale'}</span></span><!--
			--><div class='rightPart hidden'>
				<div id='situation_familiale' class='selectDiv' data-selected=''>
					<div class='visible_option'>{l file='demande-credit' term='Choisissez une option...'}</div>
					<div class='options'>
						<div class='option selected_option' id='seul'>{l file='demande-credit' term='Seul'}</div>
						<div class='option' id='en_couple'>{l file='demande-credit' term='En couple'}</div>
						<div class='option' id='chez_parents'>{l file='demande-credit' term='Vit chez ses parents'}</div>
					</div>
				</div>
			</div><!--
			--><div class='thirdPart'><div class='infoBtn'></div></div><!--
			--><div class='quartPart'>{l file='demande-credit' term='info situation_familiale'}</div>
		</div>
		
	</fieldset>


	<fieldset>
		<div class='select required field'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Titre'}</span></span><!--
			--><div class='rightPart'>
				<div id='titre' class='selectDiv' data-selected=''>
					<div class='visible_option'>{l file='demande-credit' term='Choisissez une option...'}</div>
					<div class='options'>
						<div class='option selected_option' id='m'>{l file='demande-credit' term='M.'}</div>
						<div class='option' id='mme'>{l file='demande-credit' term='Mme.'}</div>
					</div>
				</div>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		
		<div class='field text required'>
			<span class='leftPart'><label for='prenom' class='leftContent'>{l file='demande-credit' term='Prénom'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='prenom' name='prenom' value=''/>
			</span><!--
			       --><div class='thirdPart'></div>
		</div>
		
		<div class='text field required'>
			<span  class='leftPart'><label for ='nom' class='leftContent'>{l file='demande-credit' term='Nom'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='nom' name='nom' value=''/>
			</span><!--
			       --><div class='thirdPart'></div>
		</div>
		
		<div class='text field hidden'>
			<span  class='leftPart'><label for ='nom_jeune_fille' class='leftContent'>{l file='demande-credit' term='Nom de jeune fille'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='nom_jeune_fille' name='nom_jeune_fille' value=''/>
			</span><!--
			       --><div class='thirdPart'></div>
		</div>
		
		<div class='date field required'>
			<span  class='leftPart'><label for ='date_naissance' class='leftContent'>{l file='demande-credit' term='Date de naissance'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='date_naissance' name='date_naissance' maxlength='10'/>
			</span><!--
			--><div class='thirdPart'>jj/mm/aaaa<div class='infoBtn'></div></div><!--
			--><div class='quartPart'>{l file='demande-credit' term='info date_naissance'}</div>
		</div>
		
		
		<div class='select autocomplete required field'>
			<span  class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Nationalité'}</span></span><!--
			--><div class='rightPart'>
				<div id='nationalite' class='selectDiv' data-selected=''>
					<input class='visible_option'  value='' placeholder="{l file='demande-credit' term='Choisissez une option...'}" />
					<div class='options'>
						{l term='nationalites' file='demande_credit'}
					</div>
				</div>
			</div><!--
				  --><div class='thirdPart'></div>
		</div>
		<div class='select required hidden field'>
			<span  class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Permis de séjour'}</span></span><!--
			--><div class='rightPart'>
				<div id='permis_sejour' class='selectDiv' data-selected=''>
					<div class='visible_option'>{l file='demande-credit' term='Choisissez une option...'}</div>
					<div class='options'>
						<div class='option selected_option' id='c'>{l file='demande-credit' term='C'}</div>
						<div class='option' id='b'>{l file='demande-credit' term='B'}</div>
						<div class='option' id='l'>{l file='demande-credit' term='L'}</div>
						<div class='option' id='g'>{l file='demande-credit' term='G'}</div>
						<div class='option' id='def'>{l file='demande-credit' term='D,E,F Fonctionnaires internationaux'}</div>
					</div>
				</div>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		

		<div class='field select hidden required'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='En possession de votre permis de séjour depuis'}</span></span><!--
			--><span class='rightPart'>				

					<div id='permis_sejour_depuis' class='selectDiv' data-selected=''>
						<div class='visible_option'>{l file='demande-credit' term='Choisissez une option...'}</div>
						<div class='options'>
							<div class='option selected_option' id='moins_6_mois'>{l file='demande-credit' term='Moins de 6 mois'}</div>
							<div class='option' id='entre_6_12'>{l file='demande-credit' term='Entre 6 et 12 mois'}</div>
							<div class='option' id='entre_12_36'>{l file='demande-credit' term='Entre 12 et 36 mois'}</div>
							<div class='option' id='plus_36_mois'>{l file='demande-credit' term='Plus de 36 mois'}</div>
						</div>
					</div>
			</span><!--
			      --><div class='thirdPart'><div class='infoBtn'></div></div><!--
			--><div class='quartPart'>{l file='demande-credit' term='info permis_sejour'}</div>
		</div>
		
		
	</fieldset>
	
	
	<fieldset>
		<div class='radio field required'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Enfants à charge'}</span></span><!--
			--><div class='rightPart'>				
				<label class='option first' for='enfants_a_charge_oui'><input type='radio' id='enfants_a_charge_oui' name='enfants_a_charge' value='oui'/>{l file='demande-credit' term='Oui'}</label>
				<label class='option last' for='enfants_a_charge_non'><input type='radio' id='enfants_a_charge_non' name='enfants_a_charge' value='non'/>{l file='demande-credit' term='Non'}</label>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>

		<div class='field select hidden' >
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Nombre d\'enfants de moins de 6 ans'}</span></span><!--
			--><div class='rightPart'>									
					<div id='nb_enfants_moins_6' class='selectDiv' data-selected='0'>
					<div class='visible_option'>0</div>
					<div class='options'>
						<div class='option selected_option' id='0'>0</div>
						<div class='option' id='1'>1</div>
						<div class='option' id='2'>2</div>
						<div class='option' id='3'>3</div>
						<div class='option' id='4'>4</div>
						<div class='option' id='5'>5</div>
						<div class='option' id='6'>6</div>
					</div>
				</div>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		
		<div class='field select hidden' >
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Nombre d\'enfants de 6 à 12 ans'}</span></span><!--
			--><div class='rightPart'>				
					<div id='nb_enfants_entre_6_et_12' class='selectDiv' data-selected='0'>
					<div class='visible_option'>0</div>
					<div class='options'>
						<div class='option selected_option' id='0'>0</div>
						<div class='option' id='1'>1</div>
						<div class='option' id='2'>2</div>
						<div class='option' id='3'>3</div>
						<div class='option' id='4'>4</div>
						<div class='option' id='5'>5</div>
						<div class='option' id='6'>6</div>
					</div>
				</div>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		
		<div class='field select hidden' >
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Nombre d\'enfants de plus de 12 ans'}</span></span><!--
			--><div class='rightPart'>				
					<div id='nb_enfants_plus_12' class='selectDiv' data-selected='0'>
						<div class='visible_option'>0</div>
						<div class='options'>
							<div class='option selected_option' id='0'>0</div>
							<div class='option' id='1'>1</div>
						<div class='option' id='2'>2</div>
						<div class='option' id='3'>3</div>
						<div class='option' id='4'>4</div>
						<div class='option' id='5'>5</div>
						<div class='option' id='6'>6</div>
					</div>
				</div>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
			
	</fieldset>








</div>
