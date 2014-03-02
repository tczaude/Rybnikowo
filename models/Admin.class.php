<?php
/**
 * zarządzanie sesjami adminów
 */

require_once 'HCMailer2.class.php';
require_once 'Utils.class.php';

class Admin {
	
	var $message;
	
	/**
	 * @var object DBManager
	 */
	var $DBM;

	function Admin() {
		global $DBM;
	 	$this->DBM = $DBM;
	}
	
	/**
	 * pobiera listę adminów (posortowaną)
	 */
	
	function getAdmins($order = "surname", $direction = "asc", $page_number = 1) {
		
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		$sql = "select count(*) as ilosc from admin";
		$temp = $this->DBM->getRow($sql);
		$record_count = $temp['ilosc'];
		
		// echo $record_count."<br>";
		
		$sql = "select * from admin order by `$order` $direction";
		$sql .= " limit $offset, $limit ";
		
		// echo $sql."<hr>";
		
		$list_temp = $this->DBM->getTable($sql);
		
		if($list_temp){
			
			$admin_list = array();
			
			foreach ($list_temp as $admin){
				
				
				
				$sql = "select * from author where id = '$admin[wtz]'";
				$admin['author'] = $this->DBM->getRow($sql);
				$admin_list[$admin[id]] = $admin;
			}
			
			
		}
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParameters($record_count, $page_number);
		}
		//print_r($admin_list);
		return $admin_list;
	}
	
	/**
	 * pobiera przefiltrowaną listę uzytkowników
	 */
	
	function getAdminsSearch($order = "surname", $direction = "asc", $search_form, $page_number = 1) {
		
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		$sql = "select * from admin where 1=1 ";
		$sql_count = "select count(*) as ilosc from admin where 1=1 ";
		
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
			
			if ($search_form['language'] != -1) {
				$sql .= " AND language = ".$search_form['language']." ";
				$sql_count .= " AND language = ".$search_form['language']." ";
			}
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
	
	function loginAdmin($login_form) {
		
		global $dict_templates;
		
		if (sizeof($login_form)) {
			
			// sprawdzamy czy jest taki admin
			$sql = "select * from admin where email = '$login_form[login]' and password = '$login_form[password]' and status = 1";
			$admin_details = $this->DBM->getRow($sql);
			
			return $admin_details;
		}
	}
	
	/**
	 * wybiera dane admina na podstawie identyfikatora
	 */
	
	function getAdmin ($admin_id) {
		
		global $dict_templates;
		
		if ($admin_id) {
			$sql = "select * from admin where id = '$admin_id'";
			$admin_details = $this->DBM->getRow($sql);
			
			return $admin_details;
		}
	}
	
	/**
	 * write admin login in log database
	 */
	
	function writeAdminLogin ($admin_id) {
		if ($admin_id) {
			
			$date_now = date("Y-m-d H:i:s", time());
			
			$sql = "insert into admin_login (admin_id, login_date) values ('$admin_id', '$date_now')";
			$this->DBM->modifyTable($sql);
			
			// update log in counter and last log in date
			$sql = "update admin set login_count = login_count + 1, last_login = '$date_now' where id = '$admin_id'";
			$this->DBM->modifyTable($sql);
		}
	}
	
	
	/**
	 * ustawia flagę statusu dla admina
	 */
	
	function setStatus ($admin_id, $status) {
		
		if ($admin_id) {
			$sql = "update admin set status = '$status' where id = '$admin_id'";
			$this->DBM->modifyTable($sql);
			
			/*
			// jeżeli status ustawiliśmy na 1 (aktywny) to wysyłamy maila z informacją o aktywacji konta
			if ($status == 1) {
				$this->sendActivationMessage($admin_id);
			}
			*/
		}
	}
	
	/**
	 * usuwa pracodawcy status admina
	 */
	
	function unsetAdmin($employer_id) {
		
		$sql = "update employer set admin = 0 where id = '$employer_id'";
		$rv = $this->DBM->modifyTable($sql);
		
		return $rv;
	}
	
	/**
	 * aktualizacja danych admina
	 */
	
	function updateAdmin($admin_data) {
		
		global $__CFG;
		global $dict_message;
		
		if (sizeof($admin_data)) {
//			/print_r($admin_data);
			// admin może chcieć zmienić adres email - musimy sprawdzić, czy ma taką możliwość
			if ($admin_data['email'] != $admin_data['email_old']) {
				
				// sprawdzamy, czy taki email nie istnieje w naszej bazie
				$sql = "select * from admin where email = '$admin_data[email]' and id != '$admin_data[admin_id]'";
				$details = $this->DBM->getRow($sql);
				
				if (sizeof($details)) {
					// taki email jest wykorzystywany przez innego admina, więc nie możemy go wykorzystać
					$this->message = $dict_message['34'];
					
					// zmieniamy adres na stary
					$admin_data['email'] = $admin_data['email_old'];
				}
			}
			
			$sql = "update admin set name = '$admin_data[name]', surname = '$admin_data[surname]', company = '$admin_data[company]', nip = '$admin_data[nip]', email = '$admin_data[email]', password = '$admin_data[password]', street = '$admin_data[street]', zipcode = '$admin_data[zipcode]', city = '$admin_data[city]', country = '$admin_data[country]', phone = '$admin_data[phone]', mobile = '$admin_data[mobile]', fax = '$admin_data[fax]', language = '$admin_data[language]', level = '$admin_data[level]', newsletter = '$admin_data[newsletter]', district = '$admin_data[district]' where id = '$admin_data[id]'"; 
			$this->DBM->modifyTable($sql);
			
			// echo $sql;
			
			if (!$this->message) {
				// dane zostały pomyślnie zmodyfikowane
				$this->message = $dict_message['4'];
			}
			
			return $admin_data['id'];
		}
	}
	
	/**
	 * rejestracja admina - pierwszy krok
	 */
	
	function registerAdmin($register_form) {
		
		global $__CFG;
		
		if (sizeof($register_form)) {
			//print_r($register_form);
			$register_form['hashkey'] = md5(time());
			
			$sql  = " insert into admin (name, surname, company, nip, email, password, street, zipcode, city, country, phone, mobile, fax, language, level, newsletter, status, hashkey, date_created, name_01, surname_01, company_01, street_01, zipcode_01, city_01) values ";
			$sql .= " ('$register_form[name]', '$register_form[surname]', '$register_form[company]', '$register_form[nip]', '$register_form[email]', '$register_form[password]', '$register_form[street]', '$register_form[zipcode]', '$register_form[city]', '$register_form[country]', '$register_form[phone]', '$register_form[mobile]', '$register_form[fax]', 1, 1, '$register_form[newsletter]', 0, '$register_form[hashkey]', now(), '$register_form[name_01]', '$register_form[surname_01]', '$register_form[company_01]', '$register_form[street_01]', '$register_form[zipcode_01]', '$register_form[city_01]') ";
			
			$this->DBM->modifyTable($sql);
			
			// identyfikator świeżo dodanego admina
			$admin_id = $this->DBM->lastInsertID;
			
			$this->sendConfirmRegistration ($register_form);
			
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
			
			// creates link - is it possible removing admin this way ??
			// $link = $base_url."register.php?action=RemoveAdmin&email=".$admin_form[email]."&hashkey=".$admin_form[hashkey];
			
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
	 * dodanie nowego admina (administracja)
	 */
	
	function saveAdmin ($admin_form) {
		global $__CFG;
		//print_r($__CFG);
		if (sizeof($admin_form)) {
			

			
			if (!$admin_form['id']) {

				//Jeśli nowa kategoria główna - nowa metryka wraz z kolejnoscia
				$sql = "insert into `admin` (name, surname, email, password, wtz, status, level, language) values ('$admin_form[name]', '$admin_form[surname]', '$admin_form[email]', '$admin_form[password]', '$admin_form[wtz]', '$admin_form[status]', '$admin_form[level]', '1' )";
				$rv = $this->DBM->modifyTable($sql);
				$admin_id = $this->DBM->lastInsertID;
				
			}
			else {
				
				// aktualizacja kategorii
				$sql = "update `admin` set name = '$admin_form[name]', surname = '$admin_form[surname]', email = '$admin_form[email]', password = '$admin_form[password]', wtz = '$admin_form[wtz]', status = '$admin_form[status]', level = '$admin_form[level]', language = '1' where id = '$admin_form[id]'";				
				$rv = $this->DBM->modifyTable($sql);
				$admin_id = $admin_form['id'];
		
			
			}

			return $admin_id;
		}
	}
		
	/**
	 * confirming admin registration - second step of registration process
	 */
	
	function confirmAdminRegistration ($hashkey) {
		
		if ($hashkey) {
			
			// get admin details
			$sql = "select * from admin where hashkey = '$hashkey'";
			$admin_details = $this->DBM->getRow($sql);
			
			// don't register again if admin is registered (status == 1)
			if (sizeof($admin_details) && $admin_details['status'] == 0) {
			
				// update admin status (active)
				$sql = "update admin set status = 1 where hashkey = '$hashkey'";
				$this->DBM->modifyTable($sql);
				
				
				
				// send mail with registration confirmation
				//$this->sendMailWithConfirmation($admin_details['email'], $hashkey);
				//$this->sendActivationMessage($admin_details['id']);
				return true;
			}
		}
	}
	
	/**
	 * get admin by email
	 */
	
	function getAdminByEmail ($email) {
		if ($email) {
			
			$sql = "select * from admin where email = '$email'";
			$admin_details = $this->DBM->getRow($sql);
			
			return $admin_details;
		}
	}
	
	/**
	 * sprawdza czy wśród kont adminów nie ma już takiego maila
	 */
	
	function checkIfEmailExists ($email) {
		
		if ($email) {
			
			// sprawdzamy adminów
			$sql = "select * from admin where lower(email) = lower('$email')";
			$admin_details = $this->DBM->getRow($sql);
			
			if (sizeof($admin_details)) {
				// istnieje taki admin
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
	 * wysyła maila z informacją o nowej rejestracji - do administratora
	 */
	 
	function sendRegistrationToAdmin ($register_form) {
		
		global $_contact_mails;
		global $_mail_params;
		global $dict_templates;
		global $base_url;
		global $__CFG;
		global $smarty;
		
		if (sizeof($register_form)) {
			
			$mailing = array();
			
			// treść maila
			$mailing['content']  = $dict_templates['NewRegistrationContent'];
			
			$mailing['content'] .= $dict_templates['NewRegistrationWho']." : ".$register_form['name']." ".$register_form['surname']."<br/>";
			$mailing['content'] .= $dict_templates['AdminCompany']." : ".$register_form['company']."<br/>";
			$mailing['content'] .= $dict_templates['AdminEmail']." : ".$register_form['email']."<br/>";
			
			$mailing['title'] = $dict_templates['NewRegistrationTitle'];
			
			$smarty->assign("mailing", $mailing);
			
			$content = $smarty->fetch("mailing_template.tpl");
			
			$mail_data['html_body'] = $content;
			
			$mail_data['headers']['MIME-Version']= '1.0';
			$mail_data['headers']['Subject'] = $dict_templates['NewRegistrationSubject']." (".$register_form['name']." ".$register_form['surname'].")";
			$mail_data['headers']['From'] = Utils::prepareSubjectBase64($__CFG['newsletter_mail_name'])." <".$__CFG['newsletter_mail_address'].">";
			// $mail_data['headers']['To'] = $__CFG['from_mail_address'];
			$mail_data['headers']['Reply-To'] = Utils::prepareSubjectBase64($__CFG['newsletter_mail_name'])." <".$__CFG['newsletter_mail_address'].">";
			$mail_data['headers']['Date'] = date("r",time());
			
			require_once 'HCMailer2.class.php';
			
			// wybieramy listę administratorów z danego języka
			$sql = "select * from admin where language = '$register_form[language]' and status = 1 and level = 4";
			$admins = $this->DBM->getTable($sql);
			
			if (sizeof($admins)) {
				
				foreach ($admins as $admin) {
					
					$mail_data['headers']['To'] = $admin['email'];
					
					$mailerek = new HCMailer2($mail_data);
					$mailerek->sendMailMime();
				}
			}
			
			return true;
		}
		else {
			return false;
		}
	}
	
	
	/**
	 * password's reminder
	 */
	
	function remindMeMyPassword ($email) {
		
		if ($email) {
			
			// szukamy hasła dla podanego adresu email
			$sql = "select password from admin where email = '$email'";
			$details = $this->DBM->getRow($sql);
			$password = $details['password'];
			
			// echo $sql."\n";
			
			if ($password) {
				// send password
				$this->sendPasswordToAdmin ($email, $password);
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
	 * send password to admin
	 */
	
	function sendPasswordToAdmin ($email, $password) {
		
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
	 * send message to admin about activation
	 */
	
	function sendActivationMessage ($admin_id) {
		
		global $_contact_mails;
		global $_mail_params;
		global $dict_templates;
		global $base_url;
		global $__CFG;
		global $smarty;
		
		if ($admin_id) {
			
			// dane admina
			$sql = "select * from admin where id = '$admin_id'";
			$admin_details = $this->DBM->getRow($sql);
			
			if (sizeof($admin_details)) {
			
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
				$mail_data['headers']['To'] = $admin_details['email'];
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
	 * usuwa admina z systemu
	 */
	
	function removeAdmin ($admin_id) {
		
		if ($admin_id) {
			
			$sql = "delete from admin where id = '$admin_id'";
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