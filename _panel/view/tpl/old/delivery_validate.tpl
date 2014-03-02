{literal}

<script type="text/javascript">


$().ready(function() {

	
	// validate signup form on keyup and submit
	$("#signupForm").validate({
		rules: {
			"delivery[name]": {
				required: true
				
			},
			"delivery[price]": {
				required: true,
				price: true
			},
			"delivery[range_from]": {
				required: true,
				price: true
			},
			"delivery[range_to]": {
				required: true,
				price: true
			}
		},
		messages: {
			"delivery[name]": {
				required: "Proszę podać nazwę"
			},
			"delivery[price]": {
				required: "Proszę podać cenę",
				price: "Proszę podać poprawną ceną rozdzieloną KROPKĄ"
			},
			"delivery[range_from]": {
				required: "Proszę podać zakres od",
				price: "Proszę podać poprawny zakres rozdzielony KROPKĄ"
			},
			"delivery[range_to]": {
				required: "Proszę podać zakres do",
				price: "Proszę podać poprawny zakres rozdzielony KROPKĄ"
			}

		}
	});
});

</script>

{/literal}

