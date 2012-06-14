<!DOCTYPE html>
<html class='no-js'>
<head>
	
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />		
	
	<!-- Titre et autres balises meta -->
	{if isset($metaCanonical)}<title>{$metaTitle}</title>{/if}
	{if isset($metaCanonical)}<link rel="canonical" href="{$metaCanonical}"/>{/if}
	{if isset($metaRobots)}<meta name="robots" content="{$metaRobots}" />{/if}
	{if isset($metaKeywords)}<meta name="keywords" content="{$metaKeywords}" />{/if}
	{if isset($metaDescription)}<meta name="description" content="{$metaDescription}" />{/if}
	
	{if isset($header_debut)}{$header_debut}{/if}
	
	<script src="{$theme_dir}/js/1-modernizr-2b.js" type="text/javascript" ></script>

	<link href='http://fonts.googleapis.com/css?family=Molengo' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="{$theme_dir}/js/jquery-ui/css/pepper-grinder/jquery-ui-1.8.11.custom.css"> 
	<link rel="stylesheet" href="{$theme_dir}/js/shadowbox-3.0.3/shadowbox.css" type="text/css" media="screen" title="no title" >
	<link rel="stylesheet" href="{$theme_dir}/css/master.css" type="text/css" media="screen" title="no title" >
	<link rel="stylesheet" href="{$theme_dir}/css/print.css" type="text/css" media="print" title="no title" >

	<!--[if IE]>
		<link rel="stylesheet" href="{$theme_dir}/css/master_ie.css" type="text/css" media="screen" title="no title" ">
	<![endif]-->

    <!--[if IE 7]>
		<link rel="stylesheet" href="{$theme_dir}/css/ie7only.css" type="text/css" media="screen" title="no title" >
    <![endif]-->

	{if isset($header_fin)}{$header_fin}{/if}
	
	
	{if $DEV_ENVIRONMENT == 2}
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-5462683-3']);
	  _gaq.push(['_trackPageview']);
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
	{/if}
	
</head>

<body>
	
	<script type="text/javascript" >
		var shortlang = '{$shortlang}';
		var Taux1 = {$TAUX1};
		var Taux2 = {$TAUX2};
		var montantInitial = {$MONTANT_INITIAL};
		var dureeInitiale = {$DUREE_INITIALE};
		var EMPRUNT_MIN = {$EMPRUNT_MIN};
		var EMPRUNT_MAX = {$EMPRUNT_MAX};
		var DUREE_MIN = {$DUREE_MIN};
		var DUREE_MAX = {$DUREE_MAX};
		var urlFormulaireDemande = "{l term='demande-credit.html'}";
		var DEV_ENVIRONMENT = {$DEV_ENVIRONMENT}
	</script>
	
	
	
	{if !$content_only}
	<div id='body' class='{if isset($bodyclass)}{$bodyclass}{/if} {if $banner==false}nobanner{else}banner{/if} {$shortlang} {$pageName}{if isset($currentTemplate)} {$currentTemplate}{/if}' style="{if $banner==true}background:url({$background}) no-repeat center 123px;{/if}">

		<div id='entete'>
			<div id='enteteGauche'><div class='bg'></div></div>
			<div id='enteteDroite'><div class='bg'></div></div>
			
			<div id='enteteBandeLogo'>
				<div id='enteteBandeLogoContent'>
					
					<div id='slogan'>{l term='slogan'}</div>					
					<a href="/{$shortlang}/" id='thelogo'></a>
					<div id='contactHeader'>
						{l term='Besoin d&apos;aide ? Contactez-nous !'}<br/>
						<span id='contactHeaderNum'>0848 10 2000</span>
					</div>
				</div>
			</div>
			
			<div id='enteteContent'>
				<div id='enteteContent2'>
					<ul id='menuPrincipal' class='menu'>{$menuPrincipal}</ul>
					<ul id='menuSecondaire' class='menu'>{$menuSecondaire}</ul>
				
					<div id='menuLangues'>

						<!-- {if $auth==true}
							<a class="item-link" href="/{$shortlang}/accueil.html?action=deconnexion" rel='noindex,follow' >{l term='Se déconnecter'}</a> &mdash;
						{/if}
						<a class="item-link" href="/{$shortlang}/espace-client.html" >{l term='Espace client'}</a>{if $auth==true}<br/>{/if} -->


						{if isset($FR_FR) && (isset($DE_DE) || isset($EN_GB) || isset($IT_IT) || isset($PT_PT))}
						 	<!-- {if $auth!=true}&mdash;{/if} -->
							{l term='Langues'} :
						 	{if isset($FR_FR)}<a class="item-link" href="/fr/{l file='urls' term=$uri lang='fr_FR'}">fr</a>{/if}
						 	{if isset($DE_DE)}<a class="item-link" href="/de/{l file='urls' term=$uri lang='de_DE'}">de</a>{/if}
						 	{if isset($EN_GB)}<a class="item-link" href="/en/{l file='urls' term=$uri lang='en_GB'}">en</a>{/if}
						 	{if isset($IT_IT)}<a class="item-link" href="/it/{l file='urls' term=$uri lang='it_IT'}">it</a>{/if}
						 	{if isset($PT_PT)}<a class="item-link" href="/pt/{l file='urls' term=$uri lang='pt_PT'}">pt</a>{/if}
						{/if}
					</div>
				</div>
				<div id='zoneBanniere'>

					{if isset($calculateur)}{$calculateur}{/if}

					<div id='menuTerciaireZone'>
						<ul id='menuTerciaire' class='menu'>
							{$menuTerciaire}
						</ul>
					</div>
					<div id='masqueBlancGauche'></div>

					{if isset($breadcrumbs)}{$breadcrumbs}{/if}
					

				</div>
			</div>
			<div id='entetePict'></div>
		</div>
	{/if}
