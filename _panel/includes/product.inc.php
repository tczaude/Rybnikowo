<?php

//Ładujemy model dla produktów
require_once('Product.class.php');
$product = new Product();
//Ładujemy model dla kategorii
require_once('Category.class.php');
$category = new Category();
//Ładujemy model dla producentów
require_once('Producer.class.php');
$producer = new Producer();


// --------------------------------------------------------------
// dynamiczne sortowanie
// --------------------------------------------------------------

if($url_config['2'] == "sortable"){
	
	if($_GET['listItem']){
	
	
		$order_list_temp = array();	
			
		foreach ($_GET['listItem'] as $position => $item){
			
			$key = $position + 1;
			$order_list_temp[$key] = $item;

			$product->updateOrder($item, $key);
			
		}
			
		$smarty->assign("good_message", "Kolejność została ustalona");
		
		$smarty->display("good_message.tpl");
			

	}	
	
	
	
	exit;

}
//---------------------------------------------------------------
//Pierwsza "wolna" kategoria
//---------------------------------------------------------------

	$first_category_temp = $category->firstCatergory();
	$first_category = min($first_category_temp);

// --------------------------------------------------------------
// Ładujemy i przekazuyjemy do Smarty kategorie produktów
// --------------------------------------------------------------

	$category_list = $category->createCategoriesForAdmin();
	$smarty->assign("product_categories", $category_list);
	//print_r($category_list);
	
	
// --------------------------------------------------------------
// Ładujemy i przekazuyjemy do Smarty producentów
// --------------------------------------------------------------

	$producer_list = $producer->createCategoriesForAdmin();
	$smarty->assign("producer_categories", $producer_list);
	//print_r($category_list);

// --------------------------------------------------------------
// zwracamy zawartość formularza edycji do widoku
// --------------------------------------------------------------

	if($_POST['product_form']) {
		$smarty->assign("ret_post", $_POST['product_form']);
	}

// --------------------------------------------------------------
// zwracamy zawartość formularza wyszukiwania do widoku
// --------------------------------------------------------------

	if($_POST['search_form']) {
		$smarty->assign("ret_post_search", $_POST['search_form']);
	}


// --------------------------------------------------------------
// ustawia jako aktywny/nieaktywny
// --------------------------------------------------------------
//print_r($url_config);



if ($url_config['2'] == "status") {
	
	//Najpierw wyciagamy dane o artykule
	$product_details = $product->getProduct($url_config['3'], $_SESSION['admin_data']['language']);
	//print_r($product_details);
	
	$product->setStatus($url_config['3'], $url_config['4'], $_SESSION['admin_data']['language']);

	
	$_SESSION['message']['good_message'] = "Status został zmieniony";
	header("location: /_panel/product/index/".$product_details['category_id']);	
	
}


// --------------------------------------------------------------
// ustawia jako promocję i odwrotnie
// --------------------------------------------------------------

if ($url_config['2'] == "promotion") {
	
	//Najpierw wyciagamy dane o artykule
	$product_details = $product->getProduct($url_config['3'], $_SESSION['admin_data']['language']);
	//print_r($product_details);
	
	$product->setPromotion($url_config['3'], $url_config['4'], $_SESSION['admin_data']['language']);

	$_SESSION['message']['good_message'] = "Promocja została ustawiona / wyłączona";
	header("location: /_panel/product/index/".$product_details['category_id']);	
	
}

// --------------------------------------------------------------
// ustawia na strone głowna
// --------------------------------------------------------------

if ($url_config['2'] == "home") {
	
	//Najpierw wyciagamy dane o artykule
	$product_details = $product->getProduct($url_config['3'], $_SESSION['admin_data']['language']);
	//print_r($product_details);
	
	$product->setHome($url_config['3'], $url_config['4'], $_SESSION['admin_data']['language']);

	$_SESSION['message']['good_message'] = "Produkt została ustawiony / wyłączony na stronę główną";
	header("location: /_panel/product/index/".$product_details['category_id']);	
	
}

// --------------------------------------------------------------
// ustawia jako produkt / usługę
// --------------------------------------------------------------

if ($url_config['2'] == "service") {
	
	//Najpierw wyciagamy dane o artykule
	$product_details = $product->getProduct($url_config['3'], $_SESSION['admin_data']['language']);
	//print_r($product_details);
	
	$product->setService($url_config['3'], $url_config['4'], $_SESSION['admin_data']['language']);

	$_SESSION['message']['good_message'] = "Produkt została ustawiony / wyłączony jako usługa";
	header("location: /_panel/product/index/".$product_details['category_id']);	
	
}

