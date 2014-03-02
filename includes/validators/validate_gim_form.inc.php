<?php
	
	require_once('Utils.class.php');
	
	$error = array();
	
	if (!$_POST['gim_form']['email']) {
		$error['gim_form']['email'] = $dict_error[1];
	}
	elseif (!Utils::isEmail($_POST['gim_form']['email'])) {
		$error['gim_form']['email'] = $dict_error[2];
	}
	if (!$_POST['gim_form']['name']) {
		$error['gim_form']['name'] = $dict_error[3];
	}
	/*
	if (!$_POST['gim_form']['city']) {
		$error['gim_form']['city'] = $dict_error[4];
	}

	if (!$_POST['gim_form']['phone']) {
		$error['gim_form']['phone'] = $dict_error[5];
	}
*/
	if (!$_POST['gim_form']['content']) {
		$error['gim_form']['content'] = $dict_error[6];
	}
	
	if (sizeof($error)) {
		$error['gim_form']['message'] = $dict_menu['form_error'];
	}
	
	if (!$_POST['gim_form']['code']) {
		$error['gim_form']['code'] = "Wpisz kod";
	}
	else{
		
	   if( $_SESSION['code'] == $_POST['gim_form']['code'] && !empty($_SESSION['code'] ) ) {
	
	   }
	   else{
	   	
	   	$error['gim_form']['code'] = "Niepoprawny kod";
	   	
	   }
		
   	}
?>