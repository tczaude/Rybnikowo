<?php /* Smarty version 2.6.9, created on 2013-07-03 10:29:11
         compiled from main_article.tpl */ ?>

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