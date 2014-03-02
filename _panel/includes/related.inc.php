<?php
require_once('Product_related.class.php');
$product_related = new Product_related();

// print_r($_POST);
// print_r($_FILES);

if ($_REQUEST['action'] == "SetOrderOnce") {
	$product->setOrderOnce();
}

// --------------------------------------------------------------
// 
// --------------------------------------------------------------

if($_POST['search_form']) {
	$smarty->assign("ret_post_search", $_POST['search_form']);
}

// -------------------------------------------------------
// dodaj pojedynczy produkt powiązany do produktu
// -------------------------------------------------------

if ($_REQUEST['action'] == "AddRelatedProduct") {
	
	if ($url_config['3'] && $_REQUEST['RelatedId']) {
		$product_related->addRelatedProduct($url_config['3'], $_REQUEST['RelatedId']);
		$smarty->assign("parent_reload", 1);
	}
	
	$_SESSION['message']['good_message'] = "Produkty zostały przywiązane";
	header("location: /_panel/related/GetRelatedProducts/".$url_config['3']."/");	
}

// -------------------------------------------------------
// dodaj wybrane produkty powiązane do produktu
// -------------------------------------------------------

if ($_REQUEST['action'] == "AddRelatedProductBulk") {
	
	if ($url_config['3'] && sizeof($_POST['related'])) {
		
		//print_r($_POST['related']);
		
		$product_related->addRelatedProductBulk($url_config['3'], $_POST['related']);
	}
	
	$_SESSION['message']['good_message'] = "Produkty zostały przywiązane";
	header("location: /_panel/related/GetRelatedProducts/".$url_config['3']."/");
}

// -------------------------------------------------------
// usuń wybrany produkt powiązany z produktu
// -------------------------------------------------------

if ($url_config['2'] == "remove") {
	
	if ($url_config['3'] && $url_config['4']) {
		$product_related->removeRelatedProduct($url_config['3'], $url_config['4']);

	}
	$_SESSION['message']['good_message'] = "Produkty zostały odwiązane";
	header("location: /_panel/related/GetRelatedProducts/".$url_config['3']."/");	
}

// -------------------------------------------------------
// usuń wybrane produkty powiązane z produktu
// -------------------------------------------------------

if ($_REQUEST['action'] == "RemoveRelatedProductBulk") {
	
	if ($url_config['3'] && sizeof($_POST['related'])) {
		
		// print_r($url_config['3']);
		// print_r($_POST['related']);
		
		$product_related->removeRelatedProductBulk($url_config['3'], $_POST['related']);

	}
	
	$_SESSION['message']['good_message'] = "Produkty zostały odwiązane";
	header("location: /_panel/related/GetRelatedProducts/".$url_config['3']."/");	
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
	
	$_SESSION['RelatedSetOrder'] = $set_sort['0'];
	$_SESSION['RelatedSetDirection'] = $set_sort['1'];
}
else {
	// domyślne ustawienia
	$_SESSION['RelatedSetOrder'] = "name";
	$_SESSION['RelatedSetDirection'] = "asc";
}
$smarty->assign("sort_order", $_SESSION['RelatedSetOrder']);

// uwaga! do szablonu ustawiamy przeciwny sposób sortowania (dla wybranego pola wg. którego sortujemy)
$sort_direction = ($_SESSION['RelatedSetDirection'] == "asc")?"desc":"asc";
$smarty->assign("sort_direction", $sort_direction); 

// --------------------------------------------------------------
// ustawienie filtrów w sesji
// --------------------------------------------------------------

if ($url_config['2'] == "Search") {
	$_SESSION['RelatedFilters'] = $_POST['search_form'];
	header("location: /_panel/related/GetRelatedProducts/".$url_config['3']."/");
}

// --------------------------------------------------------------
// usunięcie filtrów z sesji
// --------------------------------------------------------------

if ($url_config['2'] == "ClearSearch") {
	unset($_SESSION['RelatedFilters']);
	header("location: /_panel/related/GetRelatedProducts/".$url_config['3']."/");
}

