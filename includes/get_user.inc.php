<?php

require_once ('User.class.php');
$user = new User();
// --------------------------------------------------------------
// user registration for order
// --------------------------------------------------------------  

if ($url_config['1']) {
	
	
	//Get remote user from smartserwis.net
	$remote_user_details = $user->getRemoteUserByHashkey($url_config['1']);

	if ($remote_user_details){
		
		//Sprawdzamy czy aby na pewno user nie ma juz konta
		$check_user = $user->getUserByEmail($remote_user_details['email']);
		
		
		if ($check_user){
			//ma już konto.....
			echo "jest juz";
			
			
		}
		//automatyczna rejestracja
		else{
				
			
				
				//Generujemy hasło
				$possible = '23456789bcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPRSTWUZXV';
				$code = '';
				$i = 0;
				while ($i < 6) { 
					$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
					$i++;
				}				

				$remote_user_details['password'] = $code;
				$remote_user_details['company'] = $remote_user_details['company_name'];
				$remote_user_details['nip'] = $remote_user_details['company_nip'];

				
				$registration_id = $user->registerUserForOrder($remote_user_details);
				
						
				//Sprawdzamy czy user jest zapisany już do newslettera
				require_once ('Newsletter.class.php');
				$newsletter = new Newsletter();
				$newsletter->subscribeNewsletter($remote_user_details['email'], $registration_id);
				
				$login_form['login'] = $remote_user_details['email'];
				$login_form['password'] = $remote_user_details['password'];
				
				//Automatyczne logowanie
				$user_details = $user->loginUser($login_form);
				
				
				
		       	if (sizeof($user_details)) {
	
		           	// logged correct
		       		$_SESSION['user_data'] = $user_details;
		       		$smarty->assign('user_data', $_SESSION['user_data']);
		       		
		       		// Łączymy koszyki - z sesji oraz użytkownika
		       		require_once ('Basket.class.php');
					$basket = new Basket();
		       		
		       		$basket->mergeBasket($_SESSION['user_data']['id'], session_id());  
					
		       		$_SESSION['ImportUserMessage'] = 1;
					// komunikat do widoku
					$_SESSION['message']['good_message'] = "Konto zostało pomyślnie utworzone. Jesteś zalogowany.";		       		
		       		header("location: /konto");

		       		exit;	       		
		       		
		       		
		    
		       	}			
				

				
		}

	}
		
}
	


?>