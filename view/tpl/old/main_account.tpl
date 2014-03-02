{literal}

<script type="text/javascript">


$().ready(function() {

	$("#signupForm").validate({
		rules: {
			"update_form[name]": {
				minlength: 2
			},
			"update_form[surname]": {
				required: true,
				minlength: 2
			},
			"update_form[password]": {
				required: true,
				minlength: 5
			},
			"update_form[confirm_password]": {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},
			"update_form[email]": {
				required: true,
				email: true{/literal}{if $error.email},
				noequalTo: "{$ret_post.email}"{/if}{literal}
			},
			"update_form[phone]": {
				required: true,
			},
			"update_form[zipcode]": {
				required: true,
				zipcode: true
			},
			"update_form[street]": {
				required: true,
			},
			"update_form[city]": {
				required: true,
			},
			topic: {
				required: "#newsletter:checked",
				minlength: 2
			},
			agree: "required"
		},
		messages: {
			"update_form[name]": {
				required: "Proszę podać swoje imię",
				minlength: "Nazwisko musi mieć min 2 znaki"
			},
			"update_form[surname]": {
				required: "Proszę podać swoje nazwisko",
				minlength: "Nazwisko musi mieć min 2 znaki"
			},
			"update_form[password]": {
				required: "Proszę podać hasło",
				minlength: "Hasło musi mieć min 5 znaków"
			},
			"update_form[confirm_password]": {
				required: "Proszę powtórzyć hasło",
				minlength: "Hasło musi mieć min 5 znaków",
				equalTo: "Podane hasła nie są identyczne"
			},
			"update_form[email]": {
				required: "Proszę podać adres e-mail",
				email: "Proszę podać poprawny adres e-mail",
				noequalTo: "Podnay adres już jest zarejestrowany",
			},
			
			"update_form[phone]": "Proszę podać numer telefonu",
			"update_form[street]": "Proszę podać adres",
			"update_form[city]": "Proszę podać miejscowość",
			"update_form[zipcode]": "Proszę podać poprawny kod pocztowy np: 44200 lub 44-200",
			"update_form[agree]": "Please accept our policy"
		}
	});
});

</script>



{/literal}

	

	
	
	<h3>Konto użytkownika: {$user_data.name} {$user_data.surname}</h3>
	{if $ImportUserMessage}
	<h4 style="color: red; padding: 0 0 0 37px;">{$ImportUserMessage}</h4>
	{/if}
		    
	    
		<div class="contentLeft">
			<div class="account">		

				<form class="cmxform" method="post" id="signupForm">						
				<input type="hidden" value="UpdateUser" name="action" />
				<input type="hidden" name="update_form[id]" value="{$user_data.id}">
				<input type="hidden" name="update_form[email_old]" value="{$user_data.email}">
				
				<h4>Twoje Dane:</h4>
				
				<p>
						<label for="name">Imię</label>				
						<input id="name" name="update_form[name]" type="text" class="required" value="{$user_data.name}">
				</p>
				<p>
						<label for="surname">Nazwisko</label>
						<input id="surname" name="update_form[surname]" class="reqiured" type="text" value="{$user_data.surname}">
				</p>
				<p>
						<label for="password">Hasło</label>
						<input id="password" name="update_form[password]" value="{$user_data.password}" class="required password" type="password">
				</p>	
				<p>	
						<label for="confirm_password">Ponów hasło</label>
						<input id="confirm_password" name="update_form[confirm_password]" class="required confirm_password" type="password">
				</p>
				<p>
					<label for="email">Adres e-mail</label>
					<input id="email" name="update_form[email]" class="required email" type="text" value="{$user_data.email}" style="{if $error.email}border: 2px dotted #AA2404;{/if}">
				</p>
				<p>
					<label for="phone">Telefon</label>
					<input id="phone" name="update_form[phone]" class="reuired phone" type="text" value="{$user_data.phone}">
				</p>
				
				<h4>Dane do faktury:</h4>
				<p>
					<label for="company">Firma:</label>
					<input id="company" name="update_form[company]" class="reqired company" type="text" value="{$user_data.company}">
				</p>
				<p>
					<label for="nip">Nip:</label>
					<input id="nip" name="update_form[nip]" type="text" value="{$user_data.nip}">
				</p>
				<p>
					<label for="street">Adres</label>
					<input id="street" name="update_form[street]" class="required street" type="text" value="{$user_data.street}">
				</p>
				<p>
					<label for="zipcode">Kod pocztowy</label>
					<input id="zipcode" name="update_form[zipcode]" class="required zipcode" type="text" value="{$user_data.zipcode}">
				</p>
				<p>
					<label for="city">Miejscowość</label>
					<input id="city" name="update_form[city]" class="required city" type="text" value="{$user_data.city}">
				</p>
				<p>
					<label for="city">Newsletter:</label>
					<input id="adress" name="update_form[newsletter]" type="checkbox" value="1" {if $user_data.newsletter eq 1}checked="checked"{/if}>
				</p>
				
		
				<a class="button" onclick="$(this).closest('form').submit()"><i>Wyślij</i></a>
			
				</form>
		  	
		  	</div>
	   	</div>
		<div class="contentRight">
			<p>{$intro_main.content}</p>
		</div>

