{literal}

<script type="text/javascript">


$().ready(function() {

	
	// validate signup form on keyup and submit
	$("#deliveryForm").validate({
		rules: {
			"delivery_form[name]": {
				required: true,
				minlength: 5
			},
			"delivery_form[range_from]": {
				required: true,
				price: true
			},
			"delivery_form[range_to]": {
				required: true,
				price: true
			},
			"delivery_form[price]": {
				required: true,
				price: true
			}					
		},
		messages: {
			"delivery_form[name]": {
				required: "Proszę podać nazwę"
			},
			"delivery_form[range_from]": {
				required: "Proszę podać wartość początkową",
				price: "Proszę podać poprawną wartość rozdzieloną KROPKĄ"
			},
			"delivery_form[range_to]": {
				required: "Proszę podać wartość końcową",
				price: "Proszę podać poprawną wartość rozdzieloną KROPKĄ"
			},
			"delivery_form[price]": {
				required: "Proszę podać cenę usługi",
				price: "Proszę podać poprawną cenę rozdzieloną KROPKĄ"
			}
			
		}
		
		

	});
});

</script>

{/literal}

