<?php /* Smarty version 2.6.9, created on 2013-02-22 21:59:40
         compiled from parameter.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'parameter.tpl', 53, false),array('modifier', 'default', 'parameter.tpl', 68, false),)), $this); ?>
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
                                    <h2 class="jquery_tab_title">Lista parametrów</h2>
                                    
                                    <?php if ($this->_tpl_vars['good_message']): ?>
                           		  	<div class="message success closeable">
    									<p><strong>Gratulacje!</strong> <?php echo $this->_tpl_vars['good_message']; ?>
</p>
									</div>           
                                    <?php endif; ?>
                                    
									<form name="ConfigTableEdit" method="post" >
									
									<input type="hidden" name="action" value="SaveChangeableParameters">
									
									
									<ul id="listtop">
										<li class="top">
											  
											  <div class="nametop">TYTUŁ</div>
											  <div class="paramtop">DANE</div>
											  
											  
									    </li><div class="clrl"></div>
									</ul>
									<ul id="order-list">
								
									
									<?php if ($this->_tpl_vars['parameters_list']): ?>
									<?php $_from = $this->_tpl_vars['parameters_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['parameter']):
?>
									<?php echo smarty_function_cycle(array('name' => 'color','assign' => 'row_color','values' => "#EFEFEF ,#FFFFFF"), $this);?>

									
									
									  <li id="listItem_<?php echo $this->_tpl_vars['article']['article_id']; ?>
" style="background-color: <?php echo $this->_tpl_vars['row_color']; ?>
">
											  

											  <div class="name">
											  	<?php echo $this->_tpl_vars['parameter']['name']; ?>

											  	<img src="<?php echo $this->_tpl_vars['path']; ?>
/images/help.gif" title="<?php echo $this->_tpl_vars['parameter']['description']; ?>
">
											  </div>
											  <div class="date">
											  	&nbsp;
											  </div>
											  
											  <div class="options">
												<input class="input-medium" type="text" name="config_form[<?php echo $this->_tpl_vars['parameter']['name']; ?>
]" value='<?php echo ((is_array($_tmp=@$this->_tpl_vars['parameter']['content'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['content']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['content'])); ?>
' id="url"/>
											
											</div>
										<div class="clearboth"></div>
									  </li>
									<?php endforeach; endif; unset($_from); ?>
									
							        
							            
							      



									<?php else: ?>
									
									<li>Brak wyników</li>
									
									<?php endif; ?>
									
									</ul>
						            <br/>
						            <input class="button" name="submit" type="submit" value="Zapisz"/>
									
									                                
                                
                                </form>
                                <div class="clearboth" style="height: 20px;"></div>  
                                
                                      
                                    
								
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
                Krzysiek 500 069 804
                </div><!--end footer-->
                
        </div><!-- end top -->
        
    </body>
    
</html>