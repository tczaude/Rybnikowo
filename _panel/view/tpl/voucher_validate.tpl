{literal}

<script type="text/javascript">


$().ready(function() {

	
	// validate signup form on keyup and submit
	$("#voucherForm").validate({
		rules: {
			"voucher_form[bonus_code]": {
				required: true
				
			},
			"voucher_form[again]": {
				required: true
				
			}		
		},
		messages: {
			"voucher_form[bonus_code]": {
				required: "Proszę podać kod"
			},
			"voucher_form[again]": {
				required: "Wymagane"
			}
			
		}
		
		

	});
});

</script>

{/literal}

