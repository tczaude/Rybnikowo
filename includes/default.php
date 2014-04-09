<?php
//----------------------------------------------------
// Zabezpieczenie kiedy wpisywany jest adres bez www
//----------------------------------------------------

	//print_r($_SERVER['HTTP_HOST']);
	
	if($_SERVER['HTTP_HOST'] == "www.rybnikowo.pl"){
		
		header("Location: http://rybnikowo.pl");
		
		
	}
//error_reporting(E_ALL); 
//----------------------------------------------------
//Konfig podstawowy
//----------------------------------------------------
	

	require_once('./config/config.php');
	
	session_start();
	ini_set('session.gc_maxlifetime', '3600' );
	//phpinfo();
	//print_r($_GET);
	// obsługa wielojęzyczności
	require_once($__CFG['base_path'].'/includes/language.php');
	
	// dołaczamy odpowiedni słownik i przekazujemy parametry do smartów
	require_once($__CFG['base_path'].'/includes/lang/dict_'.$language_details['short'].'.php');
	$smarty->assign('dict_templates', $dict_templates);
	$smarty->assign('dict_reports', $dict_reports);
	$smarty->assign('dict_errors', $dict_errors);
	$smarty->assign("dict_menu", $dict_menu);

	
//-----------------------------------------------------
//Artykuły
//-----------------------------------------------------

	require_once('Article.class.php');
	$article = new Article();
	
	$message_intro = $article->getArticle(30, 1);
	$smarty->assign("message_intro", $message_intro);
	//print_r($message_intro);
	
//-----------------------------------------------------
// obsługa użytkowników
//-----------------------------------------------------	
	
	require_once($__CFG['base_path'].'/includes/user.inc.php');
	

	
	
//----------------------------------------------------
//Obsługa przyjaznych url
//----------------------------------------------------

	
	$arrParams = array();
	$strDefaultPath = '/index';
	$_SERVER['REQUEST_URI'] = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : $strDefaultPath;
	$arrParams = explode( '/', substr( $_SERVER['REQUEST_URI'], 1) );
	
	$url_config = $arrParams;
	if($_SERVER['REQUEST_URI'] == '/'){
		
		$_SERVER['REQUEST_URI'] = 'index';
		$url_config['0'] = $_SERVER['REQUEST_URI'];
		
	}
	
	$smarty->assign("url_config", $url_config);
	
	
	
//--------------------------------------------
// obsługa newslleterów
//--------------------------------------------
require_once($__CFG['base_path'].'includes/newsletter.inc.php');

	
	//Ostatni wpis na blogu
	require_once('Blog.class.php');
	$blog = new Blog();
	$panel_blog = $blog->getBlogsByView("order", "desc", 3, 1, 1);
	//print_r($blog_list);
	$smarty->assign("panel_blog", $panel_blog);
	

	
	
//------------------------------
// Obrazki
//------------------------------
	 
	//print_r($__CFG['base_url']);
	$default_path = $__CFG['base_url'];
	$smarty->assign("DP", $default_path);
	

//---------------------------------------------
// menu z kategoriami produktowymi
//---------------------------------------------
	require_once($__CFG['base_path'].'/includes/menu.inc.php');
	//print_r($_SESSION['auction']);

	//Adres ip usera
	$smarty->assign("user_ip", $_SERVER['REMOTE_ADDR']);
	//Like butto script uri
	$smarty->assign("current_like", $_SERVER['SCRIPT_URI']);

	
	//Slajdy
	require_once('Slideshow.class.php');
	$slideshow = new Slideshow();
	$slideshow_list = $slideshow->getSlideshowsByCategoryToView(3, 1, 1, 1);
	//print_r($slideshow_list);
	$smarty->assign("slideshow_list", $slideshow_list);	
	
	
	//Import użytkowanika z smartserwis.net - podłączamy bazę zdalną
	if ($url_config['0'] == "GetUser"){
	
		global $DBM2;
		$DBM2 = new DBManager($__DB_CFG2['uri']);	
		
	}

?>