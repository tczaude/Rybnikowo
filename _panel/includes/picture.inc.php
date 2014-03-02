<?php

require_once('Picture.class.php');
$picture = new Picture();

// print_r($_POST);
// print_r($_FILES);


// --------------------------------------------------------------
// dynamiczne sortowanie
// --------------------------------------------------------------

if($url_config['2'] == "sortable"){
	if($_GET['listItem']){
		$order_list_temp = array();	
		foreach ($_GET['listItem'] as $position => $item){
			$key = $position + 1;
			$order_list_temp[$key] = $item;
			$picture->updateOrder($item, $key);
		}
	}	
	exit;
}

// --------------------------------------------------------------
// zwracamy zawartość formularza edycji do widoku
// --------------------------------------------------------------

if($_POST['picture_form']) {
	$smarty->assign("ret_post", $_POST['picture_form']);
	
	//print_r($_POST['picture_form']);
}

// --------------------------------------------------------------
// zwracamy zawartość formularza wyszukiwania do widoku
// --------------------------------------------------------------

if($_POST['picture_form']) {
	$smarty->assign("ret_post_search", $_POST['picture_form']);
}

// --------------------------------------------------------------
// ustawia jako aktywny/nieaktywny
// --------------------------------------------------------------

if ($url_config['2'] == "status") {
	
	//Najpierw wyciagamy dane o artykule
	$picture_details = $picture->getPicture($url_config['3'], $_SESSION['admin_data']['language']);
	//print_r($picture_details);
	
	$picture->setStatus($url_config['3'], $url_config['4'], $_SESSION['admin_data']['language']);
	//print_r($_REQUEST['action']);

	
	$_SESSION['message']['good_message'] = "Status został zmieniony";
	header("location: /_panel/picture/index/".$picture_details['category_id']);
	
}

// --------------------------------------------------------------
// usunięcie artykułu
// --------------------------------------------------------------

if ($url_config['2'] == "remove" ) {
	
	//Najpierw wyciagamy dane o artykule
	$picture_details = $picture->getPicture($url_config['3'], $_SESSION['admin_data']['language']);	
	
	// usuwamy artykuł
	$picture->removePicture($url_config['3']);
	
	$_SESSION['message']['good_message'] = "Artykuł został usunięty";
	header("location: /_panel/picture/index/".$picture_details['category_id']);	
	
}

// --------------------------------------------------------------
// zapisanie artykułu
// --------------------------------------------------------------

if ($_REQUEST['action'] == "SavePicture") {
	
	// echo "save picture";
	
	if (1) {
		if (isset($_POST['picture_form'])) {


					
			if (!sizeof($error)) {			
			
			
				// zapisujemy artykuł
				$PictureId = $picture->savePicture($_POST['picture_form']);
				
				if(!$_POST['picture_form']['picture_id']){
					
					$_SESSION['message']['good_message'] = "Zdjęcie zostało pomyślnie dodane";
				}
				else{
					
					$_SESSION['message']['good_message'] = "Zdjęcie zostało pomyślnie zapisane";
				}
				
				$smarty->assign("close", "1");
				$smarty->assign("location", "/_panel/picture/index/".$_POST['picture_form']['category_id']);
				$_REQUEST['action'] = "CreateView";

			}
		}
	}
}



// -------------------------------------------------------
// ustawianie kolejności w ramach kategorii
// -------------------------------------------------------

if($url_config['2'] == "up" && $url_config['3'] && $url_config['4']) {
	require_once('Order.class.php');
	$kolejnosc = new Order('picture','id', 'order', 'category_id', $url_config['4']);
	$kolejnosc->up($url_config['3']);
	$_SESSION['message']['good_message'] = "Kolejność została pomyślnie ustawiona";
	header("location: /_panel/picture/index/".$url_config['4']);
}

if($url_config['2'] == "down" && $url_config['3'] && $url_config['4']) {
	require_once('Order.class.php');
	$kolejnosc = new Order('picture','id', 'order', 'category_id', $url_config['4']);
	$kolejnosc->down($url_config['3']);
	$_SESSION['message']['good_message'] = "Kolejność została pomyślnie ustawiona";
	header("location: /_panel/picture/index/".$url_config['4']);
}

// --------------------------------------------------------------
// ustawienie sortowania w sesji
// --------------------------------------------------------------

// domyślne ustawienia
$_SESSION['PictureSetOrder'] = "order";
$_SESSION['PictureSetDirection'] = "asc";

$smarty->assign("sort_order", $_SESSION['PictureSetOrder']);
$smarty->assign("sort_direction", $sort_direction); 



// --------------------------------------------------------------
// lista artykułów
// --------------------------------------------------------------

if ($_REQUEST['action'] == "reindex" || !$url_config['2'] || $url_config['2'] == "index" || $url_config['2'] == "Search" || $url_config['2'] == "ClearSearch") {
	
	// ustawienie numeru strony do stronicowania (jezeli nie została podana)
	if (!($url_config['4'])) {
		$url_config['4'] = 1;
	}

	// ustawienie id wg id bloga
	$_SESSION['PictureCategoryId'] = $url_config['3'];
	$picture_list = $picture->getPictures($_SESSION['PictureSetOrder'], $_SESSION['PictureSetDirection'], $url_config['4'], $_SESSION['PictureCategoryId'], $_SESSION['lang']);
	
	//Szczegoly wpisu blogowego
	require_once('Product.class.php');
	$product = new Product();	
	
	$gallery_details = $product->getProduct($url_config['3'], $_SESSION['lang']);
	$smarty->assign("gallery_details", $gallery_details);
	//print_r($gallery_details);	
	require_once('Language.class.php');
	$language = new Language();
	$languages_list = $language->getLanguages();
	//print_r($languages_list);
	
	$template = "picture_list.tpl";
	$smarty->assign("picture_list", $picture_list);
	$smarty->assign("languages_list", $languages_list);
	$smarty->assign("category_id", $_SESSION['PictureCategoryId']);
	$smarty->assign("paging", $picture->paging);
}


// --------------------------------------------------------------
// nowy artykuł
// --------------------------------------------------------------

if ($url_config['2'] == "new") {
	$template = "picture_edit.tpl";

	$smarty->assign("category_id", $_SESSION['PictureCategoryId']);
	$smarty->assign("language_id", 1);

}

// --------------------------------------------------------------
// edycja artykułu
// --------------------------------------------------------------

if ($url_config['2'] == "edit") {
	
	// dane do edycji
	$picture_details = $picture->getPicture($url_config['3'], $_SESSION['lang']);
	
	// wersje językowe do interfejsu
	
	require_once('Language.class.php');
	$language = new Language();
	$languages_list = $language->getLanguages();
	//print_r($languages_list);
	
	$template = "picture_edit.tpl";
	$smarty->assign("picture", $picture_details);
	$smarty->assign("language_id", $picture_details['language_id']);
	$smarty->assign("languages_list", $languages_list);
	$smarty->assign("category_id", $_SESSION['PictureCategoryId']);
	//print_r($languages_list);
}



?>