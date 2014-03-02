	{if $category_details.parent eq 0}
	<div class="company-bread">
		<ul style="background-image:url({$DP}images/category_pictures/{$category_details.id}_02_01.jpg);">
			<li><a href="{$DP}">Start</a><i>/</i></li>
			<li><a href="{$DP}kategoria/{$category_details.url_name}"><strong>{$category_details.name}<i>/</i></strong></a></li>
		</ul>
	</div>
	{else}
	<div class="company-bread">
		<ul style="background-image:url({$DP}images/category_pictures/{$category_parent.id}_02_01.jpg);">
			<li><a href="{$DP}">Start</a><i>/</i></li>
			<li><a href="{$DP}kategoria/{$category_parent.url_name}"><strong>{$category_parent.name}<i>/</i></strong></a></li>
			<li>{$category_details.name}</li>
		</ul>
	</div>	
	{/if}
	<section class="company-content">
		
		<div class="company-details">
		
		
			{if $product_list}
			<ul>
				<li>O firmie <i>/</i></li>
				<li>Kontakt <i>/</i></li>
				<li>Mapa dojazdu <i>/</i></li>
				<li>Social <i>/</i></li>
			</ul>
			
			<article>
				<h2>High Tech Studio" S.C. P.Serafin M.Serafin</h2>
				<figure>
					<img src="" style="display:block;width:118px;height:118px;background:#000;" {* style wywal po podlaczeniu obrazka *}/>
				</figure>
				<p><b>O firmie</b> Firma WITTCHEN została założona w 1990 roku przez Jędrzeja Wittchena. Od momentu powstania marka stale zyskiwała na popularności i aktualnie jest liderem na rynku także sprzedaż za pośrednictwem Internetu. Obecnie marka  </p>
				<p class="follow">
					<a href="#">>></a>
				</p>
			</article>
			
			<address>
				ul. Nowowiejskiego 20
				<br>44-274 Rybnik
				<br>oj. śląskie

 				<br><br>telphone:
 				<p class="follow">
					<a href="#">>></a>
				</p>
			</address>
			
			<div class="map">
				<h4>Mapa</h4>
				
				mapa tu
				<p class="follow">
					<a href="#">>></a>
				</p>
			</div>
			
			<div class="map">
				<h4>inne</h4>
				
				inne tu
			</div>
			
			{else}
			
			Brak propozycji
			
			{/if}
			
		</div>
		
		<ul class="company-list">
			{foreach from=$subcategory_list item=subcategory name=subcategory}
			<li  {if $subcategory.id ne $category_details.id}style="font: 12px/24px 'HelveticaNeue',Arial,Verdana,sans-serif;"{/if}><a href="{$DP}kategoria/{$subcategory.url_name}">{$subcategory.name} <i>>></i></a></li>
			{/foreach}
	
		</ul>
	</section>
