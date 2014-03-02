<?php
	require_once ('ShopOrder.class.php');
	$shop_order = new ShopOrder();
	
	if ($_SESSION['OrderId']) {
	
		// -----------------------------------------------------
		// wybieramy nasze bieżące zamówienie
		// -----------------------------------------------------
		
		$order_details = $shop_order->getShopOrderAll($_SESSION['user_data']['id'], $_SESSION['OrderId']);
		$smarty->assign("order", $order_details);
		
		//print_r($order_details);
		
		if ($url_config['1'] == "error") {
			$smarty->assign("bad_message", "Wystąpiły problemy z płatnością. Spróbuj ponownie.");
		}
		
		$main = "main_order_preview.tpl";
		$smarty->assign("main", $main);
	}
	else {
		header("Location: /zamowienie");
	}
	

	
?>