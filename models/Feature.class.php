<?

require_once 'Utils.class.php';

class Feature {
	
	/**
	 * @var object DBManager
	 */
	var $DBM;
	
	var $message;
	var $paging;

	function Feature() {
		global $DBM;
	 	$this->DBM = $DBM;
	}
	
	/**
	 * tworzy menu z kategoriami (grupami) produktowymi - rekurencyjnie!
	 * zasada : doklejamy kolejne subgrupy dopty dopóki jakiekolwiek są ;-)
	 */
	
	function createMenuCategories ($parent = 0, $status = 0) {
		
		// sprawdzamy czy mamy jakieś subkategorie dla podanej kategorii
		$sql = "select * from `feature` where 1 = 1 ";
		
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
		
		if($groups){
			
			$feature_list = array();
			foreach($groups as $key => $group){
				
				$sql = "select kind.name, kind.parent from kind where id = '$group[category_id]'";
				$category_details = $this->DBM->getRow($sql);
				$groups[$key]['category_name'] = $category_details['name'];
				
				if($category_details){
					//print_r($category_details);
					$sql = "select kind.name from kind where id = '$category_details[parent]'";
					$parent_details = $this->DBM->getRow($sql);
					$groups[$key]['parent_name'] = $parent_details['name'];
					
					
					
				}
				
				
				
			}
			
		}
		
		
		//print_r($groups);
		return $groups;

	}	
	
	/**
	 * tworzy menu z kategoriami (grupami) produktowymi - rekurencyjnie!
	 * zasada : doklejamy kolejne subgrupy dopty dopóki jakiekolwiek są ;-) - dla zawezania grup wyszukiwania
	 */
	
	function createMenuCategoriesByCategory ($category_id) {
		
		// sprawdzamy czy mamy jakieś subkategorie dla podanej kategorii
		$sql = "select * from `feature` where 1 = 1 ";

		
		if($category_id){
			
			$sql .= "and category_id = '$category_id' ";
			$sql .= " order by `order` asc ";
		}
		else{
			
			$sql .= " order by name asc ";
		}
		
		$groups = $this->DBM->getTable($sql);
		return $groups;

	}
	
	
	/**
	 * uaktualnia automatycznie kolejnosc produktow w kategorii
	 */
	
	function updateOrder($feature_id, $position) {
			
		if ($feature_id && $position) {
			
			$sql = "update feature set `order` = '$position' where id = '$feature_id' ";
			$rv = $this->DBM->modifyTable($sql);
		}
		return $rv;

	}
	
	/**
	 * tworzy menu z kategoriami (grupami) produktowymi - rekurencyjnie!
	 * zasada : doklejamy kolejne subgrupy dopty dopóki jakiekolwiek są ;-)
	 */
	
	function createMenuCategoriesToView ($parent = 0, $status = 0) {
		
		// sprawdzamy czy mamy jakieś subkategorie dla podanej kategorii
		$sql = "select * from `feature` where 1 = 1 ";
		
		if ($status) {
			//print_r($status);
			$sql .= " and status = '$status' ";
		}
		
		$sql .= " order by `order` asc ";
		
		$groups = $this->DBM->getTable($sql);
		return $groups;

	}
	
	/**
	 * tworzy menu z kategoriami (grupami) produktowymi - rekurencyjnie!
	 * zasada : doklejamy kolejne subgrupy dopty dopóki jakiekolwiek są ;-)
	 */
	
	function createMenuCategoriesToViewForCategory ($category_id, $parent = 0, $status = 0) {
		
		// sprawdzamy czy mamy jakieś subkategorie dla podanej kategorii
		$sql = "select * from `feature` where category_id = '$category_id' ";
		
		if ($status) {
			//print_r($status);
			$sql .= " and status = '$status' ";
		}
		
		$sql .= " order by `order` asc ";
		
		$groups = $this->DBM->getTable($sql);
		return $groups;

	}
	
	/**
	 * tworzy menu z kategoriami (grupami) produktowymi - rekurencyjnie!
	 * zasada : doklejamy kolejne subgrupy dopty dopóki jakiekolwiek są ;-)
	 */
	
