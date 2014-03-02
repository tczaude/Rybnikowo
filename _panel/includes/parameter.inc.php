<?php

require_once ('Config.class.php');
$config = new Config();

// --------------------------------------------------------------
// save parameters
// --------------------------------------------------------------

if ($_REQUEST['action'] == "SaveChangeableParameters") {
	if (sizeof($_POST['config_form'])) {
		$config->saveChangeableParameters($_POST['config_form']);
		
		
		$smarty->assign("good_message", "Parametry zostały zapisane");
	}
}

// --------------------------------------------------------------
// get parameters
// --------------------------------------------------------------

$parameters_list = $config->getParametersForChange();
$smarty->assign("parameters_list", $parameters_list);
//print_r($parameters_list);

?>
