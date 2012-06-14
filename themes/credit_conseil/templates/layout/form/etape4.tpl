<div class='step4'>


	<h2>{l file='demande-credit' term='Votre situation professionnelle et vos revenus'}</h2>


	<fieldset>

		<div class='select required field'>
			<span  class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Situation professionnelle'}</span></span><!--
			--><div class='rightPart'>
				<div id='situation_pro' class='selectDiv' data-selected=''>
					<div class='visible_option'>{l file='demande-credit' term='Choisissez une option...'}</div>
					<div class='options'>
						<div class='option selected_option' id='apprenti_etudiant'>{l file='demande-credit' term='Apprenti / Etudiant'}</div>
						<div class='option' id='salarie'>{l file='demande-credit' term='Salarié'}</div>
						<div class='option' id='employe_de_son_entreprise'>{l file='demande-credit' term='Employé de votre propre société'}</div>
						<div class='option' id='independant'>{l file='demande-credit' term='Indépendant'}</div>
						<div class='option' id='rentier'>{l file='demande-credit' term='Rentier AI'}</div>
						<div class='option' id='retraite'>{l file='demande-credit' term='Retraité'}</div>
						<div class='option' id='temporaire'>{l file='demande-credit' term='Intérimaire / Temporaire'}</div>
						<div class='option' id='chomage'>{l file='demande-credit' term='Chômage'}</div>
						<div class='option' id='sans_revenu'>{l file='demande-credit' term='Sans revenu'}</div>
						<div class='option' id='service_sociaux'>{l file='demande-credit' term='Services sociaux'}</div>
					</div>
				</div>
			</div><!--
			      --><div class='thirdPart'></div>
			
		</div>
		<div class='select field required hidden'>
			<span  class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Lieu de travail'}</span></span><!--
			--><div class='rightPart'>
				<div id='lieu_de_travail' class='selectDiv' data-selected=''>
					<div class='visible_option'>{l file='demande-credit' term='Choisissez une option...'}</div>
					<div class='options'>
						<div class='option selected_option' id='geneve'>{l file='demande-credit' term='Genève'}</div>
						<div class='option' id='autre'>{l file='demande-credit' term='Autre'}</div>
					</div>
				</div><!--
				      --><div class='thirdPart'></div>
			</div>
		</div>

		<div class='select hidden required field'>
			<span  class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Type d\'entreprise'}</span></span><!--
			--><div class='rightPart'>
				<div id='sa_sarl' class='selectDiv' data-selected=''>
					<div class='visible_option'>{l file='demande-credit' term='Choisissez une option...'}</div>
					<div class='options'>
						<div class='option selected_option' id='sa'>{l file='demande-credit' term='SA'}</div>
						<div class='option' id='sarl'>{l file='demande-credit' term='Sàrl'}</div>
					</div>
				</div><!--
				      --><div class='thirdPart'></div>
			</div>
		</div>

		<div class='field hidden dateMois required' data-max='50' data-min='0'>
			<span class='leftPart'><label for='meme_situation_depuis' class='leftContent'>{l file='demande-credit' term='Dans la même situation depuis'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='meme_situation_depuis' name='meme_situation_depuis' value='' maxlength='7' />
			</span><!--
			--><div class='thirdPart'>mm/aaaa</div>
		</div>
		
		
		<div class='text hidden field required'>
			<span class='leftPart'><label for='nom_employeur' class='leftContent'>{l file='demande-credit' term='Nom de l\'employeur'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='nom_employeur' name='nom_employeur' value=''/>
			</span><!--
			       --><div class='thirdPart'></div>
		</div>
		
		
		<div class='text hidden field'>
			<span  class='leftPart'><label for ='nom_employeur_prec' class='leftContent'>{l file='demande-credit' term='Nom de l\'employeur précédent'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='nom_employeur_prec' name='nom_employeur_prec' value=''/>
			</span><!--
			       --><div class='thirdPart'></div>
		</div>
		
		<div class='select hidden field'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Chez l\'employeur précédent pendant'}</span></span><!--
			--><div class='rightPart'>
				<div id='chez_employeur_prec_depuis' class='selectDiv' data-selected=''>
					<div class='visible_option'>{l file='demande-credit' term='Choisissez une option...'}</div>
					<div class='options'>
						<div class='option selected_option' id='moins_1'>{l file='demande-credit' term='Moins d\'un an'}</div>
						<div class='option' id='1_3'>{l file='demande-credit' term='Entre 1 et 3 ans'}</div>
						<div class='option' id='3_5'>{l file='demande-credit' term='Entre 3 et 5 ans'}</div>
						<div class='option' id='plus_5'>{l file='demande-credit' term='Plus de 5 ans'}</div>
					</div>
				</div><!--
				      --><div class='thirdPart'></div>
			</div>
		</div>
		

	</fieldset>
	
	
	<fieldset>
		
		<div class='field hidden number required'>
			<span class='leftPart'><label for='salaire_net_mensuel' class='leftContent'>{l file='demande-credit' term='Revenu mensuel net'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='salaire_net_mensuel' name='salaire_net_mensuel' value='' />
			</span><!--
			       --><div class='thirdPart'></div>
		</div>
		
		<div class='field hidden number required' data-min='0'>
			<span class='leftPart'><label for='revenu_annuel_imposable' class='leftContent'>{l file='demande-credit' term='Revenu annuel imposable'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='revenu_annuel_imposable' name='revenu_annuel_imposable' value='' />
			</span><!--
			       --><div class='thirdPart'></div>
		</div>
		
		<div class='select hidden required field'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Nombre de salaires par an'}</span></span><!--
			--><div class='rightPart'>
				<div id='nb_salaire_par_an' class='selectDiv' data-selected=''>
					<div class='visible_option'>{l file='demande-credit' term='Choisissez une option...'}</div>
					<div class='options'>
						<div class='option selected_option' id='12'>{l file='demande-credit' term='12'}</div>
						<div class='option' id='13'>{l file='demande-credit' term='13'}</div>
						<div class='option' id='14'>{l file='demande-credit' term='14'}</div>
					</div>
				</div><!--
				      --><div class='thirdPart'></div>
			</div>
		</div>

		
		<div class='field number' data-min='0'>
			<span class='leftPart'><label for='autres_revenus' class='leftContent'>{l file='demande-credit' term='Autres revenus (en mensualités)'}</label>
				<label for='autres_revenus' class='info'>
					<ul>
						<li>{l file='demande-credit' term='Pension alimentaire reçue'}</li>
						<li>{l file='demande-credit' term='2e emploi'}</li>
						<li>{l file='demande-credit' term='Gratification'}</li>
						<li>{l file='demande-credit' term='Etc...'}</li>
					</ul>
				</label>
			</span><!--
			--><span class='rightPart'>				
				<input type='text' id='autres_revenus' name='autres_revenus' value=''/>
			</span><!--
			--><div class='thirdPart'><div class='infoBtn'></div></div>
			<div class='quartPart'>{l file='demande-credit' term='info autres revenus'}</div>
		</div>

		
		<div class='radio field required'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Etes-vous imposé à la source ?'}</span></span><!--
			--><div class='rightPart'>				
				<label class='option first' for='impose_a_la_source_oui'><input type='radio' id='impose_a_la_source_oui' name='impose_a_la_source' value='oui'/>{l file='demande-credit' term='Oui'}</label>
				<label class='option last' for='impose_a_la_source_non'><input type='radio' id='impose_a_la_source_non' name='impose_a_la_source' value='non'/>{l file='demande-credit' term='Non'}</label>
			</div><!--
			--><div class='thirdPart'><div class='infoBtn'></div></div>
			<div class='quartPart'>{l file='demande-credit' term='info impots source'}</div>
		</div>
	</fieldset>



</div>
