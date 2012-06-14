<?php
class demande_credit extends Page{



	//http://netlead.creditconseil/fr/demande-credit.html?ajax=true&action=enregistreDemande&statut=orange&montantMax=59000&documents=pieceIdentiteOuPasseportRecu,troisFichesSalaire&documents_c=true
	//http://netlead.creditconseil/fr/demande-credit.html?ajax=true&action=enregistreDemande&montantMax=0&statut=vert&documents=pieceIdentiteOuPasseportRecu,troisFichesSalaire&documents_c=true&debug=tralala
	protected $datas = null;
	
	public function customize(){

		$this->external_template = EXTERNAL_ENTONNOIR;
		$this->layout = LAYOUT_DEMANDE_CREDIT;
		$this->addCSS(array('form.css'));
		$this->addJS(array(
			'jquery.caret.1.02.min.js',
			'jquery.autocomplete.js',
//			'jquery.timer.js',
			'demandeManager.js')
		);
		
	}
	
	
	public function ajax(){}
	
	
	public function getEtapes(){
		global $smarty;

		$etapes = array(
			'etape2'=> $smarty->fetch(SMARTY_LAYOUT_TEMPLATES.'/form/etape2.tpl'),
			'etape2c'=> $smarty->fetch(SMARTY_LAYOUT_TEMPLATES.'/form/etape2_c.tpl'),
			'etape3'=> $smarty->fetch(SMARTY_LAYOUT_TEMPLATES.'/form/etape3.tpl'),
			'etape4'=> $smarty->fetch(SMARTY_LAYOUT_TEMPLATES.'/form/etape4.tpl'),
			'etape4c'=> $smarty->fetch(SMARTY_LAYOUT_TEMPLATES.'/form/etape4_c.tpl'),
			'etape5'=> $smarty->fetch(SMARTY_LAYOUT_TEMPLATES.'/form/etape5.tpl'),
			'etape5c'=> $smarty->fetch(SMARTY_LAYOUT_TEMPLATES.'/form/etape5_c.tpl')
		);
		echo json_encode(array(	'success'=> htmlentities("Etapes récupérées"), 
								'etapes'=> $etapes ));
	}
	
	
	protected function getAdresses(){
		
		global $pdo;
			
		// $row=0;
		// $handle = fopen('/ressources/adresses/npa_suisse.txt', "r");
		// while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		// 	$num = count($data);
		// 
		// 	// Removes the uncessary white spaces
		// 	$data = array_map('trim', $data);
		// 	$nom = $data[1].", ".$data[0];
		// 	$row++;
		// }
		
		$r = $_REQUEST;
		
		if(isset($r['pays']) && ($r['pays'] == 'france'|| $r['pays'] == 'suisse'|| $r['pays'] == 'france_short')){
				
			$pays = $r['pays'];
	
			try{
				if($pays == 'suisse')			$requete = 'SELECT num_ordre as id, npa, nom as city , canton_nom as region FROM match_zip WHERE (type_npa = 10 OR type_npa = 20 OR type_npa = 30) AND canton != "DE"  AND canton != "IT" ORDER BY region,npa'; //
				if($pays == 'france')			$requete = 'SELECT INSEE as id, Codepos as npa, Commune as city, Departement as region FROM villesFrance ORDER BY region, npa';//WHERE Departement like "AIN" || Departement like "DROME" || Departement like "HAUT RHIN" || Departement like "HAUTE SAVOIE" || Departement like "TERRITOIRE DE BELFORT" ';
				if($pays == 'france_short')		$requete = 'SELECT INSEE as id, Codepos as npa, Commune as city, Departement as region FROM villesFrance WHERE Departement like "AIN" || Departement like "DROME" || Departement like "HAUT RHIN" || Departement like "HAUTE SAVOIE" || Departement like "TERRITOIRE DE BELFORT" ORDER BY region, npa';

				$results = $pdo->prepare($requete);
				$results->execute();
				$villes = $results->fetchAll(PDO::FETCH_ASSOC);
	
				$villesFinal = array();			
				foreach($villes as $ville){

					if(!isset($villesFinal[$ville['region']])){
						$villesFinal[$ville['region']] = array();
					}
				
					if(!isset($villesFinal[$ville['region']][$ville['npa']])){
						$villesFinal[$ville['region']][$ville['npa']] = array();
					}
					array_push($villesFinal[$ville['region']][$ville['npa']], array(
																					'id'=> $ville['id'], 
																					'ville'=>$ville['city']));
				}
				

		 	$response = array(	'success'=> htmlentities("Villes générées !"),
			 					'field'	  => 'global',
								'villes' =>  $villesFinal);
			
			} catch(PDOException $e){
			
				$response = array(	'error'=> htmlentities("Problème avec la base de données !"),
				 				'field'	=> '',
								'request'=>	''
								,'requete'=> $requete);
								
			} catch( Exception $e){
				$response = array(	'error'=> htmlentities("Erreur indéterminée. Liaison avec la base de données impossible."),
				 				'field'	=> '',
								'request'=>	''
								,'requete'=> $requete);
			}

		}else{
			
			$response = array(	'error'=> htmlentities("Le pays n'est pas spécifié !"),
			 				'field'	=> '',
							'request'=>	'global');
		}
		
		
		// echo '<pre>';
		// print_r( $response );
		// echo '</pre>';
		echo json_encode($response);
	}
	
	
	
	
	protected function getStreets(){
		
		global $pdo;

		$r = $_REQUEST;
		
		
		if( isset($r['npa']) ){
				
			try{
				
				$requete = 'select distinct strname,onrp from match_street INNER JOIN match_zip ON match_street.onrp = match_zip.num_ordre where match_zip.npa = '.$r['npa'].' order by strname';
	
				$results = $pdo->prepare($requete);
				$results->execute( array($r['npa']) );
				$rues = $results->fetchAll(PDO::FETCH_ASSOC);
	
				$ruesFinal = array();
				foreach($rues as $rue){
					if(!isset($ruesFinal[$rue['onrp']])) $ruesFinal[$rue['onrp']] = array();
					array_push( $ruesFinal[$rue['onrp']], $rue['strname']);
				}
				

		 	$response = array(	'success'=> htmlentities("Rues récupérées !"),
			 					'field'	  => 'global',
								'rues' =>  $ruesFinal);
			
			} catch(PDOException $e){
				$message = $requete.chr(10).$e->getMessage();
				error_log($message.chr(10).__LINE__.", ".__FILE__.chr(10).chr(10), 3, $_SERVER['DOCUMENT_ROOT'].'/_debug_error_log.txt');
				$response = array(	'error'=> htmlentities("Problème avec la base de données !"),
				 				'field'	=> '',
								'request'=>	''
								,'requete'=> $requete);
								
			} catch( Exception $e){
				$response = array(	'error'=> htmlentities("Erreur indéterminée. Liaison avec la base de données impossible."),
				 				'field'	=> '',
								'request'=>	''
								,'requete'=> $requete);
			}

		}else{
			
			$response = array(	'error'=> htmlentities("Le pays n'est pas spécifié !"),
			 				'field'	=> '',
							'request'=>	'global');
		}
		
		
		// echo '<pre>';
		// print_r( $response );
		// echo '</pre>';
		echo json_encode($response);
	}
	
	
	
	
	
