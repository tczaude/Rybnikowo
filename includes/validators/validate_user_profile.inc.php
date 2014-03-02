<?php
	
	require_once('Utils.class.php');
	
	$error = array();
	

	if (!$_POST['update_form']['email']) {
		$error['update_form']['email'] = "E-mail: podaj go nam";
	}
	elseif (!Utils::isEmail($_POST['update_form']['email'])) {
		$error['update_form']['email'] = "Email: podany adres chyba nie jest prawidłowy";
	}
	
	if (!$_POST['update_form']['password']) {
		$error['update_form']['password'] = "Hasło: wpisz swoje hasło i dobrze je zapamiętaj ;-)";
	}
	else if ($_POST['update_form']['password'] != $_POST['update_form']['password_commit']) {
		$error['update_form']['password_commit'] = "Hasło: wpisz swoje hasło i dobrze je zapamiętaj ;-)";
	}
	
	if (!$_POST['update_form']['password_commit']) {
		$error['update_form']['password_commit'] = "Potwierdzenie hasła: potwierdź swoje hasło";
	}
	
	if (!$_POST['update_form']['name']) {
		$error['update_form']['name'] = "Imię: Jak masz na imię?";
	}
	
	if (!$_POST['update_form']['surname']) {
		$error['update_form']['surname'] = "Nazwisko: Jak masz na nazwisko?";
	}
	
	/*	
	if (!$_POST['update_form']['regulations']) {
		$error['update_form']['regulations'] = $dict_error[8];	// brak akceptacji regulaminu
	}
	
print_r();
	

	if (sizeof($error)) {
		$error['update_form']['message'] = $dict_message[2];
	}
	*/
?>