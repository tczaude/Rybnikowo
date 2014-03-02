<?php

/**
 * obsługa sesji usera 
 */

require_once ('User.class.php');


global $User;
$user = new User;



//echo $_REQUEST['action'];

//print_r($_SESSION['user_data']);


// --------------------------------------------------------------
// logout user
// -------------------------------------------------------------- 

if ($_REQUEST['action'] == "LogoutUser") {

    // usuwamy dane usera z sesji
    unset($_SESSION['user_data']);
	//Niszczymy poprzednie komunikaty
	unset($_SESSION['message']);
	unset($_SESSION['order']);
    unset($_SESSION['bonus_add']);
    unset($_SESSION['bonus_min']);
    $_SESSION['message']['good_message'] = "Zostałeś wylogowany";
    	
	// i kierujemy się na stronę główną

    header('Location: /');
}

// --------------------------------------------------------------
// log in user
// --------------------------------------------------------------

if ($_REQUEST['action'] == "LoginUser") {
	
	//echo"dddd";
	unset($_SESSION['user_data']);
	//Niszczymy poprzednie komunikaty
	unset($_SESSION['message']);
	
	if (!sizeof($_SESSION['user_data'])) {
		
		if (sizeof($_POST['login'])) {
			
			$login_form['login'] = $_POST['login'];
			$login_form['password'] = $_POST['password'];
			//print_r($_POST);
			// niezalogowany i podano dane do autoryzacji
			
			$user_details = $user->loginUser($login_form);
			
			
	       	if (sizeof($user_details)) {
	           	
	           	// logged correct
	       		$_SESSION['user_data'] = $user_details;
	       		$smarty->assign('user_data', $_SESSION['user_data']);
	       		
	       		// Łączymy koszyki - z sesji oraz użytkownika
	       		require_once ('Basket.class.php');
				$basket = new Basket();
	       		
	       		$basket->mergeBasket($_SESSION['user_data']['id'], session_id());
	       		
	       		$_SESSION['message']['good_message'] = "Zostałeś zalogowany";
	       		
				//Istnieje w sesji żadanie przekierowania do url
		       if($_SESSION['target']){
		       	

	       			// przenieś się do podanego wczesenij adresu
	       			$link = base64_decode($_SESSION['target']);
	       			unset($_SESSION['target']);      			
	       			
	       			header("Location: /".$link);
					//print_r($_SESSION);
	       			
	       		}
	       		//NIe ma zadania - idziemy do strony glownej
	       		else{
		       		
					
	       			// go to main page
	       			header("Location: /");
	       			//print_r($_SERVER);
	       		}
	       		exit;	
	       		
	       		       		
	    
	       	}
	       	else {
	       		// błąd przy logowaniu
	           	$smarty->assign('error_login', "Nieprawidłowy login lub hasło.");

	       		
	           	$smarty->assign('ret_post', $login_form);
	           	$main = "main_choose_login.tpl";
				$smarty->assign("main", $main);
	           	// na wszelki wypadek niszczymy bieżacą sesję usera
				unset($_SESSION['user_data']);
				
	    	}
	    }
	}
}

// --------------------------------------------------------------
// Logowanie w czasie zamowienia
// --------------------------------------------------------------

