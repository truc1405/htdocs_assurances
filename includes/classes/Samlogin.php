<?php

class Samlogin{

	private $pdo;
	private $options;
	private $user;
	
    public function __construct( $options ) 
    {
	
		//$dbname, $dbuser, $dbpass, $dbhost, $table, $username_field, $pass_field, $showLoginIfLoggedOut = false, $path = null 
		$this->options = $options;
			
		if($this->options['path']==null)	$this->options['path']= LIBRARIES.'login/';
	
		try{
				$dns = 'mysql:dbname='.$this->options['dbname'].";host=".$this->options['dbhost'];
				$pdo = new PDO( $dns, $this->options['dbuser'], $this->options['dbpassword'] );
				$this->pdo = $pdo;
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$pdo->query('SET NAMES UTF8;');
				//$requete = 'SELECT * FROM '.$this->options['dbtable'];//.' WHERE '.$username_field.'="post" AND post_status="publish" ORDER BY post_date desc';
				//$executionStatus = $pdo->query($requete);
				//$resultats = $executionStatus->fetchAll(PDO::FETCH_ASSOC);

		} catch(PDOException $e){
				//echo '<br/><strong>'.$requete.'</strong><br/>';
				echo 'Erreur de connexion a la BD';//$e;
		}
	
		if( $this->options['showForm']==true && !$this->loggedin() )	{
			$this->showLoginForm();
		}
    }





    public function login($user, $pwd = null)
    {
		global $pdo;

			// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// $pdo->query('SET NAMES UTF8;');
			// $requete = 'SELECT * FROM '.$this->options['dbtable'].' WHERE '.$this->options['dbusernamefield'].'="'.$user.'" ';
			// $executionStatus = $pdo->query($requete);
			// $resultats = $executionStatus->fetchAll(PDO::FETCH_ASSOC);
			
			$doc = new DOMDocument();
			if( $doc->load( 'users/users.xml') ){
				
				$path = new DOMXPath($doc);
				$client = "//client[@login='".$user."']";

				$clientsList = $path->query($client);
				
				if($clientsList->length == 1){
					
					
					$client = $clientsList->item(0);
					if($pwd == null) return array(	'success' => htmlentities("Utilisateur identifié !"),
					 								'field'	=> 'username');
					
					
					if( $client->getElementsByTagName('pass')->item(0)->nodeValue == $pwd){
	       				$_SESSION['sess_isAuth'] = true;
	       				$_SESSION['user_login'] = $user;
	       				$_SESSION['user_id'] = $client->getAttribute('id');
						return array(	'success' => htmlentities("Authentification réussie !"),
						 				'field'	=> 'global');
					}else
						return array(	'error' => htmlentities("Le mot de passe ne correspond pas !"),
						 				'field'	=> 'password',
										'request'=>	'global');

				}else  {
					
					if($pwd == null)	return array(	'error' => htmlentities("Utilisateur introuvable !"),
						 								'field'	=> 'username',
														'request'=>'username');

					else				return array(	'error' => htmlentities("Utilisateur introuvable !"),
										 				'field'	=> 'username',
														'request'=>	'global');
				}
				
				
			}else{
				return array(	'error' => htmlentities("Connexion avec la base de données interrompue !") ,
							'field'	=> 'global');
			}
			



		return array(	'error' => htmlentities("Authentification échouée !") ,
	 					'field'	=> 'global');

    }





		//     public function login($user, $pwd = null)
		//     {
		// global $pdo;
		// try{
		// 
		// 	// $dns = 'mysql:dbname='.$this->options['dbname'].";host=".$this->options['dbhost'];
		// 	// $pdo = new PDO( $dns, $this->options['dbuser'], $this->options['dbpassword'] );
		// 	// $this->pdo = $pdo;
		// 	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// 	$pdo->query('SET NAMES UTF8;');
		// 	$requete = 'SELECT * FROM '.$this->options['dbtable'].' WHERE '.$this->options['dbusernamefield'].'="'.$user.'" ';
		// 	$executionStatus = $pdo->query($requete);
		// 	$resultats = $executionStatus->fetchAll(PDO::FETCH_ASSOC);
		// 	
		// 	if(sizeof($resultats) == 1){
		// 					
		// 		if($pwd == null) return array(	'success' => htmlentities("Utilisateur identifié !"),
		// 		 								'field'	=> 'username');
		// 		
		// 		if($resultats[0]['pass'] == $pwd){
		//        				$_SESSION['sess_isAuth'] = true;
		//        				$_SESSION['user_login'] = $user;
		//        				$_SESSION['user_id'] = $resultats[0]['id'];
		// 			return array(	'success' => htmlentities("Authentification réussie !"),
		// 			 				'field'	=> 'global');
		// 		}else
		// 			return array(	'error' => htmlentities("Le mot de passe ne correspond pas !"),
		// 			 				'field'	=> 'password',
		// 							'request'=>	'global');
		// 		
		// 		
		// 		
		// 	}else  {
		// 		if($pwd == null)	return array(	'error' => htmlentities("Utilisateur introuvable !"),
		// 			 								'field'	=> 'username',
		// 											'request'=>'username');
		// 			
		// 		else				return array(	'error' => htmlentities("Utilisateur introuvable !"),
		// 							 				'field'	=> 'username',
		// 											'request'=>	'global');
		// 	}
		// 
		// } catch(PDOException $e){
		// 		//echo '<br/><strong>'.$requete.'</strong><br/>';
		// 	 return array(	'error' => htmlentities("Connexion avec la base de données interrompue !") ,
		// 					'field'	=> 'global');
		// }
		// 
		// return array(	'error' => htmlentities("Authentification échouée !") ,
		// 	 					'field'	=> 'global');
		// 
		//     }

    public function logout()
    {
        //sauve la session actuel
        //$this->save();
        //détruit la session
        $_SESSION = array();
		unset($session);
    }
    
    public function loggedin()
    {
        //Regarde si on est bien authentifié
        return isset($_SESSION['sess_isAuth']);
    }


	
	
	private function curPageURL() {
	 	$pageURL = 'http';
	 	if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 	$pageURL .= "://";
	 	if ($_SERVER["SERVER_PORT"] != "80") {
	  		$pageURL .= $_SERVER["HTTP_HOST"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 	} else {
	  		$pageURL .= $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
	 	}
	
	 	return $pageURL;
	}


	public function showLoginForm(){
		global $smarty;
		
		$postback = $this->curPageURL();		

		$smarty->assign('postback', $postback);
		$smarty->assign('ajaxRequestUrl', '/'.SHORT_LANG.'/connexion.html');
		
		$smarty->display('external/login.tpl');
		exit();


	}	
}








