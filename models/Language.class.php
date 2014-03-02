<?php
/**
 * @copyright Copyright code13 (c) 2005
 * @see http://www.code13.pl
 */
 
class Language {
	
	/**
	 * @var object DBManager
	 */
	var $DBM;

	function Language() {
		global $DBM;
	 	$this->DBM = $DBM;
	}
    
    /**
     * Ustawia obiekt na domy�lny j�zyk
     */
    function getLanguage($language_id = null) {
    	
    	if ($language_id) {
    		$sql = "select * from language where id = '$language_id'";
    		$language_details = $this->DBM->getRow($sql);
    		
    		$_SESSION['lang'] = $language_id;
    		
    		return $language_details;
    	}
    	else {
    		// wybieramy domy�lny
    		$sql = "select * from language where `default` = 1";
    		$language_details = $this->DBM->getRow($sql);
    		
    		$_SESSION['lang'] = $language_details['id'];
    		
    		return $language_details;
    	}	
    }
    
    /**
     * Pobiera tablic� z rekordami wszystkich dost�pnych j�zyk�w
     */
    function getLanguages () {
		
		$sql = "select * from language";
		$language_list = $this->DBM->getTable($sql);
    		
    	return $language_list;
	}
}
?>