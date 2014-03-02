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

class Product_related {
 
	/**
	 * @var object DBManager
	 */
	var $DBM;

	function Product_related() {
		global $DBM;
	 	$this->DBM = $DBM;
	}
	
	/**
	 * pobiera listę artykułów (posortowaną)
	 */
	
	function getProducts($order = "order", $direction = "desc", $page_number = 1, $category_id = 1, $lang_id) {
		
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		if (!$category_id) $category_id = 1;
		
		$sql  = "select count(*) as ilosc from product, product_multilang where product_multilang.product_id = product.id and product.category_id = '$category_id' and product_multilang.language_id = '$lang_id'";
				
		$temp = $this->DBM->getRow($sql);
		$record_count = $temp['ilosc'];
		
		$sql  = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product.category_id = '$category_id' and product_multilang.language_id = '$lang_id' ";		
		$sql .= " order by product.`$order` $direction limit $offset, $limit ";
		
		// echo $sql."<hr>";
		
		$product_list_temp = $this->DBM->getTable($sql);
		
		// reindex array
		if (sizeof($product_list_temp)) {
			$product_list = array();
			foreach ($product_list_temp as $product_details) {
				$product_list[$product_details[product_id]] = $product_details;
			}
		}
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParameters($record_count, $page_number);
		}
		
