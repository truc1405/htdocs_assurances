<div class='step1'>

	<h2>{l file='demande-credit' term='Crédit solicité'}</h2>

	<fieldset>		
		<div class='number field required' data-max='250000' data-min='5000'>
			<span class='leftPart'><label for='montant' class='leftContent'>{l file='demande-credit' term='Montant désiré'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='montant' name='montant' value='{if isset($smarty.get.montant)}{$smarty.get.montant}{else}25000{/if}'/>
			</span><!--
			--><span class='thirdPart'><div class='infoBtn'></div></span><!--
			--><div class='quartPart'>{l file='demande-credit' term='info montant'}</div>			
		</div>

		<div class='select autocomplete free required field'>
			<span  class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Durée de remboursement'}</span></span><!--
			--><div class='rightPart'>
				<div id='duree' class='selectDiv' data-selected='{if isset($smarty.get.demande)}{$smarty.get.duree}{else}72{/if}'>
					{if isset($smarty.get.duree)}
						<input class='visible_option' value='' placeholder='{$smarty.get.duree}' />
					{else}
						<input class='visible_option' value='72' />
					{/if}


					<div class='options'>
						{if isset($smarty.get.duree)}
							<div class='option selected_option' id='{$smarty.get.duree}'  >{$smarty.get.duree} </div>
						{else}
							<div class='option selected_option' id='72'>72</div>
						{/if}
						<div class='option' id='6'>6</div>
						<div class='option' id='12' >12</div>
						<div class='option' id='18' >18</div>
						<div class='option' id='24' >24</div>
						<div class='option' id='30' >30</div>
						<div class='option' id='36' >36</div>
						<div class='option' id='42' >42</div>
						<div class='option' id='48' >48</div>
						<div class='option' id='54' >54</div>
						<div class='option' id='60' >60</div>
						<div class='option' id='66' >66</div>
						<div class='option' id='72' >72</div>
					</div>
				</div>
			</div><!--
			--><div class='thirdPart'><div class='infoBtn'></div></div><!--
			--><div class='quartPart'>{l file='demande-credit' term='info duree'}</div>
		</div>


		<div class='select required field'>
			<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Motif'}</span></span><!--
			--><div class='rightPart'>
				<div id='motif' class='selectDiv' data-selected=''>
					<!-- <input class='visible_option'  value='' placeholder="{l file='demande-credit' term='Choisissez une option...'}" /> -->
					<div class='visible_option'>{l file='demande-credit' term='Choisissez une option...'}</div>
					<div class='options'>
						<div class='option' id='vehicule'>{l file='demande-credit' term='Véhicule'}</div>
						<div class='option' id='habitation'>{l file='demande-credit' term='Hâbitation'}</div>
						<div class='option' id='loisirs_voyage'>{l file='demande-credit' term='Loisirs & Voyage'}</div>
						<div class='option' id='mariage_naissance'>{l file='demande-credit' term='Mariage & Naissance'}</div>
						<div class='option' id='multimedia'>{l file='demande-credit' term='Multimédia'}</div>
						<div class='option' id='sante_operations'>{l file='demande-credit' term='Santé & Opérations'}</div>
						<div class='option' id='famille'>{l file='demande-credit' term='Famille'}</div>
						<div class='option' id='rachat_de_credit'>{l file='demande-credit' term='Rachat de crédit'}</div>
						<div class='option' id='autre'>{l file='demande-credit' term='autre'}</div>
					</div>
				</div>
			</div><!--
			--><div class='thirdPart'></div>
		</div>
		

		
		<div class='text field'>
			<span class='leftPart'><label for='codePromotionnel' class='leftContent'>{l file='demande-credit' term='Code promotionnel'}</label></span><!--
			--><span class='rightPart'>				
				<input type='text' id='codePromotionnel' name='codePromotionnel' value=''/>
			</span><!--
			--><span class='thirdPart'><div class='infoBtn'></div></span><!--
			--><div class='quartPart'>{l file='demande-credit' term='info codePromotionnel'}</div>
							
		</div>	

	</fieldset>	
</div>