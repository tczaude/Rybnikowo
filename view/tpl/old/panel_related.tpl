
<h2>Do kompletowania z</h2>
<div class="up-sell">
	
										
	<div class="first last odd">
		
		
		<!-- "previous page" action --> 
		<a class="prevPage browse left"></a> 
		 
		<!-- root element for scrollable --> 
		<div class="scrollable">     
		     
		    <!-- root element for the items --> 
		    <div class="items"> 
		     	
					{foreach from=$products_related item=produkt} 
						<a href="{$DP}pozycja/{$produkt.url_name}" title="{$produkt.price} | {$produkt.title}">
							
							<table>
								<tr>
									<td>
										
										<span style="height: 80px; width: 80px; text-align: center;">
											<img style="display: block;" src="{$DP}images/product/{$produkt.product_id}_02_01.jpg" alt="{$produkt.title}" >
										</span>
									
									</td>
								</tr>
								<tr>
									<td style="text-align: center;">
									{if $produkt.price_promo ne 0.00}
									<span style="font-size: 11px;">
									
									<span style="text-decoration: line-through; color:#FF0000;">{$produkt.price} zł<br></span>
									<span style="color: #0F9EF1;">{$produkt.price_promo} zł</span>
									</span>
									{else}
									<span style="font-size: 11px; color: #0F9EF1;">{$produkt.price} zł</span>
									{/if}
									</td>
								</tr>
							</table>
							
							
							
							
							
						</a>
						
					{/foreach}
					
		    </div> 
		     
		</div>
		
	
		
		<!-- "next page" action --> 
		<a class="nextPage browse right"></a>


	</div>

</div>

{literal}
<script> 
$(function() {

	$(".scrollable").scrollable({

	size: 4

	});

});
</script>

{/literal}