
<section class="company-content" style="border-top: 0;">
		
		<div class="company-details">
			
			<h2>Blog</h2>
			
			{if $blog_list}
			{foreach from=$blog_list item=blog}
			<article class="label" style="cursor: pointer;">
				<h2><a href="{$DP}blog/zobacz/{$blog.url_name}">{$blog.title}</a></h2>
			</article>
			<div class="menu">
				<article>
					<figure>
						<a href="{$DP}blog/zobacz/{$blog.url_name}"><img src="{$DP}images/blog/{$blog.blog_id}_02_01.jpg" alt="{$blog.title}"/></a>
					</figure>
					<p>{$blog.abstract}</p>
					<p class="follow">
						<a href="{$DP}blog/zobacz/{$blog.url_name}">&gt;&gt;</a>
					</p>
				</article>
			</div>
			
			
			{/foreach}
			
			{include file="paging_blog.tpl"}
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
