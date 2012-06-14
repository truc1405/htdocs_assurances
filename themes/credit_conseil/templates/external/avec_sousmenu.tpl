{if isset($menuGauche)}
{include file='external/_header.tpl' bodyclass='avec_sousmenu sky page_interne'}
{else}
{include file='external/_header.tpl' bodyclass='sans_sousmenu sky page_interne'}
{/if}

		
	{if !$content_only}	
		<div id='corps'>
			<div id='corpsContent'>
				{if isset($menuGauche)}
				<ul id='menuGauche' class='menu'>
					{$menuGauche}
				</ul><!--
				
		-->{/if}<div id='contentWrapper'>
					<div id='content' >
						{*$content*}
						
						{eval var=$content assign="parsedBuffer"}
						{$parsedBuffer}
						
						
					</div> <!-- fin #content -->
				</div><!-- fin #rightContentWrapper --><!--
				
				--><div id='sky' class='column rightCol'>{$sky}</div>
				
			</div><!-- fin corpsContent -->
			
		</div> <!-- fin corps -->

	{else}	
		<div id='contentBody' >{$content}</div>
	{/if}
	
	{include file='external/_footer.tpl'}
</body>
</html>