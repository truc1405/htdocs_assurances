<ul>
{foreach from=$navRequired.nav[$pagelevel1].subnav key=pageid item=page}
<li class=' {if isset($page.selected) }actual{/if}{if $page.last} last{/if}'><a class='{$page.classe}' href='{$shortlang}/{$pageid}/{$page.url}' >{$page.displayName}</a>
	{if isset($page.subnav) }
		<ul>
		{foreach from=$page.subnav key=subpageid item=subpage}

			<li class='{if isset($subpage.selected) }actual{/if}{if $subpage.last} last{/if}'><a href='{$shortlang}/{$subpageid}/{$subpage.url}' >{$subpage.displayName}</a></li>
		{/foreach}
		</ul>
	{/if}
</li>
{/foreach}
</ul>