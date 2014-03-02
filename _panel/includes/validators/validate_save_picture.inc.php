<?php
	
	require_once('Utils.class.php');
	
	$error = array();
	
	//print_r($_POST['product_form']);
	
	
	//Czyścimy fraze
	$phrase = $_POST['picture_form']['url_name'];
	$new_phrase = Utils::clean_phrase($phrase);
	//print_r($new_phrase);
	$_POST['picture_form']['url_name'] = $new_phrase;

	

	
	//Sprawdzamy czy w formularzu podane jest id 
	if($_POST['picture_form']['picture_id']){
		
		$picture_details = $picture->getPictureByUrlNameAndId($_POST['picture_form']['url_name'], $_POST['picture_form']['picture_id']);
		
		// url_name już istanieje dla istniejacego
		if ($picture_details) {
			$error['picture']['url_name'] = "Picture o podanym identyfikatorze url już istnieje.";	
			//echo"stary";
		}	
	}
	else{
		//echo"nowy";
		$picture_details = $picture->getPictureByUrlName($_POST['picture_form']['url_name']);
	
		// url_name już istanieje
		if ($picture_details) {
			$error['picture']['url_name'] = "Picture o podanym identyfikatorze url już istnieje. stary";
				
		}	
	}
	
	//exit;
?>