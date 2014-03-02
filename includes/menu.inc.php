<?php
	
	require_once('Category.class.php');
	$category = new Category();
	
	$menu_categories = $category->createMenuCategories(0, 1);
	
	$smarty->assign("menu_categories", $menu_categories);
	//print_r($menu_categories);
	
	
	/*
	echo "<!--";
	print_r($menu_categories);
	echo "-->";
	*/
?>