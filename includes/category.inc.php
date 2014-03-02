<?php
/*
 * obsługuje prezentację kategorii produktów
 */

// print_r($_SESSION);

require_once('Product.class.php');
$product = new Product();

//-------------------------------------------------------------
// Lista produktów w kategorii
//-------------------------------------------------------------

	if($url_config['0'] == "kategoria"){
		
		if($url_config['1']){
		
			
			$cat_temp = explode("_", $url_config['1']);
			//print_r($cat_temp);
			$smarty->assign("split_category", $cat_temp);
			
			
			//Info o kategorii
			$category_details = $category->getProductcategory($cat_temp['0']);
			$smarty->assign("category_details", $category_details);

			if(sizeof($category_details)){
				
				$_SESSION['category_details'] = $category_details;
				
				//Tytuły meta
				$head = array();
				$head['title'] = $category_details['name'];
				$head['description'] = $category_details['name'];
				$smarty->assign("head", $head);

				// ustawienie numeru strony do stronicowania (jezeli nie została podana)
				
				if (!$url_config['2']) {
					$url_config['2'] = 1;
				}

				
				//Ustawienia filtrów
				
				$_SESSION['filters']['order'] = "title";
				$_SESSION['filters']['type'] = "";
				$_SESSION['filters']['limit'] = "15";
				$_SESSION['filters']['dir'] = "asc";
	
				//print_r($_REQUEST);
				$smarty->assign("filters", $_SESSION['filters']);
				
				//$breadcrumb = $category->createBreadcrumbForCategory($category_details['id']);
				$category->createBreadcrumbForCategory ($category_details['id']);
				$smarty->assign("breadcrumbs", $category->breadcrumb);
				//print_r($category->breadcrumb);

				//Kategoria główna
				if ($category_details['parent'] == 0){
					
					//Kategorie niższe (subcategory)
					$subcategory_list = $category->getCategoriesBycategory($category_details['id']);
					//Sprawdzamy czy podana kategoria posiada jakies subkategorie
					if($subcategory_list){
						//print_r($subcategory_list);
						$smarty->assign("subcategory_list", $subcategory_list);
						
					}
									
					$template = "catalog_grid.tpl";
					$main = "main_category_grid.tpl";					
					
				}
				//Podkategoria
				else {
					
					$category_parent = $category->getProductCategoryById($category_details['parent']);
					//print_r($category_parent);
					$smarty->assign("category_parent", $category_parent);
					
					//Inne subkategorie
					$subcategory_list = $category->getCategoriesBycategory($category_details['parent']);
					$smarty->assign("subcategory_list", $subcategory_list);
					$_SESSION['filters']['related'] = $category_details['id'];
					//wyciagamy liste produktow
					$product_list = $product->getProductsBycategoryToView($category_details['id'], $url_config['2'], $_SESSION['filters']['limit'],  $_SESSION['lang'], $_SESSION['filters']);
					$smarty->assign("product_list", $product_list);
					//print_r($product_list);
					$template = "catalog_grid.tpl";
					$main = "main_category_grid.tpl";					
					
					
					
					
					
				}
				
				
				
				


				$smarty->assign("paging", $product->paging);
				$smarty->assign("current_category", $category_details['url_name']);

			}
			//Nie ma produktów
			else{
				
				$smarty->assign("error_heading", "404 Page Not Found");
				$smarty->assign("error_message", "Podana kategoria nie istnieje.");
				$smarty->assign("back", "javascript:history.back()");
				
				$template = "errors/error_general.tpl";
				$smarty->display($template);
				exit;

			}
		}
		else{
			//Sprawdzamy czy była jakas wyswietlana wczesnie - jesli tak podajemy ja jako domyslna
			if($_SESSION['first_category']){
				$url_config['1'] = $_SESSION['first_category'];
			}
			//Nie było wczesniej 
			else{
				$url_config['1'] = $__CFG['first_category'];
			}
			header("Location: /kategoria/".$url_config['1']);
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
//Widoki listy
$smarty->assign("main", $main);




?>