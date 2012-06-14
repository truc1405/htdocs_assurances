{include file='external/_header.tpl' bodyclass='sans_sousmenu sky page_interne'}


	{if !$content_only}	
		<div id='corps'>
			<div id='corpsContent' >
				<div id='contentWrapper'>
					<div id='content' >
						{$content}
					</div> <!-- fin #content -->
				</div><!-- fin #rightContentWrapper --><!--
				
				--><div id='sky' class='column rightCol'>{$sky}</div>
			</div> <!-- fin corpsContent -->	
		</div> <!-- fin corps -->
		
	{else}
		<div id='contentBody' >{$content}</div>
	{/if}

	{include file='external/_footer.tpl'}

</body>
</html>