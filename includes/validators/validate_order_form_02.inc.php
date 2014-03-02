<?php
	
	require_once('Utils.class.php');
	
	$error = array();

	if (!$_POST['order_form']['delivery']) {
		$error['order_form']['delivery'] = "Proszę wybrać sposób dostawy";
	}

?>