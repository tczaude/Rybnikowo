{include file="head_pop.tpl"}

{if $reload}
	<script language="JavaScript">
		window.opener.location.reload();
		// window.close();
	</script>
{/if}

<table border="0" cellpadding="5" cellspacing="0" width="100%" align="center">
	
	<tr>
		<td colspan="2">
			<b>{if !$baner.id}{$dict_templates.AddNewBanerHeader}{else}{$dict_templates.EditBanerHeader}{/if}</b>
		</td>
	</tr>
	
	<tr>
		<td colspan="2">
			<img src="img/kreska_adm_gray.gif" width="95%" height="1">
		</td>
	</tr>
	{*
	<tr>
		<td colspan="2">
			{$dict_templates.GetLanguageVersion} :&nbsp;
			{foreach from=$language_list item=language}
			&nbsp;<a href="baner.php?action=EditView&BanerId={$baner.baner_id}&LanguageId={$language.id}">{$language.short}</a>&nbsp;
			{/foreach}
		</td>
	</tr>
	*}
	<tr>
		<td colspan="2">
			<img src="img/kreska_adm_gray.gif" width="95%" height="1">
		</td>
	</tr>
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

<form name="BanerEdit" enctype="multipart/form-data" method="post">

<input type="hidden" name="baner_form[baner_id]" value="{$baner.baner_id}">
<input type="hidden" name="baner_form[type_id]" value="{$baner.type_id|default:$type_id}">
<input type="hidden" name="baner_form[language_id]" value="{$baner.language_id|default:$language_id}">
<input type="hidden" name="baner_form[category_id]" value="1">
<input type="hidden" name="action" value="SaveBaner">

<table border="0" cellpadding="5" cellspacing="0" width="100%">
	<tr valign="top">
		<td width="1">{$dict_templates.BanerLink}:</td>
		<td width="90%">
			<input type="text" name="baner_form[link]" value='{$baner.link|default:$ret_post.link}' class="long" style="width:330px;">
		</td>
	</tr>
	<tr valign="middle">
		<td>{$dict_templates.Status}:</td>
		<td>
			<select name="baner_form[status]" class="adm11"  style="width:330px;">
				<option value="1" {if $baner.status eq 1}selected{/if}>{$dict_templates.BanerUnPublished}</option>
				<option value="2" {if $baner.status eq 2}selected{/if}>{$dict_templates.BanerPublished}</option>
			</select>
		</td>
	</tr>
	<tr valign="middle">
		<td>Nowe okno:</td>
		<td>
			<select name="baner_form[target]" class="adm11"  style="width:330px;">
				<option value="1" {if $baner.target eq 1}selected{/if}>Nie</option>
				<option value="2" {if $baner.target eq 2}selected{/if}>Tak</option>
			</select>
		</td>
	</tr>	
	<tr valign="middle">
		<td>obrazek: max wys: 70px</td>
		<td><input type="file" id="pic_01" name="pic_01" class="adm3">
		{if $baner.pic_01 && !$baner.flash}<em><a href="{$__CFG.baners_pictures_url}{$baner.pic_01}" target="zdj2">{$dict_templates.See}</a></em>{/if}
		</td>
	</tr>
	{*
	<tr valign="top">
		<td>{$dict_templates.BanerContent}:</td>
		<td>
			<textarea name="baner_form[content]"  class="zaj"  style="width:330px; height:50px;">{$baner.content|default:$ret_post.content}</textarea>
		</td>
	</tr>
	*}
	<tr valign="top">
		<td colspan="2" align="center">
			<input type="button" value="{$dict_templates.Close}" name="close" class="adm2" onclick="window.close();">
			<input type="submit" value="{$dict_templates.Save}" name="save" class="adm2">
		</td>
	</tr>
</table>
</form>

</td>
</tr>
</table>
<br><br><br>
{include file="foot_pop.tpl"}