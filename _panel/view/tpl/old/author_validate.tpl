{literal}

<script type="text/javascript">


$().ready(function() {

	
	// validate signup form on keyup and submit
	$("#signupForm").validate({
		rules: {
			"author[name]": {
				required: true,
				minlength: 3
				
			},
			"author[url_name]": {
				required: true,
				minlength: 5
				
			},
			"author[account]": {
				required: true
				
			},
			"author[account_desc]": {
				required: true
				
			},
			"author[adress]": {
				required: true
				
			},
			"author[zipcode]": {
				required: true,
				zipcode: true
				
			},
			"author[city]": {
				required: true
				
			},
			"author[email]": {
				required: true,
				email: true
				
			}

		},
		messages: {
			"author[name]": {
				required: "Proszę podać nazwę",
				minlength: "Nazwa musi mieć min 5 znków"
			},
			"author[url_name]": {
				required: "Proszę podać nazwę url",
				minlength: "Nazwa url musi mieć min 5 znków"
			},
			"author[account]": {
				required: "Proszę podać numer rachunku bankowego"
			},
			"author[account_desc]": {
				required: "Proszę podać opis rachunku bankowego"
			},
			"author[adress]": {
				required: "Proszę podać adres"
			},
			"author[zipcode]": "Proszę podać poprawny kod pocztowy np: 44200 lub 44-200",
			"author[city]": "Proszę podać miejscowość",
			"author[email]": {
				required: "Proszę podać adres e-mail",
				email: "Proszę podać poprawny adres e-mail"
			}


		}
	});
});

</script>

{/literal}

