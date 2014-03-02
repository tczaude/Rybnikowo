{include file="head_pop.tpl"}

	{if $close}
	<script language="JavaScript">
		window.opener.location = '{$location}';
		window.close();
	</script>
	{/if}
	
	{include file="category_validate.tpl"}

	<form class="cmxform" id="signupForm" enctype="multipart/form-data" method="post">
	<table class="adm3" border="0" cellpadding="3" cellspacing="0" width="95%" align="center">
		<tr>
			<td colspan="2">
			<b><br>
			{if !$category.id}Dodawanie kategorii{else}Edycja kategorii{/if}
			</b>
			<br><br>
			{$dict_templates.FieldsRequired}
			</td>
		</tr>
		
		<tr>
			<td colspan="2">
				<img src="img/kreska_adm_gray.gif" width="95%" height="1">
			</td>
		</tr>

		<tr valign="top">
			<td width="20%"> w kategorii: </td>
			<td width="80%">{if $parent.name}{$parent.name}{else}głównej{/if}</td>
		</tr>
		
		<tr valign="top">
			<td width="20%"> 
				<label for="category[name]">Kategoria:</label> 
			</td>
			<td width="80%"> 
				<input class="required" type="text" name="category[name]" style="width:370px;" value="{$category.name|default:$ret_post.name}">
			</td>
		</tr>
		<tr valign="top">
			<td width="20%">
				<label for="category[url_name]">Nazwa url:</label>
			</td>
			<td width="80%"> 
				<input class="required" type="text" name="category[url_name]" style="width:370px;" value="{$category.url_name|default:$ret_post.url_name}">
				{if $error.url_name}<div style="display: block;" id="advice-required-entry-adm4" class="validation-advice">Podany url_name już istnieje.</div>{/if}
			</td>
		</tr>
		

		
		<tr valign="middle">
			<td>{$dict_templates.CategoryVisible}:</td>
			<td>
				<select id="status" name="category[status]" class="adm3">
					<option value="1" {if !$category.id || $category.status eq 1 || $ret_post.status eq 1}selected{/if}>{$dict_templates.Yes}</option>
					<option value="0" {if $category.id && $category.status eq 0}selected{/if}>{$dict_templates.No}</option>
				</select>
			</td>
		</tr>

		<tr valign="top">
			<td>&nbsp;</td>
			<td align="left">
				<br>
				<input type="hidden" name="category[id]" value="{$category.id}">
				<input type="hidden" name="category[parent]" value="{$ParentId|default:"0"}">
				<input type="hidden" name="action" value="SaveCategory">
				<input type="reset" value="{$dict_templates.Close}" onclick="window.close();">
				<input type="submit" value="{$dict_templates.Save}" name="zapisz">
				<br><br>
			</td>
		</tr>
	</table>
	</form>

{include file="foot_pop.tpl"}

