

<div class="sMenu">

	<!-- the tabs -->
		<ul class="tabs">
			<li class="tabCat"><a href="#"> </a></li>
			<li class="tabProd"><a href="#"> </a></li>
			
		</ul>
		
		<!-- tab "panes" -->
		<div class="panes">
			<div class="menuSeg">
				<div class="menuSegIn">
				
				 <ul>
                
						
				{foreach from=$menu_categories item=menu name=menu}	
			  			
			  			<li><a {if $split_category.1 ne $menu.id}style="font-size: 12px; color: gray; {if !$smarty.foreach.menu.last}border-bottom: 1px solid #BFBFBF;{/if}"{else}style="font-size: 12px; color: white; background: #666;"{/if} class="level1" href="{$DP}kategoria/{$menu.url_name}_{$menu.id}">{$menu.name}</a>
			           {if $split_category.1 eq $menu.id}  
			           {if $menu.sub}
			   					
								<div class="level2"  {if $split_category.2 eq $subcategory.id}{else}{/if}>
					            	<ul>
					            		<li>
											
											{foreach from=$menu.sub item=subcategory}
												
												<div class="menuIn" {if $split_category.1 eq $menu.id}style="background: #FFF;"{/if}><a {if $split_category.2 eq $subcategory.id}style="color: #129fc7; background:url(/images/html/minus.png) 0% 50% no-repeat;"{/if} href="{$DP}kategoria/{$subcategory.url_name}_{$menu.id}_{$subcategory.id}/1/">{$subcategory.name}</a></div>
												<!-- Level 1 -->
												{if $split_category.2 eq $subcategory.id}
												
												
												
												{if $subcategory.sub}
													<div class="series"style="background: #FFF;">
													{foreach from=$subcategory.sub item=sub1}
														<div style="font-size: 10px;"><a{if $split_category.3 eq $sub1.id} style="color: #00A5DB;" {/if} href="{$DP}kategoria/{$sub1.url_name}_{$menu.id}_{$subcategory.id}_{$sub1.id}/1/">{$sub1.name}</a></div>
														
														<!-- Level 2 -->
														{if $split_category.3 eq $sub1.id}
														{if $sub1.sub}
														<div class="series">
														{foreach from=$sub1.sub item=sub2}
															<div style="font-size: 10px; padding-left: 15px;"><a{if $split_category.4 eq $sub2.id} style="color: #00A5DB;" {/if} href="{$DP}kategoria/{$sub2.url_name}_{$menu.id}_{$subcategory.id}_{$sub1.id}_{$sub2.id}/1/">{$sub2.name}</a></div>
														{/foreach}
														</div>		
														{/if}	
														{/if}										
													
													{/foreach}
													</div>
												{/if}
												
												
												
	            								{/if}
										
										  	{/foreach}	
																	             		
										</li>
									</ul>	
										
					             </div>
								   
			
			            {/if}
			            {/if}
			           </li>
					{/foreach} 
			       
                </ul>
                </div>
				
			</div>
			
			
			
			{*
			<div class="menuSeg">
				<div class="menuSegIn">
					
				<div class="menuProd">
					<p style="color: gray;">Wybierz producenta:</p>
					<select  onchange="window.location='{$path}/producent/' + this.value;">
						<option value="" onclick="window.location='{$DP}kategoria/';"> - wybierz - </option>
						{foreach from=$categories item=category_parent}
						<option style="background-color: #FFF;" value="{$category_parent.url_name}" {if $url_config.1 eq $category_parent.url_name || $category_parent.id eq $ParentId}selected{/if}>{$category_parent.name}</option>
						{/foreach}
					</select>
					{if $subcategory_producer}
					<div>
						<p style="color: gray;">Dostępne serie:</p>
						{foreach from=$subcategory_producer item=subcategory}	
							<div style="font-size: 10px;" class="{if $category_details.id eq $subcategory.id}open{else}close{/if}"><a href="{$DP}producent/{$subcategory.url_name}">{if $category_details.id eq $subcategory.id}{else}{/if} {$subcategory.name}</a></div>
						{/foreach}
					</div>
					{/if}
				</div>
				
				</div>

			</div>
			
			*}
			
		</div>


