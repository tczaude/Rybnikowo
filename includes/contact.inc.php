<?php

/**
 *  contact form management
 */
 

$intro_main = 26;
require_once('includes/introduction.inc.php');



if ($_REQUEST['action'] == "SaveContact") {
	if (sizeof($_POST['contact_form'])) {
		
	    // validate form data
	    
	    require_once('validate_contact_form.inc.php');
	    
		
		if (!sizeof($error)) {
		
			require_once ('Contact.class.php');
			$contact = new Contact();
			
			$contact->saveContact($_POST['contact_form']);
			
			// message
			$smarty->assign('good_message', $dict_message[3]);

	

			
		}
		else {
			
		//print_r($error);
			
			// wystąpiły błędy - przekazujemy info o tych błędach
			$smarty->assign('bad_message', "Wystąpiły błędy!");
			$smarty->assign("message", $error['contact_form']['message']);
			$smarty->assign("error", $error['contact_form']);
			$smarty->assign("ret_post", $_POST['contact_form']);
			$smarty->assign("main", "contact_form.tpl");
		}
		
	}
}	
	

?>
