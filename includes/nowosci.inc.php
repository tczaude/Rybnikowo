<?php

/**
 * Obsługa nowości - author - Code13
 */


	require_once('Product.class.php');
	$product = new Product();	
	
//-------------------------------------------------
// Lista produktów wg autora
//-------------------------------------------------
	$limit = 5;
	//Brak podanej strony
	if (!$url_config['1']) {
		
		$url_config['1'] = 1;
		
	}
	$product_list = $product->getProductsNews($limit, $url_config['1'], $_SESSION['lang']);
	$smarty->assign("product_list", $product_list);
	$smarty->assign("paging", $product->paging);
	//print_r($product_list);
	
	
	