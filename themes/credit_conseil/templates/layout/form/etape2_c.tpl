<div class='conjoint step2'>
	
	
	<h2>{l file='demande-credit' term='Identité de votre conjoint'}</h2>


	<p class='paragrapheConjoint'>{l file='demande-credit' term='textConjoint'}</p>

	<fieldset>

		<div class='select required field'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Titre'}</span></span><!--
			--><div class='rightPart'>
				<div id='titre_c' class='selectDiv' data-selected=''>
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
			<span class='leftPart'><label for='prenom_c' class='leftContent'>{l file='demande-credit' term='Prénom'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='prenom_c' name='prenom_c' value=''/>
			</span><!--
			       --><div class='thirdPart'></div>
		</div>
		
		<div class='text field required'>
			<span  class='leftPart'><label for ='nom_c' class='leftContent'>{l file='demande-credit' term='Nom'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='nom_c' name='nom_c' value=''/>
			</span><!--
			       --><div class='thirdPart'></div>
		</div>
		
		<div class='text field hidden'>
			<span  class='leftPart'><label for ='nom_jeune_fille_c' class='leftContent'>{l file='demande-credit' term='Nom de jeune fille'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='nom_jeune_fille_c' name='nom_jeune_fille_c' value=''/>
			</span>
		</div>
		
		<div class='date field required'>
			<span  class='leftPart'><label for ='date_naissance_c' class='leftContent'>{l file='demande-credit' term='Date de naissance'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='date_naissance_c' name='date_naissance_c'  maxlength='10'/>
			</span><!--
			--><div class='thirdPart'>jj/mm/aaaa</div>
		</div>
		
		<div class='select autocomplete required field'>
			<span  class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Nationalité'}</span></span><!--
			--><div class='rightPart'>
				<div id='nationalite_c' class='selectDiv' data-selected=''>
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
				<div id='permis_sejour_c' class='selectDiv' data-selected=''>
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

					<div id='permis_sejour_depuis_c' class='selectDiv' data-selected=''>
						<div class='visible_option'>{l file='demande-credit' term='Choisissez une option...'}</div>
						<div class='options'>
							<div class='option selected_option' id='moins_6_mois'>{l file='demande-credit' term='Moins de 6 mois'}</div>
							<div class='option' id='entre_6_12'>{l file='demande-credit' term='Entre 6 et 12 mois'}</div>
							<div class='option' id='entre_12_36'>{l file='demande-credit' term='Entre 12 et 36 mois'}</div>
							<div class='option' id='plus_36_mois'>{l file='demande-credit' term='Plus de 36 mois'}</div>
						</div>
					</div>
			</span><!--
			       --><div class='thirdPart'></div>
		</div>
		
	</fieldset>	
	
	
	
	
</div>