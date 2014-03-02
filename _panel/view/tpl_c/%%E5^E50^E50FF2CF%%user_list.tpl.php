<?php /* Smarty version 2.6.9, created on 2013-02-13 22:01:07
         compiled from user_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'user_list.tpl', 61, false),)), $this); ?>
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
                                    <h2 class="jquery_tab_title">Lista użytkowników</h2>
                                    
                                    <?php if ($this->_tpl_vars['good_message']): ?>
                           		  	<div class="message success closeable">
    									<p><strong>Gratulacje!</strong> <?php echo $this->_tpl_vars['good_message']; ?>
</p>
									</div>           
                                    <?php endif; ?>
						            
						            <br/>
						            <h2 style="padding-top: 20px;cursor:pointer; font-size: 16px;<?php if ($this->_tpl_vars['set_filter']): ?>color: #797268;<?php endif; ?>" class="jquery_tab_title" onclick="showFilters();"><?php if ($this->_tpl_vars['set_filter']): ?>Filtrowanie - włączone<?php else: ?>Filtrowanie - wyłączone<?php endif; ?></h2>
						            
						            
						            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "user_filters.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
									


									
									<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "user_paging.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
									
									<div style="display: none;" id="info"></div>
									
									<ul id="listtop">
										<li class="top">
											  
											  <div class="nametop">NAZWISKO I IMIĘ</div>

									    </li>
									    
									</ul>
									<div class="clrl">&nbsp;</div>
									<ul id="order-list">
									
									<?php if ($this->_tpl_vars['users_list']): ?>
									
									<?php $_from = $this->_tpl_vars['users_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['user'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['user']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['user']):
        $this->_foreach['user']['iteration']++;
?>
									<?php echo smarty_function_cycle(array('name' => 'color','assign' => 'row_color','values' => "#EFEFEF ,#EFEFEF"), $this);?>

									
									
									  <li id="listItem_<?php echo $this->_tpl_vars['user']['user_id']; ?>
" style="background-color: <?php echo $this->_tpl_vars['row_color']; ?>
">
											  
											  <div class="name">
											  	<div style="width: 250px; float: left;"><?php echo $this->_tpl_vars['user']['surname']; ?>
 <?php echo $this->_tpl_vars['user']['name']; ?>
</div>
											  	<div style="width: 120px; float: left;"><?php echo $this->_tpl_vars['user']['city']; ?>
</div>
											  	<div style="width: 220px; float: left;"><a href="mailto:<?php echo $this->_tpl_vars['user']['email']; ?>
"><?php echo $this->_tpl_vars['user']['email']; ?>
</a></div>
											  </div>
											  
											  
											  <div class="options">

													<a href="<?php echo $this->_tpl_vars['path']; ?>
/user/edit/<?php echo $this->_tpl_vars['user']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/page_white_edit.png" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['Edit']; ?>
 (<?php echo $this->_tpl_vars['language']['short']; ?>
)"/></a>&nbsp;
					                                       
													<?php if ($this->_tpl_vars['user']['status'] == 1): ?>
														<a href="<?php echo $this->_tpl_vars['path']; ?>
/user/status/<?php echo $this->_tpl_vars['user']['id']; ?>
/0" title="ustaw status nieaktywny"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/delete.png" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['SetStatus']; ?>
"/></a>
													<?php else: ?>
														<a href="<?php echo $this->_tpl_vars['path']; ?>
/user/status/<?php echo $this->_tpl_vars['user']['id']; ?>
/1" title="ustaw status aktywny"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/tick.png" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['SetStatus']; ?>
"/></a>
													<?php endif; ?>                                       

													<a href="<?php echo $this->_tpl_vars['path']; ?>
/user/remove/<?php echo $this->_tpl_vars['user']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/false.png" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['Remove']; ?>
"/></a>
																
									</div>
										<div class="clearboth"></div>
									  </li>
									<?php endforeach; endif; unset($_from); ?>
									
									<?php else: ?>
									
									<li>Brak wyników</li>
									
									<?php endif; ?>
									
									</ul>
						            
								                                
                                <div class="clearboth"></div>  
                                
                                      
                                 <br/>   
								<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "user_paging.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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