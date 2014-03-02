<article class="details">
<h2>Blog</h2>
{foreach from=$blog_list item=blog_item name=blog_item}
	<section class="list2">
		<article>
			
			
			<div class="list2-l">
				
				<a href="{$DP}blog/zobacz/{$blog_item.url_name}/" title="{$blog_item.title}"> 
					<img width="190" class="pic2" src="{$DP}images/blog/{$blog_item.blog_id}_03_01.jpg" alt="{$blog_item.title}" title="{$blog_item.title}">
				</a>
			</div>	
			<div class="list2-r">
				<h3 style="color: #00A5DB;">{$blog_item.title}</h3>
				
				<p>
					{$blog_item.abstract|strip_tags|truncate:200:"..."}
				</p>
				<p class="date">data dodania: {$blog_item.date_created|date_format:"%Y-%m-%d"} <a href="{$DP}blog/zobacz/{$blog_item.url_name}/" class="button"><i>więcej</i></a></p>
				
			</div>	
		</article>
	</section>
{/foreach}	

{if $paging.page_to && $paging.page_from ne $paging.page_to}

	{include file="paging_blog.tpl"}

{else}

{/if}
</article>