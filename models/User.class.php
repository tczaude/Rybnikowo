<?php
/**
 * zarządzanie sesjami uzytkowników 
 */

require_once 'HCMailer2.class.php';
require_once 'Utils.class.php';

class User {
	
	var $message;
	
	/**
	 * @var object DBManager
	 */
	var $DBM;
	var $DBM2;

	function User() {
		global $DBM;
		global $DBM2;
	 	$this->DBM = $DBM;
	 	$this->DBM2 = $DBM2;
	}
	
	/**
	 * pobiera listę użytkowników (posortowaną)
	 */
	
	function getUsers($order = "surname", $direction = "asc", $page_number = 1) {
		
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		$sql = "select count(*) as ilosc from user";
		$temp = $this->DBM->getRow($sql);
		$record_count = $temp['ilosc'];
		
		// echo $record_count."<br>";
		
		$sql = "select * from user order by `$order` $direction";
		$sql .= " limit $offset, $limit ";
		
		// echo $sql."<hr>";
		
		$rv = $this->DBM->getTable($sql);
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParameters($record_count, $page_number);
		}
		
		return $rv;
	}
	
	/**
	 * pobiera listę użytkowników dla statystyk
	 */
	
	function getUsersForStat($order = "surname", $direction = "asc", $page_number = 1) {
		
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		$sql = "select count(*) as ilosc from user";
		$temp = $this->DBM->getRow($sql);
		$record_count = $temp['ilosc'];
		
		// echo $record_count."<br>";
		
		
		
		$sql = "select * from user";
		
		if($order == "order_count"){
			
			
			$sql .= " order by `$order` $direction, order_summary desc";
			
		}
		else{
			$sql .= " order by `$order` $direction";
			
			
		}
		$sql .= " limit $offset, $limit ";
		
		
		
		// echo $sql."<hr>";
		
		$rv = $this->DBM->getTable($sql);
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParameters($record_count, $page_number);
		}
		
		return $rv;
	}	
	
	/**
	 * aktualizujemy liczbe punktow bonusowych usera po transakcji
	 */	
	
	function updateBonusUser ($user_id, $bonus) {
		
		if ($user_id && $bonus) {
			$sql = "update user set bonus = '$bonus' where id = '$user_id'";
			$this->DBM->modifyTable($sql);
		}
	}
	
	/**
	 * aktualizujemy liczbe zamowień i sumaryczna wartosc
	 */	
	
	function updateSummaryUser ($user_id, $order_summary, $order_count) {
		
		if ($user_id && $order_summary && $order_count) {
			$sql = "update user set order_summary = '$order_summary', order_count = '$order_count' where id = '$user_id'";
			$this->DBM->modifyTable($sql);
		}
	}
	
	/**
	 * pobiera przefiltrowaną listę uzytkowników
	 */
	
	function getUsersSearch($order = "surname", $direction = "asc", $search_form, $page_number = 1) {
		
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		$sql = "select * from user where 1=1 ";
		$sql_count = "select count(*) as ilosc from user where 1=1 ";
		
		if(sizeof($search_form)) {
			if ($search_form['surname']) {
				$sql .= " AND lower(surname) like lower('%".$search_form['surname']."%') ";
				$sql_count .= " AND lower(surname) like lower('%".$search_form['surname']."%') ";
			}
			
			if ($search_form['name']) {
				$sql .= " AND lower(name) like lower('%".$search_form['name']."%') ";
				$sql_count .= " AND lower(name) like lower('%".$search_form['name']."%') ";
			}
			
			if ($search_form['city']) {
				$sql .= " AND lower(city) like lower('%".$search_form['city']."%') ";
				$sql_count .= " AND lower(city) like lower('%".$search_form['city']."%') ";
			}
			
			if ($search_form['country']) {
				$sql .= " AND lower(country) like lower('%".$search_form['country']."%') ";
				$sql_count .= " AND lower(country) like lower('%".$search_form['country']."%') ";
			}
			
			if ($search_form['email']) {
				$sql .= " AND lower(email) like lower('%".$search_form['email']."%') ";
				$sql_count .= " AND lower(email) like lower('%".$search_form['email']."%') ";
			}
			
			/*
			if ($search_form['status'] != -1) {
				$sql .= " AND status = ".$search_form['status']." ";
				$sql_count .= " AND status = ".$search_form['status']." ";
			}
			*/

		}
		
		$sql .= " order by `$order` $direction ";
		$sql .= " limit $offset, $limit ";
		
		// ilośc wszystkich rekordów
		$temp = $this->DBM->getRow($sql_count);
		$record_count = $temp['ilosc'];
		
		$rv = $this->DBM->getTable($sql);
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParameters($record_count, $page_number);
		}
		return $rv;
	}
	
	/**
	 * pobiera dane do logowania
	 */
	
	function loginUser($login_form) {
		
		global $dict_templates;
		
		if (sizeof($login_form)) {
			
			// sprawdzamy czy jest taki użytkownik
			$sql = "select * from user where email = '$login_form[login]' and password = '$login_form[password]' and status = 1";
			$user_details = $this->DBM->getRow($sql);
			
			return $user_details;
		}
	}
	
	/**
	 * wybiera dane usera na podstawie identyfikatora
	 */
	
	function getUser ($user_id) {
		
		global $dict_templates;
		
		if ($user_id) {
			$sql = "select * from user where id = '$user_id'";
			$user_details = $this->DBM->getRow($sql);
			
			return $user_details;
		}
	}
	
	/**
	 * write user login in log database
	 */
	
	function writeUserLogin ($user_id) {
		if ($user_id) {
			
			$date_now = date("Y-m-d H:i:s", time());
			
			$sql = "insert into user_login (user_id, login_date) values ('$user_id', '$date_now')";
			$this->DBM->modifyTable($sql);
			
			// update log in counter and last log in date
			$sql = "update user set login_count = login_count + 1, last_login = '$date_now' where id = '$user_id'";
			$this->DBM->modifyTable($sql);
		}
	}
	
	
	/**
	 * ustawia flagę statusu dla usera
	 */
	
	function setStatus ($user_id, $status) {
		
		if ($user_id) {
			$sql = "update user set status = '$status' where id = '$user_id'";
			$this->DBM->modifyTable($sql);
			
			/*
			// jeżeli status ustawiliśmy na 1 (aktywny) to wysyłamy maila z informacją o aktywacji konta
			if ($status == 1) {
				$this->sendActivationMessage($user_id);
			}
			*/
		}
	}
	
	/**
	 * aktualizacja danych użytkownika
	 */
	
	function updateUserForAdmin($user_data) {
		
		global $__CFG;
		global $dict_message;
		
		if (sizeof($user_data)) {
//			/print_r($user_data);
			// user może chcieć zmienić adres email - musimy sprawdzić, czy ma taką możliwość
			if ($user_data['email'] != $user_data['email_old']) {
				
				// sprawdzamy, czy taki email nie istnieje w naszej bazie
				$sql = "select * from user where email = '$user_data[email]' and id != '$user_data[id]'";
				$details = $this->DBM->getRow($sql);
				
				if (sizeof($details)) {
					// taki email jest wykorzystywany przez innego usera, więc nie możemy go wykorzystać
					$this->message = $dict_message['34'];
					
					// zmieniamy adres na stary
					$user_data['email'] = $user_data['email_old'];
				}
			}
			
			$sql = "update user set name = '$user_data[name]', surname = '$user_data[surname]', company = '$user_data[company]', nip = '$user_data[nip]', email = '$user_data[email]', password = '$user_data[password]', street = '$user_data[street]', zipcode = '$user_data[zipcode]', city = '$user_data[city]', country = '$user_data[country]', phone = '$user_data[phone]', mobile = '$user_data[mobile]', fax = '$user_data[fax]', language = '$user_data[language]', level = '$user_data[level]', newsletter = '$user_data[newsletter]', district = '$user_data[district]', bonus = '$user_data[bonus]' where id = '$user_data[id]'"; 
			$this->DBM->modifyTable($sql);
			
			
			
			//Sprawdzamy czy user jest zapisany już do newslettera
		
			//Zapisaine na newsletter
			if($user_data['newsletter'] == 1){
				require_once ('Newsletter.class.php');
				$newsletter = new Newsletter();	
				$newsletter->subscribeNewsletter($user_data['email'], $user_data['id']);				
				
			}
			//Wylaczenie newlettera
			else{
				
				$this->removeSubcriber($user_data['email']);
				
			}
			
			if (!$this->message) {
				// dane zostały pomyślnie zmodyfikowane
				$this->message = $dict_message['4'];
			}
			
			return $user_data['id'];
		}
	}
	
	/**
	 * aktualizacja danych użytkownika
	 */
	
	function updateUser($user_data) {
		
		global $__CFG;
		global $dict_message;
		
		if (sizeof($user_data)) {
//			/print_r($user_data);
			// user może chcieć zmienić adres email - musimy sprawdzić, czy ma taką możliwość
			if ($user_data['email'] != $user_data['email_old']) {
				
				// sprawdzamy, czy taki email nie istnieje w naszej bazie
				$sql = "select * from user where email = '$user_data[email]' and id != '$user_data[id]'";
				$details = $this->DBM->getRow($sql);
				
				if (sizeof($details)) {
					// taki email jest wykorzystywany przez innego usera, więc nie możemy go wykorzystać
					$this->message = $dict_message['34'];
					
					// zmieniamy adres na stary
					$user_data['email'] = $user_data['email_old'];
				}
			}
			
			$sql = "update user set name = '$user_data[name]', surname = '$user_data[surname]', company = '$user_data[company]', nip = '$user_data[nip]', email = '$user_data[email]', password = '$user_data[password]', street = '$user_data[street]', zipcode = '$user_data[zipcode]', city = '$user_data[city]', country = '$user_data[country]', phone = '$user_data[phone]', mobile = '$user_data[mobile]', fax = '$user_data[fax]', language = '$user_data[language]', level = '$user_data[level]', newsletter = '$user_data[newsletter]', district = '$user_data[district]' where id = '$user_data[id]'"; 
			$this->DBM->modifyTable($sql);
			
			
			
			//Sprawdzamy czy user jest zapisany już do newslettera
		
			//Zapisaine na newsletter
			if($user_data['newsletter'] == 1){
				require_once ('Newsletter.class.php');
				$newsletter = new Newsletter();	
				$newsletter->subscribeNewsletter($user_data['email'], $user_data['id']);				
				
			}
			//Wylaczenie newlettera
			else{
				
				$this->removeSubcriber($user_data['email']);
				
			}
			
			if (!$this->message) {
				// dane zostały pomyślnie zmodyfikowane
				$this->message = $dict_message['4'];
			}
			
			return $user_data['id'];
		}
	}
	
	/**
	 * rejestracja użytkownika - pierwszy krok
	 */
	
	function registerUser($register_form) {
		
		global $__CFG;
		
		if (sizeof($register_form)) {
			//print_r($register_form);
			$register_form['hashkey'] = md5(time());
			
			$sql  = " insert into user (name, surname, company, nip, email, password, street, zipcode, city, country, phone, mobile, fax, language, level, newsletter, status, hashkey, date_created, name_01, surname_01, company_01, street_01, zipcode_01, city_01) values ";
			$sql .= " ('$register_form[name]', '$register_form[surname]', '$register_form[company]', '$register_form[nip]', '$register_form[email]', '$register_form[password]', '$register_form[street]', '$register_form[zipcode]', '$register_form[city]', '$register_form[country]', '$register_form[phone]', '$register_form[mobile]', '$register_form[fax]', 1, 1, 1, 0, '$register_form[hashkey]', now(), '$register_form[name_01]', '$register_form[surname_01]', '$register_form[company_01]', '$register_form[street_01]', '$register_form[zipcode_01]', '$register_form[city_01]') ";
			
			$this->DBM->modifyTable($sql);
			
			// identyfikator świeżo dodanego usera
			$user_id = $this->DBM->lastInsertID;
			
			$this->sendConfirmRegistration ($register_form);
			
			return $user_id;
		}
	}
	
	/**
	 * rejestracja użytkownika - pierwszy krok
	 */
	
	function registerUserForOrder($register_form) {
		
		global $__CFG;
		
		if (sizeof($register_form)) {
			//print_r($register_form);
			$register_form['hashkey'] = md5(time());
			
			$sql  = " insert into user (name, surname, company, nip, email, password, street, zipcode, city, country, phone, mobile, fax, language, level, newsletter, status, hashkey, date_created, name_01, surname_01, company_01, street_01, zipcode_01, city_01) values ";
			$sql .= " ('$register_form[name]', '$register_form[surname]', '$register_form[company]', '$register_form[nip]', '$register_form[email]', '$register_form[password]', '$register_form[street]', '$register_form[zipcode]', '$register_form[city]', '$register_form[country]', '$register_form[phone]', '$register_form[mobile]', '$register_form[fax]', 1, 1, 1, 1, '$register_form[hashkey]', now(), '$register_form[name_01]', '$register_form[surname_01]', '$register_form[company_01]', '$register_form[street_01]', '$register_form[zipcode_01]', '$register_form[city_01]') ";
			
			$this->DBM->modifyTable($sql);
			
			// identyfikator świeżo dodanego usera
			$user_id = $this->DBM->lastInsertID;
			
			//$this->sendConfirmRegistration ($register_form);
			
			return $user_id;
		}
	}
	
	/**
	 * zapis usera dla administratora
	 */
	
	function saveUser($user_form) {
		
		global $__CFG;
		
		if (sizeof($user_form)) {
			//print_r($register_form);
			
			$sql = "update user set name = '$user_form[name]', surname = '$user_form[surname]', company = '$user_form[company]', nip = '$user_form[nip]', email = '$user_form[email]', password = '$user_form[password]', street = '$user_form[street]', zipcode = '$user_form[zipcode]', city = '$user_form[city]', country = '$user_form[country]', phone = '$user_form[phone]', mobile = '$user_form[mobile]', fax = '$user_form[fax]', language = '$user_form[language]', level = '$user_form[level]', newsletter = '$user_form[newsletter]', district = '$user_form[district]' where id = '$user_form[id]'"; 
			$this->DBM->modifyTable($sql);
			
			return true;
		}
	}
	
	/**
	 * send mail with confirmation link (registration)
	 */
	
	function sendConfirmRegistration ($register_form) {
		
		global $_contact_mails;
		global $_mail_params;
		global $dict_templates;
		global $base_url;
		global $__CFG;
		global $smarty;
		
		if (sizeof($register_form)) {
			
			$mailing = array();
			
			// treść maila
			$mailing['content']  = $dict_templates['PleaseConfirmRegistrationContent01']."<br/><br/>";
			$mailing['content'] .= "<a href='".$__CFG['base_url']."potwierdzenie/".$register_form['hashkey']."'> potwierdź rejestrację w serwisie www.rybnikowo.pl </a><br/><br/>";
			$mailing['content'] .= $dict_templates['PleaseConfirmRegistrationContent02'];
			
			$mailing['title']  = $dict_templates['PleaseConfirmRegistrationTitle'];
			
			$smarty->assign("mailing", $mailing);
			
			$content = $smarty->fetch("mailing_template.tpl");
			
			$mail_data['html_body'] = $content;
			
			$mail_data['headers']['MIME-Version']= '1.0';
			$mail_data['headers']['Subject'] = Utils::prepareSubjectBase64($dict_templates['PleaseConfirmRegistrationSubject']);
			$mail_data['headers']['From'] = Utils::prepareSubjectBase64($__CFG['from_mail_name'])." <".$__CFG['from_mail_address'].">";
			$mail_data['headers']['To'] = $register_form['email'];
			$mail_data['headers']['Reply-To'] = Utils::prepareSubjectBase64($__CFG['from_mail_name'])." <".$__CFG['from_mail_address'].">";
			$mail_data['headers']['Date'] = date("r",time());
			
			require_once 'HCMailer2.class.php';
			
			$mailerek = new HCMailer2($mail_data);
			$mailerek->sendMailMime();
			
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * send mail with registration confirmation
	 */
	
	function sendMailWithConfirmation ($email, $hashkey) {
		
		global $_contact_mails;
		global $_mail_params;
		global $dict_templates;
		global $base_url;
		global $__CFG;
		global $smarty;
		
		if ($email && $hashkey) {
			
			$mailing = array();
			
			// set email subject and content
			// $subject = $dict_templates['RegistrationConfirmSubject'];
			$mailing['content'] = $dict_templates['RegistrationConfirmContent01'];
			
			// creates link - is it possible removing user this way ??
			// $link = $base_url."register.php?action=RemoveUser&email=".$user_form[email]."&hashkey=".$user_form[hashkey];
			
			// $logfilename = "./frm/log/contact-error.log";
			
			$mailing['title'] = $dict_templates['RegistrationConfirmTitle'];
			
			$smarty->assign("mailing", $mailing);
			$content = $smarty->fetch("mailing_template.tpl");
			
			$mail_data['html_body'] = $content;
			
			$mail_data['headers']['MIME-Version']= '1.0';
			$mail_data['headers']['Subject'] = $dict_templates['RegistrationConfirmSubject'];
			$mail_data['headers']['From'] = Utils::prepareSubjectBase64($__CFG['newsletter_mail_name'])." <".$__CFG['newsletter_mail_address'].">";
			$mail_data['headers']['To'] = $email;
			$mail_data['headers']['Reply-To'] = Utils::prepareSubjectBase64($__CFG['newsletter_mail_name'])." <".$__CFG['newsletter_mail_address'].">";
			$mail_data['headers']['Date'] = date("r",time());
			
			require_once 'HCMailer2.class.php';
			
			$mailerek = new HCMailer2($mail_data);
			$mailerek->sendMailMime();
			
			return true;
		}
		else {
			return false;
		}
	}
		
	/**
	 * confirming user registration - second step of registration process
	 */
	
	function confirmUserRegistration ($hashkey) {
		
		if ($hashkey) {
			
			// get user details
			$sql = "select * from user where hashkey = '$hashkey'";
			$user_details = $this->DBM->getRow($sql);
			
			// don't register again if user is registered (status == 1)
			if (sizeof($user_details) && $user_details['status'] == 0) {
			
				// update user status (active)
				$sql = "update user set status = 1 where hashkey = '$hashkey'";
				$this->DBM->modifyTable($sql);
				
				
				
				// send mail with registration confirmation
				//$this->sendMailWithConfirmation($user_details['email'], $hashkey);
				//$this->sendActivationMessage($user_details['id']);
				return true;
			}
		}
	}
	
	/**
	 * get user by email
	 */
	
	function getUserByEmail ($email) {
		if ($email) {
			
			$sql = "select * from user where email = '$email'";
			$user_details = $this->DBM->getRow($sql);
			
			return $user_details;
		}
	}
	
	/**
	 * get remote user by hashkey
	 */
	
	function getRemoteUserByHashkey ($hashkey) {
		if ($hashkey) {
			
			$sql = "select * from service where hashkey = '$hashkey'";
			$user_details = $this->DBM2->getRow($sql);
			
			return $user_details;
		}
	}
	
	/**
	 * sprawdza czy wśród kont użytkowników nie ma już takiego maila
	 */
	
	function checkIfEmailExists ($email) {
		
		if ($email) {
			
			// sprawdzamy użytkowników
			$sql = "select * from user where lower(email) = lower('$email')";
			$user_details = $this->DBM->getRow($sql);
			
			if (sizeof($user_details)) {
				// istnieje taki użytkownik
				return true;
			}
			else {
				return false;
			}
			
		}
		else {
			// podano nieprawidłowy adres email
			return true;
		}
	}
	
	
	/**
	 * password's reminder
	 */
	
	function remindMeMyPassword ($email) {
		
		if ($email) {
			
			// szukamy hasła dla podanego adresu email
			$sql = "select password from user where email = '$email'";
			$details = $this->DBM->getRow($sql);
			$password = $details['password'];
			
			// echo $sql."\n";
			
			if ($password) {
				// send password
				$this->sendPasswordToUser ($email, $password);
				return true;
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}
	
	/**
	 * send password to user
	 */
	
	function sendPasswordToUser ($email, $password) {
		
		global $_contact_mails;
		global $_mail_params;
		global $dict_templates;
		global $base_url;
		global $__CFG;
		global $smarty;
		
		if ($email && $password) {
			
			$mailing = array();
			
			// treść maila
			$mailing['content']  = $dict_templates['PasswordReminderContent'];
			$mailing['content'] .= "<br>Twoje hasło to: <b>".$password."</b>";
			
			$mailing['title'] = $dict_templates['PasswordReminderTitle'];
			
			$smarty->assign("mailing", $mailing);
			
			$content = $smarty->fetch("mailing_template.tpl");
			
			$mail_data['html_body'] = $content;
			
			$mail_data['headers']['MIME-Version']= '1.0';
			$mail_data['headers']['Subject'] = $dict_templates['PasswordReminderSubject'];
			$mail_data['headers']['From'] = Utils::prepareSubjectBase64($__CFG['newsletter_mail_name'])." <".$__CFG['newsletter_mail_address'].">";
			$mail_data['headers']['To'] = $email;
			$mail_data['headers']['Reply-To'] = Utils::prepareSubjectBase64($__CFG['newsletter_mail_name'])." <".$__CFG['newsletter_mail_address'].">";
			$mail_data['headers']['Date'] = date("r",time());
			
			require_once 'HCMailer2.class.php';
			
			$mailerek = new HCMailer2($mail_data);
			$mailerek->sendMailMime();
			
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * send message to user about activation
	 */
	
	function sendActivationMessage ($user_id) {
		
		global $_contact_mails;
		global $_mail_params;
		global $dict_templates;
		global $base_url;
		global $__CFG;
		global $smarty;
		
		if ($user_id) {
			
			// dane użytkownika
			$sql = "select * from user where id = '$user_id'";
			$user_details = $this->DBM->getRow($sql);
			
			if (sizeof($user_details)) {
			
				$mailing = array();
				
				// treść maila
				$mailing['content']  = $dict_templates['ActivationMessageContent']."<br/><br/>";
				$mailing['content']  .= $dict_templates['ActivationMessageContent01'];
				
				$mailing['title'] = $dict_templates['ActivationMessageTitle'];
				
				$smarty->assign("mailing", $mailing);
				
				$content = $smarty->fetch("mailing_template.tpl");
				
				$mail_data['html_body'] = $content;
				
				$mail_data['headers']['MIME-Version']= '1.0';
				$mail_data['headers']['Subject'] = $dict_templates['ActivationMessageSubject'];
				$mail_data['headers']['From'] = Utils::prepareSubjectBase64($__CFG['newsletter_mail_name'])." <".$__CFG['newsletter_mail_address'].">";
				$mail_data['headers']['To'] = $user_details['email'];
				$mail_data['headers']['Reply-To'] = Utils::prepareSubjectBase64($__CFG['newsletter_mail_name'])." <".$__CFG['newsletter_mail_address'].">";
				$mail_data['headers']['Date'] = date("r",time());
				
				require_once 'HCMailer2.class.php';
				
				$mailerek = new HCMailer2($mail_data);
				$mailerek->sendMailMime();
				
				return true;
			}
		}
		else {
			return false;
		}
	}
	
	/**
	 * usuwa użytkownika z systemu
	 */
	
	function removeUser ($user_id) {
		
		if ($user_id) {
			
			$sql = "delete from user where id = '$user_id'";
			$this->DBM->modifyTable($sql);
		}
	}
	
	/**
	 * usuwa użytkownika z subskrypcji newslettera
	 */
	
	function removeSubcriber ($email) {
		
		if ($email) {
			
			$sql = "delete from subscriber where email = '$email'";
			$this->DBM->modifyTable($sql);
		}
	}
	
	/**
	 * przelicza wszystkie parametry do stronicowania
	 */
	
	function convertPagingParameters($record_count, $page_number) {
		
		global $__CFG;
		
		$paging = array();
		$last_page = ceil($record_count / $__CFG['record_count_limit']);
		
		// echo "last page : ".$last_page."<br>";
		
		// poprzednia strona
		if ($page_number == 1) {
			$paging['previous'] = "";
			$paging['first'] = "";
		}
		else {
			$paging['previous'] = $page_number - 1;
			$paging['first'] = "1";
		}
		
		// następna strona
		if ($page_number == $last_page) {
			$paging['next'] = "";
			$paging['last'] = "";	
		}
		else {
			$paging['next'] = $page_number + 1;
			$paging['last'] = $last_page;
		}
		
		$paging['current'] = $page_number;
		
		$this->paging = $paging;
		return $paging;
		
	}
}
?>