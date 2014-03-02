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

class Slideshow {

	/**
	 * @var object DBManager
	 */
	var $DBM;

	function Slideshow() {
		global $DBM;
	 	$this->DBM = $DBM;
	}
	
	/**
	 * pobiera listę artykułów (posortowaną)
	 */
	
	function getSlideshows($order = "order", $direction = "desc", $page_number = 1, $category_id = 1, $lang_id) {
		
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		if (!$category_id) $category_id = 1;
		
		$sql  = "select count(*) as ilosc from slideshow, slideshow_multilang where slideshow_multilang.slideshow_id = slideshow.id and slideshow.category_id = '$category_id' and slideshow_multilang.language_id = '$lang_id'";
				
		$temp = $this->DBM->getRow($sql);
		$record_count = $temp['ilosc'];
		
		$sql  = "select slideshow.category_id, slideshow.order, slideshow.pic_01, slideshow_multilang.* from slideshow, slideshow_multilang where slideshow_multilang.slideshow_id = slideshow.id and slideshow.category_id = '$category_id' and slideshow_multilang.language_id = '$lang_id' ";		
		$sql .= " order by slideshow.`$order` $direction limit $offset, $limit ";
		
		// echo $sql."<hr>";
		
		$slideshow_list_temp = $this->DBM->getTable($sql);
		
		// reindex array
		if (sizeof($slideshow_list_temp)) {
			$slideshow_list = array();
			foreach ($slideshow_list_temp as $slideshow_details) {
				$slideshow_list[$slideshow_details[slideshow_id]] = $slideshow_details;
			}
		}
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParameters($record_count, $page_number);
		}
		