// --------------------------------------------------------------
// zapisanie artykułu
// --------------------------------------------------------------

if ($_REQUEST['action'] == "SaveProduct") {

	require_once('validate_save_product.inc.php');
			
	if (!sizeof($error)) {
			

		$product_form = array();
		$product_form = $_POST['product_form'];

		// zapisujemy artykuł
		$ProductId = $product->saveProduct($product_form);
		
		if(!$_POST['product_form']['product_id']){
			
			$_SESSION['message']['good_message'] = "Produkt został pomyślnie dodany";
		}
		else{
			
			$_SESSION['message']['good_message'] = "Produkt został pomyślnie zapisany";
		}
		
		
		
		
		
		header("location: /_panel/product/index/".$_POST['product_form']['category_id']);
						
		
	}
	//Błędy
	else{
		
		$_SESSION['copy']['ret_post'] = $_POST['product_form'];
		$_SESSION['copy']['error'] = $error['product'];
		
		header("location: /_panel/product/ret_copy/".$url_config['3']."/1");

		
		
	}
}

// --------------------------------------------------------------
// usunięcie artykułu
// --------------------------------------------------------------

if ($url_config['2'] == "remove" ) {
	
	//Najpierw wyciagamy parametry o usuwanym artykule - zeby pozniej dobrze przekazac parametry
	
	$product_details = $product->getProductToRemove($url_config['3'], $_SESSION['lang']);
	//print_r($product_details);
	if(sizeof($product_details)){
		
	//print_r($product_details);
		// usuwamy artykuł
		$product->removeProduct($url_config['3']);
		
		$url_config['3'] = $url_config['4'];
		
		$_REQUEST['action'] = "reindex";		
		
		
	}
	else{
		header("Location: /_panel/product/index/".$url_config['4']);
	}

}


// --------------------------------------------------------------
// ustawienie sortowania w sesji
// --------------------------------------------------------------

if ($_REQUEST['SetSort']) {
	$set_sort = explode(",",$_REQUEST['SetSort']);
	
	/*
	print_r($set_sort);
	echo $set_sort[0];
	*/
	
	$_SESSION['ProductSetOrder'] = $set_sort['0'];
	$_SESSION['ProductSetDirection'] = $set_sort['1'];
}
else {
	// domyślne ustawienia
	$_SESSION['ProductSetOrder'] = "order";
	$_SESSION['ProductSetDirection'] = "asc";
}
$smarty->assign("sort_order", $_SESSION['ProductSetOrder']);

// uwaga! do szablonu ustawiamy przeciwny sposób sortowania (dla wybranego pola wg. którego sortujemy)
$sort_direction = ($_SESSION['ProductSetDirection'] == "asc")?"desc":"asc";
$smarty->assign("sort_direction", $sort_direction); 

// --------------------------------------------------------------
// ustawienie filtrów w sesji - dla wyszukiwania artykułów
// --------------------------------------------------------------

if ($_REQUEST['action'] == "SearchProduct") {
	$_SESSION['ProductFilters'] = $_POST['search_form'];
	
}
//print_r($_SESSION['ProductFilters']);

// --------------------------------------------------------------
// usunięcie filtrów z sesji
// --------------------------------------------------------------

if ($url_config['2'] == "clear_filter") {

	unset($_SESSION['ProductFilters']);
	$_SESSION['message']['good_message'] = "Filtry zostały wyczyszczone";
	header("location: /_panel/product/index/".$_SESSION['CategoryId']);	
	
	
}
if ($_REQUEST['action'] == "ClearSearch") {
	unset($_SESSION['ProductFilters']);
	
}
$smarty->assign("order_filters", $_SESSION['ProductFilters']);
// --------------------------------------------------------------
// lista artykułów
// --------------------------------------------------------------

