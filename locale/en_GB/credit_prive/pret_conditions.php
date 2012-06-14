<?php return array(

// texte uniquement (sans balises)
"metaCanonical"	 	  => "http://www.credit-conseil.ch/en/private-credit/loan-conditions.html",
"metaRobots"		    => "index,follow",
"metaDescription"	  => "Check out the conditions for granting credit. 4 criteria: age, nationality, permit- residence, professional and financial situation.",
"metaTitle"			    => "How to get a private credit in Switzerland? Loan conditions- Loan",


// inclu les balises (p.ex <script> ou <link>)
"header_debut"	            => "",
"header_fin"		            => "",
"javascript_debut"	        => "",
"javascript_avant_default"	=> "",
"javascript_fin"	          => "",


"background"		=> "/ressources/unilang/creditprive/banner_creditprive_conditions.jpg",


"calculateurBudget" => "oui",
"demandeCourrier" 	=> "oui",
"documentsARemettre" => "oui",
"avantages" 		=> "oui",
"avantagesListe"	=> "
	<li>High acceptance rate of files</li>
	<li>Interest rates from 7.5%</li>
	<li>Financial amount: 5’000 to 250'000 CHF</li>
	<li>Flexible duration of credit: 6 to 72 months</li>
",

"titrePage"			=> "How to obtain a loan: Conditions",

"zone1"				=> 
"<p>So that your credit application is accepted and sent to a selected financial organization, you must :</p>
<ol>
<li>Meet the basic requirements based on the four following criteria :</li>
	<ul>
		<li><a href='/fr/{l file='urls' term='profil/limite-age.html'}'>Your age</a></li>
		<li><a href='/fr/{l file='urls' term='profil/credit-suisse.html'}'>Your nationality- residence permit / residence</a></li>
		<li><a href='/fr/{l file='urls' term='profil/credit-situation-professionnelle.html'}'>Your employment status</a></li>
		<li><a href='/fr/{l file='urls' term='profil/situation-financiere.html'}'>Your financial situation</a></li>
	</ul>
<li>Apply for a credit loan not exceeding the maximum amount that is authorized for you.</li>
</ol>
	<p>{include file='widgets/calculateur_budget2.tpl'}</p>

",




"end"=>""
);?>