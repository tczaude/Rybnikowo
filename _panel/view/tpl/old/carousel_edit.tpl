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
		<b><br>
		{if !$carousel.id}Dodawanie nowej pozycji{else}Edycja pozycji{/if}
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

<form name="CarouselEdit" method="post" enctype="multipart/form-data">

<input type="hidden" name="carousel_form[category_id]" value="1">
<input type="hidden" name="carousel_form[language_id]" value="{$carousel.language_id|default:$language_id}">
<input type="hidden" name="carousel_form[carousel_id]" value="{$carousel.carousel_id}">
<input type="hidden" name="action" value="SaveCarousel">

<table border="0" cellpadding="5" cellspacing="0" width="100%">
	<tr valign="top">
		<td width="1">Tytuł:</td>
		<td width="90%">
			<input type="text" name="carousel_form[title]" value='{$carousel.title|default:$ret_post.title}' class="long" style="width:330px;">
		</td>
	</tr>

	<tr valign="middle">
		<td>{$dict_templates.Status}:</td>
		<td>
			<select name="carousel_form[status]" class="adm11"  style="width:330px;">
				<option value="1" {if $carousel.status eq 1}selected{/if}>Nie</option>
				<option value="2" {if $carousel.status eq 2}selected{/if}>Tak</option>
			</select>
		</td>
	</tr>



	<tr>
		<td colspan="2">
			<img src="img/kreska_adm_gray.gif" width="95%" height="1">
		</td>
	</tr>
	<tr valign="middle">
		<td>Zdjęcie (*.jpg):</td>
		<td><input type="file" id="pic_01" name="pic_01" class="adm3"></td>
	</tr>
	<tr valign="top">
		<td>
			Koordynaty:<br>
			NAME="id"
		</td>
		<td>
			<textarea name="carousel_form[coords]" class="required" style="width:330px; height:150px;">{$carousel.coords|default:$ret_post.coords}</textarea>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="img/kreska_adm_gray.gif" width="95%" height="1">
		</td>
	</tr>
	{*
	<tr valign="top">
		<td width="1">Link:</td>
		<td width="90%">
			<input type="text" name="carousel_form[abstract]" value='{$carousel.abstract|default:$ret_post.abstract}' class="long" style="width:330px;">
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