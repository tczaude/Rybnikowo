<?php
	
	require_once('Utils.class.php');
	
	$error = array();
	
	//print_r($_POST['producer']);
	
	
	//Czyścimy fraze
	$phrase = $_POST['producer']['url_name'];
	$new_phrase = Utils::clean_phrase($phrase);
	//print_r($new_phrase);
	$_POST['producer']['url_name'] = $new_phrase;
	
	
	$producer_details = $producer->getGroupByUrlName($_POST['producer']['url_name']);

	// url_name już istanieje
	if ($producer_details && $producer_details['id'] != $_POST['producer']['id']) {
		$error['producer']['url_name'] = "Kategoria o podanym identyfikatorze url już istnieje.";		
	}
	
	//exit;
?>