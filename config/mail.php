<?php
/**
 * @global string metoda wysyłania maili - podawana jako parametr do klasy Mail (wzorca factory)
 */
global $_mail_factory;
// $_mail_factory = 'smtp';
$_mail_factory = 'sendmail';

/**
 * @global array konfiguracja mailera wg formatu PEAR::Mail
 */
global $_mail_params;
$_mail_host = 'mail.rsi.pl';
$_mail_params = Array (
	'host' => $_mail_host,
	'port' => '25',
	'auth' => false,
	'username' => 'krzysiek@code13.pl.pl',
	'password' => 'TeSt',
);
?>
