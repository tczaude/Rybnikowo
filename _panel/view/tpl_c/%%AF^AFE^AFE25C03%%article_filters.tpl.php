<?php /* Smarty version 2.6.9, created on 2013-02-13 22:00:41
         compiled from article_filters.tpl */ ?>
<?php if ($this->_tpl_vars['set_filter']): ?>
	<div id="filters">
<?php else: ?>
	<div id="filters" style="display:none;">
<?php endif; ?>


<form method="post">

<input type="hidden" id="action" name="action" value="SearchArticle">
<input type="hidden" id="article_product_page_number" name="article_product_page_number" value="<?php echo $this->_tpl_vars['paging']['current']; ?>
">
<input type="hidden" id="article_id" name="search_form[article_id]" value="<?php echo $this->_tpl_vars['ArticleId']; ?>
">
<input type="hidden" id="ArticleId" name="ArticleId" value="<?php echo $this->_tpl_vars['ArticleId']; ?>
">


<table id="filtry">
	<tr>
		<td>
			<label for="date">Data utworzenia:</label>
			<input class="input-small flexy_datepicker_input" type="text" value="<?php if ($this->_tpl_vars['ret_filters']['date_created']):  echo $this->_tpl_vars['ret_filters']['date_created'];  else:  endif; ?>" name="article_form[date_created]" id="date"/>					               		
		</td>
		<td colspan="2">
			<label for="date2">Data modyfikacji:</label>
			<input class="input-small flexy_datepicker_input" type="text" value="" name="article_form[date_modified]" id="date2"/>					               		
		</td>

	</tr>
	<tr>
		<td>
            <label for="selectbox">Kategoria:</label>
            <select name="selectbox" id="selectbox" class="admin">
				<?php $_from = $this->_tpl_vars['dict_templates']['article_category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['category']):
?>
				<option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['category_id'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['category']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
            </select>			
		</td>
		<td colspan="2">
			<label for="selectbox">Status:</label>
			<select name="article_form[status]" id="selectbox">
				<option value="">- wybierz -</option>
				<option value="2" <?php if ($this->_tpl_vars['ret_filters']['status'] == 2): ?>selected<?php endif; ?>>Aktywny</option>
				<option value="1" <?php if ($this->_tpl_vars['ret_filters']['status'] == 1): ?>selected<?php endif; ?>>Niektywny</option>
			</select>		
		</td>
	</tr>
	<tr>
		<td>
            <label for="name">Tytuł:</label>
            <input type="text" id="name" name="article_form[title]" value="<?php echo $this->_tpl_vars['ret_filters']['title']; ?>
" class="input-small">
        </td>
		<td>
            <label for="name">Zajawka:</label>
            <input type="text" id="name" name="article_form[abstract]" value="<?php echo $this->_tpl_vars['ret_filters']['abstract']; ?>
" class="input-small">
        </td>
		<td>
            <label for="name">Treść:</label>
            <input type="text" id="name" name="article_form[content]" value="<?php echo $this->_tpl_vars['ret_filters']['content']; ?>
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
/article/clear'" value="<?php echo $this->_tpl_vars['dict_templates']['ClearSearch']; ?>
" class="button"><?php endif; ?>
		</td>
		
	</tr>
</table>		




</form>
				


</div>