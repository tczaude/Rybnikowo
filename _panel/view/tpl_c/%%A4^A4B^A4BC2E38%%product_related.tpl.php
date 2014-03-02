<?php /* Smarty version 2.6.9, created on 2013-03-11 22:56:19
         compiled from product_related.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'product_related.tpl', 85, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head_popup.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    
    <body>
    	
    	        
        
        <div id="top">
        

           	
            	<div>
                
                    <div id="main">
                    
                        <div id="content" style="margin-left: 0px;">
                        
                            <div class="jquery_tab">
                            
                                <div class="content_block">
                                    <h2 class="jquery_tab_title">Wybierz kategorie dla firmy</h2>
                                    <p>[<?php echo $this->_tpl_vars['product']['related_amount']; ?>
] - <?php echo $this->_tpl_vars['product']['title']; ?>
</p>
                                    <div id="informacja"></div>
                                    <?php if ($this->_tpl_vars['good_message']): ?>
                           		  	<div class="message success closeable">
    									<p><strong>Gratulacje!</strong> <?php echo $this->_tpl_vars['good_message']; ?>
</p>
									</div>           
                                    <?php endif; ?>
                                                                    
									<form action="<?php echo $this->_tpl_vars['path']; ?>
/related/Search/<?php echo $this->_tpl_vars['ProductId']; ?>
/" name="related_search" method="post">
									
									<input type="hidden" id="action" name="action" value="Search">
									<input type="hidden" id="related_page_number" name="related_page_number" value="<?php echo $this->_tpl_vars['paging']['current']; ?>
">

									nazwa : <input class="input-small"  type="text" name="search_form[name]" value="<?php echo $this->_tpl_vars['related_filters']['name']; ?>
">&nbsp;&nbsp;<br/>
									<input type="submit" class="button" name="search" value="szukaj">
									<?php if ($this->_tpl_vars['set_filter']): ?>
									<input type="button" class="button" value="Wyczyść" name="clear_search" onclick="window.location = '<?php echo $this->_tpl_vars['path']; ?>
/related/ClearSearch/<?php echo $this->_tpl_vars['ProductId']; ?>
/'">
									<?php endif; ?>
									<input type="button" class="button" value="Tylko powiązane" name="related_only" onclick="window.location = '<?php echo $this->_tpl_vars['path']; ?>
/related/RelatedOnly/<?php echo $this->_tpl_vars['ProductId']; ?>
/'">

									
									</form>                                   
                                    
						            
						            
						            <br/>
						            
									<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "product_related_paging.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
															            
									<ul id="listtop">
										<li class="top">
											  <div class="nametop">Nazwa</div>  
											  <div class="optionstop">Usuń dowiązanie</div>
									    </li><div class="clrl"></div>
									</ul>
									
									<form name="product_form" method="post">
									<input type="hidden" name="ProductId" value="<?php echo $this->_tpl_vars['ProductId']; ?>
">   
									<table>
										<tr>
											
											<td>
												<input style="margin-left: 10px;" id="checktest" type="checkbox" onclick="checkUncheckAll(this)">	
											</td>
											<td>
												- zaznacz wszystkie
											</td>
										</tr>
									</table>
																	
									
									
									<ul id="order-list">
									
										
								
									
									<?php $_from = $this->_tpl_vars['category_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['category'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['category']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['category']):
        $this->_foreach['category']['iteration']++;
?>
									<?php echo smarty_function_cycle(array('name' => 'color','assign' => 'row_color','values' => "#EFEFEF ,#EFEFEF"), $this);?>

										
									 <li style="background-color: <?php echo $this->_tpl_vars['row_color']; ?>
">
											  
										<div style="float: left; margin-left: 15px;" class="options">
										<?php echo $this->_tpl_vars['category']['name']; ?>

										</div>
										<div class="clearboth"></div>
									 </li>
									 <?php if ($this->_tpl_vars['category']['sub']): ?>
										<?php $_from = $this->_tpl_vars['category']['sub']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['subcategory'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['subcategory']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['subcategory']):
        $this->_foreach['subcategory']['iteration']++;
?>
										<?php echo smarty_function_cycle(array('name' => 'color','assign' => 'row_color','values' => "#EFEFEF ,#EFEFEF"), $this);?>

											
										 <li style="background-color: <?php echo $this->_tpl_vars['row_color']; ?>
; padding-left: 40px;">
												  
											<input style="float: left;" type="checkbox" name="related[<?php echo $this->_tpl_vars['subcategory']['id']; ?>
]" value="1" <?php if ($this->_tpl_vars['subcategory']['selected']): ?>checked<?php endif; ?>/>
											<div style="float: left; margin-left: 15px;" class="options">
											<?php echo $this->_tpl_vars['subcategory']['name']; ?>

											</div>
											<div style="float: right; margin-right: 15px;" class="options">
											<a href="<?php echo $this->_tpl_vars['path']; ?>
/related/remove/<?php echo $this->_tpl_vars['ProductId']; ?>
/<?php echo $this->_tpl_vars['subcategory']['id']; ?>
/?PagingCurrent=<?php echo $this->_tpl_vars['paging']['current']; ?>
"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/false.png" border="0" title="Usuń powiązanie"></a>
											</div>
											<div class="clearboth"></div>
										 </li>									 
										<?php endforeach; endif; unset($_from); ?>
									 <?php endif; ?>
									 
									<?php endforeach; endif; unset($_from); ?>

									
									</ul>
									<br/>
									dla wszystkich zaznaczonych :
									<select name="action" class="adm11">
										<option value="AddRelatedProductBulk">dodaj do produktu</option>
										<option value="RemoveRelatedProductBulk">usuń z produktu</option>
									</select>&nbsp;&nbsp;
                                	<input style="float: right; margin: 7px 15px 0 0;" type="submit" value="Zapisz" class="button">
						            </form>
									

                                
                                
                                <div class="clearboth"></div>  
                                
                                      
                                 <br/>   
                            	</div><!--end content_block-->

                            	
                                 <br/>   
								<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "product_related_paging.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                            	</div><!--end content_block-->                            	
                            	
                            	
                                
                            </div><!--end jquery tab-->								
								

                        </div><!--end content-->
                        
                    </div><!--end main-->
                    

                        
                     </div><!--end bg_wrapper-->
                     <div class="clearboth"></div>

                
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