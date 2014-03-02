{if $paging.page_to && $paging.page_from ne $paging.page_to}
<div style="width: 100%; border-top: 2px solid #CDCDCD;">


<div class="paginator graphic_paginator">

	{if $paging.previous}<a href="{$DP}partner/lista/{$paging.previous}" accesskey="1"  title="Poprzednia strona [Alt-1]">{/if}{if $paging.previous}<img src="{$DP}images/html/prev.gif" alt="poprzednie"></a>{/if}

	{if $paging.first && $paging.first ne $paging.page_from}
	{if $paging.first}<a href="{$DP}partner/lista/{$paging.first}" class="page_nr">{/if}<span>{$paging.first}</span>{if $paging.first}</a>{/if}
	{/if}
	
	{if $paging.first && $paging.first ne $paging.page_from}
	<span class="hellip">…</span>
	{/if}

	{section name=page start=$paging.page_from loop=$paging.page_to+1}
	
		{if $smarty.section.page.index ne $paging.current}
		
		<a href="{$DP}partner/lista/{$smarty.section.page.index}" class="page_nr"><span>{$smarty.section.page.index}</span></a>
		{else}
		<strong>{$smarty.section.page.index}</strong>
		{/if}

	{/section}
	
	{if $paging.last && $paging.last ne $paging.page_to}
	<span class="hellip">…</span>
	{/if}
	
	{if $paging.last && $paging.last ne $paging.page_to}
	{if $paging.last}<a href="{$DP}partner/lista/{$paging.last}" class="page_nr">{/if}<span>{$paging.last}</span>{if $paging.last}</a>{/if}
	{/if}
	
	{if $paging.last}<a href="{$DP}partner/lista/{$paging.next}" accesskey="2" title="Następna strona">{/if}{if $paging.next}&nbsp;<img src="{$DP}images/html/next.gif" alt="nastepne"></a>{/if}

</div>


</div>
{/if}