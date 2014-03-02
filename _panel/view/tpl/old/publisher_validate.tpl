{literal}

<script type="text/javascript">


$().ready(function() {

	
	// validate signup form on keyup and submit
	$("#signupForm").validate({
		rules: {
			"publisher[name]": {
				required: true,
				minlength: 3
				
			},
			"publisher[url_name]": {
				required: true,
				minlength: 3
			},
			"publisher[email]": {
				required: true,
				email: true
			},
			"publisher[abstract]": {
				required: true,
				minlength: 1
			}
		},
		messages: {
			"publisher[name]": {
				required: "Proszę podać nazwę",
				minlength: "Nazwa musi mieć min 5 znków"
			},
			"publisher[url_name]": {
				required: "Proszę podać nazwę url",
				minlength: "Nazwa url musi mieć min 5 znaków"
			},
			"publisher[email]": {
				required: "Proszę podać adres e-mail",
				email: "Proszę podać poprawny adres e-mail"
			},
			"publisher[abstract]": {
				required: "Proszę podać opis",
				minlength: "Opis musi mieć min 35 znaków"
			}

		}
	});
});

</script>

{/literal}

