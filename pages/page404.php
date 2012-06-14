<?php
class page404 extends Page{

	public function customize(){
		global $smarty;
		$this->external_template = EXTERNAL_SANS_SOUSMENU;
		$smarty->assign('breadcrumbs', '');
	}

	
}
?>