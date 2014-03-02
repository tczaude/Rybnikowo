<?php
	
	$smarty->assign("error_heading", "404 Page Not Found");
	$smarty->assign("error_message", "The page you requested was not found.");
	$smarty->display($__CFG['base_path'].'_panel/view/tpl/errors/error_general.tpl');
	
?>
