{if $set_filter}
	<div id="filters">
{else}
	<div id="filters" style="display:none;">
{/if}


<form method="post">

<input type="hidden" id="action" name="action" value="SearchArticle">
<input type="hidden" id="article_product_page_number" name="article_product_page_number" value="{$paging.current}">
<input type="hidden" id="article_id" name="search_form[article_id]" value="{$ArticleId}">
<input type="hidden" id="ArticleId" name="ArticleId" value="{$ArticleId}">


<table id="filtry">
	<tr>
		<td>
			<label for="date">Data utworzenia:</label>
			<input class="input-small flexy_datepicker_input" type="text" value="{if $ret_filters.date_created}{$ret_filters.date_created}{else}{/if}" name="article_form[date_created]" id="date"/>					               		
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
				{foreach from=$dict_templates.article_category item=category key=key}
				<option value="{$key}" {if $category_id eq $key}selected{/if}>{$category}</option>
				{/foreach}
            </select>			
		</td>
		<td colspan="2">
			<label for="selectbox">Status:</label>
			<select name="article_form[status]" id="selectbox">
				<option value="">- wybierz -</option>
				<option value="2" {if $ret_filters.status eq 2}selected{/if}>Aktywny</option>
				<option value="1" {if $ret_filters.status eq 1}selected{/if}>Niektywny</option>
			</select>		
		</td>
	</tr>
	<tr>
		<td>
            <label for="name">Tytuł:</label>
            <input type="text" id="name" name="article_form[title]" value="{$ret_filters.title}" class="input-small">
        </td>
		<td>
            <label for="name">Zajawka:</label>
            <input type="text" id="name" name="article_form[abstract]" value="{$ret_filters.abstract}" class="input-small">
        </td>
		<td>
            <label for="name">Treść:</label>
            <input type="text" id="name" name="article_form[content]" value="{$ret_filters.content}" class="input-small">
        </td>
	</tr>
</table>
<table>
	<tr>
		<td>
			<input type="submit" value="{$dict_templates.Search}" name="search" class="button">
					
		</td>
		<td>
		{if $set_filter}<input type="reset" onclick="window.location='{$path}/article/clear'" value="{$dict_templates.ClearSearch}" class="button">{/if}
		</td>
		
	</tr>
</table>		




</form>
				


</div>