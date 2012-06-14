<?php
class bd_manage extends Page{
	
	
	public function customize(){
		
		global $smarty;
		$this->external_template = EXTERNAL_EMPTY;
		$this->layout = LAYOUT_UNE_COLONNE;
		
		try{
					
			$this->$_REQUEST['action']();
			//$this->importZip();
			//$this->importStreets();
		}catch(Exception $e){
					echo 'exception <br/>' ;
					echo $e->getMessage();
		}
		
	}
	
	
	
	private function generate_prices_table()
	{
		global $pdo;
	
		echo '-= debut =-<br/>';
		
		$priceTableName = 'prices_2013';
		
		// efface la BD		
		$pdo->query('delete from '.$priceTableName);
		
		// on défini les valeurs
		$zones = array(
			'VD' => 2,
			'VS' => 2,
			'FR' => 2,
			'GE' => 1,
			'NE' => 1,
			'JU' => 1 );
		$modeles = array('Basis', 'MedFamille', 'HMO');
		$ages = array('mineur-1', 'mineur-2', 'mineur-3', 'adulte');
		$franchises = array(0, 100, 200, 300, 400, 500, 600, 1000, 1500, 2000, 2500);
		$accidents = array('oui', 'non');
		
		
		// on popule la table
		$compteur = 1;
		$results = $pdo->prepare("INSERT INTO ".$priceTableName." (id, canton,zone,modele,age,franchise,accident,prix) VALUES (?,?,?,?,?,?,?,?)");
		foreach($zones as $canton => $zone )
		{
			for($zonenb=1 ; $zonenb <= $zone; $zonenb++)
			{
				foreach($modeles as $modele)
				{
					foreach($ages as $age)
					{
						foreach($franchises as $franchise)
						{
							foreach($accidents as $accident)
							{
								if( 
									( ($age == 'mineur-1' || $age == 'mineur-2' || $age == 'mineur-3') && ( $franchise == 1000 || $franchise == 1500 || $franchise == 2000 || $franchise == 2500 ) )
									||
									( $age == 'adulte' && ( $franchise == 0 || $franchise == 100 || $franchise == 200 || $franchise == 300 || $franchise == 400 || $franchise == 600 ) )
								  )
								{
									$prix = -1 ;
								}else{
									$prix = 0;
								}
						
								echo  "$compteur, ";
								echo  "$canton, ";
								echo  "$zonenb, ";
								echo  "$modele, ";
								echo  "$age, ";
								echo  "$franchise, ";
								echo  "$accident, ";
								echo  "$prix<br/>";
						
						
								$params = array(
									$compteur,
									$canton,
									$zonenb,
									$modele,
									$age,
									$franchise,
									$accident,
									$prix							
								);
								
								$results->execute($params);
								$compteur ++;	
						
							}
					
						}
					}	
				}
			}
	
		}
		
		
		echo '-= fin =-';
	}
	
	
	
	/* supprime les cantons non romands */
	private function minify_tables(){
		global $pdo;
		
		try{
			$results = $pdo->prepare('select num_ordre as val from poste_p1_2012 where canton not like "VD" and canton not like "VS" and canton not like "GE" and canton not like "NE" and canton not like "JU" and canton not like "FR"');
			$results->execute();
			$results = $results->fetchAll(PDO::FETCH_ASSOC);
		

			foreach($results as $result){
				echo ' '.$result['val'].'<br/>';
				$pdo->query('delete from match_street_mini where onrp = '.$result['val']);
			}
			
			$pdo->query('delete from poste_p1_mini_2012 where canton not like "VD" and canton not like "VS" and canton not like "GE" and canton not like "NE" and canton not like "JU" and canton not like "FR"');
			
			/* on ne garde que la BD des cantons qui ont 2 zones ou plus, les autres n'en ayant qu'une seule, sont inutiles */
			$pdo->query('delete from zones_a_mini_2012 where canton not like "VD" and canton not like "VS" and canton not like "FR"');
			$pdo->query('delete from zones_b_mini_2012 where canton not like "VD" and canton not like "VS" and canton not like "FR"');
			$pdo->query('delete from zones_a_mini_2013 where canton not like "VD" and canton not like "VS" and canton not like "FR"');
			$pdo->query('delete from zones_b_mini_2013 where canton not like "VD" and canton not like "VS" and canton not like "FR"');
			
		}catch(PDOException $e){
			echo $e.'<br/><br/>';
			print_r($e).'<br/><br/>';
			echo $e->getMessage();
		}
		
		echo '-= fin =-';
	}
	
	
	
