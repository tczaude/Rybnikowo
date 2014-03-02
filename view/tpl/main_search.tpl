
<section class="company-content" style="border-top: 0;">
		
		<div class="company-details">
			
			<h2>Wyniki wyszukiwania</h2>
			
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
					<p><b>Opis</b>{$product.abstract}</p>
					<p class="follow">
						<a href="{$DP}firma/{$product.url_name}">&gt;&gt;</a>
					</p>
				</article>
			</div>
			
			
			{/foreach}
			{else}

			<div style="color: #25AAE1; padding: 20px 0;">Brak wyników wyszukiwania dla frazy "{$ret_post.phrase}"</div>

			{/if}

			
		</div>
		
		<ul class="company-list">
			{foreach from=$menu_categories item=menu name=menu}
			<li style="font: 12px/24px Arial,Verdana,sans-serif;"><a href="{$DP}kategoria/{$menu.url_name}">{$menu.name} <i>>></i></a></li>
			{/foreach}
	
		</ul>
	</section>
