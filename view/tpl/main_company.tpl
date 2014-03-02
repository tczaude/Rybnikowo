
	
	
	{if $category_details.parent eq 0}
	<div class="company-bread">
		<ul style="background-image:url({$DP}images/category_pictures/{$category_details.id}_02_01.jpg);">
			<li><a href="{$DP}kategoria/{$category_details.url_name}"><strong>{$category_details.name}<i>/</i></strong></a></li>
		</ul>
	</div>
	{else}
	<div class="company-bread">
		<ul style="background-image:url({$DP}images/category_pictures/{$category_parent.id}_02_01.jpg);">
			<li><a href="{$DP}kategoria/{$category_parent.url_name}"><strong>{$category_parent.name}<i>/</i></strong></a></li>
			<li>{$category_details.name}</li>
		</ul>
	</div>	
	{/if}
	<section class="company-content">
		
		<div class="company-details">
		
			
			{if $product_list}
			{foreach from=$product_list item=product}
			<article class="label" style="cursor: pointer;">
				<h2><a href="{$DP}firma/{$product.url_name}">{$product.title}</a></h2>
			</article>
			<div class="menu">
				<article>
					<figure>
						<a href="{$DP}firma/{$product.url_name}"><img src="{$DP}images/product/{$product.product_id}_02_01.jpg" alt="{$product.title}"/></a>
					</figure>
					<p><b>{if $product.type eq 1}O firmie{elseif $product.type eq 2}Krótki opis{/if}</b> {$product.abstract}</p>
					<p class="follow">
						<a href="{$DP}firma/{$product.url_name}">&gt;&gt;</a>
					</p>
				</article>
			</div>
			
			
			{/foreach}
			{else}
			{if $category_details.parent eq 0}
			<span><img alt="brak kategorii" src="{$DP}images/html/choose_category.png"/><a href="{$DP}dla-firm"><img alt="oferta" src="{$DP}images/html/choose_category2.png"/></a></span>
			{else}
			Brak firmy - <a style="color: #25AAE1; font: 14px/24px Arial,Verdana,sans-serif;" href="{$DP}dla-firm">bądź pierwszy</a>
			{/if}
			
			{/if}
			
		</div>
		{if $subcategory_list}
		<ul class="company-list">
			{foreach from=$subcategory_list item=subcategory name=subcategory}
			<li  {if $subcategory.id ne $category_details.id}style="font: 12px/24px Arial,Verdana,sans-serif;"{/if}><a href="{$DP}kategoria/{$subcategory.url_name}">{$subcategory.name} <i>>></i></a></li>
			{/foreach}
	
		</ul>
		{else}
		<ul class="company-list">
			<li  {if $subcategory.id ne $category_details.id}style="font: 12px/24px Arial,Verdana,sans-serif;"{/if}>Brak subkategorii</li>
		</ul>		
		{/if}
	</section>
