<?php return array(

// texte uniquement (sans balises)
"metaCanonical"	 	  => "http://www.credit-conseil.ch/en/private-credit/offer-credit.html",
"metaRobots"		    => "index,follow",
"metaDescription"	  => "Crédits Conseils SA: Profitez des meilleures offres de crédit privé du marché: venez découvrir nos conditions & solutions de prêt à la consommation.",
"metaTitle"			    => "Fast Online Offer Private Credit. Consumer Loan",


// inclu les balises (p.ex <script> ou <link>)
"header_debut"	            => "",
"header_fin"		            => "",
"javascript_debut"	        => "",
"javascript_avant_default"	=> "",
"javascript_fin"	          => "",


"background"		=> "/ressources/unilang/creditprive/banner_creditprive_offres.jpg",


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

"titrePage"			=> "Credit offer",

"zone1"				=> "
<h2>Basic offer</h2>
<ul>
	<li>Attractive interest rate : 7.5% - 14.5%</li>
	<li>Financed amount : 5000 à 250000 CHF</li>
	<li>Credit duration : 6 to 72 months</li>
</ul>

<h3>Fast processing of your file</h3>
<ol>
	<li>After filling the form (5 minutes maximum), you will get an immediate response of principle</li>
	<li>After receiving all the <a href='/fr/{l file='urls' term='credit-prive/documents-a-remettre.html'}'>mandatory documents</a>, you will get a <strong>definitive answer within 24 hours</strong></li>
	<li><strong> 7 days after signing the contract, you will receive your money</strong></li>
</ol>

	<p>{include file='widgets/calculateur_budget2.tpl'}</p>
	
	<div class='documents_a_remettre'>
	<h2>Documents to be submitted</h2>
		<p><strong>For a definitive answer within 24 hours</strong>, you have to send us <strong>as soon as possible a number of documents depending on your profile</strong>.</p>
		<p>{include file='widgets/documents_a_remettre.tpl'}</p>
	</div>
",

"end"=>""



/*
<h2>Offres spéciales en fonction de votre projet</h2>
<p>Listing des offres :</p>
<h3><a href='/fr/pret-projet/credit-vehicule.html'>Crédit Véhicule</a></h3>
<p>Assurance juridique véhicule</p>
<h3><a href='/fr/pret-projet/credit-habitation.html'>Crédit Habitation</a></h3>
<h3><a href='/fr/pret-projet/credit-loisir-voyage.html'>Crédit Loisirs & Voyage</a></h3>
<h3><a href='/fr/pret-projet/pret-mariage-naissance.html'>Crédit Mariage & Naissance</a></h3>
<h3><a href='/fr/pret-projet/credit-informatique-multimedia.html'>Crédit Informatique & Multimédia</a></h3>
<h3><a href='/fr/pret-projet/credit-chirurgie-sante.html'>Crédit Santé & Chirurgie</a></h3>
<h3><a href='/fr/pret-projet/pret-famille.html'>Crédit Famille</a></h3>
*/



);?>