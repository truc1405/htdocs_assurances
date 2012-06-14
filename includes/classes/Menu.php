<?php
class Menu{
	
//	private static $_instance;
	
	protected $template;
	protected $requiredNav;
	protected $c;
	protected $breadcrumb = array();
	protected $completeBreadcrumb = array();
	public $menu;
	public $currentPage;
	protected $activeMenu = false;





	function __construct ($tree, $uri, $params = null) {
				
		$g = 		Zend_Registry::get(TRANSLATE_GLOBAL);
		$urls = 	Zend_Registry::get(TRANSLATE_URLS);
		
		$menu = $this->initMenu($tree, $uri);
		$this->menu = $menu['menu'];
		
		if($menu['current'] == true) $this->activeMenu = true;
		$this->breadcrumb = $this->setBreadcrumb($menu['menu']);
	}
	
	
	
	public function isActive(){
		return $this->activeMenu;
	}
	
	
	
	
	
	/* 
		Fonction récursive qui recrée le menu en reprennant les traductions et en ajoutant displayName et url à chaque élément
		retourne le menu, si c'est le menu courant et le breadcrumb
	*/
	private function initMenu($tree, $uri){
		
		$g = 		Zend_Registry::get(TRANSLATE_GLOBAL);
		$urls = 	Zend_Registry::get(TRANSLATE_URLS);
		
		$current = false;
		$breadcrumb = array();

		foreach ($tree as $url => $el){
			
			if( isset($el['link']) && $el['link'] == true){
				$tree[$url]['displayName'] = $g->_($url);
				$tree[$url]['url'] = $urls->_($url);
				$tree[$url]['link'] = true;				
			}else{
			
				$tree[$url]['displayName'] = $g->_($url);
				$tree[$url]['url'] = $urls->_($url);
			
				// si la page en cours est la page courrante
				// on la tag comme tel et on l'ajoute aux breadcrumbs
				if( $tree[$url]['url'] == $uri.'.html' ){
					$current = true;
					$tree[$url]['current'] = true;
					$this->currentPage = $tree[$url];
					$uniqueUri = explode('.' , $url);
					$this->currentPage['uniqueUri'] = $uniqueUri[0];
					unset($this->currentPage['subnav']);
				}
			
				// test si enfant
				if(isset($tree[$url]['subnav']) && sizeof($tree[$url]['subnav']) > 0){
					$subnav = $this->initMenu($el['subnav'], $uri);						
					$tree[$url]['subnav'] = $subnav['menu'];
					if($subnav['current']==true || $subnav['current']==true) {
						$tree[$url]['current'] = true;
						$current = true;
					}			
				}			
			}
		}


		// echo '<pre>';
		// print_r( $tree );
		// echo '</pre>';

		
		return array('menu'=>$tree, 'current'=>$current);
	}
	
	
	
	
	
	private function setBreadcrumb($menu){

		$menu = ( !$menu ) ? $this->menu['menu'] : $menu;

		foreach ($menu as $url => $el){

			
			if(isset($el['current']) && $el['current'] == true){
								
				$breadcrumb = array($el);
				unset($breadcrumb[0]['subnav']);
				
				if($el['subnav']) {
					$sub_breadcrumbs = $this->setBreadcrumb($el['subnav']);
					if($subBreadcrumb = $sub_breadcrumbs[0]){
						array_push($breadcrumb, $subBreadcrumb);
					}				
				}	
				return $breadcrumb;
			}						
		}
		
	}
	
	
	public function getBreadcrumbs(){
		return $this->breadcrumb;
	}


	public function fetchBreadcrumbs(){
		global $smarty;
		if($this->isActive()){
			$smarty->assign('breadcrumbs', $this->breadcrumb);
			return $smarty->fetch('widgets/breadcrumbs.tpl');
		}
	}
	
	

