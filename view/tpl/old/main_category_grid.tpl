
<article class="details">
	<h2>{$category_details.name}</h2>
	{if $subcategory_list}
	<section class="list">
	{foreach from=$subcategory_list item=category name=category}
	{cycle name=class assign=class_name values="list-prod-in ,list-prod-in ,list-prod-in2"}

		<div class="list-prod">
			<div class="{$class_name}">	
				<a href="{$DP}kategoria/{$category.url_name}_{$category.sciezka}" title="{$product_item.title}">
					<img src="{$DP}images/category_pictures/{$category.id}_01.jpg" alt="{$category.name}"> 
				</a>
				<h3 style="text-align: center;"><a href="{$DP}kategoria/{$category.url_name}_{$category.sciezka}">{$category.name}</a></h3>
				
			</div>	
	   	</div>
		
	
	{/foreach}
	</section>
   	{/if}
</article>