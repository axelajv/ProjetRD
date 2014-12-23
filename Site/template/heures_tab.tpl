{foreach from=$allSeances item=seance}
	{if $seance.type == 'cumul' }
		<tr class="cumul success">
			<td></td>
			<td></td>
			<td colspan="5">{$seance.nomMatiere} - cumul des seances : </td>
			<td colspan="3">
				{if $seance.dureeTP !=0}<span><b>TP:</b> {$seance.dureeTP}</span>{else} {/if}
				{if $seance.dureeCM !=0}<span><b>CM:</b> {$seance.dureeCM}</span>{else} {/if}
			  {if $seance.dureeTD !=0}<span><b>TD:</b> {$seance.dureeTD}</span>{else} {/if}
			</td>
			<td>{$seance.eqTD}</td>
			<td></td>
		</tr>
	{else}
		<tr>
			<td>{$seance.nomFormation}</td>
			<td>{$seance.codeApogee}</td>
			<td>{$seance.nomMatiere}</td>
			<td>{$seance.dateSeance}  </td>
			<td>{$seance.heureDebut}</td>
			<td>{$seance.heureFin}</td>
			<td>{if $seance.volumeReparti == 0} NON {else} OUI {/if}</td>
			<td>{if $seance.forfaitaire == 0} NON {else} OUI {/if} </td>
			{if $seance.dureeCM !=0}<td class="info">CM</td>{else}
			{if $seance.dureeTD !=0}<td class="success">TD</td>{else}
			{if $seance.dureeTP !=0}<td class="warning">TP</td>{else}
			{/if}{/if}{/if}
			<td>
				{if $seance.dureeCM !=0}{$seance.dureeCM}{else}
				{if $seance.dureeTD !=0}{$seance.dureeTD}{else}
				{if $seance.dureeTP !=0}{$seance.dureeTP}{else}
				{/if}{/if}{/if}
			</td>
			<td>{$seance.eqTD}</td>
			<td>{if $date_actuelle  >= $seance.dateSeanceFormatee } <span class='glyphicon glyphicon-ok-circle'></span><span class="hide">+</span> {/if}</td>
		</tr>
	{/if}
{/foreach}
