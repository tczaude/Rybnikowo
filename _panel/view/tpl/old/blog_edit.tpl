{include file="head_pop.tpl"}

{if $reload}
	<script language="JavaScript">
		window.opener.location.reload();
		// window.close();
	</script>
{/if}

{include file="blog_validate.tpl"}

<table border="0" cellpadding="5" cellspacing="0" width="100%" align="center">
	{*
	{if $blog.id}
	<tr>
		<td>
			{$dict_templates.GetLanguageVersion} :&nbsp;
			{foreach from=$languages_list item=language}
				&nbsp;<a href="{$path}/blog/edit/{$blog.blog_id}/{$language.id}"><img src="{$path}/images/{$language.short}.gif" border="0" title="{$language.short}"></a>&nbsp;
			{/foreach}
		</td>
	</tr>
	{/if}
	*}
	
	<tr>
		<td colspan="2">
		<b><br>
		{if !$blog.id}Dodawanie nowego wpisu{else}Edycja wpisu{/if}
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

<form id="blogForm" name="BlogEdit" method="post" enctype="multipart/form-data">

<input type="hidden" name="blog_form[category_id]" value="{$blog.category_id}">
<input type="hidden" name="blog_form[language_id]" value="{$blog.language_id|default:$language_id}">
<input type="hidden" name="blog_form[category_id]" value="1">
<input type="hidden" name="blog_form[blog_id]" value="{$blog.blog_id}">
<input type="hidden" name="action" value="SaveBlog">
{if $admin_data.wtz}
<input type="hidden" name="blog_form[author_id]" value="{$admin_data.wtz}">
{/if}
{if $blog.author_id ne 0}
<input type="hidden" name="blog_form[author_id]" value="{$blog.author_id}">
{/if}

<table border="0" cellpadding="5" cellspacing="0" width="100%">
	<tr valign="top">
		<td width="1"><label for="blog_form[title]">Tytuł:</label></td>
		<td width="90%">
			<input class="adm3" type="text"  name="blog_form[title]" value='{$blog.title|default:$ret_post.title}' style="width:400px;">
			<label for="blog_form[title]" class="error"><br/></label>
		</td>
	</tr>
	
	<tr valign="top">
		<td width="20%">
			<label for="blog_form[url_name]">Nazwa url:</label>
		</td>
		<td width="80%"> 
			<input class="adm3" type="text" name="blog_form[url_name]" style="width:400px;" value="{$blog.url_name|default:$ret_post.url_name}">
			{if $error.url_name}<div style="display: block;" id="advice-required-entry-adm4" class="validation-advice">Podany url_name już istnieje.</div>{/if}
		</td>
	</tr>
	{if $admin_data.level eq 2}
	<tr valign="middle">
		<td>Status:</td>
		<td>
			<select id="adm3" name="blog_form[status]" class="adm11"  style="width:400px;"> 
				<option value="1" {if $blog.status eq 1}selected{/if}>Nieopublikowany</option>
				<option value="2" {if $blog.status eq 2}selected{/if}>Opublikowany</option>
			</select>
		</td>
	</tr>
	{else}
	<input type="hidden" name="blog_form[status]" value="1">
	{/if}
	<tr>
		<td colspan="2">
			<img src="img/kreska_adm_gray.gif" width="95%" height="1">
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="img/kreska_adm_gray.gif" width="95%" height="1">
		</td>
	</tr>
	<tr valign="middle">
		<td>Zdjęcie 1:</td>
		<td><input type="file" id="pic_0" name="pic_01" class="adm3">
		{if $blog.pic_01}<img src="http://www.kooperatywa.code13.pl/images/blog/{$blog.blog_id}_01_01.jpg">{/if}
		</td>
	</tr>
	<tr valign="middle">
		<td>&nbsp;</td>
		<td><input type="checkbox" name="blog_form[remove_picture_01]" value="1">Usuń zdjęcie 1</td>
	</tr>
	<tr valign="middle">
		<td>Zdjęcie 2:</td>
		<td><input type="file" id="pic_02" name="pic_02" class="adm3">
		{if $blog.pic_02}<img src="http://www.kooperatywa.code13.pl/images/blog/{$blog.blog_id}_01_02.jpg">{/if}
		</td>
	</tr>
	<tr valign="middle">
		<td>&nbsp;</td>
		<td><input type="checkbox" name="blog_form[remove_picture_02]" value="1">Usuń zdjęcie 2</td>
	</tr>
	<tr valign="middle">
		<td>Zdjęcie 3:</td>
		<td><input type="file" id="pic_03" name="pic_03" class="adm3">
		{if $blog.pic_03}<img src="http://www.kooperatywa.code13.pl/images/blog/{$blog.blog_id}_01_03.jpg">{/if}
		</td>
	</tr>
	<tr valign="middle">
		<td>&nbsp;</td>
		<td><input type="checkbox" name="blog_form[remove_picture_03]" value="1">Usuń zdjęcie 3</td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="img/kreska_adm_gray.gif" width="95%" height="1">
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="img/kreska_adm_gray.gif" width="95%" height="1">
		</td>
	</tr>
	
	<tr valign="top">
		<td>{$dict_templates.ProductAbstract}:</td>
		<td>
			<textarea id="adm3" name="blog_form[abstract]"  class="zaj"  style="width:400px; height:100px;">{$blog.abstract|default:$ret_post.abstract}</textarea>
			<label for="blog_form[abstract]" class="error"><br/></label>
		</td>
	</tr>

	<tr valign="top">
		<td>Treść:</td>
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