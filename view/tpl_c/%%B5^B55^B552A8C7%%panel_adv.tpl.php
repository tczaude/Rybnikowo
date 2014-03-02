<?php /* Smarty version 2.6.9, created on 2013-03-11 15:49:45
         compiled from panel_adv.tpl */ ?>
			<ul class="comercial">
				
				<?php $_from = $this->_tpl_vars['slideshow_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['slideshow']):
?>
				<li>
					<?php echo $this->_tpl_vars['slideshow']['title']; ?>

					<a href="<?php echo $this->_tpl_vars['slideshow']['abstract']; ?>
" <?php if ($this->_tpl_vars['slideshow']['sended'] == 2): ?>target="_new"<?php endif; ?>><img src="<?php echo $this->_tpl_vars['DP']; ?>
images/slideshow/<?php echo $this->_tpl_vars['slideshow']['slideshow_id']; ?>
_03_01.jpg" alt="<?php echo $this->_tpl_vars['slideshow']['title']; ?>
"></a>
				</li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>