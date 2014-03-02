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

<h2>Formularz kontaktowy</h2>
	
	<section class="contact">	
		<div class="contentLeft">
				
			<div class="contactForm">	
				<form method="post" id="contact-form">
				<input type="hidden" name="action" value="SaveContact">
				<p>
					
					<label for="name">Imię:</label>
					<input name="contact_form[name]" title="name" id="name" type="text" value="{$ret_post.name}" > 
					
				</p>
				<p>
					<label for="mail">E-mail:</label>
					<input name="contact_form[email]" id="mail" title="email" type="text" value="{$ret_post.email}" > 
					
				</p>
				<p>
					<label for="tel">Telefon:</label>
					<input name="contact_form[phone]" id="tel" title="telefon" type="text" value="{$ret_post.phone}" > 
					
				</p>
				
				<p>
					<label class="cont" for="text">Wiadomość:</label>
					<textarea name="contact_form[content]" id="text" title="Wiadomość" type="text">{$ret_post.content}</textarea>
					
				</p>
				<p><br><img src="{$DP}captcha" class="captcha"></p>
				<p>
					<label for="code">Kod z obrazka:</label>
						
					<input name="contact_form[code]" id="code" class="captchaInput" title="kod" type="text" value=""> 
					{if $error.code}
					<label generated="true" class="error">{$dict_templates.ContactErrorCaptcha}</label>
					{/if}
				</p>	
				<p>
					<a onclick="$(this).closest('form').submit()" class="button"><i>Wyślij</i></a>
				</p>
				</form>
		
			</div>
		</div>
		<div class="contentRight">
		
			{$intro_main.content}
		</div>
	</section>	
	
	
	
	
		
	