<?
/**
 * @copyright 
 * @author 
 * @see 
 *
 * obsługa artykułów tekstowych w wersji wielojęzycznej
 *
 */

require_once 'Utils.class.php';

class Baner {

	/**
	 * @var object DBManager
	 */
	var $DBM;

	function Baner() {
		global $DBM;
	 	$this->DBM = $DBM;
	}
	
	/**
	 * pobiera listę artykułów (posortowaną)
	 */
	
	function getBaners($order = "order", $direction = "desc", $page_number = 1, $category_id = 1, $lang_id) {
		
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		if (!$category_id) $category_id = 1;
		
		$sql  = "select count(*) as ilosc from baner, baner_multilang where baner_multilang.baner_id = baner.id and baner.category_id = '$category_id' and baner_multilang.language_id = '$lang_id'";
				
		$temp = $this->DBM->getRow($sql);
		$record_count = $temp['ilosc'];
		
		$sql  = "select baner.category_id, baner.order, baner.pic_01, baner_multilang.* from baner, baner_multilang where baner_multilang.baner_id = baner.id and baner.category_id = '$category_id' and baner_multilang.language_id = '$lang_id' ";		
		$sql .= " order by baner.`$order` $direction limit $offset, $limit ";
		
		// echo $sql."<hr>";
		
		$baner_list_temp = $this->DBM->getTable($sql);
		
		// reindex array
		if (sizeof($baner_list_temp)) {
			$baner_list = array();
			foreach ($baner_list_temp as $baner_details) {
				$baner_list[$baner_details[baner_id]] = $baner_details;
			}
		}
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParameters($record_count, $page_number);
		}
		
