<?php
require_once('Admin.class.php');
$admin = new Admin();


 
// --------------------------------------------------------------
// log in admin
// --------------------------------------------------------------

if ($_REQUEST['action'] == "LoginAdmin") {
	
	// tylko wtedy, gdy jeszcze nie jest zalogowany!
	
	if (!sizeof($_SESSION['admin_data'])) {
		
		if (sizeof($_POST['login_form'])) {
			//print_r($_POST['login_form']);
			// niezalogowany i podano dane do autoryzacji
			
			$user_details = $admin->loginAdmin($_POST['login_form']);
			// print_r($user_details);
			
	       	if (sizeof($user_details)) {
	           	// logged correct
	       		$_SESSION['admin_data'] = $user_details;
	       		$smarty->assign('admin_data', $_SESSION['admin_data']);
	       		
	       		// write this log in log
	       		//$user->writeUserLogin($_SESSION['user_data']['id']);
	       		
	       		$_SESSION['message']['good_message'] = "Zostałeś zalogowany jako admin";

	       		// go to mainpage
	       		header("location: /_panel");
	       	}
	       	else {
	       		// błąd przy logowaniu
	           	$smarty->assign('message', $dict_message[1]);
	           	$smarty->assign('ret_post', $_POST['login_form']);
	    	}
	    }
	}
}

// --------------------------------------------------------------
// admin profile to view
// --------------------------------------------------------------
 
if (sizeof($_SESSION['admin_data'])) {
	
	$smarty->assign("admin_data", $_SESSION['admin_data']);
}
?>