	protected function accountExists()
	{
		global $pdo;
		$r = $_REQUEST;
		
		
		try{
			
			if(isset($r['login']) && $r['login'] != ''){
				
				$results = $pdo->prepare("select * from users where login=?");			
				$params = array($r['login']);
				$results->execute($params);
				$clients = $results->fetchAll(PDO::FETCH_ASSOC);
				
				if ( sizeof($clients)==1 ) {
					
					// si pas de pass détecté, on lui propose de taper son mot de pase
					if( !isset($r['pass']) ){
						
					
					// sinon, on vérifie qu'il correspond pour voir si c'est le bon utilisateur
					}else{	
						
					}
					
				}
		
				
			}else{
				
			}

		}catch(PDOException $e){

			$message = $e->getMessage();
			echo $message;
			error_log($message.chr(10).__LINE__.", ".__FILE__.chr(10).chr(10), 3, $_SERVER['DOCUMENT_ROOT'].'/debug/_debug_error_log.txt');
			return false;
		}
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	protected function enregistreDemande()
	{

		global $pdo;
		
		$datas = $_REQUEST['data'];
		 
		/*
		* t : type, v : value, d : display, id : id, r : required, s : step (étape)
		*/
		$errors = array();
		foreach($datas as $f){ // $f pour field
			


			if($f['id'] == 'jaccepte'&& $f['v'] == 'non'){
				$f['m'] = htmlentities($this->pt->_('ACCEPTATION_NECESSAIRE'));
				array_push($errors, array('id'=>$f['id'],'s'=> $f['s'],'m'=>$f['m'] ));
			}

			if( isset($f['r']) && $f['r']== true && (!isset($f['v']) || $f['v'] == '')){
				$f['m'] = htmlentities($this->pt->_('Ce champ est requis'));
				array_push($errors, array('id'=>$f['id'],'s'=> $f['s'],'m'=>$f['m'] ));
			}else{
				$valid = null;
				switch($f['t']){
					case 'number':
						$valid = $this->validateNumber($f['v']);
						break;
					case 'phone':
						$valid = $this->validatePhone($f['v']);
						break;
					case 'phoneCH':
						$valid = $this->validatePhoneCH($f['v']);
						break;
					case 'dateMoise' :
					case 'date':
						$valid = $this->validateDate($f['v']);
						break;
					case 'email':
						$valid = $this->validateEmail($f['v']);
						break;
				}
				
				if(isset($valid) && $valid['success'] == false ){
					$f['m'] = htmlentities($valid['m']);
					array_push($errors, array('id'=> $f['id'],'s'=> $f['s'],'m'=>$f['m']));
				}
			}
		}
		

		
		if( sizeof($errors)>=1 ){
			echo json_encode(	array('status'=> 'fail','errors'=> $errors));
			return;
		}
	
		$datas = $this->prepareData($datas);
		$this->datas = $datas;

		
		if( $this->getValue('compte_client') == 'oui'&& $this->getValue('email') == ''){	
			echo json_encode( 	array('status'=> 'fail','errors'=> array(array('id'=> 'email', 'm'=> $this->pt->_('EMAIL_OBLIGATOIRE_SI_COMPTE')))));
			exit();			
		}
		

		
		// si tout est ok
		$id = time();//(true)*10000;
		
		// On crée un compte utilisateur
		if( $this->getValue('compte_client') == 'oui'){
			
			if(	$this->getValue('nom_utilisateur') != ''&&
				$this->getValue('mot_de_passe') != ''&& 
				$this->getValue('mot_de_passe') == $this->getValue('mot_de_passe2')
			  ){

			 	$this->doc = new DOMDocument();
				if( $this->doc->load( 'xml_etat_demandes/etat_demandes.xml') ){
					$path = new DOMXPath($this->doc);
					$clients = "//client[@login='".$this->getValue('nom_utilisateur')."']";
					$clients = $path->query($clients);

					if( $clients->length != 0 ){
						echo json_encode( 	array('status'=> 'fail','errors'=> array( array('id'=> 'nom_utilisateur', 's'=>'etape5','m'=> $this->pt->_('Votre nom d\'utilisateur est déjà utilisé. Veuillez en choisir un autre.')))));
						exit();
					}
				}
							
			}else{
				echo json_encode( 	
						array(  	'status'=> 'fail',
									'errors'=> array(
										array('id'=> 'nom_utilisateur',	's'=>'etape5', 'm'=> $this->pt->_('Vos identifants ne sont pas valides ou vos mots de passe ne sont pas identiques')),
										array('id'=> 'mot_de_passe',	's'=>'etape5', 'm'=> $this->pt->_('Vos identifants ne sont pas valides ou vos mots de passe ne sont pas identiques')),
										array('id'=> 'mot_de_passe2',	's'=>'etape5', 'm'=> $this->pt->_('Vos identifants ne sont pas valides ou vos mots de passe ne sont pas identiques'))
									)
								));
				exit();
			}
		}

		// On génère le xml
		$xmlOk = false;
		$xmlstatus = $this->createXML($id);

		// On envoit un mail de confirmation avec tout ce qu'il faut (fichiers à renvoyer)
		if($xmlstatus['generated'] == true){
			$mailstatus = $this->envoiMail($id, $xmlstatus['file']);
		}	
		
		
		echo json_encode( array('status'=> 'success', 'id'=> explode(',', $id) ));
	}
	





	private function addTag($obj, $destination, $field = '', $text = false){
		
		if( $text && $field != ''){
			$tag = $this->doc->createElement( $obj );	
			$tag->appendChild( $this->doc->createTextNode( $field ) );
			$destination->appendChild($tag);
		}else if( !$text &&  $field != ''){	
			$content = $this->getValue($field);
			$tag = $this->doc->createElement( $obj );	
			if( $content != '') $tag->appendChild( $this->doc->createTextNode( $content ) );
			$destination->appendChild($tag);
		}else if( $field==''){
			$tag = $this->doc->createElement( $obj );	
			$destination->appendChild($tag);
		}
		return $tag;
	}


	private function createXML($id){

		$doc = new DOMDocument('1.0', 'utf-8');
		$this->doc = $doc;
		$doc->formatOutput = true;

		$demandeCreditDocument = $this->addTag('demandeCreditDocument', $doc);

		$info = $this->addTag('info', $demandeCreditDocument);
			$this->addTag('id', $info, $id, true);
			$this->addTag('version', $info, '2.1', true);
			$this->addTag('Origine', $info, 'Crédit conseil', true);
			$this->addTag('Verdict', $info, $_REQUEST['statut'], true);	
			$this->addTag('langue', $info, SHORT_LANG, true);	
			$this->addTag('codePromotionnel', $info, 'codePromotionnel');	
			$this->addTag('InfoForDebug', $info, $_REQUEST['debug'], true);

		$auth = $this->addTag('auth', $demandeCreditDocument);
			$this->addTag('Login', $auth, 'nom_utilisateur');	
			$this->addTag('Pass', $auth, 'mot_de_passe');	
			
		$documents = $this->addTag('documents', $demandeCreditDocument);
			$documentsList = $_REQUEST['documents'];
			$documentsList = explode(',',$documentsList[0]);
			foreach($documentsList as $document){
				$this->addTag($document, $documents,'', true);	
			}
			
			// $this->addTag('pieceIdentiteOuPasseportRecu', $documents, $id, true);    
			// $this->addTag('troisFichesSalaire', $documents, $id, true);    
			// $this->addTag('permisSejourBLCRecu', $documents, $id, true);	
			// $this->addTag('dernierReleveDeCompteBancaire', $documents, $id, true);
			// $this->addTag('derniereFactureElectricite', $documents, $id, true);	
			// $this->addTag('carteLegitimationDEF', $documents, $id, true);
			// $this->addTag('derniereTaxationFiscale', $documents, $id, true);	
			// $this->addTag('decisionOfficielleRentes', $documents, $id, true);
			// $this->addTag('troisDerniersAvisEntreeDeRente', $documents, $id, true);	
			// $this->addTag('contratDeTravail', $documents, $id, true);                  	
		          	
		$CreditSollicite = $this->addTag('CreditSollicite', $demandeCreditDocument);	
			$this->addTag('MontantCredit', $CreditSollicite, 'montant');	
			$this->addTag('DureeCredit', $CreditSollicite, 'duree');	
			$this->addTag('MotifCredit', $CreditSollicite, 'motif');	
		
		$VotreIdentite = $this->addTag('VotreIdentite', $demandeCreditDocument);
			$this->addTag('SituationFamilialeEmprunteur', $VotreIdentite, 'situation_familiale');	
			$this->addTag('TitreEmprunteur', $VotreIdentite, 'titre');	
			$this->addTag('NomEmprunteur', $VotreIdentite, 'nom');	
			$this->addTag('NomJeuneFilleEmprunteur', $VotreIdentite, 'nom_jeune_fille');
			$this->addTag('PrenomEmprunteur', $VotreIdentite, 'prenom');	
			$this->addTag('DateNaissanceEmprunteur', $VotreIdentite, 'date_naissance');	
			$this->addTag('NationaliteEmprunteur', $VotreIdentite, 'nationalite');
			$this->addTag('valNationaliteEmprunteur', $VotreIdentite, $this->getDisplay('nationalite') ,true);
			$this->addTag('PermisSejourEmprunteur', $VotreIdentite, 'permis_sejour');	
			$this->addTag('PermisSejourDepuisEmprunteur', $VotreIdentite, 'permis_sejour_depuis');	
			$this->addTag('EtatCivilEmprunteur', $VotreIdentite, 'etat_civil');
			$this->addTag('EnfantsMoins6ans', $VotreIdentite, 'nb_enfants_moins_6');	
			$this->addTag('Enfants6a12ans', $VotreIdentite, 'nb_enfants_entre_6_et_12');	
			$this->addTag('EnfantsPlusDe12ans', $VotreIdentite, 'nb_enfants_plus_12');
			$this->addTag('TitreConjoint', $VotreIdentite, 'titre_c');	
			$this->addTag('NomConjoint', $VotreIdentite, 'nom_c');	
			$this->addTag('NomJeuneFilleConjoint', $VotreIdentite, 'nom_jeune_fille_c');
			$this->addTag('PrenomConjoint', $VotreIdentite, 'prenom_c');	
			$this->addTag('DateNaissanceConjoint', $VotreIdentite, 'date_naissance_c');	
			$this->addTag('NationaliteConjoint', $VotreIdentite, 'nationalite_c');
			$this->addTag('valNationaliteConjoint', $VotreIdentite, $this->getDisplay('nationalite_c'),true);
			$this->addTag('PermisSejourConjoint', $VotreIdentite, 'permis_sejour_c');	
			$this->addTag('PermisSejourDepuisConjoint', $VotreIdentite, 'permis_sejour_depuis_c');				
			
		
		$VosCoordonnees = $this->addTag('VosCoordonnees', $demandeCreditDocument);	
			$this->addTag('PaysEmprunteur', $VosCoordonnees, 'pays');
			$this->addTag('ville', $VosCoordonnees, $this->getDisplay('ville'), true);
			$this->addTag('regionAutriche', $VosCoordonnees, 'region_autriche');
			$this->addTag('regionItalie', $VosCoordonnees, 'region_italie');	
			$this->addTag('regionAllemangne', $VosCoordonnees, 'region_allemagne');	
			$this->addTag('regionFrance', $VosCoordonnees, 'region_france');
			$this->addTag('regionSuisse', $VosCoordonnees, 'region_suisse');		
			if( $this->getValue('pays') == 'suisse'){
				$this->addTag('zipFrance', $VosCoordonnees);
				$this->addTag('insee', $VosCoordonnees);	
				$this->addTag('zipSuisse', $VosCoordonnees, 'zip');
				$this->addTag('numOrdre', $VosCoordonnees, 'ville');
			}else if($this->getValue('pays') == 'france'){
				$this->addTag('zipFrance', $VosCoordonnees, 'zip');
				$this->addTag('insee', $VosCoordonnees, 'ville');	
				$this->addTag('zipSuisse', $VosCoordonnees);
				$this->addTag('numOrdre', $VosCoordonnees);}	
			$this->addTag('Adresse', $VosCoordonnees, $this->getDisplay('adresse').$this->getDisplay('adresse_suisse').' '.$this->getDisplay('numero'), true);
			$this->addTag('AddresseDepuis', $VosCoordonnees, 'adresse_depuis');	
			$this->addTag('PaysPrec', $VosCoordonnees, 'pays_prec');
			$this->addTag('villePrec', $VosCoordonnees, 'ville_prec');	
			$this->addTag('regionFrancePrec', $VosCoordonnees, 'region_france_prec');	
			$this->addTag('regionSuissePrec', $VosCoordonnees, 'region_suisse_prec');	
			if( $this->getValue('pays_prec') == 'suisse'){
				$this->addTag('zipFrancePrec', $VosCoordonnees);
				$this->addTag('inseePrec', $VosCoordonnees);	
				$this->addTag('zipSuissePrec', $VosCoordonnees, 'zip_prec');
				$this->addTag('numOrdrePrec', $VosCoordonnees, 'ville_prec');
			}else if($this->getValue('pays_prec') == 'france'){
				$this->addTag('zipFrancePrec', $VosCoordonnees, 'zip_prec');
				$this->addTag('inseePrec', $VosCoordonnees, 'ville_prec');	
				$this->addTag('zipSuissePrec', $VosCoordonnees);
				$this->addTag('numOrdrePrec', $VosCoordonnees);}
			$this->addTag('AdressePrec', $VosCoordonnees, $this->getDisplay('adresse_prec').$this->getDisplay('adresse_suisse_prec').$this->getDisplay('adresse_complete_prec').''.$this->getDisplay('numero_prec'), true);
			$this->addTag('DureeAdressePrec', $VosCoordonnees, 'adresse_pendant');	
			$this->addTag('telEmprunteurMob', $VosCoordonnees, 'type_telephone_mobile');
			$this->addTag('FinTelEmp', $VosCoordonnees, 'num_mobile');	
			$this->addTag('telEmprunteurDom', $VosCoordonnees, 'type_telephone_domicile');	
			$this->addTag('FinTelEmpDom', $VosCoordonnees, 'num_domicile');
			$this->addTag('telEmprunteurPro', $VosCoordonnees, 'type_telephone_pro');	
			$this->addTag('FinTelEmpPro', $VosCoordonnees, 'num_professionnel');	
			$this->addTag('AdresseMail', $VosCoordonnees, 'email');
			// - $this->addTag('telConjointMob', $VosCoordonnees, 'type_telephone_mobile_c');	
			// - $this->addTag('FinTelConj', $VosCoordonnees, 'num_mobile_c');	
			// - $this->addTag('telConjointPro', $VosCoordonnees, 'type_telephone_pro_c');
			// - $this->addTag('FinTelConjPro', $VosCoordonnees, 'num_professionnel_c');	
			// - $this->addTag('AdresseMailConj', $VosCoordonnees, 'email_c');	

			
		
		
		$VotreSituationFinanciere = $this->addTag('VotreSituationFinanciere', $demandeCreditDocument);	
			$this->addTag('SituationProfEmprunteur', $VotreSituationFinanciere, 'situation_pro');	
			$this->addTag('TypeEntreprise', $VotreSituationFinanciere, 'sa_sarl');
			$this->addTag('NomEmployeurEmp', $VotreSituationFinanciere, 'nom_employeur');	
			$this->addTag('LieuDeTravailEmp', $VotreSituationFinanciere, $this->getDisplay('lieu_de_travail'), true);
			$this->addTag('ChezEmployeurDepuisEmp', $VotreSituationFinanciere, 'meme_situation_depuis');
			$this->addTag('NomEmployeurPrecEmp', $VotreSituationFinanciere, 'nom_employeur_prec');	
			$this->addTag('DureeEmploiPrecEmp', $VotreSituationFinanciere, 'chez_employeur_prec_depuis');	
			//$this->addTag('RevenuMensuelEmp', $VotreSituationFinanciere, 'salaire_net_mensuel');
			$this->addTag('NbSalaireEmp', $VotreSituationFinanciere, 'nb_salaire_par_an');	
			$this->addTag('SoumisImpotSourceONEmp', $VotreSituationFinanciere, 'impose_a_la_source');	
			$this->addTag('SalaireNetMensuelEmp', $VotreSituationFinanciere, 'salaire_net_mensuel');
			$this->addTag('RevenuAnnuelImposableEmp', $VotreSituationFinanciere, 'revenu_annuel_imposable');
			$this->addTag('AutresRevenusEmp', $VotreSituationFinanciere, 'autres_revenus');	
			$this->addTag('LoyerMensuelEmp', $VotreSituationFinanciere, 'loyer_montant');
			$this->addTag('ChargesHypothecairesTrimestriellesEmp', $VotreSituationFinanciere, 'charges_hypothecaires_montant');
			$this->addTag('CreditEmp', $VotreSituationFinanciere, 'credits');
			$this->addTag('CreditRachatEmp', $VotreSituationFinanciere, 'credits_rachat');	
			$this->addTag('MontantCreditEmp', $VotreSituationFinanciere, 'credits_montant');	
			$this->addTag('MontantCreditRestantEmp', $VotreSituationFinanciere, 'credits_restants');	
			$this->addTag('LeasingEmp', $VotreSituationFinanciere, 'leasings');
			$this->addTag('LeasingRachatEmp', $VotreSituationFinanciere, 'leasings_rachat');	
			$this->addTag('MontantLeasingEmp', $VotreSituationFinanciere, 'leasings_montant');	
			$this->addTag('MontantLeasingRestantEmp', $VotreSituationFinanciere, 'leasings_restants');
			$this->addTag('PoursuiteEmp', $VotreSituationFinanciere, 'poursuites');
			$this->addTag('MontantPoursuiteEmp', $VotreSituationFinanciere, 'poursuites_montant');	
			$this->addTag('ActesDefautDeBienEmp', $VotreSituationFinanciere, 'addb');
			$this->addTag('TroisiemePillierEmp', $VotreSituationFinanciere, '3e_pillier');	
			$this->addTag('CaisseMaladieEmp', $VotreSituationFinanciere, 'caisse_maladie');
			$this->addTag('AutresChargesEmp', $VotreSituationFinanciere, 'autres_charges');
			$this->addTag('RemarquesEmp', $VotreSituationFinanciere, 'remarques');	
			$this->addTag('SituationProfConjoint', $VotreSituationFinanciere, 'situation_pro_c');
			$this->addTag('TypeEntrepriseConjoint', $VotreSituationFinanciere, 'sa_sarl_c');
			$this->addTag('NomEmployeurConj', $VotreSituationFinanciere, 'nom_employeur_c');
			$this->addTag('LieuDeTravailConj', $VotreSituationFinanciere, $this->getDisplay('lieu_de_travail_c'), true);
			$this->addTag('ChezEmployeurDepuisConj', $VotreSituationFinanciere, 'meme_situation_depuis_c');	
			$this->addTag('NomEmployeurPrecConj', $VotreSituationFinanciere, 'nom_employeur_prec_c');	
			$this->addTag('DureeEmploiPrecConj', $VotreSituationFinanciere, 'chez_employeur_prec_depuis_c');
			$this->addTag('NbSalaireConj', $VotreSituationFinanciere, 'nb_salaire_par_an_c');	
			//- $this->addTag('SoumisImpotSourceONConj', $VotreSituationFinanciere, 'impose_a_la_source_c');
			$this->addTag('SalaireNetMensuelConj', $VotreSituationFinanciere, 'salaire_net_mensuel_c');	
			$this->addTag('RevenuAnnuelImposableConjoint', $VotreSituationFinanciere, 'revenu_annuel_imposable_c');
			$this->addTag('AutresRevenusConj', $VotreSituationFinanciere, 'autres_revenus_c');	
			$this->addTag('CreditConj', $VotreSituationFinanciere, 'credits_c');
			$this->addTag('CreditRachatConj', $VotreSituationFinanciere, 'credits_rachat_c');	
			$this->addTag('MontantCreditConj', $VotreSituationFinanciere, 'credits_montant_c');	
			$this->addTag('MontantCreditRestantConj', $VotreSituationFinanciere, 'credits_restants_c');
			$this->addTag('LeasingConj', $VotreSituationFinanciere, 'leasings_c');
			$this->addTag('LeasingRachatConj', $VotreSituationFinanciere, 'leasings_rachat_c');	
			$this->addTag('MontantLeasingConj', $VotreSituationFinanciere, 'leasings_montant_c');	
			$this->addTag('MontantLeasingRestantConj', $VotreSituationFinanciere, 'leasings_restants_c');
			$this->addTag('PoursuiteConj', $VotreSituationFinanciere, 'poursuites_c');
			$this->addTag('MontantPoursuiteConj', $VotreSituationFinanciere, 'poursuites_montant_c');	
			$this->addTag('ActesDefautDeBienConj', $VotreSituationFinanciere, 'addb_c');
			$this->addTag('TroisiemePillierConjoint', $VotreSituationFinanciere, '3e_pillier_c');	
			$this->addTag('CaisseMaladieConjoint', $VotreSituationFinanciere, 'caisse_maladie_c');	
			$this->addTag('AutresChargesConjoint', $VotreSituationFinanciere, 'autres_charges_c');
			$this->addTag('RemarquesConj', $VotreSituationFinanciere, 'remarques_c');
	

		//echo $doc->saveXML();	
		$folder = 'xml_demandes';
		$filename = 'Demande_'.date('omd_His', $id).'.xml';
		
		if( file_put_contents($folder.'/'.$filename, $doc->saveXML() ) ){
			
			if(DEV_ENVIRONMENT == 2){
				$host = 'www.amasoft.ch'; 
				$usr = 'demandescc'; 
				$pwd = 'filetransfer';       
				$resource = $usr.':'.$pwd.'@'.$host;
			
				$resource = ftp_connect($host);
			
				$local_file = $folder.'/'.$filename; 
				$ftp_path = '/data/'.$filename; 
				$conn_id = ftp_connect($host, 21) or die ("Cannot connect to host");      
				ftp_pasv($resource, true); 
				ftp_login($conn_id, $usr, $pwd) or die("Cannot login"); 
				ftp_chdir($conn_id, '/'); 
				$upload = ftp_put($conn_id, $ftp_path, $local_file, FTP_ASCII); 
				if($upload) { $ftpsucc=1; } else { $ftpsucc=0; } 
				ftp_close($conn_id); 
			}
			
			return array('generated'=> true, 'file'=> $folder.'/'.$filename);
		}else{
			return array('generated'=>false );
		}

	}




	
	private function envoiMail($id, $file){
		
		global $smarty, $config_mail;
							
		$documents = explode(',',$_REQUEST['documents'][0]);
		$demandeur_documents = '';

		foreach( $documents as $docs ){
			$demandeur_documents.= '<li>'.$this->g->_($docs).'</li>';
		}
		$documents_c = $_REQUEST['documents_c'];		

		$contenu = $this->pt->_('mail_message_confirmation');
		$smarty->assign('mail_title', $this->pt->_('Votre demande de crédit'));	

		$smarty->assign('demandeur_prenom', $this->getValue('prenom'));
		$smarty->assign('demandeur_nom', $this->getValue('nom'));
		

		if($this->getValue('etat_civil') == 'marie'|| $this->getValue('etat_civil') == 'pacse') {
			$contenu .=  $this->pt->_('Aussi pour les conjoints ...');
		}
		
		if($this->getValue('compte_client') == 'oui') {
			$smarty->assign('demandeur_nom_utilisateur', $this->getValue('nom_utilisateur'));
			$contenu .=  $this->pt->_('demandeur login info');
		}
		$smarty->assign('demandeur_documents', $demandeur_documents);
		$contenu .=  $this->pt->_('mail remerciement');
		
		$smarty->assign('mail_content', $contenu);	
		$mailTotal = $smarty->fetch(SMARTY_WIDGET_TEMPLATES.'/mail.tpl');
		
		
		
		// envoi client
		if($this->getValue('email') != ''){
			$transport = new Zend_Mail_Transport_Smtp(SMTP_HOST, $config_mail);
			$mail = new Zend_Mail('utf-8');
			$mail->setBodyHtml($mailTotal);
			$mail->setFrom(SMTP_USERNAME);
			$mail->addTo($this->getValue('email'), $this->getValue('prenom')." ".$this->getValue('nom'));
			$mail->setSubject($this->pt->_("Confirmation de votre demande de crédit"));
			$mail->send($transport);
		}
		
		// envoi détaillé avec xml
		$contenu.= '<br/><p><strong>XML de demande :</strong><br/>';
		$contenu.= "<a href='".SITE_DOMAIN.'/'.$file."'>Fichier xml de la demande</a></p>";
		$smarty->assign('mail_content', $contenu);	
		$mailTotal = $smarty->fetch(SMARTY_WIDGET_TEMPLATES.'/mail.tpl');
		
		$transport = new Zend_Mail_Transport_Smtp(SMTP_HOST, $config_mail);
		$mail = new Zend_Mail('utf-8');
		$mail->setSubject("Demande de crédit : ".$id); 
		$mail->setBodyHtml($mailTotal);
		$mail->setFrom(SMTP_USERNAME);
		$mail->addTo('sam.baptista@net-lead.ch', 'Samuel Baptista');
		
		if(DEV_ENVIRONMENT == 2){
			$mail->addTo('kgaren@net-lead.ch', 'Garen Kassis');
			$mail->addTo('demande@credit-conseil.ch', 'Crédit conseil');
		}

		$mail->send($transport);
		
		return array('statut'=> true);
		
	}






































/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
/* /////////////////////									petites fonctions								////////////////////// */
/* /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */







	private function getValue($id){
		

		if( isset($this->datas[$id]) && is_array($this->datas[$id]) ){

			if( $this->datas[$id]['v'] != ''){
				$a =  trim($this->datas[$id]['v']);
			}else{
				$a= false;
			}
		}else if (isset($this->datas[$id])){

			$a =  trim($this->datas[$id]);
		}else{
			$a =false;
		}
		return $a;
	}
	
	private function getDisplay($id){
		
		if( isset($this->datas[$id]) && is_array($this->datas[$id])  ){
			if( $this->datas[$id]['d'] != ''){
				return trim($this->datas[$id]['d']);
			}else{
				return trim($this->datas[$id]['v']);
			}
		}else if ( isset($this->datas[$id]) ){

			return trim($this->datas[$id]);
		}else{
			return false;
		}
		
	}
	


	private function prepareData($datas){

		$newDatas = array();
		foreach($datas as $f){

			if(isset($f['d'])){
				if(!isset($newDatas[$f['id']])){
					$newDatas[$f['id']] = array();
				}
				$newDatas[$f['id']]['v'] = $f['v'];
				$newDatas[$f['id']]['d'] = $f['d'];
			}else{
				$newDatas[$f['id']]= ( isset($f['v']) ) ? $f['v'] : '';
			}
		}
		return $newDatas;
	}



	private function validateDate($string){
		$date = explode('/',$string);		
		if( checkdate($date[1],$date[0], $date[2]) && $date[2] >= 1900 && $date[2] < 2100 ){
			return array("success" => true);
		}else{
			return array("success" => false, "message" => $this->pt->_("Date incorrecte."));
		}
	}
	
	private function validatePhone($string){
		if(mb_eregi("^[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}$", $string)) { 	
			return array("success" => true);
		}else{
			return array("success" => false, "message" => $this->pt->_("Numéro incorrect."));
		}
	}
	
	private function validatePhoneCH($string){
		if(mb_eregi("^0[0-9]{2} [0-9]{3} [0-9]{2} [0-9]{2}$", $string)) { 	
			return array("success" => true);
		}else{
			return array("success" => false, "message" => $this->pt->_("Numéro incorrect."));
		}
	}
	
	private function validateEmail($string){
		if( $string == ''||mb_eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $string)) { 	
			return array("success" => true);
			
		}else{
			return array("success" => false, "message" => $this->pt->_("Adresse e-mail incorrecte."));
		}
		
	}

	private function validateNumber($string){
		if(is_numeric($string) || $string == ''){
			return array("success" => true);
		}else{
			return array("success" => false, "message" => $this->pt->_("N'est pas un numéro."));
		}
		
	}





















}
?>