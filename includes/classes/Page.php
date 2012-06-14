<?php

class Page{
	
	/*
	protected $c;
	protected $pt;
	protected $layout;
	protected $uri;
	protected $pageName;
	protected $menus;
	protected $external_template;
	
	* $this->external_template : 
	  EXTERNAL_DEFAULT				=> Toute la largeur avec ou sans bannière
	  EXTERNAL_PAGE_INTERNE			=> Avec sous menu à gauche
	  EXTERNAL_ENTONNOIR			=> Toute la largeur avec le minimum d'éléments encourageant à quitter la page
      
    * $this->layout :                       
  	  LAYOUT_DEFAULT		 		=> Template multicolonnes
	  LAYOUT_DEMANDE_CREDIT			=> Formulaire de demande de crédit

	*/
	
	protected $smarty;
	protected $c;
	protected $pt;
	protected $g;
	protected $urls;
	protected $layout;
	protected $uri;
	protected $pageName;
	protected $menus;
	protected $external_template;


	public function __construct($params = null)
  	{
		global $smarty, $auth;
		$this->smarty = $smarty;
		
		// 
		// 
		// $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		// $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		// $key = "This is a very secret key";
		// $text = "Meet me at 11 o'clock behind the monument.";
		// echo strlen($text) . "\n";
		// 
		// $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB, $iv);
		// echo strlen($crypttext) . "\n";
		// echo $crypttext;
		// 
		

		//Console::log('pageName : '.$params['pageName'] .', uri : '.$params['uri']);
		//Console::log($params);
		
		$this->menus = $params['menus'];
						
		$this->pageName = (isset($params['pageName'])) ? $params['pageName'] : 'accueil';
		$this->uri = (isset($params['uri'])) ? $params['uri'] : 'accueil';
		$this->layout = (isset($params['layout'])) ? $params['layout'] : LAYOUT_DEFAULT;
		$this->external_template = (isset($params['external_template'])) ? $params['external_template'] : EXTERNAL_DEFAULT;

		$this->pt 	= 	Lang::loadLang($this->uri);		
		$this->g 	= 	Zend_Registry::get(TRANSLATE_GLOBAL);
		$this->urls = 	Zend_Registry::get(TRANSLATE_URLS);

		if(isset($_REQUEST) && isset($_REQUEST['content_only']) && $_REQUEST['content_only'] == '1'){
			$this->smarty->assign('content_only', true);
		}else{
			$this->smarty->assign('content_only', false);
		}

		
		if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'deconnexion'){
			$auth->logout();
		}
		
		
		if(isset($auth) && $auth->loggedin()){
			$smarty->assign('auth', true);
		}else{
			$smarty->assign('auth', false);
		}
		
		
		// si le paramètre ajax est trouvé et le paramètre action aussi
		if(isset($_REQUEST) && isset($_REQUEST['ajax']) && $_REQUEST['ajax'] == true){
			if(isset($_REQUEST) && isset($_REQUEST['action']) && !empty($_REQUEST['action']) ){
				
				// si le paramètre action correspond à une fonction, on appelle la dite fonction, sinon on appelle la fonction ajax() qui s'occupera elle de faire la correspondance
				if( method_exists( $this , $_REQUEST['action'] ) ){
					$this->$_REQUEST['action']();
				}else{
					$this->ajax();
				}
			}else{
				$this->ajax();
			}			
		}else{
			$this->main($params);
		}
	}
	
	
	
	public function main($params){
		
		// chemins, et nom de page
		$this->smarty->assign('uri', $this->pt->_($params['uri']).'.html');
		$this->smarty->assign('pageName', $this->pt->_($params['pageName']));
		
		
		$calculateurBudget = $this->pt->_('calculateurBudget');
		$demandeCourrier = $this->pt->_('demandeCourrier');
		$blog = $this->pt->_('blog');	
		$blogListe = $this->pt->_('blogListe');	
		$avantages = $this->pt->_('avantages');		
		$avantagesListe = $this->pt->_('avantagesListe');		
		$documentsARemettre = $this->pt->_('documentsARemettre');
		$offreSpeciale = $this->pt->_('offreSpeciale');


		// menus et breadcrumb
		$this->smarty->assign('menuPrincipal',  $this->menus[0]->fetchMenu());
		$this->smarty->assign('menuSecondaire', $this->menus[1]->fetchMenu());
		$this->smarty->assign('menuTerciaire',  $this->menus[2]->fetchMenu());
			
		foreach($this->menus as $menu){
			if($menu->isActive()){
				if($sousmenu =  $menu->fetchSousmenu()){
					$this->smarty->assign('menuGauche',$sousmenu);
				}
				$this->smarty->assign('breadcrumbs', $menu->fetchBreadcrumbs());
				break;
			}
		}
		
		
		// bannière ou pas
		if($this->pt->_('background') != 'background'){
			$this->smarty->assign('banner', true);
			$this->smarty->assign('background', $this->pt->_('background'));
			if($calculateurBudget != 'non'){ $this->smarty->assign('calculateur',  $this->smarty->fetch(SMARTY_WIDGET_TEMPLATES.'/calculateur.tpl'));}
			$this->smarty->assign('demande_courrier',  $this->smarty->fetch(SMARTY_WIDGET_TEMPLATES.'/demande_courrier.tpl'));
		}else{
			$this->smarty->assign('banner', false);
		}
		
		
		// metas, css et js
		$this->smarty->assign('metaCanonical', $this->pt->_('metaCanonical'));
		$this->smarty->assign('metaRobots', $this->pt->_('metaRobots'));
		$this->smarty->assign('metaDescription', $this->pt->_('metaDescription'));
		$this->smarty->assign('metaTitle', $this->pt->_('metaTitle'));
		
		$this->smarty->assign('header_debut', $this->pt->_('header_debut'));
		$this->smarty->assign('header_fin', $this->pt->_('header_fin'));
		$this->smarty->assign('javascript_debut', $this->pt->_('javascript_debut'));
		$this->smarty->assign('javascript_avant_default', $this->pt->_('javascript_avant_default'));
		$this->smarty->assign('javascript_fin', $this->pt->_('javascript_fin'));
		
		
		
		// contenu
		$this->smarty->assign('titrePage', $this->pt->_('titrePage'));
	
		$calculateurBudgetTpl = $this->smarty->fetch(SMARTY_WIDGET_TEMPLATES."/calculateur_budget2.tpl");
		$demandeCourrierTpl = $this->smarty->fetch(SMARTY_WIDGET_TEMPLATES."/demande_courrier.tpl");
		
		$this->smarty->assign('calculateurBudgetTpl', $this->pt->_('calculateurBudgetTpl'));
		$this->smarty->assign('demandeCourrierTpl', $this->pt->_('demandeCourrierTpl'));
			
		if ($this->pt->_('zone1') != 'zone1') $this->smarty->assign('zone1',  $this->pt->_('zone1'));
		if ($this->pt->_('zone2') != 'zone2') $this->smarty->assign('zone2',  $this->pt->_('zone2'));
		if ($this->pt->_('zone3') != 'zone3') $this->smarty->assign('zone3',  $this->pt->_('zone3'));
		if ($this->pt->_('zone4') != 'zone4') $this->smarty->assign('zone4',  $this->pt->_('zone4'));
		if ($this->pt->_('zone10') != 'zone10') $this->smarty->assign('zone10', $this->pt->_('zone10'));
		if ($this->pt->_('zone11') != 'zone11') $this->smarty->assign('zone11', $this->pt->_('zone11'));
					
		$this->customize();



		// partie de droite
		$sky = '';
		if($calculateurBudget == 'oui')	$sky .= $calculateurBudgetTpl;
		if($demandeCourrier == 'oui') $sky .= $demandeCourrierTpl;
		
	
		if($documentsARemettre == 'oui' && $documentsARemettre != 'documentsARemettre'){
			$this->smarty->assign('documentsARemettre',  $documentsARemettre );
			$sky .= $this->smarty->fetch(SMARTY_WIDGET_TEMPLATES."/documents_a_remettre.tpl");
		}
		
		// if($offreSpeciale == 'non' || $offreSpeciale == 'offreSpeciale'){
		// 	$this->smarty->assign('offreSpeciale',  $offreSpeciale );
		// 	$sky .= $this->smarty->fetch(SMARTY_WIDGET_TEMPLATES."/offreSpeciale.tpl");
		// }
	
		if($avantages == 'oui' && $avantagesListe != 'avantagesListe'){
			$this->smarty->assign('avantagesListe',  $avantagesListe );
			$sky .= $this->smarty->fetch(SMARTY_WIDGET_TEMPLATES."/avantages.tpl");
		}
		

		
		if($blog == 'oui' && $blogListe != 'blogListe'){
			$this->smarty->assign('blogListe', $blogListe );
			$sky .= $this->smarty->fetch(SMARTY_WIDGET_TEMPLATES."/blog.tpl");
		}
		
		$this->smarty->assign('sky', $sky);
				
				
				
				
		// affichage
		$this->smarty->assign('DEV_ENVIRONMENT', DEV_ENVIRONMENT);
		$content = $this->smarty->fetch(SMARTY_LAYOUT_TEMPLATES."/".$this->layout.".tpl");
		$this->smarty->assign('content', $content);
			
		$this->display();
	}
	
	
	
	public function customize(){}
	
	
	public function display(){
		$this->smarty->display(SMARTY_EXT_TEMPLATES.'/'.$this->external_template.'.tpl');
	}
	
	
	public function addCSS($urls){
		if(sizeof($urls)>0){
			$content ='';
			foreach($urls as $css){
				$content.= '<link rel="stylesheet" href="'.THEME_DIR.'/css/'.$css.'">';
			}
			$this->smarty->assign('header_fin',$this->pt->_('header_fin'). $content);
		}
		
	}
	
	
	public function addJS($urls){

		if(sizeof($urls)>0){
			$content ='';
			foreach($urls as $css){
				$content .= '<script src="'.THEME_DIR.'/js/'.$css.'" type="text/javascript" charset="utf-8"></script>';
			}
			$this->smarty->assign('javascript_fin', $this->pt->_('javascript_fin').$content);
		}
	}

	
	public function ajax(){}
	

	
	
	
	
	
	
	
}
?>