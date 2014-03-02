<?php
	
	require_once('Utils.class.php');
	
	$error = array();
	

	
	if (!$_POST['user_data']['name']) {
		$error['user_data']['name'] = $dict_error[3];
	}
	
	if (!$_POST['user_data']['surname']) {
		$error['user_data']['surname'] = $dict_error[4];
	}
	
	if (!$_POST['user_data']['birthdate']) {
		$error['user_data']['birthdate'] = $dict_error[12];		// nieprawidłowa data urodzenia
	}
	
	if (!$_POST['user_data']['city']) {
		$error['user_data']['city'] = $dict_error[13];		// nieprawidłowa data urodzenia
	}
	

	


	

	//if (sizeof($error)) {
	//	$error['user_data']['message'] = $dict_message[2];
	//}

?>