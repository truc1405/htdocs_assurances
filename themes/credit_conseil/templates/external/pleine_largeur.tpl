{include file='external/_header.tpl' bodyclass='pleine_largeur'}

	{if !$content_only}	
		<div id='corps'>
			<div id='corpsContent' >
				<div id='contentWrapper'>
					<div id='content' >
						{$content}
					</div> <!-- fin #content -->
				</div> <!-- fin #rightContentWrapper -->
			</div> <!-- fin corpsContent -->	
		</div> <!-- fin corps -->
		
	{else}
		<div id='contentBody' >{$content}</div>
	{/if}

	{include file='external/_footer.tpl'}

</body>
</html>