<?php
	
	require_once('Utils.class.php');
	
	$error = array();
	
	//print_r($_POST['category']);
	
	
	//Czyścimy fraze
	$phrase = $_POST['category']['url_name'];
	$new_phrase = Utils::clean_phrase($phrase);
	//print_r($new_phrase);
	$_POST['category']['url_name'] = $new_phrase;
	
	
	$category_details = $category->getGroupByUrlName($_POST['category']['url_name']);

	// url_name już istanieje
	if ($category_details && $category_details['id'] != $_POST['category']['id']) {
		$error['category']['url_name'] = "Kategoria o podanym identyfikatorze url już istnieje.";		
	}
	
	//exit;
?>