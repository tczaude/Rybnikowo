{if $set_filter}
	<div id="filters">
{else}
	<div id="filters" style="display:none;">
{/if}


<form method="post">

<input type="hidden" id="action" name="action" value="SearchUser">
<input type="hidden" name="user_page_number" value="{$paging.current}">


<table id="filtry">
	<tr>
		<td>
			<label for="date">Data rejestracji:</label>
			<input class="input-small flexy_datepicker_input" type="text" value="{if $ret_filters.date_created}{$ret_filters.date_created}{else}{/if}" name="article_form[date_created]" id="date"/>					               		
		</td>


	</tr>
	<tr>
		<td>
            <label for="name">Nazwisko:</label>
            <input type="text" id="surname" name="user_form[surname]" value="{$ret_filters.surname}" class="input-small">
        </td>
		<td>
            <label for="name">Imię:</label>
            <input type="text" id="name" name="user_form[name]" value="{$ret_filters.name}" class="input-small">
        </td>
		<td>
            <label for="name">Miasto:</label>
            <input type="text" id="city" name="user_form[city]" value="{$ret_filters.city}" class="input-small">
        </td>
	</tr>
</table>
<table>
	<tr>
		<td>
			<input type="submit" value="{$dict_templates.Search}" name="search" class="button">
					
		</td>
		<td>
		{if $set_filter}<input type="reset" onclick="window.location='{$path}/user/clear'" value="{$dict_templates.ClearSearch}" class="button">{/if}
		</td>
		
	</tr>
</table>		




</form>
				


</div>