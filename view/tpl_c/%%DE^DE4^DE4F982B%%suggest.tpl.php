<?php /* Smarty version 2.6.9, created on 2013-02-18 20:19:55
         compiled from suggest.tpl */ ?>
<?php if ($this->_tpl_vars['ajax_list']): ?>
	<ul>
		<?php $_from = $this->_tpl_vars['ajax_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
		<li class="sugSeg" onclick="window.location='<?php echo $this->_tpl_vars['DP']; ?>
firma/<?php echo $this->_tpl_vars['product']['url_name']; ?>
'">
			
			
			
				<?php if ($this->_tpl_vars['product']['pic_01']): ?>
				<div style="width: 50px; height: 50px; float: left; padding: 5px;">
					<img src="<?php echo $this->_tpl_vars['DP']; ?>
images/product/<?php echo $this->_tpl_vars['product']['product_id']; ?>
_01_01.jpg" alt="<?php echo $this->_tpl_vars['product']['title']; ?>
">
				</div>
				<?php else: ?>
					<img  src="<?php echo $this->_tpl_vars['DP']; ?>
images/html/newspic.png" alt="<?php echo $this->_tpl_vars['product']['title']; ?>
">
				<?php endif; ?>	
				<h2><?php echo $this->_tpl_vars['product']['title']; ?>
</h2>
			
			
		</li>
		<?php endforeach; endif; unset($_from); ?>
	</ul>	
		<!-- Brak wynikow wyszukiwania w informacjach -->
<?php else: ?>
		
	<p>Brak wyników</p>


<?php endif; ?>