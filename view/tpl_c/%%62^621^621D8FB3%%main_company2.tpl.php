<?php /* Smarty version 2.6.9, created on 2013-06-11 10:24:43
         compiled from main_company2.tpl */ ?>
<?php echo '
	<script type="text/javascript">
		$(document).ready(function() {
			$("a[rel=company_picture]").fancybox({
				\'transitionIn\'		: \'fade\',
				\'transitionOut\'		: \'fade\',
				\'titlePosition\' 	: \'over\',
				\'overlayColor\'		: \'#000\',
				\'overlayOpacity\'	: 0.6
			});
		});
	</script>

'; ?>
	
	
	
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
			<ul>
				<li><a href="#1">Opis</a> <i>/</i></li>
				<li><a href="#2">Kontakt</a> <i>/</i></li>
				<li><a href="#3">Mapa dojazdu</a> <i>/</i></li>
				<?php if ($this->_tpl_vars['pictures_list']): ?>
				<li><a href="#4">Zdjęcia </a> <i>/</i></li>
				<?php endif; ?>
			</ul>		
			
			<?php if ($this->_tpl_vars['product_details']): ?>

			<article class="label" style="cursor: pointer;">
				<h2 style="color: #25AAE1;"><?php echo $this->_tpl_vars['product_details']['title']; ?>
</h2>
			</article>
			<div class="menu">
				<article>
					<figure>
						<img src="<?php echo $this->_tpl_vars['DP']; ?>
images/product/<?php echo $this->_tpl_vars['product_details']['product_id']; ?>
_02_01.jpg"/>
					</figure>
					<p><b><?php if ($this->_tpl_vars['product_details']['type'] == 1): ?>O firmie<?php elseif ($this->_tpl_vars['product_details']['type'] == 2): ?>Krótki opis<?php endif; ?></b> <?php echo $this->_tpl_vars['product_details']['abstract']; ?>
</p>
				</article>	
				<div id="1" class="map">
					<h4><?php if ($this->_tpl_vars['product_details']['type'] == 1): ?>Opis działalności<?php elseif ($this->_tpl_vars['product_details']['type'] == 2): ?>Opis<?php endif; ?></h4>
					<div class="desc"><?php echo $this->_tpl_vars['product_details']['content']; ?>
</div>
				</div>
				<?php if ($this->_tpl_vars['pictures_list']): ?>
				<div id="4" class="map">
					<h4>Zdjęcia</h4>
					<ul style="border-bottom: 0;">
					<?php $_from = $this->_tpl_vars['pictures_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['picture'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['picture']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['picture']):
        $this->_foreach['picture']['iteration']++;
?>
					
					<li>
					
						<a href="<?php echo $this->_tpl_vars['DP']; ?>
images/picture/<?php echo $this->_tpl_vars['picture']['picture_id']; ?>
_03_01.jpg" alt="<?php echo $this->_tpl_vars['picture']['title']; ?>
" title="<?php echo $this->_tpl_vars['picture']['title']; ?>
" rel=company_picture>
					
						<img style="float: left; padding: 0 12px 10px 0;" width="80" src="<?php echo $this->_tpl_vars['DP']; ?>
images/picture/<?php echo $this->_tpl_vars['picture']['picture_id']; ?>
_02_01.jpg" alt="<?php echo $this->_tpl_vars['picture']['title']; ?>
" />
					
						</a>
					
					</li>
					
					<?php endforeach; endif; unset($_from); ?>
					</ul>
				</div>				
				<?php endif; ?>	
				<div id="2" class="map">
					<h4>Kontakt</h4>
					<div class="desc"><?php echo $this->_tpl_vars['product_details']['content2']; ?>
</div>
				</div>			
				
				<div id="3" class="map">
					<h4>Mapa</h4>
					<div style="padding-top: 15px;"><?php echo $this->_tpl_vars['product_details']['video']; ?>
</div>
				</div>
							</div>

			<?php endif; ?>
			
		</div>
		<div class="clear"></div>
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
	</section>