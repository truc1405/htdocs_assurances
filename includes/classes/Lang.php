<?php

class Lang{
	




	public static function manageLanguage(){
		
		global $smarty;
		

		if(defined('FR_FR')){$smarty->assign('FR_FR', true);}
		if(defined('DE_DE')){$smarty->assign('DE_DE', true);}
		if(defined('EN_GB')){$smarty->assign('EN_GB', true);}
		if(defined('IT_IT')){$smarty->assign('IT_IT', true);}
		if(defined('PT_PT')){$smarty->assign('PT_PT', true);}
		
		
		// gestion de la langue //////////////////////////////////////////////////////////////////////////////////////

		// http://netlead.creditconseil/it est inactif mais affiche la page d'accueil. Devrait afficher la page 404.
		$enabled = true;
			
		// si l'utilisateur demande une langue en particulier
		if(isset($_REQUEST['lang'])){

			if($_REQUEST['lang'] == 'fr'){
				if(defined('FR_FR')){
					$lang = FR_FR;
					$shortLang = 'fr';
				}else{
					$enabled = false;
				}
			}

			if($_REQUEST['lang'] == 'de'){
				if(defined('DE_DE')){
					$lang = DE_DE;
					$shortLang = 'de';
				}else{
					$enabled = false;
				}
			}

			
			if($_REQUEST['lang'] == 'it'){
				if(defined('IT_IT')){
					$lang = IT_IT;
					$shortLang = 'it';
				}else{
					$enabled = false;
				}
			}
			
			if($_REQUEST['lang'] == 'pt'){	
				if(defined('PT_PT')){
					$lang = PT_PT;
					$shortLang = 'pt';	
				}else{
					$enabled = false;
				}
			}
			
			if($_REQUEST['lang'] == 'en'){	
				if(defined('EN_GB')){
					$lang = EN_GB;
					$shortLang = 'en';
				}else{
					$enabled = false;
				}
			}
			

			
			if($enabled == true){
				
				// la session preferred_lang est settée pour qu'il n'ai plus à le faire
				$_SESSION['lang'] = $lang;
				$_SESSION['shortlang'] = $shortLang;

				if(!isset($lang)){
					$lang = FR_FR;
					$shortLang = 'fr';
				}
				
			}else{

				if($_SESSION['lang']){
					$lang = $_SESSION['lang'];
					$shortLang = $_SESSION['shortlang'];
				}
			}
			
			
		// si rien de spécial n'a été demandé
		}else{
							
			// on vérifie s'il ne l'a pa fait auparavant (langue déja settée en session)
			if(isset($_SESSION['lang'])){
				$lang = $_SESSION['lang'];
				$shortLang = $_SESSION['shortlang'];

			// si on ne demande rien, on prend la langue par défaut
			}else {	
				$lang = FR_FR;
				$shortLang = 'fr';
			}
		}
		
		
		define('MY_LANG', $lang);
		define('SHORT_LANG', $shortLang);
		
		$smarty->assign('lang', MY_LANG);
		$smarty->assign('shortlang', SHORT_LANG);

		$putenv = putenv("LANG=".MY_LANG); // On modifie la variable d'environnement		
		$dir = setlocale(LC_ALL, MY_LANG); // On modifie les informations de localisation en fonction de la langue	

		if($enabled == false) throw new Exception404('Langue inactive');
		
		
		$global = self::loadLang('_global');
		$urls = self::loadLang('_urls');
				
		Zend_Registry::set(TRANSLATE_GLOBAL, $global);
		Zend_Registry::set(TRANSLATE_URLS,	 $urls);		
	}
	
	
	
	
	public static function loadLang($pageName, $lang = MY_LANG){


		try{
			$pageTranslation = new Zend_Translate('array',		   	 LOCALE.'/'.$lang.'/'.str_replace('-', '_', $pageName).'.php', $lang);
			
			// $pageTranslation = new Zend_Translate('array',		   	 LOCALE.'/'.FR_FR.'/'.str_replace('-', '_', $pageName).'.php', 'fr_FR');
			// if(defined('DE_DE')) $pageTranslation->addTranslation(   LOCALE.'/'.DE_DE.'/'.str_replace('-', '_', $pageName).'.php', 'de_DE');
			// if(defined('IT_IT')) $pageTranslation->addTranslation(   LOCALE.'/'.IT_IT.'/'.str_replace('-', '_', $pageName).'.php', 'it_IT');
			// if(defined('PT_PT')) $pageTranslation->addTranslation(   LOCALE.'/'.PT_PT.'/'.str_replace('-', '_', $pageName).'.php', 'pt_PT');
			// if(defined('EN_GB')) $pageTranslation->addTranslation(   LOCALE.'/'.EN_GB.'/'.str_replace('-', '_', $pageName).'.php', 'en_GB');
			
			$pageTranslation->setLocale($lang);
			return $pageTranslation;		
		
		}catch(Zend_Translate_Exception $e){
			
			$pageTranslation = new Zend_Translate('array', LOCALE.'/empty.php', $lang);
			$pageTranslation->setLocale($lang);
			return $pageTranslation;
			
			echo "<br/><br/>erreur pour le fichier $pageName";
			echo "<br/><br/>".$e->getMessage();
			//echo "<br/><br/>".$e;
			exit();
		}
	}
	
		
}






?>