if ($_REQUEST['action'] == "LoginUserForOrder") {

	unset($_SESSION['user_data']);
	//Niszczymy poprzednie komunikaty
	unset($_SESSION['message']);
	
	if (!sizeof($_SESSION['user_data'])) {
		
		if (sizeof($_POST['login_form'])) {
			
			// niezalogowany i podano dane do autoryzacji
			
			$user_details = $user->loginUser($_POST['login_form']);
			
			
	       	if (sizeof($user_details)) {
	           	
	           	// logged correct
	       		$_SESSION['user_data'] = $user_details;
	       		$smarty->assign('user_data', $_SESSION['user_data']);
	       		
	       		// Łączymy koszyki - z sesji oraz użytkownika
	       		require_once ('Basket.class.php');
				$basket = new Basket();
	       		
	       		$basket->mergeBasket($_SESSION['user_data']['id'], session_id());
	       		
	       		$_SESSION['message']['good_message'] = "Zostałeś zalogowany";
	       		
	       		
	       		
				//Istnieje w sesji żadanie przekierowania do url
		       if($_SESSION['target']){
		       	

	       			// przenieś się do podanego wczesenij adresu
	       			$link = base64_decode($_SESSION['target']);
	       			unset($_SESSION['target']);      			
	       			
	       			header("Location: /".$link);
					//print_r($_SESSION);
	       			
	       		}
	       		//NIe ma zadania - idziemy do strony glownej
	       		else{
		       		
					
	       			// go to main page
	       			header("Location: /");
	       		}
	       		exit;	       		
	    
	       	}
	       	else {
	       		// błąd przy logowaniu
	           	
				// komunikat do widoku
				$_SESSION['message']['bad_message'] = "Nieprawidłowy login lub hasło. Proszę spróbować jeszcze raz.";	       		
	           	$smarty->assign('ret_post', $_POST['login_form']);
	           	
	           	// na wszelki wypadek niszczymy bieżacą sesję usera
				unset($_SESSION['user_data']);
				
	    	}
	    }
	}
}

// --------------------------------------------------------------
// Logowanie w czasie zamowienia
// --------------------------------------------------------------

if ($_REQUEST['action'] == "LoginUserForAuction") {

	unset($_SESSION['user_data']);
	//Niszczymy poprzednie komunikaty
	unset($_SESSION['message']);
	
	if (!sizeof($_SESSION['user_data'])) {
		
		if (sizeof($_POST['login_form'])) {
			
			// niezalogowany i podano dane do autoryzacji
			
			$user_details = $user->loginUser($_POST['login_form']);
			
			
	       	if (sizeof($user_details)) {
	           	
	           	// logged correct
	       		$_SESSION['user_data'] = $user_details;
	       		$smarty->assign('user_data', $_SESSION['user_data']);
	       		
	       		// Łączymy koszyki - z sesji oraz użytkownika
	       		require_once ('Basket.class.php');
				$basket = new Basket();
	       		
	       		$basket->mergeBasket($_SESSION['user_data']['id'], session_id());
	       		
	       		$_SESSION['message']['good_message'] = "Zostałeś zalogowany";
	       		
	       		
	       		
				//Istnieje w sesji żadanie przekierowania do url
		       if($_SESSION['target']){
		       	

	       			// przenieś się do podanego wczesenij adresu
	       			$link = base64_decode($_SESSION['target']);
	       			unset($_SESSION['target']);      			
	       			
	       			header("Location: ".$link);
					//print_r($_SESSION);
	       			
	       		}
	       		//NIe ma zadania - idziemy do strony glownej
	       		else{
		       		
					
	       			// go to main page
	       			header("Location: /");
	       		}
	       		exit;	       		
	    
	       	}
	       	else {
	       		// błąd przy logowaniu
	           	
				// komunikat do widoku
				$_SESSION['message']['bad_message'] = "Nieprawidłowy login lub hasło. Proszę spróbować jeszcze raz.";	       		
	           	$smarty->assign('ret_post', $_POST['login_form']);
	           	
	           	// na wszelki wypadek niszczymy bieżacą sesję usera
				unset($_SESSION['user_data']);
				
	    	}
	    }
	}
}

// --------------------------------------------------------------
// Logowanie w czasie zamowienia
// --------------------------------------------------------------

