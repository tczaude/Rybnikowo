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

class Picture {

	/**
	 * @var object DBManager
	 */
	var $DBM;

	function Picture() {
		global $DBM;
	 	$this->DBM = $DBM;
	}
	
	/**
	 * pobiera listę artykułów (posortowaną)
	 */
	
	function getPictures($order = "order", $direction = "desc", $page_number = 1, $category_id = 1, $lang_id) {
		
		global $__CFG;
		
		$limit = 100;
		$offset = ($page_number - 1) * $limit;
		
		$sql  = "select count(*) as ilosc from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture.category_id = '$category_id' and picture_multilang.language_id = '$lang_id'";
				
		$temp = $this->DBM->getRow($sql);
		$record_count = $temp['ilosc'];
		
		$sql  = "select picture.category_id, picture.order, picture.pic_01, picture_multilang.* from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture.category_id = '$category_id' and picture_multilang.language_id = '$lang_id' ";		
		$sql .= " order by picture.`$order` $direction limit $offset, $limit ";
		
		// echo $sql."<hr>";
		
		$picture_list_temp = $this->DBM->getTable($sql);
		
		// reindex array
		if (sizeof($picture_list_temp)) {
			$picture_list = array();
			foreach ($picture_list_temp as $picture_details) {
				$picture_list[$picture_details[picture_id]] = $picture_details;
			}
		}
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParameters($record_count, $page_number);
		}
		
