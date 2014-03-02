<?php /* Smarty version 2.6.9, created on 2013-02-22 16:45:35
         compiled from picture_edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'picture_edit.tpl', 39, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head_picture.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 <?php if ($this->_tpl_vars['close']): ?>
<script language="JavaScript">
	window.opener.location = '<?php echo $this->_tpl_vars['location']; ?>
';
	window.close();
</script>
<?php endif; ?>   
    <body>
    	
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "picture_validate.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <div id="top" style="max-width: 300px; min-width: 300px;">
        

           	
            	<div>
                
                    <div id="main">
                    
                        <div id="content" style="margin-left: 0px;">
                        
							<div class="jquery_tab">
							
							<div class="content_block">
							    <h2 class="jquery_tab_title"><?php if (! $this->_tpl_vars['picture']['id']): ?>Dodawanie zdjęcia<?php else: ?>Edycja zdjęcia<?php endif; ?></h2>

							    
							    <form id="pictureForm" method="post" enctype="multipart/form-data">

									<?php if ($this->_tpl_vars['picture']['id']): ?>
									<input type="hidden" name="picture_form[category_id]" value="<?php echo $this->_tpl_vars['url_config']['4']; ?>
">
									<?php else: ?>
									<input type="hidden" name="picture_form[category_id]" value="<?php echo $this->_tpl_vars['url_config']['3']; ?>
">
									<?php endif; ?>									
									
								
									<input type="hidden" name="picture_form[language_id]" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['picture']['language_id'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['language_id']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['language_id'])); ?>
">
									<input type="hidden" name="picture_form[picture_id]" value="<?php echo $this->_tpl_vars['picture']['picture_id']; ?>
">
									<input type="hidden" name="action" value="SavePicture">
									
									    
							        <p>
							            <label for="picture_form[title]">Nazwa:</label>
							            <input class="input-medium" type="text" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['picture']['title'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['title']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['title'])); ?>
" name="picture_form[title]" id="picture_form[title]"/>
							        </p>
							        <p>
							            <label for="selectbox">Status:</label>
							            <select name="picture_form[status]" id="picture_form[status]" >
											<option value="1" <?php if ($this->_tpl_vars['picture']['status'] == 1): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['dict_templates']['ArticleUnPublished']; ?>
</option>
											<option value="2" <?php if ($this->_tpl_vars['picture']['status'] == 2): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['dict_templates']['ArticlePublished']; ?>
</option>
										
							            </select>
							        </p>
																        <p>
							            <label for="picture_form[podpis]">Podpis:</label>
							            <input class="input-big" type="text" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['picture']['podpis'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['podpis']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['podpis'])); ?>
" name="picture_form[podpis]" id="picture_form[podpis]"/>
							        </p>	
									<p>
										<br/>
										<label for="pic_01">Grafika 1:</label>
										<input class="input-small" type="file" id="pic_01" name="pic_01" />
										
									</p>
									
									<?php if ($this->_tpl_vars['picture']['pic_01']): ?>
									<p>
										<img src="<?php echo $this->_tpl_vars['__CFG']['base_url']; ?>
images/picture/<?php echo $this->_tpl_vars['picture']['picture_id']; ?>
_01_01.jpg">
										<input type="checkbox" name="picture_form[remove_picture_01]" value="1">Usuń zdjęcie
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
                    

                        
                     </div><!--end bg_wrapper-->
                     <div class="clearboth"></div>

                
        </div><!-- end top -->
        
        <?php echo '
        		
		
<script type="text/javascript">$(\'#example1\').datetimepicker();
</script>

'; ?>

		<?php echo '	
		
		<script type="text/javascript">
		
		function openwin(url)
		{
			var w = 450;
			var h = 250;
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