<?php
/**
 * @copyright Copyright Code13 (c) 2005
 * @author Dawid Makowski (vinetou@code13.pl)
 * @see http://www.code13.pl
 *
 * Created on 2005-07-16
 * 
 */

require_once 'pear_error.inc.php';

class DBManager {

	/**
	 * @var object wynik zapytania
	 */
	var $res;
	/**
	 * @var int ilość wierszy zwróconych przez zapytanie
	 */
	var $numrows;
	/**
	 * @var int ilość wierszy zmodyfikowanych przez zapytanie
	 */
	var $affected_rows;
	/**
	 * @var object PEAR:DB resource
	 */
	var $DB;
	/**
	 * @var int ID ostatnio zapisanego rekordu (po insercie) 
	 */
	var $lastInsertID;
	

	function DBManager ($uri) 
	{
		$this->constructor($uri);
	}
	
	/**
	 * Kontruktor właściwy - do wywolywania m.in. w klasach dziedziczących
	 * @param string uri dostęp do bazy danych w formacie PEAR:DB
	 */
	function constructor ($uri) 
	{

		//obsługa połączenia z bazą
		$this->DB = DB::connect($uri);
		//ustawienie trybu dostępu do tablic
		$this->DB->setFetchMode(DB_FETCHMODE_ASSOC);
		// ustawiamy stronę kodową
		$sql = "SET NAMES 'utf8'";
		$this->DB->query($sql);
	}

	/**
	 * Zwraca następne ID w sekwencji
	 * int nextId( string $seq_name, [boolean $ondemand = true])
	 * boolean $ondemand when true, the seqence is automatically created if it does not exist
	 * 
	 * @param string seq_name nazwa sekwencji
	 * @return int następne ID
	 */
	function nextID($seq_name) 
	{
		return $this->DB->nextID($seq_name);
	}
	
	/**
	 * Tworzy nową sekwencję
	 * @param string seq_name nazwa sekwencji
	 * @return int DB_OK on success. A DB_Error object on failure.
	 */
	function createSequence ($seq_name) 
	{
		return $this->DB->createSequence($seq_name);
	}
	
	/**
	 * Usuwa sekwencję
	 */
	function dropSequence($seq_name) 
	{
		return $this->DB->dropSequence($seq_name);
	}
	
	/**
	 * Dodaje wszsytkie warunki LIMIT do zapytania wg formatu każdego ze sterowników bazy
	 * @access protected
	 */
	function modifyLimitQuery( $query, $from, $count, $params = array()) 
	{
		return $this->DB->modifyLimitQuery($query, $from, $count, $params = array());
	}
	
	/**
	 * Zwraca wiersz/wiersze w tablicy
	 * @param string sql zaptyanie SQL pobierające wiersz
	 * @param bool czy ma zwracać w postaci wierszy
	 * @return array tablica asocjacyjna z wierszem lub NULL
	 */
	function getRow($sql,$array = false) {
		$retval = NULL;
		$this->res = $this->DB->query($sql);
		if( is_object($this->res) ) while($row = $this->res->fetchRow(DB_FETCHMODE_ASSOC)) {
			if($array) {
				$retval[] = $row;
			} else {
				$retval = $row;
			}
		}
		$this->numrows = $this->res->numRows();
		$this->_free();
		return $retval;
	}

	/**
	 * Zwraca tablicę wierszy wg zapytanie SQL
	 * @param string sql zapytanie SQL do pobrania tablicy rekordów
	 * @return array tablica rekordów lub null
	 */
	function getTable($sql) {
		return $this->getRow($sql,true);
	}

	/**
	 * Aktualizuje wpisy w tabeli wg zapytania SQL
	 * @param string sql zapytanie modyfikujące
	 * @return int ilość zmodyfokowanych wierszy lub false gdy błąd
	 */
	function modifyTable($sql) {
		$retval = NULL;
		
		
		
		// $sql = $this->DB->quoteSmart($sql);
		// echo "<hr>zapytanie z DBM : $sql<hr>";
		$this->res = $this->DB->query($sql);
		$res = $this->res;
		$this->affected_rows = $this->DB->affectedRows();
		
		// zapisujemy ID ostatnio dodanego rekordu
		$this->lastInsertID = mysql_insert_id();
		
		 
		//$this->_free();
		return 	$res;
	}
  
  	/**
  	 * Zwraca ilość wierszy których dotyczyło zapytanie (usunięte, zmodyfikowane lub pobrane)
  	 * @return int ilość wierszy których dotyczyło ostatnie zapytanie
  	 */
  	function affectedRows()
  	{
  		return $this->DB>affectedRows();
  	}
  
	/**
	 * Czyści z pamięci rezultat ostatniego zapytania.
	 * @access private
	 */
	function _free() {
		if($this->res) $this->res->free();
	}
	
	/**
	 * Rozpoczyna transakcję - jeżeli baza to obsługuje
	 */
	function begin() {
		return $this->DB->query('BEGIN');
	}
	
	/**
	 * Wycofuje transakcję - jeżeli baza to obsługuje
	 */
	function rollback() {
		return $this->DB->query('ROLLBACK');
	}
	
	/**
	 * Commit transakcji - jeżeli baza to obsługuje
	 */
	function commit() {
		return $this->DB->query('COMMIT');
	}
	
	/**
	 * Metoda typowa tylko dla MySQL - wstawiona dla kompatybilności wstecz oraz do specjalnych przypadków.
	 * @deprecated CVS - 2005-07-16
	 * @return int ostatnio dodany ID
	 */
	function mysqlLastInsertID() {
		return mysql_insert_id();
	}

}

?>