{include file="head_pop.tpl"}

{if $reload}
	<script language="JavaScript">
		window.opener.location.reload();
		// window.close();
	</script>
{/if}

<table border="0" cellpadding="5" cellspacing="0" width="100%" align="center">
	{*
	{if $article.id}
	<tr>
		<td>
			{$dict_templates.GetLanguageVersion} :&nbsp;
			{foreach from=$languages_list item=language}
				&nbsp;<a href="{$path}/article/edit/{$article.article_id}/{$language.id}"><img src="{$path}/images/{$language.short}.gif" border="0" title="{$language.short}"></a>&nbsp;
			{/foreach}
		</td>
	</tr>
	{/if}
	*}
	<tr>
		<td colspan="2">
		<b><br>
		{if !$article.id}Dodawanie nowego artukułu{else}Edycja artykułu{/if}
		</b>

		</td>
	</tr>	
	
	<tr>
		<td>
			<img src="img/kreska_adm_gray.gif" width="400" height="1">
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

<form name="ArticleEdit" method="post" enctype="multipart/form-data">
{if $article.id}
<input type="hidden" name="article_form[category_id]" value="{$article.category_id}">
{else}
<input type="hidden" name="article_form[category_id]" value="{$category_id}">
{/if}

<input type="hidden" name="article_form[language_id]" value="{$article.language_id|default:$language_id}">
<input type="hidden" name="article_form[article_id]" value="{$article.article_id}">
<input type="hidden" name="action" value="SaveArticle">

<table border="0" cellpadding="5" cellspacing="0" width="100%">
	<tr valign="top">
		<td width="1">{$dict_templates.ArticleTitle}:</td>
		<td width="90%">
			<input type="text" name="article_form[title]" value='{$article.title|default:$ret_post.title}' class="long" style="width:330px;">
		</td>
	</tr>

	<tr valign="middle">
		<td>{$dict_templates.Status}:</td>
		<td>
			<select name="article_form[status]" class="adm11"  style="width:330px;">
				<option value="1" {if $article.status eq 1}selected{/if}>{$dict_templates.ArticleUnPublished}</option>
				<option value="2" {if $article.status eq 2}selected{/if}>{$dict_templates.ArticlePublished}</option>
			</select>
		</td>
	</tr>
	{*
	<tr valign="middle">
		<td>{$dict_templates.ArticleCategory}:</td>
		<td>
			<select name="article_form[category_id]" class="adm11"  style="width:330px;">
				{foreach from=$dict_templates.article_category item=category key=key}
				<option value="{$key}" {if $article.category_id eq $key || $category_id eq $key}selected{/if}>{$category}</option>
				{/foreach}
			</select>
		</td>
	</tr>
	*}

	<tr>
		<td colspan="2">
			<img src="img/kreska_adm_gray.gif" width="95%" height="1">
		</td>
	</tr>
	
	{if $category_id eq 8 || $category_id eq 9 || $category_id eq 10}
	<tr valign="middle">
		<td>Grafika:</td>
		<td><input type="file" id="pic_01" name="pic_01" class="adm3">
		{if $article.pic_01}<img src="{$__CFG.base_url}images/article/{$article.article_id}_01.jpg">{/if}
		</td>
	</tr>
	{if $article.pic_01}
	<tr valign="middle">
		<td>&nbsp;</td>
		<td><input type="checkbox" name="article_form[remove_picture]" value="1">Usuń zdjęcie 1</td>
	</tr>
	{/if}
	{/if}
	{*
	<tr valign="middle">
		<td>{$dict_templates.ArticlePicture} :</td>
		<td><input type="file" id="pic_01" name="pic_01" class="adm3">
		{if $article.pic_01}<a href="{$__CFG.article_pictures_url}{$article.article_id}_01.jpg" target="zdj2">{$article.pic_01}</a>{/if}
		</td>
	</tr>
	<tr valign="middle">
		<td>&nbsp;</td>
		<td><input type="checkbox" name="article_form[remove_picture]" value="1"> {$dict_templates.Remove} {$dict_templates.Picture}</td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="img/kreska_adm_gray.gif" width="95%" height="1">
		</td>
	</tr>

	<tr valign="top">
		<td>{$dict_templates.ArticleAbstract}:</td>
		<td>
			<textarea name="article_form[abstract]"  class="zaj"  style="width:330px; height:100px;">{$article.abstract|default:$ret_post.abstract}</textarea>
		</td>
	</tr>
	*}
	<tr valign="top">
		<td>{$dict_templates.ArticleContent}:</td>
		<td>
			{$sSpaw}
			<br><br>
		</td>
	</tr>
	<tr valign="top">
		<td colspan="2" align="center">
			<input type="button" value="{$dict_templates.Close}" name="close" style="width:100px;" onclick="window.close();">
			<input type="submit" value="{$dict_templates.Save}" name="save" style="width:100px;">
		</td>
	</tr>
</table>
</form>

</td>
</tr>
</table>
<br><br><br>
{include file="foot_pop.tpl"}