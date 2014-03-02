<?php

	$template = "index.tpl";



	require_once('User.class.php');
	require_once('Article.class.php');
	require_once('Category.class.php');
	require_once('Blog.class.php');
	require_once('Product.class.php');	
	require_once('Slideshow.class.php');
	
	$user = new User();
	$article = new Article();
	$category = new Category();
	$blog = new Blog();
	$product = new Product();
	$slideshow = new Slideshow();
	
	
	//Produkty polecane
	$limit_home_product = 12;
	$page_number_home = 1;
	$home_list_product = $product->getProductsByHome($limit_home_product, $_SESSION['lang']);
	$smarty->assign("home_list", $home_list_product);
	//print_r($home_list_product);

	if($url_config['0'] == "pomoc"){
		
		//$help_list = $article->getArticlesByCategory(2, $_SESSION['lang']);
		$help_list = $article->getArticlesByCategoryToView(100, 1, $_SESSION['lang'], 2);
		$smarty->assign("help_list", $help_list);
		//print_r($help_list);
		$intro_main = 12;
		
		
	}	
	elseif($url_config['0'] == "szukaj"){
	
		$intro_main = 15;

	}
	elseif($url_config['0'] == "regulamin"){
	
		$intro_main = 5;

	}	
	elseif($url_config['0'] == "polityka"){
	
		$intro_main = 15;

	}
	elseif($url_config['0'] == "o-nas"){
	
		$intro_main = 16;

	}
	//Strona główna
	else{
		
		//$help_list = $article->getArticlesByCategory(2, $_SESSION['lang']);
		$help_list = $article->getArticlesByCategoryToView(100, 1, $_SESSION['lang'], 3);
		$smarty->assign("help_list", $help_list);
		//print_r($help_list);		
		$intro_main = 26;
	
	}

	
	require_once('includes/introduction.inc.php');
	

?>