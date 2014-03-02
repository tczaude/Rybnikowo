<?php /* Smarty version 2.6.9, created on 2013-03-20 14:23:48
         compiled from footer.tpl */ ?>
	<footer>
		<div class="wrapper">
			<h1><a href="/">Rybnikowo.pl - Wszystko pod ręką</a></h1>
			
			<ul>
				<li>
					<p>Kategorie</p>
					<ul>
						<?php $_from = $this->_tpl_vars['menu_categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['menu']):
        $this->_foreach['menu']['iteration']++;
?>
						<?php if ($this->_foreach['menu']['iteration'] < 8): ?>
						<li><a href="<?php echo $this->_tpl_vars['DP']; ?>
kategoria/<?php echo $this->_tpl_vars['menu']['url_name']; ?>
"><?php echo $this->_tpl_vars['menu']['name']; ?>
</a></li>
						<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
					</ul>
				</li>
				<li>
					<p>&nbsp;</p>
					<ul>
						<?php $_from = $this->_tpl_vars['menu_categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['menu']):
        $this->_foreach['menu']['iteration']++;
?>
						<?php if ($this->_foreach['menu']['iteration'] < 15 && $this->_foreach['menu']['iteration'] > 7): ?>
						<li><a href="<?php echo $this->_tpl_vars['DP']; ?>
kategoria/<?php echo $this->_tpl_vars['menu']['url_name']; ?>
"><?php echo $this->_tpl_vars['menu']['name']; ?>
</a></li>
						<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
					</ul>
				</li>
				<li>
					<p>&nbsp;</p>
					<ul>
						<?php $_from = $this->_tpl_vars['menu_categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['menu']):
        $this->_foreach['menu']['iteration']++;
?>
						<?php if ($this->_foreach['menu']['iteration'] < 21 && $this->_foreach['menu']['iteration'] > 14): ?>
						<li><a href="<?php echo $this->_tpl_vars['DP']; ?>
kategoria/<?php echo $this->_tpl_vars['menu']['url_name']; ?>
"><?php echo $this->_tpl_vars['menu']['name']; ?>
</a></li>
						<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
					</ul>
				</li>

				<li>
					<p>Kontakt</p>
					<ul>	
						<li>tel: 783 306 710</li>
						<li>e-mail: serwis@rybnikowo.pl</li>
					</ul>
				</li>

				
			</ul>
			<div style="float: right; padding: 40px 40px 0 0;">
				
				<div><a target="_new" href="http://www.code13.pl"><img src="<?php echo $this->_tpl_vars['DP']; ?>
images/html/bn-c13.png"></a></div>
				
			</div>
			</div>

	</footer>