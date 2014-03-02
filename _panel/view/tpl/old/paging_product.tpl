		<table border="0" cellpadding="2" cellspacing="0" width="960">
			
			<tr>
				<td width="100%" valign="top" align="right">
					{if $paging.first}<a href="{$path}/product/index/{$category_id}/{$paging.first}">{/if}<img src="{$path}/images/start{if !$paging.first}_off{/if}.gif" border="0" title="{$dict_templates.Remove}">{if $paging.first}</a>{/if}&nbsp;
					{if $paging.previous}<a href="{$path}/product/index/{$category_id}/{$paging.previous}">{/if}<img src="{$path}/images/previous{if !$paging.previous}_off{/if}.gif" border="0" title="{$dict_templates.Remove}">{if $paging.previous}</a>{/if}
					&nbsp;&nbsp;{$dict_templates.NavPage} {$paging.current} {$dict_templates.NavFrom} {$paging.last|default:$paging.current}&nbsp;&nbsp;
					{if $paging.next}<a href="{$path}/product/index/{$category_id}/{$paging.next}">{/if}<img src="{$path}/images/next{if !$paging.next}_off{/if}.gif" border="0" title="{$dict_templates.Remove}">{if $paging.next}</a>{/if}&nbsp;
					{if $paging.last}<a href="{$path}/product/index/{$category_id}/{$paging.last}">{/if}<img src="{$path}/images/end{if !$paging.last}_off{/if}.gif" border="0" title="{$dict_templates.Remove}">{if $paging.last}</a>{/if}
				</td>
			</tr>
			<tr>
				<td width="100%" valign="top" align="center"><img src="{$path}/images/kreska_adm_gray.gif" width="960" height="1"></td>
			</tr>
		</table>