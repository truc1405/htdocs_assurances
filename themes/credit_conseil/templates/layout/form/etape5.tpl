
	<h2>{l file='demande-credit' term='Vos charges financières'}</h2>
			
	<fieldset>		
		
		<div class='radio field required'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Êtes-vous propriétaire ou locataire ?'}</span></span><!--
			--><div class='rightPart yes_not'>				
				<label class='option first' for='proprietaire_oui'><input type='radio' id='proprietaire_oui' name='proprietaire' value='oui'/>{l file='demande-credit' term='Propriétaire'}</label>
				<label class='option last' for='proprietaire_non'><input type='radio' id='proprietaire_non' name='proprietaire' value='non'/>{l file='demande-credit' term='Locataire'}</label>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		

		<div class='field number required hidden' data-min='0'>
			<span class='leftPart'><label for='charges_hypothecaires_montant' class='leftContent'>{l file='demande-credit' term='Charges hypothécaires trimestrielles'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='charges_hypothecaires_montant' name='charges_hypothecaires_montant' value=''/>
			</span><!--
			       --><div class='thirdPart'></div>
		</div>

		
		<div class='field number required hidden' data-min='0'>
			<span class='leftPart'><label for='loyer_montant' class='leftContent'>{l file='demande-credit' term='Loyer mensuel'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='loyer_montant' name='loyer_montant' value=''/>
			</span><!--
			--><div class='thirdPart'><div class='infoBtn'></div></div><!--
			--><div class='quartPart'>{l file='demande-credit' term='info loyer'}</div>
		</div>
	</fieldset>
		
	
	<fieldset>

		<div class='radio field required'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Crédits en cours'}</span></span><!--
			--><div class='rightPart yes_not'>				
				<label class='option first' for='credits_oui'><input type='radio' id='credits_oui' name='credits' value='oui'/>{l file='demande-credit' term='Oui'}</label>
				<label class='option last' for='credits_non'><input type='radio' id='credits_non' name='credits' value='non'/>{l file='demande-credit' term='Non'}</label>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		<div class='field hidden number required' data-min='0'>
			<span class='leftPart'><label for='credits_montant' class='leftContent'>{l file='demande-credit' term='Mensualités'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='credits_montant' name='credits_montant' value=''/>
			</span><!--
			       --><div class='thirdPart'></div>
		</div>
		<div class='field hidden number' data-min='0'>
			<span class='leftPart'><label for='credits_restants' class='leftContent'>{l file='demande-credit' term='Montant restant'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='credits_restants' name='credits_restants' value='' placeholder='facultatif'/>
			</span><!--
			       --><div class='thirdPart'></div>
		</div>
		<div class='radio hidden field required'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Voulez-vous regrouper vos crédits dans votre demande ?'}</span></span><!--
			--><div class='rightPart'>				
				<label class='option first' for='credits_rachat_oui'><input type='radio' id='credits_rachat_oui' name='credits_rachat' value='oui'/>{l file='demande-credit' term='Oui'}</label>
				<label class='option last' for='credits_rachat_non'><input type='radio' id='credits_rachat_non' name='credits_rachat' value='non'/>{l file='demande-credit' term='Non'}</label>
			</div><!--
			--><div class='thirdPart'><div class='infoBtn'></div></div>
			<div class='quartPart'>{l file='demande-credit' term='info rachat de crédit'}</div>
		</div>

		<div class='radio field required'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Leasings en cours'}</span></span><!--
			--><div class='rightPart yes_not'>				
				<label class='option first' for='leasings_oui'><input type='radio' id='leasings_oui' name='leasings' value='oui'/>{l file='demande-credit' term='Oui'}</label>
				<label class='option last' for='leasings_non'><input type='radio' id='leasings_non' name='leasings' value='non'/>{l file='demande-credit' term='Non'}</label>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		<div class='field hidden number required' data-min='0'>
			<span class='leftPart'><label for='leasings_montant' class='leftContent'>{l file='demande-credit' term='Mensualités'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='leasings_montant' name='leasings_montant' value=''/>
			</span><!--
			       --><div class='thirdPart'></div>
		</div>
		<div class='field hidden number' data-min='0'>
			<span class='leftPart'><label for='leasings_restants' class='leftContent'>{l file='demande-credit' term='Montant restant'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='leasings_restants' name='leasings_restants' value='' placeholder='facultatif'/>
			</span><!--
			       --><div class='thirdPart'></div>
		</div>
		<div class='radio hidden field required'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Voulez-vous regrouper vos leasings dans votre demande ?'}</span></span><!--
			--><div class='rightPart'>				
				<label class='option first' for='leasings_rachat_oui'><input type='radio' id='leasings_rachat_oui' name='leasings_rachat' value='oui'/>{l file='demande-credit' term='Oui'}</label>
				<label class='option last' for='leasings_rachat_non'><input type='radio' id='leasings_rachat_non' name='leasings_rachat' value='non'/>{l file='demande-credit' term='Non'}</label>
			</div><!--
			--><div class='thirdPart'><div class='infoBtn'></div></div>
			<div class='quartPart'>{l file='demande-credit' term='info rachat de leasing'}</div>
		</div>

	</fieldset>
	
	<fieldset>
		<div class='radio required field'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Actes de défaut de bien / saisie sur salaire'}</span></span><!--
			--><div class='rightPart yes_not'>				
				<label class='option first' for='addb_oui'><input type='radio' id='addb_oui' name='addb' value='oui'/>{l file='demande-credit' term='Oui'}</label>
				<label class='option last' for='addb_non'><input type='radio' id='addb_non' name='addb' value='non'/>{l file='demande-credit' term='Non'}</label>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		<div class='radio field required'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Poursuites en cours'}</span></span><!--
			--><div class='rightPart yes_not'>				
				<label class='option first' for='poursuites_oui'><input type='radio' id='poursuites_oui' name='poursuites' value='oui'/>{l file='demande-credit' term='Oui'}</label>
				<label class='option last' for='poursuites_non'><input type='radio' id='poursuites_non' name='poursuites' value='non'/>{l file='demande-credit' term='Non'}</label>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		<div class='field hidden number required' data-min='0'>
			<span class='leftPart'><label for='poursuites_montant' class='leftContent'>{l file='demande-credit' term='Montant des poursuites'} :</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='poursuites_montant' name='poursuites_montant' value=''/>
			</span><!--
			       --><div class='thirdPart'></div>
		</div>

		<div class='field number' data-min='0'>
			<span class='leftPart'><label for='autres_charges' class='leftContent'>{l file='demande-credit' term='Autres charges (mensuelles)'}</label>
				<label for='autres_charges'  class='info'>{l file='demande-credit' term='Pension alimentaire'}</label>
			</span><!--
			--><span class='rightPart'>				
				<input type='text' id='autres_charges' name='autres_charges' value=''/>
			</span><!--
			       --><div class='thirdPart'></div>
		</div>	

		<div class='radio field'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Avez-vous un 3e pilier ou une assurance vie ?'}</span></span><!--
			--><div class='rightPart yes_not'>				
				<label class='option first' for='3e_pillier_oui'><input type='radio' id='3e_pillier_oui' name='3e_pillier' value='oui'/>{l file='demande-credit' term='Oui'}</label>
				<label class='option last' for='3e_pillier_non'><input type='radio' id='3e_pillier_non' name='3e_pillier' value='non'/>{l file='demande-credit' term='Non'}</label>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		<div class='select field'>
			<span  class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Dans quelle caisse avez-vous votre assurance maladie ?'}</span></span><!--
			--><div class='rightPart'>
				<div id='caisse_maladie' class='selectDiv' data-selected=''>
					<div class='visible_option'>{l file='demande-credit' term='Choisissez une option...'}</div>
					<div class='options'>
						<div class='option selected_option' id='Agilia'>Agilia</div>
						<div class='option' id='Agrisano'>Agrisano</div>
						<div class='option' id='AMB'>AMB</div>
						<div class='option' id='Aquilana'>Aquilana</div>
						<div class='option' id='Arcosana'>Arcosana</div>
						<div class='option' id='Assura'>Assura</div>
						<div class='option' id='Atupri'>Atupri</div>
						<div class='option' id='Auxilia'>Auxilia</div>
						<div class='option' id='Avanex'>Avanex</div>
						<div class='option' id='Avenir'>Avenir</div>
						<div class='option' id='CM_Vallée_d_Entremont'>CM Vallée d'Entremont</div>
						<div class='option' id='Compact'>Compact</div>
						<div class='option' id='Concordia'>Concordia</div>
						<div class='option' id='CSS'>CSS</div>
						<div class='option' id='Easy_Sana'>Easy Sana</div>
						<div class='option' id='EGK_Gesundheitskasse'>EGK Gesundheitskasse</div>
						<div class='option' id='Galenos'>Galenos</div>
						<div class='option' id='Glarner_Krankenversicherung'>Glarner Krankenversicherung</div>
						<div class='option' id='Groupe Mutuel'>Groupe Mutuel</div>
						<div class='option' id='Helsana'>Helsana</div>
						<div class='option' id='Innova'>Innova</div>
						<div class='option' id='Innova_Wallis'>Innova Wallis</div>
						<div class='option' id='Intras'>Intras</div>
						<div class='option' id='KK_Birchmeier'>KK Birchmeier</div>
						<div class='option' id='KK_Einsiedeln'>KK Einsiedeln</div>
						<div class='option' id='KK_Flaachtal'>KK Flaachtal</div>
						<div class='option' id='KK_Ingenbohl'>KK Ingenbohl</div>
						<div class='option' id='KK_Luzerner Hinterland'>KK Luzerner Hinterland</div>
						<div class='option' id='KK_Simplon'>KK Simplon</div>
						<div class='option' id='KK_Steffisburg'>KK Steffisburg</div>
						<div class='option' id='KK_Stoffel'>KK Stoffel</div>
						<div class='option' id='KK_Turbenthal'>KK Turbenthal</div>
						<div class='option' id='KK_Visperterminen'>KK Visperterminen</div>
						<div class='option' id='KK_Wädenswil'>KK Wädenswil</div>
						<div class='option' id='KK_Zeneggen'>KK Zeneggen</div>
						<div class='option' id='KLuG'>KLuG</div>
						<div class='option' id='KMU-Krankenversicherung'>KMU-Krankenversicherung</div>
						<div class='option' id='Kolping'>Kolping</div>
						<div class='option' id='KPT_CPT'>KPT / CPT</div>
						<div class='option' id='Lumnezia_I'>Lumnezia I</div>
						<div class='option' id='Maxi_ch'>Maxi.ch</div>
						<div class='option' id='Moove_Sympany'>Moove Sympany</div>
						<div class='option' id='Mutuel_Assurances'>Mutuel Assurances</div>
						<div class='option' id='ÖKK'>ÖKK</div>
						<div class='option' id='Philos'>Philos</div>
						<div class='option' id='Progrès'>Progrès</div>
						<div class='option' id='Provita'>Provita</div>
						<div class='option' id='Publisana'>Publisana</div>
						<div class='option' id='Rhenusana'>Rhenusana</div>
						<div class='option' id='Sana24'>Sana24</div>
						<div class='option' id='Sanagate'>Sanagate</div>
						<div class='option' id='Sanavals'>Sanavals</div>
						<div class='option' id='Sanitas'>Sanitas</div>
						<div class='option' id='Sansan'>Sansan</div>
						<div class='option' id='SLKK'>SLKK</div>
						<div class='option' id='Sodalis'>Sodalis</div>
						<div class='option' id='Sumiswalder_KK'>Sumiswalder KK</div>
						<div class='option' id='Supra'>Supra</div>
						<div class='option' id='Swica'>Swica</div>
						<div class='option' id='Visana'>Visana</div>
						<div class='option' id='Vita_Surselva'>Vita Surselva</div>
						<div class='option' id='Vivacare'>Vivacare</div>
						<div class='option' id='Vivao_Sympany'>Vivao Sympany</div>
						<div class='option' id='Wincare'>Wincare</div>
						<div class='option' id='Autre'>Autre</div>							
					</div>
				</div><!--
				      --><div class='thirdPart'></div>
			</div>
		</div>

		
	</fieldset>


	

