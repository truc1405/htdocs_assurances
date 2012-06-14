{foreach from=$menu key=url item=element name=menu}{if $element.show != false}
		<li class='item{if isset($element.current)} current{/if}{if $smarty.foreach.menu.last} last{/if}{if $smarty.foreach.menu.first} first{/if}{if $element.subnav} parent{/if}'>
			{if $element.url == '/'}
				<a class='item-link' href='/{$shortlang}/'>{$element.displayName}</a><span class='tab'></span>
				
			{elseif isset($element.link) && $element.link == true}
				<a class='item-link' href='{$element.url}'>{$element.displayName}</a><span class='tab'></span>
			{else}
				<a class='item-link' href='/{$shortlang}/{$element.url}'>{$element.displayName}</a><span class='tab'></span>
			{/if}
		
			{if $element.subnav}
			<ul class='sousnav'>
				{foreach from=$element.subnav key=url item=child name=sousnav}{if $element.show != false}
				<li class='item{if isset($child.current)} current{/if}{if $smarty.foreach.sousnav.last} last{/if}{if $smarty.foreach.sousnav.first} first{/if}'>
					{if isset($child.link) && $child.link == true}
						<a class='item-link' href='{$child.url}'>{$child.displayName}</a>
					{else}
						<a class='item-link' href='/{$shortlang}/{$child.url}'>{$child.displayName}</a>
					{/if}
				</li>
				{/if}{/foreach}
				<li class='endof_subnav'></li>
			</ul>
			{/if}
		</li>
{/if}{/foreach}