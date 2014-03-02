{include file="head_pop.tpl"}

	{if $close}
	<script language="JavaScript">
		window.opener.location = '{$location}';
		{*window.close();*}
	</script>
	{/if}
	
	{include file="publisher_validate.tpl"}

	<form class="cmxform" id="signupForm" enctype="multipart/form-data" method="post">
	<table class="adm3" border="0" cellpadding="3" cellspacing="0" width="95%" align="center">
		<tr>
			<td colspan="2">
			<b><br>
			{if !$publisher.id}Dodawanie WTZ{else}Edycja WTZ{/if}
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
			<td width="20%"> 
				<label for="publisher[name]">Nazwa:</label> 
			</td>
			<td width="80%"> 
				<input class="adm3" type="text" name="publisher[name]" style="width:400px;" value="{$publisher.name|default:$ret_post.name}">
			</td>
		</tr>
		
		<tr valign="top">
			<td width="20%"> 
				<label for="publisher[email]">Email:</label> 
			</td>
			<td width="80%"> 
				<input class="adm3" type="text" name="publisher[email]" style="width:400px;" value="{$publisher.email|default:$ret_post.email}">
			</td>
		</tr>
		
		<tr valign="top">
			<td> {$dict_templates.PublisherDescription}: </td>
			<td> {$sSpaw} </td>
		</tr>
		
		
		<tr valign="middle">
			<td>{$dict_templates.PublisherVisible}:</td>
			<td>
				<select id="status" name="publisher[status]" class="adm3" style="width:400px;">
					<option value="1" {if !$publisher.id || $publisher.status eq 1 || $ret_post.status eq 1}selected{/if}>{$dict_templates.Yes}</option>
					<option value="0" {if $publisher.id && $publisher.status eq 0}selected{/if}>{$dict_templates.No}</option>
				</select>
			</td>
		</tr>
		
		<tr valign="middle">
			<td>Zdjęcie 1:</td>
			<td><input type="file" id="pic_1" name="pic_01" class="adm3">
			{if $publisher.pic_01}<img src="http://www.kooperatywa.code13.pl/images/publisher/{$publisher.id}_01.jpg">{/if}
			</td> 
		</tr>
		{if $publisher.pic_01}
		<tr valign="middle">
			<td>&nbsp;</td>
			<td><input type="checkbox" name="publisher[remove_picture_01]" value="1">Usuń zdjęcie 1</td>
		</tr>
 		{/if}
		<tr valign="top">
			<td>&nbsp;</td>
			<td align="left">
				<br>
				<input type="hidden" name="publisher[id]" value="{$publisher.id}">
				<input type="hidden" name="publisher[parent]" value="{$ParentId|default:"0"}">
				<input type="hidden" name="action" value="SavePublisher">
				<input type="reset" value="{$dict_templates.Close}" onclick="window.close();">
				<input type="submit" value="{$dict_templates.Save}" name="zapisz">
				<br><br>
			</td>
		</tr>
	</table>
	</form>

{include file="foot_pop.tpl"}

