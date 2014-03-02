<?php /* Smarty version 2.6.9, created on 2013-02-13 21:56:35
         compiled from blog_validate.tpl */ ?>
<?php echo '

<script type="text/javascript">


$().ready(function() {

	
	// validate signup form on keyup and submit
	$("#blogForm").validate({
		rules: {
			"blog_form[title]": {
				required: true,
				minlength: 5
				
			},
			"blog_form[url_name]": {
				required: true,
				minlength: 5
				
			},
			"blog_form[abstract]": {
				required: true,
				minlength: 35
			}			
		},
		messages: {
			"blog_form[title]": {
				required: "Proszę podać nazwę",
				minlength: "Nazwa musi mieć min 5 znków"
			},
			"blog_form[url_name]": {
				required: "Proszę podać nazwę url",
				minlength: "Nazwa url musi mieć min 5 znków"
			},
			"blog_form[abstract]": {
				required: "Proszę podać opis",
				minlength: "Opis musi mieć min 35 znaków"
			}
			
		}
		
		

	});
});

</script>

'; ?>

