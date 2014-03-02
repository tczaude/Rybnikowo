<?php
	
	require_once('Utils.class.php');
	
	$error = array();

	if (!$_POST['user_form']['password_actual']) {
		$error['user_form']['password'] = $dict_error[39];
	}

	else if ($_POST['user_form']['password_actual'] != $_SESSION['user_data']['password']) {
		$error['user_form']['password'] = $dict_error[36];
	}
	
	if (!$_POST['user_form']['email']) {
		$error['user_form']['email'] = $dict_error[37];
	}
	
	if ($_POST['user_form']['email'] == $_SESSION['user_data']['email']){
		
		$error['user_form']['email'] = $dict_error[38];
	}
	
	$check_exist = $user->getUserByEmail($_POST['user_form']['email']);

	if (sizeof($check_exist)){
		
		$error['user_form']['email'] = $dict_error[40];
		
	}

	
?>