<?php

require_once 'DB.php';

require_once 'HCLogger.class.php';
if(!defined('DEBUG_ENV')) define('DEBUG_ENV', true);
PEAR::setErrorHandling(PEAR_ERROR_CALLBACK, 'handleError');
//obsługa błędów PEAR-a
function handleError($error_obj) {
	echo '<br/><br/>Wystąpił błąd krytyczny // Critical error occured';
	$err  = $error_obj->getMessage()."<br/>".$error_obj->getDebugInfo();
	$logfile = './view/log/system-error.log';
	$logger = new HCLogger('DBManager');
	$logger->setLogFile($logfile);
	$logger->log($err,PEAR_LOG_EMERG);
	die($err);
	exit;
}

?>