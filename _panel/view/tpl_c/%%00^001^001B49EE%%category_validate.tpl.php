<?php /* Smarty version 2.6.9, created on 2013-02-12 13:27:44
         compiled from category_validate.tpl */ ?>
<?php echo '

<script type="text/javascript">


$().ready(function() {

	
	// validate signup form on keyup and submit
	$("#signupForm").validate({
		rules: {
			"category[name]": {
				required: true,
				minlength: 3
				
			},
			"category[url_name]": {
				required: true,
				minlength: 3
			},
			"category[abstract]": {
				required: true,
				minlength: 1
			}
		},
		messages: {
			"category[name]": {
				required: "Proszę podać nazwę",
				minlength: "Nazwa musi mieć min 5 znków"
			},
			"category[url_name]": {
				required: "Proszę podać nazwę url",
				minlength: "Nazwa url musi mieć min 5 znaków"
			},
			"category[abstract]": {
				required: "Proszę podać opis",
				minlength: "Opis musi mieć min 35 znaków"
			}

		}
	});
});

</script>

'; ?>

