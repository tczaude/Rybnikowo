<?php

/**
 * Obsługa nowości - author - Code13
 */


	
	
//-------------------------------------------------
// Lista produktów wg autora
//-------------------------------------------------
	$limit = 10;
	//Brak podanej strony
	if (!$url_config['1']) {
		
		$url_config['1'] = 1;
		
	}
	$product_list = $product->getProductsByTheBest($limit, $url_config['1'], $_SESSION['lang']);
	$smarty->assign("product_list", $product_list);
	$smarty->assign("paging", $product->paging);
	//print_r($product_list);
	
	
	