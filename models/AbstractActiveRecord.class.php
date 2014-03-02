<?php
/**
 *
 * @copyright Copyright code13 (c) 2005
 * @author Dawid Makowski (vinetou@code13.pl)
 * @see http://www.code13.pl
 *
 * Created on 2005-07-16
 * 
 */

require_once 'database.class.php';
/** 
 * @abstract
 */ 
class AbstractActiveRecord 
{
	/**
	 * @var object DBManager
	 * @access private
	 */
	var $DBM;
	/**
	 * @var string DB_URI wg formatu PEAR
	 * @access private
	 */
	var $_DB_URI;
	
	/**
	 * @var string domy�lna tabela na kt�rej operuje dana instancja obiektu dziedzicz�cego
	 * @access private
	 */
	var $_default_table;
	/**
	 * @var string nazwa klucza g��wnego dla domy�lnej tabeli
	 * @access private
	 */
	var $_default_pk;
	/**
	 * @var string nazwa sekwencji dla tabeli domy�lnej
	 * @access private
	 */
	var $_default_seq;
	
	/**
	 * Konstruktor PHP4
	 * @access public
	 */
	function AbstractActiveRecord($params) 
	{
		$this->constructor($params);
	}
	
	/**
	 * Konstruktor w�a�ciwy.
	 * @access private
	 */ 
	function constructor($params) 
	{
		if(is_array($params)) {
			
			global $DBM;
	 		$this->DBM = $DBM;
		}
	}
	
	function load($obj_array) 
	{
		$rv = null;
		if( is_array($obj_array) ) {
			
			while (list($k,$v) = each($obj_array)) {
				$this->$k = $v;
			}
			$rv = $this; // KOPIA! bo to PHP4...
		}
		return $rv;
	}
  
  	/**
  	 * Ustawia DSN do bazy danych wg formatu PEAR::DB
  	 * @access private
  	 * @param string uri
  	 */
  	function _setURI ($uri) 
  	{
		$this->_DB_URI = $uri;
	}
	function _getURI () 
	{
		return ($this->_DB_URI);
	}
}
?>
