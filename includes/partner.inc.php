<?php
/*
 * obsługuje prezentację kategorii produktów
 */

// print_r($_SESSION);

require_once('Partner.class.php');
$partner = new Partner();



// --------------------------------------------------------------
// dodanie komentarza do partner
// --------------------------------------------------------------

	if($_REQUEST['action'] == "AddCommentPartner"){
		
		$limit = 5;
		
		//Sprawdzamy poprawnosc
		require_once('validate_partner_comment_form.inc.php');
		
    	//Jesli nie ma błędów
		if (!sizeof($error)) {
		

				$partner->saveCommentPartner($_POST['comment_form']);
				$smarty->assign("status", 1);
				$smarty->assign("partner_message", "Komentarz został pomyślnie dodany");
				//print_r($_SESSION['security_code']);		
				


		}
		//Błąd - pusta treść
		else{
			$smarty->assign("status", 2);
			$smarty->assign("error", $error['comment_form']);
			$smarty->assign("ret_post", $_POST['comment_form']);	
			$smarty->assign("error_partner", 1);
				
			
			
		}
		//print_r($_POST['partner_form']['partner_id']);
		$url_config['1'] = "zobacz";
		//$url_config['2'] = $_POST['comment_form']['partner_id'];
		
	}
	else{
		
		$smarty->assign("status", 1);
	}

//-------------------------------------------------------------
// Szczegóły partnera
//-------------------------------------------------------------
	
	if($url_config['1'] == "zobacz"){
		
		if($url_config['2']){
			
			
			$partner_details = $partner->getPartnerByUrlNameToView($url_config['2'], $_SESSION['lang']);
			
			if($partner_details){
				
				$comment_list = $partner->getCommentsByPartners($partner_details['partner_id'], 5, 1);
				$smarty->assign("comment_list", $comment_list);
				//print_r($comment_list);
				$smarty->assign("main", "main_partner_details.tpl");
				$smarty->assign("partner_details", $partner_details);
			
				//Ścieżka okruchów
				//print_r($partner_details);
				$bc = array();
				$bc['2'] = "Partner";
				$bc['2_'] = "1";
				$bc['3'] = $partner_details;
				$bc['3_'] = "0";
				$bc['4'] = "";
				$bc['4_'] = "0";			
				
				$smarty->assign("bc", $bc);
				
				//Tytuły meta
				$head = array();
				$head['title'] = $partner_details['title'];
				$head['description'] = str_replace('"', ' ', $partner_details['abstract']);
				$smarty->assign("head", $head);	
				
			}
			else{
				
				$smarty->assign("error_heading", "404 Page Not Found");
				$smarty->assign("error_message", "Podany partner nie istnieje.");
	
				
				$template = "errors/error_general.tpl";
				$smarty->display($template);
				exit;					
				
				
				
			}		
			
		}
		else{
			
			$smarty->assign("error_heading", "404 Page Not Found");
			$smarty->assign("error_message", "Nie kombinuj z url ;-).");

			
			$template = "errors/error_general.tpl";
			$smarty->display($template);
			exit;				
			
			
		}

		
	}
//--------------------------------------------------------------
// RSS
//--------------------------------------------------------------

	elseif($url_config['1'] == "rss"){
		
		$limit = 15;
		$rss_list = $partner->getPartnersByRss("date_created", "asc", 10, 1, 1);
		
		header("Content-Type: text/xml");
		$smarty->assign("rss_list", $rss_list);

		$intro_main = 23;
		require_once('includes/introduction.inc.php');
		$smarty->display("partner_rss.tpl");
		exit;
		
		
		
		
		
	}	
//-------------------------------------------------------------
// Lista partnera
//-------------------------------------------------------------
	
	elseif(!$url_config['1']){
		
		header("Location: ".$default_path."partner/lista/");
		
	}
		
	elseif($url_config['1'] == "lista"){
	
		// ustawienie numeru strony do stronicowania (jezeli nie została podana)
		if (!$url_config['2']) {
			$url_config['2'] = 1;
		}
		
		//Tytuły meta
		$head = array();
		$head['title'] = "Partner";
		$smarty->assign("head", $head);		
		
		$limit = 3;
		$partner_list = $partner->getPartnersByView("order", "desc", $limit, $url_config['2'], $_SESSION['lang']);
		//print_r($partner_list);
		$smarty->assign("main", "main_partner_list.tpl");
		$smarty->assign("partner_list", $partner_list);
		$smarty->assign("paging", $partner->paging);
	
	}
	
//-------------------------------------------------------------
// Nieznany parametr
//-------------------------------------------------------------	
	
	
	else{
		
		
			$smarty->assign("error_heading", "404 Page Not Found");
			$smarty->assign("error_message", "The page you requested was not found.");

			
			$template = "errors/error_general.tpl";
			$smarty->display($template);
			exit;		
		
		
	}

		

	
	

	
	



?>