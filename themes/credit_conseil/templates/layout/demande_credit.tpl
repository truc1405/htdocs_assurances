<script type="text/javascript" charset="utf-8">
	
var ADRESSE_VALIDATION_ENVOI = 						"/{$shortlang}/{l file='urls' term='confirmation-demande-credit.html'}";
	
var CHOISISSEZ_UNE_OPTION = 						"{l file='demande-credit' term='Choisissez une option...'}";
var DOCUMENTS_SALARIE_SUISSE = 						"{l file='demande-credit' term='DOCUMENTS_SALARIE_SUISSE'}";
var DOCUMENTS_INDEPENDANT_SUISSE = 					"{l file='demande-credit' term='DOCUMENTS_INDEPENDANT_SUISSE'}";
var DOCUMENTS_SALARIE_PAS_SUISSE = 					"{l file='demande-credit' term='DOCUMENTS_SALARIE_PAS_SUISSE'}";
var DOCUMENTS_RENTIERS = 							"{l file='demande-credit' term='DOCUMENTS_RENTIERS'}";
var DOCUMENTS_FONCTIONNAIRES = 						"{l file='demande-credit' term='DOCUMENTS_FONCTIONNAIRES'}";

var VERDICT_ROUGE_NON = 							"{l file='demande-credit' term='VERDICT_ROUGE_NON'}";
var VERDICT_ORANGE_PLUS_INFOS = 					"{l file='demande-credit' term='VERDICT_ORANGE_PLUS_INFOS'}";
var VERDICT_VERT_CONTINUEZ = 						"{l file='demande-credit' term='VERDICT_VERT_CONTINUEZ'}";
var VOUS_DEMANDEZ_TROP = 							"{l file='demande-credit' term='VOUS_DEMANDEZ_TROP'}";
var MONTANT_MAXIMUM = 								"{l file='demande-credit' term='MONTANT_MAXIMUM'}";
var DEUX_TELEPHONES_NECESSAIRES = 					"{l file='demande-credit' term='DEUX_TELEPHONES_NECESSAIRES'}";
var MOTS_DE_PASSE_DIFFERENTS = 						"{l file='demande-credit' term='MOTS_DE_PASSE_DIFFERENTS'}";	
var VOUS_NAVEZ_PAS_DROIT = 							"{l file='demande-credit' term='VOUS_NAVEZ_PAS_DROIT'}";

var EMAIL_OBLIGATOIRE_SI_COMPTE	= 					"{l file='demande-credit' term='EMAIL_OBLIGATOIRE_SI_COMPTE'}";
var POURSUITES_TROP_ELEVEES = 						"{l file='demande-credit' term='POURSUITES_TROP_ELEVEES'}";

var CE_CHAMP_EST_REQUIS =							"{l file='demande-credit' term='Ce champ est requis'}";
var VEUILLEZ_ENTRER_UNE_DATE_VALIDE = 				"{l file='demande-credit' term='Veuillez entrer une date valide'}";
var LE_MIN_EST_DE = 		 				  		"{l file='demande-credit' term='Le min est de'}";
var LE_MAX_EST_DE = 		 				  		"{l file='demande-credit' term='Le max est de'}";
var PAS_UN_NOMBRE = 		 				  		"{l file='demande-credit' term='N\'est pas un nombre'}";
var VEUILLEZ_CHOISIR_UNE_REPONSE =					"{l file='demande-credit' term='Veuillez choisir une réponse'}";
var VEUILLEZ_REMPLIR_UNE_TRANCHE_DAGE =				"{l file='demande-credit' term='Veuillez remplir au moins une tranche d\'âge'}";
var FORM_OK =										"{l file='demande-credit' term='form ok'}";

