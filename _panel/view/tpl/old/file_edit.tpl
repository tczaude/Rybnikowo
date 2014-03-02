{include file="head_pop.tpl"}

{if $close}
	<script language="JavaScript">
		window.opener.location = '{$location}';
		window.close();
	</script>
{/if}

<table border="0" cellpadding="5" cellspacing="0" width="100%" align="center">
	
	{if $errors}
	<tr>
		<td align="center">
			<span style="color:red;">
				<b>
				{foreach from=$errors item=er}
					{$er}<br/>
				{/foreach}
				</b>
			</span>
		</td>
	</tr>
	{/if}
</table>

<form name="FileEdit" enctype="multipart/form-data" method="post">

<input type="hidden" name="file_form[file_id]" value="{$file.file_id}">
<input type="hidden" name="file_form[product_id]" value="{$ProductId}">
<input type="hidden" name="file_form[language_id]" value="{$file.language_id|default:$language_id}">
<input type="hidden" name="action" value="SaveFile">

<table border="0" cellpadding="5" cellspacing="0" width="100%">
	<tr valign="top">
		<td width="1">{$dict_templates.FilePart}:</td>
		<td width="90%">
			<input type="text" name="file_form[part]" value='{$file.part|default:$ret_post.part}' class="long" style="width:330px;">
		</td>
	</tr>
	<tr valign="middle">
		<td>{$dict_templates.File}:</td>
		<td>
			<select name="file_form[file]" class="adm11"  style="width:330px;">
				<option value="0" selected>{$dict_templates.SelectFile}</option>
				{foreach from=$uploaded_files item=file key=key}
				<option value="{$file}">{$file}</option>
				{/foreach}
			</select>
		</td>
	</tr>
	<tr valign="top">
		<td colspan="2" align="center">
			<input type="submit" value="{$dict_templates.Save}" name="save" class="adm2">
			<input type="button" value="{$dict_templates.Close}" name="close" class="adm2" onclick="window.close();">
		</td>
	</tr>
</table>
</form>

</td>
</tr>
</table>
<br><br><br>
{include file="foot_pop.tpl"}