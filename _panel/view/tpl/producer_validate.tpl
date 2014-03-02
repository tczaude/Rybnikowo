{literal}

<script type="text/javascript">


$().ready(function() {

	
	// validate signup form on keyup and submit
	$("#signupForm").validate({
		rules: {
			"producer[name]": {
				required: true,
				minlength: 3
				
			},
			"producer[url_name]": {
				required: true,
				minlength: 3
			},
			"producer[abstract]": {
				required: true,
				minlength: 1
			}
		},
		messages: {
			"producer[name]": {
				required: "Proszę podać nazwę",
				minlength: "Nazwa musi mieć min 5 znków"
			},
			"producer[url_name]": {
				required: "Proszę podać nazwę url",
				minlength: "Nazwa url musi mieć min 5 znaków"
			},
			"producer[abstract]": {
				required: "Proszę podać opis",
				minlength: "Opis musi mieć min 35 znaków"
			}

		}
	});
});

</script>

{/literal}

