<?php
	
	require_once('Utils.class.php');
	
	$error = array();
	
	if (!$_POST['message_form']['topic']) {
		$error['message_form']['topic'] = $dict_error[26];		// nie wpisano tematu wiadomosci
	}
	
	if (!$_POST['message_form']['content']) {
		$error['message_form']['content'] = $dict_error[25];		// nie wpisano treści wiadomosci
	}



?>