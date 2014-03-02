
<h1>Nasza oferta</h1>

{foreach from=$feature_list item=feature name=feature}
	<section class="list">
		<h2>{$feature.name}</h2>
		
		<div class="in">
			
			<a href="{$DP}szukaj/?cecha={$feature.id}" title="{$feature.title}"> 
				<img class="pic" src="{$DP}images/feature/{$feature.id}_01.jpg" alt="{$feature.title}" title="{$feature.title}">
			</a>
			<p class="date">{$feature.date_created|date_format:"%Y-%m-%d"}</p>
			<p>
				{$feature.content}
			</p>
			<a href="{$DP}szukaj/?cecha={$feature.id}" class="more"><span>więcej</span></a>
		</div>	
	</section>
{/foreach}	
