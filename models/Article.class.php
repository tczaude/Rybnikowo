<?
/**
 * @copyright 
 * @author 
 * @see 
 *
 * obsłuha artykułów tekstowych w wersji wielojęzycznej
 *
 */

require_once 'Utils.class.php';

class Article {

	/**
	 * @var object DBManager
	 */
	var $DBM;

	function Article() {
		global $DBM;
	 	$this->DBM = $DBM;
	}
	
	/**
	 * pobiera listę artykułów (posortowaną)
	 */
	
	function getArticles($order = "order", $direction = "desc", $page_number = 1, $category_id = 1, $lang_id) {
		
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		if (!$category_id) $category_id = 1;
		
		$sql  = "select count(*) as ilosc from article, article_multilang where article_multilang.article_id = article.id and article.category_id = '$category_id' and article_multilang.language_id = '$lang_id'";
				
		$temp = $this->DBM->getRow($sql);
		$record_count = $temp['ilosc'];
		
		$sql  = "select article.category_id, article.order, article.pic_01, article_multilang.* from article, article_multilang where article_multilang.article_id = article.id and article.category_id = '$category_id' and article_multilang.language_id = '$lang_id' ";		
		$sql .= " order by article.`$order` $direction limit $offset, $limit ";
		
		// echo $sql."<hr>";
		
		$article_list_temp = $this->DBM->getTable($sql);
		
		// reindex array
		if (sizeof($article_list_temp)) {
			$article_list = array();
			foreach ($article_list_temp as $article_details) {
				$article_list[$article_details[article_id]] = $article_details;
			}
		}
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParameters($record_count, $page_number);
		}
		
