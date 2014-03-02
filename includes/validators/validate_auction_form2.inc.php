<?php

/**
 * @copyright Copyright code13 (c) 2010
 * @author Krzysiek Kaznowski (krzysiek@code13.pl)
 * @see http://www.code13.pl
 *
 * Created on 2010-01-22
 * 
 * Obsługa walidacji aukcji - krok 2
 * 
 */
	//print_r($_SESSION['auction']);
	require_once('Utils.class.php');
	require_once('Auction.class.php');
	$auction = new Auction();
	
	$error = array();
	

	//Podano kwotę w pierwszym kroku
	if ($_REQUEST['amount']) {
		

		//"Obrabiamy" format kwoty
		$amount01 = str_replace(',', '.', $_REQUEST['amount']);
		$amount = number_format($amount01, 2, '.', '');	
		$_SESSION['auction']['amount'] = $amount;
		$min_amount = $_SESSION['auction']['min_amount'];
		
		if($amount >= $min_amount){ 
			

		}
		else{
			$smarty->assign("min_amount", $_SESSION['auction']['min_amount']);
			$error['auction_form']['amount'] = "Minimalna kwota jaką możesz licytować to ";
			
		}		
	}
	//Nie podano kwoty
	else{
		$smarty->assign("min_amount", $_SESSION['auction']['min_amount']);
		$error['auction_form']['amount'] = "Minimalna kwota jaką możesz licytować to ";
	}
	


?>