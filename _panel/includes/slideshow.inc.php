<?php

require_once('Slideshow.class.php');
$slideshow = new Slideshow();

// print_r($_POST);
// print_r($_FILES);






// --------------------------------------------------------------
// dynamiczne sortowanie
// --------------------------------------------------------------

if($url_config['2'] == "sortable"){
	
	if($_GET['listItem']){
	
	
		$order_list_temp = array();	
			//print_r($_GET['listItem']);
		foreach ($_GET['listItem'] as $position => $item){
			
			$key = $position + 1;
			$order_list_temp[$key] = $item;

			
			$slideshow->updateOrders($item, $key);
			
		}

		$smarty->assign("good_message", "Kolejność została ustalona");
		
		$smarty->display("good_message.tpl");

	}		
	
	exit;

}

// --------------------------------------------------------------
// zwracamy zawartość formularza edycji do widoku
// --------------------------------------------------------------

if($_POST['slideshow_form']) {
	$smarty->assign("ret_post", $_POST['slideshow_form']);
	
	//print_r($_POST['slideshow_form']);
}

// --------------------------------------------------------------
// zwracamy zawartość formularza wyszukiwania do widoku
// --------------------------------------------------------------

if($_POST['slideshow_form']) {
	$smarty->assign("ret_post_search", $_POST['slideshow_form']);
}

// --------------------------------------------------------------
// ustawienie filtrów w sesji - dla wyszukiwania slajdów
// --------------------------------------------------------------

if ($_REQUEST['action'] == "SearchSlideshow") {
	$_SESSION['SlideshowFilters'] = $_POST['slideshow_form'];
}

// --------------------------------------------------------------
// usunięcie filtrów z sesji
// --------------------------------------------------------------

if ($url_config['2'] == "clear") {
	unset($_SESSION['SlideshowFilters']);
	header("location: /_panel/slideshow/index");
}



// --------------------------------------
// wysyłka slajdu mailem 
// --------------------------------------

if ($url_config['2'] == "send") {
	
	$slideshow_details = $slideshow->getSlideshowDetails($url_config['3'], $_SESSION['admin_data']['language']);
	
	require_once('Newsletter.class.php');
	$newsletter = new Newsletter();
	
	$subscriber_list = $newsletter->getSubscribers($_SESSION['admin_data']['language'], 1);
	
	
	if($subscriber_list){
		
		foreach($subscriber_list as $subs){
			
			$slideshow_details['sub_details'] = $subs;
			
			
			$slideshow_sent = $slideshow->sendSlideshowByEmail($slideshow_details, $subs['email']);
			
		}
		
		
		
	}
	
	
	//print_r($subscriber_list);

	if ($slideshow_sent) {
		//Oznaczamy slajd jako wyslany
		$slideshow->setSended($slideshow_details['slideshow_id']);
		
	$_SESSION['message']['good_message'] = "Slajd został wysłany";
	header("location: /_panel/slideshow/index/".$slideshow_details['category_id']);
	}
}


// --------------------------------------------------------------
// ustawia jako aktywny/nieaktywny
// --------------------------------------------------------------
//print_r($url_config);



if ($url_config['2'] == "status") {
	
	//Najpierw wyciagamy dane o artykule
	$slideshow_details = $slideshow->getSlideshow($url_config['3'], $_SESSION['admin_data']['language']);
	//print_r($slideshow_details);
	
	$slideshow->setStatus($url_config['3'], $url_config['4'], $_SESSION['admin_data']['language']);
	//print_r($_REQUEST['action']);

	
	$_SESSION['message']['good_message'] = "Status został zmieniony";
	header("location: /_panel/slideshow/index/".$slideshow_details['category_id']);
	
}

// --------------------------------------------------------------
// usunięcie slajdu
// --------------------------------------------------------------

if ($url_config['2'] == "remove" ) {
	
	//Najpierw wyciagamy dane o artykule
	$slideshow_details = $slideshow->getSlideshow($url_config['3'], $_SESSION['admin_data']['language']);	
	
	// usuwamy slajd
	$slideshow->removeSlideshow($url_config['3']);
	
	$_SESSION['message']['good_message'] = "Slajd został usunięty";
	header("location: /_panel/slideshow/index/".$slideshow_details['category_id']);	
	
}

