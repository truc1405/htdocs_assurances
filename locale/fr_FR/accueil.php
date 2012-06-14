<?php return array(

// texte uniquement (sans balises)
"metaCanonical"	 	  => "http://www.crédit-conseil.ch/fr",
"metaRobots"		    => "index,follow",
"metaDescription"	  => "Vous êtes suisse, frontalier ou de nationalité étrangère ?  Crédit en ligne rapide, simple et à des taux avantageux. Encaissez l'argent dans 7 jours !",
"metaTitle"			    => "DEMANDE DE CREDIT en Suisse : 5'000 à 250'000 CHF - CC Crédits Conseils SA, Genève",


// inclu les balises (p.ex <script> ou <link>)
"header_debut"	            => "",
"header_fin"		            => "",
"javascript_debut"	        => "",
"javascript_avant_default"	=> "",
"javascript_fin"	          => "

<script src='/themes/credit_conseil/js/jquery.timer.js' type='text/javascript'></script>
<script type='text/javascript' >

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

"zone1"				=> "<a href='/fr/{l file='urls' term='demande-credit.html'}'><img src='/ressources/fr/accueil1.jpg' /></a>",

"zone2"				=> "
	
		<h1>Votre demande de crédit en Suisse</h1>
		<ol>
		<li>Vérifiez que vous remplissez les <a href='/fr/{l file='urls' term='profil-demande-credit.html'}'>conditions de base</a> pour obtenir un <a href='/fr/{l file='urls' term='credit-prive-en-ligne.html'}'>crédit privé</a> en suisse.</li>
		<li>Remplissez le <a href='/fr/{l file='urls' term='demande-credit.html'}'>formulaire en ligne</a> en moins de 5 minutes et recevez une <strong>réponse de principe immédiate</strong> !</li>
		<li>Au terme du remplissage du formulaire, nous vous indiquons quels <a href='/fr/{l file='urls' term='credit-prive/documents-a-remettre.html'}'>documents</a> vous devez nous remettre obligatoirement afin que nous puissions traiter votre dossier et vous donner une <strong>réponse définitive en moins de 24 heures</strong>.</li>
		
		<li><strong>7 jours après la signature du contrat, encaissez l'argent</strong> !</li>	
		
		</ol>
		
		<p>Quel que soit votre projet, CC Crédits Conseils SA le finance : </p>
		<ul style='float:left;width:160px;'>
		 	<li><a href='/fr/{l file='urls' term='pret-projet/credit-auto.html'}'>Crédit voiture</a></li>
		 	<li><a href='/fr/{l file='urls' term='pret-projet/credit-moto.html'}'>Crédit véhicule 2 roues</a></li>
		 	<li><a href='/fr/{l file='urls' term='pret-projet/financement-bateau.html'}'>Crédit bateau</a></li>
		</ul>
		<ul style='float:left;width:160px;'>
		 	<li><a href='/fr/{l file='urls' term='pret-projet/credit-travaux.html'}'>Crédit rénovation</a></li>
			<li><a href='/fr/{l file='urls' term='pret-projet/credit-mobilier.html'}'>Crédit mobilier</a></li>
		 	<li><a href='/fr/{l file='urls' term='pret-projet/credit-loisir-voyage.html'}'>Crédit vacances</a></li>
		</ul>
	
",

"zone3"		=> "<img src='/ressources/fr/accueil2.jpg' />",
	
"zone10"	=> "

	<div style='float:left;width:500px;margin-left:0px'>
	 	<div style='border-bottom:1px dotted orange;margin-bottom:5px;padding-bottom:5px;color:#FC9524;font-size:15px'>Vos avantages en passant par CC Crédits Conseils SA</div>
	
		<ul  id='avantagesGauche'>
			<li class='icon_cochon'><strong>Taux d’intérêt dès</strong><br/> 7.5%</li>
			<li class='icon_money'><strong>Montant finançable</strong> <br/>5’000 à 250'000 CHF</li>
			<li class='icon_duree'><strong>Durée flexible du crédit</strong> <br/>6 à 72 mois</li>
		</ul><!--
	 --><ul  id='avantagesDroite'>
			<li>Taux d’acceptation élevé des dossiers</li>
   			<li>Montant finançable : 5’000 à 250'000 CHF</li>
   			<li>Durée flexible du crédit : 6 à 72 mois</li>
   			<li>Réponse de principe immédiate</li>
   			<li>Réponse définitive en 24 heures</li>
   			<li>Versement : 7 jours après signature du contrat</li>
   			<li>Aucun frais de dossier</li>
		</ul>
	</div>



	<div style='float:left;width:385px;margin-left:20px'>
	 	<div style='border-bottom:1px dotted orange;margin-bottom:5px;padding-bottom:5px;color:#FC9524;font-size:15px'>Actualité & Informations utiles</div>
		<ul style='font-size:10px;margin-top:10px;margin-right:10px'>
			<li><a href='/fr/{l file='urls' term='avantages/courtier-financier.html'}'>Pourquoi passer par un courtier plutôt que directement par une banque&nbsp;?</a></li>
			<li><a href='/fr/{l file='urls' term='avantages/credit-leasing.html'}'>15 bonnes raisons de préférer le Crédit au Leasing</a></li>
		</ul>
	</div>
	
",










"end"=>""
);?>