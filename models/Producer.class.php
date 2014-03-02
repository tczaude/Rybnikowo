<?

require_once 'Utils.class.php';

class Producer {
	
	/**
	 * @var object DBManager
	 */
	var $DBM;
	
	var $message;
	var $paging;

	function Producer() {
		global $DBM;
	 	$this->DBM = $DBM;
	}
	
	/**
	 * tworzy menu z kategoriami (grupami) produktowymi - rekurencyjnie!
	 * zasada : doklejamy kolejne subgrupy dopty dopóki jakiekolwiek są ;-)
	 */
	
	function createMenuCategories ($parent = 0, $status = 0) {
		
		// sprawdzamy czy mamy jakieś subkategorie dla podanej kategorii
		$sql = "select * from `producer` where parent = '$parent' ";
		
		if ($status) {
			
			$sql .= " and status = '$status' ";
		}
		
		if($parent == 0){
			$sql .= " order by name asc ";
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
		$sql = "select * from `producer` where parent = '$parent' ";
		
		if ($status) {
			//print_r($status);
			$sql .= " and status = '$status' ";
		}
		
		$sql .= " order by name asc ";
		
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
		$sql = "select * from `producer` where parent = '$parent' and type = '2' ";
		
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
	 * wyciąga szczegóły podanej kategorii na podstawie url_config
	 */
	
	function getProductProducer ($producer_id) {
		
		if ($producer_id) {
		
			$sql = "select * from `producer` where url_name = '$producer_id'";
			$producer_details = $this->DBM->getRow($sql);
			
			return $producer_details;
		}
	}

	
	/**
	 * wyciąga szczegóły podanej kategorii na podstawie id
	 */
	
	function getProductProducerById ($producer_id) {
		
		if ($producer_id) {
		
			$sql = "select * from `producer` where id = '$producer_id'";
			$producer_details = $this->DBM->getRow($sql);
			
			return $producer_details;
		}
	}
	
	/**
	 * Przestawia status 
	 */
	
	function setStatus ($producer_id, $status) {
		//print_r($status);
		if ($producer_id) {
			
			$sql = "update producer set status = '$status' where id = '$producer_id' ";
			$this->DBM->modifyTable($sql);
			
		}
	}		
	
	/**
	 * zapisuje kategorię produktu
	 */
	
	function saveProductProducer ($producer_form) {
		
		if (sizeof($producer_form)) {
			
			if (!$producer_form['id']) {
				
				
				// kolejność - to jest do przeniesienia do nowej klasy Order (?) albo osobna metoda w tej klasie (?)
				$sql = "select max(`order`) as last_order from `producer` where type = 1";
				$order = $this->DBM->getRow($sql);
				$next_order = $order['last_order'] + 1;
			
				if($producer_form['parent'] == 0 ){
					

					
					//Jeśli nowa kategoria główna - nowa metryka wraz z kolejnoscia
					$sql = "insert into `producer` (url_name, parent, name, status, type, `order`) values ('$producer_form[url_name]', '$producer_form[parent]', '$producer_form[name]', '$producer_form[status]', '1', '$next_order')";
					
				}
				else{
					
					$sql = "insert into `producer` (url_name, parent, name, status, type) values ('$producer_form[url_name]', '$producer_form[parent]', '$producer_form[name]', '$producer_form[status]', '0')";
					//echo"dupa";
				}
			
				// nowa kategoria
				
			
			
			}
			else {
				
				// aktualizacja kategorii
				$sql = "update `producer` set url_name = '$producer_form[url_name]', parent = '$producer_form[parent]', name = '$producer_form[name]', status = '$producer_form[status]', type = '$producer_form[type]' where id = '$producer_form[id]'";				
			}
			
			$this->DBM->modifyTable($sql);
			
			if (!$producer_form['id']) {
				$producer_id = $this->DBM->lastInsertID;
			}
			else {
				$producer_id = $producer_form['id'];
			}
			
			return $producer_id;
		}
	}
	
	/**
	 * wyciąga listę dostepnych grup produktów
	 */
	
	function getGroups () {
		
		$sql = "select * from `producer` ";
		$groups = $this->DBM->getTable($sql);
		
		return $groups;
	}	
	
	/**
	 * wyciąga nazwe kategorii
	 */
	
	function getGroup ($producer_id) {
		
		if($producer_id){
		
			$sql = "select * from `producer` where id = '$producer_id' ";
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
		
			$sql = "select * from `producer` where url_name = '$url_name' ";
			$group = $this->DBM->getRow($sql);
			//print_r($group);
			return $group;
		}
	}
	
	/**
	 * wyciąga listę grup dla podanej kategorii (grupy)
	 */
	
	function getCategoriesByProducer ($producer_id) {
		
		if (!$producer_id) $producer_id = 0;
		
		// if ($producer_id) {
			
			// $sql = "select gr.* from `producer` gr where gr.parent = '$producer_id' order by name asc ";
			$sql = "select gr.* from `producer` gr where gr.parent = '$producer_id' and status = 1 order by name asc";
			$categories = $this->DBM->getTable($sql);
			
			if (sizeof($categories)) {
				
				foreach ($categories as $key => $producer) {
					
					$categories[$key]['name'] = ltrim($producer['name'], "1");
				}
			}
			
			return $categories;
		// }
	}
	
	/**
	 * usuwa kategorię produktu
	 */
	
	function removeProductProducer ($producer_id) {
		
		if ($producer_id) {
			
			
			// usuwamy samą kategorię
			$sql = "delete from `producer` where id = $producer_id ";
			$rv = $this->DBM->modifyTable($sql);
			
			// usuwamy podkategorie
			$sql = "delete from `producer` where parent = $producer_id ";
			$rv = $this->DBM->modifyTable($sql);			
				
			
			
			

		}
		return $rv;
	}
	
	/**
	 * Tworzy listę kategorii dla administracji
	 */
	
	function createCategoriesForAdmin($parent = 0, $status = 0) {
		
		// sprawdzamy czy mamy jakieś subkategorie dla podanej kategorii
		$sql = "select * from `producer` where parent = '$parent'";
		
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
		$sql = "select * from `producer` where parent = 0 and status = 1";
		$groups_temp = $this->DBM->getTable($sql);
		
		if (sizeof($groups_temp)) {
			
			//Jesli sa - reindexujemy ich tablicę
			$groups = array();
			foreach ($groups_temp as $group_details) {
				$groups[$group_details[id]] = $group_details;
			}

			//Sprawdzamy czy kategoria posiada jakies subkategorie
			foreach($groups as $key => $producer){
				
				$sql = "select * from `producer` where parent = '$producer[id]' and status = 1";
				$subcategories_temp = $this->DBM->getTable($sql);
				
				
				if(sizeof($subcategories_temp)){
					//Jesli sa - dopisujemy je do tablicy glownych - a nadrzedna usuwamy
					$subcategories = array();
					foreach ($subcategories_temp as $subproducer_details) {
						$groups[$subproducer_details[id]] = $subproducer_details;
						unset($groups[$subproducer_details['parent']]);
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