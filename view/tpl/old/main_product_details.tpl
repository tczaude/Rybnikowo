{literal}
	<script type="text/javascript">
		$(document).ready(function() {
			$("a[rel=example_group]").fancybox({
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade',
				'titlePosition' 	: 'over',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.6
			});

			$("#video").fancybox({
				'scrolling' 		: 'no',
				'width'				: 600,
				'height'			: 340,
		        'autoScale'     	: false,
		        'transitionIn'		: 'fade',
				'transitionOut'		: 'fade',
				'type'				: 'iframe'
			});



			$("#addtocart_form").validate({
				rules: {
					"basket_form[BasketEmail]": {
						required: true,
						email: true
					}
				},
				messages: {
					"basket_form[BasketEmail]": {
						required: "pole wymagane",
						email: "adres niepoprawny"
					}
				}
			});







			
		});


	</script>

{/literal}	

<article class="details">
     <h2><b>{$product_details.title}</b></h2>
     
     <div class="productUp">
	   
	    <div id="main_view">
	     	
	     	<a id="main_a" rel="example_group" href="{$DP}images/product/{$product_details.product_id}_03_01.jpg">
	    		<img class="pic" src="{$DP}images/product/{$product_details.product_id}_03_01.jpg" alt="{$product_details.title}" title="{$product_details.title}" >
			</a>	
			{if $product_details.pic_02}
				<a rel="example_group" href="{$DP}images/product/{$product_details.product_id}_03_02.jpg"></a>
			{/if}
			{if $product_details.pic_03}
				<a rel="example_group" href="{$DP}images/product/{$product_details.product_id}_03_03.jpg"></a>	
			{/if}
					
	        <div class="panel_price">			
			{if $product_details.video}
	        	<a id="video" href='{$DP}video/{$product_details.product_id}'>Zobacz prezentację video</a>
	        {/if}
			{if $product_details.service ne 1}
	        	<span>cena: <strong style="font-size: 18px; color: black;">{$product_details.price}</strong> zł</span>
	        	<br>
			{if $product_details.available}
				<span style="margin: 10px 0; display: block;">{if $product_details.available eq 1}<img src="{$DP}images/html/avail.png" alt="dostepny">{elseif $product_details.available eq 2}<img src="{$DP}images/html/mediumavail.png" alt=" srednio dostepny">{elseif $product_details.available eq 3}<img src="{$DP}images/html/noavail.png" alt="niedostepny">{/if}</span>
			{/if}		        	
			{if $product_details.delivery_time}
				<span>czas dostawy: {if $product_details.delivery_time eq 1}<strong> 24h</strong>{elseif $product_details.delivery_time eq 2}<strong> 48h</strong>{elseif $product_details.delivery_time eq 3}<strong> 5 dni</strong>{elseif $product_details.delivery_time eq 4}<strong> 2 tyg</strong>{elseif $product_details.delivery_time eq 5}<strong> na miejscu</strong>{elseif $product_details.delivery_time eq 6}<strong> 2 h</strong>{elseif $product_details.delivery_time eq 7}<strong> 4 h</strong>{elseif $product_details.delivery_time eq 8}<strong> 3 dni</strong>{elseif $product_details.delivery_time eq 9}<strong> 4 dni</strong>{/if}</span>
				<br>
			{/if}	
			{/if}
			{if $product_details.service eq 1}        	
	        	<span><img style="padding-top: 20px;" src="{$DP}images/html/rybnikowo.code13.pl009.png" alt="infolinia"></span>
	        {else}
	        	<span><img style="padding-top: 20px;" src="{$DP}images/html/rybnikowo.code13.pl004.png" alt="infolinia"></span>
	        {/if}
	        </div> 			
	    </div>
	   
	        
	    <div class="detailsTop">      
			{if $product_details.service ne 1}
	          <div class="detailsThumb">

	          		<ul class="thumb">
						<li><a href="{$DP}images/product/{$product_details.product_id}_03_01.jpg"><img src="{$DP}images/product/{$product_details.product_id}_03_01.jpg" alt="{$product_details.title}" title="{$product_details.title}"></a></li>
						<li>
							{if $product_details.pic_02}
									<a href="{$DP}images/product/{$product_details.product_id}_03_02.jpg"><img src="{$DP}images/product/{$product_details.product_id}_03_02.jpg" alt="{$product_details.title}" title="{$product_details.title}"></a>
							{/if}
						</li>
						<li>
							{if $product_details.pic_03}
								<a href="{$DP}images/product/{$product_details.product_id}_03_03.jpg"><img src="{$DP}images/product/{$product_details.product_id}_03_03.jpg" alt="{$product_details.title}" title="{$product_details.title}"></a>
							{/if}
						</li>
	
					</ul>
					  		
	                  <form action="/koszyk" method="post" name="addtocart_form" id="addtocart_form">   
	                  	<fieldset>
						<input type="hidden" value="AddToBasket" name="action"/>
						<input type="hidden" value="{$product_details.product_id}" name="basket_form[product_id]"/>
						<input type="hidden" value="{$actual_price}" name="basket_form[price]"/>
												
	                    <span style="font-size: 11px;">Ilość:</span> 
	                   
	                    <input name="basket_form[qty]" id="ilosc" type="text"/> <br>
	                    
	                    
	                    {if $BasketEmail && !$user_data.email}
	                    <span style=" display: block; font-size: 11px; padding: 5px 15px 15px 0;">{$BasketEmail}<img style="padding-left: 5px; cursor: pointer;" onclick="window.location='{$DP}koszyk/DeleteBasketEmail'" src="{$DP}images/html/del_email.jpg" alt="Wyloguj adres email z koszyka"></span> 
	                    <input type="hidden" name="basket_form[BasketEmail]" value="{$BasketEmail}" >
	                    {elseif $user_data.email}
	                    <span style=" display: block; font-size: 11px; padding: 5px 15px 15px 0;">{$user_data.email}</span> 
	                    <input type="hidden" name="basket_form[BasketEmail]" value="{$user_data.email}" >	                    
	                    {else}
	                    <span style="font-size: 11px;">Adres e-mail:</span> 
	                    <input name="basket_form[BasketEmail]" id="ilosc" type="text" id="basket_form[BasketEmail]" class="reqiured" /> 
	                    {/if}
	                    <a onclick="$(this).closest('form').submit()">Dodaj do koszyka</a>
	                    </fieldset>
	                  </form>  		

	                
	                  
	            </div>
	            {/if}
	            {if $products_related}
    			{include file="panel_related.tpl"}
    			{/if}
	            <div class="detailsLike">
	            

						<div id="fb-root"></div><script src="http://connect.facebook.net/pl_PL/all.js#appId=213809702007823&amp;xfbml=1"></script><fb:like href="{$DP}pozycja/{$product_details.url_name}/" width="350" show_faces="true" action="recommend" font=""></fb:like>
						{literal}
						<!-- Umieść ten tag w sekcji head lub bezpośrednio przed zamknięciem tagu body. -->
						<script type="text/javascript" src="http://apis.google.com/js/plusone.js">
						  {lang: 'pl'}
						</script>
						<!-- Umieść ten tag w miejscu, gdzie ma pojawić się przycisk +1 -->
						<g:plusone size="medium"></g:plusone>			
						{/literal}		
            
	            
	            
	            </div>
		</div>
		        
    </div>
    {if $product_details.service ne 1}
   <ul class="tabs2">
					<li><a href="#">Opis</a></li>
					{if $product_details.content2|count_characters gt 5}
					<li><a href="#">Specyfikacja</a></li>
					{/if}
	</ul>
	{/if}
	<div class="panes2">
			<div>
				{$product_details.abstract}<br><br>
				{$product_details.content}
			</div>
			{if $product_details.content2|count_characters gt 5}
			<div>
				{$product_details.content2}
				</div>
			{/if}
	</div>
	{include file="panel_other_from_category.tpl"}

			 
</article>	

{literal}
<script type="text/javascript">
$(document).ready(function(){


	$("ul.thumb li a").click(function() {
		
		var mainImage = $(this).attr("href"); //Find Image Name
		$("#main_view img.pic").attr({ src: mainImage });
		$("#main_a").attr({ href: mainImage });
		return false;		
	});
	
	$("ul.tabs2").tabs(".panes2 > div", {history: true, effect: 'fade'});
 
});
</script>
{/literal}