		return $product_list;
	}
	
	/**
	 * pobiera listę artykułów (posortowaną)
	 */
	
	function getProductsForRelated($order = "order", $direction = "desc", $page_number = 1, $lang_id) {
		//print_r($page_number);
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		$sql  = "select count(*) as ilosc from category where category.status = '1' and parent = '0'";
				
		$temp = $this->DBM->getRow($sql);
		$record_count = $temp['ilosc'];
		
		$sql  = "select category.* from category where category.status = '1' and parent = '0'";
		$sql .= " order by category.name $direction limit $offset, $limit ";
		
		//echo $sql."<hr>";

		$category_list = $this->DBM->getTable($sql);
	
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParametersNew($record_count, $page_number, $limit);
		}
		
		return $category_list;
	}
	
	/**
	 * zapisuje komentarz do blog
	 */
	
	function saveCommentProduct($comment_form) {
		
		global $__CFG;
		
		// data bieżąca 
		$date_now = date("Y-m-d H:i:s", time());
		
		if ($comment_form['content']) {
			
			// nowa metryka
			$sql = "insert into comment_product ( user_id, product_id, date_created, content ) values ('$comment_form[name]', '$comment_form[product_id]', '$date_now', '$comment_form[content]' ) ";
			$rv = $this->DBM->modifyTable($sql);
		}
		
	}
	
	/**
	 * pobiera listę produktów bonusowych (posortowaną)
	 */
	
	function getBonuss($order = "order", $direction = "desc", $page_number = 1, $category_id = 0, $lang_id) {
		
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		if (!$category_id) $category_id = 1;
		
		$sql  = "select count(*) as ilosc from product, product_multilang where product_multilang.product_id = product.id and product.category_id = '0' and product_multilang.bonus = '1' and product_multilang.language_id = '$lang_id'";
				
		$temp = $this->DBM->getRow($sql);
		$record_count = $temp['ilosc'];
		
		$sql  = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product.category_id = '0' and product_multilang.bonus = '1' and product_multilang.language_id = '$lang_id' ";		
		$sql .= " order by product.`$order` $direction limit $offset, $limit ";
		
		//echo $sql."<hr>";
		
		$product_list_temp = $this->DBM->getTable($sql);
		
		// reindex array
		if (sizeof($product_list_temp)) {
			$product_list = array();
			foreach ($product_list_temp as $product_details) {
				$product_list[$product_details[product_id]] = $product_details;
			}
		}
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParameters($record_count, $page_number);
		}
		
		return $product_list;
	}
	
	/**
	 * pobiera listę artykułów (posortowaną) wh podanego zutora
	 */
	
	function getProductsByWZT($order = "order", $direction = "desc", $page_number = 1, $category_id = 1, $lang_id, $WTZ) {
		
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		if (!$category_id) $category_id = 1;
		
		$sql  = "select count(*) as ilosc from product, product_multilang where product_multilang.product_id = product.id and product.category_id = '$category_id' and product_multilang.language_id = '$lang_id' and product_multilang.author_id = '$WTZ'";
				
		$temp = $this->DBM->getRow($sql);
		$record_count = $temp['ilosc'];
		
		$sql  = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product.category_id = '$category_id' and product_multilang.language_id = '$lang_id' and product_multilang.author_id = '$WTZ' ";		
		$sql .= " order by product.`$order` $direction limit $offset, $limit ";
		
		// echo $sql."<hr>";
		
		$product_list_temp = $this->DBM->getTable($sql);
		
		// reindex array
		if (sizeof($product_list_temp)) {
			$product_list = array();
			foreach ($product_list_temp as $product_details) {
				$product_list[$product_details[product_id]] = $product_details;
			}
		}
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParameters($record_count, $page_number);
		}
		
		return $product_list;
	}
	
	/**
	 * Przestawia status 
	 */
	
	function setStatus ($product_id, $status) {
		
		if ($product_id) {
			
			$sql = "update product_multilang set status = '$status' where product_multilang.product_id = '$product_id' ";
			$this->DBM->modifyTable($sql);
			
		}
	}	
	
	/**
	 * Przestawia wysyłkę listem
	 */
	
	function setLetter ($product_id, $letter) {
		
		if ($product_id) {
			
			$sql = "update product_multilang set letter = '$letter' where product_multilang.product_id = '$product_id' ";
			$this->DBM->modifyTable($sql);
			
		}
	}	
	
	/**
	 * Przestawia promocję 
	 */
	
	function setPromotion ($product_id, $status) {
		
		if ($product_id) {
			
			$sql = "update product_multilang set promotion = '$status' where product_multilang.product_id = '$product_id' ";
			$this->DBM->modifyTable($sql);
			
		}
	}

	/**
	 * Ustawia na stronę główną
	 */
	
	function setHome ($product_id, $status) {
		
		if ($product_id) {
			
			$sql = "update product_multilang set home = '$status' where product_multilang.product_id = '$product_id' ";
			$this->DBM->modifyTable($sql);
			
		}
	}	
		
	/**
	 * pobiera przefiltrowaną listę artykułów
	 */
	
	function getProductsSearch($limit, $order = "order", $direction = "desc", $search_form = null, $page_number = 1, $lang_id) {
		
		
		global $__CFG;
		
		
		$offset = ($page_number - 1) * $limit;
		
		$sql  = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product_multilang.language_id = '$lang_id' ";		
		$sql_count  = "select count(*) as ilosc from product, product_multilang where product_multilang.product_id = product.id and product_multilang.language_id = '$lang_id' ";
				
		if(sizeof($search_form)) {
			
			if ($search_form['category_id']) {
				$sql .= " AND product.category_id = ".$search_form['category_id']." ";
				$sql_count .= " AND product.category_id = ".$search_form['category_id']." ";
			}
			if ($search_form['category_parent']) {
				$sql .= " AND product_multilang.category_parent = ".$search_form['category_parent']." ";
				$sql_count .= " AND product_multilang.category_parent = ".$search_form['category_parent']." ";
			}
			if ($search_form['kind_parent']) {
				$sql .= " AND product_multilang.kind_parent = ".$search_form['kind_parent']." ";
				$sql_count .= " AND product_multilang.kind_parent = ".$search_form['kind_parent']." ";
			}
			if ($search_form['home']) {
				$sql .= " AND product_multilang.home = ".$search_form['home']." ";
				$sql_count .= " AND product_multilang.home = ".$search_form['home']." ";
			}
			if ($search_form['color']) {
				$sql .= " AND product_multilang.color = ".$search_form['color']." ";
				$sql_count .= " AND product_multilang.color = ".$search_form['color']." ";
			}
			if ($search_form['promotion']) {
				$sql .= " AND product_multilang.promotion = ".$search_form['promotion']." ";
				$sql_count .= " AND product_multilang.promotion = ".$search_form['promotion']." ";
			}
			if ($search_form['title']) {
				$sql .= " AND lower(product_multilang.title) like lower('%".$search_form['title']."%') ";
				$sql_count .= " AND lower(product_multilang.title) like lower('%".$search_form['title']."%') ";
			}
			if ($search_form['symbol']) {
				$sql .= " AND lower(product_multilang.symbol) like lower('%".$search_form['symbol']."%') ";
				$sql_count .= " AND lower(product_multilang.symbol) like lower('%".$search_form['symbol']."%') ";
			}
			if ($search_form['abstract']) {
				$sql .= " AND lower(product_multilang.abstract) like lower('%".$search_form['abstract']."%') ";
				$sql_count .= " AND lower(product_multilang.abstract) like lower('%".$search_form['abstract']."%') ";
			}
			if ($search_form['content']) {
				$sql .= " AND lower(product_multilang.content) like lower('%".$search_form['content']."%') ";
				$sql_count .= " AND lower(product_multilang.content) like lower('%".$search_form['content']."%') ";
			}
			if ($search_form['status']) {
				$sql .= " AND product_multilang.status = ".$search_form['status']." ";
				$sql_count .= " AND product_multilang.status = ".$search_form['status']." ";
			}
			if ($search_form['author_id']) {
				$sql .= " AND product_multilang.author_id = ".$search_form['author_id']." ";
				$sql_count .= " AND product_multilang.author_id = ".$search_form['author_id']." ";
			}
			if ($search_form['date_created_from'] && $search_form['date_created_to']) {
				$sql .= " AND product_multilang.date_created between '".$search_form['date_created_from']."' and '".$search_form['date_created_to']."' ";
				$sql_count .= " AND product_multilang.date_created between '".$search_form['date_created_from']."' and '".$search_form['date_created_to']."' ";
			}
			if ($search_form['date_modified_from'] && $search_form['date_modified_to']) {
				$sql .= " AND product_multilang.date_modified between '".$search_form['date_modified_from']."' and '".$search_form['date_modified_to']."' ";
				$sql_count .= " AND product_multilang.date_modified between '".$search_form['date_modified_from']."' and '".$search_form['date_modified_to']."' ";
			}
			if ($search_form['date_from']) {
				$sql .= " and substring(product_multilang.date_created, 1, 10) >= '$search_form[date_from]' ";
				$sql_count .= " and substring(product_multilang.date_created, 1, 10) >= '$search_form[date_from]' ";
			}
			
			if ($search_form['date_to']) {
				$sql .= " and substring(product_multilang.date_created, 1, 10) <= '$search_form[date_to]' ";
				$sql_count .= " and substring(product_multilang.date_created, 1, 10) <= '$search_form[date_to]' ";
			}	
			if ($search_form['price_from']) {
				$sql .= " AND product_multilang.price >= '$search_form[price_from]' ";
				$sql_count .= " AND product_multilang.price >= '$search_form[price_from]' ";
			}
			if ($search_form['price_to']) {
				$sql .= " AND product_multilang.price <= '$search_form[price_to]' ";
				$sql_count .= " AND product_multilang.price <= '$search_form[price_to]' ";
			}
			if ($search_form['type']) {
				$sql .= " AND product_multilang.type = '$search_form[type]' ";
				$sql_count .= " AND product_multilang.type = '$search_form[type]' ";
			}
			if ($search_form['type_id']) {
				$sql .= " AND product_multilang.type_id = '$search_form[type_id]' ";
				$sql_count .= " AND product_multilang.type_id = '$search_form[type_id]' ";
			}
			if ($search_form['no_bonus']) {
				$sql .= " AND product_multilang.bonus != '1' ";
				$sql_count .= " AND product_multilang.bonus != '1' ";
			}
		}
		
		$sql .= " order by product.`$order` $direction ";
		$sql .= " limit $offset, $limit ";
		
		// echo $sql;
		
		// ilośc wszystkich rekordów
		$temp = $this->DBM->getRow($sql_count);
		$record_count = $temp['ilosc'];
		
		// echo $record_count."<br>";
		
		$product_list_temp = $this->DBM->getTable($sql);
		
		// reindex array
		if (sizeof($product_list_temp)) {
			$product_list = array();
			foreach ($product_list_temp as $product_details) {
				$product_list[$product_details[product_id]] = $product_details;
			}
		}
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParametersNew($record_count, $page_number, $limit);
		}
		
		return $product_list;
	}
	
	/**
	 * pobiera przefiltrowaną listę artykułów
	 */
	
	function getProductsSearchForRelated($product_id, $limit, $order = "order", $direction = "desc", $search_form = null, $page_number = 1, $lang_id) {
		
		//print_r($limit);
		global $__CFG;
		
		
		$offset = ($page_number - 1) * $limit;
		
		$sql  = "select category.* from category where category.status = '1' and parent = '0' ";		
		$sql_count  = "select count(*) as ilosc from category where category.status = '1' and parent = '0' ";
				
		if(sizeof($search_form)) {
			

			if ($search_form['name']) {
				$sql .= " AND lower(category.name) like lower('%".$search_form['name']."%') ";
				$sql_count .= " AND lower(category.name) like lower('%".$search_form['name']."%') ";
			}
			if ($search_form['status']) {
				$sql .= " AND category.status = ".$search_form['status']." ";
				$sql_count .= " AND category.status = ".$search_form['status']." ";
			}
			
		}
		
		$sql .= " order by category.`$order` $direction ";
		$sql .= " limit $offset, $limit ";
		
		// echo $sql;
		
		// ilośc wszystkich rekordów
		$temp = $this->DBM->getRow($sql_count);
		$record_count = $temp['ilosc'];
		
		// echo $record_count."<br>";
		
		$category_list = $this->DBM->getTable($sql);
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParametersNew($record_count, $page_number, $limit);
		}
		
		return $category_list;
	}
	
	/**
	 * uzupełnia podaną liste produktów o informację czy są powiązane z wyjściowym produktem
	 * podana lista produktów jest w standardowym formacie tablicowym
	 */
	
	function checkRelatedProducts($product_id, $category_list) {
		
		if ($product_id && sizeof($category_list)) {
			
			// print_r($product_list);
			
			// wyciągamy tylko powiązane produkty
			$sql = "select * from product_related where product_id = '$product_id'";
			$related = $this->DBM->getTable($sql);
			
			// print_r($related);
			
			if (sizeof($related)) {
				
				$categories = array();
				
				// najpierw reindeksujemy przekazaną tablicę produktów
				foreach ($category_list as $details) {
					
					$categories[$details['id']] = $details;
					
					if ($details['sub']){
						
						
						foreach ($details['sub'] as $value) {
							
							
							foreach ($related as $related_details) {
									if ($value['id'] == $related_details['related_id']) {	
										$categories[$details['id']]['sub'][$value['id']]['selected'] = 1;
										//$categories[$related_details['related_id']]['selected'] = 1;
									}
							}								
							
							
							
							//$categories[$details['sub']][$value]['id'] = $value;
						}
						
					}
					
					
				}

				//print_r($related);
				// następnie dla każdego powiązanego produktu oznaczamy go w tablicy ze wszystkimi produktami

				
				// zwracamy przygotowaną tablicę
				return $categories;
			}
			else {
				// zwracamy pierwotną tablicę
				return $category_list;
			}
		}
		else {
			// zwracamy pierwotną tablicę (nawet jeżeli była pusta!)
			return $category_list;
		}
	}
	
	/**
	 * sprawdza czy produkt jest powiazany z dana kategoria
	 */
	
	function checkRelatedProductInCategory($product_id, $category_id) {
		
		if ($product_id && $category_id) {
			
			// print_r($product_list);
			
			// wyciągamy tylko powiązane produkty
			$sql = "select * from product_related where product_id = '$product_id' and related_id = '$category_id'";
			$related = $this->DBM->getRow($sql);
			
			// print_r($related);
			
			if ($related) {
				
				return true;
			}
				

		}
	}
	
	/**
	 * wybiera informacje o produkcie potrzebne do listy produktów powiazanych
	 */
	
	function getProductInfoRelated ($product_id) {
		
		if ($product_id) {
			
			// szczegóły produktu
			$product_details = $this->getProduct($product_id, $_SESSION['admin_lang']);
			
			// ilość produktów powiązanych :
			$sql = "select count(*) as amount from product_related where product_id = '$product_id'";
			$details = $this->DBM->getRow($sql);
			
			$product_details['related_amount'] = $details['amount'];
			
			return $product_details;
		}
	}
	
	/**
	 * dodaje produkty powiązane do produktu
	 */
	
	function addRelatedProductBulk ($product_id, $related) {
		//print_r($related);
		if ($product_id && sizeof($related)) {
			
			foreach ($related as $related_id => $key) {
				//print_r($related_id);
				$this->addRelatedProduct($product_id, $related_id);
			}
		}
	}
	
	/**
	 * dodaje produkt powiązany do produktu
	 */
	
	function addRelatedProduct ($product_id, $related_id) {
		
		if ($product_id && $related_id) {
			
			// najpierw sprawdź, czy już nie ma takiego powiązania
			$sql = "select * from product_related where product_id = '$product_id' and related_id = '$related_id'";
			$details = $this->DBM->getRow($sql);
			
			if (!sizeof($details)) {
				// zapisujemy powiązanie
				$sql = "insert into product_related (product_id, related_id) values ('$product_id', '$related_id')";
				$this->DBM->modifyTable($sql);
				
				return true;
			}
		}
		
	}
	
	/**
	 * usuwa produkt powiązany z produktu
	 */
	
	function removeRelatedProduct ($product_id, $related_id) {
		
		if ($product_id && $related_id) {
			
			$sql = "delete from product_related where product_id = '$product_id' and related_id = '$related_id'";
			$this->DBM->modifyTable($sql);
		}
	}
	
	/**
	 * usuwa produkty powiązane z produktu
	 */
	
	function removeRelatedProductBulk ($product_id, $related) {
		
		if ($product_id && sizeof($related)) {
			
			foreach ($related as $related_id => $key) {
				$this->removeRelatedProduct ($product_id, $related_id);
			}
		}
	}
	
	/**
	 * pobiera przefiltrowaną listę artykułów
	 */
	
	function getBonussSearch($limit, $order = "order", $direction = "desc", $search_form = null, $page_number = 1, $lang_id) {
		
		
		global $__CFG;
		
		
		$offset = ($page_number - 1) * $limit;
		
		$sql  = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product_multilang.language_id = '$lang_id' ";		
		$sql_count  = "select count(*) as ilosc from product, product_multilang where product_multilang.product_id = product.id and product_multilang.language_id = '$lang_id' ";
				
		if(sizeof($search_form)) {
			
			if ($search_form['category_id']) {
				$sql .= " AND product.category_id = ".$search_form['category_id']." ";
				$sql_count .= " AND product.category_id = ".$search_form['category_id']." ";
			}
			if ($search_form['home']) {
				$sql .= " AND product_multilang.home = ".$search_form['home']." ";
				$sql_count .= " AND product_multilang.home = ".$search_form['home']." ";
			}
			if ($search_form['color']) {
				$sql .= " AND product_multilang.color = ".$search_form['color']." ";
				$sql_count .= " AND product_multilang.color = ".$search_form['color']." ";
			}
			if ($search_form['promotion']) {
				$sql .= " AND product_multilang.promotion = ".$search_form['promotion']." ";
				$sql_count .= " AND product_multilang.promotion = ".$search_form['promotion']." ";
			}
			if ($search_form['bonus']) {
				$sql .= " AND product_multilang.bonus = 1 ";
				$sql_count .= " AND product_multilang.bonus = 1 ";
			}
			if ($search_form['title']) {
				$sql .= " AND lower(product_multilang.title) like lower('%".$search_form['title']."%') ";
				$sql_count .= " AND lower(product_multilang.title) like lower('%".$search_form['title']."%') ";
			}
			if ($search_form['abstract']) {
				$sql .= " AND lower(product_multilang.abstract) like lower('%".$search_form['abstract']."%') ";
				$sql_count .= " AND lower(product_multilang.abstract) like lower('%".$search_form['abstract']."%') ";
			}
			if ($search_form['content']) {
				$sql .= " AND lower(product_multilang.content) like lower('%".$search_form['content']."%') ";
				$sql_count .= " AND lower(product_multilang.content) like lower('%".$search_form['content']."%') ";
			}
			if ($search_form['status']) {
				$sql .= " AND product_multilang.status = ".$search_form['status']." ";
				$sql_count .= " AND product_multilang.status = ".$search_form['status']." ";
			}
			if ($search_form['author_id']) {
				$sql .= " AND product_multilang.author_id = ".$search_form['author_id']." ";
				$sql_count .= " AND product_multilang.author_id = ".$search_form['author_id']." ";
			}
			if ($search_form['date_created_from'] && $search_form['date_created_to']) {
				$sql .= " AND product_multilang.date_created between '".$search_form['date_created_from']."' and '".$search_form['date_created_to']."' ";
				$sql_count .= " AND product_multilang.date_created between '".$search_form['date_created_from']."' and '".$search_form['date_created_to']."' ";
			}
			if ($search_form['date_modified_from'] && $search_form['date_modified_to']) {
				$sql .= " AND product_multilang.date_modified between '".$search_form['date_modified_from']."' and '".$search_form['date_modified_to']."' ";
				$sql_count .= " AND product_multilang.date_modified between '".$search_form['date_modified_from']."' and '".$search_form['date_modified_to']."' ";
			}
			if ($search_form['date_from']) {
				$sql .= " and substring(product_multilang.date_created, 1, 10) >= '$search_form[date_from]' ";
				$sql_count .= " and substring(product_multilang.date_created, 1, 10) >= '$search_form[date_from]' ";
			}
			
			if ($search_form['date_to']) {
				$sql .= " and substring(product_multilang.date_created, 1, 10) <= '$search_form[date_to]' ";
				$sql_count .= " and substring(product_multilang.date_created, 1, 10) <= '$search_form[date_to]' ";
			}	
			if ($search_form['price_from']) {
				$sql .= " AND product_multilang.price >= '$search_form[price_from]' ";
				$sql_count .= " AND product_multilang.price >= '$search_form[price_from]' ";
			}
			if ($search_form['price_to']) {
				$sql .= " AND product_multilang.price <= '$search_form[price_to]' ";
				$sql_count .= " AND product_multilang.price <= '$search_form[price_to]' ";
			}
			if ($search_form['type']) {
				$sql .= " AND product_multilang.type = '$search_form[type]' ";
				$sql_count .= " AND product_multilang.type = '$search_form[type]' ";
			}
		}
		
		$sql .= " order by product.`$order` $direction ";
		$sql .= " limit $offset, $limit ";
		
		// echo $sql;
		
		// ilośc wszystkich rekordów
		$temp = $this->DBM->getRow($sql_count);
		$record_count = $temp['ilosc'];
		
		// echo $record_count."<br>";
		
		$product_list_temp = $this->DBM->getTable($sql);
		
		// reindex array
		if (sizeof($product_list_temp)) {
			$product_list = array();
			foreach ($product_list_temp as $product_details) {
				$product_list[$product_details[product_id]] = $product_details;
			}
		}
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParametersNew($record_count, $page_number, $limit);
		}
		
		return $product_list;
	}
	
	/**
	 * wybiera tylko produkty powiazane z produktem
	 */
	
	function getRelatedProductsOnly ($product_id) {
		
		if ($product_id) {

					
			$sql = " select category.* from category, product_related where category.id = product_related.related_id and product_related.product_id = '$product_id' and product_related.product_id != product_related.related_id and category.status = 1 order by category.`name` asc limit 0, 100 ";
			$product_list = $this->DBM->getTable($sql);
			

			
			//print_r($product_list);
			return $product_list;
			
		}
	}
	
	/**
	 * pobiera przefiltrowaną listę artykułów
	 */
	
	function getProductsSearchToView($order = "order", $direction = "desc", $search_form = null, $page_number = 1, $limit, $lang_id) {
		
		
		global $__CFG;
		
		
		$offset = ($page_number - 1) * $limit;
		
		$sql  = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product_multilang.language_id = '$lang_id' ";		
		$sql_count  = "select count(*) as ilosc from product, product_multilang where product_multilang.product_id = product.id and product_multilang.language_id = '$lang_id' ";
				
		if(sizeof($search_form)) {
			
			if ($search_form['category_id']) {
				$sql .= " AND product.category_id = ".$search_form['category_id']." ";
				$sql_count .= " AND product.category_id = ".$search_form['category_id']." ";
			}
			if ($search_form['kind_id']) {
				$sql .= " AND product.kind_id = ".$search_form['kind_id']." ";
				$sql_count .= " AND product.kind_id = ".$search_form['kind_id']." ";
			}
			if ($search_form['producer_id']) {
				$sql .= " AND product_multilang.category_parent = ".$search_form['producer_id']." ";
				$sql_count .= " AND product_multilang.category_parent = ".$search_form['producer_id']." ";
			}
			if ($search_form['bonus']) {
				$sql .= " AND product_multilang.bonus = 1";
				$sql_count .= " AND product_multilang.bonus = 1";
			}
			if ($search_form['parent_kind_id']) {
				$sql .= " AND product_multilang.kind_parent = ".$search_form['parent_kind_id']." ";
				$sql_count .= " AND product_multilang.kind_parent = ".$search_form['parent_kind_id']." ";
			}
			if ($search_form['home']) {
				$sql .= " AND product_multilang.home = ".$search_form['home']." ";
				$sql_count .= " AND product_multilang.home = ".$search_form['home']." ";
			}
			if ($search_form['promotion']) {
				$sql .= " AND product_multilang.promotion = ".$search_form['promotion']." ";
				$sql_count .= " AND product_multilang.promotion = ".$search_form['promotion']." ";
			}
			if ($search_form['title']) {
				$sql .= " AND lower(product_multilang.title) like lower('%".$search_form['title']."%') ";
				$sql_count .= " AND lower(product_multilang.title) like lower('%".$search_form['title']."%') ";
			}
			if ($search_form['abstract']) {
				$sql .= " AND lower(product_multilang.abstract) like lower('%".$search_form['abstract']."%') ";
				$sql_count .= " AND lower(product_multilang.abstract) like lower('%".$search_form['abstract']."%') ";
			}
			if ($search_form['content']) {
				$sql .= " AND lower(product_multilang.content) like lower('%".$search_form['content']."%') ";
				$sql_count .= " AND lower(product_multilang.content) like lower('%".$search_form['content']."%') ";
			}
			if ($search_form['status']) {
				$sql .= " AND product_multilang.status = ".$search_form['status']." ";
				$sql_count .= " AND product_multilang.status = ".$search_form['status']." ";
			}
			if ($search_form['stock']) {
				$sql .= " AND product_multilang.stock > 0 ";
				$sql_count .= " AND product_multilang.stock > 0 ";
			}
			if ($search_form['type']) {
				$sql .= " AND product_multilang.type_id = ".$search_form['type']." ";
				$sql_count .= " AND product_multilang.type_id = ".$search_form['type']." ";
			}
			if ($search_form['date_created_from'] && $search_form['date_created_to']) {
				$sql .= " AND product_multilang.date_created between '".$search_form['date_created_from']."' and '".$search_form['date_created_to']."' ";
				$sql_count .= " AND product_multilang.date_created between '".$search_form['date_created_from']."' and '".$search_form['date_created_to']."' ";
			}
			if ($search_form['date_modified_from'] && $search_form['date_modified_to']) {
				$sql .= " AND product_multilang.date_modified between '".$search_form['date_modified_from']."' and '".$search_form['date_modified_to']."' ";
				$sql_count .= " AND product_multilang.date_modified between '".$search_form['date_modified_from']."' and '".$search_form['date_modified_to']."' ";
			}
		}
		

		
		if($order == "title"){
			
			$sql .= " order by product_multilang.`$order` $direction ";
		}
		elseif($order == "price"){
			
			$sql .= " order by product_multilang.`$order` $direction ";
		}
		else{
			
			$sql .= " order by product.order $direction ";
		}
		
		$sql .= " limit $offset, $limit ";
		
		// echo $sql;
		
		// ilośc wszystkich rekordów
		$temp = $this->DBM->getRow($sql_count);
		$record_count = $temp['ilosc'];
		
		// echo $record_count."<br>";
		
		$product_list_temp = $this->DBM->getTable($sql);
		
		// reindex array
		if (sizeof($product_list_temp)) {
			$product_list = array();
			foreach ($product_list_temp as $product_details) {
				$product_list[$product_details[product_id]] = $product_details;
			}
		}
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParametersNew($record_count, $page_number, $limit);
		}
		
		return $product_list;
	}

	/**
	 * Zamiana dużych polskich znakó na małe
	 */	
	
	function lower_pl($str){
		return strtoupper($str, "ąćęłńóśźż", "ĄĆĘŁŃÓŚŹŻ");
	}
	
	/**
	 * pobiera listę produktów dla porównywarki CENEO
	 */
	
	function getProductsCENEO($order = "id", $direction = "desc", $lang_id = 1) {
		
		global $__CFG;
		global $dict_templates;
		
		$sql  = "select category.name as producer_name, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang, category where product_multilang.product_id = product.id and product_multilang.category_parent = category.id and product_multilang.language_id = '$lang_id' and product_multilang.status = 2 ";		
		$sql .= " order by product_multilang.`$order` $direction";
		
		$product_list = $this->DBM->getTable($sql);
		
		if (sizeof($product_list)) {
			
			foreach ($product_list as $key => $details) {
				
				$product_name = iconv("UTF-8", "UTF-8", $details['name']);
				$product_name2 = str_replace("&", '', $product_name);
				$product_list[$key]['name'] = strip_tags($product_name2);
				
				
				$product_description = iconv("UTF-8", "UTF-8", strip_tags($details['description']));
				$product_description2 = str_replace("&", '', $product_description);
				$product_list[$key]['description'] = strip_tags($product_description2);
				
				$product_producer = iconv("UTF-8", "UTF-8", $details['producer_name']);
				$product_producer2 = str_replace("&", '', $product_producer);
				$product_list[$key]['producer_name'] = strip_tags($product_producer2);
			}
		}
		
		// szukamy da każdego produktu odpowiedniej subkategorii w kategorii CENEO

		
		if (sizeof($product_list)) {
			
			foreach ($product_list as $key => $details) {
				
				$product_list[$key]['category_name'] = $dict_templates['compare_category'][$details[compare]];
			}
		}
		return $product_list;
	}
	
	/**
	 * Reindekuje tavlice kategorii w nadkategoriach
	 */
	
	function reindexCategoryList ($category_list_temp){
		
		if ($category_list_temp){
		

			$category_list = array();
			require_once('Category.class.php');
			$category = new Category();
	
			foreach ($category_list_temp as $key => $details) {
	
				$category_list[$key] = $details;
				$subcategory_list = $category->getCategoriesByCategory($details['id']);
				$category_list[$key]['sub'] = $subcategory_list;
			}
		}
		
		return $category_list;
		
		
	}
	
	/**
	 * pobiera listę produktów dla porównywarki CENEO
	 */
	
	function getProductsTemp($order = "id", $direction = "desc", $lang_id = 1) {
		
		global $__CFG;
		global $dict_templates;
		
		$sql  = "select product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product_multilang.language_id = '$lang_id'";		
		$sql .= " order by product_multilang.`$order` $direction";
		
		$product_list = $this->DBM->getTable($sql);

		return $product_list;
	}
	
	/**
	 * wyrzuca liste produktów do dynamiczej listy w wyszukiwaniu
	 */
	
	function searchProductsForAjax ($name, $lang_id) {
		
		if ($name) {
			//print_r($lang_id);
			$name = str_replace(" ", "%", $name);
			//print_r($lang_id);
			$name = str_replace("ż", "Ż", $name);
			//$phrase = str_replace("ż", "Ż", $phrase);
			

			
			
			$sql = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product_multilang.title like '%".$name."%' and product_multilang.status = 2 and product_multilang.language_id = '$lang_id' ";

			$sql .= "order by product_multilang.title desc";
			$product_list = $this->DBM->getTable($sql);
		
			
		}
		return $product_list;
	}
		
	/**
	 * pobiera przefiltrowaną listę artykułów powiązanych z podanym produktem
	 * wraz z listą wszystkich dostępnych artykułów (dla celów administracyjnych)
	 */
	
	function getProductsForProduct($product_id, $order = "order", $direction = "desc", $search_form = null, $page_number = 1, $lang_id) {
		
		global $__CFG;
		
		if ($product_id) {
			
			// najpierw wybieramy normalną listę artykułów - przefiltrowaną wg. wskazanych filtrów
			$product_list = $this->getProductsSearch($order, $direction, $search_form, $page_number, $lang_id);
			
			// następnie wybieramy listę artykułów powiązanych z podanym produktem
			$sql = "select * from product_product where product_id = '$product_id'";
			$products_temp = $this->DBM->getTable($sql);
			
			// przelatujemy tą tablicę zazanczając na liscie wssystkich artykułów te, które są powiązane
			if (sizeof($products_temp)) {
				foreach ($products_temp as $details) {
					if ($product_list[$details['product_id']]) {
						$product_list[$details['product_id']]['selected'] = 1;
					}
				}
			}
			
			return $product_list;
		}
	}
	
	/**
	 * pobiera artykuły TYLKO powiązane z podanym produktem
	 */
	
	function getProductsOnlyForProduct ($product_id, $lang_id) {
		
		if ($product_id && $lang_id) {
			
			$sql = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang, product_product where product_multilang.product_id = product.id and product_product.product_id = product.id and product_multilang.language_id = '$lang_id' and product_product.product_id = '$product_id' ";
			$product_list = $this->DBM->getTable($sql);
			
			return $product_list;
		}
	}
	
	
	/**
	 * get products by category id
	 */
	
	function getProductsByCategory ($category_id, $lang_id) {
		
		if ($category_id && $lang_id) {
			$search_form['category_id'] = $category_id;
			
			// paging cheating ;-)
			$__CFG['record_count_limit'] = 1;
			
			$product_list = $this->getProductsSearch("order", "desc", $search_form, 1, $lang_id, $page_number);
			
			return $product_list;
		}
	}
	
	/**
	 * get products by category id to view
	 */
	
	function getProductsByCategoryToView ($category_id, $page_number, $limit, $lang_id, $filters) {
		
		if ($category_id && $lang_id) {
			$search_form['category_id'] = $category_id;
			$search_form['status'] = 2;
			$search_form['type'] = $filters['type'];
			//Artykuły sprzedane
			$product_list = $this->getProductsSearchToView($filters['order'], $filters['dir'], $search_form, $page_number, $limit, $lang_id );
			
			
			
			
			return $product_list;
		}
	}
	
	/**
	 * get products by category id to view
	 */
	
	function getBonusByCategoryToView ($page_number, $limit, $lang_id, $filters) {
		
		if ($lang_id) {
			
			$search_form['status'] = 2;
			$search_form['type'] = $filters['type'];
			$search_form['bonus'] = 1;
			$search_form['stock'] = 1;
			//Artykuły sprzedane
			$product_list = $this->getProductsSearchToView($filters['order'], $filters['dir'], $search_form, $page_number, $limit, $lang_id );
			
			
			
			
			return $product_list;
		}
	}
	
	/**
	 * get products by category id to view
	 */
	
	function getProductsByKindToView ($kind_id, $page_number, $limit, $lang_id, $filters) {
		
		if ($kind_id && $lang_id) {
			$search_form['kind_id'] = $kind_id;
			$search_form['status'] = 2;
			$search_form['type'] = $filters['type'];
			//Artykuły sprzedane
			$product_list = $this->getProductsSearchToView($filters['order'], $filters['dir'], $search_form, $page_number, $limit, $lang_id );
			
			
			
			
			return $product_list;
		}
	}
	
	/**
	 * get products by category id to view
	 */
	
	function getProductsByProducerToView ($producer_id, $page_number, $limit, $lang_id, $filters) {
		
		if ($producer_id && $lang_id) {
			$search_form['producer_id'] = $producer_id;
			$search_form['status'] = 2;
			$search_form['type'] = $filters['type'];
			//Artykuły sprzedane
			$product_list = $this->getProductsSearchToView($filters['order'], $filters['dir'], $search_form, $page_number, $limit, $lang_id );
			
			
			
			
			return $product_list;
		}
	}
	
	/**
	 * get products by category id to view
	 */
	
	function getProductsByParentKindToView ($parent_kind_id, $page_number, $limit, $lang_id, $filters) {
		
		if ($parent_kind_id && $lang_id) {
			$search_form['parent_kind_id'] = $parent_kind_id;
			$search_form['status'] = 2;
			$search_form['type'] = $filters['type'];
			//Artykuły sprzedane
			$product_list = $this->getProductsSearchToView($filters['order'], $filters['dir'], $search_form, $page_number, $limit, $lang_id );
			
			
			
			
			return $product_list;
		}
	}
	
	/**
	 * produkty promocyjne
	 */
	
	function getProductsByPromotion ($limit, $lang_id) {
		
		if($lang_id && $limit){

			$sql  = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.*, category.name as producer, category.url_name as producer_url_name from product, product_multilang, category where product_multilang.category_parent = category.id and product_multilang.product_id = product.id and product_multilang.language_id = '$lang_id' and product_multilang.promotion = '1' and product_multilang.status = '2' order by rand() desc";		
			
			$sql .= " limit $limit ";
			//echo $s
			$product_list_promo = $this->DBM->getTable($sql);
		
		}
		
		return $product_list_promo;
	}
	
	/**
	 * wyciaga produkty promocyjne
	 */
	
	function getProductsByPromo ($limit, $page_number, $lang_id){
		//print_r($page_number);
		if($limit){

			global $__CFG;
		// TEST!!!
		$__CFG['record_count_limit'] = $limit;
		
			$limit = $__CFG['record_count_limit'];			
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product_multilang.status = '2' and product_multilang.promotion = 1 and product_multilang.language_id = '$lang_id' order by date_created desc";		
			$sql_count  = "select count(*) as ilosc from product, product_multilang where product_multilang.product_id = product.id and product_multilang.status = '2' and product_multilang.promotion = 1 and product_multilang.language_id = '$lang_id'  ";
			
			$sql .= " limit $offset, $limit ";
			
			
			// echo $sql;
			
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
	 * wyciaga produkty promocyjne
	 */
	
	function getProductsByTheBest ($limit, $page_number, $lang_id){
		//print_r($page_number);
		if($limit){

			global $__CFG;
		// TEST!!!
		$__CFG['record_count_limit'] = $limit;
		
			$limit = $__CFG['record_count_limit'];			
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product_multilang.status = '2' and product_multilang.home = 1 and product_multilang.language_id = '$lang_id' order by date_created desc";		
			$sql_count  = "select count(*) as ilosc from product, product_multilang where product_multilang.product_id = product.id and product_multilang.status = '2' and product_multilang.home = 1 and product_multilang.language_id = '$lang_id'  ";
			
			$sql .= " limit $offset, $limit ";
			
			
			// echo $sql;
			
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
	 * produkty na strone główna
	 */
	
	function getProductsByHome ($limit_home, $lang_id) {
		
		if($lang_id && $limit_home){

			$sql  = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.*, category.name as producer, category.url_name as producer_url_name from product, product_multilang, category where product_multilang.category_parent = category.id and product_multilang.product_id = product.id and product_multilang.language_id = '$lang_id' and product_multilang.home = '1' and product_multilang.status = '2' order by rand() desc";		
			
			$sql .= " limit $limit_home ";
			//echo $record_count."<br>";
			$product_list_home = $this->DBM->getTable($sql);
		}
		//print_r($product_list_home);
		return $product_list_home;
	}
	
	/**
	 * get products by category id to view
	 */
	
	function getOtherProductsFromCategory ($category_id, $product_id, $lang_id) {
		
		if ($category_id && $lang_id) {

			$sql = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product.id != '$product_id' and product.category_id = '$category_id' and product_multilang.language_id = '$lang_id' and product_multilang.status = '2' order by rand() limit 15";
			$product_list = $this->DBM->getTable($sql);			
			
			return $product_list;
		}
	}
	
	/**
	 * get products by category id to view
	 */
	
	function getOtherProductsFromAuthor ($author_id, $product_id, $lang_id) {
		
		if ($author_id && $lang_id) {

			$sql = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product.id != '$product_id' and product_multilang.author_id = '$author_id' and product_multilang.language_id = '$lang_id' and product_multilang.status = '2' order by rand() asc limit 15";
			$product_list = $this->DBM->getTable($sql);			
			
			return $product_list;
		}
	}
	
	
	/**
	 * wyciaga newsy wg autora
	 */
	
	function getProductsByAuthor ($author_id, $limit, $page_number, $lang_id){
		//print_r($page_number);
		if($limit){

			global $__CFG;
		// TEST!!!
		$__CFG['record_count_limit'] = $limit;
		
		$limit = $__CFG['record_count_limit'];			
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product_multilang.language_id = '$lang_id' and product_multilang.author_id = '$author_id' order by date_created desc";		
			$sql_count  = "select count(*) as ilosc from product, product_multilang where product_multilang.product_id = product.id and product_multilang.language_id = '$lang_id' and product_multilang.author_id = '$author_id' ";
			
			$sql .= " limit $offset, $limit ";
			
			
			// echo $sql;
			
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
	 * wyciaga produkty najnowsze
	 */
	
	function getProductsNews ($limit, $page_number, $lang_id){
		//print_r($page_number);
		if($limit){

			global $__CFG;
		// TEST!!!
		$__CFG['record_count_limit'] = $limit;
		
		$limit = $__CFG['record_count_limit'];			
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product_multilang.status = '2' and product_multilang.language_id = '$lang_id' order by date_created desc";		
			$sql_count  = "select count(*) as ilosc from product, product_multilang where product_multilang.product_id = product.id and product_multilang.status = '2' and product_multilang.language_id = '$lang_id'  ";
			
			$sql .= " limit $offset, $limit ";
			
			
			// echo $sql;
			
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
	 * wyciaga produkty najnowsze dla rss
	 */
	
	function getProductsByRss ($limit, $page_number, $lang_id){
		
		if($limit){

			global $__CFG;
		
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product_multilang.language_id = '$lang_id' and product_multilang.status = 2 order by date_created desc";		
			$sql_count  = "select count(*) as ilosc from product, product_multilang where product_multilang.product_id = product.id and product_multilang.status = 2 and product_multilang.language_id = '$lang_id'  ";
			
			$sql .= " limit $offset, $limit ";
			
			
			// echo $sql;
			
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
	 * pobiera pojedynczy artykuł do edycji
	 */
	
	function getProduct($product_id, $lang_id) {
			
		if ($product_id && $lang_id) {	
			$sql = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product.id = '$product_id' and product_multilang.language_id = '$lang_id'";
			$rv = $this->DBM->getRow($sql);
			
		}
		return $rv;
	}
	
	/**
	 * uaktualnia automatycznie kolejnosc produktow w kategorii
	 */
	
	function updateOrder($product_id, $position) {
			
		if ($product_id && $position) {
			
			$sql = "update product set `order` = '$position' where id = '$product_id' ";
			$rv = $this->DBM->modifyTable($sql);
		}
		return $rv;

	}
	
	/**
	 * pobiera pojedynczy artykuł do edycji dla admina
	 */
	
	function getProductForAdmin($product_id, $lang_id) {
			
		if ($product_id && $lang_id) {	
			$sql = "select product.category_id, product.kind_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product.id = '$product_id' and product_multilang.language_id = '$lang_id'";
			$rv = $this->DBM->getRow($sql);
			
		}
		return $rv;
	}
	
	/**
	 * pobiera pojedynczy artykuł przygotowujac dane do usuniecia
	 */
	
	function getProductToRemove($product_id, $lang_id) {
			
		if ($product_id && $lang_id) {	
			$sql = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product.id = '$product_id' and product_multilang.language_id = '$lang_id'";
			$rv = $this->DBM->getRow($sql);
			
		}
		return $rv;
	}
	
	/**
	 * pobiera pojedynczy artykuł do edycji
	 */
	
	function getProductByUrlNameToView($url_name, $lang_id) {
			
		if ($url_name && $lang_id) {	
			$sql = "select product.category_id, product.kind_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product_multilang.url_name = '$url_name' and product_multilang.language_id = '$lang_id'";
			$rv = $this->DBM->getRow($sql);
			
		}
		return $rv;
	}
	
	/**
	 * sprawdza czy dany produkt istnieje o tej samej nazwie url /uzywane do walidacji - dla nowgo produktu/
	 */
	
	function getProductByUrlName($url_name) {
			
		if ($url_name) {	
			$sql = "select product_multilang.* from product_multilang where product_multilang.url_name = '$url_name' ";
			$rv = $this->DBM->getRow($sql);
			
		}
		return $rv;
	}
	
	/**
	 * sprawdza czy dany produkt istnieje o tej samej nazwie url /uzywane do walidacji - dla istniejaqcego produktu/
	 */
	
	function getProductByUrlNameAndId($url_name, $product_id) {
			
		if ($url_name && $product_id) {	
			//print_r($product_id);
			$sql = "select product_multilang.* from product_multilang where product_multilang.url_name = '$url_name' and product_multilang.product_id != '$product_id'";
			$rv = $this->DBM->getRow($sql);
			//echo $sql;
			
		}
		return $rv;
	}
	
	/**
	 * wyciąga pierwszy artykuł z podanej kategorii (tylko id)
	 */
	
	function getFirstProductInCategory ($category_id, $lang_id) {
		
		if ($category_id) {
			
			$sql = "select product.id from product, product_multilang where product_multilang.product_id = product.id and product.category_id = '$category_id' and product_multilang.language_id = '$lang_id' and product_multilang.status != 0 order by product.`order` desc limit 1";
			$details = $this->DBM->getRow($sql);
			
			return $details['id'];
		}
	}
	
	/**
	 * pobiera pojedynczy artykuł do widoku szczegółów
	 */
	
	function getProductDetails($product_id, $lang_id) {
		
		if ($product_id && $lang_id) {
			$sql = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product.id = '$product_id' and product_multilang.language_id = '$lang_id'";
			$rv = $this->DBM->getRow($sql);
		}
		return $rv;
	}
	
	/**
	 * pobiera listę komentarzy do blog	
	 */
	
	function getCommentsByProducts($product_id, $limit_count, $page_number = 1, $order = "order", $direction = "desc") {
		
		global $__CFG;

		$limit = $limit_count;
		$offset = ($page_number - 1) * $limit;
		
		$sql  = "select count(*) as ilosc from comment_product, product where product.id = comment_product.product_id and product.id = '$product_id' ";
				
		$temp = $this->DBM->getRow($sql);
		$record_count = $temp['ilosc'];
		
		$sql  = "select comment_product.* from comment_product, product where product.id = comment_product.product_id and product.id = '$product_id' ";		
		$sql .= " order by comment_product.date_created desc limit $offset, $limit ";
		
		//echo $sql."<hr>";
		
		$comment_list = $this->DBM->getTable($sql);
		

		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParametersNew($record_count, $page_number, $limit);
		}
		
		return $comment_list;
	}
	
	/**
	 * zapisuje pojedynczy artykuł
	 */
	
	function saveProduct($product_form) {
		
		global $__CFG;
		
		// data bieżąca 
		$date_now = date("Y-m-d H:i:s", time());
		
		if (!$product_form['product_id']) {
			
			// kolejność - to jest do przeniesienia do nowej klasy Order (?) albo osobna metoda w tej klasie (?)
			$sql = "select max(`order`) as last_order from product where category_id = '$product_form[category_id]'";
			$order = $this->DBM->getRow($sql);
			$next_order = $order['last_order'] + 1;
			
			// nowa metryka
			$sql = "insert into product (category_id, kind_id, `order`) values ('$product_form[category_id]', '$product_form[kind_id]', '$next_order') ";
			$rv = $this->DBM->modifyTable($sql);
			$product_id = $this->DBM->lastInsertID;
			
			// dodaj obrazek nr 1
			if ($_FILES['pic_01']['name']) {
				$pic_01 = "product_".$product_id."_01.jpg";
				$sql = "update product set pic_01 = '$pic_01' where id = '$product_id'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeProductPicture ($_FILES['pic_01']['tmp_name'], $__CFG['product_pictures_path'].$product_id."_01_01.jpg", 50, 50);
				$this->resizeProductPicture ($_FILES['pic_01']['tmp_name'], $__CFG['product_pictures_path'].$product_id."_02_01.jpg", 130, 130);
				$this->resizeProductPicture ($_FILES['pic_01']['tmp_name'], $__CFG['product_pictures_path'].$product_id."_03_01.jpg", 445, 445);
				unlink($_FILES['pic_01']['tmp_name']);				
				

			}
			
			// dodaj obrazek nr 2
			if ($_FILES['pic_02']['name']) {
				$pic_02 = "product_".$product_id."_02.jpg";
				$sql = "update product set pic_02 = '$pic_02' where id = '$product_id'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeProductPicture ($_FILES['pic_02']['tmp_name'], $__CFG['product_pictures_path'].$product_id."_01_02.jpg", 50, 50);
				$this->resizeProductPicture ($_FILES['pic_02']['tmp_name'], $__CFG['product_pictures_path'].$product_id."_02_02.jpg", 130, 130);
				$this->resizeProductPicture ($_FILES['pic_02']['tmp_name'], $__CFG['product_pictures_path'].$product_id."_03_02.jpg", 445, 445);
				unlink($_FILES['pic_02']['tmp_name']);				
				

			}
			
					
			// dodaj obrazek nr 3
			if ($_FILES['pic_03']['name']) {
				$pic_03 = "product_".$product_id."_03.jpg";
				$sql = "update product set pic_03 = '$pic_03' where id = '$product_id'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeProductPicture ($_FILES['pic_03']['tmp_name'], $__CFG['product_pictures_path'].$product_id."_01_03.jpg", 50, 50);
				$this->resizeProductPicture ($_FILES['pic_03']['tmp_name'], $__CFG['product_pictures_path'].$product_id."_02_03.jpg", 130, 130);
				$this->resizeProductPicture ($_FILES['pic_03']['tmp_name'], $__CFG['product_pictures_path'].$product_id."_03_03.jpg", 445, 445);
				unlink($_FILES['pic_03']['tmp_name']);				
				

			}
			
			if ($product_id) {
				
				// zapisujemy wersję językową
				$sql  = "insert into product_multilang (product_id, category_parent, kind_parent, url_name, language_id, title, price, promo_price, weight, abstract, content, content2, status, date_created, date_modified, level, type_id, stock, bonus, value_price, compare, letter) ";
				$sql .= " values ('$product_id', '$product_form[category_parent]', '$product_form[kind_parent]', '$product_form[url_name]', '$product_form[language_id]', '$product_form[title]', '$product_form[price]', '$product_form[promo_price]', '$product_form[weight]', '$product_form[abstract]', '$product_form[content]', '$product_form[content2]', '$product_form[status]', '$date_now', '$date_now', '$product_form[level]', '$product_form[type_id]', '$product_form[stock]', '$product_form[bonus]', '$product_form[value_price]', '$product_form[compare]', '$product_form[letter]') ";
				$rv = $this->DBM->modifyTable($sql);
				
				// i wszystkie pozostałe wersje językowe (puste)
				$sql = "select * from language";
				$languages_list = $this->DBM->getTable($sql);
				
				if (sizeof($languages_list)) {
					foreach ($languages_list as $language) {
						// bez tego, który już wczesniej zapisaliśmy!
						if ($language['id'] != $product_form['language_id']) {
							$sql  = "insert into product_multilang (product_id, category_parent, kind_parent, language_id, status, date_created, date_modified, symbol, title) ";
							$sql .= " values ('$product_id', '$product_form[category_parent]', '$product_form[kind_parent]', '$language[id]', '0', '$date_now', '$date_now', '$product_form[symbol]', '$product_form[title]') ";
							$rv = $this->DBM->modifyTable($sql);
						}
					}
				}
			}
		}
		else {
			
			// aktualizacja artykułu
			
			// najpierw metryka artykułu (zmiana conajwyżej kategorii)
			$sql = "update product set category_id = '$product_form[category_id]', kind_id = '$product_form[kind_id]' where id = '$product_form[product_id]'";
			$rv = $this->DBM->modifyTable($sql);
			
			// update obrazka (usunięcie lub aktualizacja - o ile został podany) nr 1
			if ($product_form['remove_picture_01']) {
				// usuwamy obrazek
				$pic_01 = "";
				$sql = "update product set pic_01 = '$pic_01' where id = '$product_form[product_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				unlink($__CFG['product_pictures_path'].$product_form['product_id']."_01_01.jpg");
				unlink($__CFG['product_pictures_path'].$product_form['product_id']."_02_01.jpg");
				unlink($__CFG['product_pictures_path'].$product_form['product_id']."_03_01.jpg");

			}
			elseif ($_FILES['pic_01']['name']) {
				// aktualizujemy obrazek
				$pic_01 = "product_".$product_form['product_id']."_01.jpg";
				$sql = "update product set pic_01 = '$pic_01' where id = '$product_form[product_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeProductPicture ($_FILES['pic_01']['tmp_name'], $__CFG['product_pictures_path'].$product_form[product_id]."_01_01.jpg", 50, 50);
				$this->resizeProductPicture ($_FILES['pic_01']['tmp_name'], $__CFG['product_pictures_path'].$product_form[product_id]."_02_01.jpg", 130, 130);
				$this->resizeProductPicture ($_FILES['pic_01']['tmp_name'], $__CFG['product_pictures_path'].$product_form[product_id]."_03_01.jpg", 445, 445);

				unlink($_FILES['pic_01']['tmp_name']);					
				
			}
			
			
			// update obrazka (usunięcie lub aktualizacja - o ile został podany) nr 2
			if ($product_form['remove_picture_02']) {
				// usuwamy obrazek
				$pic_02 = "";
				$sql = "update product set pic_02 = '$pic_02' where id = '$product_form[product_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				unlink($__CFG['product_pictures_path'].$product_form['product_id']."_01_02.jpg");
				unlink($__CFG['product_pictures_path'].$product_form['product_id']."_02_02.jpg");
				unlink($__CFG['product_pictures_path'].$product_form['product_id']."_03_02.jpg");
			}
			elseif ($_FILES['pic_02']['name']) {
				// aktualizujemy obrazek
				$pic_02 = "product_".$product_form['product_id']."_02.jpg";
				$sql = "update product set pic_02 = '$pic_02' where id = '$product_form[product_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeProductPicture ($_FILES['pic_02']['tmp_name'], $__CFG['product_pictures_path'].$product_form[product_id]."_01_02.jpg", 50, 50);
				$this->resizeProductPicture ($_FILES['pic_02']['tmp_name'], $__CFG['product_pictures_path'].$product_form[product_id]."_02_02.jpg", 130, 130);
				$this->resizeProductPicture ($_FILES['pic_02']['tmp_name'], $__CFG['product_pictures_path'].$product_form[product_id]."_03_02.jpg", 445, 445);
				unlink($_FILES['pic_02']['tmp_name']);					
				
			}			
			
			// update obrazka (usunięcie lub aktualizacja - o ile został podany) nr 3
			if ($product_form['remove_picture_03']) {
				// usuwamy obrazek
				$pic_03 = "";
				$sql = "update product set pic_03 = '$pic_03' where id = '$product_form[product_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				unlink($__CFG['product_pictures_path'].$product_form['product_id']."_01_03.jpg");
				unlink($__CFG['product_pictures_path'].$product_form['product_id']."_02_03.jpg");
				unlink($__CFG['product_pictures_path'].$product_form['product_id']."_03_03.jpg");
			}
			elseif ($_FILES['pic_03']['name']) {
				// aktualizujemy obrazek
				$pic_03 = "product_".$product_form['product_id']."_03.jpg";
				$sql = "update product set pic_03 = '$pic_03' where id = '$product_form[product_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeProductPicture ($_FILES['pic_03']['tmp_name'], $__CFG['product_pictures_path'].$product_form[product_id]."_01_03.jpg", 50, 50);
				$this->resizeProductPicture ($_FILES['pic_03']['tmp_name'], $__CFG['product_pictures_path'].$product_form[product_id]."_02_03.jpg", 130, 130);
				$this->resizeProductPicture ($_FILES['pic_03']['tmp_name'], $__CFG['product_pictures_path'].$product_form[product_id]."_03_03.jpg", 445, 445);
				unlink($_FILES['pic_03']['tmp_name']);					
				
			}				
			
			//print_r($product_form);
			// a potem wersja językowa
			$sql = "update product_multilang set category_parent = '$product_form[category_parent]', kind_parent = '$product_form[kind_parent]', title = '$product_form[title]', url_name = '$product_form[url_name]', price = '$product_form[price]', promo_price = '$product_form[promo_price]', weight = '$product_form[weight]', promotion = '$product_form[promotion]', abstract = '$product_form[abstract]', content = '$product_form[content]', content2 = '$product_form[content2]', status = '$product_form[status]', date_modified = '$date_now', symbol = '$product_form[symbol]', level = '$product_form[level]', type_id = '$product_form[type_id]', stock = '$product_form[stock]', bonus = '$product_form[bonus]', value_price = '$product_form[value_price]', compare = '$product_form[compare]', letter = '$product_form[letter]' where product_id = '$product_form[product_id]' and language_id = '$product_form[language_id]'";
			$rv = $this->DBM->modifyTable($sql);
			
		}
		
		// zwracamy ID ostatnio zapisanego artykułu
		if ($product_id) { 
			return $product_id;
		}
		else {
			return $product_form['product_id'];
		}
	}
	
	/**
	 * Przestawia status 
	 */
	
	function setPic1 ($product_id) {
		
		if ($product_id) {
			
			$sql = "update product_multilang set category_parent = '1', kind_parent = '1' where product_id = '$product_id' and language_id = '1' ";
			$this->DBM->modifyTable($sql);
			
		}
	}	
	
	/**
	 * zapisuje powiązanie artykułów z produktem
	 */
	
	function saveProductsForProduct ($product_id, $products) {
		
		if ($product_id && sizeof($products)) {
			
			foreach ($products as $product_id => $value) {
				
				// najpierw sprawdzamy, czy już przypadkiem takiego powiązania nie ma
				$sql = "select * from product_product where product_id = '$product_id' and product_id = '$product_id'";
				$details = $this->DBM->getRow($sql);
				
				// dalej działamy tylko wtedy kiedy nie ma jeszcze takiego powiązania!
				if (!sizeof($details)) {
					$sql = "insert into product_product (product_id, product_id) values ('$product_id', '$product_id')";
					$this->DBM->modifyTable($sql);
				}
			}
		}
	}
	
	/**
	 * usuwa pojedynczy artykuł
	 */
	
	function removeProduct($product_id) {
			
		if ($product_id) {
			// metryka
			$sql = "delete from product where id = $product_id ";
			$rv = $this->DBM->modifyTable($sql);
			// i wszystkie wersje językowe
			$sql = "delete from product_multilang where product_id = $product_id ";
			$rv = $this->DBM->modifyTable($sql);
		}
		return $rv;
	}
	
	/**
	 * usuwa powiązania podanych artykułów z podanym produktem
	 */
	
	function removeProductsFromProduct ($product_id, $products) {
		
		if ($product_id && sizeof($products)) {
			
			foreach ($products as $product_id => $value) {
				
				$sql = "delete from product_product where product_id = '$product_id' and product_id = '$product_id'";
				$this->DBM->modifyTable($sql);
			}
		}
	}
	
	/**
	 * gets n random products from given category
	 */
	
	function getRandomProducts ($category_id, $limit, $lang_id) {
		
		if ($category_id && $limit && $lang_id) {
			$sql = "select product.category_id, product.order, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product.category_id = '$category_id' and product_multilang.language_id = '$lang_id' order by rand() limit $limit";
			$product_list = $this->DBM->getTable($sql);
			
			return $product_list;
		}
		
	}
	
	/**
	 * wyciąga listę artykułów z zazanczonymi artykułami dla danego produktu
	 */
	
	function getProductsForProductAdmin ($product_id, $lang_id) {
		
		if ($product_id && $lang_id) {
			
			$products = $this->getProducts("order", "desc", 1, 2, $lang_id);
			
			return $products;
		}
		
	}
	
	/**
	 * gets all products
	 */
	
	function getProductsAll ($lang_id) {
		
		if ($lang_id) {
			$sql = "select * from product_multilang where language_id = '$lang_id' order by date_modified desc ";
			$product_list = $this->DBM->getTable($sql);
			
			return $product_list;
		}
	}
	
	/**
	 * gets all products - active
	 */
	
	function getProductsActiveAll ($lang_id) {
		
		if ($lang_id) {
			$sql = "select * from product_multilang where language_id = '$lang_id' and status = 2 order by date_modified desc ";
			$product_list = $this->DBM->getTable($sql);
			
			return $product_list;
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
		$paging['count'] = $record_count;
		$paging['page_from'] = $from;
		$paging['page_to'] = $to;
		
		//print_r($paging);
		
		$this->paging = $paging;
		return $paging;
		
	}
	
	/**
	 * wyciąga najnowsze newsy
	 */
	
	function getRecentNews ($category_id, $limit, $lang_id) {
		
		if ($lang_id) {
		
			$sql  = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product.category_id = '$category_id' and product_multilang.language_id = '$lang_id' and product_multilang.status = 2 ";		
			$sql .= " order by product.`order` desc limit $limit ";
			
			// echo $sql;
			
			$product_list = $this->DBM->getTable($sql);
			
			return $product_list;
		}
	}
	
	/**
	 * wyciąga editoriale
	 */
	
	function getEditorials ($category_id, $lang_id) {
		
		if ($lang_id) {
		
			$sql  = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product.category_id = '$category_id' and product_multilang.language_id = '$lang_id' ";		
			$sql .= " order by product.`order` desc";
			
			// echo $sql;
			
			$product_list = $this->DBM->getTable($sql);
			
			return $product_list;
		}
	}
	
	/**
	 * wyciąga pojedynczy editorial wraz z nawigacją
	 */
	
	function getEditorial ($product_id, $lang_id, $user_id = null) {
		
		if ($lang_id) {
			
			// kategoria editoriali
			if ($user_id) {
				$category_id = 4;
			}
			else {
				$category_id = 9;
			}
			
			// jeżeli został podany konkretny editorial
			if ($product_id) {
				
				$sql = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product.id = '$product_id' and product_multilang.language_id = '$lang_id' and product_multilang.status != 0";
				$product_details = $this->DBM->getRow($sql);
				
				if (sizeof($product_details)) {
					
					// wybieramy nastepny (nowszy)
					
					$sql = "select product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product.`order` > '$product_details[order]' and product.category_id = '$category_id' and product_multilang.language_id = '$lang_id' and product_multilang.status != 0 order by product.`order` asc limit 1";
					$next_product = $this->DBM->getRow($sql);
					
					if (sizeof($next_product)) {
						$product_details['next_product'] = $next_product['product_id'];
					}
					
					// wybieramy poprzedni (starszy) 
					
					$sql = "select product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product.`order` < '$product_details[order]' and product.category_id = '$category_id' and product_multilang.language_id = '$lang_id' and product_multilang.status != 0 order by product.`order` desc limit 1";
					$previous_product = $this->DBM->getRow($sql);
					
					if (sizeof($previous_product)) {
						$product_details['previous_product'] = $previous_product['product_id'];
					}
					
					return $product_details;
				}	
			}
			else {
				// nie podano konkretnego - bierzemy dwa najnowsze - od razu do nawigacji
				
				$sql  = "select product.category_id, product.order, product.pic_01, product.pic_02, product.pic_03, product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product.category_id = '$category_id' and product_multilang.language_id = '$lang_id' and product_multilang.status != 0 ";
				$sql .= " order by product.`order` desc limit 2";
				$details = $this->DBM->getTable($sql);
				
				// echo $sql;
				
				// szczegóły bieżącego
				$product_details = $details[0];
				
				// nowszego (następnego) nie ma !
				// ...
				
				// a to jest starszy
				if (sizeof($details[1])) {
					// poprzedni editorial ( = starszy!)
					$product_details['previous_product'] = $details[1]['product_id'];
				}
				
				return $product_details;
			}
		}
	}
	
	/**
	 * pobiera pojedynczy artykuł jako treść helpa
	 */
	
	function getHelp($product_id, $lang_id) {
			
		if ($product_id && $lang_id) {	
			$sql = "select product_multilang.* from product, product_multilang where product_multilang.product_id = product.id and product.id = '$product_id' and product_multilang.language_id = '$lang_id'";
			$product_details = $this->DBM->getRow($sql);
			
			return $product_details['content'];	
		}
	}
	
	/**
	 * wysyła artykuł mailem (HTML)
	 */
	
	function sendProductByEmail ($product_details, $email) {
		
		global $_mail_params;
		global $dict_templates;
		global $__CFG;
		global $smarty;
		
		if (sizeof($product_details) && $email) {
			
			$content = $smarty->fetch("send_product.tpl");
				
			$mail_data['html_body'] = $content;
			
			$mail_data['headers']['MIME-Version']= '1.0';
			$mail_data['headers']['Subject'] = $dict_templates['SendProductSubject'];
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
	
	function createFileFromProduct ($product_id, $path, $lang_id) {
		
		global $__CFG;
		
		if ($product_id && $path && $lang_id) {
			
			// szczegóły artykułu
			$sql = "select title, content from product_multilang where product_id = '$product_id' and language_id = '$lang_id'";
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
	
	/**
	 * przeskalowuje importowane zdjęcie w miejscu - z resamplingiem
	 */
	
	function resizeProductPicture2 ($source_path, $target_path, $xmin, $ymin) {
		
		global $__CFG;
		
		if ($source_path && $target_path && $xmin && $ymin) {
			
			// tylko jeden format zdj�� jest dozwolony
			
			// $details = getimagesize($__CFG['gallery_pictures_path'].$filename);
			$details = getimagesize($source_path);
			
			if ($details['mime'] == "image/jpeg") {
			

				
				// Get new dimensions 
				// list($width_orig, $height_orig) = getimagesize($__CFG['gallery_pictures_path'].$filename);
				list($width_orig, $height_orig) = getimagesize($source_path);
				
				// Set a maximum height and width
				$width = $width_orig;
				$height = $height_orig;				
				
				// Resample
				$image_p = imagecreatetruecolor($width, $height);
				
				$image = imagecreatefromjpeg($source_path);
				
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
				
				imagejpeg($image_p, $target_path, 100);
				
			}
			
		}
		else {
			return false;
		}
	}
	
	/**
	 * przeskalowuje importowane zdjęcie w miejscu - z resamplingiem
	 */
	
	function resizeProductPicture ($source_path, $target_path, $xmin, $ymin) {
		
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