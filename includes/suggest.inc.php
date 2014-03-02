<?php
require_once('Product.class.php');
$product = new Product();


//print_r($__CFG);


if(isset($_POST['queryString'])) {
	$queryString = $_POST['queryString'];

	if(strlen($queryString) >0) {
		$result = $product->searchProductsForAjax($queryString, 1);
		//print_r($result);

		if($result){
			
			$smarty->assign("ajax_list", $result);
			

			
		}
		else{
			exit;
		}

	}
}


