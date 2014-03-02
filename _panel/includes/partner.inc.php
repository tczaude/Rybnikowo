<?php

require_once('Partner.class.php');
$partner = new Partner();

// print_r($_POST);
// print_r($_FILES);

// --------------------------------------------------------------
// zwracamy zawartość formularza edycji do widoku
// --------------------------------------------------------------

if($_POST['partner_form']) {
	$smarty->assign("ret_post", $_POST['partner_form']);
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
	$partner_details = $partner->getPartner($url_config['3'], $_SESSION['admin_data']['language']);
	//print_r($partner_details);
	
	$partner->setStatus($url_config['3'], $url_config['4'], $_SESSION['admin_data']['language']);
	//print_r($_REQUEST['action']);
	$url_config['3'] = $partner_details['category_id'];
	$_REQUEST['action'] = "reindex";
	
}



// --------------------------------------------------------------
// zapisanie artykułu
// --------------------------------------------------------------

if ($_REQUEST['action'] == "SavePartner") {
	
	//Walidacja url_name
	require_once('validate_save_partner.inc.php');
			
	if (!sizeof($error)) {
			
			// zapisujemy artykuł
			$PartnerId = $partner->savePartner($_POST['partner_form']);
			
			$url_config['3'] = $PartnerId;
			$url_config['4'] = $_POST['partner_form']['language_id'];
			$url_config['2'] = "edit";
			$smarty->assign("reload", 1);
			//$url_config['2'] = "edit";
						
		
	}
	//Błędy
	else{
		
		$smarty->assign("error", $error['partner']);
		$url_config['2'] = "edit";
		//print_r($error);
		
		
	}	
	
	
}

// --------------------------------------------------------------
// usunięcie artykułu
// --------------------------------------------------------------

if ($url_config['2'] == "remove" ) {
	
	// usuwamy artykuł
	$partner->removePartner($url_config['3']);
	
	$_REQUEST['action'] = "reindex";
}

// -------------------------------------------------------
// ustawianie kolejności w ramach kategorii
// -------------------------------------------------------

if($url_config['2'] == "up" && $url_config['3'] && $url_config['4']) {
	require_once('Order.class.php');
	$kolejnosc = new Order('partner','id', 'order', 'category_id', $url_config['4']);
	$kolejnosc->down($url_config['3']);
	$url_config['3'] = $url_config['4'];
	$_REQUEST['action'] = "reindex";
}

if($url_config['2'] == "down" && $url_config['3'] && $url_config['4']) {
	require_once('Order.class.php');
	$kolejnosc = new Order('partner','id', 'order', 'category_id', $url_config['4']);
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
	
	$_SESSION['PartnerSetOrder'] = $set_sort['0'];
	$_SESSION['PartnerSetDirection'] = $set_sort['1'];
}
else {
	// domyślne ustawienia
	$_SESSION['PartnerSetOrder'] = "order";
	$_SESSION['PartnerSetDirection'] = "desc";
}
$smarty->assign("sort_order", $_SESSION['PartnerSetOrder']);

// uwaga! do szablonu ustawiamy przeciwny sposób sortowania (dla wybranego pola wg. którego sortujemy)
$sort_direction = ($_SESSION['PartnerSetDirection'] == "asc")?"desc":"asc";
$smarty->assign("sort_direction", $sort_direction); 

// --------------------------------------------------------------
// ustawienie filtrów w sesji - dla wyszukiwania artykułów
// --------------------------------------------------------------

if ($_REQUEST['action'] == "SearchPartner") {
	$_SESSION['PartnerFilters'] = $_POST['search_form'];
}

// --------------------------------------------------------------
// usunięcie filtrów z sesji
// --------------------------------------------------------------

