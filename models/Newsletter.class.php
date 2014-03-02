<?php
/**
 * @copyright 
 * @author 
 * @see 
 *
 * newletter
 *
 */

require_once 'Utils.class.php';

class Newsletter {

	/**
	 * @var object DBManager
	 */
	var $DBM;

	function Newsletter() {
		global $DBM;
	 	$this->DBM = $DBM;
	}
	
	/**
	 * subcribes newsletter for given email address
	 */
	
	function subscribeNewsletter ($email, $user_id = 0) {
		
		if ($email && $user_id) {
			
			// check if email already exists in our database
			$sql = "select * from subscriber where email = '$email'";
			$subscriber_details = $this->DBM->getRow($sql);
			
			if (sizeof($subscriber_details)) {
				// given email already exists - update 
				
				$sql = "update subscriber set user_id = '$user_id' where email = '$email'"; 
				$this->DBM->modifyTable($sql);
				
			}
			else {
				
				// hash
				$hash = md5(time());
				
				// save this subscriber as unactive
				$sql = "insert into subscriber (user_id, email, date_created, status, hash) values ('$user_id', '$email', now(), 0, '$hash')";
				$this->DBM->modifyTable($sql);
				
				// send confirmation link
				//$this->sendConfirmationLinkToSubscriber ($email, $hash);

				return true;
			}
		}
	}
	
	/**
	 * send mail with confirmation link (registration)
	 */
	
