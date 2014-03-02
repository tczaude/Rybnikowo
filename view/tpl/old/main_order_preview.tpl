{include file="panel_progress.tpl}

		<h2>Podsumowanie zamówienia</h2>

		<div class="basketBilling">	
			<p>
				<span>Dane klienta:</span> {$user_data.name},	{$user_data.surname}, {if $user_data.company}{$user_data.company},{/if}
				{$user_data.street} {$user_data.zipcode}
				{$user_data.city}
			</p>
		
			<p>
				<span>Faktura VAT:</span> {if $order.invoice eq 1}TAK{else}NIE{/if}
			</p>
			<p>
			<p>
				<span>Adres dostawy:</span>
				{$order.name}
				{$order.surname}, {if
				$order.company}{$order.company},
				{/if}{$order.street} {$order.zipcode}
				{$order.city}
			</p>
			<p>
				<span>Sposób dostawy:</span>
				{if $DeliveryType eq 1}Kurier{elseif $DeliveryType eq 2}Kurier{elseif $DeliveryType eq 3}Kurier{elseif $DeliveryType eq 4}Poczta{elseif $DeliveryType eq 5}Poczta{elseif $DeliveryType eq 6}Poczta{elseif $DeliveryType eq 7}Odbiór własny{elseif $DeliveryType eq 8}List polecony{elseif $DeliveryType eq 9}List polecony{/if}</span> - {$basket.delivery} PLN </td>
			</p>
			<p>
				<span>Sposób płatności:</span>
				{if $DeliveryType eq 1}Wpłata na konto{elseif $DeliveryType eq 3}Pobranie{elseif $DeliveryType eq 4}Wpłata na konto{elseif $DeliveryType eq 6}Pobranie{elseif $DeliveryType eq 7}Płatne przy odbiorze{elseif $DeliveryType eq 8}Wpłata na konto{elseif $DeliveryType eq 9}Płatnośc online{/if}
			</p>
		</div>	
		
		<h2>Szczegóły zamówienia:</h2>
		
		

		<ol class="billingList">
			{foreach from=$order.details item=product name=products}
		
				<li><a href="{$DP}pozycja/{$product.url_name}">{$product.name}</a> <span>{$product.price} zł</span></li>
		
			{/foreach}
		</ol>
		
		<div class="billingSummary">
	      	{if $GetDiscount}
	    	<p>                        	
	            <strong>Udzielono rabatu:</strong>	<span> {$basket.basket_before_value} zł - {$basket.discount}% = {$order.value_pln} zł</span>
	      	</p>	      	
	      	{/if}
	    	<p>                        	
	            <strong>Zakupy brutto:</strong>	<span> {$order.value_pln} zł</span>
	      	</p>
	        <p>
	        	<strong>Koszt dostawy:</strong> <span> {$order.costs|string_format:"%.2f"} zł</span>
	        	
	        </p>  
	        <p>
	        	({if $DeliveryType eq 1}kurier - wpłata na konto{elseif $DeliveryType eq 2}kurier - płatnośc online{elseif $DeliveryType eq 3}kurier - pobranie{elseif $DeliveryType eq 7}odbiór własny - płatne przy odbiorze{/if})
	        </p>
        </div>    	
    	<div class="billingTotal">
		    Razem do zapłaty: <span>{$order.to_pay|string_format:"%.2f"} PLN</span>
	    </div>
		
		<div class="basketButtons">
				<a href="/" class="button"><i>powrót do sklepu</i></a>
				<a class="showCart button" href="/zamowienie"><i>wstecz</i></a> 
				<a class="finish button" href="/finish"><i>kupuję</i></a>
		</div>
		
		
	
	