	private function importZip(){
	
		global $pdo;
		
		// $requete = 'SELECT INSEE as id, Codepos as npa, Commune as city, Departement as region FROM villesFrance WHERE Departement like "AIN" || Departement like "DROME" || Departement like "HAUT RHIN" || Departement like "HAUTE SAVOIE" || Departement like "TERRITOIRE DE BELFORT" ORDER BY region, npa';
		// $results = $pdo->prepare($requete);
		// $results->execute();
		// $villes = $results->fetchAll(PDO::FETCH_ASSOC);
		
				
		$pdo->query('delete from match_zip');
		
		$row=0;
		$handle = fopen(__file__.'/../sources/plz_l_20111022.txt', "r");
		$requete = 'INSERT INTO match_zip (num_ordre,type_npa,npa,nom,canton) values (?,?,?,?,?)';
		$results = $pdo->prepare($requete);
		
		while (($data = fgetcsv($handle, 0, chr(9) )) !== FALSE) {
			
			try{
			$results->execute( array(
				utf8_encode($data[0]),
				utf8_encode($data[1]),
				utf8_encode($data[2]),
				utf8_encode($data[5]),
				utf8_encode($data[6]) ));
				
			}catch(PDOException $e){
				echo 'pdo exception <br/>';
				echo $e->getMessage();
				
			}catch(Exception $e){
				echo 'exception <br/>' ;
				echo $e->getMessage();
			}
			
			// if($row > 100){echo 'break';break;}
			$row++;			
		}
						
		
		$cantons = array(
			"AG" => "Argovie",
			"AI" => "Appenzell Rhodes intérieures",
			"AR" => "Appenzell Rhodes extérieures",
			"OW" => "Obwald",
			"SG" => "St-Gall",
			"SH" => "Schaffhouse",
			"BE" => "Berne",
			"SO" => "Soleure",
			"BL" => "Bâle-Campagne",
			"SZ" => "Schwyz",
			"BS" => "Bâle-Ville",
			"UR" => "Uri",
			"VD" => "Vaud",
			"VS" => "Valais",
			"TG" => "Thurgovie",
			"TI" => "Tessin",
			"ZG" => "Zoug",
			"ZH" => "Zurich",
			"FR" => "Fribourg",
			"GE" => "Genève",
			"GL" => "Glaris",
			"GR" => "Grisons",
			"JU" => "Jura",
			"LU" => "Lucerne",
			"NE" => "Neuchâtel",
			"NW" => "Nidwald",
			"DE" => "Allemagne", //(uniquement pour 8238 Büsingen)
			"IT" => "Italie", //(uniquement pour 6911 Campione)￼￼￼￼
			"FL" => "Principauté de Liechtenstein"
		);
		

		foreach ($cantons as $key => $canton){

			try{
				
				$requete = 'update match_zip set canton_nom = "'.$canton.'"  where canton = "'.$key.'"';
				$results = $pdo->query($requete);


			}catch(PDOException $e){
				echo 'pdo exception <br/>';
				echo $e->getMessage();
				
			}catch(Exception $e){
				echo 'exception <br/>' ;
				echo $e->getMessage();
			}
		}
		
		
		// $requete = 'SELECT * FROM match_zip WHERE canton = "NE"';
		// $results = $pdo->prepare($requete);
		// $results->execute();
		// $results = $results->fetchAll(PDO::FETCH_ASSOC);
		
	}
	
	
	private function t($initialtime = null){
		if($initialtime) $time = $initialtime;
		else $time = $this->time;
		
		$time = microtime(true) - $time;
		return round($time,3);
	}
	
	
	
	private function importStreets(){
		
		global $pdo;
		
		// $requete = 'SELECT INSEE as id, Codepos as npa, Commune as city, Departement as region FROM villesFrance WHERE Departement like "AIN" || Departement like "DROME" || Departement like "HAUT RHIN" || Departement like "HAUTE SAVOIE" || Departement like "TERRITOIRE DE BELFORT" ORDER BY region, npa';
		// $results = $pdo->prepare($requete);
		// $results->execute();
		// $villes = $results->fetchAll(PDO::FETCH_ASSOC);
	
		
		$time = microtime(true);

				
		//$pdo->query('delete from match_street');
		
		
		$row=0;
		$handle = fopen(__file__.'/../sources/StraFi_20111022.txt', "r");
		$requete = 'INSERT INTO match_street (recorddart,onrp,strid,strid_fremdspr_alternativ,hauskey,hauskey_alternativ,str_geoport_id,adr_geopost_id,strname,strname_abk,strname_lok_typ,strname_spc,haus_nr,gebaeude_bez_alternativ,adr_status,botenbezirk) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
		$results = $pdo->prepare($requete);
		
		while (($data = fgetcsv($handle, 0, chr(9) )) !== FALSE) {
			
			try{
				$results->execute( array(
					utf8_encode($data[0]),
					utf8_encode($data[1]),
					utf8_encode($data[2]),
					utf8_encode($data[3]),
					utf8_encode($data[4]),
					utf8_encode($data[5]),
					utf8_encode($data[6]),
					utf8_encode($data[7]),
					utf8_encode($data[8]),
					utf8_encode($data[9]),
					utf8_encode($data[10]),
					utf8_encode($data[11]),
					utf8_encode($data[12]),
					utf8_encode($data[13]),
					utf8_encode($data[14]),
					utf8_encode($data[15])
				 ));

			}catch(PDOException $e){
				echo 'pdo exception <br/>';
				echo $e->getMessage();
				
			}catch(Exception $e){
				echo 'exception <br/>' ;
				echo $e->getMessage();
			}
			
			// if($row % 10000 == 0){ 
			//  	echo '<br/>';
			// 	echo $this->t($time); 
			// 	echo "\t - ";
			// 	echo $row;
			// 	echo "\t - ";
			// 	echo round($row/1780000,2);
			// 	echo "%\t - ";
			// 	echo $data[8];
			// }

			$row++;			
		}
		
	}
	
}
?>