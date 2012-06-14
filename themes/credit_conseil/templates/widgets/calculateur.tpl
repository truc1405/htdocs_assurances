<div id='calculateur'>

	<div id='calculateurTitre'>
		{l term='Simulation de crédit'}
	</div>
	
	<div id='calculateurContenu'>
		
		<div id='calculateurMontant'>
			{l file='demande-credit' term='Montant désiré'} : 
			<span id='calculateurMontantTotal'>65465</span> 
			<span>chf</span>			
			<div id='sliderMontantDesire'><div class='ligne'></div></div>
		</div>
		
		
		<div id='calculateurDuree'>
			{l file='demande-credit' term='Durée'} : 
			<span id='calculateurDureeTotal'>12</span> 
			<span>{l file='demande-credit' term='mois'}</span>
			<div id='sliderDureeDesiree'><div class='ligne'></div></div>
		</div>
		
		<div id='calculateurTotal'>
			{l file='demande-credit'  term='Mensualités de'} <span id='calculateurTotalMin'></span> chf {l file='demande-credit' term='à'} <span id='calculateurTotalMax'></span> chf
		</div>

		<a id='boutonValidationCalculateur' href="/{$shortlang}/{l term='demande-credit.html'}?demande&amp;montant={$MONTANT_INITIAL}&amp;duree={$DUREE_INITIALE}">{l term='Faites une demande en ligne'}</a>
	</div>
</div>