		return $picture_list;
	}
	
	/**
	 * Przestawia status 
	 */
	
	function setStatus ($picture_id, $status) {
		
		if ($picture_id) {
			
			$sql = "update picture_multilang set status = '$status' where picture_multilang.picture_id = '$picture_id' ";
			$this->DBM->modifyTable($sql);
			
		}
	}	
		
	/**
	 * pobiera przefiltrowaną listę artykułów
	 */
	
	function getPicturesSearch($order = "order", $direction = "desc", $search_form = null, $page_number = 1, $lang_id) {
		
		
			// ustawienie numeru strony do stronicowania (jezeli nie została podana)
			if (!sizeof($_REQUEST['page_number'])) {
				$_REQUEST['page_number'] = 1;
			}		
		
		$page_number = $_REQUEST['page_number'];
		
		
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		$sql  = "select picture.category_id, picture.order, picture.pic_01, picture_multilang.* from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture_multilang.language_id = '$lang_id' ";		
		$sql_count  = "select count(*) as ilosc from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture_multilang.language_id = '$lang_id' ";
				
		if(sizeof($search_form)) {
			
			if ($search_form['category_id']) {
				$sql .= " AND picture.category_id = ".$search_form['category_id']." ";
				$sql_count .= " AND picture.category_id = ".$search_form['category_id']." ";
			}
			if ($search_form['title']) {
				$sql .= " AND lower(picture_multilang.title) like lower('%".$search_form['title']."%') ";
				$sql_count .= " AND lower(picture_multilang.title) like lower('%".$search_form['title']."%') ";
			}
			if ($search_form['abstract']) {
				$sql .= " AND lower(picture_multilang.abstract) like lower('%".$search_form['abstract']."%') ";
				$sql_count .= " AND lower(picture_multilang.abstract) like lower('%".$search_form['abstract']."%') ";
			}
			if ($search_form['content']) {
				$sql .= " AND lower(picture_multilang.content) like lower('%".$search_form['content']."%') ";
				$sql_count .= " AND lower(picture_multilang.content) like lower('%".$search_form['content']."%') ";
			}
			if ($search_form['status']) {
				$sql .= " AND picture_multilang.status = ".$search_form['status']." ";
				$sql_count .= " AND picture_multilang.status = ".$search_form['status']." ";
			}
			if ($search_form['date_created_from'] && $search_form['date_created_to']) {
				$sql .= " AND picture_multilang.date_created between '".$search_form['date_created_from']."' and '".$search_form['date_created_to']."' ";
				$sql_count .= " AND picture_multilang.date_created between '".$search_form['date_created_from']."' and '".$search_form['date_created_to']."' ";
			}
			if ($search_form['date_modified_from'] && $search_form['date_modified_to']) {
				$sql .= " AND picture_multilang.date_modified between '".$search_form['date_modified_from']."' and '".$search_form['date_modified_to']."' ";
				$sql_count .= " AND picture_multilang.date_modified between '".$search_form['date_modified_from']."' and '".$search_form['date_modified_to']."' ";
			}
		}
		
		$sql .= " order by picture.`$order` $direction ";
		$sql .= " limit $offset, $limit ";
		
		// echo $sql;
		
		// ilośc wszystkich rekordów
		$temp = $this->DBM->getRow($sql_count);
		$record_count = $temp['ilosc'];
		
		// echo $record_count."<br>";
		
		$picture_list_temp = $this->DBM->getTable($sql);
		
		// reindex array
		if (sizeof($picture_list_temp)) {
			$picture_list = array();
			foreach ($picture_list_temp as $picture_details) {
				$picture_list[$picture_details[picture_id]] = $picture_details;
			}
		}
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParametersNew($record_count, $page_number, $limit);
		}
		
		return $picture_list;
	}
	
	/**
	 * pobiera przefiltrowaną listę artykułów /dla widokow/
	 */
	
	function getPicturesSearchToView($limit, $order = "order", $direction = "desc", $search_form = null, $page_number = 1, $lang_id) {

		$offset = ($page_number - 1) * $limit;
		
		$sql  = "select picture.category_id, picture.order, picture.pic_01, picture_multilang.* from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture_multilang.language_id = '$lang_id' ";		
		$sql_count  = "select count(*) as ilosc from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture_multilang.language_id = '$lang_id' ";
				
		if(sizeof($search_form)) {
			
			if ($search_form['category_id']) {
				$sql .= " AND picture.category_id = ".$search_form['category_id']." ";
				$sql_count .= " AND picture.category_id = ".$search_form['category_id']." ";
			}
			else{
				$sql .= " AND (picture.category_id = 1 or picture.category_id = 3 or picture.category_id = 10 or picture.category_id = 11) ";
				$sql_count .= " AND (picture.category_id = 1 or picture.category_id = 3 or picture.category_id = 10 or picture.category_id = 11) ";				
				
			}
			if ($search_form['phrase']) {
				$sql .= " AND (lower(picture_multilang.title) like lower('%".$search_form['phrase']."%') or lower(picture_multilang.content) like lower('%".$search_form['phrase']."%')) ";
				$sql_count .= " AND (lower(picture_multilang.title) like lower('%".$search_form['phrase']."%') or lower(picture_multilang.content) like lower('%".$search_form['phrase']."%')) ";
			}

		}
		
		$sql .= " order by picture.`$order` $direction ";
		$sql .= " limit $offset, $limit ";
		
		// echo $sql;
		
		// ilośc wszystkich rekordów
		$temp = $this->DBM->getRow($sql_count);
		$record_count = $temp['ilosc'];
		
		// echo $record_count."<br>";
		
		$picture_list_temp = $this->DBM->getTable($sql);
		
		// reindex array
		if (sizeof($picture_list_temp)) {
			$picture_list = array();
			foreach ($picture_list_temp as $picture_details) {
				$picture_list[$picture_details[picture_id]] = $picture_details;
			}
		}
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParametersNew($record_count, $page_number, $limit);
		}
		
		return $picture_list;
	}
		
	/**
	 * pobiera przefiltrowaną listę artykułów powiązanych z podanym produktem
	 * wraz z listą wszystkich dostępnych artykułów (dla celów administracyjnych)
	 */
	
	function getPicturesForProduct($product_id, $order = "order", $direction = "desc", $search_form = null, $page_number = 1, $lang_id) {
		
		global $__CFG;
		
		if ($product_id) {
			
			// najpierw wybieramy normalną listę artykułów - przefiltrowaną wg. wskazanych filtrów
			$picture_list = $this->getPicturesSearch($order, $direction, $search_form, $page_number, $lang_id);
			
			// następnie wybieramy listę artykułów powiązanych z podanym produktem
			$sql = "select * from product_picture where product_id = '$product_id'";
			$pictures_temp = $this->DBM->getTable($sql);
			
			// przelatujemy tą tablicę zazanczając na liscie wssystkich artykułów te, które są powiązane
			if (sizeof($pictures_temp)) {
				foreach ($pictures_temp as $details) {
					if ($picture_list[$details['picture_id']]) {
						$picture_list[$details['picture_id']]['selected'] = 1;
					}
				}
			}
			
			return $picture_list;
		}
	}
	
	/**
	 * pobiera artykuły TYLKO powiązane z podanym produktem
	 */
	
	function getPicturesOnlyForProduct ($product_id, $lang_id) {
		
		if ($product_id && $lang_id) {
			
			$sql = "select picture.category_id, picture.order, picture.pic_01, picture_multilang.* from picture, picture_multilang, product_picture where picture_multilang.picture_id = picture.id and product_picture.picture_id = picture.id and picture_multilang.language_id = '$lang_id' and product_picture.product_id = '$product_id' ";
			$picture_list = $this->DBM->getTable($sql);
			
			return $picture_list;
		}
	}
	
	
	/**
	 * get pictures by category id
	 */
	
	function getPicturesByCategory ($category_id, $lang_id) {
		
		if ($category_id && $lang_id) {
			$search_form['category_id'] = $category_id;
			$search_form['status'] = 2;
			// paging cheating ;-)
			$__CFG['record_count_limit'] = 1;
			
			$picture_list = $this->getPicturesSearch("order", "desc", $search_form, 1, $lang_id, $page_number);
			
			return $picture_list;
		}
	}
	
	/**
	 * get pictures by category id
	 */
	
	function getPicturesToMenu ($category_id, $lang_id) {
		
		if ($category_id && $lang_id) {
			$search_form['category_id'] = $category_id;
			$search_form['status'] = 2;
			// paging cheating ;-)
			$__CFG['record_count_limit'] = 1;
			
			$picture_list = $this->getPicturesSearch("order", "asc", $search_form, 1, $lang_id, $page_number);
			
			return $picture_list;
		}
	}
	
	/**
	 * wyciaga dane o znajomych
	 */
	
	function getPicturesByNews ($limit, $page_number, $lang_id){
		
		if($limit){

			global $__CFG;
		// TEST!!!
		$__CFG['record_count_limit'] = $limit;
		
		$limit = $__CFG['record_count_limit'];			
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select picture.category_id, picture.order, picture.pic_01, picture_multilang.* from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture_multilang.language_id = '$lang_id' and picture.category_id = '5' order by date_created desc";		
			$sql_count  = "select count(*) as ilosc from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture_multilang.language_id = '$lang_id' and picture.category_id = '5' ";
			
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
	
	function getPicturesByCategoryToView ($limit, $page_number, $lang_id, $category_id){
		
		if($limit && $page_number && $lang_id && $category_id){

			global $__CFG;		
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select picture.category_id, picture.order, picture.pic_01, picture_multilang.* from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture_multilang.language_id = '$lang_id' and picture.category_id = '$category_id' and picture_multilang.status = '2' order by `order` asc";		
			$sql_count  = "select count(*) as ilosc from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture_multilang.language_id = '$lang_id' and picture.category_id = '$category_id' and picture_multilang.status = '2' ";
			
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
	 * wyciaga newsy wg kategorii
	 */
	
	function getPicturesByCategoryToViewRandom ($limit, $page_number, $lang_id, $category_id){
		
		if($limit && $page_number && $lang_id && $category_id){

			global $__CFG;		
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select picture.category_id, picture.order, picture.pic_01, picture_multilang.* from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture_multilang.language_id = '$lang_id' and picture.category_id = '$category_id' and picture_multilang.status = '2' order by rand()";		
			$sql_count  = "select count(*) as ilosc from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture_multilang.language_id = '$lang_id' and picture.category_id = '$category_id' and picture_multilang.status = '2' ";
			
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
	
	function getPicturesByCategoryAndTypeToView ($type, $limit, $page_number, $lang_id, $category_id){
		
			if($type && $limit && $page_number && $lang_id && $category_id){
			
			global $__CFG;		
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select picture.category_id, picture.order, picture.pic_01, picture_multilang.* from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture_multilang.language_id = '$lang_id' and picture.category_id = '$category_id' and picture_multilang.type = '$type' order by `order` asc";		
			$sql_count  = "select count(*) as ilosc from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture_multilang.language_id = '$lang_id' and picture.category_id = '$category_id' and picture_multilang.type = '$type' ";
			
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
	
	function getPictureByUrlNameAndId($url_name, $picture_id) {
			
		if ($url_name && $picture_id) {	
			//print_r($picture_id);
			$sql = "select picture_multilang.* from picture_multilang where picture_multilang.url_name = '$url_name' and picture_multilang.picture_id != '$picture_id'";
			$rv = $this->DBM->getRow($sql);
			//echo $sql;
			
		}
		return $rv;
	}
	
	/**
	 * sprawdza czy dany artykuł istnieje o tej samej nazwie url /uzywane do walidacji - dla nowgo artykułu/
	 */
	
	function getPictureByUrlName($url_name) {
			
		if ($url_name) {	
			$sql = "select picture_multilang.* from picture_multilang where picture_multilang.url_name = '$url_name' ";
			$rv = $this->DBM->getRow($sql);
			
		}
		return $rv;
	}
	
	/**
	 * pobiera pojedynczy artykuł do edycji
	 */
	
	function getPicture($picture_id, $lang_id) {
			
		if ($picture_id && $lang_id) {	
			$sql = "select picture.category_id, picture.order, picture.pic_01, picture.pic_02, picture.pic_03, picture_multilang.* from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture.id = '$picture_id' and picture_multilang.language_id = '$lang_id'";
			$rv = $this->DBM->getRow($sql);
			
		}
		return $rv;
	}
	
	/**
	 * pobiera pojedynczy artykuł do edycji
	 */
	
	function getPictureByUrlNameToView($url_name, $lang_id) {
			
		if ($url_name && $lang_id) {	
			$sql = "select picture.category_id, picture.order, picture.pic_01, picture.pic_02, picture.pic_03, picture_multilang.* from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture_multilang.url_name = '$url_name' and picture_multilang.language_id = '$lang_id'";
			$picture_details = $this->DBM->getRow($sql);
			
		
			if (sizeof($picture_details)) {
				
				// wybieramy nastepny (nowszy)
				
				$sql = "select picture_multilang.* from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture.`order` > '$picture_details[order]' and picture.category_id = '$picture_details[category_id]' and picture_multilang.language_id = '$lang_id' and picture_multilang.status != 1 order by picture.`order` asc limit 1";
				$next_picture = $this->DBM->getRow($sql);
				
				if (sizeof($next_picture)) {
					$picture_details['next'] = $next_picture['url_name'];
				}
				
				// wybieramy poprzedni (starszy) 
				
				$sql = "select picture_multilang.* from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture.`order` < '$picture_details[order]' and picture.category_id = '$picture_details[category_id]' and picture_multilang.language_id = '$lang_id' and picture_multilang.status != 1 order by picture.`order` desc limit 1";
				$previous_picture = $this->DBM->getRow($sql);
				
				if (sizeof($previous_picture)) {
					$picture_details['previous'] = $previous_picture['url_name'];
				}
			}		
		
		
		}
		return $picture_details;
	}
	
	/**
	 * pobiera pojedynczy artykuł do edycji
	 */
	
	function getPictureByUrlNameAndTypeToView($type, $url_name, $lang_id) {
			
		if ($url_name && $lang_id) {	
			$sql = "select picture.category_id, picture.order, picture.pic_01, picture.pic_02, picture.pic_03, picture_multilang.* from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture_multilang.url_name = '$url_name' and picture_multilang.language_id = '$lang_id'";
			$picture_details = $this->DBM->getRow($sql);
			
		
			if (sizeof($picture_details)) {
				
				// wybieramy nastepny (nowszy)
				
				$sql = "select picture_multilang.* from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture.`order` > '$picture_details[order]' and picture.category_id = '$picture_details[category_id]' and picture_multilang.language_id = '$lang_id' and picture_multilang.type = '$type' and picture_multilang.status != 1 order by picture.`order` asc limit 1";
				$next_picture = $this->DBM->getRow($sql);
				
				if (sizeof($next_picture)) {
					$picture_details['next'] = $next_picture['url_name'];
				}
				
				// wybieramy poprzedni (starszy) 
				
				$sql = "select picture_multilang.* from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture.`order` < '$picture_details[order]' and picture.category_id = '$picture_details[category_id]' and picture_multilang.language_id = '$lang_id' and picture_multilang.type = '$type' and picture_multilang.status != 1 order by picture.`order` desc limit 1";
				$previous_picture = $this->DBM->getRow($sql);
				
				if (sizeof($previous_picture)) {
					$picture_details['previous'] = $previous_picture['url_name'];
				}
			}		
		
		
		}
		return $picture_details;
	}
	
	/**
	 * wyciąga pierwszy artykuł z podanej kategorii (tylko id)
	 */
	
	function getFirstPictureInCategory ($category_id, $lang_id) {
		
		if ($category_id) {
			
			$sql = "select picture.id from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture.category_id = '$category_id' and picture_multilang.language_id = '$lang_id' and picture_multilang.status != 0 order by picture.`order` desc limit 1";
			$details = $this->DBM->getRow($sql);
			
			return $details['id'];
		}
	}
	
	/**
	 * pobiera pojedynczy artykuł do widoku szczegółów
	 */
	
	function getPictureDetails($picture_id, $lang_id) {
		
		if ($picture_id && $lang_id) {
			$sql = "select picture.category_id, picture.order, picture.pic_01, picture_multilang.* from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture.id = '$picture_id' and picture_multilang.language_id = '$lang_id'";
			$rv = $this->DBM->getRow($sql);
		}
		return $rv;
	}
	
	/**
	 * zapisuje pojedynczy artykuł
	 */
	
	function savePicture($picture_form) {
		
		global $__CFG;
		
		// data bieżąca 
		if($picture_form['date_created']){
			
			$date_now = $picture_form['date_created'];
			
		}
		else{
			
			$date_now = date("Y-m-d H:i:s", time());
			
		}
		
		
		
		if (!$picture_form['picture_id']) {
			
			// kolejność - to jest do przeniesienia do nowej klasy Order (?) albo osobna metoda w tej klasie (?)
			$sql = "select max(`order`) as last_order from picture where category_id = '$picture_form[category_id]'";
			$order = $this->DBM->getRow($sql);
			$next_order = $order['last_order'] + 1;
			
			// nowa metryka
			$sql = "insert into picture (category_id, `order`) values ('$picture_form[category_id]', '$next_order') ";
			$rv = $this->DBM->modifyTable($sql);
			$picture_id = $this->DBM->lastInsertID;
			
					// dodaj obrazek nr 1
			if ($_FILES['pic_01']['name']) {
				$pic_01 = "picture_".$picture_id."_01.jpg";
				$sql = "update picture set pic_01 = '$pic_01' where id = '$picture_id'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizePicturePicture ($_FILES['pic_01']['tmp_name'], $__CFG['picture_pictures_path'].$picture_id."_01_01.jpg", 70, 70);
				$this->resizePicturePicture ($_FILES['pic_01']['tmp_name'], $__CFG['picture_pictures_path'].$picture_id."_02_01.jpg", 200, 200);
				$this->resizePicturePicture ($_FILES['pic_01']['tmp_name'], $__CFG['picture_pictures_path'].$picture_id."_03_01.jpg", 650, 650);
				unlink($_FILES['pic_01']['tmp_name']);				
				

			}
			
			// dodaj obrazek nr 2
			if ($_FILES['pic_02']['name']) {
				$pic_02 = "picture_".$picture_id."_02.jpg";
				$sql = "update picture set pic_02 = '$pic_02' where id = '$picture_id'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizePicturePicture ($_FILES['pic_02']['tmp_name'], $__CFG['picture_pictures_path'].$picture_id."_01_02.jpg", 70, 70);
				$this->resizePicturePicture ($_FILES['pic_02']['tmp_name'], $__CFG['picture_pictures_path'].$picture_id."_02_02.jpg", 200, 200);
				$this->resizePicturePicture ($_FILES['pic_02']['tmp_name'], $__CFG['picture_pictures_path'].$picture_id."_03_02.jpg", 650, 650);
				unlink($_FILES['pic_02']['tmp_name']);				
				

			}
			
					
			// dodaj obrazek nr 3
			if ($_FILES['pic_03']['name']) {
				$pic_03 = "picture_".$picture_id."_03.jpg";
				$sql = "update picture set pic_03 = '$pic_03' where id = '$picture_id'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizePicturePicture ($_FILES['pic_03']['tmp_name'], $__CFG['picture_pictures_path'].$picture_id."_01_03.jpg", 70, 70);
				$this->resizePicturePicture ($_FILES['pic_03']['tmp_name'], $__CFG['picture_pictures_path'].$picture_id."_02_03.jpg", 200, 200);
				$this->resizePicturePicture ($_FILES['pic_03']['tmp_name'], $__CFG['picture_pictures_path'].$picture_id."_03_03.jpg", 650, 650);
				unlink($_FILES['pic_03']['tmp_name']);				
				

			}			
		
			
			if ($picture_id) {
				
				// zapisujemy wersję językową
				$sql  = "insert into picture_multilang (picture_id, type, url_name, podpis, language_id, title, abstract, content, status, date_created, date_modified) ";
				$sql .= " values ('$picture_id', '$picture_form[type]', '$picture_form[url_name]', '$picture_form[podpis]', '$picture_form[language_id]', '$picture_form[title]', '$picture_form[abstract]', '$picture_form[content]', '$picture_form[status]', '$date_now', '$date_now') ";
				$rv = $this->DBM->modifyTable($sql);
				
				// i wszystkie pozostałe wersje językowe (puste)
				$sql = "select * from language";
				$languages_list = $this->DBM->getTable($sql);
				
				if (sizeof($languages_list)) {
					foreach ($languages_list as $language) {
						// bez tego, który już wczesniej zapisaliśmy!
						if ($language['id'] != $picture_form['language_id']) {
							$sql  = "insert into picture_multilang (picture_id, language_id, status, date_created, date_modified, title) ";
							$sql .= " values ('$picture_id', '$language[id]', '0', '$date_now', '$date_now', '$picture_form[title]') ";
							$rv = $this->DBM->modifyTable($sql);
						}
					}
				}
			}
		}
		else {
			
			// aktualizacja artykułu
			
			// najpierw metryka artykułu (zmiana conajwyżej kategorii)
			$sql = "update picture set category_id = '$picture_form[category_id]' where id = '$picture_form[picture_id]'";
			$rv = $this->DBM->modifyTable($sql);
			
			
					// update obrazka (usunięcie lub aktualizacja - o ile został podany) nr 1
			if ($picture_form['remove_picture_01']) {
				// usuwamy obrazek
				$pic_01 = "";
				$sql = "update picture set pic_01 = '$pic_01' where id = '$picture_form[picture_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				unlink($__CFG['picture_pictures_path'].$picture_form['picture_id']."_01_01.jpg");
				unlink($__CFG['picture_pictures_path'].$picture_form['picture_id']."_02_01.jpg");
				unlink($__CFG['picture_pictures_path'].$picture_form['picture_id']."_03_01.jpg");
			}
			elseif ($_FILES['pic_01']['name']) {
				// aktualizujemy obrazek
				$pic_01 = "picture_".$picture_form['picture_id']."_01.jpg";
				$sql = "update picture set pic_01 = '$pic_01' where id = '$picture_form[picture_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				


				
				// pierwsza miniatura
				$this->resizePicturePicture ($_FILES['pic_01']['tmp_name'], $__CFG['picture_pictures_path'].$picture_form[picture_id]."_01_01.jpg", 70, 70);
				$this->resizePicturePicture ($_FILES['pic_01']['tmp_name'], $__CFG['picture_pictures_path'].$picture_form[picture_id]."_02_01.jpg", 200, 200);
				$this->resizePicturePicture ($_FILES['pic_01']['tmp_name'], $__CFG['picture_pictures_path'].$picture_form[picture_id]."_03_01.jpg", 650, 650);
				unlink($_FILES['pic_01']['tmp_name']);					
				
			}
			
			
			// update obrazka (usunięcie lub aktualizacja - o ile został podany) nr 2
			if ($picture_form['remove_picture_02']) {
				// usuwamy obrazek
				$pic_02 = "";
				$sql = "update picture set pic_02 = '$pic_02' where id = '$picture_form[picture_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				unlink($__CFG['picture_pictures_path'].$picture_form['picture_id']."_01_02.jpg");
				unlink($__CFG['picture_pictures_path'].$picture_form['picture_id']."_02_02.jpg");
				unlink($__CFG['picture_pictures_path'].$picture_form['picture_id']."_03_02.jpg");
			}
			elseif ($_FILES['pic_02']['name']) {
				// aktualizujemy obrazek
				$pic_02 = "picture_".$picture_form['picture_id']."_02.jpg";
				$sql = "update picture set pic_02 = '$pic_02' where id = '$picture_form[picture_id]'";
				$rv = $this->DBM->modifyTable($sql);

				
				// pierwsza miniatura
				$this->resizePicturePicture ($_FILES['pic_02']['tmp_name'], $__CFG['picture_pictures_path'].$picture_form[picture_id]."_01_02.jpg", 70, 70);
				$this->resizePicturePicture ($_FILES['pic_02']['tmp_name'], $__CFG['picture_pictures_path'].$picture_form[picture_id]."_02_02.jpg", 200, 200);
				$this->resizePicturePicture ($_FILES['pic_02']['tmp_name'], $__CFG['picture_pictures_path'].$picture_form[picture_id]."_03_02.jpg", 650, 650);
				unlink($_FILES['pic_02']['tmp_name']);					
				
			}			
			
			// update obrazka (usunięcie lub aktualizacja - o ile został podany) nr 3
			if ($picture_form['remove_picture_03']) {
				// usuwamy obrazek
				$pic_03 = "";
				$sql = "update picture set pic_03 = '$pic_03' where id = '$picture_form[picture_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				unlink($__CFG['picture_pictures_path'].$picture_form['picture_id']."_01_03.jpg");
				unlink($__CFG['picture_pictures_path'].$picture_form['picture_id']."_02_03.jpg");
				unlink($__CFG['picture_pictures_path'].$picture_form['picture_id']."_03_03.jpg");
			}
			elseif ($_FILES['pic_03']['name']) {
				// aktualizujemy obrazek
				$pic_03 = "picture_".$picture_form['picture_id']."_03.jpg";
				$sql = "update picture set pic_03 = '$pic_03' where id = '$picture_form[picture_id]'";
				$rv = $this->DBM->modifyTable($sql);
				

				
				// pierwsza miniatura
				$this->resizePicturePicture ($_FILES['pic_03']['tmp_name'], $__CFG['picture_pictures_path'].$picture_form[picture_id]."_01_03.jpg", 70, 70);
				$this->resizePicturePicture ($_FILES['pic_03']['tmp_name'], $__CFG['picture_pictures_path'].$picture_form[picture_id]."_02_03.jpg", 200, 200);
				$this->resizePicturePicture ($_FILES['pic_03']['tmp_name'], $__CFG['picture_pictures_path'].$picture_form[picture_id]."_03_03.jpg", 650, 650);
				unlink($_FILES['pic_03']['tmp_name']);					
				
			}
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			// a potem wersja językowa
			$sql = "update picture_multilang set type = '$picture_form[type]', url_name = '$picture_form[url_name]', podpis = '$picture_form[podpis]',  title = '$picture_form[title]', abstract = '$picture_form[abstract]', content = '$picture_form[content]', status = '$picture_form[status]', date_modified = '$date_now' where picture_id = '$picture_form[picture_id]' and language_id = '$picture_form[language_id]'";
			$rv = $this->DBM->modifyTable($sql);
			
		}
		
		// zwracamy ID ostatnio zapisanego artykułu
		if ($picture_id) { 
			return $picture_id;
		}
		else {
			return $picture_form['picture_id'];
		}
	}
	
	/**
	 * usuwa pojedynczy artykuł
	 */
	
	function removePicture($picture_id) {
			
		if ($picture_id) {
			// metryka
			$sql = "delete from picture where id = $picture_id ";
			$rv = $this->DBM->modifyTable($sql);
			// i wszystkie wersje językowe
			$sql = "delete from picture_multilang where picture_id = $picture_id ";
			$rv = $this->DBM->modifyTable($sql);
		}
		return $rv;
	}
	
	/**
	 * uaktualnia automatycznie kolejnosc artykułow w kategorii
	 */
	
	function updateOrder($picture_id, $position) {
			
		if ($picture_id && $position) {
			
			$sql = "update picture set `order` = '$position' where id = '$picture_id' ";
			$rv = $this->DBM->modifyTable($sql);
		}
		return $rv;

	}
	
	/**
	 * gets n random pictures from given category
	 */
	
	function getRandomPictures ($category_id, $limit, $lang_id) {
		
		if ($category_id && $limit && $lang_id) {
			$sql = "select picture.category_id, picture.order, picture_multilang.* from picture, picture_multilang where picture_multilang.picture_id = picture.id and picture.category_id = '$category_id' and picture_multilang.language_id = '$lang_id' order by rand() limit $limit";
			$picture_list = $this->DBM->getTable($sql);
			
			return $picture_list;
		}
		
	}
	
	/**
	 * gets all pictures
	 */
	
	function getPicturesAll ($lang_id) {
		
		if ($lang_id) {
			$sql = "select * from picture_multilang where language_id = '$lang_id' order by date_modified desc ";
			$picture_list = $this->DBM->getTable($sql);
			
			return $picture_list;
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
	
	function resizePicturePicture ($source_path, $target_path, $xmin, $ymin) {
		
		global $__CFG;
		
		if ($source_path && $target_path && $xmin && $ymin) {
			
			// tylko jeden format zdj�� jest dozwolony
			
			// $details = getimagesize($__CFG['picture_pictures_path'].$filename);
			$details = getimagesize($source_path);
			
			if ($details['mime'] == "image/jpeg") {
			
				// Set a maximum height and width
				$width = $xmin;
				$height = $ymin;
				
				// Get new dimensions 
				// list($width_orig, $height_orig) = getimagesize($__CFG['picture_pictures_path'].$filename);
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
				// list($width_orig, $height_orig) = getimagesize($__CFG['picture_pictures_path'].$filename);
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