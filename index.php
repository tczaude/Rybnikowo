<?php

	include('includes/default.php');
	
	if(!$_SESSION['active']){
		
		$_SESSION['active'] = 1;
		$smarty->assign("active_session", 1);		
		
	}
	
	
// -------------------------------------------------------
// Powiadomienia
// -------------------------------------------------------

	//Powodzenie
	if($_SESSION['message']['good_message']){
		
		$smarty->assign("good_message", $_SESSION['message']['good_message']);
		unset($_SESSION['message']['good_message']);
		
	}
	
	//Błąd
	if($_SESSION['message']['bad_message']){
		
		$smarty->assign("bad_message", $_SESSION['message']['bad_message']);
		unset($_SESSION['message']['bad_message']);
		
	}	


//------------------------------------------------
//	Homepage
//------------------------------------------------	
	if($url_config['0'] == "index"){
	
		include('includes/index.inc.php');
		
		$smarty->assign("script", "index");
		
		//Tytuły meta
		$head = array();
		$head['title'] = "Strona główna";
		$smarty->assign("head", $head);
				
		//Definiujemy widok okna głównego
		$main = "main_home.tpl";
		
		//Przekazujemy go do smarty
		$smarty->assign("main", $main);
		$smarty->display("index.tpl");
		
		
	}	

//------------------------------------------------		
//	Regulamin
//------------------------------------------------	
	elseif($url_config['0'] == "regulamin"){
	
		include('includes/index.inc.php');
		
		//Tytuły meta
		$head = array();
		$head['title'] = "Regulamin";
		$smarty->assign("head", $head);	
		
		$main = "main_article.tpl";
		$smarty->assign("main", $main);
		$smarty->display("aticle.tpl");
		
	}	

//------------------------------------------------
//	Blog
//------------------------------------------------	
	
	elseif($url_config['0'] == "blog"){
	

		include('includes/blog.inc.php');
		$smarty->display("blog.tpl");

		
	}

//------------------------------------------------
//	Partnerzy
//------------------------------------------------	
	
	elseif($url_config['0'] == "partner"){
	

		include('includes/partner.inc.php');
		$smarty->display("partner.tpl");

		
	}
//------------------------------------------------		
//	O nas
//------------------------------------------------	
	elseif($url_config['0'] == "o-nas"){
	
		include('includes/about.inc.php');
		
		//Tytuły meta
		$head = array();
		$head['title'] = "O nas";
		$smarty->assign("head", $head);	
		
		$main = "main_article.tpl";
		$smarty->assign("main", $main);
		$smarty->display("article.tpl");
		
	}	


//------------------------------------------------		
//	Dla firm
//------------------------------------------------	
	elseif($url_config['0'] == "dla-firm"){
	
		include('includes/dlafirm.inc.php');
		
		//Tytuły meta
		$head = array();
		$head['title'] = "Dla firm";
		$smarty->assign("head", $head);	
		
		$main = "main_article.tpl";
		$smarty->assign("main", $main);
		$smarty->display("article.tpl");
		
	}	
//------------------------------------------------		
//	Kontakt
//------------------------------------------------	
	elseif($url_config['0'] == "kontakt"){
	
		include('includes/contact.inc.php');
		$smarty->assign("script", "kontakt");
		
		//Tytuły meta
		$head = array();
		$head['title'] = "Kontakt";
		$smarty->assign("head", $head);	
		
		
		$main = "main_contact.tpl";
		$smarty->assign("main", $main);
		$smarty->display("contact.tpl");
		
	}
		
//------------------------------------------------
//	Dunamiczne wyszukiwanie
//------------------------------------------------	
	
	elseif($url_config['0'] == "suggest"){
	
	
		include('includes/suggest.inc.php');
		$template = "suggest.tpl";
		$smarty->display($template);
		
	}
	
//------------------------------------------------
//	Wyszukiwanie
//------------------------------------------------	
	
	elseif($url_config['0'] == "szukaj"){
	
		//Tytuły meta
		$head = array();
		$head['title'] = "Wyniki wyszukiwania";
		$smarty->assign("head", $head);		
		include('includes/search.inc.php');
		$main = "main_search.tpl";
		$smarty->assign("main", $main);
		$smarty->display("szukaj.tpl");
		
	}
	
//------------------------------------------------
//	Mapa witryny
//------------------------------------------------	
	
	elseif($url_config['0'] == "sitemap.xml"){
	
	
		include('includes/sitemap.inc.php');
		$smarty->display("sitemap.tpl");
		
	}
	
//------------------------------------------------
//	Kategoria wg typu
//------------------------------------------------	
	
	elseif($url_config['0'] == "kategoria"){
	
	
		include('includes/category.inc.php');

		$smarty->display($template);
		
	}
	
//------------------------------------------------
//	Firma
//------------------------------------------------	
	
	elseif($url_config['0'] == "firma"){
	
	
		include('includes/product.inc.php');
	
		//nazwa skryptu do widoku dla menu
		$smarty->assign("_katalog", "1");
		$smarty->display($template);
		
	}

//------------------------------------------------
//	Generowanie obrazka
//------------------------------------------------	
	
	elseif($url_config['0'] == "captcha"){
	
	
		include('includes/captcha.inc.php');
		
		
		
	}
//------------------------------------------------
//	Administarcja
//------------------------------------------------
	/*
	elseif($url_config['0'] == "admin"){
	
	
		header("Location: /_panel/");
		
	}	
	*/
	
	
	else{
		
		
		
		$smarty->assign("error_heading", "404 Page Not Found");
		$smarty->assign("error_message", "The page you requested was not found.");
		
		$template = "errors/error_general.tpl";
		$smarty->display($template);
		
		
	
	
	
	}
	




?>