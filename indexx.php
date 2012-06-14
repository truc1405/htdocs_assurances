<?php

	try{
			
		//l'id de session est transmis uniquement par cookie
		//ini_set('session.use_only_cookies', 1);
		//utilise SHA-1 pour la gémération de l'identifiant de session
		//ini_set('session.hash_function', 0);       
		//interdit la propagation de l'id de session via l'url
		//ini_set('session.use_trans_sid', 1);
		//démarre la session
		session_start();
		//régénére l'id de session (et supprime l'ancien)
		//session_regenerate_id(true);
		
		include('config/config.inc.php');
						
		
		Console::log($_REQUEST);
		$portail = new Portail();
			
	
	}catch(Exception404 $e){
		Console::logError($e, $e->getMessage());
		Portail::display404();
			
	}catch(Exception $e){
		echo $e.'<br><br>';
		Console::logError($e, $e->getMessage());
	}
	
	
	
	if(DEBUG_CONSOLE == true){
		$profiler->display();
	}
	
	
?>