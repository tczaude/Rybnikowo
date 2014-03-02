{literal}

<script type="text/javascript">


$().ready(function() {

	
	// validate signup form on keyup and submit
	$("#productForm").validate({
		rules: {
			"product_form[title]": {
				required: true,
				minlength: 5
				
			},
			"product_form[url_name]": {
				required: true,
				minlength: 5
				
			},
			"product_form[price]": {
				required: true,
				price: true
			},
			"product_form[weight]": {
				required: true,
				price: true
			},
			"product_form[producer_id]": {
				required: true
			},
			"product_form[color]": {
				required: true
			},
			"product_form[abstract]": {
				required: true,
				minlength: 35
			}			
		},
		messages: {
			"product_form[title]": {
				required: "Proszę podać nazwę",
				minlength: "Nazwa musi mieć min 5 znków"
			},
			"product_form[url_name]": {
				required: "Proszę podać nazwę url",
				minlength: "Nazwa url musi mieć min 5 znków"
			},
			"product_form[price]": {
				required: "Proszę podać cenę",
				price: "Proszę podać poprawną ceną rozdzieloną KROPKĄ"
			},
			"product_form[weight]": {
				required: "Proszę podać wagę",
				price: "Proszę podać poprawną wagę rozdzieloną KROPKĄ"
			},
			"product_form[producer_id]": {
				required: "Proszę wybrać producenta"
			},
			"product_form[color]": {
				required: "Proszę wybrać kolor"
			},
			"product_form[abstract]": {
				required: "Proszę podać opis",
				minlength: "Opis musi mieć min 35 znaków"
			}
			
		}
		
		

	});
});

</script>

{/literal}

