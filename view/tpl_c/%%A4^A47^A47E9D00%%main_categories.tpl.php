<?php /* Smarty version 2.6.9, created on 2013-02-22 19:08:44
         compiled from main_categories.tpl */ ?>
<ul class="category">
	<?php $_from = $this->_tpl_vars['menu_categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['menu']):
        $this->_foreach['menu']['iteration']++;
?>	
	<li <?php if (($this->_foreach['menu']['iteration']-1) == 0 || ($this->_foreach['menu']['iteration']-1) == 1 || ($this->_foreach['menu']['iteration']-1) == 2 || ($this->_foreach['menu']['iteration']-1) == 3 || ($this->_foreach['menu']['iteration']-1) == 4): ?> style="border-top: 0;"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['DP']; ?>
kategoria/<?php echo $this->_tpl_vars['menu']['url_name']; ?>
" style="background-image:url(<?php echo $this->_tpl_vars['DP']; ?>
images/category_pictures/<?php echo $this->_tpl_vars['menu']['id']; ?>
_02_01.jpg);"><?php echo $this->_tpl_vars['menu']['name']; ?>
</a></li>
	<?php endforeach; endif; unset($_from); ?>
</ul>