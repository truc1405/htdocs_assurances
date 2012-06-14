<?php return array(

// texte uniquement (sans balises)
"metaCanonical"	 	  => "http://www.credit-conseil.ch/en/profile/credit-swiss.html",
"metaRobots"		    => "index,follow",
"metaDescription"	  => "CC Crédits Conseils SA: : If you are a Swiss or a foreigner, check out the possibilities of credit according to your residence",
"metaTitle"			    => "Private Credit in Switzerland – CH Swiss Nationality, Foreigner and Residence",


// inclu les balises (p.ex <script> ou <link>)
"header_debut"	            => "",
"header_fin"		            => "",
"javascript_debut"	        => "",
"javascript_avant_default"	=> "",
"javascript_fin"	          => "",


"background"		=> "/ressources/unilang/profil/banner_profil_nation.jpg",


"calculateurBudget" => "oui",
"demandeCourrier" 	=> "oui",
"documentsARemettre" => "oui",
"avantages" 		=> "oui",
"avantagesListe"	=> "
	<li>High acceptance rate of files</li>
	<li>Interest rates from 7.5%</li>
	<li>Financial amount: 5’000 to 250'000 CHF</li>
	<li>Flexible duration of credit: 6 to 72 months</li>
	<li>Immediate reply of principle</li>
	<li>Final reply under 24 hours</li>
	<li>Transfer: 7 days after signing the contract</li>
	<li>No file fees</li>
",
"blog"				=> "non",
"blogListe"		=> "
	<li><a href='/fr/avantages/courtier-financier.html' title='' >Pourquoi passer par un courtier plutôt qu'une banque ?</a></li>
",

"titrePage"			=> "Credit: nationality & residence",

"zone1"				=> "
	<p>
		The nationality, the types of residence permit / work or identity cards linked to residence have a direct impact on conditions for granting of <a href='/fr/{l file='urls' term='credit-prive-en-ligne.html'}'>private credit</a> in Switzerland.<br/><br/>
		Here are the two major classifications according to nationalities : 
	</p>
	<h2>Swiss nationality</h2>
	<p>
		A Swiss person whose legal address is registered on Swiss territory fulfils one of the conditions for the granting of a private loan.
	</p>
	<p>	
		Persons residing in Liechtenstein are considered like Swiss in a point of view administrative. 
	</p>
	<p>
		Swiss people whose principal residence is established abroad are subjects to the same regulations as transfrontier worker holder of a permit G. 
	</p>
	<h3>Other acceptance criteria</h3>
		<p>The other conditions to get a credit are :</p> 
	<ul>
		<li>Your <a href='/fr/{l file='urls' term='profil/limite-age.html'}'>age</a></li>
		<li>Your <a href='/fr/{l file='urls' term='profil/situation-financiere.html'}'>financial situation</a></li>
		<li>Your <a href='/fr/{l file='urls' term='profil/credit-situation-professionnelle.html'}'>employment status</a></li>
	</ul>
	</p>
	<p>{include file='widgets/calculateur_budget2.tpl'}</p>
	<h2>Foreign nationality</h2>
	<h3>Credit applications accepted under conditions</h3>
	<p>
		Credit applications made by persons holding a residence permit C,B,L,G or an identity card D,E,F are accepted, but under certain conditions :
	</p>
	<ul>
		<li>
			Residence permit C<br/>
			Those in favor of a C permit are subject to the same regulations on private credit that Swiss people with their principal residence in the Swiss territory.<br/>&nbsp;	
		</li>

		<li><a href='/fr/{l file='urls' term='profil/credit-etranger-permis-b-l.html'}'>credit for permit B & L</a></li>
		<li><a href='/fr/{l file='urls' term='profil/credit-frontalier-permis-g.html'}'>credit for permit G - Transfrontier worker</a></li>
		<li><a href='/fr/{l file='urls' term='profil/credit-carte-legitimation.html'}'>credit for legitimation card D, E & F – international civil servant</a></li>
	</ul>
	<p>{include file='widgets/calculateur_budget2.tpl'}</p>
	<h3>No possibility for granting a credit</h3>
	<p>
		The law forbids persons holding a residence booklet or permit F, N or S to get a private loan. 
	</p>
	<div class='documents_a_remettre'>

		<h2>Salaried employees in Switzerland – Documents to be submitted</h2>
	<ul>
		<li>Copy of your ID (Identity card or Passport)</li>
		<li>Copy of your residence permit (L, B or C if nationality other than Swiss)</li>
		<li>Proof of your incomes (3 pay slips and/or notification of pay entry on the bank account and/or annual salary certificate)</li>
		<li>For married or persons in « PACS », we also need the documents from your spouse or partner</li>
	</ul>
		
	</div>


	
",








































"end"=>""
);?>