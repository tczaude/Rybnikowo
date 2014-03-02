{literal}

<script type="text/javascript">


$().ready(function() {

	
	// validate signup form on keyup and submit
	$("#slideshowForm").validate({
		rules: {
			"slideshow_form[title]": {
				required: true
				
			},
			"slideshow_form[abstract]": {
				required: true
			}			
		},
		messages: {
			"slideshow_form[title]": {
				required: "Proszę podać nazwę"
			},
			"slideshow_form[abstract]": {
				required: "Proszę podać link"
			}
			
		}
		
		

	});
});

</script>

{/literal}

