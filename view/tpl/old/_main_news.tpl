<h1>Nowości</h1>

	

	{if $product_list}
	{foreach from=$product_list item=product_item name=product_item}

	<section class="list">
		<h2><a href="{$DP}pozycja/{$product_item.url_name}">{$product_item.title}</a></h2>
		
		<div class="in">
			<a href="{$DP}pozycja/{$product_item.url_name}" class="listPicA" title="{$product_item.title}">
				<img class="pic" src="{$DP}images/product/{$product_item.product_id}_03_01.jpg" alt="{$product_item.title}">
			</a>	
			   {if $product_item.price_promo ne 0.00}
				<div class="price">
					cena promocyjna: <span><strong>{$product_item.price}</strong> zł</span>
					<a href="{$DP}koszyk/dodaj/{$product_item.product_id}"><img src="{$DP}images/html/bn_addbasket.gif" alt="dodaj do koszyka"></a>
					
					
				</div>
				{else}
				<div class="price">
					cena: <span><strong>{$product_item.price}</strong> zł</span>
					<a href="{$DP}koszyk/dodaj/{$product_item.product_id}"><img src="{$DP}images/html/bn_addbasket.gif" alt="dodaj do koszyka"></a>
				</div>			
				{/if}
			
				
					
					<p>{$product_item.abstract|truncate:100}</p>
					
					<a href="{$DP}pozycja/{$product_item.url_name}" class="more">
						<span>więcej</span>
					</a>
				
	         
			
   		</div>
	</section>
	
	{/foreach}
	
	{if $paging.page_to && $paging.page_from ne $paging.page_to}
		{include file="paging_news.tpl"}
	{/if}
	
   	{else}
   	<p>Brak produktów w tej kategorii</p>
   	{/if}
   	

		            
			              
			                
   	