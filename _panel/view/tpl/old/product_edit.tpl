{include file="head_pop.tpl"}

{if $reload}
	<script language="JavaScript">
		window.opener.location.reload();
		window.close();
	</script>
{/if}

{include file="product_validate.tpl"}

<table border="0" cellpadding="5" cellspacing="0" width="100%" align="center">
	{*
	<tr>
		<td>
			{$dict_templates.GetLanguageVersion} :&nbsp;
			{foreach from=$languages_list item=language}
				&nbsp;<a href="{$path}/product/edit/{$product.product_id}/{$language.id}"><img src="{$path}/images/{$language.short}.gif" border="0" title="{$language.short}"></a>&nbsp;
			{/foreach}
		</td>
	</tr>
	*}
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

<form id="productForm" name="ProductEdit" method="post" enctype="multipart/form-data">

<input type="hidden" name="product_form[category_id]" value="{$product.category_id}">
<input type="hidden" name="product_form[language_id]" value="1">
<input type="hidden" name="product_form[product_id]" value="{$product.product_id}">
<input type="hidden" name="action" value="SaveProduct">

<table class="adm3" border="0" cellpadding="5" cellspacing="0" width="100%">
	
	
	<!-- Typ -->
	
	<tr valign="middle">
		<td width="1">Typ:</td>
		<td>
			<label for="type1">
				<input type="radio" {if $product.product_id}{if $product.type eq 1}checked="checked"{/if}{else}{if $product.type ne 2}checked="checked"{/if}{/if} id="type1" value="1" name="product_form[type]"/>
				Aukcja
			</label>

			<label for="type2">
				<input type="radio" {if $product.type eq 2}checked="checked"{/if} id="type2" value="2" name="product_form[type]"/>
				Kup teraz
			</label>
			<label for="product_form[type]" class="error-label"></label>
		</td>
	</tr>	
	
	<!-- Dane podawowe -->
	
	<tr valign="top">
		<td width="1"><label for="product_form[title]">Tytuł:</label></td>
		<td width="90%">
			<input class="adm3" type="text"  name="product_form[title]" value='{$product.title|default:$ret_post.title}' style="width:400px;">
			<label for="product_form[title]" class="error"><br/></label>
		</td>
	</tr>
		<tr valign="top">
			<td width="20%">
				<label for="product_form[url_name]">Nazwa url:</label>
			</td>
			<td width="80%"> 
				<input class="adm3" type="text" name="product_form[url_name]" style="width:400px;" value="{$product.url_name|default:$ret_post.url_name}">
				{if $error.url_name}<div style="display: block;" id="advice-required-entry-adm4" class="validation-advice">Podany url_name już istnieje.</div>{/if}
			</td>
		</tr>
	
	<!-- Cena -->
	
	<tr valign="top">
		<td width="1">Cena:</td>
		<td width="90%">
			<input class="adm3" type="text" name="product_form[price]" value='{$product.price|default:$ret_post.price}' style="width:100px;">&nbsp;&nbsp;PLN
		</td>
	</tr>	
	<!-- Status -->	
	
	<tr valign="middle">
		<td>Status:</td>
		<td>
			<select id="adm3" name="product_form[status]" class="adm11"  style="width:400px;">
				<option value="1" {if $product.status eq 1}selected{/if}>{$dict_templates.ArticleUnPublished}</option>
				<option value="2" {if $product.status eq 2}selected{/if}>{$dict_templates.ArticlePublished}</option>
				{if $product.status eq 3}
				<option value="3" {if $product.status eq 3}selected{/if}>sprzedany</option>
				{/if}
			</select>
		</td>
	</tr>
	
	<tr valign="middle">
		<td>Kategoria:</td>
		<td>
			<select class="adm3" name="product_form[category_id]" style="width:400px;">
				{foreach from=$product_categories item=category}
				<option value="{$category.id}" {if $product.category_id eq $category.id || $category_id eq $category.id}selected{/if}><b>{$category.parent_name}</b> - {$category.name}</option>
				{/foreach}
			</select>
		</td>
	</tr> 
	{if $admin_data.level eq 2}
	<tr valign="middle">
		<td>Autor:</td>
		<td>
			<select name="product_form[author_id]" class="adm3"  style="width:400px;">
				<option value="">- wybierz -</option>
				{foreach from=$author_list item=author}
				<option value="{$author.id}" {if $product.author_id eq $author.id}selected{/if}>{$author.name}</option>
				{/foreach}
			</select>
		</td>
	</tr>
	{else}

		<input type="hidden" name="product_form[author_id]" value="{$admin_data.wtz}"/>

	{/if}
	<tr valign="middle">
		<td>Kolor:</td>
		<td>
			<select name="product_form[color]" class="adm3"  style="width:400px;">
				<option value="">- wybierz -</option>
				{foreach from=$dict_templates.colors item=color}
				<option {if $product.color eq $color.id}selected{/if} style="background: {$color.background} none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous; color: {$color.color};" value="{$color.id}">{$color.name}</option>
				{/foreach}
			</select>
		</td>
	</tr>
	<tr valign="top">
		<td width="1">Rozmiar:</td>
		<td width="90%">
			<input id="adm3" type="text" name="product_form[format]" value='{$product.format|default:$ret_post.format}' class="long" style="width:150px;">
		</td>
	</tr>
	
	<tr valign="top">
		<td width="1">Waga (kg):</td>
		<td width="90%">
			<input type="text" name="product_form[weight]" value='{$product.weight|default:$ret_post.weight}' class="adm3" style="width:150px;">
		</td>
	</tr>
	{*
	<tr valign="top">
		<td width="1">Premiera:</td>
		<td width="90%">
			<input id="adm3" type="text" name="product_form[year]" value='{$product.year|default:$ret_post.year}' class="long" style="width:150px;">
		</td>
	</tr>
	*}
	{if $admin_data.level eq 2}
	<tr valign="middle">
		<td>Promocja:</td>
		<td>
			<select id="adm3" name="product_form[promotion]" class="adm11"  style="width:400px;">
				<option value="1" {if $product.promotion eq 1}selected{/if}>Tak</option>
				<option value="0" {if $product.promotion eq 0}selected{/if}>Nie</option>
			</select>
		</td>
	</tr>	
	{/if}
	
	<tr>
		<td colspan="2">
			<img src="img/kreska_adm_gray.gif" width="95%" height="1">
		</td>
	</tr>
	<tr valign="middle">
		<td>Zdjęcie 1:</td>
		<td><input type="file" id="pic_0" name="pic_01" class="adm3">
		{if $product.pic_01}<img src="http://www.kooperatywa.code13.pl/images/product/{$product.product_id}_01_01.jpg">{/if}
		</td>
	</tr>
	<tr valign="middle">
		<td>&nbsp;</td>
		<td><input type="checkbox" name="product_form[remove_picture_01]" value="1">Usuń zdjęcie 1</td>
	</tr>
	<tr valign="middle">
		<td>Zdjęcie 2:</td>
		<td><input type="file" id="pic_02" name="pic_02" class="adm3">
		{if $product.pic_02}<img src="http://www.kooperatywa.code13.pl/images/product/{$product.product_id}_01_02.jpg">{/if}
		</td>
	</tr>
	<tr valign="middle">
		<td>&nbsp;</td>
		<td><input type="checkbox" name="product_form[remove_picture_02]" value="1">Usuń zdjęcie 2</td>
	</tr>
	<tr valign="middle">
		<td>Zdjęcie 3:</td>
		<td><input type="file" id="pic_03" name="pic_03" class="adm3">
		{if $product.pic_03}<img src="http://www.kooperatywa.code13.pl/images/product/{$product.product_id}_01_03.jpg">{/if}
		</td>
	</tr>
	<tr valign="middle">
		<td>&nbsp;</td>
		<td><input type="checkbox" name="product_form[remove_picture_03]" value="1">Usuń zdjęcie 3</td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="img/kreska_adm_gray.gif" width="95%" height="1">
		</td>
	</tr>
	
	<tr valign="top">
		<td>{$dict_templates.ProductAbstract}:</td>
		<td>
			<textarea id="adm3" name="product_form[abstract]"  class="zaj"  style="width:400px; height:100px;">{$product.abstract|default:$ret_post.abstract}</textarea>
			<label for="product_form[abstract]" class="error"><br/></label>
		</td>
	</tr>
	{*
	<tr valign="top">
		<td>Opis:</td>
		<td>
			{$sSpaw}
			<br><br>
		</td>
	</tr>
	*}
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