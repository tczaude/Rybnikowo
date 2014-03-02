<?php
/*
 * Created on 2005-07-11
 *
 * standardowe parametry includowane w kazdym pliku 
 */

// print_r($_POST);

//----------------------------------------------------
// Zabezpieczenie kiedy wpisywany jest adres bez www
//----------------------------------------------------

	//print_r($_SERVER['HTTP_HOST']);
	
	if($_SERVER['HTTP_HOST'] == "rybnikowo.pl/_panel"){

		header("Location: http://www.rybnikowo.pl/_panel");
		
		
	}

//------------------------------------------------
// Raportowanie błędów
//------------------------------------------------ 

//error_reporting(E_ALL ^ E_NOTICE);
/*
ini_set('error_reporting', E_ALL ^ E_NOTICE);
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors',TRUE);
*/


//------------------------------------------------
// Konfig podstawowy
//------------------------------------------------ 

require_once('../config/config.php');

require_once($__CFG['base_path'].'/config/db.php');
require_once($__CFG['base_path'].'/config/mail.php');
require_once($__CFG['base_path'].'/config/smarty_admin.php');

require_once('database.class.php');
global $DBM;
$DBM = new DBManager($__DB_CFG['uri']);

//------------------------------------------------
// Sesja
//------------------------------------------------ 

session_start();
ini_set('session.gc_maxlifetime', '3600' );
//phpinfo();
//exit;

//------------------------------------------------ 
// obsługa wielojęzyczności
//------------------------------------------------ 
require_once($__CFG['base_path'].'/_panel/includes/language.php');

//------------------------------------------------ 
// dołaczamy odpowiedni słownik i przekazujemy parametry do smartów
//------------------------------------------------ 
require_once($__CFG['base_path'].'/includes/lang/dict_'.$language_details['short'].'.php');
$smarty->assign('dict_templates', $dict_templates);
$smarty->assign('dict_reports', $dict_reports);
$smarty->assign('dict_errors', $dict_errors);

//-----------------------------------------------------
//Artykuły
//-----------------------------------------------------

	require_once('Article.class.php');
	$article = new Article();
	
	$message_intro = $article->getArticle(30, 1);
	$smarty->assign("message_intro", $message_intro);
	//print_r($message_intro);

//------------------------------------------------ 
// obsługa uzytkowników
//------------------------------------------------ 

require_once($__CFG['base_path'].'/_panel/includes/login.inc.php');


//------------------------------------------------ 
// dział do widoku
//------------------------------------------------ 
$smarty->assign('page', $page);

//------------------------------------------------
//Obsługa przyjaznych url
//------------------------------------------------

$arrParams = array();
$strDefaultPath = '/index';
$_SERVER['REQUEST_URI'] = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : $strDefaultPath;
$arrParams = explode( '/', substr( $_SERVER['REQUEST_URI'], 2) );

$url_config = $arrParams;
if($_SERVER['REQUEST_URI'] == '/'){
	
	$_SERVER['REQUEST_URI'] = 'index';
	$url_config['0'] = $_SERVER['REQUEST_URI'];
	
}
$smarty->assign("url_config", $url_config);



//------------------------------------------------
// Deault path
//------------------------------------------------
 
    
$path = "http://".$_SERVER['SERVER_NAME']."/_panel";
$smarty->assign("path", $path);
//print_r($url_config);



?>