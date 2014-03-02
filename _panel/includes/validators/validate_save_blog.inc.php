<?php
	
	require_once('Utils.class.php');
	
	$error = array();
	

	
	//Czyścimy fraze
	$phrase = $_POST['blog_form']['url_name'];
	$new_phrase = Utils::clean_phrase($phrase);
	//print_r($new_phrase);
	$_POST['blog_form']['url_name'] = $new_phrase;

	
	
	
	//Sprawdzamy czy w formularzu podane jest id 
	if($_POST['blog_form']['blog_id']){
		
		$blog_details = $blog->getBlogByUrlNameAndId($_POST['blog_form']['url_name'], $_POST['blog_form']['blog_id']);
		
		// url_name już istanieje dla istniejacego
		if ($blog_details) {
			$error['blog']['url_name'] = "Blog o podanym identyfikatorze url już istnieje. nowy";	
			//echo"stary";
		}	
	}
	else{
		
		$blog_details = $blog->getBlogByUrlName($_POST['blog_form']['url_name']);
	
		// url_name już istanieje
		if ($blog_details) {
			$error['blog']['url_name'] = "Blog o podanym identyfikatorze url już istnieje. stary";
				
		}	
	}
	
	//exit;
?>