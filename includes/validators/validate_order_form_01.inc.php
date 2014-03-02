<?php
	
	require_once('Utils.class.php');
	
	$error = array();

	if (!$_POST['order_form']['adress1']) {
		$error['order_form']['adress1'] = "Proszę wybrać miejsce dostawy";
		
	}

?>