if ($_REQUEST['action'] == "reindex" || !$url_config['2'] || $url_config['2'] == "index" || $url_config['2'] == "Search" || $url_config['2'] == "ClearSearch") {
	
	// ustawienie numeru strony do stronicowania (jezeli nie została podana)
	if (!isset($url_config['4'])) {
		$url_config['4'] = 1;
	}

	
	
	// ustawienie id kategorii (jezeli nie została podana)
	if (!isset($url_config['3'])) {
		
		//jest juz poprzednia
		if(!$_SESSION['CategoryId']){
		
			$_SESSION['CategoryId'] = 32;
		}
	}
	//zostala podana
	else{
		
		$_SESSION['CategoryId'] = $url_config['3'];
			
	}

	
	
	if (isset($_SESSION['ProductFilters'])) {
		
		//$_SESSION['ProductFilters']['category_id'] = $_SESSION['CategoryId'];
		
		$limit = 100;
		$_SESSION['ProductFilters']['no_bonus'] = 1;
		// jeżeli są w sesji ustawione filtry, to zawsze pokazujemy listę przefiltrowaną
		$products_list = $product->getProductsSearch($limit, $_SESSION['ProductSetOrder'], $_SESSION['ProductSetDirection'], $_SESSION['ProductFilters'], $url_config['4'], $_SESSION['lang']);

		$smarty->assign("set_filter", "1");
		//echo"tak";
		
	}
	else {
		

			
		$products_list = $product->getProducts($_SESSION['ProductSetOrder'], $_SESSION['ProductSetDirection'], $url_config['4'], $_SESSION['CategoryId'], $_SESSION['lang']);
			
		
		
		
	
	}
	
	
	 //print_r($products_list);
	
	// wersje językowe do interfejsu
	
	require_once('Language.class.php');
	$language = new Language();
	$languages_list = $language->getLanguages();
	//print_r($languages_list);
	
	$template = "product_list.tpl";
	$smarty->assign("akcja", "product_list");
	$smarty->assign("products_list", $products_list);
	$smarty->assign("languages_list", $languages_list);
	$smarty->assign("category_id", $_SESSION['CategoryId']);
	$smarty->assign("paging", $product->paging);
}


// --------------------------------------------------------------
// nowy artykuł
// --------------------------------------------------------------

if ($url_config['2'] == "new") {
	
	
	// edytor WYSIWYG
	require_once('spaw/spaw_control.class.php');
	$sw = new SPAW_Wysiwyg('product_form[content]' /*name*/, '' /*value*/,
                   'pl' /*language*/, 'default' /*toolbar mode*/, '' /*theme*/,
                   '700px' /*width*/, '400px' /*height*/);
	$sSpaw = $sw->getHtml();
	$sw2 = new SPAW_Wysiwyg('product_form[content2]' /*name*/, '' /*value*/,
                   'pl' /*language*/, 'default' /*toolbar mode*/, '' /*theme*/,
                   '700px' /*width*/, '400px' /*height*/);
	$sSpaw2 = $sw2->getHtml();
	// wersje językowe do interfejsu
	/*
	require_once('Language.class.php');
	$language = new Language();
	$languages_list = $language->_all_languages;
	*/
	
	$template = "product_edit.tpl";
	$smarty->assign("akcja", "product_edit");
	$smarty->assign("category_id", $_SESSION['CategoryId']);
	$smarty->assign("language_id", $url_config['3']);
	// $smarty->assign("languages_list", $languages_list);
	$smarty->assign('sSpaw', $sSpaw);
	$smarty->assign('sSpaw2', $sSpaw2);
}

// --------------------------------------------------------------
// edycja artykułu
// --------------------------------------------------------------

if ($url_config['2'] == "edit") {
	//print_r($url_config);
	// dane do edycji
	$product_details = $product->getProductForAdmin($url_config['3'], $url_config['4']);
	//print_r($product_details);
	
	
	// edytor WYSIWYG
	require_once('spaw/spaw_control.class.php');
	$sw = new SPAW_Wysiwyg('product_form[content]' /*name*/, $product_details['content'] /*value*/,
                  'pl' /*language*/, 'default' /*toolbar mode*/, '' /*theme*/,
                  '700px' /*width*/, '400px' /*height*/);
	$sSpaw = $sw->getHtml();
	$sw2 = new SPAW_Wysiwyg('product_form[content2]' /*name*/, $product_details['content2'] /*value*/,
                  'pl' /*language*/, 'default' /*toolbar mode*/, '' /*theme*/,
                  '700px' /*width*/, '400px' /*height*/);
	$sSpaw2 = $sw2->getHtml();	
	// print_r($sw);
	
	// wersje językowe do interfejsu
	
	require_once('Language.class.php');
	$language = new Language();
	$languages_list = $language->getLanguages();
	//print_r($languages_list);
	
	$template = "product_edit.tpl";
	$smarty->assign("akcja", "product_edit");
	$smarty->assign("product", $product_details);
	$smarty->assign("language_id", $product_details['language_id']);
	$smarty->assign("category_id", $_SESSION['CategoryId']);
	$smarty->assign("languages_list", $languages_list);
	$smarty->assign('sSpaw', $sSpaw);
	$smarty->assign('sSpaw2', $sSpaw2);
	//print_r($languages_list);		


}
// --------------------------------------------------------------
// kopiowanie artykułu
// --------------------------------------------------------------

