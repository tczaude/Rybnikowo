<?php
/*
 * Created on 2006-06-20
 */

require_once ('Config.class.php');
$config = new Config();

// --------------------------------------------------------------
// single import from configuration file (from $__CFG array)
// --------------------------------------------------------------

if ($_REQUEST['action'] == "ImportParametersFromConfigFile") {
	$config->importParametersFromConfigFile();
}

// --------------------------------------------------------------
// get all config parameters
// --------------------------------------------------------------

$__CFG = $config->getConfigTable($base_path, $base_url);
// print_r($__CFG_temp);

?>
