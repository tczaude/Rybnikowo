<?php

require_once('SearchEngine.class.php');
$search_engine = new SearchEngine();
require_once('Product.class.php');
$product = new Product();
//Zabezpieczenie przed brakiem podania numeru strony do stronicowania
if($url_config['1']){
	
	$_SESSION['search_form_page'] = $url_config['1'];
	
}
else{
	
	$_SESSION['search_form_page'] = 1;
	
}


//-----------------------------------------------------
// Akcja wyszukiwania
//----------------------------------------------------


if($_REQUEST['action'] == "Search"){
	
	
	
	if (sizeof($_POST['search_form'])) {
		
			if($_POST['search_form']['phrase']){
				
				$_POST['search_form']['title'] = $_POST['search_form']['phrase'];
				
			}
		
			if($_POST['search_form']['title'] == "Szukaj"){
				
				$_POST['search_form']['title'] = "";
			}
		
			$_SESSION['search_form'] = $_POST['search_form'];
			//print_r($_POST['search_form']);

		
			header("location: /szukaj");
	}	

	
}
else{
	
	if(sizeof($_SESSION['search_form'])){
		
		$_SESSION['search_form']['status'] = 2;
		$search_form = $_SESSION['search_form'];
		// lista wyników
		$limit = 100;
		$search_data = $product->getProductsSearch($limit, "title", "asc", $search_form, $_SESSION['search_form_page'], $_SESSION['lang']);
		$smarty->assign("product_list", $search_data);
		$smarty->assign("paging", $product->paging);
		$smarty->assign("ret_post", $_SESSION['search_form']);
		$smarty->assign("advanced", 1);
///		print_r($search_data);

		
		
	}
}


	
?>
