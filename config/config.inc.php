<?php

if($_SERVER['HTTP_HOST'] == 'netlead.assurancesblog' || $_SERVER['HTTP_HOST'] == 'netlead.assurances'){
	include('settings-dev.inc.php');
	
}else if($_SERVER['HTTP_HOST'] == 'assurances.netlead.ch'){
	include('settings-pre-prod.inc.php');

}else if($_SERVER['HTTP_HOST'] == 'www.xxx.ch'){	
	include('settings-prod.inc.php');
}

include('config-complete.inc.php');

?>