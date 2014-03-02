<?php /* Smarty version 2.6.9, created on 2013-02-21 20:55:15
         compiled from slideshow_edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'slideshow_edit.tpl', 44, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    
    <body>
    	
    	        
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "slideshow_validate.tpl", 'smarty_include_vars' => array()));
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
							    <h2 class="jquery_tab_title"><?php if (! $this->_tpl_vars['slideshow']['id']): ?>Dodaj slajd<?php else: ?>Edycja slajdu<?php endif; ?></h2>

							    
							    <form id="slideshowForm" method="post" enctype="multipart/form-data">
									<?php if ($this->_tpl_vars['slideshow']['id']): ?>
									<input type="hidden" name="slideshow_form[category_id]" value="<?php echo $this->_tpl_vars['slideshow']['category_id']; ?>
">
									<?php else: ?>
									<input type="hidden" name="slideshow_form[category_id]" value="1">
									<?php endif; ?>
									
									<input type="hidden" name="slideshow_form[language_id]" value="1">
									<input type="hidden" name="slideshow_form[slideshow_id]" value="<?php echo $this->_tpl_vars['slideshow']['slideshow_id']; ?>
">
									<input type="hidden" name="action" value="SaveSlideshow">
									
									    
							        <p>
							            <label for="slideshow_form[title]">Tytuł:</label>
							            <input class="input-big" type="text" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['slideshow']['title'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['title']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['title'])); ?>
" name="slideshow_form[title]" id="slideshow_form[title]"/>
							        </p>
							        <p>
							           <label for="textarea">Link:</label>
							           <input class="input-big" type="text" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['slideshow']['abstract'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['abstract']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['abstract'])); ?>
" name="slideshow_form[abstract]" id="slideshow_form[abstract]"/>
							        </p>
							        <p>
							            <label for="selectbox">Typ linku:</label>
							            <select name="slideshow_form[sended]" id="slideshow_form[sended]" >
											<option value="1" <?php if ($this->_tpl_vars['slideshow']['sended'] == 1): ?>selected<?php endif; ?>>wewnętrzny</option>
											<option value="2" <?php if ($this->_tpl_vars['slideshow']['sended'] == 2): ?>selected<?php endif; ?>>zewnętrzny</option>
										
							            </select>
							        </p>
							        <p>
							            <label for="selectbox">Status:</label>
							            <select name="slideshow_form[status]" id="slideshow_form[status]" >
											<option value="1" <?php if ($this->_tpl_vars['slideshow']['status'] == 1): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['dict_templates']['ArticleUnPublished']; ?>
</option>
											<option value="2" <?php if ($this->_tpl_vars['slideshow']['status'] == 2): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['dict_templates']['ArticlePublished']; ?>
</option>
										
							            </select>
							        </p>
							        									
									
									
									<p>
										<br/>
										<label for="pic_01">Zdjęcie [265px/265px]:</label>
										<input class="input-small" type="file" id="pic_01" name="pic_01" />
										
									</p>
									
									<br/>
									
									<?php if ($this->_tpl_vars['slideshow']['pic_01']): ?>
									<p>
										<img src="<?php echo $this->_tpl_vars['__CFG']['base_url']; ?>
images/slideshow/<?php echo $this->_tpl_vars['slideshow']['slideshow_id']; ?>
_01_01.jpg">
										<input type="checkbox" name="slideshow_form[remove_picture_01]" value="1">Usuń zdjęcie
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

