<?php /* Smarty version 2.6.9, created on 2013-02-21 20:49:25
         compiled from article_edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'article_edit.tpl', 54, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    
    <body>
    	
    	        
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "article_validate.tpl", 'smarty_include_vars' => array()));
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
							    <h2 class="jquery_tab_title"><?php if (! $this->_tpl_vars['article']['id']): ?>Dodaj artykuł<?php else: ?>Edycja artykułu<?php endif; ?></h2>
							    
							    
							    							    
							    
							    <form id="articleForm" method="post" enctype="multipart/form-data">
									<?php if ($this->_tpl_vars['article']['id']): ?>
									<input type="hidden" name="article_form[category_id]" value="<?php echo $this->_tpl_vars['article']['category_id']; ?>
">
									<?php else: ?>
									<input type="hidden" name="article_form[category_id]" value="<?php echo $this->_tpl_vars['CategoryId']; ?>
">
									<?php endif; ?>
									
									<input type="hidden" name="article_form[language_id]" value="1">
									<input type="hidden" name="article_form[article_id]" value="<?php echo $this->_tpl_vars['article']['article_id']; ?>
">
									<input type="hidden" name="action" value="SaveArticle">
									
									    
							        <p>
							            <label for="article_form[title]">Tytuł:</label>
							            <input class="input-big" type="text" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['article']['title'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['title']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['title'])); ?>
" name="article_form[title]" id="article_form[title]"/>
							        </p>
							      
							        <?php if ($this->_tpl_vars['CategoryId'] == 2 | $this->_tpl_vars['CategoryId'] == 3): ?>
							        <p>
							            <label for="article_form[url_name]">Nazwa url:</label>
							            <input class="input-big" type="text" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['article']['url_name'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['url_name']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['url_name'])); ?>
" name="article_form[url_name]" id="article_form[url_name]"/>
							        	<?php if ($this->_tpl_vars['error']['url_name']): ?><br/><span style="color: red;">Podany url_name już istnieje.</span><?php endif; ?>
							        </p>	
							        <?php endif; ?>						        
							        							        <?php if ($this->_tpl_vars['CategoryId'] == 2 | $this->_tpl_vars['CategoryId'] == 3): ?>
							        <p>
	                                    <label for="selectbox">Wybierz kategorię:</label>
							            <select style="width: 200px;" name="article_form[category_id]" id="selectbox">
											<?php $_from = $this->_tpl_vars['dict_templates']['article_category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['category']):
?>
											<option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['CategoryId'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['category']; ?>
</option>
											<?php endforeach; endif; unset($_from); ?>
							            </select>							        
							        
							        </p>
							        
							        
							        <p>
							            <label for="selectbox">Status:</label>
							            <select name="article_form[status]" id="article_form[status]" >
											<option value="1" <?php if ($this->_tpl_vars['article']['status'] == 1): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['dict_templates']['ArticleUnPublished']; ?>
</option>
											<option value="2" <?php if ($this->_tpl_vars['article']['status'] == 2): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['dict_templates']['ArticlePublished']; ?>
</option>
										
							            </select>
							        </p>
									<?php endif; ?>
							
							        							        <p>
							        	<label for="textarea2">Treść:</label>
							        	<?php echo $this->_tpl_vars['sSpaw']; ?>

							        </p>
							        									
																        
							           
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

