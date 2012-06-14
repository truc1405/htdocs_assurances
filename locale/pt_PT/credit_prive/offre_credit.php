<?php return array(

// texte uniquement (sans balises)
"metaCanonical"	 	  => "http://www.credit-conseil.ch/pt/credito-privado/ofereca-credito.html",
"metaRobots"		    => "index,follow",
"metaDescription"	  => "Crédits Conseils: Aproveite das melhores ofertas de crédito privado do mercado: venha descobrir as nossas condições & soluções de empréstimo ao consumo.",
"metaTitle"			    => "Oferta de Crédito Privado Rapido em Linha. Empréstimo ao Consumo.",


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
	<li>Taxa de aceitação  elevada dos processos</li>
	<li>Taxa de interesse a partir de 7.5%</li>
	<li>Montante financiável : 5’000 a 250'000 CHF</li>
	<li>Duração flexível du crédito : 6 a 72 meses</li>
	<li>Resposta em princípio imediata</li>
	<li>Resposta definitiva em 24 horas</li>
	<li>Pagamento : 7 dias após assinatura do contrato</li>
	<li>Nenhumas despesas de processo</li>
",

"titrePage"			=> "Oferta de crédito",

"zone1"				=> "
<h2>Ofertas básicas</h2>
<ul>
	<li>Taxa de interesse vantajosa : 7.5% - 14.5%</li>
	<li>Montante finançiável : 5000 a 250000 CHF</li>
	<li>Duração do crédito : 6 a 72 meses</li>
</ul>
<h2>Ofertas especiais em função do seu projecto</h2>
<p>Lista das ofertas :</p>
<h3><a href='/pt/{l file='urls' term='pret-projet/credit-vehicule.html'}'>Crédito Veículos</a></h3>
<p>Segurança jurídica veículo</p>
<h3><a href='/pt/{l file='urls' term='pret-projet/credit-habitation.html'}'>Crédito Habitação</a></h3>
<h3><a href='/pt/{l file='urls' term='pret-projet/credit-loisir-voyage.html'}'>Crédito Lazeres e Viagem</a></h3>
<h3><a href='/pt/{l file='urls' term='pret-projet/pret-mariage-naissance.html'}'>Crédito Casamento e Nascimento</a></h3>
<h3><a href='/pt/{l file='urls' term='pret-projet/credit-informatique-multimedia.html'}'>Crédito Informatica e multimédia</a></h3>
<h3><a href='/pt/{l file='urls' term='pret-projet/credit-chirurgie-sante.html'}'>Crédito Saúde e Intervenções </a></h3>
<h3><a href='/pt/{l file='urls' term='pret-projet/pret-famille.html'}'>Crédit Família</a></h3>

	<p>{include file='widgets/calculateur_budget2.tpl'}</p>
	
	<div class='documents_a_remettre'>
	<h2>Atenção - Documentos obrigatórios à entregar</h2>
		<p><strong>Para obter uma resposta definitiva em menos de 24 horas</strong>, deve imperativamente <strong>entregar nos o mais rapido possível certos documentos que dependem do seu profil</strong>.</p>

	</div>
",

"end"=>""

);?>