</div>




{if $url_config.0 ne promocje && $url_config.0 ne nowosci && $url_config.0 ne index && $url_config.0 ne kategoria && $panel_promotion}
<div class="sBox">
	<h2>Promocje</h2>
	
	{foreach from=$panel_promotion item=product_item name=product}
	<div class="{if not $smarty.foreach.product.last}list-prod{/if}">
		<div class="list-prod-in" style="text-align: center;">	
			<h3><a href="{$DP}pozycja/{$product_item.url_name}">{$product_item.title}</a></h3>			
			<div style="text-align: center; padding-top: 15px;">
			<a href="{$DP}pozycja/{$product_item.url_name}" class="listPicA" title="{$product_item.title}">
				<img class="pic" src="{$DP}images/product/{$product_item.product_id}_02_01.jpg" alt="{$product_item.title}">
			</a>	

			<p style="color: #0F9EF1; font-weight: bold; font-size: 19px;">
				{$product_item.price} zł
			</p>
	        </div>
		</div>	
   	</div>
	
	
	{/foreach}
	<a style="padding-bottom: 15px;" href="{$DP}promocje" class="sBoxArrow">czytaj więcej</a>
</div>
{/if}



{if $url_config.0 ne nowosci && $url_config.0 ne index && $url_config.0 ne pozycja}
<div class="sBox">
	<h2 class="blue">Polecamy</h2>
	
	{foreach from=$panel_polecamy item=product_item name=product}
	<div class="{if not $smarty.foreach.product.last}list-prod{/if}">
		<div class="list-prod-in" style="text-align: center;">	
			<h3><a href="{$DP}pozycja/{$product_item.url_name}">{$product_item.title}</a></h3>			
			<div style="text-align: center; padding-top: 15px;">
			<a href="{$DP}pozycja/{$product_item.url_name}" class="listPicA" title="{$product_item.title}">
				<img class="pic" src="{$DP}images/product/{$product_item.product_id}_02_01.jpg" alt="{$product_item.title}">
			</a>	

			<p style="color: #0F9EF1; font-weight: bold; font-size: 19px;">
				{$product_item.price} zł
			</p>
	        </div>
		</div>	
   	</div>
	
	
	{/foreach}
	<a style="padding-bottom: 15px;" href="{$DP}nowosci" class="sBoxArrow">czytaj więcej</a>
</div>
{/if}




{if $url_config.0 ne blog && $url_config.0 ne pozycja && $url_config.0 ne kategoria}
<div class="sBox">
	<h2 class="blue">Na blogu</h2>
	
	{foreach from=$panel_blog item=blog_item name=blog}
	<div class="{if not $smarty.foreach.blog.last}list-prod{/if}">
		<div class="list-prod-in" style="text-align: center;">	
			<h3><a href="{$DP}blog/zobacz/{$blog_item.url_name}">{$blog_item.date_created|date_format:"%Y-%m-%d"}</a></h3>			
			<div style="text-align: center; padding-top: 15px;">
			<a href="{$DP}blog/zobacz/{$blog_item.url_name}" class="listPicA" title="{$blog_item.title}">
				<img class="pic" src="{$DP}images/blog/{$blog_item.blog_id}_02_01.jpg" alt="{$blog_item.title}">
			</a>	

			<p style="color: #0F9EF1; font-weight: bold;">
				{$blog_item.title}
			</p>
	        </div>
		</div>	
   	</div>
	
	
	{/foreach}
	<a style="padding-bottom: 15px;" href="{$DP}blog" class="sBoxArrow">czytaj więcej</a>
</div>
{/if}
{literal}
<script type="text/javascript">

	var active_panel = {/literal}{if $url_config.0 eq kategoria || $url_config.0 eq pozycja}0{elseif $url_config.0 eq producent}1{else}0{/if}{literal};
	$("ul.tabs").tabs(".panes >.menuSeg", {history: true, initialIndex: active_panel});
	
</script>
{/literal}
