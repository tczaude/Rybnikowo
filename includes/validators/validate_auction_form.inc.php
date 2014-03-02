<?php

/**
 * @copyright Copyright code13 (c) 2010
 * @author Krzysiek Kaznowski (krzysiek@code13.pl)
 * @see http://www.code13.pl
 *
 * Created on 2010-01-22
 * 
 * Obsługa walidacji aukcji - krok 1
 * 
 */
	
	require_once('Utils.class.php');
	require_once('Auction.class.php');
	$auction = new Auction();
	
	$error = array();
	

	//Podano kwotę w pierwszym kroku
	if ($_REQUEST['amount']) {
		
		//Sprawdzamy najwyższą ofertę jako cenę minimalną
		$min_amount_01 = $auction->getMaxOffert($_REQUEST['product_id']);
		
		//Są oferty
		if($min_amount_01['max_amount'] != ""){
			
			$min_amount_temp = $min_amount_01['max_amount'] + 1;
			$min_amount = number_format($min_amount_temp, 2, '.', '');	
		
			
		}
		//Nie ma ofert - wyciagamy cene produktu jako cene minimalna
		else{
			require_once('Product.class.php');
			$product = new Product();
			$product_details = $product->getProduct($_REQUEST['product_id'],1);
			$min_amount = $product_details['price'];
			
			
		} 
		
		//"Obrabiamy" format kwoty
		$amount01 = str_replace(',', '.', $_REQUEST['amount']);
		$amount = number_format($amount01, 2, '.', '');	
		
		//Przekazujemy do smarty cenę minimalną
		$smarty->assign("min_amount", $min_amount);
		$smarty->assign("amount", $amount);
		
		if($amount < $min_amount){ 
			
			$error['auction_form']['amount'] = "Minimalna kwota jaką możesz licytować to ".$min_amount." PLN";
			$smarty->assign("amount", $min_amount);
		}		
	}
	//Nie podano kwoty
	else{
		
		//Sprawdzamy najwyższą ofertę jako cenę minimalną
		$min_amount_01 = $auction->getMaxOffert($_REQUEST['product_id']);		
		
		//Są oferty
		if($min_amount_01['max_amount'] != ""){
			
			$min_amount_temp = $min_amount_01['max_amount'] + 1;
			$min_amount = number_format($min_amount_temp, 2, '.', '');	
			
			
			
		}
		//Nie ma ofert - wyciagamy cene produktu jako cene minimalna
		else{
			require_once('Product.class.php');
			$product = new Product();
			$product_details = $product->getProduct($_REQUEST['product_id'],1);
			$min_amount = $product_details['price'];
			
			
		} 	

		//Przekazujemy do smarty cenę minimalną
		$smarty->assign("min_amount", $min_amount);
		$smarty->assign("amount", $amount);
	}
	


?>