var pieceIdentiteOuPasseportRecu  =	 				"{l term='pieceIdentiteOuPasseportRecu'}";
var troisFichesSalaire=	 							"{l term='troisFichesSalaire'}";
var permisSejourBLCRecu	=	 						"{l term='permisSejourBLCRecu'}";
var dernierReleveDeCompteBancaire	=				"{l term='dernierReleveDeCompteBancaire'}";	
var derniereFactureElectricite	=	 				"{l term='derniereFactureElectricite'}";
var carteLegitimationDEF			=	 			"{l term='carteLegitimationDEF'}";
var derniereTaxationFiscale			=	 			"{l term='derniereTaxationFiscale'}";
var decisionOfficielleRentes		=	 			"{l term='decisionOfficielleRentes'}";	
var troisDerniersAvisEntreeDeRente	=	 			"{l term='troisDerniersAvisEntreeDeRente'}";
var contratDeTravail			=	 				"{l term='contratDeTravail'}";		

var VEUILLEZ_JOINDRE_LES_DOCUMENTS_DE_VOTRE_CONJOINT = "{l file='demande-credit' term='Aussi pour les conjoints ...'}";
var VEUILLEZ_ENTRER_EMAIL_VALIDE= 				 	"{l file='demande-credit' term='VEUILLEZ_ENTRER_EMAIL_VALIDE'}";

var TEXTE_QUITTER_PAGE	= 							"{l file='demande-credit' term='Etes-vous sûrs de vouloir quitter cette page ? Si vous quittez vous perdrez toutes les informations saisies.'}";
var ENTREZ_UN_NUM_VALIDE = 						 	"{l file='demande-credit' term='Veuillez entrer un numéro valide.'}";
var ACCEPTATION_NECESSAIRE = 						"{l file='demande-credit' term='ACCEPTATION_NECESSAIRE'}";
var WARNING_MESSAGE = 								"{l file='demande-credit' term='WARNING_MESSAGE'}";
var SAISIE_ABSENTE_DES_PROPOSITIONS	 = 				"{l file='demande-credit' term='SAISIE_ABSENTE_DES_PROPOSITIONS'}";

var PLUSIEURS_ERREURS = 							"{l file='demande-credit' term='PLUSIEURS_ERREURS'}";
var ERREURS_SUR_CETTE_ETAPE = 						"{l file='demande-credit' term='ERREURS_SUR_CETTE_ETAPE'}";

var LOADING = 										"{l file='demande-credit' term='LOADING'}";

{if !isset($smarty.get.demande)}
	var activeFilters = true;
{else}
	var activeFilters = false;
{/if}
</script>


