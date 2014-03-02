
<section class="company-content" style="border-top: 0;">
		
		<div class="company-details">
			
			<h2>{$intro_main.title}</h2>
			<div class="menu">
				<div id="1" class="map" style="border-top: 0;">

					<div class="desc">{$intro_main.content}</div>
				</div>
			</div>


			
		</div>
		
		<ul class="company-list">
			{foreach from=$menu_categories item=menu name=menu}
			<li style="font: 12px/24px Arial,Verdana,sans-serif;"><a href="{$DP}kategoria/{$menu.url_name}">{$menu.name} <i>>></i></a></li>
			{/foreach}
	
		</ul>
	</section>
