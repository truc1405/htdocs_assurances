<!DOCTYPE html>
<html lang="fr-FR" class='no-js'>
<head>


	<!-- Titre et autres balises meta -->
	{if isset($metaCanonical)}<title>{$metaTitle}</title>{/if}
	{if isset($metaCanonical)}<link rel="canonical" href="{$metaCanonical}"/>{/if}
	{if isset($metaRobots)}<meta name="robots" content="{$metaRobots}" />{/if}
	{if isset($metaKeywords)}<meta name="keywords" content="{$metaKeywords}" />{/if}
	{if isset($metaDescription)}<meta name="description" content="{$metaDescription}" />{/if}
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	

	
	
	{if isset($header_debut)}{$header_debut}{/if}
	
	<script src="{$theme_dir}/js/1-modernizr-2b.js" type="text/javascript" charset="utf-8"></script>

	<link href='http://fonts.googleapis.com/css?family=Molengo' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="{$theme_dir}/js/jquery-ui/css/pepper-grinder/jquery-ui-1.8.11.custom.css"> 
	<link rel="stylesheet" href="{$theme_dir}/js/shadowbox-3.0.3/shadowbox.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="{$theme_dir}/css/master.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="{$theme_dir}/css/print.css" type="text/css" media="print" title="no title" charset="utf-8">



	<!--[if IE]>
		<link rel="stylesheet" href="theme_datacentervision/css/master_ie.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<![endif]-->

    <!--[if IE 7]>
		<link rel="stylesheet" href="theme_datacentervision/css/ie7only.css" type="text/css" media="screen" title="no title" charset="utf-8">
    <![endif]-->


	{if isset($header_fin)}{$header_fin}{/if}
	
	
</head>

<body>
	
	
	<script type="text/javascript" charset="utf-8">
		var ajaxRequestUrl = '{$ajaxRequestUrl}';	
	</script>
	
	<div id='body' class='login'>	
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
						{if $auth==true}
							<a class="item-link" href="/{$shortlang}/accueil.html?action=deconnexion" rel='noindex,follow' >{l term='Se déconnecter'}</a>
						{else}
							<a class="item-link" href="/{$shortlang}/espace-client.html" >{l term='Espace client'}</a>
						{/if}
						{if isset($FR_FR) && (isset($DE_DE) || isset($EN_GB) || isset($IT_IT) || isset($PT_PT))}
						 	- 
							{l term='Langues'} :
						 	{if isset($FR_FR)}<a class="item-link" href="/fr/{l file='urls' term=$uri lang='fr_FR'}">fr</a>{/if}
						 	{if isset($DE_DE)}<a class="item-link" href="/de/{l file='urls' term=$uri lang='de_DE'}">de</a>{/if}
						 	{if isset($EN_GB)}<a class="item-link" href="/en/{l file='urls' term=$uri lang='en_GB'}">en</a>{/if}
						 	{if isset($IT_IT)}<a class="item-link" href="/it/{l file='urls' term=$uri lang='it_IT'}">it</a>{/if}
						 	{if isset($PT_PT)}<a class="item-link" href="/pt/{l file='urls' term=$uri lang='pt_PT'}">pt</a>{/if}
						{/if}
					</div>
				</div>
			</div>
			<div id='entetePict'></div>
		</div>


		<div id="loginform" class='box applycms'>
			
			<h1>Zone réservée</h1>
			
			{l file='connexion' term='zone1'}

			<div id='fields'>
				
				<input type="text" id="username" placeholder="Nom d'utilisateur"/><!--
				--><div id='loginSep'></div><!--
				--><input type="password" id="password" placeholder='Mot de passe'/><!--
				--><input type="hidden" id='postback' value='{$postback}' /><!--
				--><a type='button' id='confirmForm' class='button green' >S'identifier</a>
			</div>
			
			<div id='message'>
				<div id='fleche'></div>
				<div id='messageContent'>Cet utilisateur n'existe pas !</div>
			</div>
			<p>&nbsp;</p>
			<p><a href='' onclick='history.back();return false;'>&laquo; Revenir à la page précédente.</a></p>
		</div>
		
		
	</div>
		
		{if isset($javascript_debut)}{$javascript_debut}{/if}
		<script src="{$theme_dir}/js/2-jquery-1.7.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="{$theme_dir}/js/jquery-ui/js/jquery-ui-1.8.11.custom.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="{$theme_dir}/js/shadowbox-3.0.3/shadowbox.js" type="text/javascript" charset="utf-8"></script>
		<script src="{$theme_dir}/js/login.js" type="text/javascript" charset="utf-8"></script>	
		{if isset($javascript_avant_default)}{$javascript_avant_default}{/if}
		<script src="{$theme_dir}/js/10-default.js" type="text/javascript" charset="utf-8"></script>
		{if isset($javascript_fin)}{$javascript_fin}{/if}

		<script type="text/javascript">
			Shadowbox.init();
		</script>


</body>
</html>