<?php /* Smarty version 2.6.9, created on 2013-04-04 16:21:02
         compiled from partner_edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'partner_edit.tpl', 42, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    
    <body>
    	
    	        
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "partner_validate.tpl", 'smarty_include_vars' => array()));
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
							    <h2 class="jquery_tab_title"><?php if (! $this->_tpl_vars['partner']['id']): ?>Dodaj partnera<?php else: ?>Edycja partnera<?php endif; ?></h2>
							    
							   
							    
							    
									<form id="partnerForm" name="PartnerEdit" method="post" enctype="multipart/form-data">
									
									<input type="hidden" name="partner_form[language_id]" value="1">
									<input type="hidden" name="partner_form[category_id]" value="1">
									<input type="hidden" name="partner_form[partner_id]" value="<?php echo $this->_tpl_vars['partner']['partner_id']; ?>
">
									<input type="hidden" name="action" value="SavePartner">
									
									    
							        <p>
							            <label for="partner_form[title]">Tytuł:</label>
							            <input class="input-big" type="text" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['partner']['title'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['title']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['title'])); ?>
" name="partner_form[title]" id="partner_form[title]"/>
							        </p>
							      
							        
							        <p>
							            <label for="partner_form[url_name]">Nazwa url:</label>
							            <input class="input-big" type="text" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['partner']['url_name'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['url_name']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['url_name'])); ?>
" name="partner_form[url_name]" id="partner_form[url_name]"/>
							        	<?php if ($this->_tpl_vars['error']['url_name']): ?><br/><span style="color: red;">Podany url_name już istnieje.</span><?php endif; ?>
							        </p>							        
							        <p>
							            <label for="selectbox">Status:</label>
							            <select name="partner_form[status]" id="partner_form[status]" >
											<option value="1" <?php if ($this->_tpl_vars['partner']['status'] == 1): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['dict_templates']['ArticleUnPublished']; ?>
</option>
											<option value="2" <?php if ($this->_tpl_vars['partner']['status'] == 2): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['dict_templates']['ArticlePublished']; ?>
</option>
										
							            </select>
							        </p>
							        <p>
							           <label for="textarea2">Link [http://www.onet.pl]:</label>
							           <input class="input-big" type="text" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['partner']['abstract'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['abstract']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['abstract'])); ?>
" name="partner_form[abstract]" id="partner_form[abstract]"/>
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
									 
									<?php if ($this->_tpl_vars['partner']['pic_01']): ?>
									<p>
										<img src="http://www.rybnikowo.pl/images/partner/<?php echo $this->_tpl_vars['partner']['partner_id']; ?>
_01_01.jpg">
										<input type="checkbox" name="partner_form[remove_picture_01]" value="1">Usuń zdjęcie
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

