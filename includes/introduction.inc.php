<?php

// -------------------------------------------
// Wstawianie konkretnego artykułu
// -------------------------------------------
if ($intro_main) {
	require_once('Article.class.php');
	$article = new Article();
	$intro_main = $article->getArticle($intro_main, $_SESSION['lang']);
	$smarty->assign('intro_main', $intro_main);
}

// -------------------------------------------
// na prawą kolumnę
// -------------------------------------------
if ($intro_right) {
	require_once('Article.class.php');
	$article = new Article();
	$intro_right = $article->getArticle($intro_right, $_SESSION['lang']);
	$smarty->assign('intro_right', $intro_right);

}

// -------------------------------------------
// na lewą kolumnę
// -------------------------------------------
if ($intro_left) {
	require_once('Article.class.php');
	$article = new Article();
	$intro_left = $article->getArticle($intro_left, $_SESSION['lang']);
	$smarty->assign('intro_left', $intro_left);
}




?>