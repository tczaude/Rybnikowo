<?php /* Smarty version 2.6.9, created on 2013-02-12 13:27:23
         compiled from header.tpl */ ?>
<div id="head">
	<h1 class="logo">
    	<a href="">Code13 - Po twojej stronie w internecie !</a>
    </h1>
    
    <div class="head_memberinfo">
    	        <span class='memberinfo_span'>
       		 Witaj  <a href=""><?php echo $this->_tpl_vars['admin_data']['name']; ?>
 <?php echo $this->_tpl_vars['admin_data']['surname']; ?>
	</a>
        </span>
        
        <span class='memberinfo_span'>
        	<a href="<?php echo $this->_tpl_vars['__CFG']['base_url']; ?>
" target="_blank">Zobacz stronę</a>
        </span>
        
        <span class='memberinfo_span'>
        	<a href="<?php echo $this->_tpl_vars['path']; ?>
/parameter">Parametry</a>
        </span>        
        <span>
        	<a href="<?php echo $this->_tpl_vars['path']; ?>
/logout">Wyloguj</a>
        </span>
            </div><!--end head_memberinfo-->

</div><!--end head-->