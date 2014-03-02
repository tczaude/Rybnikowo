			<ul class="comercial">
				
				{foreach from=$slideshow_list item=slideshow}
				<li>
					{$slideshow.title}
					<a href="{$slideshow.abstract}" {if $slideshow.sended eq 2}target="_new"{/if}><img src="{$DP}images/slideshow/{$slideshow.slideshow_id}_03_01.jpg" alt="{$slideshow.title}"></a>
				</li>
				{/foreach}
			</ul>