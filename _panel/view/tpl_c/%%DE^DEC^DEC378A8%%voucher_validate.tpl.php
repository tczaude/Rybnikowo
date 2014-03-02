<?php /* Smarty version 2.6.9, created on 2013-02-13 21:55:54
         compiled from voucher_validate.tpl */ ?>
<?php echo '

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

'; ?>

