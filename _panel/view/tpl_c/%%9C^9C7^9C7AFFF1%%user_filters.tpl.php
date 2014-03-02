<?php /* Smarty version 2.6.9, created on 2013-02-13 22:01:07
         compiled from user_filters.tpl */ ?>
<?php if ($this->_tpl_vars['set_filter']): ?>
	<div id="filters">
<?php else: ?>
	<div id="filters" style="display:none;">
<?php endif; ?>


<form method="post">

<input type="hidden" id="action" name="action" value="SearchUser">
<input type="hidden" name="user_page_number" value="<?php echo $this->_tpl_vars['paging']['current']; ?>
">


<table id="filtry">
	<tr>
		<td>
			<label for="date">Data rejestracji:</label>
			<input class="input-small flexy_datepicker_input" type="text" value="<?php if ($this->_tpl_vars['ret_filters']['date_created']):  echo $this->_tpl_vars['ret_filters']['date_created'];  else:  endif; ?>" name="article_form[date_created]" id="date"/>					               		
		</td>


	</tr>
	<tr>
		<td>
            <label for="name">Nazwisko:</label>
            <input type="text" id="surname" name="user_form[surname]" value="<?php echo $this->_tpl_vars['ret_filters']['surname']; ?>
" class="input-small">
        </td>
		<td>
            <label for="name">Imię:</label>
            <input type="text" id="name" name="user_form[name]" value="<?php echo $this->_tpl_vars['ret_filters']['name']; ?>
" class="input-small">
        </td>
		<td>
            <label for="name">Miasto:</label>
            <input type="text" id="city" name="user_form[city]" value="<?php echo $this->_tpl_vars['ret_filters']['city']; ?>
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
/user/clear'" value="<?php echo $this->_tpl_vars['dict_templates']['ClearSearch']; ?>
" class="button"><?php endif; ?>
		</td>
		
	</tr>
</table>		




</form>
				


</div>