// -------------------------------------------------------
// lista produktów powiązanych
// -------------------------------------------------------
//print_r($_SESSION['RelatedFilters']);
if ($url_config['2'] == "GetRelatedProducts" || $_REQUEST['action'] == "Search" || $_REQUEST['action'] == "ClearSearch") {
	
	// ustawienie numeru strony do stronicowania (jezeli nie została podana)
	if (!$url_config['4']) {
		$url_config['4'] = 1;
	}
	//print_r($url_config);
	
	if (isset($_SESSION['RelatedFilters'])) {
		// jeżeli są w sesji ustawione filtry, to zawsze pokazujemy listę przefiltrowaną
		$category_list_temp = $product_related->getProductsSearchForRelated($url_config['3'], 100, $_SESSION['RelatedSetOrder'], $_SESSION['RelatedSetDirection'], $_SESSION['RelatedFilters'], $url_config['4'], 1);
		
		// print_r($product_list);
		
		$smarty->assign("set_filter", "1");
		$smarty->assign("related_filters", $_SESSION['RelatedFilters']);
	}
	else {
		//echo "lista";
		
		$category_list_temp = $product_related->getProductsForRelated($_SESSION['RelatedSetOrder'], $_SESSION['RelatedSetDirection'], $url_config['4'], 1);
	}
	
	
	
	
	
	if ($category_list_temp){
		
		$category_list = array();
		require_once('Category.class.php');
		$category = new Category();

		foreach ($category_list_temp as $key => $details) {

			$category_list[$key] = $details;
			$subcategory_list = $category->getCategoriesByCategory($details['id']);
			
			if ($subcategory_list){
				
				foreach ($subcategory_list as $subcategory_details) {
					$category_list[$key]['sub'][$subcategory_details['id']] = $subcategory_details;
				}
				
				
			}
		}
	}
	
	// do znalezionej listy (tylko jedna strona!) sprawdzamy które z produktów są już powiązane z danym produktem
	$category_list = $product_related->checkRelatedProducts($url_config['3'], $category_list);
	//print_r($category_list);
	//print_r($category_list);
	
	// informacje o produkcie
	$product_details = $product_related->getProductInfoRelated($url_config['3']);
	
	
	//print_r($product_details);
	
	$related_amount = $product_details['related_amount'];
	
	$smarty->assign("category_list", $category_list);
	$smarty->assign("product", $product_details);
	$smarty->assign("ProductId", $url_config['3']);
	$smarty->assign("paging", $product_related->paging);
	//print_r($product->paging);
}

// --------------------------------------------------------------
// lista tylko produktów powiązanych
// --------------------------------------------------------------

if ($url_config['2'] == "RelatedOnly") {
	
	if ($url_config['3']) {
		
		$category_list_temp = $product_related->getRelatedProductsOnly($url_config['3']);
		
		

	if ($category_list_temp){
		
		$category_list = array();
		require_once('Category.class.php');
		$category = new Category();

		foreach ($category_list_temp as $details) {
			
			$parent_details = $category->getGroup($details['parent']);

			$category_list[$details['parent']]['id'] = $parent_details['id'];
			$category_list[$details['parent']]['name'] = $parent_details['name'];
			$category_list[$details['parent']]['sub'][$details['id']] = $details;
			$category_list[$details['parent']]['sub'][$details['id']]['selected'] = 1;

		}
	}
//print_r($category_list);
	// do znalezionej listy (tylko jedna strona!) sprawdzamy które z produktów są już powiązane z danym produktem

		
		// print_r($product_list);
		
		// informacje o produkcie
		$product_details = $product_related->getProductInfoRelated($url_config['3']);		

		
		//print_r($product_details);
		
		$related_amount = $product_details['related_amount'];
		
	$smarty->assign("category_list", $category_list);
	$smarty->assign("product", $product_details);

	}
}
		$smarty->assign("ProductId", $url_config['3']);
?>
