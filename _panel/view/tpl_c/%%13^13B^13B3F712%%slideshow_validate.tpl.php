<?php /* Smarty version 2.6.9, created on 2013-02-18 15:34:11
         compiled from slideshow_validate.tpl */ ?>
<?php echo '

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

'; ?>

