<?php
class nl_admin extends Page{
	
	private $doc = null;
	
	public function customize(){
		global $smarty, $auth;
		
		$this->external_template = EXTERNAL_PLEINE_LARGEUR;
		$this->layout = 'login';
		
		$this->doc = new DOMDocument();
		
		if( $this->doc->load( 'users/users.xml') ){
			
			if($auth->loggedin()){
				
				if($_REQUEST['sauverPrix']){
					$this->savePrices();
				}
				$this->showAccount();
				
			}else{
				$auth->showLoginForm();
			}
			
		}else{
			$smarty->assign('errorMsg', $this->pt->_("L'espace client est momentanément indisponible"));
		}


	}
	
	
	public function savePrices()
	{
		global $smarty, $auth, $pdo;
		
		
		
	}
		
	public function showAccount()
	{
		global $smarty, $auth, $pdo;
	
		//$idformated = date('Ymd_His', $_SESSION['user_id']);
		$path = new DOMXPath($this->doc);
		$clients = "//client[@login='".$_SESSION['user_login']."']";
		$client = $path->query($clients)->item(0);
		
		if( $client	){

			$smarty->assign('nom', $client->getElementsByTagName("nom")->item(0)->nodeValue);
			$smarty->assign('prenom', $client->getElementsByTagName("prenom")->item(0)->nodeValue);
			
			
			$requete = 'select * from prices_2013 where prix >= 0';
			$executionStatus = $pdo->query($requete);
			$resultats = $executionStatus->fetchAll(PDO::FETCH_ASSOC);
			
			$requete = 'select distinct canton from prices_2013 where prix >= 0';
			$executionStatus = $pdo->query($requete);
			$cantons = $executionStatus->fetchAll(PDO::FETCH_ASSOC);
		
			$requete = 'select distinct zone from prices_2013 where prix >= 0';
			$executionStatus = $pdo->query($requete);
			$zones = $executionStatus->fetchAll(PDO::FETCH_ASSOC);
			
			$requete = 'select distinct modele from prices_2013 where prix >= 0';
			$executionStatus = $pdo->query($requete);
			$modeles = $executionStatus->fetchAll(PDO::FETCH_ASSOC);

			$requete = 'select distinct age from prices_2013 where prix >= 0';
			$executionStatus = $pdo->query($requete);
			$ages = $executionStatus->fetchAll(PDO::FETCH_ASSOC);
			
			$requete = 'select distinct franchise from prices_2013 where prix >= 0';
			$executionStatus = $pdo->query($requete);
			$franchises = $executionStatus->fetchAll(PDO::FETCH_ASSOC);
			
			$requete = 'select distinct accident from prices_2013 where prix >= 0';
			$executionStatus = $pdo->query($requete);
			$accidents = $executionStatus->fetchAll(PDO::FETCH_ASSOC);

			
			$smarty->assign('resultats', $resultats);
			$smarty->assign('cantons', $cantons);
			$smarty->assign('ages', $ages);
			$smarty->assign('modeles', $modeles);
			$smarty->assign('franchises', $franchises);
			$smarty->assign('accidents', $accidents);
			$smarty->assign('zones', $zones);
					
			
		}else{
			$smarty->assign('errorMsg', $this->pt->_("Votre compte est inaccessible, veuillez nous joindre directement par téléphone."));
		}
		
	}	
}
?>