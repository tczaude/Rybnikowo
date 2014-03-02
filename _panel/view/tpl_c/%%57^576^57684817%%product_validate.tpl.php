<?php /* Smarty version 2.6.9, created on 2013-03-29 14:32:24
         compiled from product_validate.tpl */ ?>
<?php echo '

<script type="text/javascript">


$().ready(function() {

	
	// validate signup form on keyup and submit
	$("#productForm").validate({
		rules: {
			"product_form[title]": {
				required: true
			},
			"product_form[url_name]": {
				required: true	
			},
			"product_form[type_id]": {
				required: true
			},
			"product_form[compare]": {
				required: true
			},
			"product_form[price]": {
				required: true,
				price: true
			},
			"product_form[delivery_cost]": {
				required: true,
				price: true
			},
			"product_form[weight]": {
				required: true,
				price: true
			},
			"product_form[category_id]": {
				required: true
			},
			"product_form[kind_id]": {
				required: true
			},
			"product_form[color]": {
				required: true
			},
			"product_form[abstract]": {
				required: true,
				minlength: 35
			},
			"product_form[available]": {
				required: true
			},
			"product_form[type]": {
				required: true
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
			"product_form[type_id]": {
				required: "Proszę wybrać cechę"
			},
			"product_form[compare]": {
				required: "Proszę wybrać kategorię CENEO / NOKAUT"
			},
			"product_form[price]": {
				required: "Proszę podać cenę",
				price: "Proszę podać poprawną ceną rozdzieloną KROPKĄ"
			},
			"product_form[delivery_cost]": {
				required: "Proszę podać cenę",
				price: "Proszę podać poprawną ceną rozdzieloną KROPKĄ"
			},
			"product_form[weight]": {
				required: "Proszę podać wagę",
				price: "Proszę podać poprawną wagę rozdzieloną KROPKĄ"
			},
			"product_form[category_id]": {
				required: "Proszę wybrać kategorię wg producenta"
			},
			"product_form[kind_id]": {
				required: "Proszę wybrać kategorię wg typu"
			},
			"product_form[color]": {
				required: "Proszę wybrać kolor"
			},
			"product_form[abstract]": {
				required: "Proszę podać opis",
				minlength: "Opis musi mieć min 35 znaków"
			},
			"product_form[available]": {
				required: "Proszę podać dostępność"
			},
			"product_form[type]": {
				required: "Proszę podać typ"
			}
			
		}
		
		

	});
});

</script>

'; ?>

