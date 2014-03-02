<?php
	
	require_once('Utils.class.php');
	
	$error = array();
	
	if (!$_POST['price_form']['email']) {
		$error['price_form']['email'] = "Pole wymagane";
	}
	elseif (!Utils::isEmail($_POST['price_form']['email'])) {
		$error['price_form']['email'] = "Nieprawidłowy adres";
	}
	if (!$_POST['price_form']['name']) {
		$error['price_form']['name'] = "Pole wymagane";
	}
	
	if (!$_POST['price_form']['price']) {
		$error['price_form']['price'] = "Pole wymagane";
	}

	/*
	if (!$_POST['price_form']['content']) {
		$error['price_form']['content'] = $dict_error[6];
	}
	
	if (!$_POST['price_form']['code']) {
		$error['price_form']['code'] = "Wpisz kod";
	}
	else{
		
	   if( $_SESSION['code'] == $_POST['price_form']['code'] && !empty($_SESSION['code'] ) ) {
	
	   }
	   else{
	   	
	   	$error['price_form']['code'] = "Niepoprawny kod";
	   	
	   }
		
   	}
   	*/
   	
   	
?>