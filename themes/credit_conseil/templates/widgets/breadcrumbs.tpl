{if count($breadcrumbs)>0}
	<div id='breadcrumbs'>
		{l term='Vous êtes ici'} : <a href='/{$shortlang}/'>{l term='Accueil'}</a>
		{foreach $breadcrumbs as $page name=breadcrumbf}
			{if isset($page.url)}
				{if !$smarty.foreach.breadcrumbf.last}
					&raquo; <a href='/{$shortlang}/{$page.url}/'>{$page.displayName}</a>
				{else}
					&raquo; <span>{$page.displayName}</span>
				{/if}
			{/if}
		{/foreach}
	</div>
{/if}