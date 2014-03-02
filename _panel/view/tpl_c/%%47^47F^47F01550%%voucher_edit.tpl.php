<?php /* Smarty version 2.6.9, created on 2013-02-13 21:55:54
         compiled from voucher_edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'voucher_edit.tpl', 39, false),array('modifier', 'date_format', 'voucher_edit.tpl', 76, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    
    <body>
    	
    	        
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "voucher_validate.tpl", 'smarty_include_vars' => array()));
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
							    <h2 class="jquery_tab_title"><?php if (! $this->_tpl_vars['voucher']['id']): ?>Dodaj kod rabatowy<?php else: ?>Edycja kodu rabatowego<?php endif; ?></h2>
							    
							    
							    
							    <form id="voucherForm" method="post" enctype="multipart/form-data">

									<input type="hidden" name="voucher_form[id]" value="<?php echo $this->_tpl_vars['voucher']['id']; ?>
">
									<input type="hidden" name="action" value="SaveVoucherFromAdmin">

									    
							        <p>
							            <label for="bonus_code">Kod:</label>
							            <input class="input-small" type="text" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['voucher']['bonus_code'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['bonus_code']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['bonus_code'])); ?>
" name="voucher_form[bonus_code]" id="bonus_code"/>
							        	<?php if ($this->_tpl_vars['error']['bonus_code']): ?>
							        	<br><span htmlfor="voucher_form[bonus_code]" generated="true" class="error"><?php echo $this->_tpl_vars['error']['bonus_code']; ?>
</span>
							        	<?php endif; ?>
							        	<a href="#" onClick="getPassword('6','bonus_code');">generuj</a>
							        </p>
							        <p>
							            <label for="bonus_value">Wartość [x.00]:</label>
							            <input class="input-small" type="text" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['voucher']['value'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['value']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['value'])); ?>
" name="voucher_form[value]" id="bonus_value"/>
							        </p>
							        <?php if ($this->_tpl_vars['voucher']['id']): ?>
							        <?php if ($this->_tpl_vars['voucher']['fb_user_name']): ?>						        
							        <p>
							            <label for="voucher_form[fb_user_name]">Imię z FB:</label>
							            <input type="hidden" name="voucher_form[fb_user_name]" value="<?php echo $this->_tpl_vars['voucher']['fb_user_name']; ?>
" id="voucher_form[fb_user_name]"/>
							            <span><?php echo $this->_tpl_vars['voucher']['fb_user_name']; ?>
</span>
							        </p>	
							        <?php endif; ?>
							        
							        <?php if ($this->_tpl_vars['voucher']['fb_user_email']): ?>						        
							        <p>
							            <label for="voucher_form[fb_user_email]">Adres email z FB:</label>
							            <input type="hidden" name="voucher_form[fb_user_email]" value="<?php echo $this->_tpl_vars['voucher']['fb_user_email']; ?>
" id="voucher_form[fb_user_email]"/>
							            <span><?php echo $this->_tpl_vars['voucher']['fb_user_email']; ?>
</span>
							        </p>	
							        <?php endif; ?>
							        
							        <?php if ($this->_tpl_vars['voucher']['fb_user_access_token']): ?>						        
							        <p>
							            <label for="voucher_form[fb_user_access_token]">Token z FB:</label>
							            <input type="hidden" name="voucher_form[fb_user_access_token]" value="<?php echo $this->_tpl_vars['voucher']['fb_user_access_token']; ?>
" id="voucher_form[fb_user_access_token]"/>
							            <span><?php echo $this->_tpl_vars['voucher']['fb_user_access_token']; ?>
</span>
							        </p>	
							        <?php endif; ?>
							        <?php endif; ?>
							        <p>
										<label for="date">Data utworzenia:</label>
										<input class="input-small flexy_datepicker_input" type="text" value="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['voucher']['creation_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")))) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['creation_date']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['creation_date'])))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
" name="voucher_form[creation_date]" id="date"/>	
							        </p>
							        <p>
										<label for="date2">Data ważności:</label>
										<input class="input-small flexy_datepicker_input" type="text" value="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['voucher']['end_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")))) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['end_date']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['end_date'])))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
" name="voucher_form[end_date]" id="date2"/>	
							        </p>
							        <p>
							            <label for="selectbox">Status:</label>
							            <select name="voucher_form[status]" id="voucher_form[status]" >
											<option value="1" <?php if ($this->_tpl_vars['voucher']['status'] == 1): ?>selected<?php endif; ?>>Aktywny</option>
											<option value="2" <?php if ($this->_tpl_vars['voucher']['status'] == 2): ?>selected<?php endif; ?>>Nieaktywny</option>
										
							            </select>
							        </p>
							        <p>
							            <label for="selectbox">Wielorazowy:</label>
							            <select name="voucher_form[again]" id="voucher_form[again]" >
							            	<option value="">- wybierz -</option>
											<option value="1" <?php if ($this->_tpl_vars['voucher']['again'] == 1): ?>selected<?php endif; ?>>Nie</option>
											<option value="2" <?php if ($this->_tpl_vars['voucher']['again'] == 2): ?>selected<?php endif; ?>>Tak</option>
										
							            </select>
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

