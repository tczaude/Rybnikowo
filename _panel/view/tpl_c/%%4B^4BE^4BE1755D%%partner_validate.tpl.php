<?php /* Smarty version 2.6.9, created on 2013-04-04 16:21:38
         compiled from partner_validate.tpl */ ?>
<?php echo '

<script type="text/javascript">


$().ready(function() {

	
	// validate signup form on keyup and submit
	$("#partnerForm").validate({
		rules: {
			"partner_form[title]": {
				required: true,
				minlength: 2
				
			},
			"partner_form[url_name]": {
				required: true,
				minlength: 2
				
			},
			"partner_form[abstract]": {
				required: true,
				minlength: 2
			}			
		},
		messages: {
			"partner_form[title]": {
				required: "Proszę podać nazwę",
				minlength: "Nazwa musi mieć min 5 znków"
			},
			"partner_form[url_name]": {
				required: "Proszę podać nazwę url",
				minlength: "Nazwa url musi mieć min 5 znków"
			},
			"partner_form[abstract]": {
				required: "Proszę podać opis",
				minlength: "Opis musi mieć min 35 znaków"
			}
			
		}
		
		

	});
});

</script>

'; ?>

