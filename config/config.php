<?php
/**
 * UWAGA! Ten plik powinien być dołączany ZAWSZE jako pierwszy w całej aplikacji!
 */


//----------------------------------------------------
// Zabezpieczenie kiedy wpisywany jest adres bez www
//----------------------------------------------------


	
//Defnicje dla ułatwienia gdyby komuś się zachciało mieć dodatkowe globale
$base_path = dirname(__FILE__).'/../';
// To musi być niestety ustawiane ręcznie bo nie działa inaczej dobrze SPAW
$base_url  = 'http://rybnikowo.pl/';
// ustawiamy ścieżki w których przeszukuje include i require
ini_set('include_path',ini_get('include_path').':'.
	$base_path.'models/:'.
	$base_path.'library/:'.
	$base_path.'library/pear/:'.
	$base_path.'library/pear/Mail/:'.
	$base_path.'library/smarty/:'.
	$base_path.'library/validators/:'.
	$base_path.'errors/:'.
	$base_path.'includes/validators/:'.
	$base_path.'_panel/includes/validators/:'
	
	);
// --------------------------------------------------------------
// database configuration
// --------------------------------------------------------------

require_once($base_path.'/config/db.php');

// --------------------------------------------------------------
// database manager
// --------------------------------------------------------------

require ('database.class.php');
global $DBM;
$DBM = new DBManager($__DB_CFG['uri']);

// -------------------------------------------------------------- 
// @global array konfiguracja główna serwisu
// --------------------------------------------------------------

global $__CFG;

// --------------------------------------------------------------
// get main config table
// --------------------------------------------------------------
require_once($base_path.'/includes/config.inc.php');

// --------------------------------------------------------------
// mail configuration
// --------------------------------------------------------------

require_once($base_path.'/config/mail.php');

// --------------------------------------------------------------
// smarty configuration
// --------------------------------------------------------------

require_once($base_path.'/config/smarty.php');


// --------------------------------------------------------------
// @global array _contact_mails lista adresów mailowych na które idą zgłoszenia z formularza kontaktowego
// --------------------------------------------------------------

global $_contact_mails;

// --------------------------------------------------------------
// lista adresów mailowych na które idą zgłoszenia z formularza kontaktowego
// --------------------------------------------------------------

$_contact_mails = array(
	'krzysiek@code13.pl',
);

?>