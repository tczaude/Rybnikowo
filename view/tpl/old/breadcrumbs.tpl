
		<a href="/" class="b-home"><img src="{$DP}images/html/home.png" alt="strona główna"></a>
		{if $url_config.0 eq blog}
		<a href="{$DP}blog">Blog</a> {if $url_config.1 eq zobacz}&#8594; {$blog_details.title}{/if}
		
		{elseif $url_config.0 eq kategoria}
		{foreach from=$breadcrumbs item=breadcrumb name=breadcrumb}
		<a href="{$DP}kategoria/{$breadcrumb.url_name}_{$breadcrumb.sciezka}/1">{$breadcrumb.name}</a>{if !$smarty.foreach.breadcrumb.last}{/if}
		{/foreach}
		
		{elseif $url_config.0 eq pozycja}
		{foreach from=$breadcrumbs item=breadcrumb name=breadcrumb}
		<a href="{$DP}kategoria/{$breadcrumb.url_name}_{$breadcrumb.sciezka}/1">{$breadcrumb.name}</a> 
		{/foreach}
		{*$product_details.title*}
		{elseif $url_config.0 eq producent}
		
		{if $parent_details}<a href="{$DP}producent/{$parent_details.url_name}">{$parent_details.name}</a>{/if}<a href="{$DP}producent/{$category_details.url_name}">{$category_details.name}</a>
		
		{/if}	

		{if $url_config.0 eq pomoc}Pomoc{/if}
		{if $url_config.0 eq nowosci}Nowości{/if}
		{if $url_config.0 eq promocje}Promocje{/if}
		{if $url_config.0 eq szukaj}Szukaj{/if}
		{if $url_config.0 eq index}Strona główna{/if}