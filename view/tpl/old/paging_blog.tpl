
		{if $paging.page_to && $paging.page_from ne $paging.page_to}
		<div class="pagBlog">
		
			{if $paging.previous}<a href="{$DP}blog/lista/{$paging.previous}" class="button" accesskey="1"  title="Poprzednia strona [Alt-1]">{/if}{if $paging.previous}<i>nowsze wpisy</i></a>{/if}
		
			
			{if $paging.last}<a href="{$DP}blog/lista/{$paging.next}" accesskey="2" class="next button" title="Następna strona [Alt-2]">{/if}{if $paging.next}<i>starsze wpisy</i></a>{/if}
		
		</div>
		
		{/if}