		return $slideshow_list;
	}
	
	/**
	 * Przestawia status 
	 */
	
	function setStatus ($slideshow_id, $status) {
		
		if ($slideshow_id) {
			
			$sql = "update slideshow_multilang set status = '$status' where slideshow_multilang.slideshow_id = '$slideshow_id' ";
			$this->DBM->modifyTable($sql);
			
		}
	}	
	
	/**
	 * Oznaczenie jako wysłany 
	 */
	
	function setSended ($slideshow_id) {
		
		if ($slideshow_id) {
			
			$sql = "update slideshow_multilang set sended = '1' where slideshow_multilang.slideshow_id = '$slideshow_id' ";
			$this->DBM->modifyTable($sql);
			
		}
	}	
		
	/**
	 * pobiera przefiltrowaną listę artykułów
	 */
	
	function getSlideshowsSearch($order = "order", $direction = "desc", $search_form = null, $page_number = 1, $lang_id) {
		
		
			// ustawienie numeru strony do stronicowania (jezeli nie została podana)
			if (!sizeof($_REQUEST['page_number'])) {
				$_REQUEST['page_number'] = 1;
			}		
		
		$page_number = $_REQUEST['page_number'];
		
		
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		$sql  = "select slideshow.category_id, slideshow.order, slideshow.pic_01, slideshow_multilang.* from slideshow, slideshow_multilang where slideshow_multilang.slideshow_id = slideshow.id and slideshow_multilang.language_id = '$lang_id' ";		
		$sql_count  = "select count(*) as ilosc from slideshow, slideshow_multilang where slideshow_multilang.slideshow_id = slideshow.id and slideshow_multilang.language_id = '$lang_id' ";
				
		if(sizeof($search_form)) {
			
			if ($search_form['category_id']) {
				$sql .= " AND slideshow.category_id = ".$search_form['category_id']." ";
				$sql_count .= " AND slideshow.category_id = ".$search_form['category_id']." ";
			}
			if ($search_form['title']) {
				$sql .= " AND lower(slideshow_multilang.title) like lower('%".$search_form['title']."%') ";
				$sql_count .= " AND lower(slideshow_multilang.title) like lower('%".$search_form['title']."%') ";
			}
			if ($search_form['abstract']) {
				$sql .= " AND lower(slideshow_multilang.abstract) like lower('%".$search_form['abstract']."%') ";
				$sql_count .= " AND lower(slideshow_multilang.abstract) like lower('%".$search_form['abstract']."%') ";
			}
			if ($search_form['content']) {
				$sql .= " AND lower(slideshow_multilang.content) like lower('%".$search_form['content']."%') ";
				$sql_count .= " AND lower(slideshow_multilang.content) like lower('%".$search_form['content']."%') ";
			}
			if ($search_form['status']) {
				$sql .= " AND slideshow_multilang.status = ".$search_form['status']." ";
				$sql_count .= " AND slideshow_multilang.status = ".$search_form['status']." ";
			}
			if ($search_form['date_created_from'] && $search_form['date_created_to']) {
				$sql .= " AND slideshow_multilang.date_created between '".$search_form['date_created_from']."' and '".$search_form['date_created_to']."' ";
				$sql_count .= " AND slideshow_multilang.date_created between '".$search_form['date_created_from']."' and '".$search_form['date_created_to']."' ";
			}
			if ($search_form['date_modified_from'] && $search_form['date_modified_to']) {
				$sql .= " AND slideshow_multilang.date_modified between '".$search_form['date_modified_from']."' and '".$search_form['date_modified_to']."' ";
				$sql_count .= " AND slideshow_multilang.date_modified between '".$search_form['date_modified_from']."' and '".$search_form['date_modified_to']."' ";
			}
		}
		
		$sql .= " order by slideshow.`$order` $direction ";
		$sql .= " limit $offset, $limit ";
		
		// echo $sql;
		
		// ilośc wszystkich rekordów
		$temp = $this->DBM->getRow($sql_count);
		$record_count = $temp['ilosc'];
		
		// echo $record_count."<br>";
		
		$slideshow_list_temp = $this->DBM->getTable($sql);
		
		// reindex array
		if (sizeof($slideshow_list_temp)) {
			$slideshow_list = array();
			foreach ($slideshow_list_temp as $slideshow_details) {
				$slideshow_list[$slideshow_details[slideshow_id]] = $slideshow_details;
			}
		}
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParametersNew($record_count, $page_number, $limit);
		}
		
		return $slideshow_list;
	}
		
	/**
	 * pobiera przefiltrowaną listę artykułów powiązanych z podanym produktem
	 * wraz z listą wszystkich dostępnych artykułów (dla celów administracyjnych)
	 */
	
	function getSlideshowsForProduct($product_id, $order = "order", $direction = "desc", $search_form = null, $page_number = 1, $lang_id) {
		
		global $__CFG;
		
		if ($product_id) {
			
			// najpierw wybieramy normalną listę artykułów - przefiltrowaną wg. wskazanych filtrów
			$slideshow_list = $this->getSlideshowsSearch($order, $direction, $search_form, $page_number, $lang_id);
			
			// następnie wybieramy listę artykułów powiązanych z podanym produktem
			$sql = "select * from product_slideshow where product_id = '$product_id'";
			$slideshows_temp = $this->DBM->getTable($sql);
			
			// przelatujemy tą tablicę zazanczając na liscie wssystkich artykułów te, które są powiązane
			if (sizeof($slideshows_temp)) {
				foreach ($slideshows_temp as $details) {
					if ($slideshow_list[$details['slideshow_id']]) {
						$slideshow_list[$details['slideshow_id']]['selected'] = 1;
					}
				}
			}
			
			return $slideshow_list;
		}
	}
	
	/**
	 * pobiera artykuły TYLKO powiązane z podanym produktem
	 */
	
	function getSlideshowsOnlyForProduct ($product_id, $lang_id) {
		
		if ($product_id && $lang_id) {
			
			$sql = "select slideshow.category_id, slideshow.order, slideshow.pic_01, slideshow_multilang.* from slideshow, slideshow_multilang, product_slideshow where slideshow_multilang.slideshow_id = slideshow.id and product_slideshow.slideshow_id = slideshow.id and slideshow_multilang.language_id = '$lang_id' and product_slideshow.product_id = '$product_id' ";
			$slideshow_list = $this->DBM->getTable($sql);
			
			return $slideshow_list;
		}
	}
	
	
	/**
	 * get slideshows by category id
	 */
	
	function getSlideshowsByCategory ($category_id, $lang_id) {
		
		if ($category_id && $lang_id) {
			$search_form['category_id'] = $category_id;
			$search_form['status'] = 2;
			// paging cheating ;-)
			$__CFG['record_count_limit'] = 1;
			
			$slideshow_list = $this->getSlideshowsSearch("order", "desc", $search_form, 1, $lang_id, $page_number);
			
			return $slideshow_list;
		}
	}
	
	/**
	 * get slideshows by category id
	 */
	
	function getSlideshowsToMenu ($category_id, $lang_id) {
		
		if ($category_id && $lang_id) {
			$search_form['category_id'] = $category_id;
			$search_form['status'] = 2;
			// paging cheating ;-)
			$__CFG['record_count_limit'] = 1;
			
			$slideshow_list = $this->getSlideshowsSearch("order", "asc", $search_form, 1, $lang_id, $page_number);
			
			return $slideshow_list;
		}
	}
	
	/**
	 * wyciaga dane o znajomych
	 */
	
	function getSlideshowsByNews ($limit, $page_number, $lang_id){
		
		if($limit){

			global $__CFG;
		// TEST!!!
		$__CFG['record_count_limit'] = $limit;
		
		$limit = $__CFG['record_count_limit'];			
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select slideshow.category_id, slideshow.order, slideshow.pic_01, slideshow_multilang.* from slideshow, slideshow_multilang where slideshow_multilang.slideshow_id = slideshow.id and slideshow_multilang.language_id = '$lang_id' and slideshow.category_id = '5' order by date_created desc";		
			$sql_count  = "select count(*) as ilosc from slideshow, slideshow_multilang where slideshow_multilang.slideshow_id = slideshow.id and slideshow_multilang.language_id = '$lang_id' and slideshow.category_id = '5' ";
			
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
	
	function getSlideshowsByCategoryToView ($limit, $page_number, $lang_id, $category_id){
		
		if($limit && $page_number && $lang_id && $category_id){

			global $__CFG;		
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select slideshow.category_id, slideshow.order, slideshow.pic_01, slideshow_multilang.* from slideshow, slideshow_multilang where slideshow_multilang.slideshow_id = slideshow.id and slideshow_multilang.language_id = '$lang_id' and slideshow.category_id = '$category_id' and slideshow_multilang.status = 2 order by rand() ";		
			$sql_count  = "select count(*) as ilosc from slideshow, slideshow_multilang where slideshow_multilang.slideshow_id = slideshow.id and slideshow_multilang.language_id = '$lang_id' and slideshow.category_id = '$category_id' and slideshow_multilang.status = 2 ";
			
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
			
			
			$sql  = "select slideshow.category_id, slideshow.order, slideshow.pic_01, slideshow_multilang.* from slideshow, slideshow_multilang where slideshow_multilang.slideshow_id = slideshow.id and slideshow_multilang.language_id = '$lang_id' and slideshow.category_id = '$category_id' and slideshow_multilang.status = 2 order by rand() asc";		
			$sql_count  = "select count(*) as ilosc from slideshow, slideshow_multilang where slideshow_multilang.slideshow_id = slideshow.id and slideshow_multilang.language_id = '$lang_id' and slideshow.category_id = '$category_id' and slideshow_multilang.status = 2 ";
			
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
	
	function getSlideshowsByCategoryAndTypeToView ($type, $limit, $page_number, $lang_id, $category_id){
		
			if($type && $limit && $page_number && $lang_id && $category_id){
			
			global $__CFG;		
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select slideshow.category_id, slideshow.order, slideshow.pic_01, slideshow_multilang.* from slideshow, slideshow_multilang where slideshow_multilang.slideshow_id = slideshow.id and slideshow_multilang.language_id = '$lang_id' and slideshow.category_id = '$category_id' and slideshow_multilang.type = '$type' order by `order` asc";		
			$sql_count  = "select count(*) as ilosc from slideshow, slideshow_multilang where slideshow_multilang.slideshow_id = slideshow.id and slideshow_multilang.language_id = '$lang_id' and slideshow.category_id = '$category_id' and slideshow_multilang.type = '$type' ";
			
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
	
	function getSlideshowByUrlNameAndId($url_name, $slideshow_id) {
			
		if ($url_name && $slideshow_id) {	
			//print_r($slideshow_id);
			$sql = "select slideshow_multilang.* from slideshow_multilang where slideshow_multilang.url_name = '$url_name' and slideshow_multilang.slideshow_id != '$slideshow_id'";
			$rv = $this->DBM->getRow($sql);
			//echo $sql;
			
		}
		return $rv;
	}
	
	/**
	 * sprawdza czy dany artykuł istnieje o tej samej nazwie url /uzywane do walidacji - dla nowgo artykułu/
	 */
	
	function getSlideshowByUrlName($url_name) {
			
		if ($url_name) {	
			$sql = "select slideshow_multilang.* from slideshow_multilang where slideshow_multilang.url_name = '$url_name' ";
			$rv = $this->DBM->getRow($sql);
			
		}
		return $rv;
	}
	
	/**
	 * pobiera pojedynczy artykuł do edycji
	 */
	
	function getSlideshow($slideshow_id, $lang_id) {
			
		if ($slideshow_id && $lang_id) {	
			$sql = "select slideshow.category_id, slideshow.order, slideshow.pic_01, slideshow.pic_02, slideshow.pic_03, slideshow_multilang.* from slideshow, slideshow_multilang where slideshow_multilang.slideshow_id = slideshow.id and slideshow.id = '$slideshow_id' and slideshow_multilang.language_id = '$lang_id'";
			$rv = $this->DBM->getRow($sql);
			
		}
		return $rv;
	}
	
	/**
	 * pobiera pojedynczy artykuł do edycji
	 */
	
	function getSlideshowByUrlNameToView($url_name, $lang_id) {
			
		if ($url_name && $lang_id) {	
			$sql = "select slideshow.category_id, slideshow.order, slideshow.pic_01, slideshow.pic_02, slideshow.pic_03, slideshow_multilang.* from slideshow, slideshow_multilang where slideshow_multilang.slideshow_id = slideshow.id and slideshow_multilang.url_name = '$url_name' and slideshow_multilang.language_id = '$lang_id'";
			$slideshow_details = $this->DBM->getRow($sql);
			
		
			if (sizeof($slideshow_details)) {
				
				// wybieramy nastepny (nowszy)
				
				$sql = "select slideshow_multilang.* from slideshow, slideshow_multilang where slideshow_multilang.slideshow_id = slideshow.id and slideshow.`order` > '$slideshow_details[order]' and slideshow.category_id = '$slideshow_details[category_id]' and slideshow_multilang.language_id = '$lang_id' and slideshow_multilang.status != 1 order by slideshow.`order` asc limit 1";
				$next_slideshow = $this->DBM->getRow($sql);
				
				if (sizeof($next_slideshow)) {
					$slideshow_details['next'] = $next_slideshow['url_name'];
				}
				
				// wybieramy poprzedni (starszy) 
				
				$sql = "select slideshow_multilang.* from slideshow, slideshow_multilang where slideshow_multilang.slideshow_id = slideshow.id and slideshow.`order` < '$slideshow_details[order]' and slideshow.category_id = '$slideshow_details[category_id]' and slideshow_multilang.language_id = '$lang_id' and slideshow_multilang.status != 1 order by slideshow.`order` desc limit 1";
				$previous_slideshow = $this->DBM->getRow($sql);
				
				if (sizeof($previous_slideshow)) {
					$slideshow_details['previous'] = $previous_slideshow['url_name'];
				}
			}		
		
		
		}
		return $slideshow_details;
	}
	
	/**
	 * pobiera pojedynczy artykuł do edycji
	 */
	
	function getSlideshowByUrlNameAndTypeToView($type, $url_name, $lang_id) {
			
		if ($url_name && $lang_id) {	
			$sql = "select slideshow.category_id, slideshow.order, slideshow.pic_01, slideshow.pic_02, slideshow.pic_03, slideshow_multilang.* from slideshow, slideshow_multilang where slideshow_multilang.slideshow_id = slideshow.id and slideshow_multilang.url_name = '$url_name' and slideshow_multilang.language_id = '$lang_id'";
			$slideshow_details = $this->DBM->getRow($sql);
			
		
			if (sizeof($slideshow_details)) {
				
				// wybieramy nastepny (nowszy)
				
				$sql = "select slideshow_multilang.* from slideshow, slideshow_multilang where slideshow_multilang.slideshow_id = slideshow.id and slideshow.`order` > '$slideshow_details[order]' and slideshow.category_id = '$slideshow_details[category_id]' and slideshow_multilang.language_id = '$lang_id' and slideshow_multilang.type = '$type' and slideshow_multilang.status != 1 order by slideshow.`order` asc limit 1";
				$next_slideshow = $this->DBM->getRow($sql);
				
				if (sizeof($next_slideshow)) {
					$slideshow_details['next'] = $next_slideshow['url_name'];
				}
				
				// wybieramy poprzedni (starszy) 
				
				$sql = "select slideshow_multilang.* from slideshow, slideshow_multilang where slideshow_multilang.slideshow_id = slideshow.id and slideshow.`order` < '$slideshow_details[order]' and slideshow.category_id = '$slideshow_details[category_id]' and slideshow_multilang.language_id = '$lang_id' and slideshow_multilang.type = '$type' and slideshow_multilang.status != 1 order by slideshow.`order` desc limit 1";
				$previous_slideshow = $this->DBM->getRow($sql);
				
				if (sizeof($previous_slideshow)) {
					$slideshow_details['previous'] = $previous_slideshow['url_name'];
				}
			}		
		
		
		}
		return $slideshow_details;
	}
	
	/**
	 * wyciąga pierwszy artykuł z podanej kategorii (tylko id)
	 */
	
	function getFirstSlideshowInCategory ($category_id, $lang_id) {
		
		if ($category_id) {
			
			$sql = "select slideshow.id from slideshow, slideshow_multilang where slideshow_multilang.slideshow_id = slideshow.id and slideshow.category_id = '$category_id' and slideshow_multilang.language_id = '$lang_id' and slideshow_multilang.status != 0 order by slideshow.`order` desc limit 1";
			$details = $this->DBM->getRow($sql);
			
			return $details['id'];
		}
	}
	
	/**
	 * pobiera pojedynczy artykuł do widoku szczegółów
	 */
	
	function getSlideshowDetails($slideshow_id, $lang_id) {
		
		if ($slideshow_id && $lang_id) {
			$sql = "select slideshow.category_id, slideshow.order, slideshow.pic_01, slideshow_multilang.* from slideshow, slideshow_multilang where slideshow_multilang.slideshow_id = slideshow.id and slideshow.id = '$slideshow_id' and slideshow_multilang.language_id = '$lang_id'";
			$rv = $this->DBM->getRow($sql);
		}
		return $rv;
	}
	
	/**
	 * zapisuje pojedynczy artykuł
	 */
	
	function saveSlideshow($slideshow_form) {
		
		global $__CFG;
		
		// data bieżąca 
		if($slideshow_form['date_created']){
			
			$date_now = $slideshow_form['date_created'];
			
		}
		else{
			
			$date_now = date("Y-m-d H:i:s", time());
			
		}
		
		
		
		if (!$slideshow_form['slideshow_id']) {
			
			// kolejność - to jest do przeniesienia do nowej klasy Order (?) albo osobna metoda w tej klasie (?)
			$sql = "select max(`order`) as last_order from slideshow where category_id = '$slideshow_form[category_id]'";
			$order = $this->DBM->getRow($sql);
			$next_order = $order['last_order'] + 1;
			
			// nowa metryka
			$sql = "insert into slideshow (category_id, `order`) values ('$slideshow_form[category_id]', '0') ";
			$rv = $this->DBM->modifyTable($sql);
			$slideshow_id = $this->DBM->lastInsertID;
			
					// dodaj obrazek nr 1
			if ($_FILES['pic_01']['name']) {
				$pic_01 = "slideshow_".$slideshow_id."_01.jpg";
				$sql = "update slideshow set pic_01 = '$pic_01' where id = '$slideshow_id'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeSlideshowPicture ($_FILES['pic_01']['tmp_name'], $__CFG['slideshow_pictures_path'].$slideshow_id."_01_01.jpg", 70, 70);
				$this->resizeSlideshowPicture ($_FILES['pic_01']['tmp_name'], $__CFG['slideshow_pictures_path'].$slideshow_id."_02_01.jpg", 130, 130);
				$this->resizeSlideshowPicture ($_FILES['pic_01']['tmp_name'], $__CFG['slideshow_pictures_path'].$slideshow_id."_03_01.jpg", 265, 265);
				unlink($_FILES['pic_01']['tmp_name']);				
				

			}
			
			// dodaj obrazek nr 2
			if ($_FILES['pic_02']['name']) {
				$pic_02 = "slideshow_".$slideshow_id."_02.jpg";
				$sql = "update slideshow set pic_02 = '$pic_02' where id = '$slideshow_id'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeSlideshowPicture ($_FILES['pic_02']['tmp_name'], $__CFG['slideshow_pictures_path'].$slideshow_id."_01_02.jpg", 70, 70);
				$this->resizeSlideshowPicture ($_FILES['pic_02']['tmp_name'], $__CFG['slideshow_pictures_path'].$slideshow_id."_02_02.jpg", 130, 130);
				$this->resizeSlideshowPicture ($_FILES['pic_02']['tmp_name'], $__CFG['slideshow_pictures_path'].$slideshow_id."_03_02.jpg", 265, 265);
				unlink($_FILES['pic_02']['tmp_name']);				
				

			}
			
					
			// dodaj obrazek nr 3
			if ($_FILES['pic_03']['name']) {
				$pic_03 = "slideshow_".$slideshow_id."_03.jpg";
				$sql = "update slideshow set pic_03 = '$pic_03' where id = '$slideshow_id'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeSlideshowPicture ($_FILES['pic_03']['tmp_name'], $__CFG['slideshow_pictures_path'].$slideshow_id."_01_03.jpg", 70, 70);
				$this->resizeSlideshowPicture ($_FILES['pic_03']['tmp_name'], $__CFG['slideshow_pictures_path'].$slideshow_id."_02_03.jpg", 130, 130);
				$this->resizeSlideshowPicture ($_FILES['pic_03']['tmp_name'], $__CFG['slideshow_pictures_path'].$slideshow_id."_03_03.jpg", 265, 265);
				unlink($_FILES['pic_03']['tmp_name']);				
				

			}			
		
			
			if ($slideshow_id) {
				
				// zapisujemy wersję językową
				$sql  = "insert into slideshow_multilang (slideshow_id, language_id, title, abstract, content, link, price, status, date_created, date_modified, sended) ";
				$sql .= " values ('$slideshow_id', '$slideshow_form[language_id]', '$slideshow_form[title]', '$slideshow_form[abstract]', '$slideshow_form[content]', '$slideshow_form[link]', '$slideshow_form[price]', '$slideshow_form[status]', '$date_now', '$date_now', '$slideshow_form[sended]') ";
				$rv = $this->DBM->modifyTable($sql);
				
				// i wszystkie pozostałe wersje językowe (puste)
				$sql = "select * from language";
				$languages_list = $this->DBM->getTable($sql);
				
				if (sizeof($languages_list)) {
					foreach ($languages_list as $language) {
						// bez tego, który już wczesniej zapisaliśmy!
						if ($language['id'] != $slideshow_form['language_id']) {
							$sql  = "insert into slideshow_multilang (slideshow_id, language_id, status, date_created, date_modified, title) ";
							$sql .= " values ('$slideshow_id', '$language[id]', '0', '$date_now', '$date_now', '$slideshow_form[title]') ";
							$rv = $this->DBM->modifyTable($sql);
						}
					}
				}
			}
		}
		else {
			
			// aktualizacja artykułu
			
			// najpierw metryka artykułu (zmiana conajwyżej kategorii)
			$sql = "update slideshow set category_id = '$slideshow_form[category_id]' where id = '$slideshow_form[slideshow_id]'";
			$rv = $this->DBM->modifyTable($sql);
			
			
					// update obrazka (usunięcie lub aktualizacja - o ile został podany) nr 1
			if ($slideshow_form['remove_picture_01']) {
				// usuwamy obrazek
				$pic_01 = "";
				$sql = "update slideshow set pic_01 = '$pic_01' where id = '$slideshow_form[slideshow_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				unlink($__CFG['slideshow_pictures_path'].$slideshow_form['slideshow_id']."_01_01.jpg");
				unlink($__CFG['slideshow_pictures_path'].$slideshow_form['slideshow_id']."_02_01.jpg");
				unlink($__CFG['slideshow_pictures_path'].$slideshow_form['slideshow_id']."_03_01.jpg");
			}
			elseif ($_FILES['pic_01']['name']) {
				// aktualizujemy obrazek
				$pic_01 = "slideshow_".$slideshow_form['slideshow_id']."_01.jpg";
				$sql = "update slideshow set pic_01 = '$pic_01' where id = '$slideshow_form[slideshow_id]'";
				$rv = $this->DBM->modifyTable($sql);

				// pierwsza miniatura
				$this->resizeSlideshowPicture ($_FILES['pic_01']['tmp_name'], $__CFG['slideshow_pictures_path'].$slideshow_form[slideshow_id]."_01_01.jpg", 70, 70);
				$this->resizeSlideshowPicture ($_FILES['pic_01']['tmp_name'], $__CFG['slideshow_pictures_path'].$slideshow_form[slideshow_id]."_02_01.jpg", 130, 130);
				$this->resizeSlideshowPicture ($_FILES['pic_01']['tmp_name'], $__CFG['slideshow_pictures_path'].$slideshow_form[slideshow_id]."_03_01.jpg", 265, 265);
				unlink($_FILES['pic_01']['tmp_name']);					
				
			}
			
			
			// update obrazka (usunięcie lub aktualizacja - o ile został podany) nr 2
			if ($slideshow_form['remove_picture_02']) {
				// usuwamy obrazek
				$pic_02 = "";
				$sql = "update slideshow set pic_02 = '$pic_02' where id = '$slideshow_form[slideshow_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				unlink($__CFG['slideshow_pictures_path'].$slideshow_form['slideshow_id']."_01_02.jpg");
				unlink($__CFG['slideshow_pictures_path'].$slideshow_form['slideshow_id']."_02_02.jpg");
				unlink($__CFG['slideshow_pictures_path'].$slideshow_form['slideshow_id']."_03_02.jpg");
			}
			elseif ($_FILES['pic_02']['name']) {
				// aktualizujemy obrazek
				$pic_02 = "slideshow_".$slideshow_form['slideshow_id']."_02.jpg";
				$sql = "update slideshow set pic_02 = '$pic_02' where id = '$slideshow_form[slideshow_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeSlideshowPicture ($_FILES['pic_02']['tmp_name'], $__CFG['slideshow_pictures_path'].$slideshow_form[slideshow_id]."_01_02.jpg", 70, 70);
				$this->resizeSlideshowPicture ($_FILES['pic_02']['tmp_name'], $__CFG['slideshow_pictures_path'].$slideshow_form[slideshow_id]."_02_02.jpg", 130, 130);
				$this->resizeSlideshowPicture ($_FILES['pic_02']['tmp_name'], $__CFG['slideshow_pictures_path'].$slideshow_form[slideshow_id]."_03_02.jpg", 265, 265);
				unlink($_FILES['pic_02']['tmp_name']);					
				
			}			
			
			// update obrazka (usunięcie lub aktualizacja - o ile został podany) nr 3
			if ($slideshow_form['remove_picture_03']) {
				// usuwamy obrazek
				$pic_03 = "";
				$sql = "update slideshow set pic_03 = '$pic_03' where id = '$slideshow_form[slideshow_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				unlink($__CFG['slideshow_pictures_path'].$slideshow_form['slideshow_id']."_01_03.jpg");
				unlink($__CFG['slideshow_pictures_path'].$slideshow_form['slideshow_id']."_02_03.jpg");
				unlink($__CFG['slideshow_pictures_path'].$slideshow_form['slideshow_id']."_03_03.jpg");
			}
			elseif ($_FILES['pic_03']['name']) {
				// aktualizujemy obrazek
				$pic_03 = "slideshow_".$slideshow_form['slideshow_id']."_03.jpg";
				$sql = "update slideshow set pic_03 = '$pic_03' where id = '$slideshow_form[slideshow_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeSlideshowPicture ($_FILES['pic_03']['tmp_name'], $__CFG['slideshow_pictures_path'].$slideshow_form[slideshow_id]."_01_03.jpg", 70, 70);
				$this->resizeSlideshowPicture ($_FILES['pic_03']['tmp_name'], $__CFG['slideshow_pictures_path'].$slideshow_form[slideshow_id]."_02_03.jpg", 130, 130);
				$this->resizeSlideshowPicture ($_FILES['pic_03']['tmp_name'], $__CFG['slideshow_pictures_path'].$slideshow_form[slideshow_id]."_03_03.jpg", 265, 265);
				unlink($_FILES['pic_03']['tmp_name']);					
				
			}
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			// a potem wersja językowa
			$sql = "update slideshow_multilang set title = '$slideshow_form[title]', abstract = '$slideshow_form[abstract]', content = '$slideshow_form[content]', link = '$slideshow_form[link]', price = '$slideshow_form[price]', status = '$slideshow_form[status]', date_modified = '$date_now', sended = '$slideshow_form[sended]' where slideshow_id = '$slideshow_form[slideshow_id]' and language_id = '$slideshow_form[language_id]'";
			$rv = $this->DBM->modifyTable($sql);
			
		}
		
		// zwracamy ID ostatnio zapisanego artykułu
		if ($slideshow_id) { 
			return $slideshow_id;
		}
		else {
			return $slideshow_form['slideshow_id'];
		}
	}
	
	/**
	 * usuwa pojedynczy artykuł
	 */
	
	function removeSlideshow($slideshow_id) {
			
		if ($slideshow_id) {
			// metryka
			$sql = "delete from slideshow where id = $slideshow_id ";
			$rv = $this->DBM->modifyTable($sql);
			// i wszystkie wersje językowe
			$sql = "delete from slideshow_multilang where slideshow_id = $slideshow_id ";
			$rv = $this->DBM->modifyTable($sql);
		}
		return $rv;
	}
	
	/**
	 * uaktualnia automatycznie kolejnosc artykułow w kategorii
	 */
	
	function updateOrders($slideshow_id, $position) {
			
		if ($slideshow_id && $position) {
			
			$sql = "update slideshow set `order` = '$position' where id = '$slideshow_id' ";
			$rv = $this->DBM->modifyTable($sql);
		}
		return $rv;

	}
	
	/**
	 * gets n random slideshows from given category
	 */
	
	function getRandomSlideshows ($category_id, $limit, $lang_id) {
		
		if ($category_id && $limit && $lang_id) {
			$sql = "select slideshow.category_id, slideshow.order, slideshow_multilang.* from slideshow, slideshow_multilang where slideshow_multilang.slideshow_id = slideshow.id and slideshow.category_id = '$category_id' and slideshow_multilang.language_id = '$lang_id' order by rand() limit $limit";
			$slideshow_list = $this->DBM->getTable($sql);
			
			return $slideshow_list;
		}
		
	}
	
	/**
	 * wysyła artykuł mailem (HTML)
	 */
	
	function sendSlideshowByEmail ($slideshow_details, $email) {
		
		global $_mail_params;
		global $dict_templates;
		global $__CFG;
		global $smarty;
		
		if (sizeof($slideshow_details) && $email) {
			//print_r($slideshow_details);
			$smarty->assign("slideshow", $slideshow_details);
			
			$content = $smarty->fetch("slideshow_send.tpl");
				
			$mail_data['html_body'] = $content;
			
			$mail_data['headers']['MIME-Version']= '1.0';
			$mail_data['headers']['Subject'] = $dict_templates['SendSlideshowSubject'];
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
	 * gets all slideshows
	 */
	
	function getSlideshowsAll ($lang_id) {
		
		if ($lang_id) {
			$sql = "select * from slideshow_multilang where language_id = '$lang_id' order by date_modified desc ";
			$slideshow_list = $this->DBM->getTable($sql);
			
			return $slideshow_list;
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
	
	function resizeSlideshowPicture ($source_path, $target_path, $xmin, $ymin) {
		
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