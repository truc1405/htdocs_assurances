<?php


/* Debug only */
@ini_set('display_errors', 'on');
define('DEBUG_CONSOLE' , false);


/* Improve PHP configuration to prevent issues */
@ini_set('default_charset', 'utf-8');

/* Correct Apache charset */
header('Content-Type: text/html; charset=utf-8');

/* Autoload */
function autoload($className){
	$include_paths = explode(':', ini_get('include_path') );
	$extensions = array('','.inc', '.class');

	if (!class_exists($className, false) ){
		foreach($include_paths as $include_path){
			foreach($extensions as $extension){
				if(file_exists( $include_path."/".$className.$extension.'.php')){
					require_once($className.$extension.'.php');
				}
			}
		}
	}
}
spl_autoload_register('autoload');
		

/* Redefine REQUEST_URI if empty (on some webservers...) */
if (!isset($_SERVER['REQUEST_URI']) OR empty($_SERVER['REQUEST_URI'])){
	$_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'];
	if (isset($_SERVER['QUERY_STRING']) AND !empty($_SERVER['QUERY_STRING']))
		$_SERVER['REQUEST_URI'] .= '?'.$_SERVER['QUERY_STRING'];
}


// includes
include('defines.inc.php');
include('display.php');
if(!defined('DB_NAME')){
	include('../htdocs_creditconseil_blog/wp-config.php');
}





// debugueur
$GLOBALS['debugger_logs']['logCount'] = 0;
$GLOBALS['debugger_logs']['speedCount'] = 0;
$GLOBALS['debugger_logs']['errorCount'] = 0;
$GLOBALS['debugger_logs']['memoryCount'] = 0;
$profiler = new PhpQuickProfiler(PhpQuickProfiler::getMicroTime(), '/includes/php_libs/pqp/');



// base de données avec pdo
global $pdo, $dns;

$dns = DB_TYPE.':dbname='.DB_NAME.";host=".DB_HOST;
$pdo = new PDO( $dns, DB_USER, DB_PASSWORD );
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try{
	$pdo->query('SET NAMES UTF8;');
}catch(PDOException $e){
	echo "N'est pas connecté à la base de données.";
	$message = $e->getMessage();
	error_log($message.chr(10).__LINE__.", ".__FILE__.chr(10).chr(10), 3, $_SERVER['DOCUMENT_ROOT'].'/debug/_debug_error_log.txt');
}



// authentification
global $auth, $authOptions;
$authOptions = array(
		'dbname' 		 => DB_NAME, 
		'dbuser'	 	 => DB_USER, 
		'dbpassword' 	 => DB_PASSWORD, 
		'dbhost' 		 => DB_HOST, 
		'dbtable'		 => 'users', 
		'dbusernamefield'=> 'login', 
		'dbpasswordfield'=> 'pass', 
		'showForm' 		 => false,
		'path' 			 => '/includes/php_libs/login/'	
	);

$auth = new Samlogin($authOptions);



// smarty
global $smarty;

$smarty = new Smarty();
$smarty->template_dir 	= THEMES_DIR.THEME_NAME.'/templates';
$smarty->compile_dir 	= COMPILED;
$smarty->cache_dir 		= CACHE_DIR;
$smarty->config_dir 	= CONFIG_DIR;
$smarty->caching 		= false;
$smarty->force_compile	= true; // to pass "false" when put into production
$smarty->compile_check	= false;
$smarty->debugging		= false;


$smarty->assign('TAUX1',number_format(TAUX1));
$smarty->assign('TAUX2',  number_format(TAUX2));
$smarty->assign('MONTANT_INITIAL', MONTANT_INITIAL);
$smarty->assign('DUREE_INITIALE', DUREE_INITIALE);
$smarty->assign('EMPRUNT_MIN', EMPRUNT_MIN);
$smarty->assign('EMPRUNT_MAX', EMPRUNT_MAX);
$smarty->assign('DUREE_MIN', DUREE_MIN);
$smarty->assign('DUREE_MAX', DUREE_MAX);

$smarty->assign('theme_dir', THEME_DIR);
$smarty->assign('BLOG_URL', BLOG_URL);
$smarty->assign('SITE_DOMAIN', SITE_DOMAIN);


function smartyTranslate($params, &$smarty)
{
	
	if(isset($params['lang']) && $params['lang']){	
		$lang = $params['lang'];
	}else{
		$lang = null;
	}
	
	// si fichier non défini ou chaine vide, on utilise global
	if( !isset($params['file']) || (isset($params['file']) && $params['file'])=='' ){
		$file = '_global';
	}else{
		
		// si égal à global
		if ( $params['file'] == 'global'){
			$file = '_global';
			
		// si égal à urls
		}elseif( $params['file'] == 'urls'){
			$file = '_urls';
		
		// sinon on charge ce qui est demandé
		}elseif(isset($params['file'])){
			$file = $params['file'];
		}else{
			return '';
		}
	}

	if($lang!= null){
		$pt = Lang::loadLang($file, $lang);
	}else{
		$pt = Lang::loadLang($file);
	}
	
	if(isset($params['term']) && $params['term'] != ''){
		return $pt->_($params['term']);
	}else{
		return '';
	}
}
$smarty->registerPlugin('function','l', 'smartyTranslate');











?>