	function createMenuGraph ($parent = 0, $status = 0) {
		
		// sprawdzamy czy mamy jakieś subkategorie dla podanej kategorii
		$sql = "select * from `feature` where parent = '$parent' and type = '2' ";
		
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
	
	function getProductFeature ($feature_id) {
		
		if ($feature_id) {
		
			$sql = "select * from `feature` where url_name = '$feature_id'";
			$feature_details = $this->DBM->getRow($sql);
			
			return $feature_details;
		}
	}

	
	/**
	 * wyciąga szczegóły podanej kategorii na podstawie id
	 */
	
	function getProductFeatureById ($feature_id) {
		
		if ($feature_id) {
		
			$sql = "select * from `feature` where id = '$feature_id'";
			$feature_details = $this->DBM->getRow($sql);
			
			return $feature_details;
		}
	}
	
	/**
	 * Przestawia status 
	 */
	
	function setStatus ($feature_id, $status) {
		//print_r($status);
		if ($feature_id) {
			
			$sql = "update feature set status = '$status' where id = '$feature_id' ";
			$this->DBM->modifyTable($sql);
			
		}
	}		
	
	/**
	 * zapisuje kategorię produktu
	 */
	
	function saveProductFeature ($feature_form) {
		
		if (sizeof($feature_form)) {
			
			if (!$feature_form['id']) {
				
				
				// kolejność - to jest do przeniesienia do nowej klasy Order (?) albo osobna metoda w tej klasie (?)
				$sql = "select max(`order`) as last_order from `feature` where 1 = 1";
				$order = $this->DBM->getRow($sql);
				$next_order = $order['last_order'] + 1;
			

					

					
				//Jeśli nowa kategoria główna - nowa metryka wraz z kolejnoscia
				$sql = "insert into `feature` (name, category_id, status, `order`, content) values ('$feature_form[name]', '$feature_form[category_id]', '$feature_form[status]', '$next_order', '$feature_form[content]')";

				
			
			
			}
			else {
				
				// aktualizacja kategorii
				$sql = "update `feature` set name = '$feature_form[name]', category_id = '$feature_form[category_id]', status = '$feature_form[status]', content = '$feature_form[content]' where id = '$feature_form[id]'";				
			}
			
			$this->DBM->modifyTable($sql);
			
			if (!$feature_form['id']) {
				$feature_id = $this->DBM->lastInsertID;
			}
			else {
				$feature_id = $feature_form['id'];
			}
			
			return $feature_id;
		}
	}
	
	/**
	 * wyciąga listę dostepnych grup produktów
	 */
	
	function getGroups () {
		
		$sql = "select * from `feature` order by `order` asc ";
		$groups = $this->DBM->getTable($sql);
		
		return $groups;
	}	
	
	/**
	 * wyciąga nazwe kategorii
	 */
	
	function getGroup ($feature_id) {
		
		if($feature_id){
		
			$sql = "select * from `feature` where id = '$feature_id' ";
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
		
			$sql = "select * from `feature` where url_name = '$url_name' ";
			$group = $this->DBM->getRow($sql);
			//print_r($group);
			return $group;
		}
	}
	
	/**
	 * wyciąga listę grup dla podanej kategorii (grupy)
	 */
	
	function getCategoriesByFeature ($feature_id) {
		
		if (!$feature_id) $feature_id = 0;
		
		// if ($feature_id) {
			
			// $sql = "select gr.* from `feature` gr where gr.parent = '$feature_id' order by name asc ";
			$sql = "select gr.* from `feature` gr where gr.parent = '$feature_id' and status = 1 order by name asc";
			$categories = $this->DBM->getTable($sql);
			
			if (sizeof($categories)) {
				
				foreach ($categories as $key => $feature) {
					
					$categories[$key]['name'] = ltrim($feature['name'], "1");
				}
			}
			
			return $categories;
		// }
	}
	
	/**
	 * usuwa kategorię produktu
	 */
	
	function removeProductFeature ($feature_id) {
		
		if ($feature_id) {
			
			
			// usuwamy samą kategorię
			$sql = "delete from `feature` where id = $feature_id ";
			$rv = $this->DBM->modifyTable($sql);
			
			// usuwamy podkategorie
			$sql = "delete from `feature` where parent = $feature_id ";
			$rv = $this->DBM->modifyTable($sql);			
				
			
			
			

		}
		return $rv;
	}
	
	/**
	 * Tworzy listę kategorii dla administracji
	 */
	
	function createCategoriesForAdmin($parent = 0, $status = 0) {
		
		// sprawdzamy czy mamy jakieś subkategorie dla podanej kategorii
		$sql = "select * from `feature` where parent = '$parent'";
		
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
	 * Pierwsza aktywna i bez podkategorii dla administracji
	 */
	
	function firstCatergory () {
		
		// sprawdzamy czy są wogóle jakieś kategorie
		$sql = "select * from `feature` where parent = 0 and status = 1";
		$groups_temp = $this->DBM->getTable($sql);
		
		if (sizeof($groups_temp)) {
			
			//Jesli sa - reindexujemy ich tablicę
			$groups = array();
			foreach ($groups_temp as $group_details) {
				$groups[$group_details[id]] = $group_details;
			}

			//Sprawdzamy czy kategoria posiada jakies subkategorie
			foreach($groups as $key => $feature){
				
				$sql = "select * from `feature` where parent = '$feature[id]' and status = 1";
				$subcategories_temp = $this->DBM->getTable($sql);
				
				
				if(sizeof($subcategories_temp)){
					//Jesli sa - dopisujemy je do tablicy glownych - a nadrzedna usuwamy
					$subcategories = array();
					foreach ($subcategories_temp as $subfeature_details) {
						$groups[$subfeature_details[id]] = $subfeature_details;
						unset($groups[$subfeature_details['parent']]);
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
	
	
	
	
}
?>