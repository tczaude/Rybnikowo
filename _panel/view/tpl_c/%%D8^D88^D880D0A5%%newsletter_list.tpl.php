<?php /* Smarty version 2.6.9, created on 2013-02-13 22:01:25
         compiled from newsletter_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'newsletter_list.tpl', 53, false),array('modifier', 'date_format', 'newsletter_list.tpl', 59, false),)), $this); ?>
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
                                    <h2 class="jquery_tab_title">Lista artykułów</h2>
                                    
                                    <?php if ($this->_tpl_vars['good_message']): ?>
                           		  	<div class="message success closeable">
    									<p><strong>Gratulacje!</strong> <?php echo $this->_tpl_vars['good_message']; ?>
</p>
									</div>           
                                    <?php endif; ?>
						            <h2 style="padding-top: 20px;cursor:pointer; font-size: 16px;<?php if ($this->_tpl_vars['set_filter']): ?>color: #797268;<?php endif; ?>" class="jquery_tab_title" onclick="showFilters();"><?php if ($this->_tpl_vars['set_filter']): ?>Filtrowanie - włączone<?php else: ?>Filtrowanie - wyłączone<?php endif; ?></h2>
						            
																		
									<div style="display: none;" id="info"></div>
									
									<ul id="listtop">
										<li class="top">
											  
											  <div class="nametop">TYTUŁ</div>
											  <div class="datetop">DATA</div>
											  
											  <div class="optionstop">OPCJE</div>
									    </li><div class="clrl"></div>
									</ul>
									<ul id="order-list">
									
									<?php if ($this->_tpl_vars['newsletter_list']): ?>
									
									<?php $_from = $this->_tpl_vars['newsletter_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['newsletter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['newsletter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['newsletter']):
        $this->_foreach['newsletter']['iteration']++;
?>
									<?php echo smarty_function_cycle(array('name' => 'color','assign' => 'row_color','values' => "#EFEFEF ,#EFEFEF"), $this);?>

									
									
									  <li id="listItem_<?php echo $this->_tpl_vars['newsletter']['newsletter_id']; ?>
" style="background-color: <?php echo $this->_tpl_vars['row_color']; ?>
">
											  
											  <div class="name"><?php echo $this->_tpl_vars['newsletter']['name']; ?>
</div>
											  <div class="date"><?php echo ((is_array($_tmp=$this->_tpl_vars['newsletter']['date_created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
</div>
											  
											  <div class="options">

													<a href="<?php echo $this->_tpl_vars['path']; ?>
/newsletter/edit/<?php echo $this->_tpl_vars['newsletter']['id']; ?>
/"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/page_white_edit.png" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['Edit']; ?>
"/></a>&nbsp;	
																				
																				                                       
													<?php if ($this->_tpl_vars['newsletter']['status'] == 2): ?>
														<a href="<?php echo $this->_tpl_vars['path']; ?>
/newsletter/status/<?php echo $this->_tpl_vars['newsletter']['newsletter_id']; ?>
/1/<?php echo $this->_tpl_vars['paging']['current']; ?>
" title="ustaw status niewidoczny"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/delete.png" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['SetStatus']; ?>
"></a>
													<?php else: ?>
														<a href="<?php echo $this->_tpl_vars['path']; ?>
/newsletter/status/<?php echo $this->_tpl_vars['newsletter']['newsletter_id']; ?>
/2/<?php echo $this->_tpl_vars['paging']['current']; ?>
" title="ustaw status widoczny"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/tick.png" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['SetStatus']; ?>
"></a>
													<?php endif; ?>                                       
													<a href="<?php echo $this->_tpl_vars['path']; ?>
/newsletter/preview/<?php echo $this->_tpl_vars['newsletter']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/magnifier.png" border="0" title="Podgląd"/></a>
													
													<a href="javascript: openwin('<?php echo $this->_tpl_vars['path']; ?>
/dispatch/GetDispatchesForNewsletter/<?php echo $this->_tpl_vars['newsletter']['id']; ?>
/');"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/email_go.png" border="0" title="Wyślij newsletter"/></a>
																											
													<a href="<?php echo $this->_tpl_vars['path']; ?>
/newsletter/remove/<?php echo $this->_tpl_vars['newsletter']['id']; ?>
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
		<?php echo '		
		<script type="text/javascript">
		
		function openwin(url)
		{
			var w = 650;
			var h = 600;
			dodanie = window.open(url,\'dodanie\',\'resizable,scrollbars,width=\'+w+\',height=\'+h+\',left=\' + ((screen.width-w)/2) + \', top=\' + ((screen.height-h)/ 2));
		}
		
		function openwin_big(url)
		{
			var w = 745;
			var h = 500;
			dodanie = window.open(url,\'dodanie\',\'resizable,scrollbars,width=\'+w+\',height=\'+h+\',left=\' + ((screen.width-w)/2) + \', top=\' + ((screen.height-h)/ 2));
		}
		
		</script>
		'; ?>
        
    </body>
    
</html>