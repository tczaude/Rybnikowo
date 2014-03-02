{literal}
	<script type="text/javascript">
		$(document).ready(function() {
			$("a[rel=blog_picture]").fancybox({
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade',
				'titlePosition' 	: 'over',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.6
			});
		});
	</script>

{/literal}	
<section class="company-content" style="border-top: 0;">
		
		<div class="company-details">
			
			<h2>Blog</h2>
			
			{if $blog_details}
			<article class="label" style="cursor: pointer;">
				<h2 style="color: #25AAE1;">{$blog_details.title}</h2>
			</article>
			<div class="menu">
				<article class="menu55">
					<figure>
						<a href="{$DP}images/blog/{$blog_details.blog_id}_04_01.jpg" alt="{$blog.title}" title="{$blog.title}" rel=blog_picture>
							<img src="{$DP}images/blog/{$blog_details.blog_id}_02_01.jpg" alt="{$blog_details.title}"/>
						</a>
					</figure>
					<p><strong>{$blog_details.abstract}</strong></p>
					<div id="blog_details"><p>{$blog_details.content}</p></div>
					<p class="follow">
						<a href="javascript:history.go(-1);">&lt;&lt; wstecz</a>
					</p>
				</article>
			</div>

			{/if}

			
		</div>
		
		<ul class="company-list">
			{foreach from=$menu_categories item=menu name=menu}
			<li style="font: 12px/24px Arial,Verdana,sans-serif;"><a href="{$DP}kategoria/{$menu.url_name}">{$menu.name} <i>>></i></a></li>
			{/foreach}
	
		</ul>
	</section>
