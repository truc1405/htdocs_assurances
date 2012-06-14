<div class='jsgallery'>
	<div id='bandeNoire'></div>
	<div id="bigPict">
		<a id='lien' href='{$picts[0].max}' title='{$picts[0].label}'><img src='{$picts[0].middle}' alt='{$picts[0].label}' /></a>
		
		{foreach from=$picts item=pict}
		<a id='hide' href='{$pict.max}' title='{$pict.label}'></a>
		{/foreach}

		<div id='barreTitre'>
			<span id='titre'>{$picts[0].label}</span>
			<div class='bg'></div>
		</div>
	</div>
	
	<div id="littlePicts">
		<div class='page' title='{$titreGallerie}'>
		{foreach from=$picts key=id item=pict}
			{if $id is div by 4 && $id>0}</div><div class='page' title='{$titreGallerie}'>
			{/if}
			<img src='{$pict.min}' alt='{$pict.label}' class='pict{$id%4+1}'>
		{/foreach}
		</div>
	</div>

</div>