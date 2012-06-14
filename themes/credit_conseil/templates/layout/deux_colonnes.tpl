{if isset($titrePage) && $titrePage!='titrePage'}<h1>{$titrePage}</h1>{/if}

<div class='content applycms'><!--
	 -->{if isset($zone1)}<div id='zone1' class="column col100 leftCol rightCol">	{eval var=$zone1 assign="parsedZone1"}{$parsedZone1}</div>{/if}<!-- 
	 -->{if isset($zone2)}<div id='zone2'class="column col50 leftCol">			{eval var=$zone2 assign="parsedZone2"}{$parsedZone2}</div>{/if}<!-- 
	 -->{if isset($zone3)}<div id='zone3' class="column col50 rightCol last">		{eval var=$zone3 assign="parsedZone3"}{$parsedZone3}</div>{/if}<!--
	 -->{if isset($zone10)}<div id='zone10' class="column col100 leftCol rightCol">	{eval var=$zone10 assign="parsedZone4"}{$parsedZone4}</div>{/if}<!-- 
	 -->{if isset($zone11)}<div id='zone11' class="column col100 leftCol rightCol closed">	
				<div id='openZone11'>
					<div>{l term='Plus de détails'} &raquo;</div>			
				</div>
				<div id='closeZone11'>
					<div>&laquo; {l term='Fermer les détails'}</div>			
				</div>
				{eval var=$zone11 assign="parsedZone11"}{$parsedZone11}
		</div>{/if}
</div>

