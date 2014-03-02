{if $ajax_list}
	<ul>
		{foreach from=$ajax_list item=product}
		<li class="sugSeg" onclick="window.location='{$DP}pozycja/{$product.url_name}'">
			
			
			
				{if $product.pic_01}
				<div style="width: 50px; height: 50px; float: left; padding: 5px;">
					<img src="{$DP}images/product/{$product.product_id}_01_01.jpg" alt="{$product.title}">
				</div>
				{else}
					<img  src="{$DP}images/html/newspic.png" alt="{$product.title}">
				{/if}	
				<h2>{$product.title}</h2>
				cena: {$product.price} zł
			
			
		</li>
		{/foreach}
	</ul>	
		<!-- Brak wynikow wyszukiwania w informacjach -->
{else}
		
	<p>Brak wyników</p>


{/if}