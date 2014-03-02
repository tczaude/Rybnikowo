<?php
	
	require_once('Utils.class.php');
	
	$error = array();
	
	//print_r($_POST['product_form']);
	
	
	//Czyścimy fraze
	$phrase = $_POST['article_form']['url_name'];
	$new_phrase = Utils::clean_phrase($phrase);
	//print_r($new_phrase);
	$_POST['article_form']['url_name'] = $new_phrase;

	

	
	//Sprawdzamy czy w formularzu podane jest id 
	if($_POST['article_form']['article_id']){
		
		$article_details = $article->getArticleByUrlNameAndId($_POST['article_form']['url_name'], $_POST['article_form']['article_id']);
		
		// url_name już istanieje dla istniejacego
		if ($article_details) {
			$error['article']['url_name'] = "Article o podanym identyfikatorze url już istnieje.";	
			//echo"stary";
		}	
	}
	else{
		//echo"nowy";
		$article_details = $article->getArticleByUrlName($_POST['article_form']['url_name']);
	
		// url_name już istanieje
		if ($article_details) {
			$error['article']['url_name'] = "Article o podanym identyfikatorze url już istnieje. stary";
				
		}	
	}
	
	//exit;
?>