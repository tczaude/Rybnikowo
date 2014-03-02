<?php
/*
 * obsługuje prezentację kategorii produktów
 */

// print_r($_SESSION);

require_once('Blog.class.php');
$blog = new Blog();



// --------------------------------------------------------------
// dodanie komentarza do blog
// --------------------------------------------------------------

	if($_REQUEST['action'] == "AddCommentBlog"){
		
		$limit = 5;
		
		//Sprawdzamy poprawnosc
		require_once('validate_blog_comment_form.inc.php');
		
    	//Jesli nie ma błędów
		if (!sizeof($error)) {
		

				$blog->saveCommentBlog($_POST['comment_form']);
				$smarty->assign("status", 1);
				$smarty->assign("blog_message", "Komentarz został pomyślnie dodany");
				//print_r($_SESSION['security_code']);		
				


		}
		//Błąd - pusta treść
		else{
			$smarty->assign("status", 2);
			$smarty->assign("error", $error['comment_form']);
			$smarty->assign("ret_post", $_POST['comment_form']);	
			$smarty->assign("error_blog", 1);
				
			
			
		}
		//print_r($_POST['blog_form']['blog_id']);
		$url_config['1'] = "zobacz";
		//$url_config['2'] = $_POST['comment_form']['blog_id'];
		
	}
	else{
		
		$smarty->assign("status", 1);
	}

//-------------------------------------------------------------
// Szczegóły bloga
//-------------------------------------------------------------
	
	if($url_config['1'] == "zobacz"){
		
		if($url_config['2']){
			
			
			$blog_details = $blog->getBlogByUrlNameToView($url_config['2'], $_SESSION['lang']);
			
			if($blog_details){
				
				$comment_list = $blog->getCommentsByBlogs($blog_details['blog_id'], 5, 1);
				$smarty->assign("comment_list", $comment_list);
				//print_r($comment_list);
				$smarty->assign("main", "main_blog_details.tpl");
				$smarty->assign("blog_details", $blog_details);
			
				//Ścieżka okruchów
				//print_r($blog_details);
				$bc = array();
				$bc['2'] = "Blog";
				$bc['2_'] = "1";
				$bc['3'] = $blog_details;
				$bc['3_'] = "0";
				$bc['4'] = "";
				$bc['4_'] = "0";			
				
				$smarty->assign("bc", $bc);
				
				//Tytuły meta
				$head = array();
				$head['title'] = $blog_details['title'];
				$head['description'] = str_replace('"', ' ', $blog_details['abstract']);
				$smarty->assign("head", $head);	
				
			}
			else{
				
				$smarty->assign("error_heading", "404 Page Not Found");
				$smarty->assign("error_message", "Podany blog nie istnieje.");
	
				
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
		$rss_list = $blog->getBlogsByRss("date_created", "asc", 10, 1, 1);
		
		header("Content-Type: text/xml");
		$smarty->assign("rss_list", $rss_list);

		$intro_main = 23;
		require_once('includes/introduction.inc.php');
		$smarty->display("blog_rss.tpl");
		exit;
		
		
		
		
		
	}	
//-------------------------------------------------------------
// Lista bloga
//-------------------------------------------------------------
	
	elseif(!$url_config['1']){
		
		header("Location: ".$default_path."blog/lista/");
		
	}
		
	elseif($url_config['1'] == "lista"){
	
		// ustawienie numeru strony do stronicowania (jezeli nie została podana)
		if (!$url_config['2']) {
			$url_config['2'] = 1;
		}
		
		//Tytuły meta
		$head = array();
		$head['title'] = "Blog";
		$smarty->assign("head", $head);		
		
		$limit = 3;
		$blog_list = $blog->getBlogsByView("order", "desc", $limit, $url_config['2'], $_SESSION['lang']);
		//print_r($blog_list);
		$smarty->assign("main", "main_blog_list.tpl");
		$smarty->assign("blog_list", $blog_list);
		$smarty->assign("paging", $blog->paging);
	
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