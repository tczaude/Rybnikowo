<?php /* Smarty version 2.6.9, created on 2013-07-09 11:10:04
         compiled from main_contact.tpl */ ?>
<?php echo '
<script type="text/javascript">
$().ready(function() {
	$("#contact-form").validate({
		rules: {
			"contact_form[name]": {
				required: true
			},
			"contact_form[email]": {
				required: true,
				email: true
			},
			"contact_form[content]": {
				required: true
			},
			"contact_form[code]": {
				required: true,
				minlength: 5
			}
		},
		messages: {
			"contact_form[name]": {
				required: "Proszę podać swoje imię"
			},
			"contact_form[email]": {
				required: "Proszę podać adres e-mail",
				email: "Proszę podać poprawny adres e-mail"
			},
			"contact_form[content]": {
				required: "Proszę wpisać wiadomość"
			},
			"contact_form[code]": {
				required: "Proszę podać kod z obrazka",
				minlength: "Kod powinien zawierać 5 znaków"
			}
		}
	});

});
</script>
'; ?>

<section class="company-content" style="border-top: 0;">
		
		<div class="company-details">
			
			<h2><?php echo $this->_tpl_vars['intro_main']['title']; ?>
</h2>
			<div class="menu">
				<div id="1" class="map" style="border-top: 0;">

					<div class="desc"><?php echo $this->_tpl_vars['intro_main']['content']; ?>
</div>
				</div>
			</div>
			<div class="menu">
				<div id="1" class="map">
					<h4>Formularz kontaktowy</h4>
					<div class="desc">
					
						<div class="contact">
						
							<?php if ($this->_tpl_vars['error']): ?>
							<p style="color: red;">Popraw błędy</p>
							<?php endif; ?>	
							<?php if ($this->_tpl_vars['good_message']): ?>
							<p style="color: green;">Dziękujemy, wiadomość wysłana.</p>
							<?php endif; ?>	
							<form method="post" id="contact-form">
							<input type="hidden" name="action" value="SaveContact">
				
								<p>
									<label for="name">Adres e-mail</label>
									<input <?php if ($this->_tpl_vars['error']['email']): ?>style="border: 1px solid red;"<?php endif; ?> name="contact_form[email]" title="email" type="text" value="<?php echo $this->_tpl_vars['ret_post']['email']; ?>
" > 
									<?php if ($this->_tpl_vars['error']['email']): ?><label class="error"><?php echo $this->_tpl_vars['error']['email']; ?>
</label><?php endif; ?>
								</p>
								<p>
									<label for="name">Numer telefonu</label>
									<input <?php if ($this->_tpl_vars['error']['phone']): ?>style="border: 1px solid red;"<?php endif; ?> name="contact_form[phone]" title="telefon" type="text" value="<?php echo $this->_tpl_vars['ret_post']['phone']; ?>
" > 
									<?php if ($this->_tpl_vars['error']['phone']): ?><label class="error"><?php echo $this->_tpl_vars['error']['phone']; ?>
</label><?php endif; ?>
								</p>
								
								<p>
									<label for="text">Wiadomość</label>
									<textarea <?php if ($this->_tpl_vars['error']['content']): ?>style="border: 1px solid red;"<?php endif; ?> name="contact_form[content]" title="Wiadomość" type="text" rows="5" cols="38"><?php echo $this->_tpl_vars['ret_post']['content']; ?>
</textarea>
									<?php if ($this->_tpl_vars['error']['content']): ?><label class="error"><?php echo $this->_tpl_vars['error']['content']; ?>
</label><?php endif; ?>
								</p>
								<p><img src="<?php echo $this->_tpl_vars['DP']; ?>
captcha" class="captcha"></p>
								<p>
									<label for="name">Kod</label>
										
									<input <?php if ($this->_tpl_vars['error']['code']): ?>style="border: 1px solid red;"<?php endif; ?> name="contact_form[code]" class="captchaInput" title="kod" type="text" value=""> 
									<?php if ($this->_tpl_vars['error']['code']): ?>
									<label for="contact_form[code]" class="error"><?php echo $this->_tpl_vars['dict_templates']['ContactErrorCaptcha']; ?>
</label>
									<?php endif; ?>
								</p>	
								<p>
									<button type="submit" class="bnSend"></button>
								</p>
							
							</form>							
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						</div>
			
		
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					</div>
				</div>
			</div>

			
		</div>
		
		<ul class="company-list">
			<?php $_from = $this->_tpl_vars['menu_categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['menu']):
        $this->_foreach['menu']['iteration']++;
?>
			<li style="font: 12px/24px Arial,Verdana,sans-serif;"><a href="<?php echo $this->_tpl_vars['DP']; ?>
kategoria/<?php echo $this->_tpl_vars['menu']['url_name']; ?>
"><?php echo $this->_tpl_vars['menu']['name']; ?>
 <i>>></i></a></li>
			<?php endforeach; endif; unset($_from); ?>
	
		</ul>

	</section>