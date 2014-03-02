<?php /* Smarty version 2.6.9, created on 2013-02-12 13:27:11
         compiled from login.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="Reflect Template" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
        <title>Flexy Admin Login Page</title>
        <link rel="stylesheet" href="<?php echo $this->_tpl_vars['path']; ?>
/style/style_all.css" type="text/css" media="screen" />
        
        
        
        <!-- to choose another color scheme uncomment one of the foloowing stylesheets and wrap styl1.css into a comment -->
        <link rel="stylesheet" href="<?php echo $this->_tpl_vars['path']; ?>
/style/style1.css" type="text/css" media="screen" />
        
        <!-- 
        <link rel="stylesheet" href="<?php echo $this->_tpl_vars['path']; ?>
/style/style2.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo $this->_tpl_vars['path']; ?>
/style/style3.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo $this->_tpl_vars['path']; ?>
/style/style4.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo $this->_tpl_vars['path']; ?>
/style/style5.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo $this->_tpl_vars['path']; ?>
/style/style6.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo $this->_tpl_vars['path']; ?>
/style/style7.css" type="text/css" media="screen" />
         -->
        
        
        <link rel="stylesheet" href="<?php echo $this->_tpl_vars['path']; ?>
/style/jquery-ui.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo $this->_tpl_vars['path']; ?>
/style/jquery.wysiwyg.css" type="text/css" media="screen" />
        
        <!--Internet Explorer Trancparency fix-->
        <!--[if IE 6]>
        <script src="js/ie6pngfix.js"></script>
        <script>
          DD_belatedPNG.fix('#head, a, a span, img, .message p, .click_to_close, .ie6fix');
        </script>
        <![endif]--> 
        
        <script type='text/javascript' src='js/jquery.js'></script>
        <script type='text/javascript' src='js/jquery-ui.js'></script>
        <script type='text/javascript' src='js/jquery.wysiwyg.js'></script>
        <script type='text/javascript' src='js/custom.js'></script>
    </head>
    
    <body class="nobackground">
    	
        <div id="login">
        
        	<h1 class="logo">
            	<a href="">Code 13 - Po Twojejestronie w internecie !</a>
            </h1>
            <h2 class="loginheading">Login</h2>
            <div class="icon_login ie6fix"></div>
                
        	<form id="login-form" method="post">
        	<input type="hidden" name="action" value="LoginAdmin">
            <p>
            	<label for="name">Login :</label>
            	<input class="input-medium" type="text" value="" name="login_form[login]" id="name"/>
        	</p>
        	<p>
            	<label for="password">Hasło :</label>
            	<input class="input-medium" type="password" value="" name="login_form[password]" id="password"/>
        	</p>
                	<p class="clearboth">
            	<input class="button" name="submit" type="submit" value="Login"/>
        	</p>
            </form>
        </div>
        <?php if ($this->_tpl_vars['message']): ?>
        <div class="login_message message error">
          <p><?php echo $this->_tpl_vars['message']; ?>
</p>
        </div>
       <?php endif; ?>
    </body>
    
</html>