{if !$content_only}
	<div id='footer'>
		<div id='footerGauche'><div class='bg'></div></div>
		<div id='footerDroite'><div class='bg'></div></div>
		<div id='footerContent'>
			<div id='footerDiv1'>
				
				
				<div id='liens_rapides'>
					<div class='footerHeader'>{l term='Liens rapides'}</div>
					<ul class='listing'>
						<li>
							<ul>
								<li><a href="/{$shortlang}/{l file='urls' term='profil/credit-suisse.html'}" >{l term='Crédit en Suisse'}</a></li>
								<li><a href="/{$shortlang}/{l file='urls' term='profil/credit-frontalier-permis-g.html'}" >{l term='Crédit Frontalier'}</a></li>
								<li><a href="/{$shortlang}/{l file='urls' term='profil/credit-etranger-permis-b-l.html'}" >{l term='Crédit Permis B - L'}</a></li>
								<li><a href="/{$shortlang}/{l file='urls' term='profil/credit-rentier-avs-ai.html'}" >{l term='Crédit AVS - AI'}</a></li>
								<li><a href="/{$shortlang}/{l file='urls' term='profil/credit-independant-directeur.html'}" >{l term='Crédit Indépendant'}</a></li>
							</ul>
						</li>
						<li>
							<ul>
								<li><a href="/{$shortlang}/{l file='urls' term='pret-projet/credit-vehicule.html'}" >{l term='Crédit Véhicule'}</a></li>
								<li><a href="/{$shortlang}/{l file='urls' term='pret-projet/credit-auto.html'}" >{l term='Crédit Auto'}</a></li>
								<li><a href="/{$shortlang}/{l file='urls' term='pret-projet/credit-moto.html'}" >{l term='Crédit Moto'}</a></li>
								<li><a href="/{$shortlang}/{l file='urls' term='pret-projet/credit-camping-car.html'}" >{l term='Crédit Camping Car'}</a></li>
								<li><a href="/{$shortlang}/{l file='urls' term='pret-projet/financement-bateau.html'}" >{l term='Financement Bateau'}</a></li>
							</ul>
						</li>
						<li>
							<ul>
								<li><a href="/{$shortlang}/{l file='urls' term='pret-projet/credit-mobilier.html'}" >{l term='Crédit Mobilier'}</a></li>
								<li><a href="/{$shortlang}/{l file='urls' term='pret-projet/credit-travaux.html'}" >{l term='Crédit Travaux'}</a></li>
								<li><a href="/{$shortlang}/{l file='urls' term='pret-projet/credit-loisir-voyage.html'}" >{l term='Crédit Voyage'}</a></li>
								<li><a href="/{$shortlang}/{l file='urls' term='pret-projet/pret-mariage-naissance.html'}" >{l term='Crédit Mariage'}</a></li>
								<li><a href="/{$shortlang}/{l file='urls' term='pret-projet/credit-chirurgie-sante.html'}" >{l term='Crédit Chirurgie'}</a></li>
							</ul>
						</li>					
					</ul>
				</div>
				
				
				
				<div id='liens_pratiques'>
					
					<div class='footerHeader' id='titreNousSuivre'>{l term='Nous suivre'}</div>
					<!-- <a id='btnTwitter'></a> -->
					<a id='btnfluxRss' href='{$BLOG_URL}'></a>
					
					
					<div class='footerHeader' id='titreLiensPratiques'>{l term='Liens pratiques'}</div>
					<ul class='listing' id='listingLiensPratiques'>
						<li><a href="/{$shortlang}/{l file='urls' term='conditions-generales.html'}" >{l term='Conditions Générales'}</a></li>
						<li><a href="/{$shortlang}/{l file='urls' term='mentions-legales.html'}" >{l term='Mentions Légales'}</a></li>
						<li><a href="/{$shortlang}/{l file='urls' term='liens.html'}" >{l term='Liens'}</a></li>
						<!-- <li><a href="/{$shortlang}/{l file='urls' term='documents-credit.html'}" >Documents à remettre</a></li> -->
					</ul>
		

				</div>
				
				
				
				<div id='derniere_col'>
					<div class='footerHeader'>{l term='Nous contacter'}</div>
					<div id='nousContacterCorps'>
						<div class='relative'><div id='btnPoi'></div></div>
						<div class='orange'>CC Crédits Conseils SA</div>
						Av. de Choiseul 23-25 <br/>
						1290 Versoix<br/><br/>
					
						<div class='relative'><div id='btnPhone'></div></div>
						Tél : 0848 10 2000<br/>
						Fax : 0848 11 2000<br/>
						<div class='relative'><div id='btnMail'></div></div>
						Email: info@credit-conseil.ch
					</div>
					
				
		
				</div>
				
				
				
			</div>
			<div id='footerDiv2'></div>
			<div id='footerDiv3'></div>
			<div id='footerDiv4'></div>
			<style type="text/css" media="screen">
				#signatureNetlead {
					width:960px;
					margin:0px auto;
					text-align:center;
					font-size: 12px;
					color: #888;
					letter-spacing: 0.8px;
					font-family:arial;
				}
				#signatureNetlead a{
					color:#888 !important;
				}
			</style>
			
			<div id='signatureNetlead'>CC Crédit Conseil SA &copy; 2012, Tous droits réservés - Net-lead : <a href='http://www.net-lead.ch'>Agence web</a>, <a href='http://www.net-lead.ch/fr/communication/web-marketing/'>Publicité internet</a></div>
		</div>
	</div>
	
</div>

{/if}

{if isset($javascript_debut)}{$javascript_debut}{/if}
<script src="{$theme_dir}/js/2-jquery-1.7.min.js" type="text/javascript" charset="utf-8"></script>
<script src="{$theme_dir}/js/jquery-ui/js/jquery-ui-1.8.11.custom.min.js" type="text/javascript" charset="utf-8"></script>
<script src="{$theme_dir}/js/shadowbox-3.0.3/shadowbox.js" type="text/javascript" charset="utf-8"></script>
<script src="{$theme_dir}/js/login.js" type="text/javascript" charset="utf-8"></script>	
{if isset($javascript_avant_default)}{$javascript_avant_default}{/if}
<script src="{$theme_dir}/js/10-default.js" type="text/javascript" charset="utf-8"></script>
{if isset($javascript_fin)}{$javascript_fin}{/if}

<script type="text/javascript">
	Shadowbox.init();
</script>


