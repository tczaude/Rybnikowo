{if $set_filter}
	<div id="filters">
{else}
	<div id="filters" style="display:none;">
{/if}


<form method="post">

<input type="hidden" id="action" name="action" value="SearchProduct">
<input type="hidden" id="product_product_page_number" name="product_product_page_number" value="{$paging.current}">
<input type="hidden" id="product_id" name="search_form[product_id]" value="{$ProductId}">
<input type="hidden" id="ProductId" name="ProductId" value="{$ProductId}">


<table id="filtry">
	<tr>
		<td>
			<label for="date">Data utworzenia:</label>
			<input class="input-small flexy_datepicker_input" type="text" value="{if $ret_post_search.date_created}{$ret_post_search.date_created}{else}{/if}" name="search_form[date_created]" id="date"/>					               		
		</td>
		<td>
			<label for="date2">Data modyfikacji:</label>
			<input class="input-small flexy_datepicker_input" type="text" value="" name="search_form[date_modified]" id="date2"/>					               		
		</td>
		<td>
			<label for="selectbox">Usługa:</label>
			<select name="search_form[service]" id="selectbox">
				<option value="1" {if $ret_post_search.service eq 1}selected{/if}>Tak</option>
				<option value="0" {if $ret_post_search.service eq 0}selected{/if}>Nie</option>
			</select>		
		</td>
	</tr>
	<tr>
		<td>
            <label for="selectbox">Kategoria:</label>
            <select id="selectbox" class="admin" name="search_form[category_id]">
					<option value="">- wybierz -</option>
				{foreach from=$product_categories item=category}
				{if $category.sub}
					{foreach from=$category.sub item=subcategory}										
					<option value="{$subcategory.id}" {if $ret_post_search.category_id eq $subcategory.id}selected{/if}>{$category.name} - {$subcategory.name}</option>
					{/foreach}
				{/if}
				{/foreach}
            </select>			
		</td>
		<td>
			<label for="selectbox">Status:</label>
			<select name="search_form[status]" id="selectbox">
				<option value="">- wybierz -</option>
				<option value="2" {if $ret_post_search.status eq 2}selected{/if}>Aktywny</option>
				<option value="1" {if $ret_post_search.status eq 1}selected{/if}>Niektywny</option>
			</select>		
		</td>
		<td>
			<label for="selectbox">Promocja:</label>
			<select name="search_form[promotion]" id="selectbox">
				<option value="1" {if $ret_post_search.promotion eq 1}selected{/if}>Tak</option>
				<option value="0" {if $ret_post_search.promotion eq 0}selected{/if}>Nie</option>
			</select>		
		</td>
		<td>
			<label for="selectbox">Strona główna:</label>
			<select name="search_form[home]" id="selectbox">
				<option value="1" {if $ret_post_search.home eq 1}selected{/if}>Tak</option>
				<option value="0" {if $ret_post_search.home eq 0}selected{/if}>Nie</option>
			</select>		
		</td>
	</tr>
	<tr>
		<td>
            <label for="name">Tytuł:</label>
            <input type="text" id="name" name="search_form[title]" value="{$ret_post_search.title}" class="input-small">
        </td>
		<td>
            <label for="name">Zajawka:</label>
            <input type="text" id="name" name="search_form[abstract]" value="{$ret_post_search.abstract}" class="input-small">
        </td>
		<td colspan="2">
            <label for="name">Treść:</label>
            <input type="text" id="name" name="search_form[content]" value="{$ret_post_search.content}" class="input-small">
        </td>
	</tr>
</table>
<table>
	<tr>
		<td>
			<input type="submit" value="{$dict_templates.Search}" name="search" class="button">
					
		</td>
		<td>
		{if $set_filter}<input type="reset" onclick="window.location='{$path}/product/clear_filter'" value="{$dict_templates.ClearSearch}" class="button">{/if}
		</td>
		
	</tr>
</table>		




</form>
				


</div>