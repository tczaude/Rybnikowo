{literal}
<script type="text/javascript">
$().ready(function() {
	$("#contact-form").validate({
		rules: {
			"contact_form[name]": {
				required: true
			},
			"contact_form[email]": {
				required: true,
				email: true
			},
			"contact_form[content]": {
				required: true
			},
			"contact_form[code]": {
				required: true,
				minlength: 5
			}
		},
		messages: {
			"contact_form[name]": {
				required: "Proszę podać swoje imię"
			},
			"contact_form[email]": {
				required: "Proszę podać adres e-mail",
				email: "Proszę podać poprawny adres e-mail"
			},
			"contact_form[content]": {
				required: "Proszę wpisać wiadomość"
			},
			"contact_form[code]": {
				required: "Proszę podać kod z obrazka",
				minlength: "Kod powinien zawierać 5 znaków"
			}
		}
	});

});
</script>
{/literal}
<section class="company-content" style="border-top: 0;">
		
		<div class="company-details">
			
			<h2>{$intro_main.title}</h2>
			<div class="menu">
				<div id="1" class="map" style="border-top: 0;">

					<div class="desc">{$intro_main.content}</div>
				</div>
			</div>
			<div class="menu">
				<div id="1" class="map">
					<h4>Formularz kontaktowy</h4>
					<div class="desc">
					
						<div class="contact">
						
							{if $error}
							<p style="color: red;">Popraw błędy</p>
							{/if}	
							{if $good_message}
							<p style="color: green;">Dziękujemy, wiadomość wysłana.</p>
							{/if}	
							<form method="post" id="contact-form">
							<input type="hidden" name="action" value="SaveContact">
				
								<p>
									<label for="name">Adres e-mail</label>
									<input {if $error.email}style="border: 1px solid red;"{/if} name="contact_form[email]" title="email" type="text" value="{$ret_post.email}" > 
									{if $error.email}<label class="error">{$error.email}</label>{/if}
								</p>
								<p>
									<label for="name">Numer telefonu</label>
									<input {if $error.phone}style="border: 1px solid red;"{/if} name="contact_form[phone]" title="telefon" type="text" value="{$ret_post.phone}" > 
									{if $error.phone}<label class="error">{$error.phone}</label>{/if}
								</p>
								
								<p>
									<label for="text">Wiadomość</label>
									<textarea {if $error.content}style="border: 1px solid red;"{/if} name="contact_form[content]" title="Wiadomość" type="text" rows="5" cols="38">{$ret_post.content}</textarea>
									{if $error.content}<label class="error">{$error.content}</label>{/if}
								</p>
								<p><img src="{$DP}captcha" class="captcha"></p>
								<p>
									<label for="name">Kod</label>
										
									<input {if $error.code}style="border: 1px solid red;"{/if} name="contact_form[code]" class="captchaInput" title="kod" type="text" value=""> 
									{if $error.code}
									<label for="contact_form[code]" class="error">{$dict_templates.ContactErrorCaptcha}</label>
									{/if}
								</p>	
								<p>
									<button type="submit" class="bnSend"></button>
								</p>
							
							</form>							
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						</div>
			
		
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					</div>
				</div>
			</div>

			
		</div>
		
		<ul class="company-list">
			{foreach from=$menu_categories item=menu name=menu}
			<li style="font: 12px/24px Arial,Verdana,sans-serif;"><a href="{$DP}kategoria/{$menu.url_name}">{$menu.name} <i>>></i></a></li>
			{/foreach}
	
		</ul>

	</section>