// --------------------------------------------------------------
// zapisanie slajdu
// --------------------------------------------------------------

if ($_REQUEST['action'] == "SaveSlideshow") {
	
	// echo "save slideshow";
	
	if (1) {
		if (isset($_POST['slideshow_form'])) {
			
				
					
	
			//Walidacja url_name
			//require_once('validate_save_slideshow.inc.php');
					
			if (!sizeof($error)) {			
			
			
				// zapisujemy slajd
				$SlideshowId = $slideshow->saveSlideshow($_POST['slideshow_form']);
				
				if(!$_POST['slideshow_form']['slideshow_id']){
					
					$_SESSION['message']['good_message'] = "Slajd został pomyślnie dodany";
				}
				else{
					
					$_SESSION['message']['good_message'] = "Slajd został pomyślnie zapisany";
				}
				
				
				
				
				
				header("location: /_panel/slideshow/index/".$_POST['slideshow_form']['category_id']);
			
			
				
			}
			//Błędy
			else{
				
				$smarty->assign("error", $error['slideshow']);
				$url_config['2'] = "edit";
				//print_r($error);
				
				
			}
			

		}
	}
}



// -------------------------------------------------------
// ustawianie kolejności w ramach kategorii
// -------------------------------------------------------

if($url_config['2'] == "up" && $url_config['3'] && $url_config['4']) {
	require_once('Order.class.php');
	$kolejnosc = new Order('slideshow','id', 'order', 'category_id', $url_config['4']);
	$kolejnosc->down($url_config['3']);
	$url_config['3'] = $url_config['4'];
	$_REQUEST['action'] = "reindex";
}

if($url_config['2'] == "down" && $url_config['3'] && $url_config['4']) {
	require_once('Order.class.php');
	$kolejnosc = new Order('slideshow','id', 'order', 'category_id', $url_config['4']);
	$kolejnosc->up($url_config['3']);
	$url_config['3'] = $url_config['4'];
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
	
	$_SESSION['SlideshowSetOrder'] = $set_sort['0'];
	$_SESSION['SlideshowSetDirection'] = $set_sort['1'];
}
else {
	// domyślne ustawienia
	$_SESSION['SlideshowSetOrder'] = "order";
	$_SESSION['SlideshowSetDirection'] = "asc";
}
$smarty->assign("sort_order", $_SESSION['SlideshowSetOrder']);

// uwaga! do szablonu ustawiamy przeciwny sposób sortowania (dla wybranego pola wg. którego sortujemy)
$sort_direction = ($_SESSION['SlideshowSetDirection'] == "asc")?"desc":"asc";
$smarty->assign("sort_direction", $sort_direction); 



// --------------------------------------------------------------
// lista slajdów
// --------------------------------------------------------------

if ($_REQUEST['action'] == "reindex" || !$url_config['2'] || $url_config['2'] == "index" || $url_config['2'] == "Search" || $url_config['2'] == "ClearSearch") {
	
	// ustawienie numeru strony do stronicowania (jezeli nie została podana)
	if (!isset($url_config['4'])) {
		$url_config['4'] = 1;
	}
	
	// ustawienie id kategorii (jezeli nie została podana)
	if (!isset($url_config['3'])) {
		
		//jest juz poprzednia
		if(!$_SESSION['SlideshowCategoryId']){
		
			$_SESSION['SlideshowCategoryId'] = 1;
		}
	}
	//zostala podana
	else{
		
		$_SESSION['SlideshowCategoryId'] = $url_config['3'];
			
	}
	
	
	//Jesli powrót do listy po jakiejś akcji
	if ($_REQUEST['action'] == "reindex"){
		
		$url_config['4'] = 1;
		
		
		
	}

	
	if (isset($_SESSION['SlideshowFilters'])) {
		
		$_SESSION['SlideshowFilters']['category_id'] = $_SESSION['SlideshowCategoryId'];
		
		// jeżeli są w sesji ustawione filtry, to zawsze pokazujemy listę przefiltrowaną
		$slideshows_list = $slideshow->getSlideshowsSearch($_SESSION['SlideshowSetOrder'], $_SESSION['SlideshowSetDirection'], $_SESSION['SlideshowFilters'], $url_config['4'], $_SESSION['lang']);
		$smarty->assign("set_filter", "1");
		
		$smarty->assign("ret_filters", $_SESSION['SlideshowFilters']);
	}
	else {
		$slideshows_list = $slideshow->getSlideshows($_SESSION['SlideshowSetOrder'], $_SESSION['SlideshowSetDirection'], $url_config['4'], $_SESSION['SlideshowCategoryId'], $_SESSION['lang']);
	
	}
	
	
	 //print_r($slideshows_list);
	
	// wersje językowe do interfejsu
	
	require_once('Language.class.php');
	$language = new Language();
	$languages_list = $language->getLanguages();
	//print_r($languages_list);
	
	$template = "slideshow_list.tpl";
	$smarty->assign("slideshows_list", $slideshows_list);
	$smarty->assign("akcja", "slideshow_list");
	$smarty->assign("languages_list", $languages_list);
	$smarty->assign("category_id", $_SESSION['SlideshowCategoryId']);
	$smarty->assign("paging", $slideshow->paging);
}


