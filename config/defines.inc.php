<?php


$currentDir = dirname(__FILE__);

// PATHS SUR LE SERVEUR
define('ROOT_DIR',          		realpath($currentDir.'/..'));
define('CLASSES', 					ROOT_DIR.'/includes/classes');
define('CLASSES_EXCEPTIONS',		ROOT_DIR.'/includes/classes/exceptions');	
define('LOCALE', 					ROOT_DIR.'/locale');	
define('PAGES', 					ROOT_DIR.'/pages');


// THEMES
define('RACINE',    				'/');
define('THEMES_DIR',    			'themes/');
define('THEME_DIR',    				RACINE.THEMES_DIR.THEME_NAME);
define('THEME_IMG_DIR',				RACINE.THEMES_DIR.THEME_NAME.'/deco/');
define('THEME_CSS_DIR',				RACINE.THEMES_DIR.THEME_NAME.'/css/');
define('THEME_JS_DIR', 				RACINE.THEMES_DIR.THEME_NAME.'/js/');
                            		
             		                    

// LANGUES
define('FR_FR', 			'fr_FR');	
//define('DE_DE', 			'de_DE');	
//define('IT_IT', 			'it_IT');
define('PT_PT', 			'pt_PT');
define('EN_GB', 			'en_GB');
define('TRANSLATE_GLOBAL', 	'translate_global');
define('TRANSLATE_URLS', 	'translate_urls');


// SMARTY
define('NL_SMARTY_DIR',				ROOT_DIR.'/includes/php_libs/Smarty/libs');
define('COMPILED', 					ROOT_DIR.'/cache/templates_c');
define('CONFIG_DIR',				ROOT_DIR.'/cache/config_dir');
define('CACHE_DIR', 				ROOT_DIR.'/cache/cache_dir');
define('SMARTY_TEMPLATES', 			ROOT_DIR.THEME_DIR.'/templates');
define('SMARTY_EXT_TEMPLATES', 	    'external');
define('SMARTY_LAYOUT_TEMPLATES',   'layout');
define('SMARTY_WIDGET_TEMPLATES',   'widgets');


// TEMPLATES
define('EXTERNAL_PLEINE_LARGEUR', 	'pleine_largeur');
define('EXTERNAL_DEFAULT', 			EXTERNAL_PLEINE_LARGEUR);
define('EXTERNAL_SANS_SOUSMENU', 	'sans_sousmenu');
define('EXTERNAL_AVEC_SOUSMENU', 	'avec_sousmenu');
define('EXTERNAL_ENTONNOIR', 		'entonnoir');
define('EXTERNAL_LOGIN', 			'login');
define('EXTERNAL_EMPTY', 			'empty');

define('LAYOUT_UNE_COLONNE', 		'une_colonne');
define('LAYOUT_DEFAULT', 			LAYOUT_UNE_COLONNE);
define('LAYOUT_DEUX_COLONNES', 		'deux_colonnes');
define('LAYOUT_TROIS_COLONNES', 	'trois_colonnes');
define('LAYOUT_DEMANDE_CREDIT', 	'demande_credit');



define('LIBRARIES', 				ROOT_DIR.'/includes/php_libs');
define('PHP_QUICK_PROFILER',		LIBRARIES.'/pqp');
define('PHP_QUICK_PROFILER_CLASSES',LIBRARIES.'/pqp/classes');
define('ZEND', 						LIBRARIES.'/Zend');


ini_set('include_path', ini_get('include_path').':'.
						NL_SMARTY_DIR.":".
						LIBRARIES.":".
						ZEND.":".
						LOCALE.":".
						PAGES.":".
						CLASSES_EXCEPTIONS.":".
						PHP_QUICK_PROFILER.":".
						PHP_QUICK_PROFILER_CLASSES.":".
						CLASSES
					);
					
					
require_once (LIBRARIES."/Zend/Registry.php");
require_once (LIBRARIES."/Zend/Translate.php");
require_once (LIBRARIES."/Zend/Mail.php");
require_once (LIBRARIES."/Zend/Mail/Transport/Smtp.php");
		

define('TAUX1', 7.5);
define('TAUX2', 15);
define('MONTANT_INITIAL', 25000);
define('DUREE_INITIALE', 72);
define('EMPRUNT_MIN', 5000);
define('EMPRUNT_MAX', 250000);
define('DUREE_MIN', 6);
define('DUREE_MAX', 72);	

			
			
			
			
	
	
	
	

?>