	function sendConfirmationLinkToSubscriber ($email, $hash) {
		
		global $_contact_mails;
		global $_mail_params;
		global $dict_templates;
		global $base_url;
		global $__CFG;
		global $smarty;
		
		if ($email && $hash) {
			
			$mailing = array();
			
			// treść
			$mailing['content'] = $dict_templates['SubscribeNewsletterContent01'];
			
			// link do potwierdzenia rejestracji
			$link = $__CFG['base_url']."index.php?action=ConfirmNewsletterSubscription&email=".$email."&code=".$hash."#newsletter\n";
			$mailing['content'] .= "<br><br><a href='".$link."'>".$dict_templates['SubscriptionLinkText']."</a><br><br>";
			
			$mailing['content'] .= $dict_templates['SubscribeNewsletterContent02'];
			
			$mailing['title'] = $dict_templates['SubscribeNewsletterTitle'];
			
			$smarty->assign("mailing", $mailing);
			$content = $smarty->fetch("mailing_template.tpl");
			
			$mail_data['html_body'] = $content;
			
			$mail_data['headers']['MIME-Version']= '1.0';
			$mail_data['headers']['Subject'] = $dict_templates['SubscribeNewsletterSubject'];
			$mail_data['headers']['From'] = Utils::prepareSubjectBase64($__CFG['contact_mail_name'])." <".$__CFG['newsletter_mail_address'].">";
			$mail_data['headers']['To'] = $email;
			$mail_data['headers']['Reply-To'] = Utils::prepareSubjectBase64($__CFG['contact_mail_name'])." <".$__CFG['newsletter_mail_address'].">";
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
	 * confirm subscription for given email address
	 */
	
	function confirmNewsletterSubscription ($email, $hash) {
		
		if ($email && $hash) {
			
			// check if email already exists in our database
			$sql = "select * from subscriber where email = '$email' and hash = '$hash'";
			$subscriber_details = $this->DBM->getRow($sql);
			
			if (!sizeof($subscriber_details)) {
				// given email not exists in our database
				return false;
			}
			else {
				
				// check if this email isn't already confirmed
				
				if (!$subscriber_details['status']) {
					// set this subscriber as active
					$sql = "update subscriber set date_confirmed = now(), status = 1 where email = '$email'";
					$this->DBM->modifyTable($sql);
					
					// send subscription confirmation 
					//$this->sendConfirmationToSubscriber ($email, $hash);
					
					return true;
				}
				else {
					return false;
				}
			}
		}
	}
	
	/**
	 * send mail with registration confirmation
	 */
	
	function sendConfirmationToSubscriber ($email, $hash) {
		
		global $_contact_mails;
		global $_mail_params;
		global $dict_templates;
		global $base_url;
		global $__CFG;
		global $smarty;
		
		if ($email && $hash) {
			
			$mailing = array();
			
			// treść
			$mailing['content'] = $dict_templates['ConfirmSubscriptionContent01'];
			
			// link do potwierdzenia rejestracji
			$link = $__CFG['base_url']."index.php?action=UnsubscribeNewsletter&email=".$email."&code=".$hash."#newsletter\n";
			$mailing['content'] .= "<br><br><a href='".$link."'>".$dict_templates['SubscriptionRemoveLinkText']."</a>";
			
			// $mailing['content'] .= $dict_templates['ConfirmSubscriptionContent02'];
			
			$mailing['title'] = $dict_templates['ConfirmSubscriptionTitle'];
			
			$smarty->assign("mailing", $mailing);
			$content = $smarty->fetch("mailing_template.tpl");
			
			$mail_data['html_body'] = $content;
			
			$mail_data['headers']['MIME-Version']= '1.0';
			$mail_data['headers']['Subject'] = $dict_templates['ConfirmSubscriptionSubject'];
			$mail_data['headers']['From'] = Utils::prepareSubjectBase64($__CFG['contact_mail_name'])." <".$__CFG['newsletter_mail_address'].">";
			$mail_data['headers']['To'] = $email;
			$mail_data['headers']['Reply-To'] = Utils::prepareSubjectBase64($__CFG['contact_mail_name'])." <".$__CFG['newsletter_mail_address'].">";
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
	 * removes given email address from newsletter subscription
	 */
	
	function unsubscribeNewsletter ($email, $hash) {
		
		if ($email && $hash) {
			
			// check if email already exists in our database
			$sql = "select * from subscriber where email = '$email' and hash = '$hash'";
			$subscriber_details = $this->DBM->getRow($sql);
			
			if (!sizeof($subscriber_details)) {
				// given email not exists in our database
				return false;
			}
			else {
				// remove email
				$sql = "delete from subscriber where email = '$email' and hash = '$hash'";
				$this->DBM->modifyTable($sql);
				$sql = "update user set newsletter = '0' where email = '$email'";
				$this->DBM->modifyTable($sql);				
				return true;
			}
		}
	}
	
	/**
	 * get newsletters list
	 */
	
	function getNewsletters ($status = 1) {
		
		$sql = "select * from newsletter where 1 = 1 ";
		
		if ($status) {
			$sql .= " and status = '$status' ";
		}
		
		$sql .= " order by date_created desc ";
		
		$newsletter_list = $this->DBM->getTable($sql);
		
		return $newsletter_list;
	}
	
	/**
	 * get single newsletter
	 */
	
	function getNewsletter($newsletter_id) {
		
		// get newsletter
		if ($newsletter_id) {
			$sql = "select * from newsletter where id = $newsletter_id";
			$newsletter_details = $this->DBM->getRow($sql);
			
			$newsletter_details = $this->getSectionsForNewsletter($newsletter_details);
			
			return $newsletter_details;
		}
	}
	
	/**
	 * gets sections for newsletter
	 */
	
	function getSectionsForNewsletter ($newsletter_details) {
		
		if (sizeof($newsletter_details)) {
			
			// get sections
			$sql = "select * from newsletter_section where newsletter_id = '$newsletter_details[id]' order by id asc";
			$sections = $this->DBM->getTable($sql);
			
			if (sizeof($sections)) {
				foreach ($sections as $section) {
					$newsletter_details['sections'][] = $section['article_id'];
				}
			}
		}
		
		return $newsletter_details;
	}
	
	/**
	 * save newsletter
	 */
	
	function saveNewsletter($newsletter_details) {
		
		if (!$newsletter_details['id']) {
			
			// new newsletter
			
			$sql  = " insert into newsletter (name, date_created, status) values ('$newsletter_details[name]', now(), '$newsletter_details[status]') ";
		}
		else {
			
			// update newsletter
			
			$sql  = " update newsletter set name = '$newsletter_details[name]', status = '$newsletter_details[status]' where id = $newsletter_details[id] ";
			$newsletter_id = $newsletter['id'];		
		}
		
		$rv = $this->DBM->modifyTable($sql);
		
		if (!$newsletter_details['id']) {
			$newsletter_id = $this->DBM->lastInsertID;
		}
		else {
			$newsletter_id = $newsletter_details['id'];
		}
		
		// save sections (update only)
		if ($newsletter_id) {
			$this->saveSectionsForNewsletter($newsletter_id, $newsletter_details);
		}
		
		return $newsletter_id;
	}
	
	/**
	 * save sections for newsletter
	 */
	
	function saveSectionsForNewsletter ($newsletter_id, $newsletter_details) {
		
		if ($newsletter_id && sizeof($newsletter_details)) {
			
			// delete previous sections layout
			$sql = "delete from newsletter_section where newsletter_id = '$newsletter_id'";
			$this->DBM->modifyTable($sql);
			
			// save new layout
			if (sizeof($newsletter_details['sections'])) {
				foreach ($newsletter_details['sections'] as $article_id) {
					if ($article_id) {
						$sql = "insert into newsletter_section (newsletter_id, article_id) values ('$newsletter_id', '$article_id')";
						$this->DBM->modifyTable($sql);
					}
				} 
			}
		}
	}
	
	/**
	 * remove newsletter
	 */
	
	function removeNewsletter($newsletter_id) {
		
		// remove newsletter
		if ($newsletter_id) {
			
			// remove main 
			$sql = "delete from newsletter where id = '$newsletter_id'";
			$this->DBM->modifyTable($sql);
			
			// remove sections
			$sql = "delete from newsletter_section where newsletter_id = '$newsletter_id'";
			$this->DBM->modifyTable($sql);
		}
	}
	
	/**
	 * gets data for newsletter (sections etc.)
	 */
	
	function getDataForNewsletter ($newsletter_id, $lang_id) {
		
		global $dict_templates;
		
		if ($newsletter_id && $lang_id) {
			
			// get articles
			$sql = "select article.category_id, article.pic_01, article_multilang.* from article,  article_multilang, newsletter_section where article_multilang.article_id = article.id and newsletter_section.article_id = article_multilang.article_id and newsletter_section.newsletter_id = '$newsletter_id' and article_multilang.language_id = '$lang_id' order by newsletter_section.id asc";
			$data = $this->DBM->getTable($sql);
			
			// print_r($data);
			
			if (sizeof($data)) {
				
				// first article goes to introduction
				$newsletter_data['introduction'] = $data[0];
				// set script name
				$newsletter_data['introduction']['script_name'] = $dict_templates['category_script'][$data[0]['category_id']];
				
				
				// other articles (except first one) goes to sections
				foreach ($data as $key => $article) {
					if ($key) {
						$article['script_name'] = $dict_templates['category_script'][$article['category_id']];
						$newsletter_data['sections'][] = $article;
					}
				}
				

				
				
			}

			
			// get promotions
			
			//Obliczamy wiadomosci tylko z ostatnich dwóch tygodni
			$date_limit = date("Y-m-d H:i:s", time() - 1209600);
			
			require_once('Product.class.php');
			$product = new Product();		
			//Promocje
			$limit_promotion = 6;
			$page_number_promotion = 1;
			$info_data = $product->getProductsByPromotionForNewsletter($limit_promotion, $_SESSION['lang']);			
			
			if($info_data){
				
				$newsletter_data['products'] = $info_data;
				
			}
			//print_r($newsletter_data);
			//exit;	
				
			return $newsletter_data;
			
		}
	}
	
	/**
	 * gets subscribers list
	 */
	
	function getSubscribers ($lang_id, $group_id) {
		
		if ($lang_id) {
			
			if (!$group_id) {
				
				// wybieramy z niezarejestrowanych
				$sql  = "select * from subscriber where 1 = 1 order by email asc";
			}
			else {
				// wybieramy z zarejestrowanych
				$sql = "select id, email from user where newsletter = 1 order by email asc";
			}
			
			// echo $sql;
			
			$subscriber_list = $this->DBM->getTable($sql);
			
			return $subscriber_list;
		}
	}
	
	/**
	 * gets subscriber
	 */
	
	function getSubscriber ($email) {
		
		if ($email) {
			
			// wybieramy z niezarejestrowanych
			$sql  = "select * from subscriber where email = '$email' ";

			

			
			$subscriber = $this->DBM->getRow($sql);
			
			return $subscriber;
		}
	}
	
	function getSubscribersWithUser ($lang_id, $group_id, $dispatch_type) {
		
		if ($lang_id) {
			
			if ($dispatch_type == 2) {
				
				// wybieramy z niezarejestrowanych
				$sql  = "select * from subscriber where status = 1 order by email asc";
				$subscriber_list = $this->DBM->getTable($sql);
			}
			if ($dispatch_type == 1) {
				// wybieramy z zarejestrowanych
				$sql = "select id, email from user where newsletter = 1 order by email asc";
				$subscriber_list = $this->DBM->getTable($sql);
			}
			
			// echo $sql;
			
			
			
			return $subscriber_list;
		}
	}
	
	/**
	 * gets subscribers list
	 */
	
	function getSubscribersByFilters ($search_form) {
		
		if (sizeof($search_form)) {
			
			if ($search_form['type'] == 1) {
				
				$sql = "select user.* from user, category_visit where category_visit.user_id = user.id and category_visit.category_id = '$search_form[category_id]' and category_visit.counter > '$amount' and user.last_newsletter < '$date_delay'";
				$subscriber_list = $this->DBM->getTable($sql);
			}
			else if ($search_form['type'] == 2) {
				
				$sql = "select user.* from user, category_buy where category_buy.user_id = user.id and category_buy.category_id = '$search_form[category_id]' and category_buy.counter > '$amount' and user.last_newsletter < '$date_delay'";
				$subscriber_list = $this->DBM->getTable($sql);
			}
			else {
				$subscriber_list = $this->getSubscribers();
			}
			
			// print_r($subscriber_list);
			// echo $sql;
			
			return $subscriber_list;
		}
	}
	
	/**
	 * changes subscriber status (active/inactive)
	 */
	
	function changeSubscriberStatus ($subscriber_id, $status) {
		
		if ($subscriber_id) {
			$sql = "update subscriber set status = '$status' where id = '$subscriber_id'";
			$this->DBM->modifyTable($sql);
		}
		
	}
	
	/**
	 * removes subscriber
	 */
	
	function removeSubscriber ($subscriber_id) {
		
		$sql = "delete from subscriber where id = '$subscriber_id'";
		$this->DBM->modifyTable($sql);
	}
	
	/**
	 * create new dispatch for newsletter
	 */
	
	function saveDispatch ($dispatch) {
		
		if (sizeof($dispatch)) {
			
			// z jakiego języka zapisujemy tą wysyłkę
			$sql = "select * from language where id = '$dispatch[language]'";
			$lang = $this->DBM->getRow($sql);
			
			if (!$dispatch['id']) {
				$sql = "insert into newsletter_dispatch (newsletter_id, date, status, description, name_from, email_from, language, type) values ('$dispatch[newsletter_id]', '$dispatch[date]', '0', '$dispatch[description]', '$dispatch[name_from]', '$dispatch[email_from]', '$lang[short]', '$dispatch[type]')";
			}
			else {
				$sql = "update newsletter_dispatch set date = '$dispatch[date]', description = '$dispatch[description]', name_from = '$dispatch[name_from]', email_from = '$dispatch[email_from]', language = '$lang[short]', type = '$dispatch[type]' where id = '$dispatch[id]'";	
			}
			$this->DBM->modifyTable($sql);
			
			$dispatch_id = $this->DBM->lastInsertID;
			
			return $dispatch_id;
		}
	}
	
	/**
	 * tworzy listę odbiorców dla wysyłki konkretnego newslettera
	 * $subscribers - tablica par subscriber_id => 1
	 */
	 
	function saveSubscribersForDispatch ($dispatch_id, $subscribers) {
		
		if ($dispatch_id && sizeof($subscribers)) {
			
			// tworzymy łańcuch z listą subskrybentów
			$subscribers_string = "";
			
			if (sizeof($subscribers)) {
			
				$first = 1;
				
				foreach ($subscribers as $subscriber_id => $value) {
					
					if ($first) {
						
						if ($temp['subscribers']) {
							$subscribers_string .= "#".$subscriber_id;
						}
						else {
							$subscribers_string .= $subscriber_id;
						}
					}
					else {
						$subscribers_string .= "#".$subscriber_id;
					}
					
					$first = 0;
				}
			}
			
			// pustych łąńcuch nie przeszkadza - oznacza to tyle, że nie ma być powiązanego z tą wysyłką żadnego usera
			$sql = "update newsletter_dispatch set subscribers = '$subscribers_string' where id = '$dispatch_id'";
			$this->DBM->modifyTable($sql);
			
		}
	}
	
	/* wersja z DODAWANIEM do listy wysyłkowej
	function saveSubscribersForDispatch ($dispatch_id, $subscribers) {
		
		if ($dispatch_id && sizeof($subscribers)) {
			
			// tworzymy łańcuch z listą subskrybentów
			
			// wyciągamy dotychczasową zawartość tej listy (łańcuch identyfikatorów odbiorców przedzielonych znakami #)
			$sql = "select * from newsletter_dispatch where id = '$dispatch_id'";
			$temp = $this->DBM->getRow($sql);
			
			if ($temp['subscribers']) {
				
				// ustawiamy istniejący ciąg identyfikatorów - będziemy do niego DODAWAĆ
				$subscribers_string = $temp['subscribers'];
				
				// poza tym przygotowujemy się do sprawdzania, czy w nowym łańcuchu zaznaczonych odbiorców nie znajdują się już te, które zaznaczyliśmy wcześniej
				$details = explode("#", $temp['subscribers']);
				
				if (sizeof($details)) {
					
					$previous_subscribers = array();
					
					// reindeksujemy tablicę
					foreach ($details as $subscriber_id) {
						$previous_subscribers[$subscriber_id] = 1;
					}
				}	
			}
			else {
				
				$subscribers_string = "";
			}
			
			$first = 1;
			
			foreach ($subscribers as $subscriber_id => $value) {
				
				// nie dodajemy identyfikatorów już istniejących wcześniej
				if (!$previous_subscribers[$subscriber_id]) {
				
					if ($first) {
						
						if ($temp['subscribers']) {
							$subscribers_string .= "#".$subscriber_id;
						}
						else {
							$subscribers_string .= $subscriber_id;
						}
					}
					else {
						$subscribers_string .= "#".$subscriber_id;
					}
					
					$first = 0;
				}
			}
			
			if ($subscribers_string != "") {
				$sql = "update newsletter_dispatch set subscribers = '$subscribers_string' where id = '$dispatch_id'";
				$this->DBM->modifyTable($sql);
			}
		}
	}
	*/
	
	/**
	 * usuwa zaznaczonych odbiorców z wysyłki konkretnego newslettera
	 * $subscribers - tablica par subscriber_id => 1
	 */
	
	function removeSubscribersFromDispatch ($dispatch_id, $subscribers) {
		
		if ($dispatch_id && sizeof($subscribers)) {
			
			// tworzymy łańcuch z listą subskrybentów
			
			// wyciągamy dotychczasową zawartość tej listy (łańcuch identyfikatorów odbiorców przedzielonych znakami #)
			$sql = "select * from newsletter_dispatch where id = '$dispatch_id'";
			$temp = $this->DBM->getRow($sql);
			
			if ($temp['subscribers']) {
				
				// tworzymy tablicę z wcześniej wybranymi adresami
				$details = explode("#", $temp['subscribers']);
				
				if (sizeof($details)) {
					
					$previous_subscribers = array();
					
					// reindeksujemy tablicę
					foreach ($details as $subscriber_id) {
						$previous_subscribers[$subscriber_id] = 1;
					}
					
					// przeglądamy poprzednie adresy i wyrzucamy te, które zostały oznaczone do wyrzucenia
					
					$first = 1;
			
					foreach ($previous_subscribers as $subscriber_id => $value) {
						
						// dodajemy tylko te identyfikatory których nie ma w przekazanej do usunięcia liście
						if (!$subscribers[$subscriber_id]) {
						
							if ($first) {
								$subscribers_string .= $subscriber_id;
							}
							else {
								$subscribers_string .= "#".$subscriber_id;
							}
							
							$first = 0;
						}
					}
					
					$sql = "update newsletter_dispatch set subscribers = '$subscribers_string' where id = '$dispatch_id'";
					$this->DBM->modifyTable($sql);					
				}	
			}
			else {
				
				// nie ma nic do usuwania :-)
			}
		}
	}
	
	/**
	 * tworzy nowy numer press release
	 */
	
	function createPressReleaseNumber ($lang = "pl") {
		
		global $__CFG;
		global $dict_templates;
		
		// tutaj zapiszemy ostatni numerek oraz łąńcuch do wklejenia w temacie maila
		$numbers = array();
		
		// ostatni numerek
		$current_number = $__CFG['counter_press_release_'.$lang];
		
		// rozbijamy ostatni numerek na numer i rok
		$temp = explode("/", $current_number);
		
		// sprawdzamy rok z numerka względem bieżącego roku
		if ($temp[1] != date("Y", time())) {
			
			// ostatni numerek był z poprzedniego roku - zmmieniamy numerek na 1 i rok na bieżący
			$new_number = "1/".date("Y", time());
		}
		else {
			// zwiększamy numerek o 1
			$number = $temp[0] + 1;
			$new_number = $number."/".$temp[1];
		}
		
		$numbers['new_number'] = $new_number;
		
		// tworzymy cały łańcuch do doklejenia w temacie maila
		$subject = " - [www.rybnikowo.pl - ".$dict_templates['PressReleaseSubject']." ".$new_number."]";
		
		$numbers['subject'] = $subject;
		
		return $numbers;
	}
	
	/**
	 * send dispatch to all subscribers
	 */
	
	function sendNewsletterDispatch ($dispatch_id) {
		
		if ($dispatch_id) {
			
			// get dispatch details
			$sql = "select * from newsletter_dispatch where id = '$dispatch_id'";
			$dispatch_details = $this->DBM->getRow($sql);
			
			// print_r($dispatch_details);
			
			if (sizeof($dispatch_details)) {
				
				// get newsletter details
				$newsletter_data = $this->getDataForNewsletter($dispatch_details['newsletter_id'], $_SESSION['lang']);


				
				// tworzymy nowy numer press release dla tej wysyłki - dla konkretnego języka
				// numer dostajemy od razu z całym tekstem który dokłejamy do tematu!
				if (!$dispatch_details['language']) {
					$dispatch_details['language'] = "pl";
				}
				$release_numbers = $this->createPressReleaseNumber($dispatch_details['language']);
				
				// temat (= nazwa) newslettera
				$sql = "select * from newsletter where id = '$dispatch_details[newsletter_id]'";
				$newsletter_details = $this->DBM->getRow($sql);
				
				$subject = $newsletter_details['name'].$release_numbers['subject'];
				
				// musi być przygotowana zawartość (treść) newslettera oraz lista wysyłkowa 
				
				if ($dispatch_details['subscribers']) {
					
					// lista subskrybentów zapisanych w wysyłce
					$subscriber_list = explode("#", $dispatch_details['subscribers']);
					
					// send newsletter to each subscriber
					if (sizeof($subscriber_list)) {
						
						echo "Wysylam newsletter ...<br/>";
						
						foreach ($subscriber_list as $key => $subscriber_id) {
							
							
							
							
							
							// sprawdzamy czy użytkownik w międzyczasie nie zrezygnował z newslettera, oraz ściągamy jego email
							// $sql = "select id, email, newsletter, status from user where id = '$subscriber_id'";
							$sql = "select id, email, hash from subscriber where id = '$subscriber_id'";
							$subscriber = $this->DBM->getRow($sql);
							
							if (sizeof($subscriber)) {
								
								if ($subscriber['email']) {
									

									$newsletter_data['subscriber'] = $subscriber;
									
									
									// prepare newsletter content
									$content = $this->prepareNewsletterContent($newsletter_data);
									
									
									
									// sprawdzamy jeszcze czy do danego uzytkownika nie wysyłaliśmy już w danej wysyłce newslettera
									$sql = "select * from dispatch_subscriber where dispatch_id = '$dispatch_id' and subscriber_id = '$subscriber_id'";
									$temp = $this->DBM->getRow($sql);
									
									if (!sizeof($temp)) {
										// możemy wysyłać newsletter
										require_once 'Utils.class.php';
										
										$isEmail = Utils::isEmail($subscriber['email']);
										if($isEmail){
											$this->sendNewsletterToSubscriber($content, $subscriber, $dispatch_id, $subject, $dispatch_details['name_from'], $dispatch_details['email_from']);
											// tymczasowo !
											echo $subscriber['email']." => OK<br/>";											
											
											
										}
										else{
											
											echo $subscriber['email']." => niepoprawny adres email<br/>";
										}

									}
									else {
										echo $subscriber['email']." => na ten adres już wysyłaliśmy<br/>";
									}
								}
								else {
									// tutaj powinniśmy zapisać coś do error-logów z danej wysyłki
									// user zrezygnował z newslettera lub jest nieaktywny ...
									
									// tymczasowo !
									echo $subscriber['email']." => zrezygnowal lub nieaktywny<br/>";
								}
							}
							else {
								// tutaj powinniśmy zapisać coś do error-logów z danej wysyłki
								// nie znaleziono takiego usera ...
								
								// tymczasowo !
								echo $subscriber['email']." => ERROR<br/>";
							}
						}
						
						// jak się wszystko powiodło, to możemy ustawić wysykę jako zrealizowaną
						$sql = "update newsletter_dispatch set status = 1 where id = '$dispatch_id'";
						$this->DBM->modifyTable($sql);
						
						// i przestawiamy numerek w tablicy config_table
						$sql = "update config_table set content = '".$release_numbers['new_number']."' where name = 'counter_press_release_".$dispatch_details['language']."'";
						$this->DBM->modifyTable($sql);
						
						echo "Koniec wysyłki ...";
					}
				}
			}
		}
	}
	
	/**
	 * send newsletter to subscriber
	 */
	
	function sendNewsletterToSubscriber ($content, $subscriber, $dispatch_id, $subject = "", $name_from = "", $email_from = "") {
		
		if (sizeof($content) && sizeof($subscriber)) {
		
			global $_contact_mails;
			global $dict_templates;
			global $base_url;
			global $__CFG;
			require_once 'Utils.class.php';
			
			// czyścimy podane imię i nazwisko (name_from)
			if ($name_from) {
				$name_from = Utils::toascii_replace($name_from);
			}
			
			// czyścimy podany adres nadawcy
			if ($email_from) {
				$email_from = Utils::toascii_replace_email($email_from);
			}
			
			// personalize unsubscribe link
			// get hashcode
			// $sql = "select * from subscriber where id = '$subscriber_id'";
			// $details = $this->DBM->getRow($sql);
			
			// set content for unsubscribe message
			$content2 = str_replace("%%EMAIL_ADDRESS%%", $subscriber['email'], $content);
			// $content = str_replace("%%HASHCODE%%", $subscriber['hashkey'], $content);
			
			$mail_data['html_body'] = $content;
			// $mail_data['attachment'] = $message_form['attachment_01'];
			
			// następnie nagłówki maila
			// $logfilename = "./frm/log/contact-error.log";
			
			// czy został podany temat
			if (!$subject) {
				$subject = $dict_templates['NewsletterSubject'];
			}
			
			if ($name_from && $email_from) {
				$mail_from = Utils::prepareSubjectBase64($name_from)." <".$email_from.">";
			}
			else {
				$mail_from = Utils::prepareSubjectBase64($__CFG['newsletter_mail_name'])." <".$__CFG['newsletter_mail_address'].">";
			}
			
			// echo $mail_from;
			
			$mail_data['headers']['MIME-Version']= '1.0';
			// $mail_data['headers']['Subject'] = Utils::prepareSubjectBase64($subject);
			$mail_data['headers']['Subject'] = $subject;
			// $mail_data['headers']['From'] = Utils::prepareSubjectBase64($__CFG['newsletter_mail_name'])." <".$__CFG['newsletter_mail_address'].">";
			$mail_data['headers']['From'] = $mail_from;
			$mail_data['headers']['To'] = Utils::toascii_replace_email($subscriber['email']);
			// $mail_data['headers']['Reply-To'] = Utils::prepareSubjectBase64($__CFG['newsletter_mail_name'])." <".$__CFG['newsletter_mail_address'].">";
			$mail_data['headers']['Reply-To'] = $mail_from;
			$mail_data['headers']['Date'] = date("r",time());
			
			// print_r($mail_data);
			// echo "\n<!-- sended to : ".$subscriber['email']."-->\n";
			
			require_once 'HCMailer2.class.php';
			
			$mailerek = new HCMailer2($mail_data);
			$mailerek->sendMailMime();
			
			// save subscriber in dispatch
			$sql = "insert into dispatch_subscriber (dispatch_id, subscriber_id, date) values ('$dispatch_id', '$subscriber[id]', now())";
			$this->DBM->modifyTable($sql);
			
			// podbijamy datę ostatniej wysyłki dla usera
			/*
			$sql = "update user set last_newsletter = now() where id = '$subscriber[id]'";
			$this->DBM->modifyTable($sql);
			*/
		}
	}
	
	/**
	 * prepare content for sending as newsletter
	 */
	
	function prepareNewsletterContent ($newsletter_data) {
		
		global $smarty;
		
		if (sizeof($newsletter_data)) {

			// data
			$smarty->assign("newsletter_data", $newsletter_data);
			// we want unsubscribe content
			$smarty->assign("unsubscribe_link", 1);
			
			$content = $smarty->fetch("newsletter_template.tpl");
			
			return $content;
		}
	}
	
	/**
	 * wybiera wszystkie niewysłane wysyłki newsletterów i stara się je wysłać
	 */
	
	function sendDispatches() {
		
		// wybiera odpowiednie wysyłki
		
		$sql = "select * from newsletter_dispatch where status = 0 and date < now()";
		$dispatches = $this->DBM->getTable($sql);
		
		if (sizeof($dispatches)) {
			
			foreach ($dispatches as $dispatch) {
				echo "ID wysyłki : ".$dispatch['id']."\n";
				$this->sendNewsletterDispatch ($dispatch['id']);
				echo "koniec wysyłki : ".$dispatch['id']."\n";
			}
		}
	}
	
	/**
	 * wyciaga listę wysyłek dla danego newsletter
	 */
	 
	function getDispatches ($newsletter_id) {
		
		if ($newsletter_id) {
			
			$sql = "select * from newsletter_dispatch where newsletter_id = '$newsletter_id' order by date desc";
			$dispatches = $this->DBM->getTable($sql);
			
			return $dispatches;
		}
	}
	
	/**
	 * wyciaga pojedyncza wysyłkę (metrykę)
	 */
	
	function getDispatch ($dispatch_id) {
		
		if ($dispatch_id) {
			
			$sql = "select * from newsletter_dispatch where id = '$dispatch_id'";
			$dispatch_details = $this->DBM->getRow($sql);
			
			return $dispatch_details;
		}
	}
	
	/**
	 * usuwa wysyłkę
	 */
	
	function removeDispatch ($dispatch_id) {
		
		if ($dispatch_id) {
			$sql = "delete from newsletter_dispatch where id = '$dispatch_id' and status = 0";
			$this->DBM->modifyTable($sql);
		}
	}
	
	/**
	 * uzupełnia podaną liste subskrybentów o informację czy są powiązane z wyjściową wysyłką
	 * podana lista subskrybentów jest w standardowym formacie tablicowym
	 */
	
	function checkDispatchSubscribers($dispatch_id, $subscriber_list) {
		
		if ($dispatch_id && sizeof($subscriber_list)) {
			
			// print_r($subscriber_list);
			
			// wyciągamy powiązanych subskrybentów
			$sql = "select * from newsletter_dispatch where id = '$dispatch_id'";
			$dispatch_details = $this->DBM->getRow($sql);
			
			// print_r($dispatch_details);
			
			if (sizeof($dispatch_details)) {
				
				$subsrcibers = array();
				
				// najpierw reindeksujemy przekazaną tablicę subskrybentów
				foreach ($subscriber_list as $details) {
					$subscribers[$details['id']] = $details;
				}
				
				// następnie reindeksujemy tablicę z powiązanymi
				$related = explode("#", $dispatch_details['subscribers']);
				foreach ($related as $details) {
					$rel[$details] = 1;
				}
				
				
				/*
				$related = array();
				
				foreach ($temp as $key => $value) {
					$related[$value] = 1;
				}
				*/
				
				// print_r($subscribers);
				
				/*
				// następnie dla każdego powiązanego subskrybenta oznaczamy go w tablicy ze wszystkimi subskrybentami
				foreach ($related as $details) {
					if ($details) {
						$subscribers[$details]['selected'] = 1;
					}
				}
				*/
				
				// następnie dla każdego wyjściowego subskrybenta sprawdzamy, czy był oznaczony w wysyłce
				foreach ($subscribers as $key => $subscriber) {
					if ($rel[$subscriber[id]]) {
						$subscribers[$key]['selected'] = 1;
					}
				}
				
				// zwracamy przygotowaną tablicę
				return $subscribers;
			}
			else {
				// zwracamy pierwotną tablicę
				return $subscriber_list;
			}
		}
		else {
			// zwracamy pierwotną tablicę (nawet jeżeli była pusta!)
			return $subscriber_list;
		}
	}
	
	/**
	 * uruchamia codzienny mailing z informacją o nowych materiałach 
	 */
	 
	function startDailyMailing () {
		
		global $dict_templates;
		
		// dzisiejszy dzień tygodnia
		$day_of_week = date("w", time());
		
		// dzisiejsza data
		$date_now = date("Y-m-d", time());
		
		// wybieramy wszystkich użytkowników, którzy chcieli mieć dzisiaj przesłaną informację
		$sql = "select * from user where newsletter = 1 and substring(newsletter_day, $day_of_week, 1) = 1 ";
		$user_list = $this->DBM->getTable($sql);
		
		if (sizeof($user_list)) {
			
			// sprawdzamy każdego usera oddzielnie, bo może mieć inną datę ostatniej wysyłki materiałów
			foreach ($user_list as $user) {
				
				// wybieramy wszystkie NOWE materiały od daty ostatniej wysyłki (indywidualnej dla niego) lub daty rejestracji
				$sql  = "select stuff.product_id, stuff.type, count(*) as amount from stuff, stuff_multilang, product_multilang where stuff_multilang.stuff_id = stuff.id and stuff.product_id = product_multilang.product_id and stuff_multilang.language_id = '$user[language]' and product_multilang.language_id = '$user[language]' and stuff_multilang.access <= '$user[level]' and stuff_multilang.date_add >= '$user[last_mailing]' and stuff_multilang.date_add < '$date_now' and stuff_multilang.status = 1 and product_multilang.status = 1 ";		
				$sql .= " group by stuff.product_id, stuff.type";
				
				// echo $sql."\n\n";
				
				$stuffs = $this->DBM->getTable($sql);
				
				// print_r($stuffs);
				// exit();
				
				// jeżeli znaleźliśmy jakieś materiały, to przygotowujemy maila
				if (sizeof($stuffs)) {
					
					$stuffs_temp = array();
					
					// pierwsze przejście - rodzielenie materiałów
					foreach ($stuffs as $key => $details) {
						
						$type = $dict_templates['stuff_type'][$details['type']];
						
						$stuffs_temp[$details['product_id']][$type] = $details['amount'];
					} 
					
					// print_r($stuffs_temp);
					// exit();
					
					// drugie przejście - ustalenie nazw produktów i formatów
					if (sizeof($stuffs_temp)) {
						
						$stuff_list = array();
						
						foreach ($stuffs_temp as $product_id => $types) {
							
							// wybieramy nazwę produktu
							$sql = "select product_multilang.title as title_main, format from product, product_multilang where product_multilang.product_id = product.id and product.id = '$product_id' and product_multilang.language_id = '$user[language]'";
							$product = $this->DBM->getRow($sql);
							
							$stuff_list[$product['title_main']]['id'] = $product_id;
							
							foreach ($types as $type_id => $amount) {
								
								$format = $dict_templates['product_format'][$product['format']];
								
								$stuff_list[$product['title_main']][$format][$type_id] = $amount;
							}
						}
					}
					
					$done = false;
					
					// if (strtolower($user['email']) == "bartosz.antoniak@cdprojekt.com" || strtolower($user['email']) == "krzysztof.szarski@cdprojekt.com" || strtolower($user['email']) == "cubitus@code13.pl") {
					// if (strtolower($user['email']) == "cubitus@code13.pl") {
						
					$done = $this->sendMailingToUser($user, $stuff_list);
					echo "wysyłka do => ".$user['email']."\n\n";
						
						// print_r($stuff_list);	
					// }
					
					
					
					// testowo !!!
					// $done = true;
					
					if ($done) {
						// przestawiamy datę ostatniej wysyłki na dzisiejszą datę
						$sql = "update user set last_mailing = '$date_now' where id = '$user[id]' ";
						$this->DBM->modifyTable($sql);
						
						// echo $sql."<br/>";
					}
				}
			}
		}
		
	} 
	
	/* STARA WERSJA - inny format danych o materiałach
	function startDailyMailing () {
		
		global $dict_templates;
		
		// dzisiejszy dzień tygodnia
		$day_of_week = date("w", time());
		
		// dzisiejsza data
		$date_now = date("Y-m-d", time());
		
		// wybieramy wszystkich użytkowników, którzy chcieli mieć dzisiaj przesłaną informację
		$sql = "select * from user where newsletter = 1 and substring(newsletter_day, $day_of_week, 1) = 1 ";
		$user_list = $this->DBM->getTable($sql);
		
		if (sizeof($user_list)) {
			
			// sprawdzamy każdego usera oddzielnie, bo może mieć inną datę ostatniej wysyłki materiałów
			foreach ($user_list as $user) {
				
				// wybieramy wszystkie NOWE materiały od daty ostatniej wysyłki (indywidualnej dla niego) lub daty rejestracji
				$sql  = "select stuff.type, stuff.date_created, stuff.file_01, stuff.file_02, stuff_multilang.* from stuff, stuff_multilang where stuff_multilang.stuff_id = stuff.id and stuff_multilang.language_id = '$user[language]' and stuff_multilang.access <= '$user[level]' and stuff_multilang.date_add >= '$user[last_mailing]' and stuff_multilang.date_add < '$date_now' ";		
				$sql .= " order by stuff_multilang.date_add desc limit 30";
				
				$stuff_list = $this->DBM->getTable($sql);
				
				// jeżeli znaleźliśmy jakieś materiały, to przygotowujemy maila
				if (sizeof($stuff_list)) {
					
					$stuff_list_categories = array();
					
					// przygotowujemy podział na kategorie
					foreach ($stuff_list as $key => $details) {
						$stuff_list_categories[$dict_templates['stuff_type'][$details['type']]][] = $details;
					} 
					
					$done = false;
					
					if (strtolower($user['email']) == "bartosz.antoniak@cdprojekt.com") {
						// $done = $this->sendMailingToUser($user, $stuff_list_categories);
						echo "wysyłka do => ".$user['email']." - ".sizeof($stuff_list)." materiałów <br/>";	
					}
					
					
					
					// testowo !!!
					// $done = true;
					
					if ($done) {
						// przestawiamy datę ostatniej wysyłki na dzisiejszą datę
						$sql = "update user set last_mailing = '$date_now' where id = '$user[id]' ";
						// $this->DBM->modifyTable($sql);
						
						// echo $sql."<br/>";
					}
				}
			}
		}
		
	}
	*/
	
	/**
	 * wysyłamy mailing do usera z listą ostatnio dodanych materiałów
	 */
	
	function sendMailingToUser ($user, $stuff_list) {
		
		global $_contact_mails;
		global $_mail_params;
		global $dict_templates;
		global $base_url;
		global $__CFG;
		global $smarty;
		
		if (sizeof($user) && sizeof($stuff_list)) {
			
			// print_r($stuff_list);
			
			$mailing = array();
			
			// tytuł
			$mailing['title'] = $dict_templates['MailingNewStuffTitle'];
			
			// wstęp do treści maila
			$mailing['content']  = $dict_templates['MailingNewStuffContent']."<br/><br/>";
			
			// nowe materiały
			$mailing['stuff_list'] = $stuff_list;
			
			$smarty->assign("mailing", $mailing);
			$content = $smarty->fetch("mailing_new_stuff_template.tpl");
			
			$mail_data['html_body'] = $content;
			
			$mail_data['headers']['MIME-Version']= '1.0';
			$mail_data['headers']['Subject'] = $dict_templates['MailingNewStuffSubject'];
			$mail_data['headers']['From'] = Utils::prepareSubjectBase64($__CFG['newsletter_mail_name'])." <".$__CFG['newsletter_mail_address'].">";
			$mail_data['headers']['To'] = $user['email'];
			$mail_data['headers']['Reply-To'] = Utils::prepareSubjectBase64($__CFG['newsletter_mail_name'])." <".$__CFG['newsletter_mail_address'].">";
			$mail_data['headers']['Date'] = date("r",time());
			
			require_once 'HCMailer2.class.php';
				
			$mailerek = new HCMailer2($mail_data);
			$mailerek->sendMailMime();
			
			echo $user['email']." => OK<br/>";
			
			return true;
		}
 	}
	
	/**
	 * importuje subskrybentów z pliku CSV
	 */
	
	function importSubscribersFromCSV ($group_id, $lang_id) {
		
		global $_FILES;
		
		if ($group_id && $lang_id) {
			
			$fp = fopen($_FILES['csv']['tmp_name'], "r");
			
			if ($fp) {
				
				$first = 1;
				
				// czytaj po linijce
				while (!feof($fp)) {
					
					// trzeba usunąć znaki końca linii!!!
			   		$email = trim(fgets($fp));
			   		
			   		// sprawdzamy, czy taki subscriber już jest
			   		
			   		if ($email) {
			   			$sql = "select * from subscriber where email = '$email'";
			   			$details = $this->DBM->getRow($sql);
			   			
			   			if (!sizeof($details)) {
			   				
			   				// nowy - dodajemy do listy
			   				
			   				$code = md5(time());
			   				$sql = "insert into subscriber (email, hash, date_created, status, group_id, language_id) values ('$email', '$code', now(), 1, '$group_id', '$lang_id')";
			   				$this->DBM->modifyTable($sql);
			   				
			   				$subscriber_id = $this->lastInsertID;
			   				
			   				
			   				/*
			   				// dodajemy adres do wysyłki
			   				
			   				if ($first) {
								$subscribers_string .= $subscriber_id;
							}
							else {
								$subscribers_string .= "#".$subscriber_id;
							}
							*/
							
							$first = 0;
									   			
						}
						else {
							// już istnieje - dodajemy go do listy wysyłkowej tylko wtedy, gdy jesgo status jest równy 1 (nie zrezygnował z newsletterów)
							// tutaj następuje zmiana koncepcji 28.11.2007 - taka sytuacja zawsze powoduje ustawienie aktywności na 1 i dodanie do listy
							
							// if ($details['status']) {
								
							// ustawiamy mu aktywność w subskrybent_csv na 1
							$sql = "update subskrybent_csv set status = 1 where email = '$email'";
							$this->DBM->modifyTable($sql);
							
							// zapisujemy do wysyłki	
							if ($first) {
								$subscribers_string .= $details['id'];
							}
							else {
								$subscribers_string .= "#".$details['id'];
							}
							$first = 0;
								
							// }
						}
			   		}
				}
				
				fclose($fp);
				
				/*
				// zapisujemy ciąg identyfikatorów
				if ($subscribers_string) {
					$sql = "update newsletter_dispatch set subscribers = '$subscribers_string', list_id = '4' where id = '$dispatch_id'";
					$this->modyfikujTabele($sql);
				}
				*/
			}
		}
	}
	
	/**
	 * usuwa subskrybentów z systemu
	 */
	
	function removeSubscribers ($subscribers) {
		
		if (sizeof($subscribers)) {
			
			foreach ($subscribers as $subscriber_id => $value) {
				
				$sql = "delete from subscriber where id = '$subscriber_id'";
				$this->DBM->modifyTable($sql);
			}
		}
	}
}
?>