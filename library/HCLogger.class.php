<?php
/* vim: set expandtab tabstop=2 shiftwidth=2 foldmethod=marker: */
/**
 * @internal wymagana klasa logera PEAR-a
 * @author vinetou
 * @copyright Copyright © 2005, vinetou, code13
 */
require_once 'Log.php';
/**
* Abstrakcyjna klasa zawierająca standardowe definicje logger-a
*/

class HCLogger {
	/**
	 * @var object instancja obiektu (singleton) tworząca wpisy do logów
	 */
	var $logger;
	/**
	 * @var string scieżka do pliku z logami
	 */
	var $logfile;
	/**
	 * @var string identyfikacja wpisu do logu (ident z PEAR::Log)
	 */
	var $ident;
	/**
	 * @var array tablica konfiguracji loggera dla konkretnego typu instancji loggera
	 */
	var $conf;
	
	function HCLogger() 
	{
		$this->constructor();
	}

	/**
	 * Zaślepka imitująca PHP5 - konstruktor wywoływany w obiektach potomnych 
	 * w celu ustawienia domyślnych włściwości
	 * 
	 * @access protected
	 * @param string ident identyfikator wpisu do logu - ident wg PEAR::Log
	 */
	function constructor($ident = 'HCLogger') {
		$this->logfile = './system-error.log';
		$this->ident = $ident;
  		$this->conf = array('mode' => 0666, 'timeFormat' => '%x %X');
		$this->_setLogger();
	}

	/**
	 * Powołuje instancję obiektu logującego (sparametryzowany dla zapisu do pliku)
	 * @access private
	 */
	function _setLogger() 
	{
		// w tej wersji obsługuje tylko zapis do pliku
		
		// lub obserwatora obiektu
	  $this->logger = &Log::singleton('file', $this->logfile, $this->ident, $this->conf);
	}

	/**
	 * Zapisuje komunikat do logu
	 * 
	 * @access protected
	 * @param string content zawartość komunikatu
	 * @param int flag flaga ważności komunikatu do logu wg stałych zdefiniowanych w PEAR::Log
	 * @param string append treść dodatkowa komunikatu doklejana zawsze na końcu komunikatu głównego
	 * (może być np. pomocne przy późniejszym filtrowaniu)
	 */
	function log($content,$flag=null,$append = '') 
	{
			$this->logger->log($content.$append, $flag);
	}

	/**
	 * Ustawia ścieżkę (może być względna) do pliku z logami
	 * 
	 * @access protected
	 * @param string file ścieżka do pliku (razem z jego nazwą)
	 */
	function setLogFile($file)
	{
		$this->logfile = $file;
		$this->_setLogger();
	}
	
	function setIdent($ident)
	{
		$this->ident = $ident;
		$this->_setLogger();
	}

}
?>