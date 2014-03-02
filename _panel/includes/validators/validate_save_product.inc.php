<?php
	
	require_once('Utils.class.php');
	
	$error = array();
	
	//print_r($_POST['product_form']);
	
	
	//Czyścimy fraze
	$phrase = $_POST['product_form']['url_name'];
	$new_phrase = Utils::clean_phrase($phrase);
	//print_r($new_phrase);
	$_POST['product_form']['url_name'] = $new_phrase;

	

	
	//Sprawdzamy czy w formularzu podane jest id 
	if($_POST['product_form']['product_id']){
		
		$product_details = $product->getProductByUrlNameAndId($_POST['product_form']['url_name'], $_POST['product_form']['product_id']);
		
		// url_name już istanieje dla istniejacego
		if ($product_details) {
			$error['product']['url_name'] = "Product o podanym identyfikatorze url już istnieje.";	
			//echo"stary";
		}	
	}
	else{
		//echo"nowy";
		$product_details = $product->getProductByUrlName($_POST['product_form']['url_name']);
	
		// url_name już istanieje
		if ($product_details) {
			$error['product']['url_name'] = "Product o podanym identyfikatorze url już istnieje. stary";
				
		}	
	}
	
	//exit;
?>