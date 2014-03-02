{literal}

<script type="text/javascript">


$().ready(function() {

	

	$("#signupForm").validate({


		rules: {
			"register_form[name]": {
				required: true,
				minlength: 2
			},
			"register_form[surname]": {
				required: true,
				minlength: 2
			},
			"register_form[password]": {
				required: true,
				minlength: 5
			},
			"register_form[confirm_password]": {
				required: true,
				minlength: 5,
				equalTo: "#passr"
			},
			"register_form[email]": {
				required: true,
				email: true
				{/literal}
				{if $error.email},
				noequalTo: {$ret_post.email}
				{/if}
				{literal}
			},
			"register_form[phone]": {
				required: true
			},
			"register_form[zipcode]": {
				required: true,
				zipcode: true
			},
			"register_form[street]": {
				required: true
			},
			"register_form[city]": {
				required: true
			},
			"register_form[regulamin]": {
				required: true
			}
		},
		messages: {
			"register_form[name]": {
				required: "Proszę podać swoje imię",
				minlength: "Nazwisko musi mieć min 2 znaki"
			},
			"register_form[surname]": {
				required: "Proszę podać swoje nazwisko",
				minlength: "Nazwisko musi mieć min 2 znaki"
			},
			"register_form[password]": {
				required: "Proszę podać hasło",
				minlength: "Hasło musi mieć min 5 znaków"
			},
			"register_form[confirm_password]": {
				required: "Proszę powtórzyć hasło",
				minlength: "Hasło musi mieć min 5 znaków",
				equalTo: "Podane hasła nie są identyczne"
			},
			"register_form[email]": {
				required: "Proszę podać adres e-mail",
				email: "Proszę podać poprawny adres e-mail",
				noequalTo: "Podnay adres już jest zarejestrowany"
			},
			
			"register_form[phone]": "Proszę podać numer telefonu",
			"register_form[street]": "Proszę podać adres",
			"register_form[city]": "Proszę podać miejscowość",
			"register_form[zipcode]": "Proszę podać poprawny kod",
			"register_form[regulamin]": "Proszę zaakceptować regulamin"
		}
	});


});
</script>
{/literal}

<h2>Załóż konto</h2>

<div class="choose">
	
	<div class="contentLeft">
		<div class="register">
					
					<form class="cmxform" method="post" id="signupForm">
				
					<input type="hidden" value="RegisterUser" name="action" />
					<h4>Dane klienta</h4>
					
					<p>
							<label for="register_form[name]">Imię:</label>
							<input name="register_form[name]" id="register_form[name]" type="text" class="required" value="{$ret_post.name}" >
						
					</p>
					<p>
						
							<label for="register_form[surname]">Nazwisko:</label>
					
							<input name="register_form[surname]" id="register_form[surname]" class="reqiured" type="text" value="{$ret_post.surname}" >
					
					</p>
					<p>
							<label for="passr">Hasło:</label>
							<input name="register_form[password]" id="passr" class="required password" value="" type="password" >
					</p>
					<p>
							<label for="register_form[confirm_password]">Powtórz hasła:</label>
							<input name="register_form[confirm_password]" id="register_form[confirm_password]" type="password" >
					</p>
					<p>
							<label for="register_form[email]">Adres e-mail:</label>
				
							<input name="register_form[email]" id="register_form[email]" class="required" type="text" value="{$ret_post.email}">
							{if $error.email}<br><span style="color: red; font-size: 8px;">{$error.email}</span>{/if}
					</p>
					<p>
							<label for="register_form[phone]">Telefon:</label>
							<input name="register_form[phone]" id="register_form[phone]" class="reuired phone" type="text" value="{$ret_post.phone}" >
					</p>
				
					<h4>Dane do faktury</h4>
					
					<p>
							<label for="register_form[company]">Firma:</label>
							<input name="register_form[company]" id="register_form[company]" class="reqired company" type="text" value="{$ret_post.company}" >
					</p>
					<p>
							<label for="register_form[nip]">Nip:</label>
							<input name="register_form[nip]" id="register_form[nip]" type="text" value="{$ret_post.nip}">
					</p>
					<p>
							<label for="register_form[street]">Adres:</label>
							<input name="register_form[street]" id="register_form[street]" class="required street" type="text" value="{$ret_post.street}" >
					</p>
					<p>
							<label for="register_form[zipcode]">Kod pocztowy:</label>
							<input name="register_form[zipcode]" id="register_form[zipcode]" class="required zipcode" type="text" value="{$ret_post.zipcode}">					</p>
					<p>
							<label for="register_form[city]">Miejscowość:</label>
							<input name="register_form[city]" id="register_form[city]" class="required city" type="text" value="{$ret_post.city}" >
					</p>
				
					<h4>Regulamin:</h4>
					
					<div class="registerReg" style="text-align: left;">						
						{$intro_left.content} 
					</div>
					<p class="pReg">
						<label for="register_form[regulamin]">Akceptuję regulamin:</label>
						<input {if $ret_post.regulamin eq 2}checked="checked"{/if} name="register_form[regulamin]" id="register_form[regulamin]" class="required regulamin" type="checkbox" value="2">				
					</p>
					
					<p>
						<a class="button" onclick="$(this).closest('form').submit()"><i>Zarejestruj</i></a>
					</p>
					
			
				</form>

			</div>	
	</div>
	
	<div class="contentRight">
		
		
		{$intro_main.content}
				
		</div>
		
</div>