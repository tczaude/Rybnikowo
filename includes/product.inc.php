<?php
/*
 * obsługuje prezentację kategorii produktów
 */

// print_r($_SESSION);


//Wyłączenie filtrow w danej kategorii

if($_REQUEST['clear_filter']){
	
	$_SESSION['filters']['type'] = "";
	
	
}

require_once('Product.class.php');
$product = new Product();
	
	
//-------------------------------------------------------------
// Szczególy produktu w kategorii
//-------------------------------------------------------------
	
	
	if($url_config['0'] == "firma"){
		
		//Podano identyfikator produktu
		if($url_config['1']){
		
			//Widok
			$template = "catalog_details.tpl";
			
			//Sprawdzamy czy podany produkt rzeczywiście istanieje
			$product_details = $product->getProductByUrlNameToView($url_config['1'], $_SESSION['lang']);
			//print_r($product_details);
			//Jeśli produkt istnieje i ma status "dostępny"
			if($product_details['status'] == "2"){
				
			
				$smarty->assign("product_details", $product_details);

				
				if ($_SESSION['category_details']){
					
					//Sprawdzamy, czy firma ma powiaązanie z ta kategoria
					require_once('Product_related.class.php');
					$product_related = new Product_related();
					
					$check_category = $product_related->checkRelatedProductInCategory($product_details['product_id'], $_SESSION['category_details']['id']);
					
					if ($check_category){
						
						//Dane o kategorii produktu - potrzebne do breadcrumbs, etc
						$category_details = $category->getGroup($_SESSION['category_details']['id']);						
					}
					else{
						//Dane o kategorii produktu - potrzebne do breadcrumbs, etc
						$category_details = $category->getGroup($product_details['category_id']);							
						
					}
					
					
					
				}
				else{
					
					//Dane o kategorii produktu - potrzebne do breadcrumbs, etc
					$category_details = $category->getGroup($product_details['category_id']);		
					$_SESSION['category_details'] = $category_details;			
					
				}
				

				$smarty->assign("category_details", $category_details);
			
				$category_parent = $category->getProductCategoryById($category_details['parent']);
				//print_r($category_parent);
				$smarty->assign("category_parent", $category_parent);
				
				//Inne subkategorie
				$subcategory_list = $category->getCategoriesBycategory($category_details['parent']);
				$smarty->assign("subcategory_list", $subcategory_list);
				
				//Zdjęcia dodatkowe dla firmy
				require_once('Picture.class.php');
				$picture = new Picture();
				$pictures_list = $picture->getPicturesByCategoryToView(100, 1, 1, $product_details['product_id']);
				//print_r($pictures_list);
				$smarty->assign("pictures_list", $pictures_list);
				
				
				//Tytuły meta
				$head = array();
				$head['title'] = $product_details['title'];
				$head['description'] = str_replace('"', ' ', $product_details['abstract']);
				
				$smarty->assign("head", $head);				
				
			}
			//Nie istnieje, albo jest wyłączony
			else{
				
				$smarty->assign("error_heading", "404 Page Not Found");
				$smarty->assign("error_message", "Podane produkt nie istnieje.");
				$smarty->assign("back", "javascript:history.back()");
				
				$template = "errors/error_general.tpl";
				$smarty->display($template);
				exit;				
				
				
				
			}
	
			
			
		}
		//Nie podano identyfikatora produktu
		else{
			$location = $__CFG['first_category'];
			header("Location: ".$default_path."producent/".$location);
			
		}

		
		
	}


	
	
//-------------------------------------------------------------
// Nieznany parametr
//-------------------------------------------------------------	
	
	
	else{
		
		
			$smarty->assign("error_heading", "404 Page Not Found");
			$smarty->assign("error_message", "The page you requested was not found.");

			
			$template = "errors/error_general.tpl";
			$smarty->display($template);
			exit;		
		
		
	}
	

//print_r($_SESSION['first_category']);
//Widoki listy
				
if($_REQUEST['view']){
	//print_r($_REQUEST['order']);
		$_SESSION['filters']['view'] = $_REQUEST['view'];	
}
else{
	if(!$_SESSION['filters']['view']){
		$_SESSION['filters']['view'] = "main_product_list";
	}										
}				

$main = $_SESSION['filters']['view'].".tpl";
$smarty->assign("main", $main);

?>