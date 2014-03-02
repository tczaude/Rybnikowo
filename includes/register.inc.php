<?php

require_once ('User.class.php');
$user = new User();


$intro_main = 2;
$intro_left = 5;
require_once('includes/introduction.inc.php');


// --------------------------------------------------------------
// user registration (step 1)
// --------------------------------------------------------------  

if ($_REQUEST['action'] == "RegisterUser") {
//print_r($_POST);

	if (sizeof($_POST['register_form'])) {
		
    	require_once('validate_register_form.inc.php');
	    
		if (!sizeof($error['register_form'])) {
		
			$registration_id = $user->registerUser($_POST['register_form']);
			
					
			//Sprawdzamy czy user jest zapisany już do newslettera
			require_once ('Newsletter.class.php');
			$newsletter = new Newsletter();
			$newsletter->subscribeNewsletter($_POST['register_form']['email'], $registration_id);

			
			// komunikat do widoku
			$_SESSION['message']['good_message'] = "Wysłaliśmy do Ciebie e-mail z dalszymi instrukcjami odnośnie Twojej resjestracji.";
			header("location: /");
		}
		else {
			// błąd
			$smarty->assign("register_message", $error['register_form']['message']);
			$smarty->assign("error", $error['register_form']);
			$smarty->assign("ret_post", $_POST['register_form']);
			//print_r($error);
			$main = "main_registy.tpl";
 			
		}
	}
}



if (!$_REQUEST['action']) {

	$main = "main_registy.tpl";
}


//Jesli zalogowany - przenosimy do "moje konto"
if($_SESSION['user_data']){
	header("location: /konto");
}



?>