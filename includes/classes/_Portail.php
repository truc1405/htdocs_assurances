<?php

class Portail{

	protected $smarty;

	protected $db;
	protected $message;
	protected $c;

	public $menus;
	

	public function __construct($displayPage = true)
	{
		global $smarty;

		Lang::manageLanguage();

		if($displayPage){
			$params = self::managePageRequest();
			if($params['pageName']){
				$pageName = str_replace('-', '_', $params['pageName']);	
				new $pageName($params);
			}
		}

	}


	
	
	
	private static function managePageRequest(){
		
		global $smarty;

		if(!isset($_REQUEST['uri']) || $_REQUEST['uri'] == '')		$uri = 'accueil';
		elseif($_REQUEST['uri'] == 'page404'){						self::display404();return null;}
		else 														$uri = $_REQUEST['uri'];
			
		$menus = self::getMenus( $uri );

		foreach($menus as $menu){
			if($menu->isActive()==true){
				$uri = $menu->currentPage['uniqueUri'];
			}
		}
		
		$uriElements = explode('/', $uri);
		$pageName = $uriElements[sizeof($uriElements)-1];

		// test si la page existe
		if(file_exists( PAGES.'/'.str_replace('-', '_', $uri).'.php' )){
 			// si c'est une page dans un sous répertoire, on ajoute à include_path
			if(sizeof($uriElements) > 1){
				foreach($uriElements as $key =>$uriElement){
					$uriElements[$key] = str_replace('-', '_', $uriElement);
				}
				$pageDirectory = PAGES.'/'.implode('/',array_slice($uriElements, 0, sizeof($uriElements)-1));

				ini_set('include_path', ini_get('include_path').':'.$pageDirectory);
			}
		}else{
			self::display404();
			return null;
		}

		$params = array(
			'pageName'=> $pageName, 
			'uri'=>		 $uri,
			'menus' =>   $menus
		);
		return $params;
	}
	
	
	
	public static function display404($params = null){
		global $smarty;
		
		$menus = ($params['menus'] ? $params['menus'] : 		$menus = self::getMenus( $_REQUEST['uri'] ));

		$params = array(
			'pageName'=> 	'page404', 
			'uri'=>		 	'page404',
			'menus' => 		$menus
		);
		
		new page404($params);				
	}
	
	
	
