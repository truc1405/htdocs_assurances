<?php
class connexion extends Page{
	
	
	public function main($params){
		
		// chemins, et nom de page
		$this->smarty->assign('theme_dir', THEME_DIR);
		$this->smarty->assign('uri', $this->pt->_($params['uri']).'.html');
		$this->smarty->assign('pageName', $this->pt->_($params['pageName']));


		$this->smarty->assign('menuSecondaire', $this->menus[1]->fetchMenu());
	
		$this->customize();
	
		$this->display();
	}
	
	
	public function customize(){
		global $smarty;
		$this->external_template = EXTERNAL_LOGIN;
	}
	
	
	protected function login(){
		global $authOptions;
		$login = new Samlogin( $authOptions );
		$status = $login->login($_POST['username'], $_POST['password']);
		echo json_encode($status);
	}
	
	protected function username(){
		global $authOptions;
		$login = new Samlogin( $authOptions );
		$status = $login->login($_POST['username']);
		echo json_encode($status);
	}


		
		
		
}
?>