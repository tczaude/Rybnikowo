<?php
/* vim: set expandtab tabstop=2 shiftwidth=2 foldmethod=marker: */

/**
 * Klasa zawierajaca uzyteczne funkcje :)
 *
 * @author Kamil Smoroń (speed), Dawid Makowski (vinetou)
 * @version 0.0.2
 */
class Utils {

  /**
   * Konstruktor
   */
	function Utils() {
	}

  /**
   * Odczytuje typ pliku na podstawie jego rozszerzenia.
   *
   * @param string $file_name nazwa pliku (moze byc pelna sciezka)
   *
   * @return string typ pliku (srednio 3 znaki - wielki litery)
   */
  function getFileType($file_name) {
    $retval = strtoupper(substr(strrchr($file_name, '.'), 1));
    return $retval;
  }

  /**
   * Sprawdza, czy podany ciag jest poprawnym adresem email.
   *
   * @param string $email badany ciag (email)
   *
   * @return bool czy podany ciag jest emailem
   */
  function isEmail($email) {
    return (preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
  }

  function prepareMailSubject($sub) {
    return trim(mb_encode_mimeheader($sub,'iso-8859-2','Q',"\n\t"));
  }
  
  function prepareSubjectBase64($s) {
  	return "=?utf-8?B?" . base64_encode($s) . "?=";
  }


  /**
   * Sprawdza, czy podany ciag jest poprawnym czasem H:i:s
   *
   * @param string $time badany ciag (czas)
   *
   * @return bool czy podany ciag jest czasem
   */
  function isTime($time) {
    $time_parts = explode(':', $time);
    $h = (int)$time_parts[0];
    $m = (int)$time_parts[1];
    $s = (int)$time_parts[2];
    return (0 <= $h && $h <= 24 && 0 <= $m && $m <= 59 && 0 <= $s && $s <= 59);
  }

  /**
   * Sprawdza, czy podany ciag jest poprawna data wg ISO YYYY-mm-dd
   * (bez godziny).
   *
   * @param string $date badany ciag (data)
   *
   * @return bool czy podany ciag jest data (format ISO)
   */
  function isDate($date) {
    $date_parts = explode('-', $date);
    return (checkdate($date_parts[1], $date_parts[2], $date_parts[0])); //m-d-y
  }

  /**
   * Sprawdza, czy podany ciag jest poprawna data/czasem wg ISO YYYY-mm-dd H:i:s
   *
   * @param string $date badany ciag (data/czas)
   *
   * @return bool czy podany ciag jest data/czasem (format ISO)
   */
  function isDateTime($datetime) {
    $date_parts = preg_split('/[ ]+/', trim($datetime));
    if ($date_parts[1] == '') {
      $date_parts[1] = '00:00:00';
    }
    return (Utils::isDate($date_parts[0]) && Utils::isTime($date_parts[1]));
  }

  /**
   * Zapisuje na serwerze plik przeslany przez uzytkownika.
   *
   * @param string $param_name nazwa parametru, przez ktory zostal przeslany plik
   * @param string $new_file sciezka wraz z nazwa dla nowego pliku
   *
   * @return bool czy plik poprawnie zapisany
   */
   function saveFile($param_name, $new_file) {
    global $_FILES;
    $retval = false;
    $file_tmp = $_FILES[$param_name]['tmp_name'];
    if (is_uploaded_file($file_tmp)) {
      //echo "is uploaded\n";
      if (move_uploaded_file($file_tmp, $new_file)) {
        // echo "is moved to $new_file\n";
        $retval = true;
      } else {
        @unlink($file_tmp);
      }
    }
    return $retval;
  }

  /**
   * Zamienia stary plik na serwerze na plik przeslany przez uzytkownika.
   *
   * @param string $param_name nazwa parametru, przez ktory zostal przeslany plik
   * @param string $new_file sciezka wraz z nazwa dla nowego pliku
   * @param string $old_file sciezka wraz z nazwa starego pliku
   *
   * @return bool czy plik poprawnie zapisany
   */
   function replaceFile($param_name, $new_file, $old_file) {
    global $_FILES;
    $retval = false;
    $file_tmp = $_FILES[$param_name]['tmp_name'];
    if (is_uploaded_file($file_tmp)) {
      if (move_uploaded_file($file_tmp, $new_file)) {
        if (trim(strtoupper($new_file)) != trim(strtoupper($old_file))) {
          @unlink($old_file);
        }
        $retval = true;
      } else {
        @unlink($file_tmp);
      }
    }
    return $retval;
  }

  /**
  * Zrzuca dane do pliku
  * @param $filename  string nazwa pliku (może być cała ścieżka)
  * @param $content   string zawartość pliku
  */
	function file_put_contents($filename, $content, $flags = 0) {
	   define('FILE_APPEND', 1);
	   //if (!($file = fopen($filename, ($flags & FILE_APPEND) ? 'a' : 'w')))
	   if (!($file = fopen($filename,'a')))
	   return false;
	   $n = fwrite($file, $content);
	   fclose($file);
	   return $n ? $n : false;
  	}

  /**
   * Zwraca opisowa reprezentacje podanej daty.
   *
   * @param string $date data
   *
   * @return string tekstowa reprezentacja podanej daty
   */
  function getTextDate($date) {
    $day_names = array('Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela');
    $month_names = array('Stycznia', 'Lutego', 'Marca', 'Kwietnia', 'Maja', 'Czerwca', 'Lipca', 'Sierpnia', 'Września', 'Października', 'Listopada', 'Grudnia');
    $retval = '';

    $dateTmp = split('-', $date);
    $tmpDate = getdate(mktime(12, 0, 0, $dateTmp[1], $dateTmp[2], $dateTmp[0]));
    $day = $tmpDate['wday'] - 1; // liczymy od PN
    if ($day < 0) {
      $day = 6;
    }

    $retval = $day_names[$day].', '.$dateTmp[2].' '.$month_names[$dateTmp[1] - 1].' '.$dateTmp[0];
    return $retval;
  }

  /**
   * Jezeli podanej wartosc nie da sie skonwertowac na numeric
   * zwraca zero, w przeciwnym przypadku zwraca liczbe z separatorem
   * dziesietnym ustawionym na '.'
   *
   * @param string $numeric wartosc do zbadania
   *
   * @return string tekstowa reprezentacja podanej daty
   */
  function getNumeric($numeric) {
    $retval = 0.0;
    $numeric = str_replace(',', '.', $numeric);
    if (is_numeric($numeric)) {
      $retval = $numeric;
    }
    return $retval;
  }
  
  /**
   * Upraszcza dwuwymiarową tablicę.
   * Używa wartości z tablicy (każda z wartości też musi być tablicą) i buduje uproszczoną tablicę biorąc
   * jej jedne z wartości na klucze a inne na wartości (trochę zakręcone, wiem..).
   * Najczęsciej używane do 'spłaszczania tablicy 'rekordów' pobranych z bazy (tablica tablic)
   * @access public
   * @static
   */
  function array2To1Dimension($array, $key_name, $val_name)
  {
  	$rv = array();
  	if( is_array($array) ) {
  		foreach ($array as $k=>$v) {
  			$rv[$v[$key_name]] = $v[$val_name];
  		}
  	}
  	return $rv;
  }

  function getMicrotime()
  {
    $mtime = microtime();
    $mtime = explode(' ', $mtime);
    $mtime = (double)($mtime[1]) + (double)($mtime[0]);
    return ($mtime);
  }
  
  /**
 * Check if a file exists in the include path
 *
 * @version      1.2.0
 * @author       Aidan Lister <aidan@php.net>
 * @param        string     $file       Name of the file to look for
 * @return       bool       TRUE if the file exists, FALSE if it does not
 */
	function file_exists_incpath ($file)
	{
	    $paths = explode(PATH_SEPARATOR, get_include_path());
	 
	    foreach ($paths as $path) {
	        // Formulate the absolute path
	        $fullpath = $path . DIRECTORY_SEPARATOR . $file;
	 
	        // Check it
	        if (file_exists($fullpath)) {
	            return true;
	        }
	    }
	 
	    return false;
	}
  
/*
the fine thing is, you can add as many parameters you need, and you can add sort_flags as well (but be shure not to put em into " or ' - took some time for me to get this *g*)
______
syntax:
$new_array = array_multisort($array [, 'col1' [, SORT_FLAG [, SORT_FLAG]]]...);
__________
explanation:
$array is the array you want to sort, 'col1' is the name of the column you want to sort, SORT_FLAGS are : SORT_ASC, SORT_DESC, SORT_REGULAR, SORT_NUMERIC, SORT_STRING
you can repeat the 'col',FLAG,FLAG, as often you want, the highest prioritiy is given to the first - so the array is sorted by the last given column first, then the one before ...

*/
//Sortowanie tablicy wielowymiarowej
function array_csort() {  //coded by Ichier2003
    $args = func_get_args();
    $marray = array_shift($args);

    $msortline = "return(array_multisort(";
    foreach ($args as $arg) {
        $i++;
        if (is_string($arg)) {
            foreach ($marray as $row) {
                $sortarr[$i][] = $row[$arg];
            }
        } else {
            $sortarr[$i] = $arg;
        }
        $msortline .= "\$sortarr[".$i."],";
    }
    $msortline .= "\$marray));";

    eval($msortline);
    return $marray;
}


function clean_phrase($phrase){
	
		$new_phrase_01 = strtr($phrase, " ", "-");
		$new_phrase_02 = strtr($new_phrase_01, ".", "-");
		$new_phrase_03 = strtr($new_phrase_02, "?", "-");
		$new_phrase_04 = strtr($new_phrase_03, "/", "-");
		$new_phrase_05 = strtr($new_phrase_04, "&", "-");
		$new_phrase_06 = strtr($new_phrase_05, "`", "-");
		$new_phrase_07 = strtr($new_phrase_06, "'", "-");
		$new_phrase = strtr($new_phrase_07, "%", "-");
	
		// tablica z translacją polskich znaków
		$toascii = array(
					'Ś' => 'S',
					'ś' => 's',
					'Ć' => 'C',
					'ć' => 'c',
					'Ó' => 'O',
					'ó' => 'o',
					'Ń' => 'N',
					'ń' => 'n',
					'Ł' => 'L',
					'ł' => 'l',
					'Ż' => 'Z',
					'ż' => 'z',
					'Ź' => 'Z',
					'ź' => 'z',
					'Ą' => 'A',
					'ą' => 'a',
					'Ę' => 'E',
					'ę' => 'e',
					'é' => 'e',
					);
		
		return (!$addSlashes)? strtr($new_phrase, $toascii): addslashes( strtr($new_phrase, $toascii) );	
	
	
}

function clean_phrase_by_special_characters($phrase){
	
		$phrase2 = ereg_replace("'","&rsquo;",$phrase);
		$phrase3 = ereg_replace('"','&quot;',$phrase2);
		$phrase4 = ereg_replace('“','&ldquo;',$phrase3);
		$phrase5 = ereg_replace('”','&rdquo;',$phrase4);
		
		return $phrase5;	
	
	
}

function toascii_replace($input){
	
		// tablica z translacją polskich znaków
		
		$toascii = array(
					'Ś' => 'S',
					'ś' => 's',
					'Ć' => 'C',
					'ć' => 'c',
					'Ó' => 'O',
					'ó' => 'o',
					'Ń' => 'N',
					'ń' => 'n',
					'Ł' => 'L',
					'ł' => 'l',
					'Ż' => 'Z',
					'ż' => 'z',
					'Ź' => 'Z',
					'ź' => 'z',
					'Ą' => 'A',
					'ą' => 'a',
					'Ę' => 'E',
					'ę' => 'e',
					);
		
		return (!$addSlashes)? strtr($input, $toascii): addslashes( strtr($input, $toascii) );
	}



function toascii_replace_email($input){
	
		// tablica z translacją polskich znaków
		
		$toascii = array(
					'Ś' => 'S',
					'ś' => 's',
					'Ć' => 'C',
					'ć' => 'c',
					'Ó' => 'O',
					'ó' => 'o',
					'Ń' => 'N',
					'ń' => 'n',
					'Ł' => 'L',
					'ł' => 'l',
					'Ż' => 'Z',
					'ż' => 'z',
					'Ź' => 'Z',
					'ź' => 'z',
					'Ą' => 'A',
					'ą' => 'a',
					'Ę' => 'E',
					
					// znaki specjalne :
					
					':' => '',
					'(' => '',
					')' => '',
					'"' => '',
					'%' => '',
					'&' => '',
					'+' => '',
					'=' => '',
					'!' => '',
					'$' => '',
					'#' => '',
					',' => '',
					';' => '',
					'<' => '',
					'>' => '',
					'?' => '',
					'/' => '',
					'{' => '',
					'}' => '',
					'[' => '',
					']' => '',
					'*' => '',
					"'" => '',
					);
		
		return (!$addSlashes)? strtr($input, $toascii): addslashes( strtr($input, $toascii) );
}

}
?>