if ($url_config['2'] == "copy") {
	//print_r($url_config);
	// dane do edycji
	$product_details = $product->getProductForAdmin($url_config['3'], $url_config['4']);
	//print_r($product_details);
	

	// edytor WYSIWYG
	require_once('spaw/spaw_control.class.php');
	$sw = new SPAW_Wysiwyg('product_form[content]' /*name*/, $product_details['content'] /*value*/,
                  'pl' /*language*/, 'default' /*toolbar mode*/, '' /*theme*/,
                  '700px' /*width*/, '400px' /*height*/);
	$sSpaw = $sw->getHtml();
	$sw2 = new SPAW_Wysiwyg('product_form[content2]' /*name*/, $product_details['content2'] /*value*/,
                  'pl' /*language*/, 'default' /*toolbar mode*/, '' /*theme*/,
                  '700px' /*width*/, '400px' /*height*/);
	$sSpaw2 = $sw2->getHtml();	
	$smarty->assign('sSpaw', $sSpaw);
	$smarty->assign('sSpaw2', $sSpaw2);
	// print_r($sw);

	
	// wersje językowe do interfejsu
	
	require_once('Language.class.php');
	$language = new Language();
	$languages_list = $language->getLanguages();
	//print_r($languages_list);
	
	$template = "product_copy.tpl";
	$smarty->assign("akcja", "product_edit");
	$smarty->assign("product", $product_details);
	$smarty->assign("language_id", $product_details['language_id']);
	$smarty->assign("category_id", $_SESSION['CategoryId']);
	$smarty->assign("languages_list", $languages_list);

	//print_r($languages_list);		


}
// --------------------------------------------------------------
// kopiowanie artykułu /nastepna proba zapisu/
// --------------------------------------------------------------

if ($url_config['2'] == "ret_copy") {
	//print_r($url_config);
	// dane do edycji
	$product_details = $_SESSION['copy']['ret_post'];
	//print_r($product_details);
	

	// edytor WYSIWYG
	require_once('spaw/spaw_control.class.php');
	$sw = new SPAW_Wysiwyg('product_form[content]' /*name*/, $product_details['content'] /*value*/,
                  'pl' /*language*/, 'default' /*toolbar mode*/, '' /*theme*/,
                  '700px' /*width*/, '400px' /*height*/);
	$sSpaw = $sw->getHtml();
	$sw2 = new SPAW_Wysiwyg('product_form[content2]' /*name*/, $product_details['content2'] /*value*/,
                  'pl' /*language*/, 'default' /*toolbar mode*/, '' /*theme*/,
                  '700px' /*width*/, '400px' /*height*/);
	$sSpaw2 = $sw2->getHtml();	
	$smarty->assign('sSpaw', $sSpaw);
	$smarty->assign('sSpaw2', $sSpaw2);
	// print_r($sw);

	
	// wersje językowe do interfejsu
	
	require_once('Language.class.php');
	$language = new Language();
	$languages_list = $language->getLanguages();
	//print_r($languages_list);
	
	$template = "product_copy.tpl";
	$smarty->assign("akcja", "product_edit");
	$smarty->assign("product", $product_details);
	$smarty->assign("language_id", $product_details['language_id']);
	$smarty->assign("category_id", $_SESSION['CategoryId']);
	$smarty->assign("error", $_SESSION['copy']['error']);
	$smarty->assign("languages_list", $languages_list);

	//print_r($languages_list);		


}
// --------------------------------------------------------------
// dane artykułu - to może być wykorzystywane tylko w podglądzie?
// --------------------------------------------------------------

if ($_REQUEST['action'] == "DetailView") {
	
	// dane do przeglądania
	$product_details = $product->getProductDetails($_REQUEST['ProductId'], $_REQUEST['LanguageId']);

	// print_r($product_details);
	
	$template = "product_details.tpl";
	$smarty->assign("product", $product_details);
}

//print_r($url_config);


?>