	/* 
		Retourne un tableau avec les menus
		Reçois l'uri demandée. Cette uri permet de définir les breadcrumbs et les pages actives 
	*/
	public static function getMenus($uri){
		
		
		// Offres & Conditions  I  Avantages  I  Assurances  I  Protection des données
		
		
		/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
		/* /////////////////////									NAVIGATION PRINCIPALE							////////////////////// */
		/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
		
		$navigationPrincipale =  array(
			'credit-prive-en-ligne.html'	
			=>	array(
				'show'		=> true,
				'subnav'	=> array(
									'credit-prive/pret-conditions.html'=> array(
										'show'		=> true,
										'subnav'	=> null
									),
									'credit-prive/offre-credit.html'=> array(
										'show'		=> true,
										'subnav'	=> null
									)
				)

			),
			'rachat-credit.html' 
			=>	array(
				'show'		=> true,
				'subnav'	=> null		
			)
		);		
		
		
		
		/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
		/* /////////////////////									NAVIGATION SECONDAIRE							////////////////////// */
		/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
		
		$navigationSecondaire =  array(
			'/'				=> array(
				'show'			=> true,
				'subnav'		=> null,
				'link'			=> true
			),
			BLOG_URL				=> array(
				'show'			=> true,
				'subnav'		=> null,
				'link'			=> true
			),
			'faq.html'				=> array(
				'show'			=> true,
				'subnav'		=> null
			),
			'contact.html'			=> array(
				'show'			=> true,
				'subnav'		=> null
			),

		);




	/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
	/* /////////////////////									NAVIGATION TERCIAIRE							////////////////////// */
	/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
		$navigationTerciaire =  array(
			'profil-demande-credit.html'=>array(
				'show'		=> true,
				'subnav'	=> array(
					'profil/limite-age.html'=> array(
						'show'		=> true,
						'subnav'	=> null
					),
					'profil/credit-suisse.html'=> array(
						'show'		=> true,
						'subnav'	=> array(		 
									'profil/credit-etranger-permis-b-l.html'=> array(
										'show'		=> true,
										'subnav'		=> null
									),
									'profil/credit-frontalier-permis-g.html'=> array(
										'show'		=> true,
										'subnav'		=> null
									),
									'profil/credit-carte-legitimation.html'=> array(
										'show'		=> true,
										'subnav'		=> null
									)
								)
					),
					'profil/credit-situation-professionnelle.html'=> array(
							'show'		=> true,
							'subnav'		=> array(
									'profil/credit-rentier-avs-ai.html'=> array(
										'show'		=> true,
										'subnav'		=> null
									),
									'profil/credit-independant-directeur.html'=> array(
										'show'		=> true,
										'subnav'		=> null
									),
									'profil/credit-temporaire-interimaire.html'=> array(
										'show'		=> true,
										'subnav'		=> null
									)											 
								)
					),
					'profil/situation-financiere.html'=> array(
						'show'		=> true,
						'subnav'	=> null
					)
				)
			),
			
			'financement-projet.html'=>array(
				'show'		=> true,
				'subnav'	=> array(
					'pret-projet/credit-vehicule.html'=> array(
						'show'		=> true,
						'subnav'		=> array(
									'pret-projet/credit-auto.html'=> array(
										'show'		=> true,
										'subnav'		=> null	
									),
									'pret-projet/credit-moto.html'=> array(
										'show'		=> true,
										'subnav'		=> null	
									),
									'pret-projet/credit-camping-car.html'=> array(
										'show'		=> true,
										'subnav'		=> null	
									),
									'pret-projet/financement-bateau.html'=> array(
										'show'		=> true,
										'subnav'		=> null	
									)
									
						)
					),
					'pret-projet/credit-habitation.html'=> array(
						'show'		=> true,
						'subnav'		=> array(
									'pret-projet/credit-mobilier.html'=> array(
										'show'		=> true,
										'subnav'		=> null
									),
									'pret-projet/credit-travaux.html'=> array(
										'show'		=> true,
										'subnav'		=> null
									),
									'pret-projet/credit-demenagement.html'=> array(
										'show'		=> true,
										'subnav'		=> null
									)

						)
					),
					'pret-projet/credit-loisir-voyage.html'=> array(
						'show'		=> true,
						'subnav'		=> null
					),
					'pret-projet/pret-mariage-naissance.html'=> array(
						'show'		=> true,
						'subnav'		=> null
					),
					'pret-projet/credit-informatique-multimedia.html'=> array(
						'show'		=> true,
						'subnav'		=> null
					),
					'pret-projet/credit-chirurgie-sante.html'=> array(
						'show'		=> true,
						'subnav'		=> null
					),
					'pret-projet/pret-famille.html'=> array(
						'show'		=> true,
						'subnav'		=> null
					)
				)
			),
			'pret-avantage.html'=>array(
				'show'		=> true,
				'subnav'	=> array(
					'avantages/credit-leasing.html'=> array(
						'show'		=> true,
						'subnav'		=> null
					),
					'avantages/courtier-financier.html'=> array(
						'show'		=> true,
						'subnav'		=> null
					),
					'avantages/protection-donnees.html'=> array(
						'show'		=> true,
						'subnav'		=> null
					)
				)
			),
			'societe-de-credit.html'=>array(
				'show'		=> true,
				'subnav'	=> array(
					'societe-credit/ethique.html'=> array(
						'show'		=> true,
						'subnav'		=> null
					),
					'societe-credit/equipe.html'=> array(
						'show'		=> true,
						'subnav'		=> null
					),
					'societe-credit/partenaires.html'=> array(
						'show'		=> true,
						'subnav'		=> null
					),
				)
			)
		);
		
		
		
		/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
		/* /////////////////////									NAVIGATION CACHEE								////////////////////// */
		/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
		
		$navigationCachee =  array(
			'accueil.html'=>array(
				'show'		=> true,
				'subnav'	=> null

			),
			'hide/test.html'=>array(
				'show'		=> true,
				'subnav'	=> null

			),
			'hide/abcde.html'=>array(
				'show'		=> true,
				'subnav'	=> null
			)
		);
		
		

		$menus = array(
				 	new Menu($navigationPrincipale, $uri ),
					new Menu($navigationSecondaire, $uri),
					new Menu($navigationTerciaire, $uri ),
				 	new Menu($navigationCachee, $uri )
			);
		
		return $menus;
		
	}
	
	
	

	// si l'utilisateur veut se loguer -> on détruit la session précédente,
	// et on affecte l'username recu à la nouvelle session,
	// puis on crée une session groupe qui contiendra le groupe de l'utilisateur
	// puis on crée une session avec la liste des objets qu'on pourra utiliser pour créer nos pages
	public function terminer()
	{
		session_unset();
		session_destroy();
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function main(){		


		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		/////////////////////////////////////////////////////////////// GESTION DES PAGES ET DE LA NAVIGATION  //////////////////////////////////////////////////////////////
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


		// $this->menu = Menu::getInstance();
		// $navRequired = $this->managePage($this->menu);
		// $breadcrumbs = $this->menu->getbreadcrumb();
		// $completeBreadCrumbs = $this->menu->getCompleteBreadcrumbs();
		// $menu = $this->menu;
		// $actualPage = $menu->getActualPage();
		// 
		// $nav = array_keys($navRequired['nav']);
		// $menu1 = $menu->getLevel(0 ,$navRequired['selected']);
		// $menu2 = $menu->getLevel(1 ,$navRequired['selected']);
		// $menu3 = $menu->getLevel(2 ,$navRequired['selected']);
		// 
		// 
		// $header = $data['header'];
		
		
		
				

		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		/////////////////////////////////////////////////////////////// ASSIGNATION DES VARIABLES POUR SMARTY  //////////////////////////////////////////////////////////////
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		// $this->smarty->debugging = true;
		// $data['templateObject']->debugging = true;
		// $this->smarty->assign('pageid', $navRequired['selected']);
		// $this->smarty->assign('breadcrumbs', $breadcrumbs);
		// $this->smarty->assign('completeBreadCrumbs', $completeBreadCrumbs);
		// $this->smarty->assign('actualPage', $actualPage);
		// $this->smarty->assign('menu1', $menu1);
		// $this->smarty->assign('navRequired', $navRequired);
		// $this->smarty->assign('header', $header);
		
		// 
		// $this->smarty->assign('currentTemplate', $data['templateName']);
		// $this->smarty->assign('contenu', $data['templateObject']->fetch( $data['templateName'].".tpl" ));
	

	}// fin main
}
?>