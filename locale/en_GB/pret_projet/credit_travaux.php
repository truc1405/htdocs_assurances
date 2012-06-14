<?php return array(

// texte uniquement (sans balises)
"metaCanonical"	 	  => "http://www.credit-conseil.ch/en/loan-project/credit-works.html",
"metaRobots"		    => "index,follow",
"metaDescription"	  => "CC Crédits Conseils SA: You want to do some works or renovations, but you don’t have the necessary fund? Get a credit to the best conditions.",
"metaTitle"			    => "Works Credit - Financing – Loan Renovation & Construction",


// inclu les balises (p.ex <script> ou <link>)
"header_debut"	            => "",
"header_fin"		            => "",
"javascript_debut"	        => "",
"javascript_avant_default"	=> "",
"javascript_fin"	          => "",

"background"		=> "/ressources/unilang/projet/banner_projet_habitation_construction.jpg",

"documentsARemettre" => "oui",
"calculateurBudget" => "oui",
"demandeCourrier" 	=> "oui",
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

"titrePage"			=> "Renovation, works, decoration credit ",

"zone1"				=> "
	<p>
		You plan to build, renovate or decorate your home? 
	</p>
	<p>
		Whatever the works you plan to do, whether inside or outside the house, CC Crédits Conseils SA will find the right credit solution tailored to your budget. 
	</p>
	<h2>Works inside your house</h2>
	<p>
		Your boiler is defective?<br/> 
		You want to buy a new stove?<br/> 
		You want to repaint all the children’s rooms?
	</p>
	<h2>Works outside your house</h2>
	<p>
		You wish to build a swimming pool, Turkish baths or a sauna?<br/> 
		You dream to buy and install a spa?<br/> 
		You wish to do some excavation or landscaping works?
	</p>

	<p>{include file='widgets/calculateur_budget2.tpl'}</p>

	<div class='documents_a_remettre'>
		
	<h2>Warning – Mandatory documents to be submitted</h2>
		<p>
			For a definitive answer within 24 hours, you have to send us as soon as possible a number of documents depending on your profile.
		</p>

		<p>{include file='widgets/documents_a_remettre.tpl'}</p>

	</div>
",


"end"=>""



// 
// <div class="column col100 rightCol leftCol"></div>
// <div class="column col50 leftCol"></div>
// <div class="column col50 rightCol"></div>
// 

);?>