// --------------------------------------------------------------
// nowy slajd
// --------------------------------------------------------------

if ($url_config['2'] == "new") {
	
	// edytor WYSIWYG
	require_once('spaw/spaw_control.class.php');
	$sw = new SPAW_Wysiwyg('slideshow_form[content]' /*name*/, '' /*value*/,
                   'pl' /*language*/, 'default' /*toolbar mode*/, '' /*theme*/,
                   '400px' /*width*/, '400px' /*height*/);
	$sSpaw = $sw->getHtml();
	
	// wersje językowe do interfejsu
	/*
	require_once('Language.class.php');
	$language = new Language();
	$languages_list = $language->_all_languages;
	*/
	
	$template = "slideshow_edit.tpl";
	
	$smarty->assign("akcja", "slideshow_edit");
	
	$smarty->assign("category_id", $_SESSION['SlideshowCategoryId']);
	$smarty->assign("language_id", 1);
	// $smarty->assign("languages_list", $languages_list);
	$smarty->assign('sSpaw', $sSpaw);
}

// --------------------------------------------------------------
// edycja slajdu
// --------------------------------------------------------------

if ($url_config['2'] == "edit") {
	//print_r($url_config);
	// dane do edycji
	$slideshow_details = $slideshow->getSlideshow($url_config['3'], $url_config['4']);

	
	// edytor WYSIWYG
	require_once('spaw/spaw_control.class.php');
	$sw = new SPAW_Wysiwyg('slideshow_form[content]' /*name*/, $slideshow_details['content'] /*value*/,
                   'pl' /*language*/, 'default' /*toolbar mode*/, '' /*theme*/,
                   '200px' /*width*/, '400px' /*height*/);
	$sSpaw = $sw->getHtml();
	
	 //print_r($slideshow_details);
	
	// wersje językowe do interfejsu
	
	require_once('Language.class.php');
	$language = new Language();
	$languages_list = $language->getLanguages();
	//print_r($languages_list);
	
	$template = "slideshow_edit.tpl";
	$smarty->assign("slideshow", $slideshow_details);
	$smarty->assign("language_id", $slideshow_details['language_id']);
	$smarty->assign("languages_list", $languages_list);
	$smarty->assign('sSpaw', $sSpaw);
	$smarty->assign("category_id", $_SESSION['SlideshowCategoryId']);
	$smarty->assign("akcja", "slideshow_edit");
	//print_r($languages_list);
}

// --------------------------------------------------------------
// dane slajdu - to może być wykorzystywane tylko w podglądzie?
// --------------------------------------------------------------

if ($_REQUEST['action'] == "DetailView") {
	
	// dane do przeglądania
	$slideshow_details = $slideshow->getSlideshowDetails($_REQUEST['SlideshowId'], $_REQUEST['LanguageId']);

	// print_r($slideshow_details);
	
	$template = "slideshow_details.tpl";
	$smarty->assign("slideshow", $slideshow_details);
}

//Przekazujemy info o domyslnej kategorii
if($_SESSION['SlideshowCategoryId']){
	
	$smarty->assign("CategoryId", $_SESSION['SlideshowCategoryId']);
	
}
else{
	
	$smarty->assign("CategoryId", 1);
}



?>