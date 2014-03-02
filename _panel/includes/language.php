<?php
/**
 * obsługa języka w serwisie wielojęzycznym
 */
require_once ('Language.class.php');

// print_r($_SESSION);
// print_r($_COOKIE);

if ($_SESSION['admin_data']['language']) {
	$_SESSION['admin_lang'] = $_SESSION['admin_data']['language'];
}
else {
	$_SESSION['admin_lang'] = 1;
}

$lang_id = $_SESSION['admin_lang'];

// global $Lang;

// pomimo wczesniejszego sprawdzania user może być po prostu pierwszy raz 
// więc jeżeli $lang_id bedzie pusty to mu sie ustawi domyslny język 

$language = new Language();
$language_details = $language->getLanguage($lang_id);
$smarty->assign('admin_lang', $language_details['short']);

// i jeszcze lista wszystkich języków
$language_list = $language->getLanguages();
$smarty->assign('language_list', $language_list);

// print_r($language_list);

?>