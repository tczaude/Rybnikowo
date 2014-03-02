<?
require_once 'AbstractActiveRecord.class.php';
require_once 'Utils.class.php';

class Category extends AbstractActiveRecord {
	
	/**
	 * @var object DBManager
	 */
	var $DBM;
	var $breadcrumb;
	var $message;
	var $paging;

	function Category() {
		global $DBM;
	 	$this->DBM = $DBM;
	}
	
	/**
	 * tworzy menu z kategoriami (grupami) produktowymi - rekurencyjnie!
	 * zasada : doklejamy kolejne subgrupy dopty dopóki jakiekolwiek są ;-)
	 */
	
	function createMenuCategories ($parent = 0, $status = 0) {
		
		// sprawdzamy czy mamy jakieś subkategorie dla podanej kategorii
		$sql = "select * from `category` where parent = '$parent' ";
		
		if ($status) {
			
			$sql .= " and status = '$status' ";
		}
		
		if($parent == 0){
			$sql .= " order by `order` asc ";
		}
		else{
			
			$sql .= " order by name asc ";
		}
		
		$groups = $this->DBM->getTable($sql);
		
		if (sizeof($groups)) {
			
			// znalezione subkategorie - dla każdej z nich wywołujemy jeszcze raz metodę
			foreach ($groups as $key => $details) {
				
				$sub = $this->createMenuCategories($details['id']);
				
				if (sizeof($sub)) {
					$groups[$key]['sub'] = $sub;
				}
			} 
			
			// zwracamy wyciągniętą tablicę z kategoriami
			return $groups;
		}
	}	
	
	/**
	 * tworzy menu z kategoriami (grupami) produktowymi - rekurencyjnie!
	 * zasada : doklejamy kolejne subgrupy dopty dopóki jakiekolwiek są ;-)
	 */
	
	function createMenuCategoriesToView ($parent = 0, $status = 0) {
		
		// sprawdzamy czy mamy jakieś subkategorie dla podanej kategorii
		$sql = "select * from `category` where parent = '$parent' ";
		
		if ($status) {
			//print_r($status);
			$sql .= " and status = '$status' ";
		}
		
		$sql .= " order by `order` asc ";
		
		$groups = $this->DBM->getTable($sql);
		
		if (sizeof($groups)) {
			
			// znalezione subkategorie - dla każdej z nich wywołujemy jeszcze raz metodę
			foreach ($groups as $key => $details) {
				$groups[$key]['index'] = $key;
				$status = 1;
				$sub = $this->createMenuCategories($details['id'], $status);
				
				if (sizeof($sub)) {
					$groups[$key]['sub'] = $sub;
				}
			} 
			
			// zwracamy wyciągniętą tablicę z kategoriami
			return $groups;
		}
	}
	
	/**
	 * tworzy menu z kategoriami (grupami) produktowymi - rekurencyjnie!
	 * zasada : doklejamy kolejne subgrupy dopty dopóki jakiekolwiek są ;-)
	 */
	
	function createMenuGraph ($parent = 0, $status = 0) {
		
		// sprawdzamy czy mamy jakieś subkategorie dla podanej kategorii
		$sql = "select * from `category` where parent = '$parent' and type = '2' ";
		
		if ($status) {
			$sql .= " and status = '$status' ";
		}
		
		$sql .= " order by `order` asc ";
		
		$groups = $this->DBM->getTable($sql);
		
		if (sizeof($groups)) {
			
			// znalezione subkategorie - dla każdej z nich wywołujemy jeszcze raz metodę
			foreach ($groups as $key => $details) {
				
				$sub = $this->createMenuCategories($details['id']);
				
				if (sizeof($sub)) {
					$groups[$key]['sub'] = $sub;
				}
			} 
			
			// zwracamy wyciągniętą tablicę z kategoriami
			return $groups;
		}
	}
	
	/**
	 * wyciąga szczegóły podanej kategorii na podstawie url_config
	 */
	
	function getProductCategory ($category_id) {
		
		if ($category_id) {
		
			$sql = "select * from `category` where url_name = '$category_id'";
			$category_details = $this->DBM->getRow($sql);
			
			return $category_details;
		}
	}
	
	/**
	 * wyciąga szczegóły podanej kategorii na podstawie id
	 */
	
	function getProductCategoryById ($category_id) {
		
		if ($category_id) {
		
			$sql = "select * from `category` where id = '$category_id'";
			$category_details = $this->DBM->getRow($sql);
			
			return $category_details;
		}
	}
	
	/**
	 * Przestawia status 
	 */
	
	function setStatus ($category_id, $status) {
		//print_r($status);
		if ($category_id) {
			
			$sql = "update category set status = '$status' where id = '$category_id' ";
			$this->DBM->modifyTable($sql);
			
		}
	}		
	
	/**
	 * zapisuje kategorię produktu
	 */
	
