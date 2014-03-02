<article class="details">
<h2>Nowości</h2>
	{if $product_list}
	{foreach from=$product_list item=product_item name=product_item}
	<section class="list2">
		<article>
			
			
			<div class="list2-l">
				
				<a href="{$DP}pozycja/{$product_item.url_name}" class="listPicA" title="{$product_item.title}">
					<img width="200" class="pic" src="{$DP}images/product/{$product_item.product_id}_03_01.jpg" alt="{$product_item.title}">
				</a>
			</div>	
			<div class="list2-r">
				<h3><a style="color: #00A5DB;" href="{$DP}pozycja/{$product_item.url_name}">{$product_item.title}</a></h3>
			
				<p>
					
					<span style="padding-bottom: 10px; display: block;">
					
					{if $product_item.price_promo ne 0.00}
					
					cena promocyjna: <span><strong>{$product_item.price}</strong> zł</span>
					
					{else}
					
					cena: <span><strong>{$product_item.price}</strong> zł</span>
					
					{/if}
					
					</span>
					
					{$product_item.abstract|truncate:100}
				</p>
				<br>
				<a href="{$DP}pozycja/{$product_item.url_name}" class="button"><i>więcej</i></a>

			</div>	
		</article>
	</section>
{/foreach}	

	{if $paging.page_to && $paging.page_from ne $paging.page_to}
		{include file="paging_news.tpl"}
	{/if}
	
{else}
<p>Brak produktów promocyjnych</p>
{/if}
</article>
		            
			              
			                
   	