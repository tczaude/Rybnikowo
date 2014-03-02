<?php

/**
 *  user profile managing 
 */
 
// print_r($_POST);

// --------------------------------------------------------------
// user profile form protection
// --------------------------------------------------------------

//if (!sizeof($_SESSION['user_data'])) {
	// user is not logged in!
	//header("Location: index.php");
	//exit;
//}



// --------------------------------------------------------------
// aktualizacja danych użytkownika
// --------------------------------------------------------------

if ($_REQUEST['action'] == "UpdateUser") {
	
	if (sizeof($_POST['user_data'])) {
		
	    // form validation
	    
	    require_once('validate_user_profile.inc.php');
	    
		if (!sizeof($error['user_data'])) {
			
			// dane są poprawne -> update
			$user->updateUser($_POST['user_data']);
			
			// remove user data from POST
			unset($_POST['user_data']);
			
			// get new user data
			$user_details = $user->getUser($_SESSION['user_data']['id']);
			
			// print_r($user_details);
			
			// copy user data to session and Smarty
			$_SESSION['user_data'] = $user_details;
			$smarty->assign('user_data', $_SESSION['user_data']);
			unset($_SESSION['ImportUserMessage']);
			// komunikat do widoku
			$smarty->assign('message', $user->message);
		}
		else {
			// wystąpiły błędy - przekazujemy info o tych błędach
			//print_r($error);
			$smarty->assign("message", $error['user_data']['message']);
			$smarty->assign("error", $error['user_data']);
			$smarty->assign("ret_post", $_POST['user_data']);
			
		}
	}
}
/*
// --------------------------------------------------------------
// lista zamówień złożonych przez użytkownika
// --------------------------------------------------------------

if ($_REQUEST['action'] == "GetMyOrders") {
	
	require_once ('ShopOrder.class.php');
	$shop_order = new ShopOrder();
	
	$order_list = $shop_order->getOrdersForUser($_SESSION['user_data']['id']);
	$smarty->assign("order_list", $order_list);
	
	$smarty->assign("featured_content", "my_orders.tpl");
}

// --------------------------------------------------------------
// najbliższe premiery
// --------------------------------------------------------------

require_once('Product.class.php');
$product = new Product();

$premieres = $product->getNextPremieres($_SESSION['user_data']['language']);
$smarty->assign("premieres", $premieres);

//print_r($premieres);
*/
?>