

{if isset($errorMsg)}

	<div class='errorMsg'>{$errorMsg}</div>

{else}

	<h1> {l term='Bonjour' file='espace-client'} {$prenom} {$nom}</h1>


<form action='' method='post' class='applycms admin'>
	
	<input type='submit' value='Enregistrer les prix' name='sauverPrix' class='sauverLamal' />
	


	<h2>Filtrer</h2>
	
	<input type='button' id='applyFilter' value='Appliquer le filtre' />

	<table class='prix filtre'>
		<tr>
			<th>Cantons</th>
			<th>Zones</th>
			<th>Modèles</th>
			<th>Ages</th>
			<th>Franchises</th>
			<th>Accident</th>
		</tr>
		<tr>
			<td>
				<ul>
				{foreach from=$cantons item=item}
					<li class='show' data-info='canton_{$item.canton}'>{$item.canton}</li>
				{/foreach}				
				</ul>
			</td>
			<td>
				<ul>
				{foreach from=$zones item=item}
					<li class='show' data-info='zone_{$item.zone}'>{$item.zone}</li>
				{/foreach}				
				</ul>
			</td>
			<td>
				<ul>
				{foreach from=$modeles item=item}
					<li class='show' data-info='modele_{$item.modele}'>{$item.modele}</li>
				{/foreach}				
				</ul>
			</td>
			<td>
				<ul>
				{foreach from=$ages item=item}
					<li class='show' data-info='age_{$item.age}'>{$item.age}</li>
				{/foreach}				
				</ul>
			</td>
			<td>
				<ul>
				{foreach from=$franchises item=item}
					<li class='show' data-info='franchise_{$item.franchise}'>{$item.franchise}</li>
				{/foreach}				
				</ul>
			</td>
			<td>
				<ul>
				{foreach from=$accidents item=item}
					<li class='show' data-info='accident_{$item.accident}'>{$item.accident}</li>
				{/foreach}				
				</ul>
			</td>
		</tr>
	</table>
	
	
	<table class='prix listing'>
		<tr>
			{foreach from=$resultats[0] key=col item=entree}
				<th>{$col}</th>
			{/foreach}
		</tr>
		
	
		{foreach from=$resultats item=resultat}
			<tr class='{if $resultat.prix == 0}warning{/if} canton_{$resultat.canton} zone_{$resultat.zone} modele_{$resultat.modele} age_{$resultat.age} franchise_{$resultat.franchise} accident_{$resultat.accident}'>
				{foreach from=$resultat key=col item=entree}
					<td >
						{if $col=='prix'}
							<input type='text' name='entry{$resultat.id}' value='{$entree}'>
						{else}
							{$entree}
						{/if}

					</td>
				{/foreach}
			</tr>
		{/foreach}
	
	</table>
	
	<input type='submit' value='Enregistrer les prix' name='sauverPrix' class='sauverLamal' />

</form>





{/if}