	function saveProductCategory ($category_form) {
		
		global $__CFG;
		
		if (sizeof($category_form)) {
			
			if (!$category_form['id']) {
				
				
				// kolejność - to jest do przeniesienia do nowej klasy Order (?) albo osobna metoda w tej klasie (?)
				$sql = "select max(`order`) as last_order from `category` where type = 1";
				$order = $this->DBM->getRow($sql);
				$next_order = $order['last_order'] + 1;
			
				if($category_form['parent'] == 0 ){
					

					
					//Jeśli nowa kategoria główna - nowa metryka wraz z kolejnoscia
					$sql = "insert into `category` (url_name, parent, name, status, type, `order`) values ('$category_form[url_name]', '$category_form[parent]', '$category_form[name]', '$category_form[status]', '1', '$next_order')";
					
				}
				else{
					
					$sql = "insert into `category` (url_name, parent, name, status, type) values ('$category_form[url_name]', '$category_form[parent]', '$category_form[name]', '$category_form[status]', '0')";
					//echo"dupa";
				}
			
				$this->DBM->modifyTable($sql);
				$category_id = $this->DBM->lastInsertID;
				
				
				// dodaj obrazek nr 1
				if ($_FILES['pic_01']['name']) {
					$pic_01 = "category_".$category_id."_01.jpg";
					$sql = "update category set pic_01 = '$pic_01' where id = '$category_id'";
					$rv = $this->DBM->modifyTable($sql);
					
					// pierwsza miniatura
					$this->resizeCategoryPicture ($_FILES['pic_01']['tmp_name'], $__CFG['category_pictures_path'].$category_id."_01_01.jpg", 70, 70);
					$this->resizeCategoryPicture ($_FILES['pic_01']['tmp_name'], $__CFG['category_pictures_path'].$category_id."_02_01.jpg", 175, 175);
					$this->resizeCategoryPicture ($_FILES['pic_01']['tmp_name'], $__CFG['category_pictures_path'].$category_id."_03_01.jpg", 500, 500);
					unlink($_FILES['pic_01']['tmp_name']);				
					
	
				}				
				
				
		
			
			
			}
			else {
				
				// aktualizacja kategorii
				$sql = "update `category` set url_name = '$category_form[url_name]', parent = '$category_form[parent]', name = '$category_form[name]', status = '$category_form[status]', type = '$category_form[type]' where id = '$category_form[id]'";				
				$this->DBM->modifyTable($sql);
				$category_id = $category_form['id'];
				
				
				// update obrazka (usunięcie lub aktualizacja - o ile został podany) nr 1
				if ($category_form['remove_picture_01']) {

					// usuwamy obrazek
					$pic_01 = "";
					$sql = "update category set pic_01 = '$pic_01' where id = '$category_form[id]'";
					$rv = $this->DBM->modifyTable($sql);
					
					unlink($__CFG['category_pictures_path'].$category_form['id']."_01_01.jpg");
					unlink($__CFG['category_pictures_path'].$category_form['id']."_02_01.jpg");
					unlink($__CFG['category_pictures_path'].$category_form['id']."_03_01.jpg");
				}
				elseif ($_FILES['pic_01']['name']) {
					// aktualizujemy obrazek
					$pic_01 = "category_".$category_form['id']."_01.jpg";
					$sql = "update category set pic_01 = '$pic_01' where id = '$category_form[id]'";
					$rv = $this->DBM->modifyTable($sql);

					
					
					// pierwsza miniatura
					$this->resizeCategoryPicture ($_FILES['pic_01']['tmp_name'], $__CFG['category_pictures_path'].$category_form['id']."_01_01.jpg", 70, 70);
					$this->resizeCategoryPicture ($_FILES['pic_01']['tmp_name'], $__CFG['category_pictures_path'].$category_form['id']."_02_01.jpg", 175, 175);
					$this->resizeCategoryPicture ($_FILES['pic_01']['tmp_name'], $__CFG['category_pictures_path'].$category_form['id']."_03_01.jpg", 500, 500);
					unlink($_FILES['pic_01']['tmp_name']);					
					
				}			
			
			}

			return $category_id;
		}
	}
			
			
function generateBreadcrumbsForCategory ($category_id, $category_form) {
	
	
	if ($category_id && $category_form){
			
			
			$pos_1 = $category_id;
			$sciezka = $category_id;
			
			$pos_2 = $this->getGroup($category_form['parent']);
			if ($pos_2){
				
				$sciezka = $pos_2['id']."_".$category_id;
				$pos_3 = $this->getGroup($pos_2['parent']);
				
				if ($pos_3){
					$sciezka = $pos_3['id']."_".$pos_2['id']."_".$category_id;
					$pos_4 = $this->getGroup($pos_3['parent']);
					
					if ($pos_4){
						$sciezka = $pos_4['id']."_".$pos_3['id']."_".$pos_2['id']."_".$category_id;
					}
				}
			}
			// aktualizacja sciezki
			$sql = "update `category` set sciezka = '$sciezka' where id = '$category_id'";				
			$this->DBM->modifyTable($sql);
			
			
			
			
	}
	return $category_id;
		
}
	
	
	/**
	 * wyciąga listę dostepnych grup produktów
	 */
	
	function getGroups () {
		
		$sql = "select * from `category` ";
		$groups = $this->DBM->getTable($sql);
		
		return $groups;
	}	
	
	/**
	 * wyciąga nazwe kategorii
	 */
	
