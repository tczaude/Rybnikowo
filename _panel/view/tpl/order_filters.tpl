{if $set_filter}
	<div id="filters">
{else}
	<div id="filters" style="display:none;">
{/if}


<form method="post">

<input type="hidden" id="action" name="action" value="SearchShopOrder">
<input type="hidden" name="order_page_number" value="{$paging.current}">


<table id="filtry">
	<tr>
		<td>
			<label for="date">Data od:</label>
			<input class="input-small flexy_datepicker_input" type="text" value="{if $order_filters.date_from}{$order_filters.date_from}{else}{/if}" name="search_form[date_from]" id="date"/>					               		
		</td>
		<td colspan="2">
			<label for="date2">Data do:</label>
			<input class="input-small flexy_datepicker_input" type="text" value="{if $order_filters.date_to}{$order_filters.date_to}{else}{/if}" name="search_form[date_to]" id="date2"/>					               		
		</td>

	</tr>
	<tr>
		<td colspan="2">
			<label for="selectbox">Status:</label>
			<select name="search_form[status]" id="selectbox">
				<option value="">- wybierz -</option>
				{*<option value="1" {if $order_filters.status eq 1}selected{/if}>Niezakończone</option>*}
            {foreach from=$dict_templates.status_message item=status}
				<option value="{$status.id}" {if $order_filters.status eq $status.id}selected{/if}>{$status.name}</option>
			{/foreach}
			</select>		
		</td>
	</tr>
	<tr>
		<td>
            <label for="name">Nazwisko:</label>
            <input type="text" id="name" name="search_form[surname]" value="{$ret_filters.surname}" class="input-small">
        </td>
		<td>
            <label for="name">Imię:</label>
            <input type="text" id="name" name="search_form[name]" value="{$ret_filters.name}" class="input-small">
        </td>
		<td>
            <label for="name">Miasto:</label>
            <input type="text" id="name" name="search_form[city]" value="{$ret_filters.city}" class="input-small">
        </td>
	</tr>
</table>
<table>
	<tr>
		<td>
			<input type="submit" value="{$dict_templates.Search}" name="search" class="button">
					
		</td>
		<td>
		{if $set_filter}<input type="reset" onclick="window.location='{$path}/order/clear'" value="{$dict_templates.ClearSearch}" class="button">{/if}
		</td>
		
	</tr>
</table>		

</form>
				


</div>