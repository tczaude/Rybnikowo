<?php
	
	require_once('Utils.class.php');
	
	$error = array();
	


	
	if ($user->checkIfEmailExists($_POST['register_form']['email'])) {
		$error['register_form']['email'] = "Email: konto o podanym adresie już istnieje";		// podany adres już istnieje
	}
	if (!Utils::isEmail($_POST['register_form']['email'])) {
		$error['register_form']['email'] = "Email: podany adres nie jest prawidłowy";
	}
?>