	function getGroup ($category_id) {
		
		if($category_id){
		
			$sql = "select * from `category` where id = '$category_id' ";
			$group = $this->DBM->getRow($sql);
			//print_r($group);
			return $group;
		}
	}
	
	/**
	 * wyciąga nazwe kategorii wg url+config
	 */
	
	function getGroupByUrlName ($url_name) {
		
		if($url_name){
		
			$sql = "select * from `category` where url_name = '$url_name' ";
			$group = $this->DBM->getRow($sql);
			//print_r($group);
			return $group;
		}
	}
	
	/**
	 * wyciąga listę grup dla podanej kategorii (grupy)
	 */
	
	function getCategoriesByCategory ($category_id) {
		
		if (!$category_id) $category_id = 0;
		
		// if ($category_id) {
			
			// $sql = "select gr.* from `category` gr where gr.parent = '$category_id' order by name asc ";
			$sql = "select * from `category` where parent = '$category_id' and status = 1 order by name asc";
			$categories = $this->DBM->getTable($sql);
			
			/*
			if (sizeof($categories)) {
				
				foreach ($categories as $key => $category) {
					
					$categories[$key]['name'] = ltrim($category['name'], "1");
				}
			}
			*/
			return $categories;
		// }
	}
	
	/**
	 * tworzy �cie�k� okruch�w dla katalogu produkt�w
	 */
	
	function createBreadcrumbForCategory ($group_id) {
		
		if ($group_id) {
			
			// wyci�gamy rodzica
			$sql = "select * from `category` where `id` = '$group_id'";
			$details = $this->DBM->getRow($sql);
			
			// echo $sql."\n";
			
			if (sizeof($details)) {
				if ($details['parent']) {
					// szukamy dalej
					$this->createBreadcrumbForCategory ($details['parent']);
				}
			}
			
			$group['id'] = $group_id;
			$group['name'] = $details['name'];
			$group['url_name'] = $details['url_name'];
			$group['sciezka'] = $details['sciezka'];
			
			$this->breadcrumb[] = $group; 
		}
	}
	
	/**
	 * usuwa kategorię produktu
	 */
	
	function removeProductCategory ($category_id) {
		
		if ($category_id) {
			
			
			// usuwamy samą kategorię
			$sql = "delete from `category` where id = $category_id ";
			$rv = $this->DBM->modifyTable($sql);
			
			// usuwamy podkategorie
			$sql = "delete from `category` where parent = $category_id ";
			$rv = $this->DBM->modifyTable($sql);			
				
			
			
			

		}
		return $rv;
	}
	
	/**
	 * Tworzy listę kategorii dla administracji
	 */
	
	function createCategoriesForAdmin($parent = 0, $status = 0) {
		
		// sprawdzamy czy mamy jakieś subkategorie dla podanej kategorii
		$sql = "select * from `category` where parent = '$parent'";
		
		if ($status) {
			$sql .= " and status = '$status' ";
		}
		
		$sql .= " order by name asc ";
		
		$groups = $this->DBM->getTable($sql);
		
		if (sizeof($groups)) {
			
			// znalezione subkategorie - dla każdej z nich wywołujemy jeszcze raz metodę
			foreach ($groups as $key => $details) {
				
				$sub = $this->createMenuCategories($details['id']);
				
				if (sizeof($sub)) {
					$groups[$key]['sub'] = $sub;
				}
			} 
			
			// zwracamy wyciągniętą tablicę z kategoriami
			return $groups;
		}
	}
	
	/**
	 * Pierwsza aktywna i bez podkategorii dla administracji
	 */
	
	function firstCatergory () {
		
		// sprawdzamy czy są wogóle jakieś kategorie
		$sql = "select * from `category` where parent = 0 and status = 1";
		$groups_temp = $this->DBM->getTable($sql);
		
		if (sizeof($groups_temp)) {
			
			//Jesli sa - reindexujemy ich tablicę
			$groups = array();
			foreach ($groups_temp as $group_details) {
				$groups[$group_details[id]] = $group_details;
			}

			//Sprawdzamy czy kategoria posiada jakies subkategorie
			foreach($groups as $key => $category){
				
				$sql = "select * from `category` where parent = '$category[id]' and status = 1";
				$subcategories_temp = $this->DBM->getTable($sql);
				
				
				if(sizeof($subcategories_temp)){
					//Jesli sa - dopisujemy je do tablicy glownych - a nadrzedna usuwamy
					$subcategories = array();
					foreach ($subcategories_temp as $subcategory_details) {
						$groups[$subcategory_details[id]] = $subcategory_details;
						unset($groups[$subcategory_details['parent']]);
					}						
				}	
			}
			
			$new_groups = array();
			foreach($groups as $group){
				
				$new_groups[] = $group['id'];
				
				
			}

			// zwracamy wyciągniętą tablicę z kategoriami
			//print_r($groups);
			return $new_groups;
		}
	}
	
	/**
	 * przeskalowuje importowane zdj�cie w miejscu - z resamplingiem
	 */
	
	function resizeCategoryPicture ($source_path, $target_path, $xmin, $ymin) {
		
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