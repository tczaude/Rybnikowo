<?
/**
 * @copyright Copyright code13 (c) 2005
 * @author Dawid Makowski (vinetou@code13.pl)
 * @see http://www.code13.pl
 *
 * Created on 2005-07-16
 * 
 */

require_once 'HCMailer2.class.php';
require_once 'Utils.class.php';

class Contact {
	
	/**
	 * @var object DBManager
	 */
	var $DBM;
	
	function Contact() {
		global $DBM;
	 	$this->DBM = $DBM;
	}
	
	/**
	 * get contacts list (sorted)
	 */
	
	function getContacts($order = "date_created", $direction = "desc", $page_number = 1) {
		
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		$sql = "select count(*) as ilosc from contact";
		$temp = $this->DBM->getRow($sql);
		$record_count = $temp['ilosc'];
		
		// echo $record_count."<br>";
		
		$sql = "select * from contact order by `$order` $direction";
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
	 * get contacts list (sorted and filtered)
	 */
	
	function getContactsSearch($order = "date_created", $direction = "desc", $search_form, $page_number = 1) {
		
		global $__CFG;
		
		$limit = $__CFG['record_count_limit'];
		$offset = ($page_number - 1) * $limit;
		
		$sql = "select * from contact where 1=1 ";
		$sql_count = "select count(*) as ilosc from contact where 1=1 ";
		
		if(sizeof($search_form)) {
			if ($search_form['surname']) {
				$sql .= " AND lower(surname) like lower('%".$search_form['surname']."%') ";
				$sql_count .= " AND lower(surname) like lower('%".$search_form['surname']."%') ";
			}
			
			if ($search_form['name']) {
				$sql .= " AND lower(name) like lower('%".$search_form['name']."%') ";
				$sql_count .= " AND lower(name) like lower('%".$search_form['name']."%') ";
			}
			
			if ($search_form['email']) {
				$sql .= " AND lower(email) like lower('%".$search_form['email']."%') ";
				$sql_count .= " AND lower(email) like lower('%".$search_form['email']."%') ";
			}
			
		}
		
		$sql .= " order by `$order` $direction ";
		$sql .= " limit $offset, $limit ";
		
		// ilość wszystkich rekordów
		$temp = $this->DBM->getRow($sql_count);
		$record_count = $temp['ilosc'];
		
		// echo $sql;
		
		$rv = $this->DBM->getTable($sql);
		
		if(isset($page_number)) {
			// przeliczamy parametry
			$this->convertPagingParameters($record_count, $page_number);
		}
		return $rv;
	}
	
	/**
	 * save new contact
	 */
	
	function saveContact ($contact_form) {
		
		global $dict_templates;
		global $_FILES;
		
		if (sizeof($contact_form)) {
			
			// bieżąca data
			$date_now = date("Y-m-d H:i:s", time());
			

			
			$sql  = "insert into contact (category, subcategory, content, email, date_created) values ";
			$sql .= " ('$contact_form[name]', '$contact_form[phone]', '$contact_form[content]', '$contact_form[email]', '$date_now') ";
			
			$this->DBM->modifyTable($sql);
			$this->sendContact($contact_form);
			
			return $this->DBM->lastInsertID;
		}
	}
	
	/**
	 * remove contact data
	 */
	
	function removeContact($contact_id) {
		$sql = "delete from contact where id = $contact_id";
		$rv = $this->DBM->modifyTable($sql);
		return $rv;
	}
	
	/**
	 * send contact mail
	 */
	
	function sendContact($contact_form)
	{
		global $_contact_mails;
		global $_mail_params;
		global $dict_templates;
		global $__CFG;
		
		// $subject = $contact_form['subject'];
		
		$content  = $dict_templates['ContactMailIntroduction'];
		$content .= "Imię i nazwisko : ".$contact_form['name']."\n";
		$content .= $dict_templates['Email']." : ".$contact_form['email']."\n";
		$content .= "Telefon : ".$contact_form['phone']."\n"."\n";
		
		$content .= $dict_templates['ContactContent']." : ".$contact_form['content']."\n";
		$content .= "\n".$dict_templates['ContactMailSummary'];
		
		$mail_data['txt_body'] = $content;
		// $mail_data['attachment'] = $contact_form['attachment_01'];
		
		// jeżeli jest załącznik, to go wysyłamy
		if ($_FILES['attachment']['name'] && $_FILES['attachment']['type'] == "image/jpeg" && $_FILES['attachment']['size'] < 150000) {
			
			$timestamp = time();
			
			// zmieniamy mu nazwę
			copy($_FILES['attachment']['tmp_name'], "/tmp/".$timestamp."_zal.jpg");
			
			$mail_data['attachment'] = "/tmp/".$timestamp."_zal.jpg";
		}
		
		$mail_data['headers']['MIME-Version']= '1.0';
		$mail_data['headers']['Subject'] = $dict_templates['ContactMailSubject'];
		$mail_data['headers']['From'] = Utils::prepareSubjectBase64($contact_form['email'])." <".$__CFG['from_mail_address'].">";  
		$mail_data['headers']['To'] = $__CFG['reply_mail_address'];
		$mail_data['headers']['Reply-To'] = Utils::prepareSubjectBase64($contact_form['name'])." <".$__CFG['from_mail_address'].">";
		$mail_data['headers']['Date'] = date("r",time());
		
		/*
		$logfilename = "./frm/log/contact-error.log";
		
		$from = Utils::prepareSubjectBase64($contact_form['name'])." <".$contact_form['email'].">";
		$reply = Utils::prepareSubjectBase64($contact_form['name'])." <".$contact_form['email'].">";
		*/
		
		// $mailer = new HCMailer($_mail_params,$logfilename,$subject,$content,$from,$__CFG['reply_mail_address'],$reply);
		
		$mailer = new HCMailer2($mail_data);
		$mailer->sendMailMime();
	}
	
	/**
	 * send mail about contact to administrator
	 */
	
	function _sendMailToAdmins($record_array)
	{
		global $_contact_mails;
		global $_mail_params;
		global $dict_templates;
		global $__CFG;
		
		// product category details
		require_once ("Product.class.php");
		$product = new Product();
		$category_details = $product->getProductCategory($record_array['interested']);
		
		$subject = $dict_templates['ContactMailSubject'];
		$content  = $dict_templates['ContactMailIntroduction'];
		
		$content .= $dict_templates['Name']." : ".$record_array['name']."\n";
		$content .= $dict_templates['Email']." : ".$record_array['email']."\n";
		$content .= $dict_templates['JobTitle']." : ".$record_array['job_title']."\n";
		$content .= $dict_templates['Organisation']." : ".$record_array['company']."\n";
		$content .= $dict_templates['Phone']." : ".$record_array['phone']."\n";
		$content .= $dict_templates['Address']." : ".$record_array['address']."\n";
		$content .= $dict_templates['ContactVia']." : ".$dict_templates['contact_via_list'][$record_array['contact_via']]."\n";
		$content .= $dict_templates['HeardAbout']." : ".$dict_templates['heard_about_list'][$record_array['heard']]."\n";
		$content .= $dict_templates['InterestedIn']." : ".$category_details['name']."\n";
		$content .= $dict_templates['Comments']." : ".$record_array['content']."\n";
		
		$content .= "\n".$dict_templates['ContactMailSummary'];
		
		$logfilename = "./frm/log/contact-error.log";
		
		$from = Utils::prepareSubjectBase64($record_array['name']." ".$record_array['surname'])." <".$record_array['email'].">";
		$reply = Utils::prepareSubjectBase64($record_array['name']." ".$record_array['surname'])." <".$record_array['email'].">";
		
		$mailer = new HCMailer($_mail_params,$logfilename,$subject,$content,$from,$__CFG['reply_mail_address'],$reply);
		$mailer->sendMail();
		
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