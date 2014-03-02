<?php
	
	require_once('Utils.class.php');
	
	$error = array();
	

	if (!$_POST['comment_form']['content']) {
		$error['comment_form']['content'] = "Pusty komentarz jest bez sensu ;-)";
	}
	
	if (!$_POST['comment_form']['name']) {
		$error['comment_form']['name'] = "Przedstaw się proszę";
	}	
	
	if (!$_POST['comment_form']['captcha']) {
		$error['comment_form']['captcha'] = "Wpisz kod";
	}
	else{
		
	   if( $_SESSION['code'] == $_POST['comment_form']['captcha'] && !empty($_SESSION['code'] ) ) {
		// Insert you code for processing the form here, e.g emailing the submission, entering it into a database. 
	   }
	   else{
	   	
	   	$error['comment_form']['captcha'] = "Niepoprawny kod";
	   	
	   }
		
   }
	
		



	
	
?>