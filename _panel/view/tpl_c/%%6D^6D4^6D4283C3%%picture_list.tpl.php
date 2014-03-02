<?php /* Smarty version 2.6.9, created on 2013-02-22 16:49:21
         compiled from picture_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'picture_list.tpl', 61, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
              
              
              
              
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head_picture.tpl", 'smarty_include_vars' => array()));
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
                                    <h2 class="jquery_tab_title">Zdjęcia</h2>
                                    <p><?php echo $this->_tpl_vars['gallery_details']['title']; ?>
</p>
                                    
                                    
                                    <p>
                                    	<input type="button" class="button" value="Dodaj zdjęcie" onclick="javascript: openwin('<?php echo $this->_tpl_vars['path']; ?>
/picture/new/<?php echo $this->_tpl_vars['gallery_details']['product_id']; ?>
');"/>
                                    	<input style="width: 50px;"  onclick="window.close();" value="zamknij" class="button">
						             
                                    </p>
                                    <div id="informacja"></div>
                                    <?php if ($this->_tpl_vars['good_message']): ?>
                           		  	<div class="message success closeable">
    									<p><strong>Gratulacje!</strong> <?php echo $this->_tpl_vars['good_message']; ?>
</p>
									</div>           
                                    <?php endif; ?>

									<ul id="listtop">
										<li class="top">
											  
											  <div class="nametop">Zdjęcie</div>
											  <div class="optionstop">Opcje</div>
									    </li><div class="clrl"></div>
									</ul>
									


									<ul id="order-list">
									
										
								
									<?php if ($this->_tpl_vars['picture_list']): ?>
									<?php $_from = $this->_tpl_vars['picture_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['picture'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['picture']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['picture']):
        $this->_foreach['picture']['iteration']++;
?>
									<?php echo smarty_function_cycle(array('name' => 'color','assign' => 'row_color','values' => "#EFEFEF ,#EFEFEF"), $this);?>

										
									 <li style="background-color: <?php echo $this->_tpl_vars['row_color']; ?>
">
						 				
										<div style="float: left; width: 30px;"><?php if (! ($this->_foreach['picture']['iteration'] <= 1)): ?><a href="<?php echo $this->_tpl_vars['path']; ?>
/picture/up/<?php echo $this->_tpl_vars['picture']['picture_id']; ?>
/<?php echo $this->_tpl_vars['picture']['category_id']; ?>
"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/up.gif" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['MoveUp']; ?>
"></a><?php endif; ?>&nbsp;</div>
										<div style="float: left; width: 30px;"><?php if (! ($this->_foreach['picture']['iteration'] == $this->_foreach['picture']['total'])): ?><a href="<?php echo $this->_tpl_vars['path']; ?>
/picture/down/<?php echo $this->_tpl_vars['picture']['picture_id']; ?>
/<?php echo $this->_tpl_vars['picture']['category_id']; ?>
"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/down.gif" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['MoveDown']; ?>
"></a><?php endif; ?>&nbsp;</div>
												 				
						 				<div class="name"><img src="<?php echo $this->_tpl_vars['__CFG']['base_url']; ?>
images/picture/<?php echo $this->_tpl_vars['picture']['picture_id']; ?>
_01_01.jpg" height="25" alt="<?php echo $this->_tpl_vars['picture']['title']; ?>
"/>&nbsp;&nbsp;<?php echo $this->_tpl_vars['picture']['title']; ?>

											<br/><span style="color: gray; font-size: 10px;"><?php echo $this->_tpl_vars['picture']['date']; ?>
</span>
										</div>  
										<div class="options" <?php if ($this->_tpl_vars['picture']['status'] == '1'): ?>style="color:#bbbbbb;"<?php endif; ?>>
											<a href="javascript: openwin('<?php echo $this->_tpl_vars['path']; ?>
/picture/edit/<?php echo $this->_tpl_vars['picture']['picture_id']; ?>
/<?php echo $this->_tpl_vars['picture']['category_id']; ?>
/');"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/page_white_edit.png" border="0" title="Edytuj zdjęcie"/></a>	
											<?php if ($this->_tpl_vars['picture']['status'] == 2): ?>
												<a href="<?php echo $this->_tpl_vars['path']; ?>
/picture/status/<?php echo $this->_tpl_vars['picture']['picture_id']; ?>
/1/<?php echo $this->_tpl_vars['paging']['current']; ?>
" title="ustaw status niewidoczny"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/delete.png" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['SetStatus']; ?>
"></a>
											<?php else: ?>
												<a href="<?php echo $this->_tpl_vars['path']; ?>
/picture/status/<?php echo $this->_tpl_vars['picture']['picture_id']; ?>
/2/<?php echo $this->_tpl_vars['paging']['current']; ?>
" title="ustaw status widoczny"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/tick.png" border="0" title="<?php echo $this->_tpl_vars['dict_templates']['SetStatus']; ?>
"></a>
											<?php endif; ?> 
											<a href="<?php echo $this->_tpl_vars['path']; ?>
/picture/remove/<?php echo $this->_tpl_vars['picture']['picture_id']; ?>
/" onclick="if (!confirm('Czy na pewno chcesz usunąć wybrane zdjęcie?')) return false;"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/false.png" border="0" title="Usuń zdjęcie"></a>

											
										</div>
										<div class="clearboth"></div>
									 </li>
									 
									
									 
									 
									<?php endforeach; endif; unset($_from); ?>
									<?php endif; ?>
									
									</ul>

									

                                
                                
                                <div class="clearboth"></div>  
                                
                                      
                                 <br/>   
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
			var w = 400;
			var h = 520;
			dodanie = window.open(url,\'picture\',\'resizable,scrollbars,width=\'+w+\',height=\'+h+\',left=\' + ((screen.width-w)/2) + \', top=\' + ((screen.height-h)/ 2));
		}
		
		function openwin_big(url)
		{
			var w = 800;
			var h = 700;
			dodanie = window.open(url,\'picture\',\'resizable,scrollbars,width=\'+w+\',height=\'+h+\',left=\' + ((screen.width-w)/2) + \', top=\' + ((screen.height-h)/ 2));
		}
		
		</script>
		'; ?>

    </body>
    
</html>