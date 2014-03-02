<?php /* Smarty version 2.6.9, created on 2013-02-12 13:27:23
         compiled from order_filters.tpl */ ?>
<?php if ($this->_tpl_vars['set_filter']): ?>
	<div id="filters">
<?php else: ?>
	<div id="filters" style="display:none;">
<?php endif; ?>


<form method="post">

<input type="hidden" id="action" name="action" value="SearchShopOrder">
<input type="hidden" name="order_page_number" value="<?php echo $this->_tpl_vars['paging']['current']; ?>
">


<table id="filtry">
	<tr>
		<td>
			<label for="date">Data od:</label>
			<input class="input-small flexy_datepicker_input" type="text" value="<?php if ($this->_tpl_vars['order_filters']['date_from']):  echo $this->_tpl_vars['order_filters']['date_from'];  else:  endif; ?>" name="search_form[date_from]" id="date"/>					               		
		</td>
		<td colspan="2">
			<label for="date2">Data do:</label>
			<input class="input-small flexy_datepicker_input" type="text" value="<?php if ($this->_tpl_vars['order_filters']['date_to']):  echo $this->_tpl_vars['order_filters']['date_to'];  else:  endif; ?>" name="search_form[date_to]" id="date2"/>					               		
		</td>

	</tr>
	<tr>
		<td colspan="2">
			<label for="selectbox">Status:</label>
			<select name="search_form[status]" id="selectbox">
				<option value="">- wybierz -</option>
				            <?php $_from = $this->_tpl_vars['dict_templates']['status_message']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['status']):
?>
				<option value="<?php echo $this->_tpl_vars['status']['id']; ?>
" <?php if ($this->_tpl_vars['order_filters']['status'] == $this->_tpl_vars['status']['id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['status']['name']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
			</select>		
		</td>
	</tr>
	<tr>
		<td>
            <label for="name">Nazwisko:</label>
            <input type="text" id="name" name="search_form[surname]" value="<?php echo $this->_tpl_vars['ret_filters']['surname']; ?>
" class="input-small">
        </td>
		<td>
            <label for="name">Imię:</label>
            <input type="text" id="name" name="search_form[name]" value="<?php echo $this->_tpl_vars['ret_filters']['name']; ?>
" class="input-small">
        </td>
		<td>
            <label for="name">Miasto:</label>
            <input type="text" id="name" name="search_form[city]" value="<?php echo $this->_tpl_vars['ret_filters']['city']; ?>
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
/order/clear'" value="<?php echo $this->_tpl_vars['dict_templates']['ClearSearch']; ?>
" class="button"><?php endif; ?>
		</td>
		
	</tr>
</table>		

</form>
				


</div>