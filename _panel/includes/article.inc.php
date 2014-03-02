<?php

require_once('Article.class.php');
$article = new Article();

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

			
			$article->updateOrders($item, $key);
			
		}

		$smarty->assign("good_message", "Kolejność została ustalona");
		
		$smarty->display("good_message.tpl");

	}		
	
	exit;

}

// --------------------------------------------------------------
// zwracamy zawartość formularza edycji do widoku
// --------------------------------------------------------------

if($_POST['article_form']) {
	$smarty->assign("ret_post", $_POST['article_form']);
	
	//print_r($_POST['article_form']);
}

// --------------------------------------------------------------
// zwracamy zawartość formularza wyszukiwania do widoku
// --------------------------------------------------------------

if($_POST['article_form']) {
	$smarty->assign("ret_post_search", $_POST['article_form']);
}

// --------------------------------------------------------------
// ustawienie filtrów w sesji - dla wyszukiwania artykułów
// --------------------------------------------------------------

if ($_REQUEST['action'] == "SearchArticle") {
	$_SESSION['ArticleFilters'] = $_POST['article_form'];
}

// --------------------------------------------------------------
// usunięcie filtrów z sesji
// --------------------------------------------------------------

if ($url_config['2'] == "clear") {
	unset($_SESSION['ArticleFilters']);
	header("location: /_panel/article/index");
}



// --------------------------------------
// wysyłka artykułu mailem 
// --------------------------------------

if ($url_config['2'] == "send") {
	
	$article_details = $article->getArticleDetails($url_config['3'], $_SESSION['admin_data']['language']);
	
	require_once('Newsletter.class.php');
	$newsletter = new Newsletter();
	
	$subscriber_list = $newsletter->getSubscribers($_SESSION['admin_data']['language'], 1);
	
	
	if($subscriber_list){
		
		foreach($subscriber_list as $subs){
			
			$article_details['sub_details'] = $subs;
			
			
			$article_sent = $article->sendArticleByEmail($article_details, $subs['email']);
			
		}
		
		
		
	}
	
	
	//print_r($subscriber_list);

	if ($article_sent) {
		//Oznaczamy artykuł jako wyslany
		$article->setSended($article_details['article_id']);
		
	$_SESSION['message']['good_message'] = "Artykuł został wysłany";
	header("location: /_panel/article/index/".$article_details['category_id']);
	}
}


// --------------------------------------------------------------
// ustawia jako aktywny/nieaktywny
// --------------------------------------------------------------
//print_r($url_config);



if ($url_config['2'] == "status") {
	
	//Najpierw wyciagamy dane o artykule
	$article_details = $article->getArticle($url_config['3'], $_SESSION['admin_data']['language']);
	//print_r($article_details);
	
	$article->setStatus($url_config['3'], $url_config['4'], $_SESSION['admin_data']['language']);
	//print_r($_REQUEST['action']);

	
	$_SESSION['message']['good_message'] = "Status został zmieniony";
	header("location: /_panel/article/index/".$article_details['category_id']);
	
}

// --------------------------------------------------------------
// usunięcie artykułu
// --------------------------------------------------------------

if ($url_config['2'] == "remove" ) {
	
	//Najpierw wyciagamy dane o artykule
	$article_details = $article->getArticle($url_config['3'], $_SESSION['admin_data']['language']);	
	
	// usuwamy artykuł
	$article->removeArticle($url_config['3']);
	
	$_SESSION['message']['good_message'] = "Artykuł został usunięty";
	header("location: /_panel/article/index/".$article_details['category_id']);	
	
}

// --------------------------------------------------------------
// zapisanie artykułu
// --------------------------------------------------------------

