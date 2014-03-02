{literal}

<script type="text/javascript">


$().ready(function() {

	

	$("#signupForm").validate({


		rules: {

			"remind_form[email]": {
				required: true,
				email: true
			}
		},
		messages: {

			"remind_form[email]": {
				required: "Proszę podać adres e-mail",
				email: "Proszę podać poprawny adres e-mail"
			}
		}
	});

});

</script>
{/literal}

<h2>{$intro_main.title}</h2>

<div class="choose">
	
	<div class="contentLeft">
		<div class="register">
					
					<form method="post" id="signupForm">
						
						<p>			
							<label for="remind_form[email]">Adres e-mail:</label>
							<input type="hidden" name="action" value="SendPassword">
							<input id="name" name="remind_form[email]" type="text" class="required" value="{$ret_post.email}" >
						</p>
						<p><a class="button" onclick="$(this).closest('form').submit()"><i>Odzyskaj</i></a></p>
					</form>						
			</div>	
	</div>
	
	<div class="contentRight">
		
		
		{$intro_main.content}
				
		</div>
		
</div>