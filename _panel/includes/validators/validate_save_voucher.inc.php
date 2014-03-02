<?php
	
	require_once('Utils.class.php');
	
	$error = array();
	//print_r($_POST);
	//Sprawdzamy czy kod o takiej wartości juz przypadkiem nie istanieje
	if ($_POST['voucher_form']['id']){
		
		$voucher_details = $voucher->getVoucherByCodeAndId($_POST['voucher_form']['bonus_code'], $_POST['voucher_form']['id']);
	}
	else{
		
		$voucher_details = $voucher->getVoucher($_POST['voucher_form']['bonus_code']);
		
	}
	

	// url_name już istanieje
	if ($voucher_details) {
		$error['voucher']['bonus_code'] = "Taki kod rabatowy już istnieje, ponów próbę.";
			
	}	

	
	//exit;
?>