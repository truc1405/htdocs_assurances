<div id='miniContactForm'>
	<span class='miniContactTitre' href='#'>{$titre}</span>
	
	<span class='introMinoContact'>{$intro}</span>
	
	<input type='hidden' name='link' value='{$shortlang}/{$actualPage.pageid}/{$actualPage.url}' />
	<input type='hidden' name='produitConcerne' value="{$produitConcerne}" />
	<input type='hidden' name='pageProduit' value='http://www.orca-piscines.ch/{$shortlang}/{$actualPage.pageid}/{$actualPage.url}' />
	<input type='hidden' name='sendTo' value='{$sendTo}' />
	
	
	<label for='Nom'>{$labelNom}<span class='ast'>*</span></label> <input type='text' value='' name='Nom' size='22'/>
	<div class='clear'></div>
	<label for='Email'>{$labelEmail}<span class='ast'>*</span></label> <input type='text' value='' name='Email' size='22'/>
	<div class='clear'></div>	
	<label for='Telephone'>{$labelTel}</label> <input type='text' value='' name='Telephone' size='22'/>
	<div class='clear'></div>
<br/>
	<input id='submitMiniMail' type='button' value='{$labelEnvoyer}' />
	<div id='processingMessage' class='message'>{$processingMessage}</div>	
	<div id='messageZone' class='message'></div>
	<div id='fatalError' class='message'>{$errorMessage} {$sendTo} {$interet} <strong>{$produitConcerne}</strong>.</div>

	
</div>

