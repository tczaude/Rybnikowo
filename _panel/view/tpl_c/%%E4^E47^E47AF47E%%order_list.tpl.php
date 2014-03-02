<?php /* Smarty version 2.6.9, created on 2013-02-12 13:27:23
         compiled from order_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'string_format', 'order_list.tpl', 26, false),array('modifier', 'date_format', 'order_list.tpl', 72, false),array('function', 'cycle', 'order_list.tpl', 60, false),)), $this); ?>
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
                                    <h2 class="jquery_tab_title">Lista zamówień - łączna wartość: <?php if ($this->_tpl_vars['summary_value']):  echo ((is_array($_tmp=$this->_tpl_vars['summary_value'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f"));  else: ?>0<?php endif; ?> PLN</h2>
                                    <div id="info"></div>
                                    <?php if ($this->_tpl_vars['good_message']): ?>
                           		  	<div class="message success closeable">
    									<p><strong>Gratulacje!</strong> <?php echo $this->_tpl_vars['good_message']; ?>
</p>
									</div>           
                                    <?php endif; ?>

						            
						            <br/>
						            <h2 style="padding-top: 20px;cursor:pointer; font-size: 16px;<?php if ($this->_tpl_vars['set_filter']): ?>color: #797268;<?php endif; ?>" class="jquery_tab_title" onclick="showFilters();"><?php if ($this->_tpl_vars['set_filter']): ?>Filtrowanie - włączone<?php else: ?>Filtrowanie - wyłączone<?php endif; ?></h2>
						            
						            
						            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "order_filters.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

									
									<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "order_paging.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
									
									
									
									<ul id="listtop">
										<li class="top">
											  
											  <div class="nametop">NR, NAZWISKO I IMIĘ</div>
											  <div class="datetop">DATA</div>
											  
											  <div class="optionstop">OPCJE</div>
									    </li><div class="clrl"></div>
									</ul>
									<ul id="order-list">
									
									<?php if ($this->_tpl_vars['orders_list']): ?>
									
									<?php $_from = $this->_tpl_vars['orders_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['order'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['order']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['order']):
        $this->_foreach['order']['iteration']++;
?>
									<?php echo smarty_function_cycle(array('name' => 'color','assign' => 'row_color','values' => "#EFEFEF ,#EFEFEF"), $this);?>

									
									
									  <li style="background-color: <?php echo $this->_tpl_vars['row_color']; ?>
">
											  
											  <div class="name" style="width: 30px;"><?php echo $this->_tpl_vars['order']['id']; ?>
</div>
											  
											  <div class="name" style="width: 250px;"><?php echo $this->_tpl_vars['order']['user_surname']; ?>
 <?php echo $this->_tpl_vars['order']['user_name']; ?>
</div>
											  <div style="float: left;width: 70px;"><?php echo $this->_tpl_vars['order']['to_pay']; ?>
</div>
											 <div style="float: left;width: 130px;<?php if ($this->_tpl_vars['order']['delivery'] == 3 || $this->_tpl_vars['order']['delivery'] == 6): ?>color: purple; font-weight: bold;<?php endif; ?>"><?php echo $this->_tpl_vars['order']['user_city']; ?>
</div>
											 <div style="float: left;width: 180px;<?php if ($this->_tpl_vars['order']['status'] == 1): ?>color: red;<?php elseif ($this->_tpl_vars['order']['status'] == 2): ?>color: orange;<?php elseif ($this->_tpl_vars['order']['status'] == 3): ?>color: navy;<?php else: ?>color: green;<?php endif; ?>"><?php echo $this->_tpl_vars['order']['status_name']; ?>
</div>
											 <div style="float: left;width: 180px;"><?php echo $this->_tpl_vars['order']['status_transaction_name']; ?>
</div>
											  <div class="date"><?php echo ((is_array($_tmp=$this->_tpl_vars['order']['date_created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
</div>
											  
											  
											  <div class="options">
											
												<a href="<?php echo $this->_tpl_vars['path']; ?>
/order/display/<?php echo $this->_tpl_vars['order']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/page_white_edit.png" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['Edit']; ?>
 (<?php echo $this->_tpl_vars['language']['short']; ?>
)"></a>&nbsp;
																					
																								<a href="<?php echo $this->_tpl_vars['path']; ?>
/order/remove/<?php echo $this->_tpl_vars['order']['id']; ?>
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
$this->_smarty_include(array('smarty_include_tpl_file' => "order_paging.tpl", 'smarty_include_vars' => array()));
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