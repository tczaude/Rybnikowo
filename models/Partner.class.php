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

class Partner {

	/**
	 * @var object DBManager
	 */
	var $DBM;

	function Partner() {
		global $DBM;
	 	$this->DBM = $DBM;
	}
	
	/**
	 * pobiera listę artykułów (posortowaną)
	 */
	
	function getPartners($order = "order", $direction = "desc", $page_number = 1, $lang_id) {
		
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		$sql  = "select count(*) as ilosc from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner_multilang.language_id = '$lang_id'";
				
		$temp = $this->DBM->getRow($sql);
		$record_count = $temp['ilosc'];
		
		$sql  = "select partner.category_id, partner.order, partner.pic_01, partner_multilang.* from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner_multilang.language_id = '$lang_id' ";		
		$sql .= " order by partner.`$order` $direction limit $offset, $limit ";
		
		// echo $sql."<hr>";
		
		$partner_list_temp = $this->DBM->getTable($sql);
		
		// reindex array
		if (sizeof($partner_list_temp)) {
			$partner_list = array();
			foreach ($partner_list_temp as $partner_details) {
				$partner_list[$partner_details[partner_id]] = $partner_details;
			}
		}
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParameters($record_count, $page_number);
		}
		
		return $partner_list;
	}
	
	/**
	 * pobiera listę artykułów (posortowaną)
	 */
	
	function getPartnersByWtz($order = "order", $direction = "desc", $page_number = 1, $category_id = 1, $lang_id, $wtz) {
		
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		if (!$category_id) $category_id = 1;
		
		$sql  = "select count(*) as ilosc from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner_multilang.language_id = '$lang_id' and partner_multilang.author_id = '$wtz' ";
				
		$temp = $this->DBM->getRow($sql);
		$record_count = $temp['ilosc'];
		
		$sql  = "select partner.category_id, partner.order, partner.pic_01, partner_multilang.* from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner_multilang.language_id = '$lang_id' and partner_multilang.author_id = '$wtz'  ";		
		$sql .= " order by partner.`$order` $direction limit $offset, $limit ";
		
		// echo $sql."<hr>";
		
		$partner_list_temp = $this->DBM->getTable($sql);
		
		// reindex array
		if (sizeof($partner_list_temp)) {
			$partner_list = array();
			foreach ($partner_list_temp as $partner_details) {
				$partner_list[$partner_details[partner_id]] = $partner_details;
			}
		}
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParameters($record_count, $page_number);
		}
		
		return $partner_list;
	}
	
	/**
	 * Przestawia status 
	 */
	
	function setStatus ($partner_id, $status) {
		
		if ($partner_id) {
			
			$sql = "update partner_multilang set status = '$status' where partner_multilang.partner_id = '$partner_id' ";
			$this->DBM->modifyTable($sql);
			
		}
	}	
		
	/**
	 * pobiera przefiltrowaną listę artykułów
	 */
	
	function getPartnersSearch($order = "order", $direction = "desc", $search_form = null, $page_number = 1, $lang_id) {
		
		
			// ustawienie numeru strony do stronicowania (jezeli nie została podana)
			if (!sizeof($_REQUEST['page_number'])) {
				$_REQUEST['page_number'] = 1;
			}		
		
		$page_number = $_REQUEST['page_number'];
		
		
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		$sql  = "select partner.category_id, partner.order, partner.pic_01, partner_multilang.* from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner_multilang.language_id = '$lang_id' ";		
		$sql_count  = "select count(*) as ilosc from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner_multilang.language_id = '$lang_id' ";
				
		if(sizeof($search_form)) {
			
			if ($search_form['title']) {
				$sql .= " AND lower(partner_multilang.title) like lower('%".$search_form['title']."%') ";
				$sql_count .= " AND lower(partner_multilang.title) like lower('%".$search_form['title']."%') ";
			}
			if ($search_form['abstract']) {
				$sql .= " AND lower(partner_multilang.abstract) like lower('%".$search_form['abstract']."%') ";
				$sql_count .= " AND lower(partner_multilang.abstract) like lower('%".$search_form['abstract']."%') ";
			}
			if ($search_form['content']) {
				$sql .= " AND lower(partner_multilang.content) like lower('%".$search_form['content']."%') ";
				$sql_count .= " AND lower(partner_multilang.content) like lower('%".$search_form['content']."%') ";
			}
			if ($search_form['status']) {
				$sql .= " AND partner_multilang.status = ".$search_form['status']." ";
				$sql_count .= " AND partner_multilang.status = ".$search_form['status']." ";
			}
			if ($search_form['date_created_from'] && $search_form['date_created_to']) {
				$sql .= " AND partner_multilang.date_created between '".$search_form['date_created_from']."' and '".$search_form['date_created_to']."' ";
				$sql_count .= " AND partner_multilang.date_created between '".$search_form['date_created_from']."' and '".$search_form['date_created_to']."' ";
			}
			if ($search_form['date_modified_from'] && $search_form['date_modified_to']) {
				$sql .= " AND partner_multilang.date_modified between '".$search_form['date_modified_from']."' and '".$search_form['date_modified_to']."' ";
				$sql_count .= " AND partner_multilang.date_modified between '".$search_form['date_modified_from']."' and '".$search_form['date_modified_to']."' ";
			}
		}
		
		$sql .= " order by partner.`$order` $direction ";
		$sql .= " limit $offset, $limit ";
		
		// echo $sql;
		
		// ilośc wszystkich rekordów
		$temp = $this->DBM->getRow($sql_count);
		$record_count = $temp['ilosc'];
		
		// echo $record_count."<br>";
		
		$partner_list_temp = $this->DBM->getTable($sql);
		
		// reindex array
		if (sizeof($partner_list_temp)) {
			$partner_list = array();
			foreach ($partner_list_temp as $partner_details) {
				$partner_list[$partner_details[partner_id]] = $partner_details;
			}
		}
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParametersNew($record_count, $page_number);
		}
		
		return $partner_list;
	}
		
	/**
	 * pobiera przefiltrowaną listę artykułów powiązanych z podanym produktem
	 * wraz z listą wszystkich dostępnych artykułów (dla celów administracyjnych)
	 */
	
	function getPartnersForProduct($product_id, $order = "order", $direction = "desc", $search_form = null, $page_number = 1, $lang_id) {
		
		global $__CFG;
		
		if ($product_id) {
			
			// najpierw wybieramy normalną listę artykułów - przefiltrowaną wg. wskazanych filtrów
			$partner_list = $this->getPartnersSearch($order, $direction, $search_form, $page_number, $lang_id);
			
			// następnie wybieramy listę artykułów powiązanych z podanym produktem
			$sql = "select * from product_partner where product_id = '$product_id'";
			$partners_temp = $this->DBM->getTable($sql);
			
			// przelatujemy tą tablicę zazanczając na liscie wssystkich artykułów te, które są powiązane
			if (sizeof($partners_temp)) {
				foreach ($partners_temp as $details) {
					if ($partner_list[$details['partner_id']]) {
						$partner_list[$details['partner_id']]['selected'] = 1;
					}
				}
			}
			
			return $partner_list;
		}
	}
	
	/**
	 * pobiera artykuły TYLKO powiązane z podanym produktem
	 */
	
	function getPartnersOnlyForProduct ($product_id, $lang_id) {
		
		if ($product_id && $lang_id) {
			
			$sql = "select partner.category_id, partner.order, partner.pic_01, partner_multilang.* from partner, partner_multilang, product_partner where partner_multilang.partner_id = partner.id and product_partner.partner_id = partner.id and partner_multilang.language_id = '$lang_id' and product_partner.product_id = '$product_id' ";
			$partner_list = $this->DBM->getTable($sql);
			
			return $partner_list;
		}
	}
	
	
	/**
	 * get partners by category id
	 */
	
	function getPartnersByCategory ($category_id, $lang_id) {
		
		if ($category_id && $lang_id) {
			$search_form['category_id'] = $category_id;
			
			// paging cheating ;-)
			$__CFG['record_count_limit'] = 1;
			
			$partner_list = $this->getPartnersSearch("order", "desc", $search_form, 1, $lang_id, $page_number);
			
			return $partner_list;
		}
	}
	
	/**
	 * wyciaga listę partnera dla widoku serwisu wraz z pagingiem
	 */
	
	function getPartnersByView ($order = "order", $direction = "desc", $limit, $page_number = 1, $lang_id){
		
		if($limit){
			
			
			$direction = "desc";
			$order = "order";

			global $__CFG;
			// TEST!!!
			$__CFG['record_count_limit'] = $limit;
		
			$limit = $__CFG['record_count_limit'];			
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select partner.category_id, partner.order, partner.pic_01, partner_multilang.* from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner_multilang.language_id = '$lang_id' and partner_multilang.status = '2' ";		
			$sql_count  = "select count(*) as ilosc from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner_multilang.language_id = '$lang_id' and partner_multilang.status = '2' ";
			
			$sql .= " order by partner.`$order` $direction limit $offset, $limit ";
			
			
			// echo $sql;
			
			// ilośc wszystkich rekordów
			$temp = $this->DBM->getRow($sql_count);
			$record_count = $temp['ilosc'];
			
			//echo $record_count."<br>";
			
			$news_list_temp = $this->DBM->getTable($sql);
			
				//print_r($partner_list_temp);
				if($news_list_temp){
				//print_r($partner_list_temp);
				$news_list = $this->calculateCommentsVolumeForPartner($news_list_temp);
				
			}
			
			if(isset($page_number)) {
				// przeliczamy parametry
				$this->convertPagingParametersNew($record_count, $page_number);
			}
		}
		
		return $news_list;
	}
	
	/**
	 * wyciaga listę partnera dla widoku serwisu wraz z pagingiem
	 */
	
	function getPartnersByCategoryToView ($order = "order", $direction = "desc", $limit, $page_number = 1, $lang_id, $category_id){
		
		if($limit){
			
			
			$direction = "desc";
			$order = "order";

			global $__CFG;
			// TEST!!!
			$__CFG['record_count_limit'] = $limit;
		
			$limit = $__CFG['record_count_limit'];			
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select partner.category_id, partner.order, partner.pic_01, partner_multilang.* from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner_multilang.language_id = '$lang_id' and partner_multilang.author_id = '$category_id' and partner_multilang.status = '2' ";		
			$sql_count  = "select count(*) as ilosc from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner_multilang.language_id = '$lang_id' and partner_multilang.author_id = '$category_id' and partner_multilang.status = '2' ";
			
			$sql .= " order by partner.`$order` $direction limit $offset, $limit ";
			
			
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
	 * pobiera pojedynczy artykuł do edycji
	 */
	
	function getPartnerByUrlNameToView($url_name, $lang_id) {
			
		if ($url_name && $lang_id) {	
			$sql = "select partner.category_id, partner.order, partner.pic_01, partner.pic_02, partner.pic_03, partner_multilang.* from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner_multilang.url_name = '$url_name' and partner_multilang.language_id = '$lang_id'";
			$rv = $this->DBM->getRow($sql);
			
		}
		return $rv;
	}
	
	/**
	 * Liczba komentarzy dla danego wpisu
	 */
	
	function calculateCommentsVolumeForPartner($partner_list) {
		
		if (sizeof($partner_list)) {
			
			// dla każdego użytkownika sprawdzamy ilośc jego znajomych
			foreach ($partner_list as $key => $partner_details) {
				
				//print_r($partner_details);
				
				$sql = "select count(*) as ilosc from comment_partner where partner_id = '$partner_details[partner_id]' ";
				$details = $this->DBM->getRow($sql);

				$partner_list[$key]['comments_volume'] = $details['ilosc'];
			}
		}
		
		return $partner_list;	
	}
	
	/**
	 * wyciaga listę partnera dla widoku serwisu wraz z pagingiem
	 */
	
	function getPartnersByHome ($order = "order", $direction = "desc", $limit, $page_number = 1, $lang_id){
		
		if($limit){
			
			
			$direction = "desc";
			$order = "order";

			global $__CFG;
			// TEST!!!
			$__CFG['record_count_limit'] = $limit;
		
			$limit = $__CFG['record_count_limit'];			
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select partner.category_id, partner.order, partner.pic_01, partner_multilang.* from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner_multilang.language_id = '$lang_id' and partner.category_id = '1' and partner_multilang.status = '2' ";		
			$sql_count  = "select count(*) as ilosc from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner_multilang.language_id = '$lang_id' and partner.category_id = '1' and partner_multilang.status = '2' ";
			
			$sql .= " order by partner.`$order` $direction limit $offset, $limit ";
			
			
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
	 * wyciaga listę partnera dla rss
	 */
	
	function getPartnersByRss ($order = "order", $direction = "desc", $limit, $page_number = 1, $lang_id){
		
		if($limit){
			
			
			$direction = "desc";
			$order = "order";

			global $__CFG;
			// TEST!!!
			$__CFG['record_count_limit'] = $limit;
		
			$limit = $__CFG['record_count_limit'];			
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select partner.category_id, partner.order, partner.pic_01, partner_multilang.* from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner_multilang.language_id = '$lang_id' and partner.category_id = '1' and partner_multilang.status = '2' ";		
			$sql_count  = "select count(*) as ilosc from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner_multilang.language_id = '$lang_id' and partner.category_id = '1' and partner_multilang.status = '2' ";
			
			$sql .= " order by partner.`$order` $direction limit $offset, $limit ";
			
			
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
	 * pobiera pojedynczy artykuł do edycji
	 */
	
	function getPartner($partner_id, $lang_id) {
			
		if ($partner_id && $lang_id) {	
			$sql = "select partner.category_id, partner.order, partner.pic_01, partner.pic_02, partner.pic_03, partner_multilang.* from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner.id = '$partner_id' and partner_multilang.language_id = '$lang_id'";
			$rv = $this->DBM->getRow($sql);
			
		}
		return $rv;
	}
	
	/**
	 * wyciąga pierwszy artykuł z podanej kategorii (tylko id)
	 */
	
	function getFirstPartnerInCategory ($category_id, $lang_id) {
		
		if ($category_id) {
			
			$sql = "select partner.id from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner.category_id = '$category_id' and partner_multilang.language_id = '$lang_id' and partner_multilang.status != 0 order by partner.`order` desc limit 1";
			$details = $this->DBM->getRow($sql);
			
			return $details['id'];
		}
	}
	
	/**
	 * pobiera pojedynczy artykuł do widoku szczegółów
	 */
	
	function getPartnerDetails($partner_id, $lang_id) {
		
		if ($partner_id && $lang_id) {
			$sql = "select partner.category_id, partner.order, partner.pic_01, partner.pic_02, partner.pic_03, partner_multilang.* from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner.id = '$partner_id' and partner_multilang.language_id = '$lang_id'";
			$rv = $this->DBM->getRow($sql);
		}
		return $rv;
	}
	
	/**
	 * sprawdza czy dany partner istnieje o tej samej nazwie url /uzywane do walidacji - dla istniejaqcego wpisu/
	 */
	
	function getPartnerByUrlNameAndId($url_name, $partner_id) {
			
		if ($url_name && $partner_id) {	
			//print_r($product_id);
			$sql = "select partner_multilang.* from partner_multilang where partner_multilang.url_name = '$url_name' and partner_multilang.partner_id != '$partner_id'";
			$rv = $this->DBM->getRow($sql);
			//echo $sql;
			
		}
		return $rv;
	}
	
	/**
	 * sprawdza czy dany wpis partnera istnieje o tej samej nazwie url /uzywane do walidacji - dla nowgo wpisu/
	 */
	
	function getPartnerByUrlName($url_name) {
			
		if ($url_name) {	
			$sql = "select partner_multilang.* from partner_multilang where partner_multilang.url_name = '$url_name' ";
			$rv = $this->DBM->getRow($sql);
			
		}
		return $rv;
	}
	
	/**
	 * zapisuje pojedynczy artykuł
	 */
	
	function savePartner($partner_form) {
		
		global $__CFG;
		
		// data bieżąca 
		$date_now = date("Y-m-d H:i:s", time());
		
		if (!$partner_form['partner_id']) {
			
			// kolejność - to jest do przeniesienia do nowej klasy Order (?) albo osobna metoda w tej klasie (?)
			$sql = "select max(`order`) as last_order from partner where category_id = '$partner_form[category_id]'";
			$order = $this->DBM->getRow($sql);
			$next_order = $order['last_order'] + 1;
			
			// nowa metryka
			$sql = "insert into partner (category_id, `order`) values ('$partner_form[category_id]', '$next_order') ";
			$rv = $this->DBM->modifyTable($sql);
			$partner_id = $this->DBM->lastInsertID;
			
			// dodaj obrazek nr 1
			if ($_FILES['pic_01']['name']) {
				$pic_01 = "partner_".$partner_id."_01.jpg";
				$sql = "update partner set pic_01 = '$pic_01' where id = '$partner_id'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizePartnerPicture ($_FILES['pic_01']['tmp_name'], $__CFG['partner_pictures_path'].$partner_id."_01_01.jpg", 50, 50);
				$this->resizePartnerPicture ($_FILES['pic_01']['tmp_name'], $__CFG['partner_pictures_path'].$partner_id."_02_01.jpg", 130, 130);
				$this->resizePartnerPicture ($_FILES['pic_01']['tmp_name'], $__CFG['partner_pictures_path'].$partner_id."_03_01.jpg", 190, 190);
				$this->resizePartnerPicture ($_FILES['pic_01']['tmp_name'], $__CFG['partner_pictures_path'].$partner_id."_04_01.jpg", 500, 500);
				unlink($_FILES['pic_01']['tmp_name']);				
				

			}
			
			// dodaj obrazek nr 2
			if ($_FILES['pic_02']['name']) {
				$pic_02 = "partner_".$partner_id."_02.jpg";
				$sql = "update partner set pic_02 = '$pic_02' where id = '$partner_id'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizePartnerPicture ($_FILES['pic_02']['tmp_name'], $__CFG['partner_pictures_path'].$partner_id."_01_02.jpg", 50, 50);
				$this->resizePartnerPicture ($_FILES['pic_02']['tmp_name'], $__CFG['partner_pictures_path'].$partner_id."_03_02.jpg", 190, 190);
				$this->resizePartnerPicture ($_FILES['pic_02']['tmp_name'], $__CFG['partner_pictures_path'].$partner_id."_04_02.jpg", 500, 500);
				unlink($_FILES['pic_02']['tmp_name']);				
				

			}
			
					
			// dodaj obrazek nr 3
			if ($_FILES['pic_03']['name']) {
				$pic_03 = "partner_".$partner_id."_03.jpg";
				$sql = "update partner set pic_03 = '$pic_03' where id = '$partner_id'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizePartnerPicture ($_FILES['pic_03']['tmp_name'], $__CFG['partner_pictures_path'].$partner_id."_01_03.jpg", 50, 50);
				$this->resizePartnerPicture ($_FILES['pic_03']['tmp_name'], $__CFG['partner_pictures_path'].$partner_id."_03_03.jpg", 190, 190);
				$this->resizePartnerPicture ($_FILES['pic_03']['tmp_name'], $__CFG['partner_pictures_path'].$partner_id."_04_03.jpg", 500, 500);
				unlink($_FILES['pic_03']['tmp_name']);				
				

			}
			
			if ($partner_id) {
				
				$sql  = "insert into partner_multilang (partner_id, url_name, language_id, title, abstract, content, status, date_created, date_modified, author_id) ";
				$sql .= " values ('$partner_id', '$partner_form[url_name]', '$partner_form[language_id]', '$partner_form[title]', '$partner_form[abstract]', '$partner_form[content]', '$partner_form[status]', '$date_now', '$date_now', '$partner_form[author_id]') ";
				$rv = $this->DBM->modifyTable($sql);
				
				// i wszystkie pozostałe wersje językowe (puste)
				$sql = "select * from language";
				$languages_list = $this->DBM->getTable($sql);
				
				if (sizeof($languages_list)) {
					foreach ($languages_list as $language) {
						// bez tego, który już wczesniej zapisaliśmy!
						if ($language['id'] != $partner_form['language_id']) {
							$sql  = "insert into partner_multilang (partner_id, language_id, status, date_created, date_modified, title) ";
							$sql .= " values ('$partner_id', '$language[id]', '0', '$date_now', '$date_now', '$partner_form[title]') ";
							$rv = $this->DBM->modifyTable($sql);
						}
					}
				}
			}
		}
		else {
			
			// aktualizacja artykułu
			
			// najpierw metryka artykułu (zmiana conajwyżej kategorii)
			$sql = "update partner set category_id = '$partner_form[category_id]' where id = '$partner_form[partner_id]'";
			$rv = $this->DBM->modifyTable($sql);
			
			// update obrazka (usunięcie lub aktualizacja - o ile został podany) nr 1
			if ($partner_form['remove_picture_01']) {
				// usuwamy obrazek
				$pic_01 = "";
				$sql = "update partner set pic_01 = '$pic_01' where id = '$partner_form[partner_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				unlink($__CFG['partner_pictures_path'].$partner_form['partner_id']."_01_01.jpg");
				unlink($__CFG['partner_pictures_path'].$partner_form['partner_id']."_02_01.jpg");
				unlink($__CFG['partner_pictures_path'].$partner_form['partner_id']."_03_01.jpg");
				unlink($__CFG['partner_pictures_path'].$partner_form['partner_id']."_04_01.jpg");
			}
			elseif ($_FILES['pic_01']['name']) {
				// aktualizujemy obrazek
				$pic_01 = "partner_".$partner_form['partner_id']."_01.jpg";
				$sql = "update partner set pic_01 = '$pic_01' where id = '$partner_form[partner_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				
				// pierwsza miniatura
				$this->resizePartnerPicture ($_FILES['pic_01']['tmp_name'], $__CFG['partner_pictures_path'].$partner_form[partner_id]."_01_01.jpg", 50, 50);
				$this->resizePartnerPicture ($_FILES['pic_01']['tmp_name'], $__CFG['partner_pictures_path'].$partner_form[partner_id]."_02_01.jpg", 130, 130);
				$this->resizePartnerPicture ($_FILES['pic_01']['tmp_name'], $__CFG['partner_pictures_path'].$partner_form[partner_id]."_03_01.jpg", 190, 190);
				$this->resizePartnerPicture ($_FILES['pic_01']['tmp_name'], $__CFG['partner_pictures_path'].$partner_form[partner_id]."_04_01.jpg", 500, 500);
				unlink($_FILES['pic_01']['tmp_name']);					
				
			}
			
			
			// update obrazka (usunięcie lub aktualizacja - o ile został podany) nr 2
			if ($partner_form['remove_picture_02']) {
				// usuwamy obrazek
				$pic_02 = "";
				$sql = "update partner set pic_02 = '$pic_02' where id = '$partner_form[partner_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				unlink($__CFG['partner_pictures_path'].$partner_form['partner_id']."_01_02.jpg");
				unlink($__CFG['partner_pictures_path'].$partner_form['partner_id']."_03_02.jpg");
				unlink($__CFG['partner_pictures_path'].$partner_form['partner_id']."_04_02.jpg");
			}
			elseif ($_FILES['pic_02']['name']) {
				// aktualizujemy obrazek
				$pic_02 = "partner_".$partner_form['partner_id']."_02.jpg";
				$sql = "update partner set pic_02 = '$pic_02' where id = '$partner_form[partner_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizePartnerPicture ($_FILES['pic_02']['tmp_name'], $__CFG['partner_pictures_path'].$partner_form[partner_id]."_01_02.jpg", 50, 50);
				$this->resizePartnerPicture ($_FILES['pic_02']['tmp_name'], $__CFG['partner_pictures_path'].$partner_form[partner_id]."_03_02.jpg", 190, 190);
				$this->resizePartnerPicture ($_FILES['pic_02']['tmp_name'], $__CFG['partner_pictures_path'].$partner_form[partner_id]."_04_02.jpg", 500, 500);
				unlink($_FILES['pic_02']['tmp_name']);					
				
			}			
			
			// update obrazka (usunięcie lub aktualizacja - o ile został podany) nr 3
			if ($partner_form['remove_picture_03']) {
				// usuwamy obrazek
				$pic_03 = "";
				$sql = "update partner set pic_03 = '$pic_03' where id = '$partner_form[partner_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				unlink($__CFG['partner_pictures_path'].$partner_form['partner_id']."_01_03.jpg");
				unlink($__CFG['partner_pictures_path'].$partner_form['partner_id']."_03_03.jpg");
				unlink($__CFG['partner_pictures_path'].$partner_form['partner_id']."_04_03.jpg");
			}
			elseif ($_FILES['pic_03']['name']) {
				// aktualizujemy obrazek
				$pic_03 = "partner_".$partner_form['partner_id']."_03.jpg";
				$sql = "update partner set pic_03 = '$pic_03' where id = '$partner_form[partner_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizePartnerPicture ($_FILES['pic_03']['tmp_name'], $__CFG['partner_pictures_path'].$partner_form[partner_id]."_01_03.jpg", 50, 50);
				$this->resizePartnerPicture ($_FILES['pic_03']['tmp_name'], $__CFG['partner_pictures_path'].$partner_form[partner_id]."_03_03.jpg", 190, 190);
				$this->resizePartnerPicture ($_FILES['pic_03']['tmp_name'], $__CFG['partner_pictures_path'].$partner_form[partner_id]."_04_03.jpg", 500, 500);
				unlink($_FILES['pic_03']['tmp_name']);					
				
			}				
			
			// a potem wersja językowa
			$sql = "update partner_multilang set title = '$partner_form[title]', url_name = '$partner_form[url_name]', abstract = '$partner_form[abstract]', content = '$partner_form[content]', status = '$partner_form[status]', date_modified = '$date_now', author_id = '$partner_form[author_id]' where partner_id = '$partner_form[partner_id]' and language_id = '$partner_form[language_id]'";
			$rv = $this->DBM->modifyTable($sql);
			
		}
		
		// zwracamy ID ostatnio zapisanego artykułu
		if ($partner_id) { 
			return $partner_id;
		}
		else {
			return $partner_form['partner_id'];
		}
	}
	
	/**
	 * zapisuje powiązanie artykułów z produktem
	 */
	
	function savePartnersForProduct ($product_id, $partners) {
		
		if ($product_id && sizeof($partners)) {
			
			foreach ($partners as $partner_id => $value) {
				
				// najpierw sprawdzamy, czy już przypadkiem takiego powiązania nie ma
				$sql = "select * from product_partner where product_id = '$product_id' and partner_id = '$partner_id'";
				$details = $this->DBM->getRow($sql);
				
				// dalej działamy tylko wtedy kiedy nie ma jeszcze takiego powiązania!
				if (!sizeof($details)) {
					$sql = "insert into product_partner (product_id, partner_id) values ('$product_id', '$partner_id')";
					$this->DBM->modifyTable($sql);
				}
			}
		}
	}
	
	/**
	 * zapisuje komentarz do partner
	 */
	
	function saveCommentPartner($comment_form) {
		
		global $__CFG;
		
		// data bieżąca 
		$date_now = date("Y-m-d H:i:s", time());
		
		if ($comment_form['content']) {
			
			$content = strip_tags($comment_form['content']);
			$name= strip_tags($comment_form['name']);
			
			// nowa metryka
			$sql = "insert into comment_partner ( user_id, partner_id, date_created, content, remote_ip ) values ('$name', '$comment_form[partner_id]', '$date_now', '$content', '$_SERVER[REMOTE_ADDR]' ) ";
			$rv = $this->DBM->modifyTable($sql);
		}
		
	}
	
	/**
	 * usuwa pojedynczy artykuł
	 */
	
	function removePartner($partner_id) {
			
		if ($partner_id) {
			// metryka
			$sql = "delete from partner where id = $partner_id ";
			$rv = $this->DBM->modifyTable($sql);
			// i wszystkie wersje językowe
			$sql = "delete from partner_multilang where partner_id = $partner_id ";
			$rv = $this->DBM->modifyTable($sql);
		}
		return $rv;
	}
	
	/**
	 * usuwa powiązania podanych artykułów z podanym produktem
	 */
	
	function removePartnersFromProduct ($product_id, $partners) {
		
		if ($product_id && sizeof($partners)) {
			
			foreach ($partners as $partner_id => $value) {
				
				$sql = "delete from product_partner where product_id = '$product_id' and partner_id = '$partner_id'";
				$this->DBM->modifyTable($sql);
			}
		}
	}
	
	/**
	 * gets n random partners from given category
	 */
	
	function getRandomPartners ($category_id, $limit, $lang_id) {
		
		if ($category_id && $limit && $lang_id) {
			$sql = "select partner.category_id, partner.order, partner_multilang.* from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner.category_id = '$category_id' and partner_multilang.language_id = '$lang_id' order by rand() limit $limit";
			$partner_list = $this->DBM->getTable($sql);
			
			return $partner_list;
		}
		
	}
	
	/**
	 * wyciąga listę artykułów z zazanczonymi artykułami dla danego produktu
	 */
	
	function getPartnersForProductAdmin ($product_id, $lang_id) {
		
		if ($product_id && $lang_id) {
			
			$partners = $this->getPartners("order", "desc", 1, 2, $lang_id);
			
			return $partners;
		}
		
	}
	
	/**
	 * gets all partners
	 */
	
	function getPartnersAll ($lang_id) {
		
		if ($lang_id) {
			$sql = "select * from partner_multilang where language_id = '$lang_id' order by date_modified desc ";
			$partner_list = $this->DBM->getTable($sql);
			
			return $partner_list;
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
	
	function convertPagingParametersNew($record_count, $page_number) {
		
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
		
		$range = 3;
		
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
	 * przelicza wszystkie parametry do stronicowania
	 */
	
	function convertPagingParameters2($record_count, $page_number, $limit) {
		
		global $__CFG;
		
		$paging_partner = array();
		$last_page = ceil($record_count / $limit);
		
		// echo "last page : ".$last_page."<br>";
		$paging_partner['count'] = $last_page;
		// poprzednia strona
		if ($page_number == 1) {
			$paging_partner['previous'] = "";
			$paging_partner['first'] = "";
		}
		else {
			$paging_partner['previous'] = $page_number - 1;
			$paging_partner['first'] = "1";
		}
		
		// następna strona
		if ($page_number == $last_page) {
			$paging_partner['next'] = "";
			$paging_partner['last'] = "";	
		}
		else {
			$paging_partner['next'] = $page_number + 1;
			$paging_partner['last'] = $last_page;
		}
		
		$paging_partner['current'] = $page_number;
		
		
		$this->paging_partner = $paging_partner;
		return $paging_partner;
		
	}
	
	/**
	 * wyciąga najnowsze newsy
	 */
	
	function getRecentNews ($category_id, $limit, $lang_id) {
		
		if ($lang_id) {
		
			$sql  = "select partner.category_id, partner.order, partner.pic_01, partner_multilang.* from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner.category_id = '$category_id' and partner_multilang.language_id = '$lang_id' and partner_multilang.status = 2 ";		
			$sql .= " order by partner.`order` desc limit $limit ";
			
			// echo $sql;
			
			$partner_list = $this->DBM->getTable($sql);
			
			return $partner_list;
		}
	}
	
	/**
	 * pobiera listę komentarzy do partner	
	 */
	
	function getCommentsByPartners($partner_id, $limit_count, $page_number = 1, $order = "order", $direction = "desc") {
		
		global $__CFG;

		$limit = $limit_count;
		$offset = ($page_number - 1) * $limit;
		
		$sql  = "select count(*) as ilosc from comment_partner, partner where partner.id = comment_partner.partner_id and partner.id = '$partner_id' ";
				
		$temp = $this->DBM->getRow($sql);
		$record_count = $temp['ilosc'];
		
		$sql  = "select comment_partner.* from comment_partner, partner where partner.id = comment_partner.partner_id and partner.id = '$partner_id' ";		
		$sql .= " order by comment_partner.date_created desc limit $offset, $limit ";
		
		//echo $sql."<hr>";
		
		$comment_list = $this->DBM->getTable($sql);
		

		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParameters2($record_count, $page_number, $limit);
		}
		
		return $comment_list;
	}
	
	/**
	 * pobiera listę komentarzy do partner	/administracja/
	 */
	
	function getCommentsByPartnersForAdmin($partner_id, $limit_count, $page_number = 1, $order = "order", $direction = "desc") {
		
		global $__CFG;

		$limit = $limit_count;
		$offset = ($page_number - 1) * $limit;
		
		$sql  = "select count(*) as ilosc from comment_partner, partner where partner.id = comment_partner.partner_id and partner.id = '$partner_id' ";
				
		$temp = $this->DBM->getRow($sql);
		$record_count = $temp['ilosc'];
		
		$sql  = "select comment_partner.* from comment_partner, partner where  partner.id = comment_partner.partner_id and partner.id = '$partner_id' ";		
		$sql .= " order by comment_partner.date_created desc limit $offset, $limit ";
		
		//echo $sql."<hr>";
		
		$comment_list = $this->DBM->getTable($sql);
		

		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParameters($record_count, $page_number);
		}
		
		return $comment_list;
	}
	
	/**
	 * usuwa powiązania podanych artykułów z podanym produktem
	 */
	
	function removeCommentForPartner ($comment_id) {
		
		if ($comment_id) {
			

				
			$sql = "delete from comment_partner where id = '$comment_id' ";
			$this->DBM->modifyTable($sql);

		}
	}
	
	/**
	 * wyciąga editoriale
	 */
	
	function getEditorials ($category_id, $lang_id) {
		
		if ($lang_id) {
		
			$sql  = "select partner.category_id, partner.order, partner.pic_01, partner_multilang.* from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner.category_id = '$category_id' and partner_multilang.language_id = '$lang_id' ";		
			$sql .= " order by partner.`order` desc";
			
			// echo $sql;
			
			$partner_list = $this->DBM->getTable($sql);
			
			return $partner_list;
		}
	}
	
	/**
	 * wyciąga pojedynczy editorial wraz z nawigacją
	 */
	
	function getEditorial ($partner_id, $lang_id, $user_id = null) {
		
		if ($lang_id) {
			
			// kategoria editoriali
			if ($user_id) {
				$category_id = 4;
			}
			else {
				$category_id = 9;
			}
			
			// jeżeli został podany konkretny editorial
			if ($partner_id) {
				
				$sql = "select partner.category_id, partner.order, partner.pic_01, partner_multilang.* from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner.id = '$partner_id' and partner_multilang.language_id = '$lang_id' and partner_multilang.status != 0";
				$partner_details = $this->DBM->getRow($sql);
				
				if (sizeof($partner_details)) {
					
					// wybieramy nastepny (nowszy)
					
					$sql = "select partner_multilang.* from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner.`order` > '$partner_details[order]' and partner.category_id = '$category_id' and partner_multilang.language_id = '$lang_id' and partner_multilang.status != 0 order by partner.`order` asc limit 1";
					$next_partner = $this->DBM->getRow($sql);
					
					if (sizeof($next_partner)) {
						$partner_details['next_partner'] = $next_partner['partner_id'];
					}
					
					// wybieramy poprzedni (starszy) 
					
					$sql = "select partner_multilang.* from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner.`order` < '$partner_details[order]' and partner.category_id = '$category_id' and partner_multilang.language_id = '$lang_id' and partner_multilang.status != 0 order by partner.`order` desc limit 1";
					$previous_partner = $this->DBM->getRow($sql);
					
					if (sizeof($previous_partner)) {
						$partner_details['previous_partner'] = $previous_partner['partner_id'];
					}
					
					return $partner_details;
				}	
			}
			else {
				// nie podano konkretnego - bierzemy dwa najnowsze - od razu do nawigacji
				
				$sql  = "select partner.category_id, partner.order, partner.pic_01, partner_multilang.* from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner.category_id = '$category_id' and partner_multilang.language_id = '$lang_id' and partner_multilang.status != 0 ";
				$sql .= " order by partner.`order` desc limit 2";
				$details = $this->DBM->getTable($sql);
				
				// echo $sql;
				
				// szczegóły bieżącego
				$partner_details = $details[0];
				
				// nowszego (następnego) nie ma !
				// ...
				
				// a to jest starszy
				if (sizeof($details[1])) {
					// poprzedni editorial ( = starszy!)
					$partner_details['previous_partner'] = $details[1]['partner_id'];
				}
				
				return $partner_details;
			}
		}
	}
	
	/**
	 * pobiera pojedynczy artykuł jako treść helpa
	 */
	
	function getHelp($partner_id, $lang_id) {
			
		if ($partner_id && $lang_id) {	
			$sql = "select partner_multilang.* from partner, partner_multilang where partner_multilang.partner_id = partner.id and partner.id = '$partner_id' and partner_multilang.language_id = '$lang_id'";
			$partner_details = $this->DBM->getRow($sql);
			
			return $partner_details['content'];	
		}
	}
	
	/**
	 * wysyła artykuł mailem (HTML)
	 */
	
	function sendPartnerByEmail ($partner_details, $email) {
		
		global $_mail_params;
		global $dict_templates;
		global $__CFG;
		global $smarty;
		
		if (sizeof($partner_details) && $email) {
			
			$content = $smarty->fetch("send_partner.tpl");
				
			$mail_data['html_body'] = $content;
			
			$mail_data['headers']['MIME-Version']= '1.0';
			$mail_data['headers']['Subject'] = $dict_templates['SendPartnerSubject'];
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
	 * generuje z podanego artykułu plik tekstowy
	 */
	
	function createFileFromPartner ($partner_id, $path, $lang_id) {
		
		global $__CFG;
		
		if ($partner_id && $path && $lang_id) {
			
			// szczegóły artykułu
			$sql = "select title, content from partner_multilang where partner_id = '$partner_id' and language_id = '$lang_id'";
			$details = $this->DBM->getRow($sql);
			
			if (sizeof($details)) {
				
				$details['content'] = str_replace("</p>", "\r\n", $details['content']);
				$details['content'] = strip_tags($details['content']);
				
				$filename = strtolower(Utils::toascii_replace(str_replace(" ", "_", trim($details['title'])))).".txt";
				
				// echo $path.$filename."<br/>";
				
				$fp = fopen($path.$filename, 'w');
				fwrite($fp, $details['title']."\r\n\r\n");
				fwrite($fp, $details['content']);
				fclose($fp);
				
				// echo " done<br/>";
			} 
		}
	}
	
	function echocode ($code){
		
		if($code){
			
			print_r($code);
			
		}
		
	}
	
	/**
	 * przeskalowuje importowane zdj�cie w miejscu - z resamplingiem
	 */
	
	function resizePartnerPicture ($source_path, $target_path, $xmin, $ymin) {
		
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