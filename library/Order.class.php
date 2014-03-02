<?
/* vim: set expandtab tabstop=2 shiftwidth=2 foldmethod=marker: */

/**
 * Klasa do obsługi kolejności elementów w tabelach. Operuje na kolumnie w tabeli
 * zawierającej unikalne wartości wg których można sortować. Może przesuwać elementy 'w górę'
 * 'w dół' zamieniając sąsiednie wartości kolejności.
 * Może się ta zamiana odbywać także w zakresie konkretnej wartości innej kolumny (np. kategorii
 * artykułowej, kategorii produktowej) w tej samej tabeli.
 *
 * @author Dawid Makowski
 * @version 0.1.2
 * 
 */
 
class Order {

  /**
   * @var string Tabela na której są przeprowadzane operacje
   */
	var $tab;
  /**
   * @var string Nazwa kolumny zawierającej numer ID obiektu (domyślnie 'id')
   */
	var $id;
  /**
   * @var Nazwa kolumny zawierającej kolejność elementów
   */
	var $kolejnosc;
  /**
   * @var string Druga kolumna do warunku WHERE (kategoryzowanie wszelakie)
   */
	var $druga_kolumna;
	/**
   * @var int Parametr do drugiej kolumny (do warunku WHERE)
   */
	var $druga_kolumna_id;
	
  /**
   * Konstruktor, ustawiane są w nim tabele i kolumny na których będzie wykonywanie przestawianie.
	 *
	 * @param string $tab Tabela na której są przeprowadzane operacje
	 * @param string $id Nazwa kolumny zawierającej kolejność elementów
	 * @param string $kolejnosc Nazwa kolumny zawierającej kolejność elementów
	 * @param string $druga_kolumna Druga kolumna do warunku WHERE
	 * @param int $druga_kolumna_id Parametr do drugiej kolumny
   */
	function Order($tab, $id = 'id', $kolejnosc = 'routine', $druga_kolumna = null, $druga_kolumna_id = null) 
	{
		$this->tab = $tab;
		$this->id = $id;
		$this->kolejnosc = $kolejnosc;
		$this->druga_kolumna = $druga_kolumna;
		$this->druga_kolumna_id = $druga_kolumna_id;
		global $DBM;
		$this->DBM = $DBM;
	}

	/**
	 * Przesuwa element 'wcześniej' na liście
   * @param int $id numer id przesuwanego elementu
	 */
	function up($id) {
		$this->changeOrder($id);
	}

	/**
	 * Przesuwa element 'później' na liście
   * @param int $id numer id przesuwanego elementu
	 */
	function down ($id) 
	{
		$this->changeOrder($id,false);
	}

	/**
	 * Przesuwa element - zaleca sie korzystać tylko z metod 'wczesniej' i 'pozniej'
   * @param int $id numer id przesuwanego elementu
   * @param bool $up 1-wcześnie/0-później
	 */
	function changeOrder ($id, $up=true) 
	{
		$sql  = " SELECT ".$this->id.",`".$this->kolejnosc."` FROM ".$this->tab;
		$sql .= " WHERE ".$this->id." = '$id'";
    	$row = $this->DBM->getRow($sql);
    	
    	if ( is_array($row) ) {
      		$sql = "SELECT ".$this->id.",`".$this->kolejnosc."` FROM ".$this->tab;
			$sql .= " WHERE ";
			if ( $this->druga_kolumna && $this->druga_kolumna_id ) { 
				$sql .= $this->druga_kolumna." = ".$this->druga_kolumna_id." AND ";
			}
      		$sql .= " `".$this->kolejnosc."`";
  	    	if($up) $sql .= " < ";
 	     	else $sql .= " > ";
 	     	$sql .= $row[$this->kolejnosc]." ORDER BY `".$this->kolejnosc."`" ;
  	    	if($up) $sql .= " DESC ";
 	     	else $sql .= " ASC ";
 	     	$sql .= " LIMIT 1";
 	     	$row2 = $this->DBM->getRow($sql);
 	     	if ( is_array($row2) ) {
  		      	$sql  = " UPDATE ".$this->tab." SET `".$this->kolejnosc."` = ".$row2[$this->kolejnosc];
        		$sql .= " WHERE ".$this->id." = '$id'";
        		$this->DBM->modifyTable($sql);
        		$sql  = " UPDATE ".$this->tab." SET `".$this->kolejnosc."` = ".$row[$this->kolejnosc];
        		$sql .= " WHERE ".$this->id." = '".$row2[$this->id]."'";
        		$this->DBM->modifyTable($sql);
      		}
    	}
	}

	/**
	 * Pobiera następny numerek w kolejności dla nowego rekordu w bazie
	 * @return int numer kolekny rekordu
	 */
	function getNextOrder ($table = null, $column = 'routine') 
	{
		$maxsql = "SELECT max($column) max FROM ";
    	if($table) $maxsql .= $table;
    	else $maxsql .= $this->tab;
		$max = $this->DBM->getRow($maxsql);
		$k = 1;
		if ( is_numeric($max['max']) ) $k = $max['max'] + 1;
		return $k;
	}

}
