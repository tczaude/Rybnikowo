<?php
	
	require_once('Utils.class.php');
	
	$error = array();
	
	if (!$_POST['contact_form']['email']) {
		$error['contact_form']['email'] = "Podaj adres email";
	}
	elseif (!Utils::isEmail($_POST['contact_form']['email'])) {
		$error['contact_form']['email'] = "Nieprawidłowy adres e-mail";
	}

	/*
	if (!$_POST['contact_form']['city']) {
		$error['contact_form']['city'] = $dict_error[4];
	}

	if (!$_POST['contact_form']['phone']) {
		$error['contact_form']['phone'] = $dict_error[5];
	}
*/
	if (!$_POST['contact_form']['content']) {
		$error['contact_form']['content'] = "Brak wiadomości";
	}
	
	if (sizeof($error)) {
		$error['contact_form']['message'] = $dict_menu['form_error'];
	}
	
	if (!$_POST['contact_form']['code']) {
		$error['contact_form']['code'] = "Wpisz kod";
	}
	else{
		
	   if( $_SESSION['code'] == $_POST['contact_form']['code'] && !empty($_SESSION['code'] ) ) {
	
	   }
	   else{
	   	
	   	$error['contact_form']['code'] = "Niepoprawny kod";
	   	
	   }
		
   	}
?>