		return $baner_list;
	}
	
	/**
	 * Przestawia status 
	 */
	
	function setStatus ($baner_id, $status) {
		
		if ($baner_id) {
			
			$sql = "update baner_multilang set status = '$status' where baner_multilang.baner_id = '$baner_id' ";
			$this->DBM->modifyTable($sql);
			
		}
	}	
	
	/**
	 * Oznaczenie jako wysłany 
	 */
	
	function setSended ($baner_id) {
		
		if ($baner_id) {
			
			$sql = "update baner_multilang set sended = '1' where baner_multilang.baner_id = '$baner_id' ";
			$this->DBM->modifyTable($sql);
			
		}
	}	
		
	/**
	 * pobiera przefiltrowaną listę artykułów
	 */
	
	function getBanersSearch($order = "order", $direction = "desc", $search_form = null, $page_number = 1, $lang_id) {
		
		
			// ustawienie numeru strony do stronicowania (jezeli nie została podana)
			if (!sizeof($_REQUEST['page_number'])) {
				$_REQUEST['page_number'] = 1;
			}		
		
		$page_number = $_REQUEST['page_number'];
		
		
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		$sql  = "select baner.category_id, baner.order, baner.pic_01, baner_multilang.* from baner, baner_multilang where baner_multilang.baner_id = baner.id and baner_multilang.language_id = '$lang_id' ";		
		$sql_count  = "select count(*) as ilosc from baner, baner_multilang where baner_multilang.baner_id = baner.id and baner_multilang.language_id = '$lang_id' ";
				
		if(sizeof($search_form)) {
			
			if ($search_form['category_id']) {
				$sql .= " AND baner.category_id = ".$search_form['category_id']." ";
				$sql_count .= " AND baner.category_id = ".$search_form['category_id']." ";
			}
			if ($search_form['title']) {
				$sql .= " AND lower(baner_multilang.title) like lower('%".$search_form['title']."%') ";
				$sql_count .= " AND lower(baner_multilang.title) like lower('%".$search_form['title']."%') ";
			}
			if ($search_form['abstract']) {
				$sql .= " AND lower(baner_multilang.abstract) like lower('%".$search_form['abstract']."%') ";
				$sql_count .= " AND lower(baner_multilang.abstract) like lower('%".$search_form['abstract']."%') ";
			}
			if ($search_form['content']) {
				$sql .= " AND lower(baner_multilang.content) like lower('%".$search_form['content']."%') ";
				$sql_count .= " AND lower(baner_multilang.content) like lower('%".$search_form['content']."%') ";
			}
			if ($search_form['status']) {
				$sql .= " AND baner_multilang.status = ".$search_form['status']." ";
				$sql_count .= " AND baner_multilang.status = ".$search_form['status']." ";
			}
			if ($search_form['date_created_from'] && $search_form['date_created_to']) {
				$sql .= " AND baner_multilang.date_created between '".$search_form['date_created_from']."' and '".$search_form['date_created_to']."' ";
				$sql_count .= " AND baner_multilang.date_created between '".$search_form['date_created_from']."' and '".$search_form['date_created_to']."' ";
			}
			if ($search_form['date_modified_from'] && $search_form['date_modified_to']) {
				$sql .= " AND baner_multilang.date_modified between '".$search_form['date_modified_from']."' and '".$search_form['date_modified_to']."' ";
				$sql_count .= " AND baner_multilang.date_modified between '".$search_form['date_modified_from']."' and '".$search_form['date_modified_to']."' ";
			}
		}
		
		$sql .= " order by baner.`$order` $direction ";
		$sql .= " limit $offset, $limit ";
		
		// echo $sql;
		
		// ilośc wszystkich rekordów
		$temp = $this->DBM->getRow($sql_count);
		$record_count = $temp['ilosc'];
		
		// echo $record_count."<br>";
		
		$baner_list_temp = $this->DBM->getTable($sql);
		
		// reindex array
		if (sizeof($baner_list_temp)) {
			$baner_list = array();
			foreach ($baner_list_temp as $baner_details) {
				$baner_list[$baner_details[baner_id]] = $baner_details;
			}
		}
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParametersNew($record_count, $page_number, $limit);
		}
		
		return $baner_list;
	}
		
	/**
	 * pobiera przefiltrowaną listę artykułów powiązanych z podanym produktem
	 * wraz z listą wszystkich dostępnych artykułów (dla celów administracyjnych)
	 */
	
	function getBanersForProduct($product_id, $order = "order", $direction = "desc", $search_form = null, $page_number = 1, $lang_id) {
		
		global $__CFG;
		
		if ($product_id) {
			
			// najpierw wybieramy normalną listę artykułów - przefiltrowaną wg. wskazanych filtrów
			$baner_list = $this->getBanersSearch($order, $direction, $search_form, $page_number, $lang_id);
			
			// następnie wybieramy listę artykułów powiązanych z podanym produktem
			$sql = "select * from product_baner where product_id = '$product_id'";
			$baners_temp = $this->DBM->getTable($sql);
			
			// przelatujemy tą tablicę zazanczając na liscie wssystkich artykułów te, które są powiązane
			if (sizeof($baners_temp)) {
				foreach ($baners_temp as $details) {
					if ($baner_list[$details['baner_id']]) {
						$baner_list[$details['baner_id']]['selected'] = 1;
					}
				}
			}
			
			return $baner_list;
		}
	}
	
	/**
	 * pobiera artykuły TYLKO powiązane z podanym produktem
	 */
	
	function getBanersOnlyForProduct ($product_id, $lang_id) {
		
		if ($product_id && $lang_id) {
			
			$sql = "select baner.category_id, baner.order, baner.pic_01, baner_multilang.* from baner, baner_multilang, product_baner where baner_multilang.baner_id = baner.id and product_baner.baner_id = baner.id and baner_multilang.language_id = '$lang_id' and product_baner.product_id = '$product_id' ";
			$baner_list = $this->DBM->getTable($sql);
			
			return $baner_list;
		}
	}
	
	
	/**
	 * get baners by category id
	 */
	
	function getBanersByCategory ($category_id, $lang_id) {
		
		if ($category_id && $lang_id) {
			$search_form['category_id'] = $category_id;
			$search_form['status'] = 2;
			// paging cheating ;-)
			$__CFG['record_count_limit'] = 1;
			
			$baner_list = $this->getBanersSearch("order", "desc", $search_form, 1, $lang_id, $page_number);
			
			return $baner_list;
		}
	}
	
	/**
	 * get baners by category id
	 */
	
	function getBanersToMenu ($category_id, $lang_id) {
		
		if ($category_id && $lang_id) {
			$search_form['category_id'] = $category_id;
			$search_form['status'] = 2;
			// paging cheating ;-)
			$__CFG['record_count_limit'] = 1;
			
			$baner_list = $this->getBanersSearch("order", "asc", $search_form, 1, $lang_id, $page_number);
			
			return $baner_list;
		}
	}
	
	/**
	 * wyciaga dane o znajomych
	 */
	
	function getBanersByNews ($limit, $page_number, $lang_id){
		
		if($limit){

			global $__CFG;
		// TEST!!!
		$__CFG['record_count_limit'] = $limit;
		
		$limit = $__CFG['record_count_limit'];			
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select baner.category_id, baner.order, baner.pic_01, baner_multilang.* from baner, baner_multilang where baner_multilang.baner_id = baner.id and baner_multilang.language_id = '$lang_id' and baner.category_id = '5' order by date_created desc";		
			$sql_count  = "select count(*) as ilosc from baner, baner_multilang where baner_multilang.baner_id = baner.id and baner_multilang.language_id = '$lang_id' and baner.category_id = '5' ";
			
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
	 * wyciaga artykuły jako banery
	 */
	
	function getBanersByCategoryToView ($limit, $page_number, $lang_id, $category_id){
		
		if($limit && $page_number && $lang_id && $category_id){

			global $__CFG;		
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select baner.category_id, baner.order, baner.pic_01, baner_multilang.* from baner, baner_multilang where baner_multilang.baner_id = baner.id and baner_multilang.language_id = '$lang_id' and baner.category_id = '$category_id' and baner_multilang.status = 2 order by rand() asc";		
			$sql_count  = "select count(*) as ilosc from baner, baner_multilang where baner_multilang.baner_id = baner.id and baner_multilang.language_id = '$lang_id' and baner.category_id = '$category_id' and baner_multilang.status = 2 ";
			
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
	
	function getBanersByCategoryAndTypeToView ($type, $limit, $page_number, $lang_id, $category_id){
		
			if($type && $limit && $page_number && $lang_id && $category_id){
			
			global $__CFG;		
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select baner.category_id, baner.order, baner.pic_01, baner_multilang.* from baner, baner_multilang where baner_multilang.baner_id = baner.id and baner_multilang.language_id = '$lang_id' and baner.category_id = '$category_id' and baner_multilang.type = '$type' order by `order` asc";		
			$sql_count  = "select count(*) as ilosc from baner, baner_multilang where baner_multilang.baner_id = baner.id and baner_multilang.language_id = '$lang_id' and baner.category_id = '$category_id' and baner_multilang.type = '$type' ";
			
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
	
	function getBanerByUrlNameAndId($url_name, $baner_id) {
			
		if ($url_name && $baner_id) {	
			//print_r($baner_id);
			$sql = "select baner_multilang.* from baner_multilang where baner_multilang.url_name = '$url_name' and baner_multilang.baner_id != '$baner_id'";
			$rv = $this->DBM->getRow($sql);
			//echo $sql;
			
		}
		return $rv;
	}
	
	/**
	 * sprawdza czy dany artykuł istnieje o tej samej nazwie url /uzywane do walidacji - dla nowgo artykułu/
	 */
	
	function getBanerByUrlName($url_name) {
			
		if ($url_name) {	
			$sql = "select baner_multilang.* from baner_multilang where baner_multilang.url_name = '$url_name' ";
			$rv = $this->DBM->getRow($sql);
			
		}
		return $rv;
	}
	
	/**
	 * pobiera pojedynczy artykuł do edycji
	 */
	
	function getBaner($baner_id, $lang_id) {
			
		if ($baner_id && $lang_id) {	
			$sql = "select baner.category_id, baner.order, baner.pic_01, baner.pic_02, baner.pic_03, baner_multilang.* from baner, baner_multilang where baner_multilang.baner_id = baner.id and baner.id = '$baner_id' and baner_multilang.language_id = '$lang_id'";
			$rv = $this->DBM->getRow($sql);
			
		}
		return $rv;
	}
	
	/**
	 * pobiera pojedynczy artykuł do edycji
	 */
	
	function getBanerByUrlNameToView($url_name, $lang_id) {
			
		if ($url_name && $lang_id) {	
			$sql = "select baner.category_id, baner.order, baner.pic_01, baner.pic_02, baner.pic_03, baner_multilang.* from baner, baner_multilang where baner_multilang.baner_id = baner.id and baner_multilang.url_name = '$url_name' and baner_multilang.language_id = '$lang_id'";
			$baner_details = $this->DBM->getRow($sql);
			
		
			if (sizeof($baner_details)) {
				
				// wybieramy nastepny (nowszy)
				
				$sql = "select baner_multilang.* from baner, baner_multilang where baner_multilang.baner_id = baner.id and baner.`order` > '$baner_details[order]' and baner.category_id = '$baner_details[category_id]' and baner_multilang.language_id = '$lang_id' and baner_multilang.status != 1 order by baner.`order` asc limit 1";
				$next_baner = $this->DBM->getRow($sql);
				
				if (sizeof($next_baner)) {
					$baner_details['next'] = $next_baner['url_name'];
				}
				
				// wybieramy poprzedni (starszy) 
				
				$sql = "select baner_multilang.* from baner, baner_multilang where baner_multilang.baner_id = baner.id and baner.`order` < '$baner_details[order]' and baner.category_id = '$baner_details[category_id]' and baner_multilang.language_id = '$lang_id' and baner_multilang.status != 1 order by baner.`order` desc limit 1";
				$previous_baner = $this->DBM->getRow($sql);
				
				if (sizeof($previous_baner)) {
					$baner_details['previous'] = $previous_baner['url_name'];
				}
			}		
		
		
		}
		return $baner_details;
	}
	
	/**
	 * pobiera pojedynczy artykuł do edycji
	 */
	
	function getBanerByUrlNameAndTypeToView($type, $url_name, $lang_id) {
			
		if ($url_name && $lang_id) {	
			$sql = "select baner.category_id, baner.order, baner.pic_01, baner.pic_02, baner.pic_03, baner_multilang.* from baner, baner_multilang where baner_multilang.baner_id = baner.id and baner_multilang.url_name = '$url_name' and baner_multilang.language_id = '$lang_id'";
			$baner_details = $this->DBM->getRow($sql);
			
		
			if (sizeof($baner_details)) {
				
				// wybieramy nastepny (nowszy)
				
				$sql = "select baner_multilang.* from baner, baner_multilang where baner_multilang.baner_id = baner.id and baner.`order` > '$baner_details[order]' and baner.category_id = '$baner_details[category_id]' and baner_multilang.language_id = '$lang_id' and baner_multilang.type = '$type' and baner_multilang.status != 1 order by baner.`order` asc limit 1";
				$next_baner = $this->DBM->getRow($sql);
				
				if (sizeof($next_baner)) {
					$baner_details['next'] = $next_baner['url_name'];
				}
				
				// wybieramy poprzedni (starszy) 
				
				$sql = "select baner_multilang.* from baner, baner_multilang where baner_multilang.baner_id = baner.id and baner.`order` < '$baner_details[order]' and baner.category_id = '$baner_details[category_id]' and baner_multilang.language_id = '$lang_id' and baner_multilang.type = '$type' and baner_multilang.status != 1 order by baner.`order` desc limit 1";
				$previous_baner = $this->DBM->getRow($sql);
				
				if (sizeof($previous_baner)) {
					$baner_details['previous'] = $previous_baner['url_name'];
				}
			}		
		
		
		}
		return $baner_details;
	}
	
	/**
	 * wyciąga pierwszy artykuł z podanej kategorii (tylko id)
	 */
	
	function getFirstBanerInCategory ($category_id, $lang_id) {
		
		if ($category_id) {
			
			$sql = "select baner.id from baner, baner_multilang where baner_multilang.baner_id = baner.id and baner.category_id = '$category_id' and baner_multilang.language_id = '$lang_id' and baner_multilang.status != 0 order by baner.`order` desc limit 1";
			$details = $this->DBM->getRow($sql);
			
			return $details['id'];
		}
	}
	
	/**
	 * pobiera pojedynczy artykuł do widoku szczegółów
	 */
	
	function getBanerDetails($baner_id, $lang_id) {
		
		if ($baner_id && $lang_id) {
			$sql = "select baner.category_id, baner.order, baner.pic_01, baner_multilang.* from baner, baner_multilang where baner_multilang.baner_id = baner.id and baner.id = '$baner_id' and baner_multilang.language_id = '$lang_id'";
			$rv = $this->DBM->getRow($sql);
		}
		return $rv;
	}
	
	/**
	 * zapisuje pojedynczy artykuł
	 */
	
	function saveBaner($baner_form) {
		
		global $__CFG;
		
		// data bieżąca 
		if($baner_form['date_created']){
			
			$date_now = $baner_form['date_created'];
			
		}
		else{
			
			$date_now = date("Y-m-d H:i:s", time());
			
		}
		
		
		
		if (!$baner_form['baner_id']) {
			
			// kolejność - to jest do przeniesienia do nowej klasy Order (?) albo osobna metoda w tej klasie (?)
			$sql = "select max(`order`) as last_order from baner where category_id = '$baner_form[category_id]'";
			$order = $this->DBM->getRow($sql);
			$next_order = $order['last_order'] + 1;
			
			// nowa metryka
			$sql = "insert into baner (category_id, `order`) values ('$baner_form[category_id]', '0') ";
			$rv = $this->DBM->modifyTable($sql);
			$baner_id = $this->DBM->lastInsertID;
			
					// dodaj obrazek nr 1
			if ($_FILES['pic_01']['name']) {
				$pic_01 = "baner_".$baner_id."_01.jpg";
				$sql = "update baner set pic_01 = '$pic_01' where id = '$baner_id'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeBanerPicture ($_FILES['pic_01']['tmp_name'], $__CFG['baner_pictures_path'].$baner_id."_01_01.jpg", 35, 20);
				$this->resizeBanerPicture ($_FILES['pic_01']['tmp_name'], $__CFG['baner_pictures_path'].$baner_id."_02_01.jpg", 100, 75);
				$this->resizeBanerPicture ($_FILES['pic_01']['tmp_name'], $__CFG['baner_pictures_path'].$baner_id."_03_01.jpg", 200, 130);
				unlink($_FILES['pic_01']['tmp_name']);				
				

			}
			
			// dodaj obrazek nr 2
			if ($_FILES['pic_02']['name']) {
				$pic_02 = "baner_".$baner_id."_02.jpg";
				$sql = "update baner set pic_02 = '$pic_02' where id = '$baner_id'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeBanerPicture ($_FILES['pic_02']['tmp_name'], $__CFG['baner_pictures_path'].$baner_id."_01_02.jpg", 35, 20);
				$this->resizeBanerPicture ($_FILES['pic_02']['tmp_name'], $__CFG['baner_pictures_path'].$baner_id."_02_02.jpg", 100, 75);
				$this->resizeBanerPicture ($_FILES['pic_02']['tmp_name'], $__CFG['baner_pictures_path'].$baner_id."_03_02.jpg", 200, 130);
				unlink($_FILES['pic_02']['tmp_name']);				
				

			}
			
					
			// dodaj obrazek nr 3
			if ($_FILES['pic_03']['name']) {
				$pic_03 = "baner_".$baner_id."_03.jpg";
				$sql = "update baner set pic_03 = '$pic_03' where id = '$baner_id'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeBanerPicture ($_FILES['pic_03']['tmp_name'], $__CFG['baner_pictures_path'].$baner_id."_01_03.jpg", 35, 20);
				$this->resizeBanerPicture ($_FILES['pic_03']['tmp_name'], $__CFG['baner_pictures_path'].$baner_id."_02_03.jpg", 100, 75);
				$this->resizeBanerPicture ($_FILES['pic_03']['tmp_name'], $__CFG['baner_pictures_path'].$baner_id."_03_03.jpg", 200, 130);
				unlink($_FILES['pic_03']['tmp_name']);				
				

			}			
		
			
			if ($baner_id) {
				
				// zapisujemy wersję językową
				$sql  = "insert into baner_multilang (baner_id, language_id, title, abstract, content, link, price, status, date_created, date_modified) ";
				$sql .= " values ('$baner_id', '$baner_form[language_id]', '$baner_form[title]', '$baner_form[abstract]', '$baner_form[content]', '$baner_form[link]', '$baner_form[price]', '$baner_form[status]', '$date_now', '$date_now') ";
				$rv = $this->DBM->modifyTable($sql);
				
				// i wszystkie pozostałe wersje językowe (puste)
				$sql = "select * from language";
				$languages_list = $this->DBM->getTable($sql);
				
				if (sizeof($languages_list)) {
					foreach ($languages_list as $language) {
						// bez tego, który już wczesniej zapisaliśmy!
						if ($language['id'] != $baner_form['language_id']) {
							$sql  = "insert into baner_multilang (baner_id, language_id, status, date_created, date_modified, title) ";
							$sql .= " values ('$baner_id', '$language[id]', '0', '$date_now', '$date_now', '$baner_form[title]') ";
							$rv = $this->DBM->modifyTable($sql);
						}
					}
				}
			}
		}
		else {
			
			// aktualizacja artykułu
			
			// najpierw metryka artykułu (zmiana conajwyżej kategorii)
			$sql = "update baner set category_id = '$baner_form[category_id]' where id = '$baner_form[baner_id]'";
			$rv = $this->DBM->modifyTable($sql);
			
			
					// update obrazka (usunięcie lub aktualizacja - o ile został podany) nr 1
			if ($baner_form['remove_picture_01']) {
				// usuwamy obrazek
				$pic_01 = "";
				$sql = "update baner set pic_01 = '$pic_01' where id = '$baner_form[baner_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				unlink($__CFG['baner_pictures_path'].$baner_form['baner_id']."_01_01.jpg");
				unlink($__CFG['baner_pictures_path'].$baner_form['baner_id']."_02_01.jpg");
				unlink($__CFG['baner_pictures_path'].$baner_form['baner_id']."_03_01.jpg");
			}
			elseif ($_FILES['pic_01']['name']) {
				// aktualizujemy obrazek
				$pic_01 = "baner_".$baner_form['baner_id']."_01.jpg";
				$sql = "update baner set pic_01 = '$pic_01' where id = '$baner_form[baner_id]'";
				$rv = $this->DBM->modifyTable($sql);

				// pierwsza miniatura
				$this->resizeBanerPicture ($_FILES['pic_01']['tmp_name'], $__CFG['baner_pictures_path'].$baner_form[baner_id]."_01_01.jpg", 35, 20);
				$this->resizeBanerPicture ($_FILES['pic_01']['tmp_name'], $__CFG['baner_pictures_path'].$baner_form[baner_id]."_02_01.jpg", 100, 75);
				$this->resizeBanerPicture ($_FILES['pic_01']['tmp_name'], $__CFG['baner_pictures_path'].$baner_form[baner_id]."_03_01.jpg", 200, 130);
				unlink($_FILES['pic_01']['tmp_name']);					
				
			}
			
			
			// update obrazka (usunięcie lub aktualizacja - o ile został podany) nr 2
			if ($baner_form['remove_picture_02']) {
				// usuwamy obrazek
				$pic_02 = "";
				$sql = "update baner set pic_02 = '$pic_02' where id = '$baner_form[baner_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				unlink($__CFG['baner_pictures_path'].$baner_form['baner_id']."_01_02.jpg");
				unlink($__CFG['baner_pictures_path'].$baner_form['baner_id']."_02_02.jpg");
				unlink($__CFG['baner_pictures_path'].$baner_form['baner_id']."_03_02.jpg");
			}
			elseif ($_FILES['pic_02']['name']) {
				// aktualizujemy obrazek
				$pic_02 = "baner_".$baner_form['baner_id']."_02.jpg";
				$sql = "update baner set pic_02 = '$pic_02' where id = '$baner_form[baner_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeBanerPicture ($_FILES['pic_02']['tmp_name'], $__CFG['baner_pictures_path'].$baner_form[baner_id]."_01_02.jpg", 35, 20);
				$this->resizeBanerPicture ($_FILES['pic_02']['tmp_name'], $__CFG['baner_pictures_path'].$baner_form[baner_id]."_02_02.jpg", 100, 75);
				$this->resizeBanerPicture ($_FILES['pic_02']['tmp_name'], $__CFG['baner_pictures_path'].$baner_form[baner_id]."_03_02.jpg", 200, 130);
				unlink($_FILES['pic_02']['tmp_name']);					
				
			}			
			
			// update obrazka (usunięcie lub aktualizacja - o ile został podany) nr 3
			if ($baner_form['remove_picture_03']) {
				// usuwamy obrazek
				$pic_03 = "";
				$sql = "update baner set pic_03 = '$pic_03' where id = '$baner_form[baner_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				unlink($__CFG['baner_pictures_path'].$baner_form['baner_id']."_01_03.jpg");
				unlink($__CFG['baner_pictures_path'].$baner_form['baner_id']."_02_03.jpg");
				unlink($__CFG['baner_pictures_path'].$baner_form['baner_id']."_03_03.jpg");
			}
			elseif ($_FILES['pic_03']['name']) {
				// aktualizujemy obrazek
				$pic_03 = "baner_".$baner_form['baner_id']."_03.jpg";
				$sql = "update baner set pic_03 = '$pic_03' where id = '$baner_form[baner_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeBanerPicture ($_FILES['pic_03']['tmp_name'], $__CFG['baner_pictures_path'].$baner_form[baner_id]."_01_03.jpg", 35, 20);
				$this->resizeBanerPicture ($_FILES['pic_03']['tmp_name'], $__CFG['baner_pictures_path'].$baner_form[baner_id]."_02_03.jpg", 100, 75);
				$this->resizeBanerPicture ($_FILES['pic_03']['tmp_name'], $__CFG['baner_pictures_path'].$baner_form[baner_id]."_03_03.jpg", 200, 130);
				unlink($_FILES['pic_03']['tmp_name']);					
				
			}
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			// a potem wersja językowa
			$sql = "update baner_multilang set title = '$baner_form[title]', abstract = '$baner_form[abstract]', content = '$baner_form[content]', link = '$baner_form[link]', price = '$baner_form[price]', status = '$baner_form[status]', date_modified = '$date_now' where baner_id = '$baner_form[baner_id]' and language_id = '$baner_form[language_id]'";
			$rv = $this->DBM->modifyTable($sql);
			
		}
		
		// zwracamy ID ostatnio zapisanego artykułu
		if ($baner_id) { 
			return $baner_id;
		}
		else {
			return $baner_form['baner_id'];
		}
	}
	
	/**
	 * usuwa pojedynczy artykuł
	 */
	
	function removeBaner($baner_id) {
			
		if ($baner_id) {
			// metryka
			$sql = "delete from baner where id = $baner_id ";
			$rv = $this->DBM->modifyTable($sql);
			// i wszystkie wersje językowe
			$sql = "delete from baner_multilang where baner_id = $baner_id ";
			$rv = $this->DBM->modifyTable($sql);
		}
		return $rv;
	}
	
	/**
	 * uaktualnia automatycznie kolejnosc artykułow w kategorii
	 */
	
	function updateOrders($baner_id, $position) {
			
		if ($baner_id && $position) {
			
			$sql = "update baner set `order` = '$position' where id = '$baner_id' ";
			$rv = $this->DBM->modifyTable($sql);
		}
		return $rv;

	}
	
	/**
	 * gets n random baners from given category
	 */
	
	function getRandomBaners ($category_id, $limit, $lang_id) {
		
		if ($category_id && $limit && $lang_id) {
			$sql = "select baner.category_id, baner.order, baner_multilang.* from baner, baner_multilang where baner_multilang.baner_id = baner.id and baner.category_id = '$category_id' and baner_multilang.language_id = '$lang_id' order by rand() limit $limit";
			$baner_list = $this->DBM->getTable($sql);
			
			return $baner_list;
		}
		
	}
	
	/**
	 * wysyła artykuł mailem (HTML)
	 */
	
	function sendBanerByEmail ($baner_details, $email) {
		
		global $_mail_params;
		global $dict_templates;
		global $__CFG;
		global $smarty;
		
		if (sizeof($baner_details) && $email) {
			//print_r($baner_details);
			$smarty->assign("baner", $baner_details);
			
			$content = $smarty->fetch("baner_send.tpl");
				
			$mail_data['html_body'] = $content;
			
			$mail_data['headers']['MIME-Version']= '1.0';
			$mail_data['headers']['Subject'] = $dict_templates['SendBanerSubject'];
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
	 * gets all baners
	 */
	
	function getBanersAll ($lang_id) {
		
		if ($lang_id) {
			$sql = "select * from baner_multilang where language_id = '$lang_id' order by date_modified desc ";
			$baner_list = $this->DBM->getTable($sql);
			
			return $baner_list;
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
	 * przeskalowuje importowane zdjęcie w miejscu - z resamplingiem
	 */
	
	function resizeBanerPicture ($source_path, $target_path, $xmin, $ymin) {
		
		global $__CFG;
		
		if ($source_path && $target_path && $xmin && $ymin) {
			
			// tylko jeden format zdjęć jest dozwolony
			
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
				
				imagejpeg($image_p, $target_path, 100);
				
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
				
				imagegif($image_p, $target_path, 100);
				
			}
		}
		else {
			return false;
		}
	}	
	
	
	
	
}
?>