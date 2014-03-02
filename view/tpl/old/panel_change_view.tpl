
<div class="view">
	<span>Sortuj według</span>
	{if $filters.view eq main_product_grid}
	<img src="{$DP}images/html/v2.png" alt="widok lista" title="Widok listy">
	{if $url_config.0 eq kategoria}
	<a href="{$DP}kategoria/{$category_details.url_name}/?view=main_product_list">
	{elseif $url_config.0 eq producent}
	<a href="{$DP}producent/{$category_details.url_name}/?view=main_product_list">
	{/if}
		<img src="{$DP}images/html/v1.png" alt="widok kafelki" title="Widok kafelek">
		
	</a>
	{else}
	
	{if $url_config.0 eq kategoria}
	<a href="{$DP}kategoria/{$category_details.url_name}/?view=main_product_grid">
	{elseif $url_config.0 eq producent}
	<a href="{$DP}producent/{$category_details.url_name}/?view=main_product_grid">
	{/if}	
	
		<img src="{$DP}images/html/v1.png" alt="widok kafelki" title="Widok kafelek">
	</a>
	<img src="{$DP}images/html/v2.png" alt="widok lista" title="Widok listy">
	
	
	
	{/if}	
	
</div>
