<article class="details">

		<h2>Koszyk {if $BasketEmail}<span style="font-size: 12px;">[{$BasketEmail}]<img style="padding-left: 5px; cursor: pointer;" onclick="window.location='{$DP}koszyk/DeleteBasketEmail'" src="{$DP}images/html/del_email.jpg" alt="Wyloguj adres email z koszyka"></span>{/if}</h2>


{include file="panel_progress.tpl}
		
		
	{if $basket.products}
	<form action="{$DP}koszyk" name="basket_form" method="post">
		<input type="hidden" value="CalculateBasket" name="action"/> 
		<table cellpadding="0" cellspacing="0" border="0" class="basketProd">
			<thead>
				<tr>
					<th colspan="2" class="bname">Produkt</th>
					<th class="bprice">Cena</th>
					<th class="bcount">Ilość</th>
					<th class="bvalue">Wartość</th>
					<th class="bdelete">Usuń</th>
				</tr>
			</thead>
		    <tbody>
		    		
		       {foreach from=$basket.products item=product_item}
		       <tr>
		       		
		       		 <td class="bpic" rowspan="2">
		       		 	<a href="{$DP}pozycja/{$product_item.url_name}" title="{$product_item.title}">
		       		 		<img height="100" src="{$DP}images/product/{$product_item.product_id}_02_01.jpg" alt="{$product_details.title}" title="{$product_details.title}" >
		       		 	</a>
		       		 </td>					    
				     <td class="bprice">&nbsp;</td>
				     <td class="bprice">{$product_item.price} zł</td>
					 <td class="bcount"><input name="products[{$product_item.product_id}]" value="{$product_item.quantity}"></td>  
						       
					 <td class="bvalue">{$product_item.value} zł</td>        	
					 <td class="bdelete">
		        		<a href="/koszyk/remove/{$product_item.product_id}" title="Usuń z listy zakupów">
	               			<img src="{$DP}images/html/close.png" alt="usuń">
	               		</a>
			   		  </td>
				      
				 </tr>
				 <tr class="bsec">
				 	<td colspan="5">
			       		<a href="{$DP}pozycja/{$product_item.url_name}" title="{$product_item.title}">	
			                   <strong> {$product_item.title}</strong>
						</a>
					 </td>  
				 </tr>
				  
				 {/foreach}
			 </tbody>
		</table>		 
			
		<div class="bButtons">
			<a class="button" href="{$DP}koszyk/clear"><i>usuń wszystko</i></a>
			<a class="button" onclick="$(this).closest('form').submit()"><i>przelicz</i></a>						
		</div>
	</form>
				
	<h2>Sposób zapłaty i przesyłki</h2> 
		        
		        <div class="b-kg">Przybliżona waga paczki: {$basket.basket_weight} kg</div>
		        
		       	<form method="post">
		       	<input type="hidden" name="action" value="SetDelivery">
		       	<div class="deliver">
			       	<div class="deli">
			       		<h3>Kurier:</h3>
			       		<ul>
					       	<li>
					       		<input name="transport" {if $DeliveryType eq 1} checked="checked"{/if} value="1" onclick="window.location='{$DP}basket/transport/' + this.value;" type="radio"> wpłata na konto
					       	</li>
					       	{*
							<li>
								<input name="transport" {if $DeliveryType eq 2} checked="checked"{/if} value="2" onclick="window.location='{$DP}basket/transport/' + this.value;" type="radio"> płatnośc online
							</li>
							*}
							<li>
								<input name="transport" {if $DeliveryType eq 3} checked="checked"{/if} value="3" onclick="window.location='{$DP}basket/transport/' + this.value;" type="radio"> za pobraniem
							</li>	
						</ul>	
					</div>	
			       	<div class="deli">
			       		<h3>Odbiór osobisty:</h3>
						<ul>
							<li>
								<input name="transport" {if $DeliveryType eq 7} checked="checked"{/if} value="7" onclick="window.location='{$DP}basket/transport/' + this.value;" type="radio"> płatność przy odbiorze
					        </li>
						</ul>		       	
					</div>
				</div>	
				
				</form> 
				<h2>{$intro_main.title}</h2> 		
				<div class="choose">
					
					<div class="contentLeft" style="width: 230px; padding-top: 20px;">
						<div>
							{if !$GetDiscount}
							<form method="post">

							<p>
									<input type="hidden" name="action" value="GetVoucher">
									<label for="voucher_code">Wpisz kod rabatowy</label>
					     			<input type="text" id="voucher_code" name="voucher_code" style="display: block;">								
									<a class="button" onclick="$(this).closest('form').submit()"><i>Wyślij</i></a>		
							</p>
							{else}
							<p><a class="button" href="{$DP}koszyk/DeleteVoucher"><i>Usuń kod</i></a></p>
							<div class="clear"></div><br>
							<p>Udzielono rabatu: <span><strong>{$basket.basket_discount_amount}</strong> zł ({$basket.discount}%)</span></p>
							<p>Wartość przed rabatem: <span><strong>{$basket.basket_before_value}</strong> zł</span></p>
							{/if}
					
							</form>
				
						</div>	
					</div>
					
					<div class="contentRight" style="padding-top: 15px; width: 280px; float: left;">{$intro_main.content}</div>
						
				</div>		
			    <h2>Podsumowanie</h2>
			      	
			    
			
			    <div class="summary" style="padding-left: 35px;">                 	
			      	{if $GetDiscount}
			    	<p>                        	
			            <strong>Udzielono rabatu:</strong>	<span> {$basket.basket_before_value} zł - {$basket.discount}% = {$basket.basket_value} zł</span>
			      	</p>	      	
			      	{/if}                    
                    <p>
                    	<label id="bfvalue">Wartość zamówienia:</label>	<span>{$basket.basket_value} zł</span>
                	</p>
                	<p>
	                	<label id="bfpay">Sposób zapłaty i przesyłki:</label> <span>{if $basket.delivery}{$basket.delivery}{else}0{/if} zł</span><br> 	
                		({if $DeliveryType eq 1}kurier - wpłata na konto{elseif $DeliveryType eq 2}kurier - płatnośc online{elseif $DeliveryType eq 3}kurier - pobranie{elseif $DeliveryType eq 7}odbiór własny - płatne przy odbiorze{/if})
              		</p>
                </div>
                    	
            	<div class="total">
				    <label id="btotal">DO ZAPŁATY:</label> <span>{$basket.total} zł</span>                	
			     </div>  
					
			 	 {else}
				 
				 <p style="padding-left: 30px;">Brak produktów w koszyku - zapraszamy na zakupy</p>
				
				 {/if}     
				 
			     <div class="basketButtons">
		     		<a href="javascript:history.back()" class="button"><i>wróc do zakupów</i></a>
		     		{if $basket.products}
		     		<a href="/zamowienie" class="bnForward button"><i>do kasy</i></a>
		     		{/if}
				
			     </div>
</article>
