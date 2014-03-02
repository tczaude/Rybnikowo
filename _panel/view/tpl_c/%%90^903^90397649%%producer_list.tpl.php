<?php /* Smarty version 2.6.9, created on 2013-02-13 21:47:30
         compiled from producer_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'producer_list.tpl', 72, false),)), $this); ?>
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
                                    <h2 class="jquery_tab_title">Lista kategorii wg producenta</h2>
                                    <div id="info"></div>
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
											  			$("#info").load("/_panel/article/sortable/?"+order);
											     	}
											});
											$("#order-list").disableSelection();
										});
										</script>
										'; ?>



									
									
									
									
									
									<ul id="listtop">
										<li class="top">
											  
											  <div class="nametop">NAZWA</div>
											  <div class="optionstop">OPCJE</div>
									    </li><div class="clrl"></div>
									</ul>
									<ul id="order-list">
									
									<?php if ($this->_tpl_vars['menu_categories']): ?>
									
									<?php $_from = $this->_tpl_vars['menu_categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['producer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['producer']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['producer']):
        $this->_foreach['producer']['iteration']++;
?>
									<?php echo smarty_function_cycle(array('name' => 'color','assign' => 'row_color','values' => "#EFEFEF ,#EFEFEF"), $this);?>

									
									
									  <li style="background-color: <?php echo $this->_tpl_vars['row_color']; ?>
" >
											  
											  <div class="name" style="padding-left:30px;<?php if ($this->_tpl_vars['producer']['status'] != 1): ?> color:#bbbbbb;<?php endif; ?>"><?php echo $this->_tpl_vars['producer']['name']; ?>
</div>
											  
											  
											  <div class="options">
                  
													<a href="<?php echo $this->_tpl_vars['path']; ?>
/producer/edit/<?php echo $this->_tpl_vars['producer']['id']; ?>
/<?php echo $this->_tpl_vars['language']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/page_white_edit.png" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['Edit']; ?>
 (<?php echo $this->_tpl_vars['language']['short']; ?>
)"/></a>&nbsp;					                                       
													<?php if ($this->_tpl_vars['producer']['status'] == 1): ?>
														<a href="<?php echo $this->_tpl_vars['path']; ?>
/producer/status/<?php echo $this->_tpl_vars['producer']['id']; ?>
/0/<?php echo $this->_tpl_vars['paging']['current']; ?>
" title="ustaw status niewidoczny"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/delete.png" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['SetStatus']; ?>
"></a>
													<?php else: ?>
														<a href="<?php echo $this->_tpl_vars['path']; ?>
/producer/status/<?php echo $this->_tpl_vars['producer']['id']; ?>
/1/<?php echo $this->_tpl_vars['paging']['current']; ?>
" title="ustaw status widoczny"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/tick.png" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['SetStatus']; ?>
"></a>
													<?php endif; ?>                                       
										            <a href="<?php echo $this->_tpl_vars['path']; ?>
/producer/remove/<?php echo $this->_tpl_vars['producer']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/false.png" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['Remove']; ?>
"></a>
																
											</div>
																					<div class="clearboth"></div>
									  </li>
									  <?php if ($this->_tpl_vars['producer']['sub']): ?>
									  <?php $_from = $this->_tpl_vars['producer']['sub']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sub1']):
?>
									  <?php echo smarty_function_cycle(array('name' => 'color','assign' => 'sub_color','values' => "#EFEFEF ,#EFEFEF"), $this);?>

									  <li style="padding: 2px 10px; background-color: <?php echo $this->_tpl_vars['sub_color']; ?>
">
											  
											  <div class="name" style="padding-left:50px;<?php if ($this->_tpl_vars['sub1']['status'] != 1): ?> color:#bbbbbb;<?php endif; ?>">&nbsp;&rarr;&nbsp;&nbsp;<?php echo $this->_tpl_vars['sub1']['name']; ?>
</div>
											  
											  <div class="options">
								
													<a href="<?php echo $this->_tpl_vars['path']; ?>
/producer/edit/<?php echo $this->_tpl_vars['sub1']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/page_white_edit.png" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['Edit']; ?>
 (<?php echo $this->_tpl_vars['language']['short']; ?>
)"></a>&nbsp;
					                                       
													<?php if ($this->_tpl_vars['sub1']['status'] == 1): ?>
														<a href="<?php echo $this->_tpl_vars['path']; ?>
/producer/status/<?php echo $this->_tpl_vars['sub1']['id']; ?>
/0/<?php echo $this->_tpl_vars['paging']['current']; ?>
" title="ustaw status niewidoczny"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/delete.png" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['SetStatus']; ?>
"></a>
													<?php else: ?>
														<a href="<?php echo $this->_tpl_vars['path']; ?>
/producer/status/<?php echo $this->_tpl_vars['sub1']['id']; ?>
/1/<?php echo $this->_tpl_vars['paging']['current']; ?>
" title="ustaw status widoczny"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/tick.png" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['SetStatus']; ?>
"></a>
													<?php endif; ?>                                       
										             
													<a href="<?php echo $this->_tpl_vars['path']; ?>
/producer/remove/<?php echo $this->_tpl_vars['sub1']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/false.png" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['Remove']; ?>
"></a>
																
											</div>
										<div class="clearboth"></div>
									  </li>									  
									  <?php endforeach; endif; unset($_from); ?>
									  <?php endif; ?>
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
        
    </body>
    
</html>