<div id='form_demande_credit'>

	{if isset($titrePage) && $titrePage!='titrePage'}<h1>{$titrePage}</h1>{/if}

	<div class='content applycms'>

	<div id='txtSansEngagement'>{l file='demande-credit' term='Sans engagement : délai de révocation de 7 jours !'}</div>

	<ul class='etapesEnonce'>
		   <li class='boutonEtapePrecedente enonceEtape1 active' data-destination='etape1'><span>{l file='demande-credit' term='Votre projet'}</span></li><!--
		--><li class='boutonEtapePrecedente enonceEtape2' data-destination='etape2'><span>{l file='demande-credit' term='Votre identité'}</span></li><!--
		--><li class='boutonEtapePrecedente enonceEtape3' data-destination='etape3'><span>{l file='demande-credit' term='Vos coordonnées'}</span></li><!--
		--><li class='boutonEtapePrecedente enonceEtape4' data-destination='etape4'><span>{l file='demande-credit' term='Situation professionnelle et revenu'}</span></li><!--
		--><li class='enonceEtape5'><span>{l file='demande-credit' term='Vos charges financières'}</span></li>
	</ul>


	<div id='zoneForm'>
		<div id='bgTop'> </div>
		<div id='formContent'>
			
			<form id='demande-credit-formulaire' action='' method='get'>
				<div id='etape1' class='etape'>
					<div class='boutonsNav'><div class='zoneRapportErreurs'><div class='contentErrors'>{l file='demande-credit' term='ERREURS_SUR_CETTE_ETAPE'}</div></div></div>
					{include file="layout/form/etape1.tpl"}
					<div class='boutonsNav'>
						<div class='zoneRapportErreurs'><div class='contentErrors'>{l file='demande-credit' term='ERREURS_SUR_CETTE_ETAPE'}</div></div>
						<div class='boutonEtapeSuivante'  id='boutonContinuerEtape2'>{l file='demande-credit' term='Passer à l\'étape suivante'}</div>
					</div>
				</div>
				
				<div id='etape2' class='etape'>
					<div class='boutonsNav'><div class='zoneRapportErreurs'><div class='contentErrors'>{l file='demande-credit' term='ERREURS_SUR_CETTE_ETAPE'}</div></div></div>
					<div class='zoneContenu'></div>
					<div class='boutonsNav'>
						<div class='zoneRapportErreurs'><div class='contentErrors'>{l file='demande-credit' term='ERREURS_SUR_CETTE_ETAPE'}</div></div>
						<div class='boutonEtapePrecedente' >&laquo; {l file='demande-credit' term='Revenir à l\'étape précédente'}</div>
						<div class='boutonEtapeSuivante'  id='boutonContinuerEtape3'>{l file='demande-credit' term='Passer à l\'étape suivante'}</div>
					</div>
				</div>
				
				<div id='etape3' class='etape'>
					<div class='boutonsNav'><div class='zoneRapportErreurs'><div class='contentErrors'>{l file='demande-credit' term='ERREURS_SUR_CETTE_ETAPE'}</div></div></div>
					<div class='zoneContenu'></div>
					<div class='boutonsNav'>
						<div class='zoneRapportErreurs'><div class='contentErrors'>{l file='demande-credit' term='ERREURS_SUR_CETTE_ETAPE'}</div></div>
						<div class='boutonEtapePrecedente'>&laquo; {l file='demande-credit' term='Revenir à l\'étape précédente'}</div>
						<div class='boutonEtapeSuivante'  id='boutonContinuerEtape4'>{l file='demande-credit' term='Passer à l\'étape suivante'}</div>
					</div>
				</div>
				
				<div id='etape4' class='etape'>
					<div class='boutonsNav'><div class='zoneRapportErreurs'><div class='contentErrors'>{l file='demande-credit' term='ERREURS_SUR_CETTE_ETAPE'}</div></div></div>
					<div class='zoneContenu'></div>
					<div class='boutonsNav'>
						<div class='zoneRapportErreurs'><div class='contentErrors'>{l file='demande-credit' term='ERREURS_SUR_CETTE_ETAPE'}</div></div>
						<div class='boutonEtapePrecedente' >&laquo; {l file='demande-credit' term='Revenir à l\'étape précédente'}</div>
						<div class='boutonEtapeSuivante'  id='boutonContinuerEtape5'>{l file='demande-credit' term='Passer à l\'étape suivante'}</div>
					</div>
				</div>
				
				
				
				
				
				<div id='etape5' class='etape step5'>
					<div class='boutonsNav'><div class='zoneRapportErreurs'><div class='contentErrors'>{l file='demande-credit' term='ERREURS_SUR_CETTE_ETAPE'}</div></div></div>	
					<div class='zoneContenu'></div>

					<h2>Finalisation</h2>

					<fieldset>
						<div class='radio field hidden required'>
							<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Souhaitez-vous un compte client ?'}</span></span><!--
							--><div class='rightPart'>				
								<label class='option first' for='compte_client_oui'><input type='radio' id='compte_client_oui' name='compte_client' value='oui'/>{l file='demande-credit' term='Oui'}</label>
								<label class='option last' for='compte_client_non'><input type='radio' id='compte_client_non' name='compte_client' value='non'/>{l file='demande-credit' term='Non'}</label>
							</div><!--
							--><div class='thirdPart'><div class='infoBtn'></div></div>
							<div class='quartPart'>{l file='demande-credit' term='info création compte'}</div>
						</div>	

						<div class='field hidden text required'>
							<span class='leftPart'><label for='nom_utilisateur' class='leftContent'>{l file='demande-credit' term='Nom d\'utilisateur'}</label></span><!--
							--><span class='rightPart'>				
								<input type='text' id='nom_utilisateur' name='nom_utilisateur' value='' />
							</span><!--
							       --><div class='thirdPart'></div>
						</div>

						<div class='field hidden pass text required'>
							<span class='leftPart'><label for='mot_de_passe' class='leftContent'>{l file='demande-credit' term='Mot de passe'}</label></span><!--
							--><span class='rightPart'>				
								<input type='password' id='mot_de_passe' name='mot_de_passe' value='' />
							</span><!--
							       --><div class='thirdPart'></div>
						</div>

						<div class='field hidden pass text required'>
							<span class='leftPart'><label for='mot_de_passe2' class='leftContent'>{l file='demande-credit' term='Retapez votre mot de passe'}</label></span><!--
							--><span class='rightPart'>				
								<input type='password' id='mot_de_passe2' name='mot_de_passe2' value='' />
							</span><!--
							       --><div class='thirdPart'></div>
						</div>
						
					</fieldset>
					<fieldset>
						
						<div id='champEmail' class='field email'>
							<span class='leftPart'><label for='email' class='leftContent'>{l file='demande-credit' term='E-mail'}</label></span><!--
							--><span class='rightPart'>				
								<input type='text' id='email' name='email' placeholder='example@example.com' value='' />
							</span><!--
							       --><div class='thirdPart'></div>
						</div>
						
					</fieldset>
					<fieldset>
						
						<div class='textarea field'>
							<span class='leftPart'><label for='remarques' class='leftContent'>{l file='demande-credit' term='Remarques'}</label></span><!--
							--><div class='rightPart'>				
								<textarea name='remarques' id='remarques' rows='8' cols='90'></textarea>
							</div><!--
							      --><div class='thirdPart'></div>
						</div>
						
					</fieldset>
					<fieldset>
						<div class='radio field required'>
							<span class='leftPart'><span class='leftContent'>{l file='demande-credit' term='Acceptez-vous les conditions générales ?'}</span></span><!--
							--><div class='rightPart yes_not'>				
								<label class='option first' for='jaccepte_oui'><input type='radio' id='jaccepte_oui' name='jaccepte' value='oui'/>{l file='demande-credit' term='J\'accepte'}</label>
								<label class='option last' for='jaccepte_non'><input type='radio' id='jaccepte_non' name='jaccepte' value='non'/>{l file='demande-credit' term='Je refuse'}</label>
							</div><!--
	                              --><div class='thirdPart'></div><!--
							--><span class='info_permanente'><br/>{l file='demande-credit' term='J\'accepte les conditions ...'}
								 <ul id='consentementsGeneraux' >
									<li><a href="{l file='_urls' term='conditions-generales.html'}?content_only=1" rel='shadowbox;width=740'>{l file='demande-credit' term='Déclaration de consentement'}</a></li>
									<li><a href="{l file='_urls' term='mentions-legales.html'}?content_only=1" rel='shadowbox;width=740'>{l file='demande-credit' term='Informations Juridiques'}</a></li>
								 </ul></span>
						</div>
						
						<div id='debugCalcul'></div>
					</fieldset>
					
				
					
					<div class='boutonsNav'>
						<div class='zoneRapportErreurs'><div class='contentErrors'>{l file='demande-credit' term='ERREURS_SUR_CETTE_ETAPE'}</div></div>
						<div class='boutonEtapePrecedente'>&laquo; {l file='demande-credit' term='Revenir à l\'étape précédente'}</div>
						<div class='boutonEtapeSuivante'  id='boutonContinuerEtape6'>
							{l file='demande-credit' term='Envoyer la demande'}
							<div id='sending'></div>
						</div>
					</div>
				</div>
				
				

			</form>
			
		</div>
		<div id='bgBot'> </div>
	</div>


	
	</div>
</div>




