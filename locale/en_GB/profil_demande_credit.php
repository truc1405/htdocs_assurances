<?php return array(

// texte uniquement (sans balises)
"metaCanonical"	 	  => "http://www.credit-conseil.ch/en/profile-credit-application.html",
"metaRobots"		    => "index,follow",
"metaDescription"	  => "CC Crédits Conseils SA: Check out all the conditions for granting a consumer credit in Switzerland & get the best offers on the market.",
"metaTitle"			    => "Credit Application & Request - Quick Personal Loan Online. Geneva, Vaud, Lausanne.",


// inclu les balises (p.ex <script> ou <link>)
"header_debut"	            => "",
"header_fin"		            => "",
"javascript_debut"	        => "",
"javascript_avant_default"	=> "",
"javascript_fin"	          => "",


"background"		=> "/ressources/unilang/profil/banner_profil.jpg",


"documentsARemettre" => "oui",
"calculateurBudget" => "oui",

"demandeCourrier" 	=> "oui",
"blog"				=> "non",
"blogListe"		=> "
	<li><a href='/fr/avantages/courtier-financier.html' title='' >Pourquoi passer par un courtier plutôt qu'une banque ?</a></li>
",
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



"titrePage"			=> "Credit Application: Acceptance Criteria",

"zone1"				=> "
	<ol>
	<li>Can I get a <a href='/fr/{l file='urls' term='credit-prive-en-ligne.html'}'>private credit</a> ?</li>
	<li>If so, the credit amount requested is less than the maximum that I can receive ?</li>
	</ol>
	
	<p>After filling the form in less than 5 minutes, receive an immediate response in principle!</p>
	
	<h2>Criterion n°1: the basic conditions</h2>
	<p>in less than 5 minutes, know whether your credit application within our organization would be accepted on the basis of four criteria below :</p>
	<ul>
		<li>Your <a href='/fr/{l file='urls' term='profil/limite-age.html'}'>age</a></li>
		<li>Your <a href='/fr/{l file='urls' term='profil/credit-suisse.html'}'>nationality – residence permit – legitimation card / residence</a></li>
		<li>Your <a href='/fr/{l file='urls' term='profil/credit-situation-professionnelle.html'}'>professional situation</a></li>
		<li>Your <a href='/fr/{l file='urls' term='profil/situation-financiere.html'}'>financial situation</a></li>
	</ul>
	
	<p>If the principle answer is negative, it means that you don't meet the basic requirements for obtaining credit.</p>	
	
	<h2>Criterion n°2 : the amount of your credit</h2>
	
	<p>The amount of your credit must be at or below the maximum allowed in relation to your personal situation.</p>
	
	<p>If the principle answer is neither negative nor positive, and it tells you that an advisor will contact you, it means that the amount of your loan application is most likely higher than the maximum authorised in relation to your situation. In this case, the person responsible for your case will advise you with relevance in order that your application will be accepted by financial institutions.</p>
	
	<p>{include file='widgets/calculateur_budget2.tpl'}</p>
",















































"end"=>""
);?>