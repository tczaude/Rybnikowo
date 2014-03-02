<article class="details">

		<h2>{$intro_main.title}</h2>
		
		<article class="artic" style="margin: 15px 0 10px 0; font-size: 11px; color: #4e4f4f;">{$intro_main.content}</article>

</article>
<article class="details">
<h2>Polecamy</h2>	
<section class="list">

	{foreach from=$home_list item=product_item name=product}
	{cycle name=class assign=class_name values="list-prod-in ,list-prod-in ,list-prod-in2"}
	<div class="list-prod">
		<div class="{$class_name}">	
			<a href="{$DP}pozycja/{$product_item.url_name}" class="listPicA" title="{$product_item.title}">
				<img class="pic" src="{$DP}images/product/{$product_item.product_id}_02_01.jpg" alt="{$product_item.title}">
			</a>	
			<h3><a href="{$DP}pozycja/{$product_item.url_name}">{$product_item.title}</a></h3>
			<p style="color: #0F9EF1; font-weight: bold; text-align: center;">
				{$product_item.price} zł
			</p>
	         
		</div>	
   	</div>
	
	
	{/foreach}
</section>
</article>