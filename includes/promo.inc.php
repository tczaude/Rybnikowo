<?php

/**
 * Obsługa nowości - author - Code13
 */


	require_once('Product.class.php');
	$product = new Product();		
	
//-------------------------------------------------
// Lista produktów wg autora
//-------------------------------------------------
	$limit = 10;
	//Brak podanej strony
	if (!$url_config['1']) {
		
		$url_config['1'] = 1;
		
	}
	$product_list_temp = $product->getProductsByPromo($limit, $url_config['1'], $_SESSION['lang']);
	
	
	if(sizeof($product_list_temp)){
	
	$product_list = array();
	//Dolaczamy nazwe cechy
	foreach ($product_list_temp as $key => $details){
		
		require_once('Feature.class.php');
		$feature = new Feature();
		
		$feature_details = $feature->getProductFeatureById($details['type_id']);
		$product_list[$key] = $details;
		$product_list[$key]['feature_name'] = $feature_details['name'];
								
	}
	//print_r($product_list);

}	
	
	
	
	$smarty->assign("product_list", $product_list);
	$smarty->assign("paging", $product->paging);
	//print_r($product_list);
	
	
	