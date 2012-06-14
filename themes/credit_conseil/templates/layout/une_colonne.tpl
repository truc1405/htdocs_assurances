{if isset($titrePage) && $titrePage!='titrePage'}<h1>{$titrePage}</h1>{/if}

<div class='content applycms'>
	 {if isset($zone1)}<div class="column col100 leftCol rightCol">{eval var=$zone1 assign="parsedZone1"} {$parsedZone1}</div>{/if}<!--
 -->{if isset($zone11)}<div id='zone11' class="column col100 leftCol rightCol closed">	
			<div id='openZone11'>
				<div>{l term='Plus de détails'} &raquo;</div>			
			</div>
			<div id='closeZone11'>
				<div>&laquo; {l term='Fermer les détails'}</div>			
			</div>
			{$zone11}
	</div>{/if}
</div>

