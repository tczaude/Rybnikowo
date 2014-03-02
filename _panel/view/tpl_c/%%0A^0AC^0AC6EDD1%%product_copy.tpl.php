<?php /* Smarty version 2.6.9, created on 2013-03-08 14:39:00
         compiled from product_copy.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'product_copy.tpl', 50, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    
    <body>
    	
    	        
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "product_validate.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        
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
							    <h2 class="jquery_tab_title">Kopiowanie produktu</h2>
							    
							    
							    							    
							    
							    <form id="productForm" method="post" enctype="multipart/form-data">
									
									
									
									<input type="hidden" name="product_form[language_id]" value="1">
									<input type="hidden" name="action" value="SaveProduct">
									
									    
							        <p>
							            <label for="product_form[title]">Nazwa produktu:</label>
							            <input class="input-big" type="text" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['product']['title'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['title']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['title'])); ?>
" name="product_form[title]" id="product_form[title]"/>
							        </p>
							      
							        
							        <p>
							            <label for="product_form[url_name]">Nazwa url:</label>
							            <input class="input-big" type="text" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['product']['url_name'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['url_name']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['url_name'])); ?>
" name="product_form[url_name]" id="product_form[url_name]"/>
							        	<?php if ($this->_tpl_vars['error']['url_name']): ?><br/><span style="color: red;">Podany url_name już istnieje.</span><?php endif; ?>
							        </p>							        					        
							        <p>
							           <label for="textarea">Mapa [425px / 350px]:</label>
							           <textarea name="product_form[video]" id="textarea2"  cols="40" rows="15"><?php echo ((is_array($_tmp=@$this->_tpl_vars['product']['video'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['video']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['video'])); ?>
</textarea>
							        </p>
							        <p>
	                                    <label for="selectbox">Kategoria:</label>
							            <select name="product_form[category_id]" class="kategoria" id="selectbox2" onchange="loadSeries();">


								            <option value="">- wybierz -</option>
												<?php $_from = $this->_tpl_vars['product_categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
													<?php if ($this->_tpl_vars['category']['sub']): ?>
													<?php $_from = $this->_tpl_vars['category']['sub']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sub1']):
?>
													<?php if (! $this->_tpl_vars['sub1']['sub']): ?>
													<option value="<?php echo $this->_tpl_vars['sub1']['id']; ?>
" <?php if ($this->_tpl_vars['product']['category_id'] == $this->_tpl_vars['sub1']['id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['category']['name']; ?>
 - <?php echo $this->_tpl_vars['sub1']['name']; ?>
</option>
													<?php endif; ?>		
															<?php if ($this->_tpl_vars['sub1']['sub']): ?>
															<?php $_from = $this->_tpl_vars['sub1']['sub']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sub2']):
?>
															<?php if (! $this->_tpl_vars['sub2']['sub']): ?>
															<option value="<?php echo $this->_tpl_vars['sub2']['id']; ?>
" <?php if ($this->_tpl_vars['product']['category_id'] == $this->_tpl_vars['sub2']['id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['category']['name']; ?>
 - <?php echo $this->_tpl_vars['sub1']['name']; ?>
 - <?php echo $this->_tpl_vars['sub2']['name']; ?>
</option>
															<?php endif; ?>	
																<?php if ($this->_tpl_vars['sub2']['sub']): ?>
																<?php $_from = $this->_tpl_vars['sub2']['sub']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sub3']):
?>
																<?php if (! $this->_tpl_vars['sub3']['sub']): ?>
																<option value="<?php echo $this->_tpl_vars['sub3']['id']; ?>
" <?php if ($this->_tpl_vars['product']['category_id'] == $this->_tpl_vars['sub3']['id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['category']['name']; ?>
 - <?php echo $this->_tpl_vars['sub1']['name']; ?>
 - <?php echo $this->_tpl_vars['sub2']['name']; ?>
 - <?php echo $this->_tpl_vars['sub3']['name']; ?>
</option>
																<?php endif; ?>
																<?php endforeach; endif; unset($_from); ?>
																<?php endif; ?>
															<?php endforeach; endif; unset($_from); ?>
															<?php endif; ?>												
													<?php endforeach; endif; unset($_from); ?>
													<?php endif; ?>
												<?php endforeach; endif; unset($_from); ?>
								        </select>						        							        		        
							        </p>							        
							        <p>
							            <label for="selectbox">Status:</label>
							            <select name="product_form[status]" id="product_form[status]" >
											<option value="1" <?php if ($this->_tpl_vars['product']['status'] == 1): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['dict_templates']['ArticleUnPublished']; ?>
</option>
											<option value="2" <?php if ($this->_tpl_vars['product']['status'] == 2): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['dict_templates']['ArticlePublished']; ?>
</option>
										
							            </select>
							        </p>
							        <p>
							           <label for="textarea2aaaa">Tagi:</label>
							           <textarea name="product_form[tags]" id="textarea2aaaa" class="richtextaaaaa" cols="40" rows="15"><?php echo ((is_array($_tmp=@$this->_tpl_vars['product']['tags'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['tags']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['tags'])); ?>
</textarea>
							        </p>
							        <p>
							           <label for="textarea2aaaa">Zajawka:</label>
							           <textarea name="product_form[abstract]" id="textarea2aaaa" class="richtextaaaaa" cols="40" rows="15"><?php echo ((is_array($_tmp=@$this->_tpl_vars['product']['abstract'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['abstract']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['abstract'])); ?>
</textarea>
							        </p>
							        <p>
							           <label for="textarea2">Opis działalności:</label>
							          <?php echo $this->_tpl_vars['sSpaw']; ?>

							        </p>
							        <p>
							           <label for="textarea2">Kontakt:</label>
							          <?php echo $this->_tpl_vars['sSpaw2']; ?>

							        </p>									
									
									<p>
										<br/>
										<label for="pic_01">Logo [jpeg, jpg - kwadrat]:</label>
										<input class="input-small" type="file" id="pic_01" name="pic_01" />
										
									</p>
									
									<?php if ($this->_tpl_vars['product']['pic_01']): ?>
									<p>
										<img src="<?php echo $this->_tpl_vars['__CFG']['base_url']; ?>
images/product/<?php echo $this->_tpl_vars['product']['product_id']; ?>
_01_01.jpg">
										<input type="checkbox" name="product_form[remove_picture_01]" value="1">Usuń zdjęcie
									<p>
									<?php endif; ?>							        
							        
								
							        <p>
							            <input class="button" name="submit" type="submit" value="Zapisz"/>
							        </p>
							    </form>
							    
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
                     
                <div id="footer">
                
                </div><!--end footer-->
                
        </div><!-- end top -->
        
    </body>
    
</html>

