<div class='conjoint step5'>
	
	
	
	<h2>{l file='demande-credit' term='Charges financières de votre conjoint'}</h2>


	<fieldset>
		<div class='radio required field'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Actes de défaut de bien / saisie sur salaire'}</span></span><!--
			--><div class='rightPart yes_not'>				
				<label class='option first' for='addb_c_oui'><input type='radio' id='addb_c_oui' name='addb_c' value='oui'/>{l file='demande-credit' term='Oui'}</label>
				<label class='option last' for='addb_c_non'><input type='radio' id='addb_c_non' name='addb_c' value='non'/>{l file='demande-credit' term='Non'}</label>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		<div class='radio field required'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Poursuites en cours'}</span></span><!--
			--><div class='rightPart yes_not'>				
				<label class='option first' for='poursuites_c_oui'><input type='radio' id='poursuites_c_oui' name='poursuites_c' value='oui'/>{l file='demande-credit' term='Oui'}</label>
				<label class='option last' for='poursuites_c_non'><input type='radio' id='poursuites_c_non' name='poursuites_c' value='non'/>{l file='demande-credit' term='Non'}</label>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		<div class='field hidden number required' data-min='0'>
			<span class='leftPart'><label for='poursuites_montant_c' class='leftContent'>{l file='demande-credit' term='Montant des poursuites'} :</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='poursuites_montant_c' name='poursuites_montant_c' value=''/>
			</span><!--
			       --><div class='thirdPart'></div>
		</div>
	</fieldset>



		
	
	

	<fieldset>

		<div class='radio field required'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Crédits en cours'}</span></span><!--
			--><div class='rightPart yes_not'>				
				<label class='option first' for='credits_c_oui'><input type='radio' id='credits_c_oui' name='credits_c' value='oui'/>{l file='demande-credit' term='Oui'}</label>
				<label class='option last' for='credits_c_non'><input type='radio' id='credits_c_non' name='credits_c' value='non'/>{l file='demande-credit' term='Non'}</label>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		<div class='field hidden number required' data-min='0'>
			<span class='leftPart'><label for='credits_montant_c' class='leftContent'>{l file='demande-credit' term='Mensualités'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='credits_montant_c' name='credits_montant_c' value=''/>
			</span><!--
			       --><div class='thirdPart'></div>
		</div>
		<div class='field hidden number' data-min='0'>
			<span class='leftPart'><label for='credits_restants_c' class='leftContent'>{l file='demande-credit' term='Montant restant'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='credits_restants_c' name='credits_restants_c' value='' placeholder='facultatif'/>
			</span><!--
			       --><div class='thirdPart'></div>
		</div>
		<div class='radio hidden field required'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Voulez-vous regrouper vos crédits dans votre demande ?'}</span></span><!--
			--><div class='rightPart'>				
				<label class='option first' for='credits_rachat_c_oui'><input type='radio' id='credits_rachat_c_oui' name='credits_rachat_c' value='oui'/>{l file='demande-credit' term='Oui'}</label>
				<label class='option last' for='credits_rachat_c_non'><input type='radio' id='credits_rachat_c_non' name='credits_rachat_c' value='non'/>{l file='demande-credit' term='Non'}</label>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>

		<div class='radio field required'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Leasings en cours'}</span></span><!--
			--><div class='rightPart yes_not'>				
				<label class='option first' for='leasings_c_oui'><input type='radio' id='leasings_c_oui' name='leasings_c' value='oui'/>{l file='demande-credit' term='Oui'}</label>
				<label class='option last' for='leasings_c_non'><input type='radio' id='leasings_c_non' name='leasings_c' value='non'/>{l file='demande-credit' term='Non'}</label>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>
		<div class='field hidden number required' data-min='0'>
			<span class='leftPart'><label for='leasings_montant_c' class='leftContent'>{l file='demande-credit' term='Mensualités'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='leasings_montant_c' name='leasings_montant_c' value=''/>
			</span><!--
			       --><div class='thirdPart'></div>
		</div>
		<div class='field hidden number' data-min='0'>
			<span class='leftPart'><label for='leasings_restants_c' class='leftContent'>{l file='demande-credit' term='Montant restant'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='leasings_restants_c' name='leasings_restants_c' value='' placeholder='facultatif'/>
			</span><!--
			       --><div class='thirdPart'></div>
		</div>
		<div class='radio hidden field required'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Voulez-vous regrouper vos leasings dans votre demande ?'}</span></span><!--
			--><div class='rightPart'>				
				<label class='option first' for='leasings_rachat_c_oui'><input type='radio' id='leasings_rachat_c_oui' name='leasings_rachat_c' value='oui'/>{l file='demande-credit' term='Oui'}</label>
				<label class='option last' for='leasings_rachat_c_non'><input type='radio' id='leasings_rachat_c_non' name='leasings_rachat_c' value='non'/>{l file='demande-credit' term='Non'}</label>
			</div><!--
			      --><div class='thirdPart'></div>
		</div>

		<div class='field number' data-min='0'>
			<span class='leftPart'><label for='autres_charges_c' class='leftContent'>{l file='demande-credit' term='Autres charges (mensuelles)'}</label>
				<label for='autres_charges' class='info'>{l file='demande-credit' term='Pension alimentaire'}</label>
			</span><!--
			--><span class='rightPart'>				
				<input type='text' id='autres_charges_c' name='autres_charges_c' value=''/>
			</span><!--
			       --><div class='thirdPart'></div>
		</div>	
	</fieldset>
	
	

	
	
	
	
</div>