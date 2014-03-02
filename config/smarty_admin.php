<?php
/** 
 * Automatycznie tworzy Smarty
 * @author vinetou 
 */ 
require_once($__CFG['smarty_dir'] . '/Smarty.class.php');
$smarty = new Smarty;
$smarty->template_dir = $__CFG['smarty_admin_templates']; 
$smarty->compile_dir = $__CFG['smarty_admin_templates_c']; 
$smarty->config_dir = $__CFG['smarty_admin_config']; 
$smarty->cache_dir = $__CFG['smarty_admin_cache']; 

// wpisujemy od razu do smarty konfigurację serwisu
$smarty->assign('__CFG', $__CFG);
// debbug Smarty
$smarty->assign('debug', $__CFG['smarty_admin_debug']);
global $_pages;
$smarty->assign('_pages', $_pages);
$smarty->register_modifier('sslash','stripslashes');
?>