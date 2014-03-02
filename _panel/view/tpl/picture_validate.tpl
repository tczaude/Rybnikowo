{*

<script type="text/javascript">


$().ready(function() {

	
	// validate signup form on keyup and submit
	$("#pictureForm").validate({
		rules: {
			"picture_form[title]": {
				required: true,
				minlength: 5
				
			},
			"picture_form[abstract]": {
				required: true,
				minlength: 35
			}			
		},
		messages: {
			"picture_form[title]": {
				required: "Proszę podać nazwę",
				minlength: "Nazwa musi mieć min 5 znków"
			},
			"picture_form[abstract]": {
				required: "Proszę podać opis",
				minlength: "Opis musi mieć min 35 znaków"
			}
			
		}
		
		

	});
});

</script>

*}

