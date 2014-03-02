
<section class="company-content" style="border-top: 0;">
		
		<div class="company-details">
			
			<h2>Partnerzy</h2>
			
			{if $partner_list}
			{foreach from=$partner_list item=partner}
			<article class="label" style="cursor: pointer;">
				<h2 style="color: #25AAE1; cursor: default;">{$partner.title}</h2>
			</article>
			<div class="menu">
				<article>
					<figure>
						<img src="{$DP}images/partner/{$partner.partner_id}_02_01.jpg" alt="{$partner.title}"/>
					</figure>
					<p>{$partner.content}</p>
					{if $partner.abstract}
					
					<p class="follow" style="font: 12px/18px Arial,Verdana,sans-serif; text-align: left; padding: 0;">
						www: <a style="font: 12px/18px Arial,Verdana,sans-serif;" target="_new" href="{$partner.abstract}" title="{$partner.abstract}">{$partner.abstract}</a>
					</p>					
					
					{/if}
				</article>
			</div>
			
			
			{/foreach}
			
			{include file="paging_partner.tpl"}
			{else}

			<div style="color: #25AAE1; padding: 20px 0;">Brak wpisów - zapraszamy wkrótce</div>

			{/if}

			
		</div>
		
		<ul class="company-list">
			{foreach from=$menu_categories item=menu name=menu}
			<li style="font: 12px/24px Arial,Verdana,sans-serif;"><a href="{$DP}kategoria/{$menu.url_name}">{$menu.name} <i>>></i></a></li>
			{/foreach}
	
		</ul>
	</section>
