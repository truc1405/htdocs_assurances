<?php return array(

// texte uniquement (sans balises)
"metaCanonical"	 	  => "http://www.crédit-conseil.ch/pt",
"metaRobots"		    => "index,follow",
"metaDescription"	  => "Crédit conseil",
"metaTitle"			    => "Crédito Privado Online, Suíça - Genève, CC Crédits Conseils SA.",


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

"zone1"				=> "<a href='/pt/{l file='urls' term='demande-credit.html'}'><img src='/ressources/pt/accueil1.jpg' /></a>",

"zone2"				=> "

		<h1>Crédito privado on-line / fax / correio</h1>
		<p>CC Crédit Conseil SA é um dos líderes suíços da <a href='/fr/{l file='urls' term='avantages/courtier-financier.html'}'>corretagem financeira</a> no domínio do <a href='/fr/{l file='urls' term='credit-prive-en-ligne.html'}'>crédito privado ao consumo</a> ou a <a href='/fr/{l file='urls' term='rachat-credit.html'}'>compra de créditos</a>.</p>
		<p>Então, você beneficia de numerosas <a href='/fr/{l file='urls' term='pret-avantage.html'}'>vantagens para o seu empréstimo</a>. Graças ao profissionalismo e para o conhecimento perfeito das ofertas dos vários organismos financeiros presentes no mercado, os nossos conselheiros altamente qualificados estabelecerão um processo concreto nas melhores condições dentro de 24 horas!<br><br>
		E ao final, graças a nossa alta taxa de sucesso, você põe a sorte do vosso lado para que os seus projetos realizam-se !</p>
		
		<ul style='float:left;width:160px;'>
		 	<li><a href='/fr/{l file='urls' term='pret-projet/credit-auto.html'}'>Crédito carro</a></li>
		 	<li><a href='/fr/{l file='urls' term='pret-projet/credit-moto.html'}'>Crédito veículo 2 rodas</a></li>
		 	<li><a href='/fr/{l file='urls' term='pret-projet/credit-camping-car.html'}'>Crédito mobile home</a></li>
		 	<li><a href='/fr/{l file='urls' term='pret-projet/financement-bateau.html'}'>Crédito voilier, hors bord</a></li>
		</ul>
		<ul style='float:left;width:160px;'>
		 	<li><a href='/fr/{l file='urls' term='pret-projet/credit-habitation.html'}'>Crédito casa</a></li>
		 	<li><a href='/fr/{l file='urls' term='pret-projet/credit-loisir-voyage.html'}'>Crédito férias</a></li>
		 	<li><a href='/fr/{l file='urls' term='pret-projet/credit-chirurgie-sante.html'}'>Crédito saúde</a></li>
		 	<li><a href='/fr/{l file='urls' term='pret-projet/credit-informatique-multimedia.html'}'>Crédito imagens & sons</a></li>
		</ul>
",




"zone3"		=> "<img src='/ressources/pt/accueil2.jpg' />",



"zone10"	=> "
<div style='float:left;width:500px;margin-left:0px'>
 	<div style='border-bottom:1px dotted orange;margin-bottom:5px;padding-bottom:5px;color:#FC9524;font-size:15px'>As vossas vantagens  em passando por CC Crédits Conseils SA</div>

	<ul  id='avantagesGauche'>
		<li class='icon_cochon'><strong>Taxa de interesse a partir de</strong><br/> 7.5%</li>
		<li class='icon_money'><strong>Montante financiável</strong> <br/>5’000 a 250'000 CHF</li>
		<li class='icon_duree'><strong>Duração flexível du crédito</strong> <br/>6 a 72 meses</li>
	</ul><!--
 --><ul  id='avantagesDroite'>
		<li>Taxa de aceitação elevada dos processos</li>
		<li>Montante financiável : 5’000 a 250'000 CHF</li>
		<li>Duração flexível du crédito : 6 a 72 meses</li>
		<li>Resposta em princípio imediata</li>
		<li>Resposta definitiva em 24 horas</li>
		<li>Pagamento : 7 dias após assinatura do contrato</li>
		<li>Nenhumas despesas de processo</li>
	</ul>
</div>
",









"end"=>""
);?>