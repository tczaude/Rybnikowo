<?php /* Smarty version 2.6.9, created on 2013-02-13 21:55:06
         compiled from baner_validate.tpl */ ?>
<?php echo '

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

'; ?>

