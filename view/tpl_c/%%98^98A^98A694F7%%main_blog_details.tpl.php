<?php /* Smarty version 2.6.9, created on 2013-07-09 17:00:44
         compiled from main_blog_details.tpl */ ?>
<?php echo '
	<script type="text/javascript">
		$(document).ready(function() {
			$("a[rel=blog_picture]").fancybox({
				\'transitionIn\'		: \'fade\',
				\'transitionOut\'		: \'fade\',
				\'titlePosition\' 	: \'over\',
				\'overlayColor\'		: \'#000\',
				\'overlayOpacity\'	: 0.6
			});
		});
	</script>

'; ?>
	
<section class="company-content" style="border-top: 0;">
		
		<div class="company-details">
			
			<h2>Blog</h2>
			
			<?php if ($this->_tpl_vars['blog_details']): ?>
			<article class="label" style="cursor: pointer;">
				<h2 style="color: #25AAE1;"><?php echo $this->_tpl_vars['blog_details']['title']; ?>
</h2>
			</article>
			<div class="menu">
				<article class="menu55">
					<figure>
						<a href="<?php echo $this->_tpl_vars['DP']; ?>
images/blog/<?php echo $this->_tpl_vars['blog_details']['blog_id']; ?>
_04_01.jpg" alt="<?php echo $this->_tpl_vars['blog']['title']; ?>
" title="<?php echo $this->_tpl_vars['blog']['title']; ?>
" rel=blog_picture>
							<img src="<?php echo $this->_tpl_vars['DP']; ?>
images/blog/<?php echo $this->_tpl_vars['blog_details']['blog_id']; ?>
_02_01.jpg" alt="<?php echo $this->_tpl_vars['blog_details']['title']; ?>
"/>
						</a>
					</figure>
					<p><strong><?php echo $this->_tpl_vars['blog_details']['abstract']; ?>
</strong></p>
					<div id="blog_details"><p><?php echo $this->_tpl_vars['blog_details']['content']; ?>
</p></div>
					<p class="follow">
						<a href="javascript:history.go(-1);">&lt;&lt; wstecz</a>
					</p>
				</article>
			</div>

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