

<article class="details">	
	
	<h2>{$category_details.name}</h2>
	{if $product_list}
	
	{if $paging.page_to && $paging.page_from ne $paging.page_to}
		{include file="paging_product.tpl"}
	{/if}
	<section class="list">	
	{foreach from=$product_list item=product_item name=product}
	{cycle name=class assign=class_name values="list-prod-in ,list-prod-in ,list-prod-in2"}
	
		<div class="list-prod">
			<div class="{$class_name}">	
				<a href="{$DP}pozycja/{$product_item.url_name}" class="listPicA" title="{$product_item.title}">
					<img class="pic" src="{$DP}images/product/{$product_item.product_id}_02_01.jpg" alt="{$product_item.title}">
				</a>	
				<h3 style="text-align: center;"><a href="{$DP}pozycja/{$product_item.url_name}">{$product_item.title}</a></h3>
				<p style="color: #0F9EF1; font-weight: bold; text-align: center;">
					{$product_item.price} zł
				</p>
		         
			</div>	
	   	</div>
		
		
		{/foreach}
	</section>
	

	
	{if $paging.page_to && $paging.page_from ne $paging.page_to}
		{include file="paging_product.tpl"}
	{/if}
	
   	{else}
   	<p>Brak produktów w tej kategorii</p>
   	{/if}
   	
</article>

	
	
		            
			              
			                
   	