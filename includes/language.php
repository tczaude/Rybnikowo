<?php
/**
 * obsługa języka w serwisie wielojęzycznym
 */
require_once ('Language.class.php');

// print_r($_SESSION);
// print_r($_COOKIE);

if ($_GET['lang']) {
	// próba ustawenia języka przez user-a
	$lang_id = $_GET['lang'];
} else {
	if (!$_SESSION['lang']) {
		// sprawdzamy cookiesa - nie ma w sesji więc to może być pierwsza  wizyta lub powrót
		if ($_COOKIE['lang']) {
			$lang_id = $_COOKIE['lang'];
		} 
	} else {
		$lang_id = $_SESSION['lang'];
	}
}




// global $Lang;

// pomimo wcześniejszego sprawdzania user może być po prostu pierwszy raz 
// więc jeżeli $lang_id bedzie pusty to mu sie ustawi domyślny język 

$language = new Language();
$language_details = $language->getLanguage($lang_id);
$smarty->assign('lang', $language_details['short']);

// i jeszcze lista wszystkich języków
$language_list = $language->getLanguages();
//print_r($language_list);
$smarty->assign('language_list', $language_list);
$smarty->assign("active_lang", $_SESSION['lang']);

?>