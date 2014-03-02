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

class Blog {

	/**
	 * @var object DBManager
	 */
	var $DBM;

	function Blog() {
		global $DBM;
	 	$this->DBM = $DBM;
	}
	
	/**
	 * pobiera listę artykułów (posortowaną)
	 */
	
	function getBlogs($order = "order", $direction = "desc", $page_number = 1, $lang_id) {
		
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		$sql  = "select count(*) as ilosc from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog_multilang.language_id = '$lang_id'";
				
		$temp = $this->DBM->getRow($sql);
		$record_count = $temp['ilosc'];
		
		$sql  = "select blog.category_id, blog.order, blog.pic_01, blog_multilang.* from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog_multilang.language_id = '$lang_id' ";		
		$sql .= " order by blog.`$order` $direction limit $offset, $limit ";
		
		// echo $sql."<hr>";
		
		$blog_list_temp = $this->DBM->getTable($sql);
		
		// reindex array
		if (sizeof($blog_list_temp)) {
			$blog_list = array();
			foreach ($blog_list_temp as $blog_details) {
				$blog_list[$blog_details[blog_id]] = $blog_details;
			}
		}
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParameters($record_count, $page_number);
		}
		
		return $blog_list;
	}
	
	/**
	 * pobiera listę artykułów (posortowaną)
	 */
	
	function getBlogsByWtz($order = "order", $direction = "desc", $page_number = 1, $category_id = 1, $lang_id, $wtz) {
		
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		if (!$category_id) $category_id = 1;
		
		$sql  = "select count(*) as ilosc from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog_multilang.language_id = '$lang_id' and blog_multilang.author_id = '$wtz' ";
				
		$temp = $this->DBM->getRow($sql);
		$record_count = $temp['ilosc'];
		
		$sql  = "select blog.category_id, blog.order, blog.pic_01, blog_multilang.* from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog_multilang.language_id = '$lang_id' and blog_multilang.author_id = '$wtz'  ";		
		$sql .= " order by blog.`$order` $direction limit $offset, $limit ";
		
		// echo $sql."<hr>";
		
		$blog_list_temp = $this->DBM->getTable($sql);
		
		// reindex array
		if (sizeof($blog_list_temp)) {
			$blog_list = array();
			foreach ($blog_list_temp as $blog_details) {
				$blog_list[$blog_details[blog_id]] = $blog_details;
			}
		}
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParameters($record_count, $page_number);
		}
		
		return $blog_list;
	}
	
	/**
	 * Przestawia status 
	 */
	
	function setStatus ($blog_id, $status) {
		
		if ($blog_id) {
			
			$sql = "update blog_multilang set status = '$status' where blog_multilang.blog_id = '$blog_id' ";
			$this->DBM->modifyTable($sql);
			
		}
	}	
		
	/**
	 * pobiera przefiltrowaną listę artykułów
	 */
	
	function getBlogsSearch($order = "order", $direction = "desc", $search_form = null, $page_number = 1, $lang_id) {
		
		
			// ustawienie numeru strony do stronicowania (jezeli nie została podana)
			if (!sizeof($_REQUEST['page_number'])) {
				$_REQUEST['page_number'] = 1;
			}		
		
		$page_number = $_REQUEST['page_number'];
		
		
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		$sql  = "select blog.category_id, blog.order, blog.pic_01, blog_multilang.* from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog_multilang.language_id = '$lang_id' ";		
		$sql_count  = "select count(*) as ilosc from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog_multilang.language_id = '$lang_id' ";
				
		if(sizeof($search_form)) {
			
			if ($search_form['title']) {
				$sql .= " AND lower(blog_multilang.title) like lower('%".$search_form['title']."%') ";
				$sql_count .= " AND lower(blog_multilang.title) like lower('%".$search_form['title']."%') ";
			}
			if ($search_form['abstract']) {
				$sql .= " AND lower(blog_multilang.abstract) like lower('%".$search_form['abstract']."%') ";
				$sql_count .= " AND lower(blog_multilang.abstract) like lower('%".$search_form['abstract']."%') ";
			}
			if ($search_form['content']) {
				$sql .= " AND lower(blog_multilang.content) like lower('%".$search_form['content']."%') ";
				$sql_count .= " AND lower(blog_multilang.content) like lower('%".$search_form['content']."%') ";
			}
			if ($search_form['status']) {
				$sql .= " AND blog_multilang.status = ".$search_form['status']." ";
				$sql_count .= " AND blog_multilang.status = ".$search_form['status']." ";
			}
			if ($search_form['date_created_from'] && $search_form['date_created_to']) {
				$sql .= " AND blog_multilang.date_created between '".$search_form['date_created_from']."' and '".$search_form['date_created_to']."' ";
				$sql_count .= " AND blog_multilang.date_created between '".$search_form['date_created_from']."' and '".$search_form['date_created_to']."' ";
			}
			if ($search_form['date_modified_from'] && $search_form['date_modified_to']) {
				$sql .= " AND blog_multilang.date_modified between '".$search_form['date_modified_from']."' and '".$search_form['date_modified_to']."' ";
				$sql_count .= " AND blog_multilang.date_modified between '".$search_form['date_modified_from']."' and '".$search_form['date_modified_to']."' ";
			}
		}
		
		$sql .= " order by blog.`$order` $direction ";
		$sql .= " limit $offset, $limit ";
		
		// echo $sql;
		
		// ilośc wszystkich rekordów
		$temp = $this->DBM->getRow($sql_count);
		$record_count = $temp['ilosc'];
		
		// echo $record_count."<br>";
		
		$blog_list_temp = $this->DBM->getTable($sql);
		
		// reindex array
		if (sizeof($blog_list_temp)) {
			$blog_list = array();
			foreach ($blog_list_temp as $blog_details) {
				$blog_list[$blog_details[blog_id]] = $blog_details;
			}
		}
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParametersNew($record_count, $page_number);
		}
		
		return $blog_list;
	}
		
	/**
	 * pobiera przefiltrowaną listę artykułów powiązanych z podanym produktem
	 * wraz z listą wszystkich dostępnych artykułów (dla celów administracyjnych)
	 */
	
	function getBlogsForProduct($product_id, $order = "order", $direction = "desc", $search_form = null, $page_number = 1, $lang_id) {
		
		global $__CFG;
		
		if ($product_id) {
			
			// najpierw wybieramy normalną listę artykułów - przefiltrowaną wg. wskazanych filtrów
			$blog_list = $this->getBlogsSearch($order, $direction, $search_form, $page_number, $lang_id);
			
			// następnie wybieramy listę artykułów powiązanych z podanym produktem
			$sql = "select * from product_blog where product_id = '$product_id'";
			$blogs_temp = $this->DBM->getTable($sql);
			
			// przelatujemy tą tablicę zazanczając na liscie wssystkich artykułów te, które są powiązane
			if (sizeof($blogs_temp)) {
				foreach ($blogs_temp as $details) {
					if ($blog_list[$details['blog_id']]) {
						$blog_list[$details['blog_id']]['selected'] = 1;
					}
				}
			}
			
			return $blog_list;
		}
	}
	
	/**
	 * pobiera artykuły TYLKO powiązane z podanym produktem
	 */
	
	function getBlogsOnlyForProduct ($product_id, $lang_id) {
		
		if ($product_id && $lang_id) {
			
			$sql = "select blog.category_id, blog.order, blog.pic_01, blog_multilang.* from blog, blog_multilang, product_blog where blog_multilang.blog_id = blog.id and product_blog.blog_id = blog.id and blog_multilang.language_id = '$lang_id' and product_blog.product_id = '$product_id' ";
			$blog_list = $this->DBM->getTable($sql);
			
			return $blog_list;
		}
	}
	
	
	/**
	 * get blogs by category id
	 */
	
	function getBlogsByCategory ($category_id, $lang_id) {
		
		if ($category_id && $lang_id) {
			$search_form['category_id'] = $category_id;
			
			// paging cheating ;-)
			$__CFG['record_count_limit'] = 1;
			
			$blog_list = $this->getBlogsSearch("order", "desc", $search_form, 1, $lang_id, $page_number);
			
			return $blog_list;
		}
	}
	
	/**
	 * wyciaga listę bloga dla widoku serwisu wraz z pagingiem
	 */
	
	function getBlogsByView ($order = "order", $direction = "desc", $limit, $page_number = 1, $lang_id){
		
		if($limit){
			
			
			$direction = "desc";
			$order = "order";

			global $__CFG;
			// TEST!!!
			$__CFG['record_count_limit'] = $limit;
		
			$limit = $__CFG['record_count_limit'];			
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select blog.category_id, blog.order, blog.pic_01, blog_multilang.* from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog_multilang.language_id = '$lang_id' and blog_multilang.status = '2' ";		
			$sql_count  = "select count(*) as ilosc from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog_multilang.language_id = '$lang_id' and blog_multilang.status = '2' ";
			
			$sql .= " order by blog.`$order` $direction limit $offset, $limit ";
			
			
			// echo $sql;
			
			// ilośc wszystkich rekordów
			$temp = $this->DBM->getRow($sql_count);
			$record_count = $temp['ilosc'];
			
			//echo $record_count."<br>";
			
			$news_list_temp = $this->DBM->getTable($sql);
			
				//print_r($blog_list_temp);
				if($news_list_temp){
				//print_r($blog_list_temp);
				$news_list = $this->calculateCommentsVolumeForBlog($news_list_temp);
				
			}
			
			if(isset($page_number)) {
				// przeliczamy parametry
				$this->convertPagingParametersNew($record_count, $page_number);
			}
		}
		
		return $news_list;
	}
	
	/**
	 * wyciaga listę bloga dla widoku serwisu wraz z pagingiem
	 */
	
	function getBlogsByCategoryToView ($order = "order", $direction = "desc", $limit, $page_number = 1, $lang_id, $category_id){
		
		if($limit){
			
			
			$direction = "desc";
			$order = "order";

			global $__CFG;
			// TEST!!!
			$__CFG['record_count_limit'] = $limit;
		
			$limit = $__CFG['record_count_limit'];			
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select blog.category_id, blog.order, blog.pic_01, blog_multilang.* from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog_multilang.language_id = '$lang_id' and blog_multilang.author_id = '$category_id' and blog_multilang.status = '2' ";		
			$sql_count  = "select count(*) as ilosc from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog_multilang.language_id = '$lang_id' and blog_multilang.author_id = '$category_id' and blog_multilang.status = '2' ";
			
			$sql .= " order by blog.`$order` $direction limit $offset, $limit ";
			
			
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
	
	function getBlogByUrlNameToView($url_name, $lang_id) {
			
		if ($url_name && $lang_id) {	
			$sql = "select blog.category_id, blog.order, blog.pic_01, blog.pic_02, blog.pic_03, blog_multilang.* from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog_multilang.url_name = '$url_name' and blog_multilang.language_id = '$lang_id'";
			$rv = $this->DBM->getRow($sql);
			
		}
		return $rv;
	}
	
	/**
	 * Liczba komentarzy dla danego wpisu
	 */
	
	function calculateCommentsVolumeForBlog($blog_list) {
		
		if (sizeof($blog_list)) {
			
			// dla każdego użytkownika sprawdzamy ilośc jego znajomych
			foreach ($blog_list as $key => $blog_details) {
				
				//print_r($blog_details);
				
				$sql = "select count(*) as ilosc from comment_blog where blog_id = '$blog_details[blog_id]' ";
				$details = $this->DBM->getRow($sql);

				$blog_list[$key]['comments_volume'] = $details['ilosc'];
			}
		}
		
		return $blog_list;	
	}
	
	/**
	 * wyciaga listę bloga dla widoku serwisu wraz z pagingiem
	 */
	
	function getBlogsByHome ($order = "order", $direction = "desc", $limit, $page_number = 1, $lang_id){
		
		if($limit){
			
			
			$direction = "desc";
			$order = "order";

			global $__CFG;
			// TEST!!!
			$__CFG['record_count_limit'] = $limit;
		
			$limit = $__CFG['record_count_limit'];			
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select blog.category_id, blog.order, blog.pic_01, blog_multilang.* from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog_multilang.language_id = '$lang_id' and blog.category_id = '1' and blog_multilang.status = '2' ";		
			$sql_count  = "select count(*) as ilosc from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog_multilang.language_id = '$lang_id' and blog.category_id = '1' and blog_multilang.status = '2' ";
			
			$sql .= " order by blog.`$order` $direction limit $offset, $limit ";
			
			
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
	 * wyciaga listę bloga dla rss
	 */
	
	function getBlogsByRss ($order = "order", $direction = "desc", $limit, $page_number = 1, $lang_id){
		
		if($limit){
			
			
			$direction = "desc";
			$order = "order";

			global $__CFG;
			// TEST!!!
			$__CFG['record_count_limit'] = $limit;
		
			$limit = $__CFG['record_count_limit'];			
			$offset = ($page_number - 1) * $limit;
			
			
			$sql  = "select blog.category_id, blog.order, blog.pic_01, blog_multilang.* from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog_multilang.language_id = '$lang_id' and blog.category_id = '1' and blog_multilang.status = '2' ";		
			$sql_count  = "select count(*) as ilosc from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog_multilang.language_id = '$lang_id' and blog.category_id = '1' and blog_multilang.status = '2' ";
			
			$sql .= " order by blog.`$order` $direction limit $offset, $limit ";
			
			
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
	
	function getBlog($blog_id, $lang_id) {
			
		if ($blog_id && $lang_id) {	
			$sql = "select blog.category_id, blog.order, blog.pic_01, blog.pic_02, blog.pic_03, blog_multilang.* from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog.id = '$blog_id' and blog_multilang.language_id = '$lang_id'";
			$rv = $this->DBM->getRow($sql);
			
		}
		return $rv;
	}
	
	/**
	 * wyciąga pierwszy artykuł z podanej kategorii (tylko id)
	 */
	
	function getFirstBlogInCategory ($category_id, $lang_id) {
		
		if ($category_id) {
			
			$sql = "select blog.id from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog.category_id = '$category_id' and blog_multilang.language_id = '$lang_id' and blog_multilang.status != 0 order by blog.`order` desc limit 1";
			$details = $this->DBM->getRow($sql);
			
			return $details['id'];
		}
	}
	
	/**
	 * pobiera pojedynczy artykuł do widoku szczegółów
	 */
	
	function getBlogDetails($blog_id, $lang_id) {
		
		if ($blog_id && $lang_id) {
			$sql = "select blog.category_id, blog.order, blog.pic_01, blog.pic_02, blog.pic_03, blog_multilang.* from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog.id = '$blog_id' and blog_multilang.language_id = '$lang_id'";
			$rv = $this->DBM->getRow($sql);
		}
		return $rv;
	}
	
	/**
	 * sprawdza czy dany blog istnieje o tej samej nazwie url /uzywane do walidacji - dla istniejaqcego wpisu/
	 */
	
	function getBlogByUrlNameAndId($url_name, $blog_id) {
			
		if ($url_name && $blog_id) {	
			//print_r($product_id);
			$sql = "select blog_multilang.* from blog_multilang where blog_multilang.url_name = '$url_name' and blog_multilang.blog_id != '$blog_id'";
			$rv = $this->DBM->getRow($sql);
			//echo $sql;
			
		}
		return $rv;
	}
	
	/**
	 * sprawdza czy dany wpis bloga istnieje o tej samej nazwie url /uzywane do walidacji - dla nowgo wpisu/
	 */
	
	function getBlogByUrlName($url_name) {
			
		if ($url_name) {	
			$sql = "select blog_multilang.* from blog_multilang where blog_multilang.url_name = '$url_name' ";
			$rv = $this->DBM->getRow($sql);
			
		}
		return $rv;
	}
	
	/**
	 * zapisuje pojedynczy artykuł
	 */
	
	function saveBlog($blog_form) {
		
		global $__CFG;
		
		// data bieżąca 
		$date_now = date("Y-m-d H:i:s", time());
		
		if (!$blog_form['blog_id']) {
			
			// kolejność - to jest do przeniesienia do nowej klasy Order (?) albo osobna metoda w tej klasie (?)
			$sql = "select max(`order`) as last_order from blog where category_id = '$blog_form[category_id]'";
			$order = $this->DBM->getRow($sql);
			$next_order = $order['last_order'] + 1;
			
			// nowa metryka
			$sql = "insert into blog (category_id, `order`) values ('$blog_form[category_id]', '$next_order') ";
			$rv = $this->DBM->modifyTable($sql);
			$blog_id = $this->DBM->lastInsertID;
			
			// dodaj obrazek nr 1
			if ($_FILES['pic_01']['name']) {
				$pic_01 = "blog_".$blog_id."_01.jpg";
				$sql = "update blog set pic_01 = '$pic_01' where id = '$blog_id'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeBlogPicture ($_FILES['pic_01']['tmp_name'], $__CFG['blog_pictures_path'].$blog_id."_01_01.jpg", 50, 50);
				$this->resizeBlogPicture ($_FILES['pic_01']['tmp_name'], $__CFG['blog_pictures_path'].$blog_id."_02_01.jpg", 130, 130);
				$this->resizeBlogPicture ($_FILES['pic_01']['tmp_name'], $__CFG['blog_pictures_path'].$blog_id."_03_01.jpg", 190, 190);
				$this->resizeBlogPicture ($_FILES['pic_01']['tmp_name'], $__CFG['blog_pictures_path'].$blog_id."_04_01.jpg", 500, 500);
				unlink($_FILES['pic_01']['tmp_name']);				
				

			}
			
			// dodaj obrazek nr 2
			if ($_FILES['pic_02']['name']) {
				$pic_02 = "blog_".$blog_id."_02.jpg";
				$sql = "update blog set pic_02 = '$pic_02' where id = '$blog_id'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeBlogPicture ($_FILES['pic_02']['tmp_name'], $__CFG['blog_pictures_path'].$blog_id."_01_02.jpg", 50, 50);
				$this->resizeBlogPicture ($_FILES['pic_02']['tmp_name'], $__CFG['blog_pictures_path'].$blog_id."_03_02.jpg", 190, 190);
				$this->resizeBlogPicture ($_FILES['pic_02']['tmp_name'], $__CFG['blog_pictures_path'].$blog_id."_04_02.jpg", 500, 500);
				unlink($_FILES['pic_02']['tmp_name']);				
				

			}
			
					
			// dodaj obrazek nr 3
			if ($_FILES['pic_03']['name']) {
				$pic_03 = "blog_".$blog_id."_03.jpg";
				$sql = "update blog set pic_03 = '$pic_03' where id = '$blog_id'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeBlogPicture ($_FILES['pic_03']['tmp_name'], $__CFG['blog_pictures_path'].$blog_id."_01_03.jpg", 50, 50);
				$this->resizeBlogPicture ($_FILES['pic_03']['tmp_name'], $__CFG['blog_pictures_path'].$blog_id."_03_03.jpg", 190, 190);
				$this->resizeBlogPicture ($_FILES['pic_03']['tmp_name'], $__CFG['blog_pictures_path'].$blog_id."_04_03.jpg", 500, 500);
				unlink($_FILES['pic_03']['tmp_name']);				
				

			}
			
			if ($blog_id) {
				
				$sql  = "insert into blog_multilang (blog_id, url_name, language_id, title, abstract, content, status, date_created, date_modified, author_id) ";
				$sql .= " values ('$blog_id', '$blog_form[url_name]', '$blog_form[language_id]', '$blog_form[title]', '$blog_form[abstract]', '$blog_form[content]', '$blog_form[status]', '$date_now', '$date_now', '$blog_form[author_id]') ";
				$rv = $this->DBM->modifyTable($sql);
				
				// i wszystkie pozostałe wersje językowe (puste)
				$sql = "select * from language";
				$languages_list = $this->DBM->getTable($sql);
				
				if (sizeof($languages_list)) {
					foreach ($languages_list as $language) {
						// bez tego, który już wczesniej zapisaliśmy!
						if ($language['id'] != $blog_form['language_id']) {
							$sql  = "insert into blog_multilang (blog_id, language_id, status, date_created, date_modified, title) ";
							$sql .= " values ('$blog_id', '$language[id]', '0', '$date_now', '$date_now', '$blog_form[title]') ";
							$rv = $this->DBM->modifyTable($sql);
						}
					}
				}
			}
		}
		else {
			
			// aktualizacja artykułu
			
			// najpierw metryka artykułu (zmiana conajwyżej kategorii)
			$sql = "update blog set category_id = '$blog_form[category_id]' where id = '$blog_form[blog_id]'";
			$rv = $this->DBM->modifyTable($sql);
			
			// update obrazka (usunięcie lub aktualizacja - o ile został podany) nr 1
			if ($blog_form['remove_picture_01']) {
				// usuwamy obrazek
				$pic_01 = "";
				$sql = "update blog set pic_01 = '$pic_01' where id = '$blog_form[blog_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				unlink($__CFG['blog_pictures_path'].$blog_form['blog_id']."_01_01.jpg");
				unlink($__CFG['blog_pictures_path'].$blog_form['blog_id']."_02_01.jpg");
				unlink($__CFG['blog_pictures_path'].$blog_form['blog_id']."_03_01.jpg");
				unlink($__CFG['blog_pictures_path'].$blog_form['blog_id']."_04_01.jpg");
			}
			elseif ($_FILES['pic_01']['name']) {
				// aktualizujemy obrazek
				$pic_01 = "blog_".$blog_form['blog_id']."_01.jpg";
				$sql = "update blog set pic_01 = '$pic_01' where id = '$blog_form[blog_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				
				// pierwsza miniatura
				$this->resizeBlogPicture ($_FILES['pic_01']['tmp_name'], $__CFG['blog_pictures_path'].$blog_form[blog_id]."_01_01.jpg", 50, 50);
				$this->resizeBlogPicture ($_FILES['pic_01']['tmp_name'], $__CFG['blog_pictures_path'].$blog_form[blog_id]."_02_01.jpg", 130, 130);
				$this->resizeBlogPicture ($_FILES['pic_01']['tmp_name'], $__CFG['blog_pictures_path'].$blog_form[blog_id]."_03_01.jpg", 190, 190);
				$this->resizeBlogPicture ($_FILES['pic_01']['tmp_name'], $__CFG['blog_pictures_path'].$blog_form[blog_id]."_04_01.jpg", 500, 500);
				unlink($_FILES['pic_01']['tmp_name']);					
				
			}
			
			
			// update obrazka (usunięcie lub aktualizacja - o ile został podany) nr 2
			if ($blog_form['remove_picture_02']) {
				// usuwamy obrazek
				$pic_02 = "";
				$sql = "update blog set pic_02 = '$pic_02' where id = '$blog_form[blog_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				unlink($__CFG['blog_pictures_path'].$blog_form['blog_id']."_01_02.jpg");
				unlink($__CFG['blog_pictures_path'].$blog_form['blog_id']."_03_02.jpg");
				unlink($__CFG['blog_pictures_path'].$blog_form['blog_id']."_04_02.jpg");
			}
			elseif ($_FILES['pic_02']['name']) {
				// aktualizujemy obrazek
				$pic_02 = "blog_".$blog_form['blog_id']."_02.jpg";
				$sql = "update blog set pic_02 = '$pic_02' where id = '$blog_form[blog_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeBlogPicture ($_FILES['pic_02']['tmp_name'], $__CFG['blog_pictures_path'].$blog_form[blog_id]."_01_02.jpg", 50, 50);
				$this->resizeBlogPicture ($_FILES['pic_02']['tmp_name'], $__CFG['blog_pictures_path'].$blog_form[blog_id]."_03_02.jpg", 190, 190);
				$this->resizeBlogPicture ($_FILES['pic_02']['tmp_name'], $__CFG['blog_pictures_path'].$blog_form[blog_id]."_04_02.jpg", 500, 500);
				unlink($_FILES['pic_02']['tmp_name']);					
				
			}			
			
			// update obrazka (usunięcie lub aktualizacja - o ile został podany) nr 3
			if ($blog_form['remove_picture_03']) {
				// usuwamy obrazek
				$pic_03 = "";
				$sql = "update blog set pic_03 = '$pic_03' where id = '$blog_form[blog_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				unlink($__CFG['blog_pictures_path'].$blog_form['blog_id']."_01_03.jpg");
				unlink($__CFG['blog_pictures_path'].$blog_form['blog_id']."_03_03.jpg");
				unlink($__CFG['blog_pictures_path'].$blog_form['blog_id']."_04_03.jpg");
			}
			elseif ($_FILES['pic_03']['name']) {
				// aktualizujemy obrazek
				$pic_03 = "blog_".$blog_form['blog_id']."_03.jpg";
				$sql = "update blog set pic_03 = '$pic_03' where id = '$blog_form[blog_id]'";
				$rv = $this->DBM->modifyTable($sql);
				
				// pierwsza miniatura
				$this->resizeBlogPicture ($_FILES['pic_03']['tmp_name'], $__CFG['blog_pictures_path'].$blog_form[blog_id]."_01_03.jpg", 50, 50);
				$this->resizeBlogPicture ($_FILES['pic_03']['tmp_name'], $__CFG['blog_pictures_path'].$blog_form[blog_id]."_03_03.jpg", 190, 190);
				$this->resizeBlogPicture ($_FILES['pic_03']['tmp_name'], $__CFG['blog_pictures_path'].$blog_form[blog_id]."_04_03.jpg", 500, 500);
				unlink($_FILES['pic_03']['tmp_name']);					
				
			}				
			
			// a potem wersja językowa
			$sql = "update blog_multilang set title = '$blog_form[title]', url_name = '$blog_form[url_name]', abstract = '$blog_form[abstract]', content = '$blog_form[content]', status = '$blog_form[status]', date_modified = '$date_now', author_id = '$blog_form[author_id]' where blog_id = '$blog_form[blog_id]' and language_id = '$blog_form[language_id]'";
			$rv = $this->DBM->modifyTable($sql);
			
		}
		
		// zwracamy ID ostatnio zapisanego artykułu
		if ($blog_id) { 
			return $blog_id;
		}
		else {
			return $blog_form['blog_id'];
		}
	}
	
	/**
	 * zapisuje powiązanie artykułów z produktem
	 */
	
	function saveBlogsForProduct ($product_id, $blogs) {
		
		if ($product_id && sizeof($blogs)) {
			
			foreach ($blogs as $blog_id => $value) {
				
				// najpierw sprawdzamy, czy już przypadkiem takiego powiązania nie ma
				$sql = "select * from product_blog where product_id = '$product_id' and blog_id = '$blog_id'";
				$details = $this->DBM->getRow($sql);
				
				// dalej działamy tylko wtedy kiedy nie ma jeszcze takiego powiązania!
				if (!sizeof($details)) {
					$sql = "insert into product_blog (product_id, blog_id) values ('$product_id', '$blog_id')";
					$this->DBM->modifyTable($sql);
				}
			}
		}
	}
	
	/**
	 * zapisuje komentarz do blog
	 */
	
	function saveCommentBlog($comment_form) {
		
		global $__CFG;
		
		// data bieżąca 
		$date_now = date("Y-m-d H:i:s", time());
		
		if ($comment_form['content']) {
			
			$content = strip_tags($comment_form['content']);
			$name= strip_tags($comment_form['name']);
			
			// nowa metryka
			$sql = "insert into comment_blog ( user_id, blog_id, date_created, content, remote_ip ) values ('$name', '$comment_form[blog_id]', '$date_now', '$content', '$_SERVER[REMOTE_ADDR]' ) ";
			$rv = $this->DBM->modifyTable($sql);
		}
		
	}
	
	/**
	 * usuwa pojedynczy artykuł
	 */
	
	function removeBlog($blog_id) {
			
		if ($blog_id) {
			// metryka
			$sql = "delete from blog where id = $blog_id ";
			$rv = $this->DBM->modifyTable($sql);
			// i wszystkie wersje językowe
			$sql = "delete from blog_multilang where blog_id = $blog_id ";
			$rv = $this->DBM->modifyTable($sql);
		}
		return $rv;
	}
	
	/**
	 * usuwa powiązania podanych artykułów z podanym produktem
	 */
	
	function removeBlogsFromProduct ($product_id, $blogs) {
		
		if ($product_id && sizeof($blogs)) {
			
			foreach ($blogs as $blog_id => $value) {
				
				$sql = "delete from product_blog where product_id = '$product_id' and blog_id = '$blog_id'";
				$this->DBM->modifyTable($sql);
			}
		}
	}
	
	/**
	 * gets n random blogs from given category
	 */
	
	function getRandomBlogs ($category_id, $limit, $lang_id) {
		
		if ($category_id && $limit && $lang_id) {
			$sql = "select blog.category_id, blog.order, blog_multilang.* from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog.category_id = '$category_id' and blog_multilang.language_id = '$lang_id' order by rand() limit $limit";
			$blog_list = $this->DBM->getTable($sql);
			
			return $blog_list;
		}
		
	}
	
	/**
	 * wyciąga listę artykułów z zazanczonymi artykułami dla danego produktu
	 */
	
	function getBlogsForProductAdmin ($product_id, $lang_id) {
		
		if ($product_id && $lang_id) {
			
			$blogs = $this->getBlogs("order", "desc", 1, 2, $lang_id);
			
			return $blogs;
		}
		
	}
	
	/**
	 * gets all blogs
	 */
	
	function getBlogsAll ($lang_id) {
		
		if ($lang_id) {
			$sql = "select * from blog_multilang where language_id = '$lang_id' order by date_modified desc ";
			$blog_list = $this->DBM->getTable($sql);
			
			return $blog_list;
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
		
		$paging_blog = array();
		$last_page = ceil($record_count / $limit);
		
		// echo "last page : ".$last_page."<br>";
		$paging_blog['count'] = $last_page;
		// poprzednia strona
		if ($page_number == 1) {
			$paging_blog['previous'] = "";
			$paging_blog['first'] = "";
		}
		else {
			$paging_blog['previous'] = $page_number - 1;
			$paging_blog['first'] = "1";
		}
		
		// następna strona
		if ($page_number == $last_page) {
			$paging_blog['next'] = "";
			$paging_blog['last'] = "";	
		}
		else {
			$paging_blog['next'] = $page_number + 1;
			$paging_blog['last'] = $last_page;
		}
		
		$paging_blog['current'] = $page_number;
		
		
		$this->paging_blog = $paging_blog;
		return $paging_blog;
		
	}
	
	/**
	 * wyciąga najnowsze newsy
	 */
	
	function getRecentNews ($category_id, $limit, $lang_id) {
		
		if ($lang_id) {
		
			$sql  = "select blog.category_id, blog.order, blog.pic_01, blog_multilang.* from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog.category_id = '$category_id' and blog_multilang.language_id = '$lang_id' and blog_multilang.status = 2 ";		
			$sql .= " order by blog.`order` desc limit $limit ";
			
			// echo $sql;
			
			$blog_list = $this->DBM->getTable($sql);
			
			return $blog_list;
		}
	}
	
	/**
	 * pobiera listę komentarzy do blog	
	 */
	
	function getCommentsByBlogs($blog_id, $limit_count, $page_number = 1, $order = "order", $direction = "desc") {
		
		global $__CFG;

		$limit = $limit_count;
		$offset = ($page_number - 1) * $limit;
		
		$sql  = "select count(*) as ilosc from comment_blog, blog where blog.id = comment_blog.blog_id and blog.id = '$blog_id' ";
				
		$temp = $this->DBM->getRow($sql);
		$record_count = $temp['ilosc'];
		
		$sql  = "select comment_blog.* from comment_blog, blog where blog.id = comment_blog.blog_id and blog.id = '$blog_id' ";		
		$sql .= " order by comment_blog.date_created desc limit $offset, $limit ";
		
		//echo $sql."<hr>";
		
		$comment_list = $this->DBM->getTable($sql);
		

		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParameters2($record_count, $page_number, $limit);
		}
		
		return $comment_list;
	}
	
	/**
	 * pobiera listę komentarzy do blog	/administracja/
	 */
	
	function getCommentsByBlogsForAdmin($blog_id, $limit_count, $page_number = 1, $order = "order", $direction = "desc") {
		
		global $__CFG;

		$limit = $limit_count;
		$offset = ($page_number - 1) * $limit;
		
		$sql  = "select count(*) as ilosc from comment_blog, blog where blog.id = comment_blog.blog_id and blog.id = '$blog_id' ";
				
		$temp = $this->DBM->getRow($sql);
		$record_count = $temp['ilosc'];
		
		$sql  = "select comment_blog.* from comment_blog, blog where  blog.id = comment_blog.blog_id and blog.id = '$blog_id' ";		
		$sql .= " order by comment_blog.date_created desc limit $offset, $limit ";
		
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
	
	function removeCommentForBlog ($comment_id) {
		
		if ($comment_id) {
			

				
			$sql = "delete from comment_blog where id = '$comment_id' ";
			$this->DBM->modifyTable($sql);

		}
	}
	
	/**
	 * wyciąga editoriale
	 */
	
	function getEditorials ($category_id, $lang_id) {
		
		if ($lang_id) {
		
			$sql  = "select blog.category_id, blog.order, blog.pic_01, blog_multilang.* from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog.category_id = '$category_id' and blog_multilang.language_id = '$lang_id' ";		
			$sql .= " order by blog.`order` desc";
			
			// echo $sql;
			
			$blog_list = $this->DBM->getTable($sql);
			
			return $blog_list;
		}
	}
	
	/**
	 * wyciąga pojedynczy editorial wraz z nawigacją
	 */
	
	function getEditorial ($blog_id, $lang_id, $user_id = null) {
		
		if ($lang_id) {
			
			// kategoria editoriali
			if ($user_id) {
				$category_id = 4;
			}
			else {
				$category_id = 9;
			}
			
			// jeżeli został podany konkretny editorial
			if ($blog_id) {
				
				$sql = "select blog.category_id, blog.order, blog.pic_01, blog_multilang.* from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog.id = '$blog_id' and blog_multilang.language_id = '$lang_id' and blog_multilang.status != 0";
				$blog_details = $this->DBM->getRow($sql);
				
				if (sizeof($blog_details)) {
					
					// wybieramy nastepny (nowszy)
					
					$sql = "select blog_multilang.* from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog.`order` > '$blog_details[order]' and blog.category_id = '$category_id' and blog_multilang.language_id = '$lang_id' and blog_multilang.status != 0 order by blog.`order` asc limit 1";
					$next_blog = $this->DBM->getRow($sql);
					
					if (sizeof($next_blog)) {
						$blog_details['next_blog'] = $next_blog['blog_id'];
					}
					
					// wybieramy poprzedni (starszy) 
					
					$sql = "select blog_multilang.* from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog.`order` < '$blog_details[order]' and blog.category_id = '$category_id' and blog_multilang.language_id = '$lang_id' and blog_multilang.status != 0 order by blog.`order` desc limit 1";
					$previous_blog = $this->DBM->getRow($sql);
					
					if (sizeof($previous_blog)) {
						$blog_details['previous_blog'] = $previous_blog['blog_id'];
					}
					
					return $blog_details;
				}	
			}
			else {
				// nie podano konkretnego - bierzemy dwa najnowsze - od razu do nawigacji
				
				$sql  = "select blog.category_id, blog.order, blog.pic_01, blog_multilang.* from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog.category_id = '$category_id' and blog_multilang.language_id = '$lang_id' and blog_multilang.status != 0 ";
				$sql .= " order by blog.`order` desc limit 2";
				$details = $this->DBM->getTable($sql);
				
				// echo $sql;
				
				// szczegóły bieżącego
				$blog_details = $details[0];
				
				// nowszego (następnego) nie ma !
				// ...
				
				// a to jest starszy
				if (sizeof($details[1])) {
					// poprzedni editorial ( = starszy!)
					$blog_details['previous_blog'] = $details[1]['blog_id'];
				}
				
				return $blog_details;
			}
		}
	}
	
	/**
	 * pobiera pojedynczy artykuł jako treść helpa
	 */
	
	function getHelp($blog_id, $lang_id) {
			
		if ($blog_id && $lang_id) {	
			$sql = "select blog_multilang.* from blog, blog_multilang where blog_multilang.blog_id = blog.id and blog.id = '$blog_id' and blog_multilang.language_id = '$lang_id'";
			$blog_details = $this->DBM->getRow($sql);
			
			return $blog_details['content'];	
		}
	}
	
	/**
	 * wysyła artykuł mailem (HTML)
	 */
	
	function sendBlogByEmail ($blog_details, $email) {
		
		global $_mail_params;
		global $dict_templates;
		global $__CFG;
		global $smarty;
		
		if (sizeof($blog_details) && $email) {
			
			$content = $smarty->fetch("send_blog.tpl");
				
			$mail_data['html_body'] = $content;
			
			$mail_data['headers']['MIME-Version']= '1.0';
			$mail_data['headers']['Subject'] = $dict_templates['SendBlogSubject'];
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
	
	function createFileFromBlog ($blog_id, $path, $lang_id) {
		
		global $__CFG;
		
		if ($blog_id && $path && $lang_id) {
			
			// szczegóły artykułu
			$sql = "select title, content from blog_multilang where blog_id = '$blog_id' and language_id = '$lang_id'";
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
	
	function resizeBlogPicture ($source_path, $target_path, $xmin, $ymin) {
		
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