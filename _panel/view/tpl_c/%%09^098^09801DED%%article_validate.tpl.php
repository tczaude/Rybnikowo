<?php /* Smarty version 2.6.9, created on 2013-02-13 21:47:50
         compiled from article_validate.tpl */ ?>
<?php echo '

<script type="text/javascript">


$().ready(function() {

	
	// validate signup form on keyup and submit
	$("#articleForm").validate({
		rules: {
			"article_form[title]": {
				required: true,
				minlength: 5
				
			},
			"article_form[url_name]": {
				required: true,
				minlength: 5
				
			},
			"article_form[abstract]": {
				required: true,
				minlength: 35
			}			
		},
		messages: {
			"article_form[title]": {
				required: "Proszę podać nazwę",
				minlength: "Nazwa musi mieć min 5 znków"
			},
			"article_form[url_name]": {
				required: "Proszę podać nazwę url",
				minlength: "Nazwa url musi mieć min 5 znków"
			},
			"article_form[abstract]": {
				required: "Proszę podać opis",
				minlength: "Opis musi mieć min 35 znaków"
			}
			
		}
		
		

	});
});

</script>

'; ?>

