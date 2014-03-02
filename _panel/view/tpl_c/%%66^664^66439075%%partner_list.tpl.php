<?php /* Smarty version 2.6.9, created on 2013-04-04 15:44:47
         compiled from partner_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'partner_list.tpl', 77, false),array('modifier', 'date_format', 'partner_list.tpl', 86, false),)), $this); ?>
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
                                    <h2 class="jquery_tab_title">Lista partnerów</h2>
                                    
                                    <?php if ($this->_tpl_vars['good_message']): ?>
                           		  	<div class="message success closeable">
    									<p><strong>Gratulacje!</strong> <?php echo $this->_tpl_vars['good_message']; ?>
</p>
									</div>           
                                    <?php endif; ?>

						            									
										<?php echo ' 
										<style>
										.ui-state-highlight { 	background-image: url(../images/bullet2.gif) no-repeat top left #efefef; height: 1.5em; line-height: 1.2em;  }
										</style>                          	
										<script type="text/javascript">
										$(function() {
											$("#order-list").sortable({
												placeholder: \'ui-state-highlight\',
											    handle : \'.handle\',
											    update : function () {
													var order = $(\'#order-list\').sortable(\'serialize\');
											  			$("#info").load("/_panel/partner/sortable/?"+order);
											     	}
											});
											$("#order-list").disableSelection();
										});
										</script>
										'; ?>



									
									<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "partner_paging.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
									
									<div style="display: none;" id="info"></div>
									
									<ul id="listtop">
										<li class="top">
											  
											  <div class="nametop">TYTUŁ</div>
											  <div class="datetop">DATA</div>
											  
											  <div class="optionstop">OPCJE</div>
									    </li><div class="clrl"></div>
									</ul>
									<ul id="order-list">
									
									<?php if ($this->_tpl_vars['partners_list']): ?>
									
									<?php $_from = $this->_tpl_vars['partners_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['partner'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['partner']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['partner']):
        $this->_foreach['partner']['iteration']++;
?>
									<?php echo smarty_function_cycle(array('name' => 'color','assign' => 'row_color','values' => "#EFEFEF ,#EFEFEF"), $this);?>

									
									
									  <li id="listItem_<?php echo $this->_tpl_vars['partner']['partner_id']; ?>
" style="background-color: <?php echo $this->_tpl_vars['row_color']; ?>
">
											  
											<div style="float: left; width: 30px;"><?php if (! ($this->_foreach['partner']['iteration'] <= 1)): ?><a href="<?php echo $this->_tpl_vars['path']; ?>
/partner/up/<?php echo $this->_tpl_vars['partner']['partner_id']; ?>
/<?php echo $this->_tpl_vars['partner']['category_id']; ?>
"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/up.gif" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['MoveUp']; ?>
"></a><?php endif; ?>&nbsp;</div>
											<div style="float: left; width: 30px;"><?php if (! ($this->_foreach['partner']['iteration'] == $this->_foreach['partner']['total'])): ?><a href="<?php echo $this->_tpl_vars['path']; ?>
/partner/down/<?php echo $this->_tpl_vars['partner']['partner_id']; ?>
/<?php echo $this->_tpl_vars['partner']['category_id']; ?>
"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/down.gif" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['MoveDown']; ?>
"></a><?php endif; ?>&nbsp;</div>
							
											  <div class="name"><?php echo $this->_tpl_vars['partner']['title']; ?>
</div>
											  <div class="date"><?php echo ((is_array($_tmp=$this->_tpl_vars['partner']['date_created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
</div>
											  
											  <div class="options">
											  	<?php $_from = $this->_tpl_vars['language_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['language']):
?>
														<?php if ($this->_tpl_vars['language']['id'] == $this->_tpl_vars['admin_data']['language']): ?>
														<a href="<?php echo $this->_tpl_vars['path']; ?>
/partner/edit/<?php echo $this->_tpl_vars['partner']['partner_id']; ?>
/<?php echo $this->_tpl_vars['language']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/page_white_edit.png" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['Edit']; ?>
 (<?php echo $this->_tpl_vars['language']['short']; ?>
)"></a>&nbsp;
														<?php endif; ?>
												<?php endforeach; endif; unset($_from); ?>
																				
																				                                       
													<?php if ($this->_tpl_vars['partner']['status'] == 2): ?>
														<a href="<?php echo $this->_tpl_vars['path']; ?>
/partner/status/<?php echo $this->_tpl_vars['partner']['partner_id']; ?>
/1/<?php echo $this->_tpl_vars['paging']['current']; ?>
" title="ustaw status niewidoczny"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/delete.png" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['SetStatus']; ?>
"></a>
													<?php else: ?>
														<a href="<?php echo $this->_tpl_vars['path']; ?>
/partner/status/<?php echo $this->_tpl_vars['partner']['partner_id']; ?>
/2/<?php echo $this->_tpl_vars['paging']['current']; ?>
" title="ustaw status widoczny"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/tick.png" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['SetStatus']; ?>
"></a>
													<?php endif; ?>                                       
										            													<a href="<?php echo $this->_tpl_vars['path']; ?>
/partner/remove/<?php echo $this->_tpl_vars['partner']['partner_id']; ?>
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
                                
                                      
                                  <br/>    
								<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "partner_paging.tpl", 'smarty_include_vars' => array()));
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
                Krzysiek 500 069 804
                </div><!--end footer-->
                
        </div><!-- end top -->
        
    </body>
    
</html>