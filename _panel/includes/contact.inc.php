<?php

require_once('Contact.class.php');
$contact = new Contact();

// print_r($__CFG);

// --------------------------------------------------------------
// 
// --------------------------------------------------------------

if($_POST['contact_form']) {
	$smarty->assign("ret_post", $_POST['contact_form']);
}

// --------------------------------------------------------------
// 
// --------------------------------------------------------------

if($_POST['search_form']) {
	$smarty->assign("ret_post_search", $_POST['search_form']);
}

// --------------------------------------------------------------
// remove contact
// --------------------------------------------------------------

if ($url_config['2'] == "delete") {
	
	// removing contact
	$contact->removeContact($url_config['3']);
	
	$_REQUEST['action'] = "index";
}

// --------------------------------------------------------------
// set sorting in session
// --------------------------------------------------------------

if ($_REQUEST['SetSort']) {
	$set_sort = explode(",",$_REQUEST['SetSort']);
	
	$_SESSION['ContactSetOrder'] = $set_sort['0'];
	$_SESSION['ContactSetDirection'] = $set_sort['1'];
}
else {
	// default settings
	$_SESSION['ContactSetOrder'] = "date_created";
	$_SESSION['ContactSetDirection'] = "desc";
}
$smarty->assign("sort_order", $_SESSION['ContactSetOrder']);

// warning! in template we're setting opposite sorting direction
$sort_direction = ($_SESSION['ContactSetDirection'] == "asc")?"desc":"asc";
$smarty->assign("sort_direction", $sort_direction); 

// --------------------------------------------------------------
// set filters in session
// --------------------------------------------------------------

if ($_REQUEST['action'] == "Search") {
	$_SESSION['ContactFilters'] = $_POST['search_form'];
}

// --------------------------------------------------------------
// remove filters from session
// --------------------------------------------------------------

if ($_REQUEST['action'] == "ClearSearch") {
	unset($_SESSION['ContactFilters']);
}

// --------------------------------------------------------------
// contacts list
// --------------------------------------------------------------

if (!$_REQUEST['action'] || $_REQUEST['action'] == "index" || $_REQUEST['action'] == "Search" || $_REQUEST['action'] == "ClearSearch") {
	
	// set default page number (if not set)
	if (!isset($_REQUEST['contact_page_number'])) {
		$_REQUEST['contact_page_number'] = 1;
	}
	
	if (isset($_SESSION['ContactFilters'])) {
		
		// if there are filters set in session, always show filtered list
		$contacts_list = $contact->getContactsSearch($_SESSION['ContactSetOrder'], $_SESSION['ContactSetDirection'], $_SESSION['ContactFilters'], $_REQUEST['contact_page_number']);
		$smarty->assign("set_filter", "1");
	}
	else {
		$contacts_list = $contact->getContacts($_SESSION['ContactSetOrder'], $_SESSION['ContactSetDirection'], $_REQUEST['contact_page_number']);
	}
	
	 //print_r($contacts_list);
	
	$template = "contact_list.tpl";
	$smarty->assign("contact_list", $contacts_list);
	$smarty->assign("paging", $contact->paging);
}
?>