if ($_REQUEST['action'] == "SaveArticle") {
	
	// echo "save article";
	
	if (1) {
		if (isset($_POST['article_form'])) {
			
				
					
	
			//Walidacja url_name
			require_once('validate_save_article.inc.php');
					
			if (!sizeof($error)) {			
			
			
				// zapisujemy artykuł
				$ArticleId = $article->saveArticle($_POST['article_form']);
				
				if(!$_POST['article_form']['article_id']){
					
					$_SESSION['message']['good_message'] = "Artykuł został pomyślnie dodany";
				}
				else{
					
					$_SESSION['message']['good_message'] = "Artykuł został pomyślnie zapisany";
				}
				
				
				
				
				
				header("location: /_panel/article/index/".$_POST['article_form']['category_id']);
			
			
				
			}
			//Błędy
			else{
				
				$smarty->assign("error", $error['article']);
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
	$kolejnosc = new Order('article','id', 'order', 'category_id', $url_config['4']);
	$kolejnosc->down($url_config['3']);
	$url_config['3'] = $url_config['4'];
	$_REQUEST['action'] = "reindex";
}

if($url_config['2'] == "down" && $url_config['3'] && $url_config['4']) {
	require_once('Order.class.php');
	$kolejnosc = new Order('article','id', 'order', 'category_id', $url_config['4']);
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
	
	$_SESSION['ArticleSetOrder'] = $set_sort['0'];
	$_SESSION['ArticleSetDirection'] = $set_sort['1'];
}
else {
	// domyślne ustawienia
	$_SESSION['ArticleSetOrder'] = "order";
	$_SESSION['ArticleSetDirection'] = "asc";
}
$smarty->assign("sort_order", $_SESSION['ArticleSetOrder']);

// uwaga! do szablonu ustawiamy przeciwny sposób sortowania (dla wybranego pola wg. którego sortujemy)
$sort_direction = ($_SESSION['ArticleSetDirection'] == "asc")?"desc":"asc";
$smarty->assign("sort_direction", $sort_direction); 



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
		
		//jest juz poprzednia
		if(!$_SESSION['ArticleCategoryId']){
		
			$_SESSION['ArticleCategoryId'] = 1;
		}
	}
	//zostala podana
	else{
		
		$_SESSION['ArticleCategoryId'] = $url_config['3'];
			
	}
	
	
	//Jesli powrót do listy po jakiejś akcji
	if ($_REQUEST['action'] == "reindex"){
		
		$url_config['4'] = 1;
		
		
		
	}

	
	if (isset($_SESSION['ArticleFilters'])) {
		
		$_SESSION['ArticleFilters']['category_id'] = $_SESSION['ArticleCategoryId'];
		
		// jeżeli są w sesji ustawione filtry, to zawsze pokazujemy listę przefiltrowaną
		$articles_list = $article->getArticlesSearch($_SESSION['ArticleSetOrder'], $_SESSION['ArticleSetDirection'], $_SESSION['ArticleFilters'], $url_config['4'], $_SESSION['lang']);
		$smarty->assign("set_filter", "1");
		
		$smarty->assign("ret_filters", $_SESSION['ArticleFilters']);
	}
	else {
		$articles_list = $article->getArticles($_SESSION['ArticleSetOrder'], $_SESSION['ArticleSetDirection'], $url_config['4'], $_SESSION['ArticleCategoryId'], $_SESSION['lang']);
	
	}
	
	
	 //print_r($articles_list);
	
	// wersje językowe do interfejsu
	
	require_once('Language.class.php');
	$language = new Language();
	$languages_list = $language->getLanguages();
	//print_r($languages_list);
	
	$template = "article_list.tpl";
	$smarty->assign("articles_list", $articles_list);
	$smarty->assign("akcja", "article_list");
	$smarty->assign("languages_list", $languages_list);
	$smarty->assign("category_id", $_SESSION['ArticleCategoryId']);
	$smarty->assign("paging", $article->paging);
}


// --------------------------------------------------------------
// nowy artykuł
// --------------------------------------------------------------

if ($url_config['2'] == "new") {
	
	// edytor WYSIWYG
	require_once('spaw/spaw_control.class.php');
	$sw = new SPAW_Wysiwyg('article_form[content]' /*name*/, '' /*value*/,
                   'pl' /*language*/, 'default' /*toolbar mode*/, '' /*theme*/,
                   '400px' /*width*/, '400px' /*height*/);
	$sSpaw = $sw->getHtml();
	
	// wersje językowe do interfejsu
	/*
	require_once('Language.class.php');
	$language = new Language();
	$languages_list = $language->_all_languages;
	*/
	
	$template = "article_edit.tpl";
	
	$smarty->assign("akcja", "article_edit");
	
	$smarty->assign("category_id", $_SESSION['ArticleCategoryId']);
	$smarty->assign("language_id", 1);
	// $smarty->assign("languages_list", $languages_list);
	$smarty->assign('sSpaw', $sSpaw);
}

// --------------------------------------------------------------
// edycja artykułu
// --------------------------------------------------------------

if ($url_config['2'] == "edit") {
	//print_r($url_config);
	// dane do edycji
	$article_details = $article->getArticle($url_config['3'], $url_config['4']);

	
	// edytor WYSIWYG
	require_once('spaw/spaw_control.class.php');
	$sw = new SPAW_Wysiwyg('article_form[content]' /*name*/, $article_details['content'] /*value*/,
                   'pl' /*language*/, 'default' /*toolbar mode*/, '' /*theme*/,
                   '200px' /*width*/, '400px' /*height*/);
	$sSpaw = $sw->getHtml();
	
	 //print_r($article_details);
	
	// wersje językowe do interfejsu
	
	require_once('Language.class.php');
	$language = new Language();
	$languages_list = $language->getLanguages();
	//print_r($languages_list);
	
	$template = "article_edit.tpl";
	$smarty->assign("article", $article_details);
	$smarty->assign("language_id", $article_details['language_id']);
	$smarty->assign("languages_list", $languages_list);
	$smarty->assign('sSpaw', $sSpaw);
	$smarty->assign("category_id", $_SESSION['ArticleCategoryId']);
	$smarty->assign("akcja", "article_edit");
	//print_r($languages_list);
}

// --------------------------------------------------------------
// dane artykułu - to może być wykorzystywane tylko w podglądzie?
// --------------------------------------------------------------

if ($_REQUEST['action'] == "DetailView") {
	
	// dane do przeglądania
	$article_details = $article->getArticleDetails($_REQUEST['ArticleId'], $_REQUEST['LanguageId']);

	// print_r($article_details);
	
	$template = "article_details.tpl";
	$smarty->assign("article", $article_details);
}

//Przekazujemy info o domyslnej kategorii
if($_SESSION['ArticleCategoryId']){
	
	$smarty->assign("CategoryId", $_SESSION['ArticleCategoryId']);
	
}
else{
	
	$smarty->assign("CategoryId", 1);
}



?>