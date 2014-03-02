<?php
require_once('Product.class.php');
$product = new Product();

$site_list = $product->getProductsActiveAll($_SESSION['lang']);

header("Content-Type: text/xml");
$smarty->assign("site_list", $site_list);





