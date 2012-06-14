<?php
class credit_prive_en_ligne extends Page{
	
	
	public function customize(){
		global $smarty;
		$this->external_template = EXTERNAL_AVEC_SOUSMENU;
		$this->layout = LAYOUT_TROIS_COLONNES;
	}
		
}
?>