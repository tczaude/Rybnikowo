<?php /* Smarty version 2.6.9, created on 2013-03-12 11:38:48
         compiled from blog_edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'blog_edit.tpl', 42, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    
    <body>
    	
    	        
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "blog_validate.tpl", 'smarty_include_vars' => array()));
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
							    <h2 class="jquery_tab_title"><?php if (! $this->_tpl_vars['blog']['id']): ?>Dodaj bloga<?php else: ?>Edycja bloga<?php endif; ?></h2>
							    
							   
							    
							    
									<form id="blogForm" name="BlogEdit" method="post" enctype="multipart/form-data">
									
									<input type="hidden" name="blog_form[language_id]" value="1">
									<input type="hidden" name="blog_form[category_id]" value="1">
									<input type="hidden" name="blog_form[blog_id]" value="<?php echo $this->_tpl_vars['blog']['blog_id']; ?>
">
									<input type="hidden" name="action" value="SaveBlog">
									
									    
							        <p>
							            <label for="blog_form[title]">Tytuł:</label>
							            <input class="input-big" type="text" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['blog']['title'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['title']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['title'])); ?>
" name="blog_form[title]" id="blog_form[title]"/>
							        </p>
							      
							        
							        <p>
							            <label for="blog_form[url_name]">Nazwa url:</label>
							            <input class="input-big" type="text" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['blog']['url_name'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['url_name']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['url_name'])); ?>
" name="blog_form[url_name]" id="blog_form[url_name]"/>
							        	<?php if ($this->_tpl_vars['error']['url_name']): ?><br/><span style="color: red;">Podany url_name już istnieje.</span><?php endif; ?>
							        </p>							        
							        
							        <?php if ($this->_tpl_vars['CategoryId'] == 1): ?>
							        <p>
	                                    <label for="selectbox">Typ:</label>
							            <select style="width: 200px;" name="blog_form[type]" id="selectbox">
											<option value="">- wybierz -</option>
											<option value="1" <?php if ($this->_tpl_vars['blog']['type'] == 1): ?>selected<?php endif; ?>>szkolenia</option>
											<option value="2" <?php if ($this->_tpl_vars['blog']['type'] == 2): ?>selected<?php endif; ?>>akcje i wydarzenia</option>
							            </select>							        
							        </p>
							        <?php endif; ?>
							        
							        <p>
							            <label for="selectbox">Status:</label>
							            <select name="blog_form[status]" id="blog_form[status]" >
											<option value="1" <?php if ($this->_tpl_vars['blog']['status'] == 1): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['dict_templates']['ArticleUnPublished']; ?>
</option>
											<option value="2" <?php if ($this->_tpl_vars['blog']['status'] == 2): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['dict_templates']['ArticlePublished']; ?>
</option>
										
							            </select>
							        </p>
							
							        <p>
	                                    <label for="selectbox">Wybierz kategorię, do której ma być przypisany wpis:</label>
							            <select name="blog_form[author_id]" id="selectbox">
								            <option value="">- wybierz -</option>
												<?php $_from = $this->_tpl_vars['kind_categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
												<option value="<?php echo $this->_tpl_vars['category']['id']; ?>
" <?php if ($this->_tpl_vars['blog']['author_id'] == $this->_tpl_vars['category']['id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['category']['name']; ?>
</option>
												<?php endforeach; endif; unset($_from); ?>
								            </select>						        
							        
							        </p>							
							        
							        <p>
							           <label for="textarea2">Zajawka:</label>
							           <textarea name="blog_form[abstract]" id="textarea2" cols="40" rows="15"><?php echo ((is_array($_tmp=@$this->_tpl_vars['blog']['abstract'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['abstract']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['abstract'])); ?>
</textarea>
							        </p>

							        <p>
							        	<label for="textarea2">Treść:</label>
							        	<?php echo $this->_tpl_vars['sSpaw']; ?>

							        </p>							        
									
									
									
									
									<p>
										<br/>
										<label for="pic_01">Grafika 1:</label>
										<input class="input-small" type="file" id="pic_01" name="pic_01" />
										
									</p>
									 
									<?php if ($this->_tpl_vars['blog']['pic_01']): ?>
									<p>
										<img src="http://www.rybnikowo.pl/images/blog/<?php echo $this->_tpl_vars['blog']['blog_id']; ?>
_01_01.jpg">
										<input type="checkbox" name="blog_form[remove_picture_01]" value="1">Usuń zdjęcie
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

