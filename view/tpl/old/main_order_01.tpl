


{include file="panel_progress.tpl}

<h2>Twoje Dane</h2>

<form class="cmxform" method="post" id="signupForm" name="order_form">
<input type="hidden" value="SaveStep_01" name="action">		
<input type="hidden" value="{$DeliveryType}" name="order_form[delivery]">		

<div class="orderData">		
			
	<div class="contentLeft">	
		
		
			   
				<p>
					<strong>Imię:</strong> {$user_data.name}
				</p>
				<p>	
					<strong>Nazwisko:</strong> {$user_data.surname}
				</p>
				<p>	
					<strong>E-mail:</strong> {$user_data.email}
				</p>
				<p>	
					<strong>Firma:</strong> {$user_data.company}
				</p>
				<p>	
					<strong>Nip:</strong> {$user_data.nip}
				</p>
				<p>	
					<strong>Adres:</strong> {$user_data.street}
				</p>
				<p>	
					<strong>Kod pocztowy:</strong> {$user_data.zipcode}
				</p>
				<p>	
					<strong>Miejscowość:</strong> {$user_data.city}
				</p>
				<p>	
					<strong class="moreInfo">Informacja dodatkowa:</strong> <textarea name="order_form[description]"></textarea>
				</p>
				
				<a href="{$DP}konto" class="button bnChangeData"><i>zmień dane</i></a>
				<p class="ocheck">
					<label for="invoice">Zmień adres dostawy:</label>
					<input {if $retry.adress1 eq 2}checked="selected"{/if} class="newadress" id="invoice" type="checkbox" value="2" name="order_form[adress1]"  onclick="showDelivery();"/>
				</p>			
				<div id="orderAdressChange" {if $retry.adress1 ne 2}style="display:none;"{/if}>
				
					<h3>Adres dostawy</h3>
					<p>
							<label for="name">Imię:</label>
						
							<input id="name" name="order_form[name]" type="text" value="{$retry.name}" />
					</p>
					<p>
						
							<label for="surname">Nazwisko:<span class="required">*</span></label>
						
							<input id="surname" name="order_form[surname]" type="text" value="{$retry.surname}" />
					</p>	
					<p>
						
							<label for="company">Firma:</label>
							<input id="company" name="order_form[company]" type="text" value="{$retry.company}" />
					</p>	
					<p>
						
							<label for="street">Adres:<span class="required">*</span></label>
							<input id="street" name="order_form[street]" type="text" value="{$retry.street}" />
					</p>
					<p>
							<label for="zipcode">Kod pocztowy:<span class="required">*</span></label>
							<input id="zipcode" name="order_form[zipcode]" type="text" value="{$retry.zipcode}" />
						
					</p>
					<p>
						
							<label for="city">Miejscowość:<span class="required">*</span></label>
							<input id="city" name="order_form[city]" type="text" value="{$retry.city}">
					</p>		
				</div>
					
				<p class="ocheck">
					<label for="invoic2">Faktura VAT:</label>
					<input id="invoice2" name="order_form[invoice]" {if $retry.invoice eq 1}checked="checked"{/if} type="checkbox" value="1" />
				</p>
	
				{if $DeliveryType eq 2 || $DeliveryType eq 5 || $DeliveryType eq 9}
			
					<label for="city">Zapłać z:</label>
				
	               	<select name="order_form[payment]">
	               		{foreach from=$dict_templates.payment_type item=payment key=type}
	               		<option value="{$type}" {if $PaymentId eq $type}selected{/if}>{$payment}</option>
	               		{/foreach}
	               	</select>
						
				{/if}
		
	</div>

	<div class="contentRight2">
		{*$intro_main.content*} 
		<p>Jeśli dane Twojego zamówienia są prawidłowe, kliknij przycisk dalej.</p>
	
		<p>Jeśli chcesz zmienić adres dostawy, zaznacz odpowiednie pole i wpisz poprawny adres.</p>
	</div>	
</div>	
		
<div class="basketButtons">
		<a href="{$DP}koszyk" class="button"><i>wróć</i></a>
		<a style="padding-left: 320px;" onclick="$(this).closest('form').submit()" class="button"><i>dalej</i></a>
		
</div>
		
		
	
</form>
{literal}

<script type="text/javascript">

$().ready(function() {

	$("#signupForm").validate({

		rules: {
			"order_form[name]": {
				required: true,
				minlength: 2
			},
			"order_form[surname]": {
				required: true,
				minlength: 2
			},
			"order_form[zipcode]": {
				required: true,
				zipcode: true
			},
			"order_form[street]": {
				required: true
			},
			"order_form[city]": {
				required: true
			},
			"order_form[payment]": {
				required: true
			}
		},
		messages: {
			"order_form[name]": {
				required: "Wymagane",
				minlength: "Wymagane min 2 znaki"
			},
			"order_form[surname]": {
				required: "Wymagane",
				minlength: "Wymagane min 2 znaki"
			},
			"order_form[payment]": {
				required: "Proszę wybrac forme płatnośći"
				
			},
			"order_form[street]": "Wymagane",
			"order_form[city]": "Wymagane",
			"order_form[zipcode]": "Wymagane np: 44200 lub 44-200"
		}
	});

	//code to hide topic selection, disable for demo
	var newsletter = $(".newadress");
	// newsletter topics are optional, hide at first
	var inital = newsletter.is(":checked");
	var topics = $("#orderAdressChange")[inital ? "removeClass" : "addClass"]("gray");
	var topicInputs = topics.find("input").attr("disabled", !inital);
	// show when newsletter is checked
	newsletter.click(function() {
		topics[this.checked ? "removeClass" : "addClass"]("gray");
		topicInputs.attr("disabled", !this.checked);
	});


});

</script>



{/literal}