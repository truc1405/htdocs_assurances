<?php return array(

// texte uniquement (sans balises)
"metaCanonical"	 	  => "http://www.credit-conseil.ch/fr/credit-prive-en-ligne.html",
"metaRobots"		    => "index,follow",
"metaDescription"	  => "Taux attractifs. Durée de remboursement flexible: 6 à 72 mois. Réponse définitive en moins de 24 heures, argent encaissé après 7 jours !",
"metaTitle"			    => "CREDIT PRIVE Suisse: Crédit en ligne 5'000 à 250'000 CHF - CC Crédits Conseils SA, Genève",


// inclu les balises (p.ex <script> ou <link>)
"header_debut"	            => "",
"header_fin"		            => "",
"javascript_debut"	        => "",
"javascript_avant_default"	=> "",
"javascript_fin"	          => "",


"background"		=> "/ressources/unilang/creditprive/banner_creditprive.jpg",


"documentsARemettre" => "oui",
"calculateurBudget" => "oui",
"demandeCourrier" 	=> "oui",
"avantages" 		=> "oui",
"avantagesListe"	=> "
	<li>Taux d'acceptation élevé des dossiers</li>
	<li>Taux d'intérêt dès 7.5%</li>
	<li>Somme finançable: 5000 à 250000 CHF</li>
	<li>Durée flexible du crédit: 6 à 72 mois</li>
	<li>Réponse de principe immédiate</li>
	<li>Réponse définitive en 24 heures</li>
	<li>Versement: 7 jours après signature</li>
	<li>Aucun frais de dossier</li>
",
"blog"				=> "oui",
"blogListe"		=> "
	<li><a href='/fr/avantages/courtier-financier.html' title='' >Pourquoi passer par un courtier plutôt qu'une banque ?</a></li>
",

"titrePage"			=> "Prêt en ligne de 5'000 à 250'000 CHF",

"zone1"				=> "
	<p>Vous êtes de <a href='/fr/{l file='urls' term='profil/credit-suisse.html'}'>nationalité suisse ou étrangère</a> avec un permis C, B ou L, ou encore <a href='/fr/{l file='urls' term='profil/credit-frontalier-permis-g.html'}'>frontalier</a>, et désirez emprunter de l'argent pour financer un projet personnel ? Avec CC Crédits Conseils SA, <a href='/fr/{l file='urls' term='societe-de-credit.html'}'>société de crédit privé suisse</a>, vous bénéficiez des avantages suivants :</p>
	<ul>
		<li>Des <strong>conseils neutres et personnalisés</strong></li>
		<li>Des <strong>démarches administratives simplifiées et rapides</strong></li>
		<li>Des <strong>solutions de financement sur mesure</strong></li>
		<li>Les <strong>taux de crédit les plus bas du marché</strong></li>
		<li>Les <strong>probabilités d'obtention de prêt augmentées</strong></li>
	</ul>
	<p>{include file='widgets/calculateur_budget2.tpl'}</p>
	
	<h2>1. Offres de crédit aux meilleures conditions du marché</h2>
	<p>
		Grâce à CC Crédits Conseils SA, vous bénéficiez de conditions avantageuses pour votre crédit privé, comme par exemple :</p> 
	<ul>
		<li>un taux d’intérêt dès 7.5% jusqu'à 14.5%</li>
		<li>un montant finançable de 5'000 à 250'000 CHF</li>
		<li>une durée de votre emprunt allant de 6 à 72 mois</li>
	</ul>
	
	<p><a href='/fr/{l file='urls' term='pret-avantage.html'}'>Découvrez vos avantages au complet en passant par CC Crédits Conseils SA</a></p>
	<h2>2. Crédit express : encaissez l'argent dans 7 jours !</h2>
	<p>Avec CC Crédits Conseils SA, votre dossier est traité de manière express : </p>
	<ul>
		<li>Moins de <strong>5 minutes</strong> suffisent à remplir le formulaire et obtenir une <strong>réponse de prinicipe immédiate</strong></li>
		<li><strong>24 heures</strong> pour obtenir une <strong>réponse définitive</strong> après avoir réceptionné tous les documents</li>
		<li><strong>7 jours pour encaisser votre argent</strong> après la signature du contrat</li>
	</ul>

	<h2>3. Comment procéder pour obtenir votre prêt ? Très simple</h2>	
	
	<ol>
		<li>Vérifiez que vous remplissez les <a href='/fr/{l file='urls' term='profil-demande-credit.html'}'>conditions de base pour obtenir un prêt privé</a></li>
		<li>2 possibilités s'offrent à vous :
		<ul>
			<li>Télécharger et imprimer le <strong>document de demande de crédit au format PDF</strong>. Une fois le document rempli, vous pouvez nous l'envoyer : <br>- soit par <strong>fax</strong> au 0848 11 2000, <br>- soit par <strong>courrier</strong> : CC Crédits Conseils SA - CP 636 - 1290 Versoix</li>
			<li>Remplir le <strong>formulaire en ligne</strong> en moins de 5 minutes et recevoir une réponse de principe immédiate !</li>
		</ul>
		{include file='widgets/calculateur_budget2.tpl'}
		<li>Au terme du remplissage du formulaire, nous vous indiquons quels <strong>documents obligatoires</strong> vous devez nous remettre afin que nous puissions traiter votre dossier.
		<br>{include file='widgets/documents_a_remettre.tpl'}</li>

		
		
	</ol>
	

",




"end"=>""
);?>