	public function fetchMenu(){
		global $smarty;
		
		//Console::log($this->menu);
		$smarty->assign('menu', $this->menu);
		return $smarty->fetch('widgets/menu.tpl');
	}
	
	
	public function getSousmenu(){
		
		if($this->isActive()){
			foreach($this->menu as $menu){
				if(isset($menu['current']) && $menu['current'] ==true){
					if(sizeof($menu['subnav']) == 0) return false;
					else return $menu['subnav'];
				}
			}					
		}
	}
	
	public function fetchSousmenu(){
		global $smarty;

		if($this->isActive()){
			$sousmenu = $this->getSousmenu();
			if( $sousmenu != false ){
				$smarty->assign('menu', $sousmenu);
				return $smarty->fetch('widgets/menu.tpl');
			}else{
				return false;
			}
		}	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function getMenu($tree){
		return $this->template->fetch('menu.tpl');
	}

	


	public function getActualPage(){
		return $this->completeBreadcrumb[sizeof($this->completeBreadcrumb)-1];
	}




	public function getCompleteBreadcrumbs(){
		return $this->completeBreadcrumb;
	}
	
	public function getLevel($level, $pageid=null){

		
		if($level == 0){
			$nav = $this->getNavElements();
			foreach($nav as $key => $pageDetail){
				$nav[$key]['subnav'] = null;
				if($this->isSelected($key)) $nav[$key]['selected']=true;
			}
			return $nav;
		}
		
		
		if($level == 1){
			$requiredNav = $this->getRequiredNav($pageid);
			$nav = array_keys($requiredNav);
		
			$tableau = null;
			if(isset($requiredNav[$nav[0]]['subnav'])){
				$tableau = $requiredNav[$nav[0]]['subnav'];
				while ($pageDetail = current($tableau)) {
					$key = key($tableau);
					$tableau[$key]['subnav'] = null;
				    next($tableau);
				}
			}
			return  $tableau;
		}
		
		
		if($level == 2){
			$requiredNav = $this->getRequiredNav($pageid);
			$nav = array_keys($requiredNav);
		
			$tableau = null;
			if(isset($requiredNav[$nav[0]]['subnav'])){
				$tableau = $requiredNav[$nav[0]]['subnav'];
				while ($pageDetail = current($tableau)) {

					$key = key($tableau);			
					if(isset($tableau[$key]['subnav'])){ // vérifie que le 3e niveau existe
						return $tableau[$key]['subnav']; // sélectionne le 3e niveau
					}
				    next($tableau);
				}
			}
			return null;
		}
	}
	
	
	
	

	public function getParent($pageid){
		$parent = array_search($pageid, $this->breadcrumb);
		if($parent == 0) return false;
		else return $this->breadcrumb[$parent-1];
	}
	
	
	public function isSelected($pageid){
		if(in_array($pageid,$this->breadcrumb)) return true;
		else return false;
	}
	
	
	
	
	public function getRequiredNav($page){
		$fermerSousmenus = true;
		
		if(isset($this->requiredNav)) return $this->requiredNav;
		
		$arrayLevel1 = $this->getNavElements();
		
		// racine (niveau 000, 100, 200, ...)
		// si la page xxx reçue, existe : 
		if(isset($arrayLevel1[$page])){
			$tableau =  array($page=>$arrayLevel1[$page]);
			$tableau[$page]['selected']=true;
			$this->breadcrumb[0] = $page;
			$this->completeBreadcrumb[0] = $arrayLevel1[$page];
			$this->completeBreadcrumb[0]['subnav'] =  null;
			$this->completeBreadcrumb[0]['pageid'] = $page;
			
			// ferme les sous navigations des autres menus du même niveau (p.ex si a page voulue est 423, ferme les sous navigations 431,432, 433, 434 et 451, 452, 453, 454,...)
			if($fermerSousmenus && isset($tableau[$page]['subnav'])){
				//$this->c->warn($tableau);
				//$this->c->warn($page);
				foreach($tableau[$page]['subnav'] as $key => $pageDetail){
					if($key != $page){
						$tableau[$page]['subnav'][$key]['subnav']=null;
					}
				}
			}
			$this->requiredNav = $tableau;
			return $tableau;
		}
		
		
		// sous navigation (niveau 110, 120, 130, ...)
		foreach($arrayLevel1 as $key1 => $pageDetail1){

			if(isset($pageDetail1['subnav'])){
				if(isset($pageDetail1['subnav'][$page])) {
					
					$tableau1 =  array($key1=>$arrayLevel1[$key1]);
					$indiceBase = array_keys($tableau1);
					$tableau1[$indiceBase[0]]['selected'] = true;
					$tableau1[$indiceBase[0]]['subnav'][$page]['selected']=true;
					$this->breadcrumb[0] = $key1;
					$this->breadcrumb[1] = $page;
					$this->completeBreadcrumb[0] = $arrayLevel1[$key1];
					$this->completeBreadcrumb[0]['subnav'] = null;
					$this->completeBreadcrumb[0]['pageid'] = $key1;
					$this->completeBreadcrumb[1] = $pageDetail1['subnav'][$page];
					$this->completeBreadcrumb[1]['subnav'] = null;
					$this->completeBreadcrumb[1]['pageid'] = $page;
					//$this->c->warn('selected');
					
					if($fermerSousmenus){
						foreach($tableau1[$key1]['subnav'] as $key => $pageDetail1){
							if($key != $page){
								$tableau1[$key1]['subnav'][$key]['subnav']=null;
							}
						}
					}
					$this->requiredNav = $tableau1;
					return $tableau1;
				}
				

				// sous sous navigation (niveau 111, 112, 113, 114)
				foreach($pageDetail1['subnav'] as $key2 => $pageDetail2){
					
					// si sous navigation
					if(isset($pageDetail2['subnav'])){
						if(isset($pageDetail2['subnav'][$page])) {
						
							$arrayLevel1[$key1]['subnav'][$key2]['selected']= true;
							//$this->c->warn($arrayLevel1);
							// retourne le tableau depuis le niveau 100 
							$tableau2 =  array(	$key1=> $pageDetail1); 
							
							//$this->c->info($tableau2[$key1]['subnav'][$key2]['subnav'][$page]);
							$tableau2[$key1]['subnav'][$key2]['subnav'][$page]['selected']=true;
							$tableau2[$key1]['subnav'][$key2]['selected']=true;	
							$this->breadcrumb[0] = $key1;
							$this->breadcrumb[1] = $key2;
							$this->breadcrumb[2] = $page;
							$this->completeBreadcrumb[0] = $arrayLevel1[$key1];
							$this->completeBreadcrumb[0]['subnav'] = null;
							$this->completeBreadcrumb[0]['pageid'] = $key1;
							$this->completeBreadcrumb[1] = $arrayLevel1[$key2];
							$this->completeBreadcrumb[1]['subnav'] = null;
							$this->completeBreadcrumb[1]['pageid'] = $key2;
							$this->completeBreadcrumb[2] = $pageDetail2['subnav'][$page];						
							$this->completeBreadcrumb[2]['subnav'] = null;
							$this->completeBreadcrumb[2]['pageid'] = $page;

							// ferme les sous navigations des autres menus du même niveau (p.ex si a page voulue est 423, ferme les sous navigations 431,432, 433, 434 et 451, 452, 453, 454,...)
							if($fermerSousmenus){
								foreach($tableau2[$key1]['subnav'] as $key => $pageDetail){
									if($key != $key2){
										$tableau2[$key1]['subnav'][$key]['subnav']=null;
									}
								}
							}
							$this->requiredNav = $tableau2;
							return $tableau2;
						}
						
					}
				} // fin foreach
			
			}

		}
		
	}
		
	
	
	
	
	
	

	
	
	
	
	
}
?>