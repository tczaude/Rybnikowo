<?php

require_once 'Utils.class.php';
require_once 'Mail.php';

/**
 * Podstawowa prosta klasa do wysyłania maili w UTF-8 razem z logowaniem 
 * błędów serwera SMTP do pliku
 */
 class HCMailer2 {
 
   	/**
   	 * @var array tablica z ustawieniami do wysyłki poczty (PEAR::Mail)
   	 */
   	var $mail_params = array();
   	
   	/**
   	 * @var string ustawienia factory (PEAR::Mail)
   	 */
   	var $factory = array();
   	
   	/**
   	 * @var string ścieżka do pliku z logami z błędami wysyłki
   	 */ 
   	var $logfile;
   
    /**
     * Konstruktor. Pobiera dane do ustawień wysyłki w formacie PEAR
     * @param array _mail_params parametry wysyłki poczty (PEAR)
     */
     
    var $crlf;
  	
  	function HCMailer2($mail_data) {
  	  
  	  global $_mail_params;
  	  global $_mail_factory;
  	  
	  $this->mail_params = $_mail_params;
	  $this->mail_factory = $_mail_factory;
	  $this->mail_data = $mail_data;
	  $this->crlf = "\n";
	  
	  /*
	  $this->content_type = $type;
	  $this->subject = $subject;
	  $this->body = $body;
	  $this->from = $from;
	  $this->to = $to;
	  $this->reply = $reply; 
	  $this->logfile = $logfile;
	  */
  	}
  	
  	/**
  	 * Przygotowanie wszystkich danych do maila
  	 */
  	/*
  	function prepareMail () {
  		$headers['MIME-Version']= '1.0';
  		
  		if ($this->content_type == 'html') {
			$headers['Content-type']= 'text/html; charset=iso-8859-2';
  		} else {
  			$headers['Content-type']= 'text/plain; charset=iso-8859-2';
  		}
  				
		$headers['Date']		= date('r',time());
		$headers['From']		= $this->from;
		$headers['To']			= $this->to;
		$headers['Reply-To']	= $this->reply;
		$headers['Subject']		= Utils::prepareSubjectBase64($this->subject);
		$this->headers = $headers;
	}
	*/
  	
  	/**
  	 * obsługa wysyłki zwykłego maila tekstowego, bez załączników
  	 */
  	
  	function sendMail () {
	
  		if ($mailer = &Mail::factory($this->mail_factory, $this->mail_params)) {
			$status = $mailer->send($this->mail_data['To'],  $this->mail_data['headers'],  $this->mail_data['txt_body']);
  		} 
  		else {
  			// echo 'Problemy podczas tworzenia mailera';
  		}
		
		return $status;
	}
	
	/**
	 * obsługa wysyłki maila z załącznikami oraz mieszanego txt/html
	 */
	
	function sendMailMime () {
		
		require_once 'mime.php';
  		
  		if ($mailer = &Mail::factory($this->mail_factory, $this->mail_params)) {
  			
			$mime = new Mail_mime($this->crlf);
			// tutaj jeszcze może powinniśmy ustawiać nagłówki lokalizacji ISO
			// (to co jest ustawiane w konstruktorze Mail_mime - parametr $_build_params) 
			// w zależności od tego jaką wysyłamy treść (albo wszystko pchać w UTF-8?)
						
			// tekstowa część wiadomości
			if ($this->mail_data['txt_body']) {
				$mime->setTXTBody($this->mail_data['txt_body']);
			}
			
			// jeżeli chcemy przesłać treść w HTMLu
			if ($this->mail_data['html_body']) {
				$mime->setHTMLBody($this->mail_data['html_body']);
			}
			

			
			$mime_body = $mime->get();
			$mime_headers = $mime->headers($this->mail_data['headers']);
			
			// echo "wysyłamy";
			
			$status = $mailer->send($this->mail_data['headers']['To'], $mime_headers, $mime_body);
		} 
		else {
  			//echo 'Problemy podczas tworzenia mailera';
  		}
		
		return $status;
	}
}
?>
