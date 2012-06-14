<?php return array(

// texte uniquement (sans balises)
"metaCanonical"	 	  => "http://www.credit-conseil.ch/en",
"metaRobots"		    => "index,follow",
"metaDescription"	  => "Crédit conseil",
"metaTitle"			    => "Crédit conseil: Online Private Credit, Financing & Loan. Geneva, Switzerland",


// inclu les balises (p.ex <script> ou <link>)
"header_debut"	            => "",
"header_fin"		            => "",
"javascript_debut"	        => "",
"javascript_avant_default"	=> "",
"javascript_fin"	          => "

<script src='/themes/credit_conseil/js/jquery.timer.js' type='text/javascript' charset='utf-8'></script>
<script type='text/javascript' charset='utf-8'>

	var picts = [
		'banner_homepage_auto.jpg',
		'banner_homepage_bateau.jpg',
		'banner_homepage_campingcar.jpg',
		'banner_homepage_homecinema.jpg',
		'banner_homepage_mariage.jpg',
		'banner_homepage_mobilier.jpg',
		'banner_homepage_moto.jpg',
		'banner_homepage_naissance.jpg',
		'banner_homepage_piscines.jpg',
		'banner_homepage_voyage.jpg'		
	];


	var nb = Math.ceil(Math.random()*(picts.length-1))		
	$('#body').css('backgroundImage', 'url(/ressources/unilang/accueil/'+picts[nb]+')');
	
	$(document).everyTime(5000, function(i) {
		var nb = Math.ceil(Math.random()*(picts.length-1))		
		$('#body').css('backgroundImage', 'url(/ressources/unilang/accueil/'+picts[nb]+')');
	});
	
</script>



",

"background"		=> "",


"documentsARemettre" => "oui",
"calculateurBudget" => "oui",
"demandeCourrier" 	=> "oui",
"blog"				=> "oui",
"blogListe"		=> "
	<li><a href='' title='' >Article du blog 1</a></li>
	<li><a href='' title='' >Article du blog 2</a></li>
	<li><a href='' title='' >Article du blog 3</a></li>
	<li><a href='' title='' >Article du blog 4</a></li>
	<li><a href='' title='' >Article du blog 5</a></li>
	<li><a href='' title='' >Article du blog 6</a></li>
	<li><a href='' title='' >Article du blog 7</a></li>
",
"avantages" 		=> "oui",
"avantagesListe"	=> "
	<li>Avantage 1</li>
	<li>Avantage 2</li>
	<li>Avantage 3</li>
	<li>Avantage 4</li>
	<li>Avantage 5</li>
	<li>Avantage 6</li>
	<li>Avantage 7</li>
",



//"titrePage"			=> "Accueil",

"zone1"				=> "<a href='/en/{l file='urls' term='demande-credit.html'}'><img src='/ressources/en/accueil1.jpg' /></a>",

"zone2"				=> "


		<h1>Online private credit, fax / mail</h1>
		<p>CC Crédit Conseil SA is one of the leading companies in Switzerland regarding the <a href='/fr/{l file='urls' term='avantages/courtier-financier.html'}'>financial brokerage</a>in the field of the <a href='/fr/{l file='urls' term='credit-prive-en-ligne.html'}'>private consumer credit</a> or the  <a href='/fr/{l file='urls' term='rachat-credit.html'}'>credit repurchase</a>.</p>
		<p>As a result, you get  <a href='/fr/{l file='urls' term='pret-avantage.html'}'>many advantages for your loan</a>. Thanks to the professionalism & the seamless knowledge of the different offers proposed by the various organizations on the market, our highly qualified consultants will build a strong file with the best conditions on the market and that within 24 hours!<br><br>
		And finally, thanks to our high success rate, you put the odds on your side so that your projects come to reality!</p>
		
		<ul style='float:left;width:160px;'>
		 	<li><a href='/fr/{l file='urls' term='pret-projet/credit-auto.html'}'>Car Credit</a></li>
		 	<li><a href='/fr/{l file='urls' term='pret-projet/credit-moto.html'}'>Motorcycle Credit</a></li>
		 	<li><a href='/fr/{l file='urls' term='pret-projet/credit-camping-car.html'}'>Mobile Home Credit</a></li>
		 	<li><a href='/fr/{l file='urls' term='pret-projet/financement-bateau.html'}'>Sailboat, Speedboat Credit</a></li>
		</ul>
		<ul style='float:left;width:160px;'>
		 	<li><a href='/fr/{l file='urls' term='pret-projet/credit-habitation.html'}'>House Credi</a></li>
		 	<li><a href='/fr/{l file='urls' term='pret-projet/credit-loisir-voyage.html'}'>Holidays Credit</a></li>
		 	<li><a href='/fr/{l file='urls' term='pret-projet/credit-chirurgie-sante.html'}'>Health Credit</a></li>
		 	<li><a href='/fr/{l file='urls' term='pret-projet/credit-informatique-multimedia.html'}'>Image and Sound Credit</a></li>
		</ul>
	
  ",


"zone3"		=> "<img src='/ressources/en/accueil2.jpg' />",

"zone10"	=> "


<div style='float:left;width:500px;margin-left:0px'>
 	<div style='border-bottom:1px dotted orange;margin-bottom:5px;padding-bottom:5px;color:#FC9524;font-size:15px'>Your advantages with CC Crédits Conseils SA</div>

	<ul  id='avantagesGauche'>
		<li class='icon_cochon'><strong>Interest rate from</strong><br/> 7.5%</li>
		<li class='icon_money'><strong>Financial amount</strong> <br/>5’000 à 250'000 CHF</li>
		<li class='icon_duree'><strong>Flexible duration of credit</strong> <br/>6 à 72 mois</li>
	</ul><!--
 --><ul  id='avantagesDroite'>
<li>High acceptance rate of files</li>
<li>Interest rates from 7.5%</li>
<li>Financial amount: 5’000 to 250'000 CHF</li>
<li>Flexible duration of credit: 6 to 72 months</li>
<li>Immediate reply of principle</li>
<li>Final reply under 24 hours</li>
<li>Transfer: 7 days after signing the contract</li>
<li>No file fees</li>
	</ul>
</div>

",







"end"=>""
);?>