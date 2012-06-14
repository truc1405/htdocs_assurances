<?php return array(

// texte uniquement (sans balises)
"metaCanonical"	 	  => "http://www.credit-conseil.ch/en/loan-project/credit-move.html",
"metaRobots"		    => "index,follow",
"metaDescription"	  => "CC Crédits Conseils SA: You need money to move and/or to move in? Check out our private credit under the best conditions!",
"metaTitle"			    => "Fast Credit Move. Loan - Deposit – Moving in ",


// inclu les balises (p.ex <script> ou <link>)
"header_debut"	            => "",
"header_fin"		            => "",
"javascript_debut"	        => "",
"javascript_avant_default"	=> "",
"javascript_fin"	          => "",

"background"		=> "/ressources/unilang/projet/banner_projet_habitation_demenagement.jpg",

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

"titrePage"			=> "Moving Credit",

"zone1"				=> "
	<p>
		You want to finance your move?<br/>
		You want to get a deposit for the rental guarantee?<br/> 
		You want to take this opportunity to change your <a href='/fr/{l file='urls' term='pret-projet/credit-mobilier.html'}'>furniture</a>?<br/> 
		<a href='/fr/{l file='urls' term='pret-projet/credit-travaux.html'}'>Renovation works</a> to be done in the apartment or house that you leave?
	</p>
	<p>
		CC Crédits Conseils SA will find a solution tailored to your budget for financing all the consequences bound to your move, whether the funding for a moving company, getting the rental guarantee, purchase of new furniture or even repair works.
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
