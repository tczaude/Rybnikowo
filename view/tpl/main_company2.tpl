{literal}
	<script type="text/javascript">
		$(document).ready(function() {
			$("a[rel=company_picture]").fancybox({
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade',
				'titlePosition' 	: 'over',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.6
			});
		});
	</script>

{/literal}	
	
	
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
			<ul>
				<li><a href="#1">Opis</a> <i>/</i></li>
				<li><a href="#2">Kontakt</a> <i>/</i></li>
				<li><a href="#3">Mapa dojazdu</a> <i>/</i></li>
				{if $pictures_list}
				<li><a href="#4">Zdjęcia </a> <i>/</i></li>
				{/if}
			</ul>		
			
			{if $product_details}

			<article class="label" style="cursor: pointer;">
				<h2 style="color: #25AAE1;">{$product_details.title}</h2>
			</article>
			<div class="menu">
				<article>
					<figure>
						<img src="{$DP}images/product/{$product_details.product_id}_02_01.jpg"/>
					</figure>
					<p><b>{if $product_details.type eq 1}O firmie{elseif $product_details.type eq 2}Krótki opis{/if}</b> {$product_details.abstract}</p>
				</article>	
				<div id="1" class="map">
					<h4>{if $product_details.type eq 1}Opis działalności{elseif $product_details.type eq 2}Opis{/if}</h4>
					<div class="desc">{$product_details.content}</div>
				</div>
				{if $pictures_list}
				<div id="4" class="map">
					<h4>Zdjęcia</h4>
					<ul style="border-bottom: 0;">
					{foreach from=$pictures_list item=picture name=picture}
					
					<li>
					
						<a href="{$DP}images/picture/{$picture.picture_id}_03_01.jpg" alt="{$picture.title}" title="{$picture.title}" rel=company_picture>
					
						<img style="float: left; padding: 0 12px 10px 0;" width="80" src="{$DP}images/picture/{$picture.picture_id}_02_01.jpg" alt="{$picture.title}" />
					
						</a>
					
					</li>
					
					{/foreach}
					</ul>
				</div>				
				{/if}	
				<div id="2" class="map">
					<h4>Kontakt</h4>
					<div class="desc">{$product_details.content2}</div>
				</div>			
				
				<div id="3" class="map">
					<h4>Mapa</h4>
					<div style="padding-top: 15px;">{$product_details.video}</div>
				</div>
				{*
				<div id="4" class="map">
					<h4>Drukuj kupon rabatowy</h4>
					
					wkrótce
				</div>
				*}
			</div>

			{/if}
			
		</div>
		<div class="clear"></div>
		<ul class="company-list">
			{foreach from=$subcategory_list item=subcategory name=subcategory}
			<li  {if $subcategory.id ne $category_details.id}style="font: 12px/24px Arial,Verdana,sans-serif;"{/if}><a href="{$DP}kategoria/{$subcategory.url_name}">{$subcategory.name} <i>>></i></a></li>
			{/foreach}
	
		</ul>
	</section>
