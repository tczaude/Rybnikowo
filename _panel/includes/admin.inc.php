<?php
require_once('Admin.class.php');
$admin = new Admin();






// print_r($_POST);

// --------------------------------------------------------------
// logout admin
// -------------------------------------------------------------- 

if ($_REQUEST['action'] == "LogoutAdmin") {
    
    // usuwamy dane usera z sesji
    unset($_SESSION['admin_data']);
    
    // i kierujemy się na stronę główną
    header('Location: /_panel/');
}
 

if (sizeof($_SESSION['admin_data'])) {
	
	$smarty->assign("admin_data", $_SESSION['admin_data']);
}


// --------------------------------------------------------------
// 
// --------------------------------------------------------------

if($_POST['search_form']) {
	$smarty->assign("ret_post_search", $_POST['search_form']);
}

// --------------------------------------------------------------
// ustawia użytkownika jako aktywnego/nieaktywnego
// --------------------------------------------------------------

if ($url_config['2'] == "status") {
	
	$admin->setStatus($url_config['3'], $url_config['4']);
	$_REQUEST['action'] = "index";
}


// --------------------------------------------------------------
// zapisanie admina
// --------------------------------------------------------------

if ($_REQUEST['action'] == "SaveAdmin") {
			
	if (!sizeof($error)) {
	
		$admin_id = $admin->saveAdmin($_POST['admin']);

		
		$smarty->assign("close", "1");
		$smarty->assign("location", $path."/admin");
		
	}
}
// --------------------------------------------------------------
// usunięcie użytkownika
// --------------------------------------------------------------

if ($url_config['2'] == "remove") {
	$admin->removeAdmin($url_config['3']);
	$_REQUEST['action'] = "index";
}



// --------------------------------------------------------------
// edycja admina
// --------------------------------------------------------------

if ($url_config['2'] == "edit") {
	//print_r($url_config);
	// dane do edycji
	$admin_details = $admin->getAdmin($url_config['3']);
	
	$smarty->assign("admin", $admin_details);
	$template = "admin_edit.tpl";

}

// --------------------------------------------------------------
// nowy admin
// --------------------------------------------------------------

if ($url_config['2'] == "new") {
	//print_r($url_config);
	// dane do edycji
	
	
	$smarty->assign("admin", $admin_details);
	$template = "admin_edit.tpl";

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
	
	$_SESSION['AdminSetOrder'] = $set_sort['0'];
	$_SESSION['AdminSetDirection'] = $set_sort['1'];
}
else {
	// domyślne ustawienia
	$_SESSION['AdminSetOrder'] = "surname";
	$_SESSION['AdminSetDirection'] = "asc";
}
$smarty->assign("sort_order", $_SESSION['AdminSetOrder']);

// uwaga! do szablonu ustawiamy przeciwny sposób sortowania (dla wybranego pola wg. którego sortujemy)
$sort_direction = ($_SESSION['AdminSetDirection'] == "asc")?"desc":"asc";
$smarty->assign("sort_direction", $sort_direction); 

// --------------------------------------------------------------
// ustawienie filtrów w sesji
// --------------------------------------------------------------

if ($_REQUEST['action'] == "Search") {
	$_SESSION['AdminFilters'] = $_POST['search_form'];
	$_REQUEST['admin_page_number'] = 1;
}

// --------------------------------------------------------------
// usunięcie filtrów z sesji
// --------------------------------------------------------------

if ($_REQUEST['action'] == "ClearSearch") {
	unset($_SESSION['AdminFilters']);
}

// -------------------------------------------------------
// lista użytkowników
// -------------------------------------------------------

if ($_REQUEST['action'] == "index" || !$url_config['2'] || $_REQUEST['action'] == "Search" || $_REQUEST['action'] == "ClearSearch") {
	
	// ustawienie numeru strony do stronicowania (jezeli nie została podana)
	if (!isset($_REQUEST['admin_page_number'])) {
		$_REQUEST['admin_page_number'] = 1;
	}
	
	// zawsze ustawiony musi być w filtrach język - to jest związane z rozdzieleniem administracji na poszczególne kraje
	$_SESSION['AdminFilters']['language'] = $_SESSION['admin_data']['language'];
	
	$admin_list = $admin->getAdmins($_SESSION['AdminSetOrder'], $_SESSION['AdminSetDirection'], $_REQUEST['admin_page_number']);
	//print_r($admin_list);
	$smarty->assign("admin_list", $admin_list);
	$smarty->assign("paging", $admin->paging);
}

// -------------------------------------------------------
// zabezpieczenie przed brakiem nazwy działu
// -------------------------------------------------------

if (!$nazwa_dzialu) {
	$smarty->assign('nazwa_dzialu', $dict_templates['Admins']);
}
else {
	$smarty->assign('nazwa_dzialu', $nazwa_dzialu);
}
?>