if ($_REQUEST['action'] == "LoginUserForBasketBonus") {

	unset($_SESSION['user_data']);
	//Niszczymy poprzednie komunikaty
	unset($_SESSION['message']);
	
	if (!sizeof($_SESSION['user_data'])) {
		
		if (sizeof($_POST['login_form'])) {
			
			// niezalogowany i podano dane do autoryzacji
			
			$user_details = $user->loginUser($_POST['login_form']);
			
			
	       	if (sizeof($user_details)) {
	           	
	           	// logged correct
	       		$_SESSION['user_data'] = $user_details;
	       		$smarty->assign('user_data', $_SESSION['user_data']);
	       		
	       		// Łączymy koszyki - z sesji oraz użytkownika
	       		require_once ('Basket.class.php');
				$basket = new Basket();
	       		
	       		$basket->mergeBasket($_SESSION['user_data']['id'], session_id());
	       		
	       		$_SESSION['message']['good_message'] = "Zostałeś zalogowany";
	       		
	       		
	       		
				//Istnieje w sesji żadanie przekierowania do url
		       if($_SESSION['target']){
		       	

	       			// przenieś się do podanego wczesenij adresu
	       			$link = base64_decode($_SESSION['target']);
	       			unset($_SESSION['target']);      			
	       			
	       			header("Location: ".$link);
					//print_r($_SESSION);
	       			
	       		}
	       		//NIe ma zadania - idziemy do strony glownej
	       		else{
		       		
					
	       			// go to main page
	       			header("Location: /");
	       		}
	       		exit;	       		
	    
	       	}
	       	else {
	       		// błąd przy logowaniu
	           	
				// komunikat do widoku
				$_SESSION['message']['bad_message'] = "Nieprawidłowy login lub hasło. Proszę spróbować jeszcze raz.";	       		
	           	$smarty->assign('ret_post', $_POST['login_form']);
	           	
	           	// na wszelki wypadek niszczymy bieżacą sesję usera
				unset($_SESSION['user_data']);
				
	    	}
	    }
	}
}

// --------------------------------------------------------------
// sending password
// -------------------------------------------------------------- 

if ($_REQUEST['action'] == "SendPassword"){
		
	
    if (sizeof($_POST['remind_form']['email'])) {
    	
    	$remind = $user->remindMeMyPassword ($_POST['remind_form']['email']);
    	
    	if ($remind) {

			
			// komunikat do widoku
			$_SESSION['message']['good_message_popup'] = "Hasło zostało wysłane.";
			$_SESSION['confirm'] = 1;
						
    	}
    	else {

    		$smarty->assign("bad_message", "Konta skojarzonego z tym adresem nie odnaleziono. Zarejestruj się.");

    	}
    }
    else{

		$smarty->assign("error", $dict_message[44]);
    }

}


			
// --------------------------------------------------------------
// Update information of user
// --------------------------------------------------------------

		//Jeśli zażdano zmiany adres email przez użytkownika
		if($_REQUEST['action'] == "UpdateUser"){
			

				
			if (sizeof($_POST['update_form'])) {
				//Sprawdzamy poprawność przesłanych danych za pomoca walidatora
				//require_once('validate_user_profile.inc.php');
	
				if (!sizeof($error['update_form'])) {
//					/print_r($_POST['update_form']);
					
					//Update do bazy
					$user->updateUser($_POST['update_form']);

					//Wyciągam zaktualizowane dane
					$user_details = $user->getUser($_SESSION['user_data']['id']);
					//print_r($user_details);
					// I napisuję je w sesji
					$_SESSION['user_data'] = $user_details;
					//Przekazuje do widoku
					$smarty->assign("user_data", $user_details);
					
					$_SESSION['message']['good_message'] = "Dane zostały zaktualizowane";
					$smarty->assign("good_message", $_SESSION['message']['good_message']);

				}
				/*
				else{
					echo"blad";	
					// błąd
					$smarty->assign("update_message", $error['user_data']['message']);
					$smarty->assign("error", $error['update_form']);
					$smarty->assign("ret_post", $_POST['update_form']);
				}
				*/
			}
			
		}

// --------------------------------------------------------------
// user profile to view
// --------------------------------------------------------------
 
if (sizeof($_SESSION['user_data'])) {
	//print_r($_SESSION['user_data']);
	$_SESSION['BasketEmail'] = $_SESSION['user_data']['email'];
	$smarty->assign("user_data", $_SESSION['user_data']);
}

    
?>