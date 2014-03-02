<?php

require_once('Category.class.php');
$category = new Category();

// print_r($_POST);
// print_r($_FILES);

// --------------------------------------------------------------
// zwracamy zawartość formularza edycji do widoku
// --------------------------------------------------------------

if($_POST['category']) {
	$smarty->assign("ret_post", $_POST['category']);
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
	$category_details = $category->getProductCategoryById($url_config['3']);
	//print_r($category_details);
	
	$category->setStatus($category_details['id'], $url_config['4']);

	$_REQUEST['action'] = "reindex";
	
}



// --------------------------------------------------------------
// zapisanie artykułu
// --------------------------------------------------------------

if ($_REQUEST['action'] == "SaveCategory") {
	
	
	
	//Walidacja url_name
	require_once('validate_save_category.inc.php');
			
	if (!sizeof($error)) {
	
		$category_id = $category->saveProductCategory($_POST['category']);
		
		//print_r($_POST['category']);
		
		// wrzucamy zdjęcia do odpowiedniego katalogu
		//require_once('Utils.class.php');
		//Utils::saveFile("pic_01", $__CFG['category_pictures_path'].$category_id."_01.jpg");
		
		$_SESSION['message']['good_message'] = "Kategoria została zapisana";
		header("location: /_panel/category");	
	}
	//Błędy
	else{
		
		$smarty->assign("error", $error['category']);
		$_REQUEST['action'] = "CreateView";
		//print_r($_POST['category']);
		
		
	}
}

// --------------------------------------------------------------
// usunięcie artykułu
// --------------------------------------------------------------

if ($url_config['2'] == "remove" ) {
	
	// usuwamy artykuł
	$category->removeProductCategory($url_config['3']);
	
	$_REQUEST['action'] = "reindex";
}

// -------------------------------------------------------
// ustawianie kolejności w ramach kategorii
// -------------------------------------------------------

if($url_config['2'] == "up" && $url_config['3']) {
	require_once('Order.class.php');
	$kolejnosc = new Order('category', 'id', 'order', 'type', 1);
	$kolejnosc->up($url_config['3']);
	
	$_REQUEST['action'] = "reindex";
}

if($url_config['2'] == "down" && $url_config['3']) {
	require_once('Order.class.php');
	$kolejnosc = new Order('category', 'id', 'order', 'type', 1);
	$kolejnosc->down($url_config['3']);
	
	$_REQUEST['action'] = "reindex";
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
	
	$_SESSION['CategorySetOrder'] = $set_sort['0'];
	$_SESSION['CategorySetDirection'] = $set_sort['1'];
}
else {
	// domyślne ustawienia
	$_SESSION['CategorySetOrder'] = "order";
	$_SESSION['CategorySetDirection'] = "desc";
}
$smarty->assign("sort_order", $_SESSION['CategorySetOrder']);

// uwaga! do szablonu ustawiamy przeciwny sposób sortowania (dla wybranego pola wg. którego sortujemy)
$sort_direction = ($_SESSION['CategorySetDirection'] == "asc")?"desc":"asc";
$smarty->assign("sort_direction", $sort_direction); 

// --------------------------------------------------------------
// ustawienie filtrów w sesji - dla wyszukiwania artykułów
// --------------------------------------------------------------

if ($_REQUEST['action'] == "SearchCategory") {
	$_SESSION['CategoryFilters'] = $_POST['search_form'];
}

// --------------------------------------------------------------
// usunięcie filtrów z sesji
// --------------------------------------------------------------

if ($_REQUEST['action'] == "ClearSearch") {
	unset($_SESSION['CategoryFilters']);
}

// --------------------------------------------------------------
// listakategorii
// --------------------------------------------------------------

if ($_REQUEST['action'] == "reindex" || !$url_config['2'] || $url_config['2'] == "index" || $url_config['2'] == "Search" || $url_config['2'] == "ClearSearch") {
	
	// oszukujemy ilość lokalizacji na jednej stronie
	$__CFG['record_count_limit'] = 10000;
	
	
	$menu_categories = $category->createMenuCategories(0);
	$smarty->assign("akcja", "category_list");
	//print_r($menu_categories);
	$smarty->assign("menu_categories", $menu_categories);
	
	// $smarty->assign("groups", $groups);
	$smarty->assign("languages_list", $languages_list);
}


// --------------------------------------------------------------
// nowy artykuł
// --------------------------------------------------------------

if ($url_config['2'] == "new") {
	
	// edytor WYSIWYG
	require_once('spaw/spaw_control.class.php');
	$sw = new SPAW_Wysiwyg('category_form[content]' /*name*/, '' /*value*/,
                   'pl' /*language*/, 'default' /*toolbar mode*/, '' /*theme*/,
                   '400px' /*width*/, '400px' /*height*/);
	$sSpaw = $sw->getHtml();
	
	// wersje językowe do interfejsu
	/*
	require_once('Language.class.php');
	$language = new Language();
	$languages_list = $language->_all_languages;
	*/
	$smarty->assign("akcja", "category_edit");
	$parent = $category->getProductCategoryById($url_config['3']);
	//print_r($parent);
	$smarty->assign("parent", $parent);
	$smarty->assign("ParentId", $url_config['3']);
	$template = "category_edit.tpl";
	$smarty->assign("category_id", $url_config['4']);
	$smarty->assign("language_id", $url_config['3']);
	// $smarty->assign("languages_list", $languages_list);
	$smarty->assign('sSpaw', $sSpaw);
}

// --------------------------------------------------------------
// edycja artykułu
// --------------------------------------------------------------

if ($url_config['2'] == "edit") {
	//print_r($url_config);
	// dane do edycji
	$category_details = $category->getProductCategoryById($url_config['3']);
	
//	/print_r($category_details);
	$_REQUEST['ParentId'] = $category_details['parent'];
	
	$smarty->assign("ParentId", $_REQUEST['ParentId']);
	
	// i jeszcze szczegóły rodzica
	$parent = $category->getProductCategory($category_details['parent']);
	$smarty->assign("parent", $parent);

	
	// edytor WYSIWYG
	require_once('spaw/spaw_control.class.php');
	$sw = new SPAW_Wysiwyg('category_form[content]' /*name*/, $category_details['content'] /*value*/,
                   'pl' /*language*/, 'default' /*toolbar mode*/, '' /*theme*/,
                   '400px' /*width*/, '400px' /*height*/);
	$sSpaw = $sw->getHtml();
	
	// print_r($sw);
	
	// wersje językowe do interfejsu
	
	require_once('Language.class.php');
	$language = new Language();
	$languages_list = $language->getLanguages();
	//print_r($languages_list);
	$smarty->assign("akcja", "category_edit");
	$template = "category_edit.tpl";
	$smarty->assign("category", $category_details);
	$smarty->assign("language_id", $category_details['language_id']);
	$smarty->assign("languages_list", $languages_list);
	$smarty->assign('sSpaw', $sSpaw);
	//print_r($languages_list);
}

// --------------------------------------------------------------
// dane artykułu - to może być wykorzystywane tylko w podglądzie?
// --------------------------------------------------------------

if ($_REQUEST['action'] == "DetailView") {
	
	// dane do przeglądania
	$category_details = $category->getCategoryDetails($_REQUEST['CategoryId'], $_REQUEST['LanguageId']);

	// print_r($category_details);
	
	$template = "category_details.tpl";
	$smarty->assign("category", $category_details);
}

?>