		return $article_list;
	}
	
	/**
	 * Przestawia status 
	 */
	
	function setStatus ($article_id, $status) {
		
		if ($article_id) {
			
			$sql = "update article_multilang set status = '$status' where article_multilang.article_id = '$article_id' ";
			$this->DBM->modifyTable($sql);
			
		}
	}	
	
	/**
	 * Oznaczenie jako wysłany 
	 */
	
	function setSended ($article_id) {
		
		if ($article_id) {
			
			$sql = "update article_multilang set sended = '1' where article_multilang.article_id = '$article_id' ";
			$this->DBM->modifyTable($sql);
			
		}
	}	
		
	/**
	 * pobiera przefiltrowaną listę artykułów
	 */
	
	function getArticlesSearch($order = "order", $direction = "desc", $search_form = null, $page_number = 1, $lang_id) {
		
		
			// ustawienie numeru strony do stronicowania (jezeli nie została podana)
			if (!sizeof($_REQUEST['page_number'])) {
				$_REQUEST['page_number'] = 1;
			}		
		
		$page_number = $_REQUEST['page_number'];
		
		
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		$sql  = "select article.category_id, article.order, article.pic_01, article_multilang.* from article, article_multilang where article_multilang.article_id = article.id and article_multilang.language_id = '$lang_id' ";		
		$sql_count  = "select count(*) as ilosc from article, article_multilang where article_multilang.article_id = article.id and article_multilang.language_id = '$lang_id' ";
				
		if(sizeof($search_form)) {
			
			if ($search_form['category_id']) {
				$sql .= " AND article.category_id = ".$search_form['category_id']." ";
				$sql_count .= " AND article.category_id = ".$search_form['category_id']." ";
			}
			if ($search_form['title']) {
				$sql .= " AND lower(article_multilang.title) like lower('%".$search_form['title']."%') ";
				$sql_count .= " AND lower(article_multilang.title) like lower('%".$search_form['title']."%') ";
			}
			if ($search_form['abstract']) {
				$sql .= " AND lower(article_multilang.abstract) like lower('%".$search_form['abstract']."%') ";
				$sql_count .= " AND lower(article_multilang.abstract) like lower('%".$search_form['abstract']."%') ";
			}
			if ($search_form['content']) {
				$sql .= " AND lower(article_multilang.content) like lower('%".$search_form['content']."%') ";
				$sql_count .= " AND lower(article_multilang.content) like lower('%".$search_form['content']."%') ";
			}
			if ($search_form['status']) {
				$sql .= " AND article_multilang.status = ".$search_form['status']." ";
				$sql_count .= " AND article_multilang.status = ".$search_form['status']." ";
			}
			if ($search_form['date_created_from'] && $search_form['date_created_to']) {
				$sql .= " AND article_multilang.date_created between '".$search_form['date_created_from']."' and '".$search_form['date_created_to']."' ";
				$sql_count .= " AND article_multilang.date_created between '".$search_form['date_created_from']."' and '".$search_form['date_created_to']."' ";
			}
			if ($search_form['date_modified_from'] && $search_form['date_modified_to']) {
				$sql .= " AND article_multilang.date_modified between '".$search_form['date_modified_from']."' and '".$search_form['date_modified_to']."' ";
				$sql_count .= " AND article_multilang.date_modified between '".$search_form['date_modified_from']."' and '".$search_form['date_modified_to']."' ";
			}
		}
		
		$sql .= " order by article.`$order` $direction ";
		$sql .= " limit $offset, $limit ";
		
		// echo $sql;
		
		// ilośc wszystkich rekordów
		$temp = $this->DBM->getRow($sql_count);
		$record_count = $temp['ilosc'];
		
		// echo $record_count."<br>";
		
		$article_list_temp = $this->DBM->getTable($sql);
		
		// reindex array
		if (sizeof($article_list_temp)) {
			$article_list = array();
			foreach ($article_list_temp as $article_details) {
				$article_list[$article_details[article_id]] = $article_details;
			}
		}
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParametersNew($record_count, $page_number, $limit);
		}
		
		return $article_list;
	}
		
	/**
	 * pobiera przefiltrowaną listę artykułów powiązanych z podanym produktem
	 * wraz z listą wszystkich dostępnych artykułów (dla celów administracyjnych)
	 */
	
	function getArticlesForProduct($product_id, $order = "order", $direction = "desc", $search_form = null, $page_number = 1, $lang_id) {
		
		global $__CFG;
		
		if ($product_id) {
			
			// najpierw wybieramy normalną listę artykułów - przefiltrowaną wg. wskazanych filtrów
			$article_list = $this->getArticlesSearch($order, $direction, $search_form, $page_number, $lang_id);
			
			// następnie wybieramy listę artykułów powiązanych z podanym produktem
			$sql = "select * from product_article where product_id = '$product_id'";
			$articles_temp = $this->DBM->getTable($sql);
			
			// przelatujemy tą tablicę zazanczając na liscie wssystkich artykułów te, które są powiązane
			if (sizeof($articles_temp)) {
				foreach ($articles_temp as $details) {
					if ($article_list[$details['article_id']]) {
						$article_list[$details['article_id']]['selected'] = 1;
					}
				}
			}
			
			return $article_list;
		}
	}
	
	/**
	 * pobiera artykuły TYLKO powiązane z podanym produktem
	 */
	
	function getArticlesOnlyForProduct ($product_id, $lang_id) {
		
		if ($product_id && $lang_id) {
			
			$sql = "select article.category_id, article.order, article.pic_01, article_multilang.* from article, article_multilang, product_article where article_multilang.article_id = article.id and product_article.article_id = article.id and article_multilang.language_id = '$lang_id' and product_article.product_id = '$product_id' ";
			$article_list = $this->DBM->getTable($sql);
			
			return $article_list;
		}
	}
	
	
	/**
	 * get articles by category id
	 */
	
	function getArticlesByCategory ($category_id, $lang_id) {
		
		if ($category_id && $lang_id) {
			$search_form['category_id'] = $category_id;
			$search_form['status'] = 2;
			// paging cheating ;-)
			//$__CFG['record_count_limit'] = 1;
			
			$article_list = $this->getArticlesSearch("order", "desc", $search_form, 1, $lang_id, $page_number);
			
			return $article_list;
		}
	}
	
	/**
	 * get articles by category id
	 */
	
	function getArticlesToMenu ($category_id, $lang_id) {
		
		if ($category_id && $lang_id) {
			$search_form['category_id'] = $category_id;
			$search_form['status'] = 2;
			// paging cheating ;-)
			$__CFG['record_count_limit'] = 1;
			
			$article_list = $this->getArticlesSearch("order", "asc", $search_form, 1, $lang_id, $page_number);
			
			return $article_list;
		}
	}
	
	/**
	 * wyciaga dane o znajomych
	 */
	
	function getArticlesByNews ($limit, $page_number, $lang_id){
		
		if($limit){

			global $__CFG;
		// TEST!!!
		$__CFG['record_count_limit'] = $limit;
		
		$limit = $__CFG['record_count_limit'];			
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select article.category_id, article.order, article.pic_01, article_multilang.* from article, article_multilang where article_multilang.article_id = article.id and article_multilang.language_id = '$lang_id' and article.category_id = '5' order by date_created desc";		
			$sql_count  = "select count(*) as ilosc from article, article_multilang where article_multilang.article_id = article.id and article_multilang.language_id = '$lang_id' and article.category_id = '5' ";
			
			$sql .= " limit $offset, $limit ";
			
			
			// echo $sql;
			
			// ilośc wszystkich rekordów
			$temp = $this->DBM->getRow($sql_count);
			$record_count = $temp['ilosc'];
			
			//echo $record_count."<br>";
			
			$news_list = $this->DBM->getTable($sql);
			
			if(isset($page_number)) {
				// przeliczamy parametry
				$this->convertPagingParametersNew($record_count, $page_number);
			}
		}
		
		return $news_list;
	}
	
	/**
	 * wyciaga newsy wg kategorii
	 */
	
	function getArticlesByCategoryToView ($limit, $page_number, $lang_id, $category_id){
		
		if($limit && $page_number && $lang_id && $category_id){

			global $__CFG;		
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select article.category_id, article.order, article.pic_01, article_multilang.* from article, article_multilang where article_multilang.article_id = article.id and article_multilang.language_id = '$lang_id' and article.category_id = '$category_id' and article_multilang.status = '2' order by `order` asc";		
			$sql_count  = "select count(*) as ilosc from article, article_multilang where article_multilang.article_id = article.id and article_multilang.language_id = '$lang_id' and article.category_id = '$category_id' and article_multilang.status = '2' ";
			
			$sql .= " limit $offset, $limit ";
			
			
			//echo $sql;
			
			// ilośc wszystkich rekordów
			$temp = $this->DBM->getRow($sql_count);
			$record_count = $temp['ilosc'];
			
			//echo $record_count."<br>";
			
			$news_list = $this->DBM->getTable($sql);
			
			if(isset($page_number)) {
				// przeliczamy parametry
			
				$this->convertPagingParametersNew($record_count, $page_number, $limit);
			}
		}
		
		return $news_list;
	}
	
	/**
	 * wyciaga artykuły jako banery
	 */
	
	function getBanersByCategoryToView ($limit, $page_number, $lang_id, $category_id){
		
		if($limit && $page_number && $lang_id && $category_id){

			global $__CFG;		
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select article.category_id, article.order, article.pic_01, article_multilang.* from article, article_multilang where article_multilang.article_id = article.id and article_multilang.language_id = '$lang_id' and article.category_id = '$category_id' and article_multilang.status = 2 order by rand() asc";		
			$sql_count  = "select count(*) as ilosc from article, article_multilang where article_multilang.article_id = article.id and article_multilang.language_id = '$lang_id' and article.category_id = '$category_id' and article_multilang.status = 2 ";
			
			$sql .= " limit $offset, $limit ";
			
			
			//echo $sql;
			
			// ilośc wszystkich rekordów
			$temp = $this->DBM->getRow($sql_count);
			$record_count = $temp['ilosc'];
			
			//echo $record_count."<br>";
			
			$news_list = $this->DBM->getTable($sql);
			
			if(isset($page_number)) {
				// przeliczamy parametry
			
				$this->convertPagingParametersNew($record_count, $page_number, $limit);
			}
		}
		
		return $news_list;
	}
	
	/**
	 * wyciaga newsy wg kategorii biorąc pod uwagę typ wiadomości
	 */
	
	function getArticlesByCategoryAndTypeToView ($type, $limit, $page_number, $lang_id, $category_id){
		
			if($type && $limit && $page_number && $lang_id && $category_id){
			
			global $__CFG;		
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select article.category_id, article.order, article.pic_01, article_multilang.* from article, article_multilang where article_multilang.article_id = article.id and article_multilang.language_id = '$lang_id' and article.category_id = '$category_id' and article_multilang.type = '$type' order by `order` asc";		
			$sql_count  = "select count(*) as ilosc from article, article_multilang where article_multilang.article_id = article.id and article_multilang.language_id = '$lang_id' and article.category_id = '$category_id' and article_multilang.type = '$type' ";
			
			$sql .= " limit $offset, $limit ";
			
			
			//echo $sql;
			
			// ilośc wszystkich rekordów
			$temp = $this->DBM->getRow($sql_count);
			$record_count = $temp['ilosc'];
			
			//echo $record_count."<br>";
			
			$news_list = $this->DBM->getTable($sql);
			
			if(isset($page_number)) {
				// przeliczamy parametry
			
				$this->convertPagingParametersNew($record_count, $page_number, $limit);
			}
		}
		
		return $news_list;
	}

	/**
	 * sprawdza czy dany artykuł istnieje o tej samej nazwie url /uzywane do walidacji - dla istniejaqcego artykułu/
	 */
	
	function getArticleByUrlNameAndId($url_name, $article_id) {
			
		if ($url_name && $article_id) {	
			//print_r($article_id);
			$sql = "select article_multilang.* from article_multilang where article_multilang.url_name = '$url_name' and article_multilang.article_id != '$article_id'";
			$rv = $this->DBM->getRow($sql);
			//echo $sql;
			
		}
		return $rv;
	}
	
	/**
	 * sprawdza czy dany artykuł istnieje o tej samej nazwie url /uzywane do walidacji - dla nowgo artykułu/
	 */
	
	function getArticleByUrlName($url_name) {
			
		if ($url_name) {	
			$sql = "select article_multilang.* from article_multilang where article_multilang.url_name = '$url_name' ";
			$rv = $this->DBM->getRow($sql);
			
		}
		return $rv;
	}
	
	/**
	 * pobiera pojedynczy artykuł do edycji
	 */
	
	function getArticle($article_id, $lang_id) {
			
		if ($article_id && $lang_id) {	
			$sql = "select article.category_id, article.order, article.pic_01, article.pic_02, article.pic_03, article_multilang.* from article, article_multilang where article_multilang.article_id = article.id and article.id = '$article_id' and article_multilang.language_id = '$lang_id'";
			$rv = $this->DBM->getRow($sql);
			
		}
		return $rv;
	}
	
	/**
	 * pobiera pojedynczy artykuł do edycji
	 */
	
	function getArticleByUrlNameToView($url_name, $lang_id) {
			
		if ($url_name && $lang_id) {	
			$sql = "select article.category_id, article.order, article.pic_01, article.pic_02, article.pic_03, article_multilang.* from article, article_multilang where article_multilang.article_id = article.id and article_multilang.url_name = '$url_name' and article_multilang.language_id = '$lang_id'";
			$article_details = $this->DBM->getRow($sql);
			
		
			if (sizeof($article_details)) {
				
				// wybieramy nastepny (nowszy)
				
				$sql = "select article_multilang.* from article, article_multilang where article_multilang.article_id = article.id and article.`order` > '$article_details[order]' and article.category_id = '$article_details[category_id]' and article_multilang.language_id = '$lang_id' and article_multilang.status != 1 order by article.`order` asc limit 1";
				$next_article = $this->DBM->getRow($sql);
				
				if (sizeof($next_article)) {
					$article_details['next'] = $next_article['url_name'];
				}
				
				// wybieramy poprzedni (starszy) 
				
				$sql = "select article_multilang.* from article, article_multilang where article_multilang.article_id = article.id and article.`order` < '$article_details[order]' and article.category_id = '$article_details[category_id]' and article_multilang.language_id = '$lang_id' and article_multilang.status != 1 order by article.`order` desc limit 1";
				$previous_article = $this->DBM->getRow($sql);
				
				if (sizeof($previous_article)) {
					$article_details['previous'] = $previous_article['url_name'];
				}
			}		
		
		
		}
		return $article_details;
	}
	
	/**
	 * pobiera pojedynczy artykuł do edycji
	 */
	
	function getArticleByUrlNameAndTypeToView($type, $url_name, $lang_id) {
			
		if ($url_name && $lang_id) {	
			$sql = "select article.category_id, article.order, article.pic_01, article.pic_02, article.pic_03, article_multilang.* from article, article_multilang where article_multilang.article_id = article.id and article_multilang.url_name = '$url_name' and article_multilang.language_id = '$lang_id'";
			$article_details = $this->DBM->getRow($sql);
			
		
			if (sizeof($article_details)) {
				
				// wybieramy nastepny (nowszy)
				
				$sql = "select article_multilang.* from article, article_multilang where article_multilang.article_id = article.id and article.`order` > '$article_details[order]' and article.category_id = '$article_details[category_id]' and article_multilang.language_id = '$lang_id' and article_multilang.type = '$type' and article_multilang.status != 1 order by article.`order` asc limit 1";
				$next_article = $this->DBM->getRow($sql);
				
				if (sizeof($next_article)) {
					$article_details['next'] = $next_article['url_name'];
				}
				
				// wybieramy poprzedni (starszy) 
				
				$sql = "select article_multilang.* from article, article_multilang where article_multilang.article_id = article.id and article.`order` < '$article_details[order]' and article.category_id = '$article_details[category_id]' and article_multilang.language_id = '$lang_id' and article_multilang.type = '$type' and article_multilang.status != 1 order by article.`order` desc limit 1";
				$previous_article = $this->DBM->getRow($sql);
				
				if (sizeof($previous_article)) {
					$article_details['previous'] = $previous_article['url_name'];
				}
			}		
		
		
		}
		return $article_details;
	}
	
	/**
	 * wyciąga pierwszy artykuł z podanej kategorii (tylko id)
	 */
	
	function getFirstArticleInCategory ($category_id, $lang_id) {
		
		if ($category_id) {
			
			$sql = "select article.id from article, article_multilang where article_multilang.article_id = article.id and article.category_id = '$category_id' and article_multilang.language_id = '$lang_id' and article_multilang.status != 0 order by article.`order` desc limit 1";
			$details = $this->DBM->getRow($sql);
			
			return $details['id'];
		}
	}
	
	/**
	 * pobiera pojedynczy artykuł do widoku szczegółów
	 */
	
	function getArticleDetails($article_id, $lang_id) {
		
		if ($article_id && $lang_id) {
			$sql = "select article.category_id, article.order, article.pic_01, article_multilang.* from article, article_multilang where article_multilang.article_id = article.id and article.id = '$article_id' and article_multilang.language_id = '$lang_id'";
			$rv = $this->DBM->getRow($sql);
		}
		return $rv;
	}
	
	/**
	 * zapisuje pojedynczy artykuł
	 */
	
	function saveArticle($article_form) {
		
		global $__CFG;
		
		// data bieżąca 
		if($article_form['date_created']){
			
			$date_now = $article_form['date_created'];
			
		}
		else{
			
			$date_now = date("Y-m-d H:i:s", time());
			
		}
		
		
		
		if (!$article_form['article_id']) {
			
			// kolejność - to jest do przeniesienia do nowej klasy Order (?) albo osobna metoda w tej klasie (?)
			$sql = "select max(`order`) as last_order from article where category_id = '$article_form[category_id]'";
			$order = $this->DBM->getRow($sql);
			$next_order = $order['last_order'] + 1;
			
			// nowa metryka
			$sql = "insert into article (category_id, `order`) values ('$article_form[category_id]', '0') ";
			$rv = $this->DBM->modifyTable($sql);
			$article_id = $this->DBM->lastInsertID;
			
					// dodaj obrazek nr 1
			if ($_FILES['pic_01']['name']) {
				$pic_01 = "article_".$article_id."_01.jpg";
				$sql = "update article set pic_01 = '$pic_01' where id = '$article_id'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeArticlePicture ($_FILES['pic_01']['tmp_name'], $__CFG['art_pictures_path'].$article_id."_01_01.jpg", 70, 70);
				$this->resizeArticlePicture ($_FILES['pic_01']['tmp_name'], $__CFG['art_pictures_path'].$article_id."_02_01.jpg", 130, 130);
				$this->resizeArticlePicture ($_FILES['pic_01']['tmp_name'], $__CFG['art_pictures_path'].$article_id."_03_01.jpg", 500, 500);
				unlink($_FILES['pic_01']['tmp_name']);				
				

			}
			
			// dodaj obrazek nr 2
			if ($_FILES['pic_02']['name']) {
				$pic_02 = "article_".$article_id."_02.jpg";
				$sql = "update article set pic_02 = '$pic_02' where id = '$article_id'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeArticlePicture ($_FILES['pic_02']['tmp_name'], $__CFG['art_pictures_path'].$article_id."_01_02.jpg", 70, 70);
				$this->resizeArticlePicture ($_FILES['pic_02']['tmp_name'], $__CFG['art_pictures_path'].$article_id."_02_02.jpg", 130, 130);
				$this->resizeArticlePicture ($_FILES['pic_02']['tmp_name'], $__CFG['art_pictures_path'].$article_id."_03_02.jpg", 500, 500);
				unlink($_FILES['pic_02']['tmp_name']);				
				

			}
			
					
			// dodaj obrazek nr 3
			if ($_FILES['pic_03']['name']) {
				$pic_03 = "article_".$article_id."_03.jpg";
				$sql = "update article set pic_03 = '$pic_03' where id = '$article_id'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeArticlePicture ($_FILES['pic_03']['tmp_name'], $__CFG['art_pictures_path'].$article_id."_01_03.jpg", 70, 70);
				$this->resizeArticlePicture ($_FILES['pic_03']['tmp_name'], $__CFG['art_pictures_path'].$article_id."_02_03.jpg", 130, 130);
				$this->resizeArticlePicture ($_FILES['pic_03']['tmp_name'], $__CFG['art_pictures_path'].$article_id."_03_03.jpg", 500, 500);
				unlink($_FILES['pic_03']['tmp_name']);				
				

			}			
		
			
			if ($article_id) {
				
				// zapisujemy wersję językową
				$sql  = "insert into article_multilang (article_id, type, url_name, podpis, language_id, title, abstract, content, status, date_created, date_modified) ";
				$sql .= " values ('$article_id', '$article_form[type]', '$article_form[url_name]', '$article_form[podpis]', '$article_form[language_id]', '$article_form[title]', '$article_form[abstract]', '$article_form[content]', '$article_form[status]', '$date_now', '$date_now') ";
				$rv = $this->DBM->modifyTable($sql);
				
				// i wszystkie pozostałe wersje językowe (puste)
				$sql = "select * from language";
				$languages_list = $this->DBM->getTable($sql);
				
				if (sizeof($languages_list)) {
					foreach ($languages_list as $language) {
						// bez tego, który już wczesniej zapisaliśmy!
						if ($language['id'] != $article_form['language_id']) {
							$sql  = "insert into article_multilang (article_id, language_id, status, date_created, date_modified, title) ";
							$sql .= " values ('$article_id', '$language[id]', '0', '$date_now', '$date_now', '$article_form[title]') ";
							$rv = $this->DBM->modifyTable($sql);
						}
					}
				}
			}
		}
		else {
			
			// aktualizacja artykułu
			
			// najpierw metryka artykułu (zmiana conajwyżej kategorii)
			$sql = "update article set category_id = '$article_form[category_id]' where id = '$article_form[article_id]'";
			$rv = $this->DBM->modifyTable($sql);
			
			
					// update obrazka (usunięcie lub aktualizacja - o ile został podany) nr 1
			if ($article_form['remove_picture_01']) {
				// usuwamy obrazek
				$pic_01 = "";
				$sql = "update article set pic_01 = '$pic_01' where id = '$article_form[article_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				unlink($__CFG['art_pictures_path'].$article_form['article_id']."_01_01.jpg");
				unlink($__CFG['art_pictures_path'].$article_form['article_id']."_02_01.jpg");
				unlink($__CFG['art_pictures_path'].$article_form['article_id']."_03_01.jpg");
			}
			elseif ($_FILES['pic_01']['name']) {
				// aktualizujemy obrazek
				$pic_01 = "article_".$article_form['article_id']."_01.jpg";
				$sql = "update article set pic_01 = '$pic_01' where id = '$article_form[article_id]'";
				$rv = $this->DBM->modifyTable($sql);

				// pierwsza miniatura
				$this->resizeArticlePicture ($_FILES['pic_01']['tmp_name'], $__CFG['art_pictures_path'].$article_form[article_id]."_01_01.jpg", 70, 70);
				$this->resizeArticlePicture ($_FILES['pic_01']['tmp_name'], $__CFG['art_pictures_path'].$article_form[article_id]."_02_01.jpg", 130, 130);
				$this->resizeArticlePicture ($_FILES['pic_01']['tmp_name'], $__CFG['art_pictures_path'].$article_form[article_id]."_03_01.jpg", 500, 500);
				unlink($_FILES['pic_01']['tmp_name']);					
				
			}
			
			
			// update obrazka (usunięcie lub aktualizacja - o ile został podany) nr 2
			if ($article_form['remove_picture_02']) {
				// usuwamy obrazek
				$pic_02 = "";
				$sql = "update article set pic_02 = '$pic_02' where id = '$article_form[article_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				unlink($__CFG['art_pictures_path'].$article_form['article_id']."_01_02.jpg");
				unlink($__CFG['art_pictures_path'].$article_form['article_id']."_02_02.jpg");
				unlink($__CFG['art_pictures_path'].$article_form['article_id']."_03_02.jpg");
			}
			elseif ($_FILES['pic_02']['name']) {
				// aktualizujemy obrazek
				$pic_02 = "article_".$article_form['article_id']."_02.jpg";
				$sql = "update article set pic_02 = '$pic_02' where id = '$article_form[article_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeArticlePicture ($_FILES['pic_02']['tmp_name'], $__CFG['art_pictures_path'].$article_form[article_id]."_01_02.jpg", 70, 70);
				$this->resizeArticlePicture ($_FILES['pic_02']['tmp_name'], $__CFG['art_pictures_path'].$article_form[article_id]."_02_02.jpg", 130, 130);
				$this->resizeArticlePicture ($_FILES['pic_02']['tmp_name'], $__CFG['art_pictures_path'].$article_form[article_id]."_03_02.jpg", 500, 500);
				unlink($_FILES['pic_02']['tmp_name']);					
				
			}			
			
			// update obrazka (usunięcie lub aktualizacja - o ile został podany) nr 3
			if ($article_form['remove_picture_03']) {
				// usuwamy obrazek
				$pic_03 = "";
				$sql = "update article set pic_03 = '$pic_03' where id = '$article_form[article_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				unlink($__CFG['art_pictures_path'].$article_form['article_id']."_01_03.jpg");
				unlink($__CFG['art_pictures_path'].$article_form['article_id']."_02_03.jpg");
				unlink($__CFG['art_pictures_path'].$article_form['article_id']."_03_03.jpg");
			}
			elseif ($_FILES['pic_03']['name']) {
				// aktualizujemy obrazek
				$pic_03 = "article_".$article_form['article_id']."_03.jpg";
				$sql = "update article set pic_03 = '$pic_03' where id = '$article_form[article_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeArticlePicture ($_FILES['pic_03']['tmp_name'], $__CFG['art_pictures_path'].$article_form[article_id]."_01_03.jpg", 70, 70);
				$this->resizeArticlePicture ($_FILES['pic_03']['tmp_name'], $__CFG['art_pictures_path'].$article_form[article_id]."_02_03.jpg", 130, 130);
				$this->resizeArticlePicture ($_FILES['pic_03']['tmp_name'], $__CFG['art_pictures_path'].$article_form[article_id]."_03_03.jpg", 500, 500);
				unlink($_FILES['pic_03']['tmp_name']);					
				
			}
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			// a potem wersja językowa
			$sql = "update article_multilang set type = '$article_form[type]', url_name = '$article_form[url_name]', podpis = '$article_form[podpis]',  title = '$article_form[title]', abstract = '$article_form[abstract]', content = '$article_form[content]', status = '$article_form[status]', date_modified = '$date_now' where article_id = '$article_form[article_id]' and language_id = '$article_form[language_id]'";
			$rv = $this->DBM->modifyTable($sql);
			
		}
		
		// zwracamy ID ostatnio zapisanego artykułu
		if ($article_id) { 
			return $article_id;
		}
		else {
			return $article_form['article_id'];
		}
	}
	
	/**
	 * usuwa pojedynczy artykuł
	 */
	
	function removeArticle($article_id) {
			
		if ($article_id) {
			// metryka
			$sql = "delete from article where id = $article_id ";
			$rv = $this->DBM->modifyTable($sql);
			// i wszystkie wersje językowe
			$sql = "delete from article_multilang where article_id = $article_id ";
			$rv = $this->DBM->modifyTable($sql);
		}
		return $rv;
	}
	
	/**
	 * uaktualnia automatycznie kolejnosc artykułow w kategorii
	 */
	
	function updateOrders($article_id, $position) {
			
		if ($article_id && $position) {
			
			$sql = "update article set `order` = '$position' where id = '$article_id' ";
			$rv = $this->DBM->modifyTable($sql);
		}
		return $rv;

	}
	
	/**
	 * gets n random articles from given category
	 */
	
	function getRandomArticles ($category_id, $limit, $lang_id) {
		
		if ($category_id && $limit && $lang_id) {
			$sql = "select article.category_id, article.order, article_multilang.* from article, article_multilang where article_multilang.article_id = article.id and article.category_id = '$category_id' and article_multilang.language_id = '$lang_id' order by rand() limit $limit";
			$article_list = $this->DBM->getTable($sql);
			
			return $article_list;
		}
		
	}
	
	/**
	 * wysyła artykuł mailem (HTML)
	 */
	
	function sendArticleByEmail ($article_details, $email) {
		
		global $_mail_params;
		global $dict_templates;
		global $__CFG;
		global $smarty;
		
		if (sizeof($article_details) && $email) {
			//print_r($article_details);
			$smarty->assign("article", $article_details);
			
			$content = $smarty->fetch("article_send.tpl");
				
			$mail_data['html_body'] = $content;
			
			$mail_data['headers']['MIME-Version']= '1.0';
			$mail_data['headers']['Subject'] = $dict_templates['SendArticleSubject'];
			$mail_data['headers']['From'] = Utils::prepareSubjectBase64($__CFG['newsletter_mail_name'])." <".$__CFG['newsletter_mail_address'].">";
			$mail_data['headers']['To'] = $email;
			$mail_data['headers']['Reply-To'] = Utils::prepareSubjectBase64($__CFG['newsletter_mail_name'])." <".$__CFG['newsletter_mail_address'].">";
			$mail_data['headers']['Date'] = date("r",time());
			
			require_once 'HCMailer2.class.php';
			
			$mailerek = new HCMailer2($mail_data);
			$mailerek->sendMailMime();
			
			return true;
		}
	}
	
	/**
	 * gets all articles
	 */
	
	function getArticlesAll ($lang_id) {
		
		if ($lang_id) {
			$sql = "select * from article_multilang where language_id = '$lang_id' order by date_modified desc ";
			$article_list = $this->DBM->getTable($sql);
			
			return $article_list;
		}
	}
	
	/**
	 * przelicza wszystkie parametry do stronicowania
	 */
	
	function convertPagingParameters($record_count, $page_number) {
		
		global $__CFG;
		
		$paging = array();
		$last_page = ceil($record_count / $__CFG['record_count_limit']);
		
		// echo "last page : ".$last_page."<br>";
		
		// poprzednia strona
		if ($page_number == 1) {
			$paging['previous'] = "";
			$paging['first'] = "";
		}
		else {
			$paging['previous'] = $page_number - 1;
			$paging['first'] = "1";
		}
		
		// następna strona
		if ($page_number == $last_page) {
			$paging['next'] = "";
			$paging['last'] = "";	
		}
		else {
			$paging['next'] = $page_number + 1;
			$paging['last'] = $last_page;
		}
		
		$paging['current'] = $page_number;
		
		$this->paging = $paging;
		return $paging;
		
	}
	
		/**
		 * Przelicza wszystkie parametry do stronicowania z zakresami
		 */
	
	function convertPagingParametersNew($record_count, $page_number, $limit) {
		
		global $__CFG;
		
		$paging = array();
		$last_page = ceil($record_count / $limit);
		
		// na wszelki wypadek
		if ($last_page == 0) {
			$last_page = "";
		}
		
		// echo "last page : ".$last_page."<br>";
		
		// poprzednia strona
		if ($page_number == 1) {
			$paging['previous'] = "";
			$paging['first'] = "";
		}
		else {
			$paging['previous'] = $page_number - 1;
			$paging['first'] = "1";
		}
		
		// następna strona
		if ($page_number == $last_page) {
			$paging['next'] = "";
			$paging['last'] = "";	
		}
		elseif ($last_page)  {
			$paging['next'] = $page_number + 1;
			$paging['last'] = $last_page;
		}
		
		$paging['current'] = $page_number;
		
		// i jeszcze nawigacja po kilku stronach
		// zakładamy, że rozstrzał w jedną i w drugą stronę będzie równy 4 strony
		
		$range = 5;
		
		if ($page_number < $range + 1) {
			$from = 1;
		}
		else {
			$from = $page_number - $range;
		}
		
		if ($last_page < $page_number + $range) {
			$to = $last_page;
		}
		else {
			$to = $page_number + $range;
		}
		$paging['count'] = $record_count;
		$paging['page_from'] = $from;
		$paging['page_to'] = $to;
		
		//print_r($paging);
		
		$this->paging = $paging;
		return $paging;
		
	}
	
	/**
	 * przeskalowuje importowane zdj�cie w miejscu - z resamplingiem
	 */
	
	function resizeArticlePicture ($source_path, $target_path, $xmin, $ymin) {
		
		global $__CFG;
		
		if ($source_path && $target_path && $xmin && $ymin) {
			
			// tylko jeden format zdj�� jest dozwolony
			
			// $details = getimagesize($__CFG['gallery_pictures_path'].$filename);
			$details = getimagesize($source_path);
			
			if ($details['mime'] == "image/jpeg") {
			
				// Set a maximum height and width
				$width = $xmin;
				$height = $ymin;
				
				// Get new dimensions 
				// list($width_orig, $height_orig) = getimagesize($__CFG['gallery_pictures_path'].$filename);
				list($width_orig, $height_orig) = getimagesize($source_path);
				
				$ratio_orig = $width_orig/$height_orig;
				
				if ($width/$height > $ratio_orig) {
				   $width = $height*$ratio_orig;
				} else {
				   $height = $width/$ratio_orig;
				}
				
				// Resample
				$image_p = imagecreatetruecolor($width, $height);
				
				$image = imagecreatefromjpeg($source_path);
				
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
				
				imagejpeg($image_p, $target_path, 80);
				
			}
			
			if ($details['mime'] == "image/gif") {
			
				// Set a maximum height and width
				$width = $xmin;
				$height = $ymin;
				
				// Get new dimensions 
				// list($width_orig, $height_orig) = getimagesize($__CFG['gallery_pictures_path'].$filename);
				list($width_orig, $height_orig) = getimagesize($source_path);
				
				$ratio_orig = $width_orig/$height_orig;
				
				if ($width/$height > $ratio_orig) {
				   $width = $height*$ratio_orig;
				} else {
				   $height = $width/$ratio_orig;
				}
				
				// Resample
				$image_p = imagecreatetruecolor($width, $height);
				
				$image = imagecreatefromgif($source_path);
				
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
				
				imagegif($image_p, $target_path, 80);
				
			}
		}
		else {
			return false;
		}
	}	
	
	
	
	
}
?>