<?php

require_once("Newsletter.class.php");
$newsletter = new Newsletter();

// --------------------------------------------------------------
// subscribe newsletter
// --------------------------------------------------------------  

if ($_REQUEST['action'] == "SubscribeNewsletter") {
	
	
	if (sizeof($_POST['newsletter']['email'])) {
	    
		require_once('validate_newsletter_form.inc.php');
	    
		if (!sizeof($error['newsletter'])) {
		
			//Sprawdzamy, czy user jest juz zapisany
			$exist = $newsletter->getSubscriber($_POST['newsletter']['email']);
			//print_r($exist);
			
			if(sizeof($exist)){
				$smarty->assign("ret_post", $_POST['newsletter']);
				$smarty->assign("bad_subscribe_message", "Podany adres jest już na liście");
				//print_r($_REQUEST);
				
				
			}
			else{
			
			
				$is_done = $newsletter->subscribeNewsletter($_POST['newsletter']['email']);
				
				// komunikat do widoku
				$smarty->assign("good_subscribe_message", "Adres został dodany");
			}
			
		}
		else {
			// błąd
			$smarty->assign("bad_subscribe_message", $error['newsletter']['email']);
			$smarty->assign("ret_post", $_POST['newsletter']);
			//print_r($error['newsletter']['email']);
		}		
	}
}

// --------------------------------------------------------------
// confirm subscription
// --------------------------------------------------------------  

if ($_REQUEST['action'] == "ConfirmNewsletterSubscription") {
	
	if ($_REQUEST['email'] && $_REQUEST['code']) {
		$is_done = $newsletter->confirmNewsletterSubscription ($_REQUEST['email'], $_REQUEST['code']);
		
		if ($is_done) {
			$smarty->assign("good_subscribe_message", $dict_message['12']);
		}
		else {
			$smarty->assign("bad_subscribe_message", $dict_message['11']);
		}
	}
}

// --------------------------------------------------------------
// unsubscribe newsletter
// --------------------------------------------------------------  

if ($url_config['1'] == "unsubscribe") {
	
	if ($_REQUEST['email'] && $_REQUEST['code']) {
		$is_done = $newsletter->unsubscribeNewsletter ($_REQUEST['email'], $_REQUEST['code']);
		
		if ($is_done) {
			$smarty->assign("good_subscribe_message", "Adres został pomyślnie usunięty z listy subskrybentów");
		}
		else {
			$smarty->assign("bad_subscribe_message", "Wystąpił błąd.");
		}
	}
}



?>
