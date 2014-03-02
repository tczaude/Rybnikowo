<?php
	
	require_once('Utils.class.php');
	
	$error = array();
	

	
	//Czyścimy fraze
	$phrase = $_POST['partner_form']['url_name'];
	$new_phrase = Utils::clean_phrase($phrase);
	//print_r($new_phrase);
	$_POST['partner_form']['url_name'] = $new_phrase;

	
	
	
	//Sprawdzamy czy w formularzu podane jest id 
	if($_POST['partner_form']['partner_id']){
		
		$partner_details = $partner->getPartnerByUrlNameAndId($_POST['partner_form']['url_name'], $_POST['partner_form']['partner_id']);
		
		// url_name już istanieje dla istniejacego
		if ($partner_details) {
			$error['partner']['url_name'] = "Partner o podanym identyfikatorze url już istnieje. nowy";	
			//echo"stary";
		}	
	}
	else{
		
		$partner_details = $partner->getPartnerByUrlName($_POST['partner_form']['url_name']);
	
		// url_name już istanieje
		if ($partner_details) {
			$error['partner']['url_name'] = "Partner o podanym identyfikatorze url już istnieje. stary";
				
		}	
	}
	
	//exit;
?>