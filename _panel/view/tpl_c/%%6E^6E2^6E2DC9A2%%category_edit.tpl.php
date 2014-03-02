<?php /* Smarty version 2.6.9, created on 2013-02-18 15:30:54
         compiled from category_edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'category_edit.tpl', 34, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    
    <body>
    	
    	        
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "category_validate.tpl", 'smarty_include_vars' => array()));
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
							    <h2 class="jquery_tab_title"><?php if (! $this->_tpl_vars['category']['id']): ?>Dodaj kategorię<?php else: ?>Edycja kategorii<?php endif; ?></h2>
							   
							    
							    
							    <form class="cmxform" id="signupForm" enctype="multipart/form-data" method="post">
									<input type="hidden" name="category[id]" value="<?php echo $this->_tpl_vars['category']['id']; ?>
">
									<input type="hidden" name="category[type]" value="<?php echo $this->_tpl_vars['category']['type']; ?>
">
									<input type="hidden" name="category[parent]" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['ParentId'])) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
">
									<input type="hidden" name="action" value="SaveCategory">		
									    
							        <p>
							        	W kategorii: <strong><?php if ($this->_tpl_vars['parent']['name']):  echo $this->_tpl_vars['parent']['name'];  else: ?>głównej<?php endif; ?></strong>
							        </p>
							        <p>
							            <label for="category[title]">Nazwa:</label>
							            <input class="input-big" type="text" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['category']['name'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['name']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['name'])); ?>
" name="category[name]" id="category[name]"/>
							        </p>
							      
							        
							        <p>
							            <label for="category[url_name]">Nazwa url:</label>
							            <input class="input-big" type="text" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['category']['url_name'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['url_name']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['url_name'])); ?>
" name="category[url_name]" id="category[url_name]"/>
							        	<?php if ($this->_tpl_vars['error']['url_name']): ?><br/><span style="color: red;">Podany url_name już istnieje.</span><?php endif; ?>
							        </p>				
							        
							        <p>
							            <label for="selectbox">Status:</label>
							            <select name="category[status]" id="category[status]" >
											<option value="0" <?php if ($this->_tpl_vars['category']['status'] == 0): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['dict_templates']['ArticleUnPublished']; ?>
</option>
											<option value="1" <?php if ($this->_tpl_vars['category']['status'] == 1): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['dict_templates']['ArticlePublished']; ?>
</option>
										
							            </select>
							        </p>
							        <?php if ($this->_tpl_vars['ParentId'] == 0): ?>
									<p>
										<br/>
										<label for="pic_01">Grafika [90px/90px].jpg:</label>
										<input class="input-small" type="file" id="pic_01" name="pic_01" />
										
									</p>
									<br/>
									<?php if ($this->_tpl_vars['category']['pic_01']): ?>
									<p>
										<img src="<?php echo $this->_tpl_vars['__CFG']['base_url']; ?>
images/category_pictures/<?php echo $this->_tpl_vars['category']['id']; ?>
_01_01.jpg">
										<input type="checkbox" name="category[remove_picture_01]" value="1">Usuń zdjęcie
									<p>
									<?php endif; ?>
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

