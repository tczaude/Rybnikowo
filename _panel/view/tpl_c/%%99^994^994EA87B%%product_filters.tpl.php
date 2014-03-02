<?php /* Smarty version 2.6.9, created on 2013-02-13 21:49:28
         compiled from product_filters.tpl */ ?>
<?php if ($this->_tpl_vars['set_filter']): ?>
	<div id="filters">
<?php else: ?>
	<div id="filters" style="display:none;">
<?php endif; ?>


<form method="post">

<input type="hidden" id="action" name="action" value="SearchProduct">
<input type="hidden" id="product_product_page_number" name="product_product_page_number" value="<?php echo $this->_tpl_vars['paging']['current']; ?>
">
<input type="hidden" id="product_id" name="search_form[product_id]" value="<?php echo $this->_tpl_vars['ProductId']; ?>
">
<input type="hidden" id="ProductId" name="ProductId" value="<?php echo $this->_tpl_vars['ProductId']; ?>
">


<table id="filtry">
	<tr>
		<td>
			<label for="date">Data utworzenia:</label>
			<input class="input-small flexy_datepicker_input" type="text" value="<?php if ($this->_tpl_vars['ret_post_search']['date_created']):  echo $this->_tpl_vars['ret_post_search']['date_created'];  else:  endif; ?>" name="search_form[date_created]" id="date"/>					               		
		</td>
		<td>
			<label for="date2">Data modyfikacji:</label>
			<input class="input-small flexy_datepicker_input" type="text" value="" name="search_form[date_modified]" id="date2"/>					               		
		</td>
		<td>
			<label for="selectbox">Usługa:</label>
			<select name="search_form[service]" id="selectbox">
				<option value="1" <?php if ($this->_tpl_vars['ret_post_search']['service'] == 1): ?>selected<?php endif; ?>>Tak</option>
				<option value="0" <?php if ($this->_tpl_vars['ret_post_search']['service'] == 0): ?>selected<?php endif; ?>>Nie</option>
			</select>		
		</td>
	</tr>
	<tr>
		<td>
            <label for="selectbox">Kategoria:</label>
            <select id="selectbox" class="admin" name="search_form[category_id]">
					<option value="">- wybierz -</option>
				<?php $_from = $this->_tpl_vars['product_categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
				<?php if ($this->_tpl_vars['category']['sub']): ?>
					<?php $_from = $this->_tpl_vars['category']['sub']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['subcategory']):
?>										
					<option value="<?php echo $this->_tpl_vars['subcategory']['id']; ?>
" <?php if ($this->_tpl_vars['ret_post_search']['category_id'] == $this->_tpl_vars['subcategory']['id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['category']['name']; ?>
 - <?php echo $this->_tpl_vars['subcategory']['name']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
            </select>			
		</td>
		<td>
			<label for="selectbox">Status:</label>
			<select name="search_form[status]" id="selectbox">
				<option value="">- wybierz -</option>
				<option value="2" <?php if ($this->_tpl_vars['ret_post_search']['status'] == 2): ?>selected<?php endif; ?>>Aktywny</option>
				<option value="1" <?php if ($this->_tpl_vars['ret_post_search']['status'] == 1): ?>selected<?php endif; ?>>Niektywny</option>
			</select>		
		</td>
		<td>
			<label for="selectbox">Promocja:</label>
			<select name="search_form[promotion]" id="selectbox">
				<option value="1" <?php if ($this->_tpl_vars['ret_post_search']['promotion'] == 1): ?>selected<?php endif; ?>>Tak</option>
				<option value="0" <?php if ($this->_tpl_vars['ret_post_search']['promotion'] == 0): ?>selected<?php endif; ?>>Nie</option>
			</select>		
		</td>
		<td>
			<label for="selectbox">Strona główna:</label>
			<select name="search_form[home]" id="selectbox">
				<option value="1" <?php if ($this->_tpl_vars['ret_post_search']['home'] == 1): ?>selected<?php endif; ?>>Tak</option>
				<option value="0" <?php if ($this->_tpl_vars['ret_post_search']['home'] == 0): ?>selected<?php endif; ?>>Nie</option>
			</select>		
		</td>
	</tr>
	<tr>
		<td>
            <label for="name">Tytuł:</label>
            <input type="text" id="name" name="search_form[title]" value="<?php echo $this->_tpl_vars['ret_post_search']['title']; ?>
" class="input-small">
        </td>
		<td>
            <label for="name">Zajawka:</label>
            <input type="text" id="name" name="search_form[abstract]" value="<?php echo $this->_tpl_vars['ret_post_search']['abstract']; ?>
" class="input-small">
        </td>
		<td colspan="2">
            <label for="name">Treść:</label>
            <input type="text" id="name" name="search_form[content]" value="<?php echo $this->_tpl_vars['ret_post_search']['content']; ?>
" class="input-small">
        </td>
	</tr>
</table>
<table>
	<tr>
		<td>
			<input type="submit" value="<?php echo $this->_tpl_vars['dict_templates']['Search']; ?>
" name="search" class="button">
					
		</td>
		<td>
		<?php if ($this->_tpl_vars['set_filter']): ?><input type="reset" onclick="window.location='<?php echo $this->_tpl_vars['path']; ?>
/product/clear_filter'" value="<?php echo $this->_tpl_vars['dict_templates']['ClearSearch']; ?>
" class="button"><?php endif; ?>
		</td>
		
	</tr>
</table>		




</form>
				


</div>