<?php /* Smarty version 2.6.9, created on 2013-02-13 21:47:50
         compiled from order_edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'string_format', 'order_edit.tpl', 58, false),array('modifier', 'default', 'order_edit.tpl', 96, false),)), $this); ?>
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
							    <h2 class="jquery_tab_title">Podgląd zamówienia nr: (<span style="color: black;"><?php echo $this->_tpl_vars['order']['id']; ?>
</span>) - <?php echo $this->_tpl_vars['order']['date_created']; ?>
</h2>
								
								<h4>Dane klienta:</h4>    
						        <p>
						            Imię i nazwisko: <span><strong><a href="<?php echo $this->_tpl_vars['path']; ?>
/user/edit/<?php echo $this->_tpl_vars['order']['user_details']['id']; ?>
/"><?php echo $this->_tpl_vars['order']['user_details']['surname']; ?>
 <?php echo $this->_tpl_vars['order']['user_details']['name']; ?>
</a></strong></span><br/>
						            Adres: <span><strong><?php echo $this->_tpl_vars['order']['user_details']['street']; ?>
, <?php echo $this->_tpl_vars['order']['user_details']['zipcode']; ?>
 <?php echo $this->_tpl_vars['order']['user_details']['city']; ?>
</strong></span><br/>
						        	Faktura VAT: <span><strong><?php if ($this->_tpl_vars['order']['invoice'] == 1): ?><span style="color: red;">TAK</span><?php else: ?><span style="color: black;">NIE<?php endif; ?></strong></span><br/>
						        </p>
						        <h4>Dane firmowe:</h4> 
						        <p>
						            Firma: <span><strong><?php if ($this->_tpl_vars['order']['user_details']['company']): ?><span style="color: red;"><?php echo $this->_tpl_vars['order']['user_details']['company']; ?>
</span><?php else: ?>-<?php endif; ?></strong></span><br/>						        
						            NIP: <span><strong><?php if ($this->_tpl_vars['order']['user_details']['nip']): ?><span style="color: red;"><?php echo $this->_tpl_vars['order']['user_details']['nip']; ?>
</span><?php else: ?>-<?php endif; ?></strong></span><br/>
						        </p>
						        
						        
							    <h4>Dane kontaktowe:</h4>
						        <p>
						            Telefon: <span><strong><?php echo $this->_tpl_vars['order']['user_details']['phone']; ?>
 </strong></span><br/>
						            Adres e-mail: <span><strong><a href="mailto:<?php echo $this->_tpl_vars['order']['user_details']['email']; ?>
"><?php echo $this->_tpl_vars['order']['user_details']['email']; ?>
</a></strong></span><br/>
						        </p>
						        							    
							    <h4>Dostawa:</h4>
						        <p>
						            Forma transportu: <span><strong><?php if ($this->_tpl_vars['order']['delivery'] == 1): ?>kurier - wpłata na konto<?php elseif ($this->_tpl_vars['order']['delivery'] == 2): ?>kurier - płatnośc online<?php elseif ($this->_tpl_vars['order']['delivery'] == 3): ?>kurier - pobranie<?php elseif ($this->_tpl_vars['order']['delivery'] == 4): ?>poczta - wpłata na konto<?php elseif ($this->_tpl_vars['order']['delivery'] == 5): ?>poczta - płatnośc online<?php elseif ($this->_tpl_vars['order']['delivery'] == 6): ?>poczta - pobranie<?php elseif ($this->_tpl_vars['order']['delivery'] == 7): ?>odbiór własny - płatne przy odbiorze<?php elseif ($this->_tpl_vars['order']['delivery'] == 8): ?>list polecony - wpłata na konto<?php elseif ($this->_tpl_vars['order']['delivery'] == 9): ?>list polecony - płatnośc online<?php endif; ?></strong></span><br/>
						            Firma: <span><strong><?php if ($this->_tpl_vars['order']['company']): ?><span style="color: red;"><?php echo $this->_tpl_vars['order']['company']; ?>
</span><?php else: ?>-<?php endif; ?></strong></span><br/>			            
						            Adres: <span><strong><?php echo $this->_tpl_vars['order']['surname']; ?>
 <?php echo $this->_tpl_vars['order']['name']; ?>
 - <?php echo $this->_tpl_vars['order']['street']; ?>
, <?php echo $this->_tpl_vars['order']['zipcode']; ?>
 <?php echo $this->_tpl_vars['order']['city']; ?>
</strong></span><br/>
						        </p>
							    <h4>Zamawiane produkty:</h4>
						        <p>
						        	<?php $_from = $this->_tpl_vars['order']['details']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['product'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['product']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['product']['iteration']++;
?>
						        	
						        	<span><?php echo $this->_foreach['product']['iteration']; ?>
.<strong><a href="<?php echo $this->_tpl_vars['__CFG']['base_url']; ?>
pozycja/<?php echo $this->_tpl_vars['product']['url_name']; ?>
/" target="_blank"><?php echo $this->_tpl_vars['product']['name']; ?>
</a></strong></span>&nbsp;&nbsp;&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['quantity'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.0f") : smarty_modifier_string_format($_tmp, "%.0f")); ?>
&nbsp;   x <?php echo $this->_tpl_vars['product']['price']; ?>
 = <?php echo $this->_tpl_vars['product']['value']; ?>
 PLN<br/>
						        	
						        	<?php endforeach; endif; unset($_from); ?>

						        </p>						        							    
							    <h4>Podsumowanie:</h4>
						        <p>
						        Wartość: <strong><?php echo $this->_tpl_vars['order']['value_pln']; ?>
 PLN</strong><br/>
						        Dostawa: <strong><?php echo ((is_array($_tmp=$this->_tpl_vars['order']['costs'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 PLN</strong><br/>
						        RAZEM: <strong><?php echo $this->_tpl_vars['order']['to_pay']; ?>
 PLN</strong><br/><br/>
						        
						        Uwagi: <strong style="color: red;"><?php echo $this->_tpl_vars['order']['description']; ?>
</strong><br/>
						        
						        <?php if ($this->_tpl_vars['order']['transaction_status']): ?>
						        
						        platnosci.pl: <strong style="color: purple;"><?php echo $this->_tpl_vars['dict_templates']['transaction_message'][$this->_tpl_vars['order']['transaction_status']]['name']; ?>
</strong><br/>
						        
						        <?php endif; ?>
						        
						        
								</p>							    
							    
							    
									<form id="bonusForm" method="post" enctype="multipart/form-data">

										<input type="hidden" name="order_form[order_id]" value="<?php echo $this->_tpl_vars['order']['id']; ?>
"/>
										<input type="hidden" name="action" value="SaveOrder"/>
									
							        <p>
							            <label for="selectbox">Status:</label>
							            <select name="order_form[status]" id="order_form[status]" >
							            <?php $_from = $this->_tpl_vars['dict_templates']['status_message']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['status']):
?>
											<option value="<?php echo $this->_tpl_vars['status']['id']; ?>
" <?php if ($this->_tpl_vars['order']['status'] == $this->_tpl_vars['status']['id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['status']['name']; ?>
</option>
										<?php endforeach; endif; unset($_from); ?>
							            </select>
							        </p>							
								    <p>
							           <label for="order_form[message]">Wiadomość:</label>
							           <textarea name="order_form[message]" id="order_form[message]" class="richtext" cols="40" rows="15"><?php echo ((is_array($_tmp=@$this->_tpl_vars['order']['abstract'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['ret_post']['abstract']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['ret_post']['abstract'])); ?>
</textarea>
							        </p>
							        <p>
							        	<label for="order_form[send]">Wyślij powiadomienie klientowi:</label>
							        	<input type="checkbox" name="order_form[send]" value="1"/>
							        </p>
							        <p>
							        	<label for="order_form[send]">Zapisz:</label>
							        	<input type="checkbox" name="order_form[save]" value="1"/>
							        </p>							        
							        <?php if ($this->_tpl_vars['message_list']): ?>
							        <p>
							        <?php $_from = $this->_tpl_vars['message_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['message']):
?>
							        <span style="color: gray;"><?php echo $this->_tpl_vars['message']['date_created']; ?>
</span><br/>
							        <span><?php echo $this->_tpl_vars['message']['message']; ?>
</span><br/><br/>
							        <?php endforeach; endif; unset($_from); ?>
							        
							        </p>
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

