{literal}

<script type="text/javascript">


$().ready(function() {

	
	// validate signup form on keyup and submit
	$("#signupForm").validate({
		rules: {
			"feature[name]": {
				required: true,
				minlength: 3
				
			},
			"feature[url_name]": {
				required: true,
				minlength: 3
			},
			"feature[abstract]": {
				required: true,
				minlength: 1
			}
		},
		messages: {
			"feature[name]": {
				required: "Proszę podać nazwę",
				minlength: "Nazwa musi mieć min 5 znków"
			},
			"feature[url_name]": {
				required: "Proszę podać nazwę url",
				minlength: "Nazwa url musi mieć min 5 znaków"
			},
			"feature[abstract]": {
				required: "Proszę podać opis",
				minlength: "Opis musi mieć min 35 znaków"
			}

		}
	});
});

</script>

{/literal}