if ($_REQUEST['action'] == "ClearSearch") {
	unset($_SESSION['PartnerFilters']);
}

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
		$url_config['3'] = 1;
	}
	
	//Jesli powrót do listy po jakiejś akcji
	if ($_REQUEST['action'] == "reindex"){
		
		$url_config['4'] = 1;
		$url_config['3'] = 1;
		
		
	}

	
	if (isset($_SESSION['PartnerFilters'])) {
		
		$_SESSION['PartnerFilters']['category_id'] = $url_config['3'];
		
		// jeżeli są w sesji ustawione filtry, to zawsze pokazujemy listę przefiltrowaną
		$partners_list = $partner->getPartnersSearch($_SESSION['PartnerSetOrder'], $_SESSION['PartnerSetDirection'], $_SESSION['PartnerFilters'], $url_config['4'], $_SESSION['lang']);
		$smarty->assign("set_filter", "1");
		//echo"tak";
		
	}
	else {
		
		if($_SESSION['admin_data']['level'] == 2){
			$partners_list = $partner->getPartners($_SESSION['PartnerSetOrder'], $_SESSION['PartnerSetDirection'], $url_config['4'], $url_config['3'], $_SESSION['lang']);
		}
		else{
			$partners_list = $partner->getPartnersByWtz($_SESSION['PartnerSetOrder'], $_SESSION['PartnerSetDirection'], $url_config['4'], $url_config['3'], $_SESSION['lang'], $_SESSION['admin_data']['wtz']);
		}
	}
	
	
	 //print_r($partners_list);
	
	// wersje językowe do interfejsu
	
	require_once('Language.class.php');
	$language = new Language();
	$languages_list = $language->getLanguages();
	//print_r($languages_list);
	
	$template = "partner_list.tpl";
	$smarty->assign("partners_list", $partners_list);
	$smarty->assign("languages_list", $languages_list);
	$smarty->assign("category_id", $url_config['3']);
	$smarty->assign("paging", $partner->paging);
}


// --------------------------------------------------------------
// nowy artykuł
// --------------------------------------------------------------

if ($url_config['2'] == "new") {
	
	// edytor WYSIWYG
	require_once('spaw/spaw_control.class.php');
	if($_SESSION['admin_data']['level'] == 1){
		$sw = new SPAW_Wysiwyg('partner_form[content]' /*name*/, '' /*value*/,
	                   'pl' /*language*/, 'mini' /*toolbar mode*/, '' /*theme*/,
	                   '400px' /*width*/, '400px' /*height*/);
	}
	elseif($_SESSION['admin_data']['level'] == 2){
		$sw = new SPAW_Wysiwyg('partner_form[content]' /*name*/, '' /*value*/,
	                   'pl' /*language*/, 'default' /*toolbar mode*/, '' /*theme*/,
	                   '400px' /*width*/, '400px' /*height*/);		
		
	}
	$sSpaw = $sw->getHtml();
	
	// wersje językowe do interfejsu
	/*
	require_once('Language.class.php');
	$language = new Language();
	$languages_list = $language->_all_languages;
	*/
	
	$template = "partner_edit.tpl";
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
	$partner_details = $partner->getPartner($url_config['3'], $url_config['4']);

	
	// edytor WYSIWYG
	require_once('spaw/spaw_control.class.php');
	
	if($_SESSION['admin_data']['level'] == 1){
		$sw = new SPAW_Wysiwyg('partner_form[content]' /*name*/, $partner_details['content'] /*value*/,
	                   'pl' /*language*/, 'mini' /*toolbar mode*/, '' /*theme*/,
	                   '400px' /*width*/, '400px' /*height*/);
	}
	elseif($_SESSION['admin_data']['level'] == 2){
		$sw = new SPAW_Wysiwyg('partner_form[content]' /*name*/, $partner_details['content'] /*value*/,
	                   'pl' /*language*/, 'default' /*toolbar mode*/, '' /*theme*/,
	                   '400px' /*width*/, '400px' /*height*/);		
		
	}
	$sSpaw = $sw->getHtml();
	
	// print_r($sw);
	
	// wersje językowe do interfejsu
	
	require_once('Language.class.php');
	$language = new Language();
	$languages_list = $language->getLanguages();
	//print_r($languages_list);
	
	$template = "partner_edit.tpl";
	$smarty->assign("partner", $partner_details);
	$smarty->assign("language_id", $partner_details['language_id']);
	$smarty->assign("languages_list", $languages_list);
	$smarty->assign('sSpaw', $sSpaw);
	//print_r($languages_list);
}

// --------------------------------------------------------------
// dane artykułu - to może być wykorzystywane tylko w podglądzie?
// --------------------------------------------------------------

if ($_REQUEST['action'] == "DetailView") {
	
	// dane do przeglądania
	$partner_details = $partner->getPartnerDetails($_REQUEST['PartnerId'], $_REQUEST['LanguageId']);

	// print_r($partner_details);
	
	$template = "partner_details.tpl";
	$smarty->assign("partner", $partner_details);
}

?>