<?php
	
	require_once('Utils.class.php');
	
	$error = array();

	if (!$_POST['user_form']['password']) {
		$error['user_form']['password'] = $dict_error[25];
	}
	
	else if ($_POST['user_form']['password'] != $_POST['user_form']['password_commit']) {
		$error['user_form']['password_commit'] = $dict_error[9];
	}
	
	if (!$_POST['user_form']['password_commit']) {
		$error['user_form']['password_commit'] = $dict_error[16];
	}
	
	if (strlen($_POST['user_form']['password_commit']) < 6) {
		
		$error['user_form']['password'] = $dict_error[7];
	} 
	
?>