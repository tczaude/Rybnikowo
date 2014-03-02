{literal}

<script type="text/javascript">


$().ready(function() {

	
	// validate signup form on keyup and submit
	$("#dispatchForm").validate({
		rules: {
			"dispatch[description]": {
				required: true
				
			},
			"dispatch[date]": {
				required: true
				
			}					
		},
		messages: {
			"dispatch[description]": {
				required: "Proszę podać nazwę"
			},
			"dispatch[date]": {
				required: "Proszę podać datę"
			}
			
		}
		
		

	});
});

</script>

{/literal}

