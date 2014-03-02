<?php

require_once('Article.class.php');
$article = new Article();

// sprawdzamy czy podany jest konkretny artykuł
if ($_REQUEST['ArticleId']) {
	
	// jest, a więc na pewno chcemy szczegółów artykułu
	$article_details = $article->getArticle($_REQUEST['ArticleId'], $_SESSION['lang']);
	$smarty->assign("article", $article_details);
	
	// print_r($article_details);
	
	$smarty->assign("CategoryId", $article_details['category_id']);
	
	// --------------------------------------
	// wysyłka artykułu mailem 
	// --------------------------------------
	
	if ($_REQUEST['action'] == "SendArticleByEmail") {
		$article_sent = $article->sendArticleByEmail($article_details, $_REQUEST['email']);
		
		if ($article_sent) {
			$smarty->assign("message", $dict_message[41]);
		}
	}
	
	// --------------------------------------
	// drukowanie artykułu
	// --------------------------------------
	
	if ($_REQUEST['action'] == "PrintArticle") {
		$template = "print_article.tpl";
	}
	
	// template z konkretnym projektem
	$content = "article_details.tpl";
}
else {
	// nie ma konkretnego artykułu - musi to być więc lista artykułów w podanej kategorii
	if ($_REQUEST['CategoryId']) {
		
		if (!isset($_REQUEST['news_page_number'])) {
			$_REQUEST['news_page_number'] = 1;
		}
		
		$_SESSION['ArticleFilters']['category_id'] = $_REQUEST['CategoryId'];
		
		// ustawiamy inną niż w administracji ilośc elementów na stronę
		$__CFG['record_count_limit'] = 10;
		
		$article_list = $article->getArticlesSearch("order", "desc", $_SESSION['ArticleFilters'], $_REQUEST['news_page_number'], $_SESSION['user_data']['language']);
		
		$smarty->assign("article_list", $article_list);
		$smarty->assign("paging", $article->paging);
		
		//print_r($article_list);
		
		$smarty->assign("CategoryId", $_REQUEST['CategoryId']);
			
		// template z listą artykułów
		$content = "article_list.tpl";
	}
	else {
		
		// nie ma konkretnej kategorii - przekazujemy sterowanie na główną stronę serwisu
		header("Location: index.php?section=1");
		exit();
	}
}
?>