<?
	include('includes/default.php');
	
	
	// -------------------------------------------------------
	// Powiadomienia
	// -------------------------------------------------------

	//Powodzenie
	if($_SESSION['message']['good_message']){
		
		$smarty->assign("good_message", $_SESSION['message']['good_message']);
		unset($_SESSION['message']['good_message']);
		
	}
	
	//Błąd
	if($_SESSION['message']['bad_message']){
		
		$smarty->assign("bad_message", $_SESSION['message']['bad_message']);
		unset($_SESSION['message']['bad_message']);
		
	}	
	
	
	//Tutaj musimy zrobic rozdzielenie poszczegolnych działów w zalezności od $url_config
	
	
	//Zabezpieczenie przed niezalogowaniem
	if ($_SESSION['admin_data']['id']) {
		
		
		
		
		//Jeśli nie wybrano działu - kierujemy do artykułów	
		if(!$url_config['1']){
			$url_config['1'] = "article";
		
		}		
		
		// -----------------------------------------------------------
		// Artykuły
		// -----------------------------------------------------------
		if($url_config['1'] == "article"){
			include('includes/article.inc.php');
			if (!$template) {
				$template = "article_list.tpl";
			}
			$smarty->assign('nazwa_dzialu', $dict_templates['Articles']);
			$smarty->assign("script_name", "article");
			$smarty->display($template);
			
		}

		//-----------------------------------------------------------
		// Firmy
		//-----------------------------------------------------------
		elseif($url_config['1'] == "product"){
			include('includes/product.inc.php');
			if (!$template) {
				$template = "product_list.tpl";
			}
			$smarty->assign('nazwa_dzialu', "Produkt");
			$smarty->assign("script_name", "product");
			$smarty->display($template);
			
		}
		// -----------------------------------------------------------
		// Kategorie
		// -----------------------------------------------------------
		elseif($url_config['1'] == "category"){
			include('includes/category.inc.php');
			if (!$template) {
				$template = "category_list.tpl";
			}
			$smarty->assign('nazwa_dzialu',"Kategorie");
			$smarty->assign("script_name", "category");
			$smarty->display($template);
			
		}		
		// -----------------------------------------------------------
		// Newsletter
		// -----------------------------------------------------------
		elseif($url_config['1'] == "newsletter"){
			include('includes/newsletter.inc.php');
			if (!$template) {
				$template = "newsletter_list.tpl";
			}
			$smarty->assign('nazwa_dzialu', "Newsletter");
			$smarty->assign("script_name", "newsletter");
			$smarty->display($template);
			
		}	
		// -----------------------------------------------------------
		// Zdjęcia
		// -----------------------------------------------------------
		elseif($url_config['1'] == "picture"){
			include('includes/picture.inc.php');
			if (!$template) {
				$template = "picture_list.tpl";
			}
			$smarty->assign('nazwa_dzialu', "Zdjęcia");
			$smarty->assign("script_name", "picture");
			$smarty->display($template);
			
		}
		// -----------------------------------------------------------
		// Blog
		// -----------------------------------------------------------
		elseif($url_config['1'] == "blog"){
			include('includes/blog.inc.php');
			if (!$template) {
				$template = "blog_list.tpl";
			}
			$smarty->assign('nazwa_dzialu', "Blog");
			$smarty->assign("script_name", "blog");
			$smarty->display($template);
			
		}	
		// -----------------------------------------------------------
		// Partnerzy
		// -----------------------------------------------------------
		elseif($url_config['1'] == "partner"){
			include('includes/partner.inc.php');
			if (!$template) {
				$template = "partner_list.tpl";
			}
			$smarty->assign('nazwa_dzialu', "Partner");
			$smarty->assign("script_name", "partner");
			$smarty->display($template);
			
		}	
		// -----------------------------------------------------------
		// Produkty powiązane
		// -----------------------------------------------------------
		elseif($url_config['1'] == "related"){
			include('includes/related.inc.php');
			if (!$template) {
				$template = "product_related.tpl";
			}
			$smarty->assign('nazwa_dzialu',"Produkty powiązane");
			$smarty->assign("script_name", "product_related");
			$smarty->display($template);
			
		}	
		//-----------------------------------------------------------
		// Slideshow
		//-----------------------------------------------------------
		elseif($url_config['1'] == "slideshow"){
			include('includes/slideshow.inc.php');
			if (!$template) {
				$template = "slideshow_list.tpl";
			}
			$smarty->assign('nazwa_dzialu', "Slideshow");
			$smarty->assign("script_name", "slideshow");
			$smarty->display($template);
			
		}				
		
		// -----------------------------------------------------------
		// Wylogowanie
		// -----------------------------------------------------------
		elseif($url_config['1'] == "logout"){
			
			$_REQUEST['action'] = "LogoutAdmin";
			include('includes/admin.inc.php');
			
		}		
		// -----------------------------------------------------------
		// Parametry
		// -----------------------------------------------------------
		elseif($url_config['1'] == "parameter"){
			include('includes/parameter.inc.php');
			if (!$template) {
				$template = "parameter.tpl";
			}
			$smarty->assign('nazwa_dzialu', $dict_templates['Parameters']);
			$smarty->assign("script_name", "parameter");
			$smarty->display($template);
			
		}
		// -----------------------------------------------------------
		// Kontakt
		// -----------------------------------------------------------
		elseif($url_config['1'] == "kontakt"){
			include('includes/contact.inc.php');
			if (!$template) {
				$template = "contact_list.tpl";
			}
			$smarty->assign('nazwa_dzialu',"Kontakt");
			$smarty->assign("script_name", "contact");
			$smarty->display($template);
			
		}	
		
		
		elseif($url_config['1'] == "good_message"){
			
			
			$smarty->display("good_message.tpl");	
			
			
		}
		
		
		else{
		
			include('includes/_error.inc.php');
			
		}			
	
	
	
	}
	else{
		
		$smarty->display("login.tpl");
		
	}
	

	
	

?>