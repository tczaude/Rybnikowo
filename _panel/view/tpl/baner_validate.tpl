{literal}

<script type="text/javascript">


$().ready(function() {

	
	// validate signup form on keyup and submit
	$("#banerForm").validate({
		rules: {
			"baner_form[title]": {
				required: true,
				minlength: 5
				
			},
			"baner_form[abstract]": {
				required: true,
				minlength: 35
			}			
		},
		messages: {
			"baner_form[title]": {
				required: "Proszę podać nazwę",
				minlength: "Nazwa musi mieć min 5 znków"
			},
			"baner_form[abstract]": {
				required: "Proszę podać opis",
				minlength: "Opis musi mieć min 35 znaków"
			}
			
		}
		
		

	});
});

</script>

{/literal}

