<?php
class accueil extends Page{
	
	
	public function customize(){
		
		global $smarty;		
		$this->external_template = EXTERNAL_PLEINE_LARGEUR;
		$this->layout = LAYOUT_DEUX_COLONNES;
		
	}
	
}
?>