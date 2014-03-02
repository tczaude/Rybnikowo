<?php /* Smarty version 2.6.9, created on 2013-07-09 08:55:21
         compiled from main_blog_list.tpl */ ?>

<section class="company-content" style="border-top: 0;">
		
		<div class="company-details">
			
			<h2>Blog</h2>
			
			<?php if ($this->_tpl_vars['blog_list']): ?>
			<?php $_from = $this->_tpl_vars['blog_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['blog']):
?>
			<article class="label" style="cursor: pointer;">
				<h2><a href="<?php echo $this->_tpl_vars['DP']; ?>
blog/zobacz/<?php echo $this->_tpl_vars['blog']['url_name']; ?>
"><?php echo $this->_tpl_vars['blog']['title']; ?>
</a></h2>
			</article>
			<div class="menu">
				<article>
					<figure>
						<a href="<?php echo $this->_tpl_vars['DP']; ?>
blog/zobacz/<?php echo $this->_tpl_vars['blog']['url_name']; ?>
"><img src="<?php echo $this->_tpl_vars['DP']; ?>
images/blog/<?php echo $this->_tpl_vars['blog']['blog_id']; ?>
_02_01.jpg" alt="<?php echo $this->_tpl_vars['blog']['title']; ?>
"/></a>
					</figure>
					<p><?php echo $this->_tpl_vars['blog']['abstract']; ?>
</p>
					<p class="follow">
						<a href="<?php echo $this->_tpl_vars['DP']; ?>
blog/zobacz/<?php echo $this->_tpl_vars['blog']['url_name']; ?>
">&gt;&gt;</a>
					</p>
				</article>
			</div>
			
			
			<?php endforeach; endif; unset($_from); ?>
			
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "paging_blog.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php else: ?>

			<div style="color: #25AAE1; padding: 20px 0;">Brak wpisów - zapraszamy wkrótce</div>

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