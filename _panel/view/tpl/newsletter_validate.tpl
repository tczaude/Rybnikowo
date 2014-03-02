{literal}

<script type="text/javascript">


$().ready(function() {

	
	// validate signup form on keyup and submit
	$("#newsletterForm").validate({
		rules: {
			"newsletter_form[name]": {
				required: true,
				minlength: 5
				
			}			
		},
		messages: {
			"newsletter_form[name]": {
				required: "Proszę podać nazwę",
				minlength: "Nazwa musi mieć min 5 znków"
			}
			
		}
		
		

	});
});

</script>

{/literal}

