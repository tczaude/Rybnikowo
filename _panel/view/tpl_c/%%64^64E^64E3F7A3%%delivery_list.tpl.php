<?php /* Smarty version 2.6.9, created on 2013-02-13 21:48:50
         compiled from delivery_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'delivery_list.tpl', 49, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    
    <body>
    	
    	        
        
        <div id="top">
        
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
           	
            	<div id="bg_wrapper">
                
                    <div id="main">
                    
                        <div id="content">
                        
                            <div class="jquery_tab">
                            
                                <div class="content_block">
                                    <h2 class="jquery_tab_title">Lista zakresów</h2>
                                    <div id="info"></div>
                                    <?php if ($this->_tpl_vars['good_message']): ?>
                           		  	<div class="message success closeable">
    									<p><strong>Gratulacje!</strong> <?php echo $this->_tpl_vars['good_message']; ?>
</p>
									</div>           
                                    <?php endif; ?>
						            
						            <br/>
								
									<ul id="listtop">
										<li class="top">
											  
											  <div class="nametop">ZAKRES</div>
											  
											  <div class="optionstop">OPCJE</div>
									    </li><div class="clrl"></div>
									</ul>
									<ul id="order-list">
									
									<?php if ($this->_tpl_vars['delivery_list']): ?>
									
									<?php $_from = $this->_tpl_vars['delivery_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['delivery'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['delivery']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['delivery']):
        $this->_foreach['delivery']['iteration']++;
?>
									<?php echo smarty_function_cycle(array('name' => 'color','assign' => 'row_color','values' => "#EFEFEF ,#EFEFEF"), $this);?>

									
									
									  <li id="listItem_<?php echo $this->_tpl_vars['delivery']['id']; ?>
" style="background-color: <?php echo $this->_tpl_vars['row_color']; ?>
">
											  
											  <div class="name"><?php echo $this->_tpl_vars['delivery']['name']; ?>
</div>
											  <div class="options">

												<a href="<?php echo $this->_tpl_vars['path']; ?>
/delivery/edit/<?php echo $this->_tpl_vars['delivery']['id']; ?>
/"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/page_white_edit.png" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['Edit']; ?>
"></a>&nbsp;
												<a href="<?php echo $this->_tpl_vars['path']; ?>
/delivery/remove/<?php echo $this->_tpl_vars['delivery']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/false.png" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['Remove']; ?>
"></a>
			
									</div>
										<div class="clearboth"></div>
									  </li>
									<?php endforeach; endif; unset($_from); ?>
									
									<?php else: ?>
									
									<li>Brak wyników</li>
									
									<?php endif; ?>
									
									</ul>
                                
                                <div class="clearboth"></div>  
                                
                                    

                            	</div><!--end content_block-->

                            	
                            	
                            	
                            	
                                
                            </div><!--end jquery tab-->								
								

                        </div><!--end content-->
                        
                    </div><!--end main-->
                    
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        
                     </div><!--end bg_wrapper-->
                     <div class="clearboth"></div>
                <div id="footer">
                cos tu napisać idzie
                </div><!--end footer-->
                
        </div><!-- end top -->
        
    </body>
    
</html>