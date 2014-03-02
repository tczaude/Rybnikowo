{literal}

<script type="text/javascript">


$().ready(function() {

	$("#login-form2").validate({
		rules: {
			login: {
				required: true
			},
			password: {
				required: true
			}
		},
		messages: {
			login: {
				required: "Proszę podać swój login"
			},
			password: {
				required: "Proszę podać swoje hasło"
			}
		}
	});


});
</script>
{/literal}

<h2>Witam ponownie. Zaloguj się, aby kontynuować zakupy</h2>

<div class="choose">
	
	<div class="contentLeft">
		<div class="register">
					
					<form method="post" id="login-form2">
						<input type="hidden" name="action" value="LoginUser">
						
						<p>			
							<label for="login">Adres e-mail:</label>
							<input name="login" id="login" title="login" type="text" {if $BasketEmail}value="{$BasketEmail}"{/if}>
						</p>
						<p>
							<label for="password">Hasło:</label>
							<input name="password" id="password" title="password" type="password"> 
						</p>
						<p><a class="button" onclick="$(this).closest('form').submit()"><i>Zaloguj</i></a></p>
					</form>						
					
					<p><a href="{$DP}odzyskaj-haslo">Zapomniałeś hasła?</a></p>

			</div>	
	</div>
	
	<div class="contentRight">
		
		
		{$intro_main.content}
				
		</div>
		
</div>