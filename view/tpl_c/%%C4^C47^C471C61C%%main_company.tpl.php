<?php /* Smarty version 2.6.9, created on 2013-04-04 15:41:25
         compiled from main_company.tpl */ ?>

	
	
	<?php if ($this->_tpl_vars['category_details']['parent'] == 0): ?>
	<div class="company-bread">
		<ul style="background-image:url(<?php echo $this->_tpl_vars['DP']; ?>
images/category_pictures/<?php echo $this->_tpl_vars['category_details']['id']; ?>
_02_01.jpg);">
			<li><a href="<?php echo $this->_tpl_vars['DP']; ?>
kategoria/<?php echo $this->_tpl_vars['category_details']['url_name']; ?>
"><strong><?php echo $this->_tpl_vars['category_details']['name']; ?>
<i>/</i></strong></a></li>
		</ul>
	</div>
	<?php else: ?>
	<div class="company-bread">
		<ul style="background-image:url(<?php echo $this->_tpl_vars['DP']; ?>
images/category_pictures/<?php echo $this->_tpl_vars['category_parent']['id']; ?>
_02_01.jpg);">
			<li><a href="<?php echo $this->_tpl_vars['DP']; ?>
kategoria/<?php echo $this->_tpl_vars['category_parent']['url_name']; ?>
"><strong><?php echo $this->_tpl_vars['category_parent']['name']; ?>
<i>/</i></strong></a></li>
			<li><?php echo $this->_tpl_vars['category_details']['name']; ?>
</li>
		</ul>
	</div>	
	<?php endif; ?>
	<section class="company-content">
		
		<div class="company-details">
		
			
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
					<p><b><?php if ($this->_tpl_vars['product']['type'] == 1): ?>O firmie<?php elseif ($this->_tpl_vars['product']['type'] == 2): ?>Krótki opis<?php endif; ?></b> <?php echo $this->_tpl_vars['product']['abstract']; ?>
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
			<?php if ($this->_tpl_vars['category_details']['parent'] == 0): ?>
			<span><img alt="brak kategorii" src="<?php echo $this->_tpl_vars['DP']; ?>
images/html/choose_category.png"/><a href="<?php echo $this->_tpl_vars['DP']; ?>
dla-firm"><img alt="oferta" src="<?php echo $this->_tpl_vars['DP']; ?>
images/html/choose_category2.png"/></a></span>
			<?php else: ?>
			Brak firmy - <a style="color: #25AAE1; font: 14px/24px Arial,Verdana,sans-serif;" href="<?php echo $this->_tpl_vars['DP']; ?>
dla-firm">bądź pierwszy</a>
			<?php endif; ?>
			
			<?php endif; ?>
			
		</div>
		<?php if ($this->_tpl_vars['subcategory_list']): ?>
		<ul class="company-list">
			<?php $_from = $this->_tpl_vars['subcategory_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['subcategory'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['subcategory']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['subcategory']):
        $this->_foreach['subcategory']['iteration']++;
?>
			<li  <?php if ($this->_tpl_vars['subcategory']['id'] != $this->_tpl_vars['category_details']['id']): ?>style="font: 12px/24px Arial,Verdana,sans-serif;"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['DP']; ?>
kategoria/<?php echo $this->_tpl_vars['subcategory']['url_name']; ?>
"><?php echo $this->_tpl_vars['subcategory']['name']; ?>
 <i>>></i></a></li>
			<?php endforeach; endif; unset($_from); ?>
	
		</ul>
		<?php else: ?>
		<ul class="company-list">
			<li  <?php if ($this->_tpl_vars['subcategory']['id'] != $this->_tpl_vars['category_details']['id']): ?>style="font: 12px/24px Arial,Verdana,sans-serif;"<?php endif; ?>>Brak subkategorii</li>
		</ul>		
		<?php endif; ?>
	</section>