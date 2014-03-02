<?php /* Smarty version 2.6.9, created on 2013-04-09 14:32:34
         compiled from main_search.tpl */ ?>

<section class="company-content" style="border-top: 0;">
		
		<div class="company-details">
			
			<h2>Wyniki wyszukiwania</h2>
			
			<?php if ($this->_tpl_vars['product_list']): ?>
			<?php $_from = $this->_tpl_vars['product_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
			<article class="label" style="cursor: pointer;">
				<h2><a href="<?php echo $this->_tpl_vars['DP']; ?>
firma/<?php echo $this->_tpl_vars['product']['url_name']; ?>
"><?php echo $this->_tpl_vars['product']['title']; ?>
</a></h2>
			</article>
			<div class="menu">
				<article>
					<figure>
						<a href="<?php echo $this->_tpl_vars['DP']; ?>
firma/<?php echo $this->_tpl_vars['product']['url_name']; ?>
"><img src="<?php echo $this->_tpl_vars['DP']; ?>
images/product/<?php echo $this->_tpl_vars['product']['product_id']; ?>
_02_01.jpg" alt="<?php echo $this->_tpl_vars['product']['title']; ?>
"/></a>
					</figure>
					<p><b>Opis</b><?php echo $this->_tpl_vars['product']['abstract']; ?>
</p>
					<p class="follow">
						<a href="<?php echo $this->_tpl_vars['DP']; ?>
firma/<?php echo $this->_tpl_vars['product']['url_name']; ?>
">&gt;&gt;</a>
					</p>
				</article>
			</div>
			
			
			<?php endforeach; endif; unset($_from); ?>
			<?php else: ?>

			<div style="color: #25AAE1; padding: 20px 0;">Brak wyników wyszukiwania dla frazy "<?php echo $this->_tpl_vars['ret_post']['phrase']; ?>
"</div>

			<?php endif; ?>

			
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