<?php

class SearchEngine {
	
	/**
	 * @var object DBManager
	 */
	var $DBM;
	
	var $paging = array();
	
	function SearchEngine() {
		global $DBM;
	 	$this->DBM = $DBM;
	}
	
	/**
	 * search all
	 */
	
	function searchPhrase ($search_form, $lang_id) {
		
		if (sizeof($search_form) && $lang_id) {
			
			
			
			// search products
			$products = $this->searchProducts($search_form, $lang_id);
			

			
			
			return $products;
		}
		
	}
	
	/**
	 * search in products
	 */
	
	function searchProducts ($search_form, $lang_id) {
		
		if (sizeof($search_form) && $lang_id) {
			
			$products = array();
			$phrase = "";
			
			// czyścimy frazę i dzielimy ją na słowa
			$details = explode(" ", trim($search_form['phrase']));
			
			// składamy ze słów zapytanie
			if (sizeof($details)) {
				foreach($details as $string) {
					$phrase .= trim($string)."* ";
				}
			}
			
			$search_form['phrase'] = $phrase;
			$phrase = str_replace("ż", "Ż", $phrase);
			if (sizeof($search_form)) {
			
				if ($phrase && $phrase != "* ") {
					
					$sql  = "select product_multilang.*, match (title) against ('$phrase' IN BOOLEAN MODE) as score from product_multilang where match(title) against('$phrase' IN BOOLEAN MODE) and product_multilang.language_id = '$lang_id' and status = 2 ";
					$sql .= " order by score desc, title asc ";
				
					$products = $this->DBM->getTable($sql);
					

					
					return $products;
				
				}
			}
		}
		
	}
	
	/**
	 * szukamy w informacjach prasowych
	 */
	
	function searchArticles ($search_form, $lang_id) {
		
		if ($search_form['phrase'] && $lang_id) {
			
			$articles = array();
			$phrase = "";
			
			// czyścimy frazę i dzielimy ją na słowa
			$details = explode(" ", trim($search_form['phrase']));
			
			// składamy ze słów zapytanie
			if (sizeof($details)) {
				foreach($details as $string) {
					$phrase .= trim($string)."* ";
				}
			}
			
			// kategoria newsów
			$category_id = 2;
			
			$sql  = "select *, match (article_multilang.title, article_multilang.content, article_multilang.abstract) against ('$phrase' IN BOOLEAN MODE) as score from article, article_multilang where article_multilang.article_id = article.id and article_multilang.language_id = '$lang_id' and article.category_id = '$category_id' and article_multilang.status != 0 and match(article_multilang.title, article_multilang.content, article_multilang.abstract) against('$phrase' IN BOOLEAN MODE)  ";
			$articles = $this->DBM->getTable($sql);
			
			// echo $sql;
			// print_r($articles);
			
			return $articles;
		}
		
	}
	
	/**
	 * przelicza wszystkie parametry do stronicowania - wersja roszerzona
	 */
	
	function convertPagingParameters($record_count, $page_number) {
		
		global $__CFG;
		
		$paging = array();
		$last_page = ceil($record_count / $__CFG['record_count_limit']);
		
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
		
		$range = 4;
		
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
		
		$paging['page_from'] = $from;
		$paging['page_to'] = $to;
		
		// print_r($paging);
		
		$this->paging = $paging;
		return $paging;
		
	}
}
?>